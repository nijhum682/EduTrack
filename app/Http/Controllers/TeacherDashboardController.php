<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\ScheduledClass;
use App\Models\Lecture;
use App\Models\CourseNote;
use App\Models\ScheduledClassComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    /**
     * Display the teacher dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Get teacher's courses
        $courses = Course::where('instructor_id', $user->id)
            ->orWhere('instructor', $user->name)
            ->withCount('enrolledUsers')
            ->get();

        // If the teacher has no courses, let them see other courses to CLAIM them (for testing purposes),
        // but they can also create their own courses.
        $allCourses = Course::withCount('enrolledUsers')->get();

        // 2. Get tasks for the teacher's courses
        $courseIds = $courses->pluck('id');
        $tasks = Task::whereIn('course_id', $courseIds)->with(['course', 'questions'])->get();

        // 3. Get student submissions for these tasks
        $submissions = TaskSubmission::whereIn('task_id', $tasks->pluck('id'))
            ->with(['user', 'task.course', 'task.questions'])
            ->orderBy('is_completed', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // 4. Get scheduled classes (excluding expired ones)
        $scheduledClasses = ScheduledClass::whereIn('course_id', $courseIds)
            ->with('course')
            ->orderBy('scheduled_at', 'asc')
            ->get()
            ->filter(function ($class) {
                $endTime = $class->scheduled_at->copy()->addMinutes($class->duration_minutes);
                return now()->lessThanOrEqualTo($endTime);
            });

        return view('teacher.dashboard', compact('courses', 'allCourses', 'tasks', 'submissions', 'scheduledClasses'));
    }

    /**
     * Create a new course.
     */
    public function createCourse(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:courses,code',
            'enrollment_fee' => 'required|integer|min:0',
            'class' => 'required|string|in:Class 8,Class 9,Class 10,Class 11,Class 12',
            'description' => 'nullable|string',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'subject' => 'nullable|string|max:100',
        ]);

        $imagePath = null;
        if ($request->hasFile('course_image')) {
            $file = $request->file('course_image');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '', $file->getClientOriginalName());
            
            $destPath = public_path('uploads/courses');
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }

            $file->move($destPath, $filename);
            $imagePath = 'uploads/courses/' . $filename;
        }

        $course = Course::create([
            'title' => $request->title,
            'code' => strtoupper($request->code),
            'credits' => 3,
            'enrollment_fee' => $request->enrollment_fee,
            'class' => $request->class,
            'description' => $request->description,
            'instructor' => Auth::user()->name,
            'instructor_id' => Auth::id(),
            'image_path' => $imagePath,
            'subject' => $request->subject,
        ]);

        \App\Models\Activity::log('course_creation', "Created course: {$course->code} - {$course->title}");

        return redirect()->back()->with('success', 'Course created successfully!');
    }

    /**
     * Create a new task (question/test).
     */
    public function createTask(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'is_test' => 'nullable|boolean',
            'duration_minutes' => 'required_if:is_test,1|integer|min:5|max:480',
        ]);

        // Verify the teacher owns the course or claim it
        $course = Course::findOrFail($request->course_id);
        if ($course->instructor_id !== Auth::id()) {
            $course->update(['instructor_id' => Auth::id(), 'instructor' => Auth::user()->name]);
        }

        $isTest = $request->boolean('is_test');
        $totalPoints = 0;

        if ($isTest && $request->has('questions')) {
            foreach ($request->questions as $q) {
                $totalPoints += intval($q['points'] ?? 0);
            }
        } else {
            $request->validate(['points' => 'required|integer|min:1']);
            $totalPoints = $request->points;
        }

        $task = Task::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'points' => $totalPoints,
            'is_test' => $isTest,
            'duration_minutes' => $isTest ? $request->duration_minutes : 60,
        ]);

        if ($isTest && $request->has('questions') && is_array($request->questions)) {
            foreach ($request->questions as $index => $q) {
                // Ensure options are clean
                $options = null;
                if ($q['type'] === 'mcq' && isset($q['options']) && is_array($q['options'])) {
                    $options = array_values(array_filter($q['options']));
                }
                
                $task->questions()->create([
                    'question_text' => $q['text'],
                    'type' => $q['type'],
                    'points' => intval($q['points'] ?? 5),
                    'options' => $options,
                ]);
            }
        }

        \App\Models\Activity::log('task_creation', "Created " . ($isTest ? "test" : "task") . ": {$task->title} for {$course->title}");

        return redirect()->back()->with('success', $isTest ? 'Google Form style Test created successfully!' : 'Task/Question created successfully!');
    }

    /**
     * Evaluate a student submission.
     */
    public function evaluateSubmission(Request $request, TaskSubmission $submission)
    {
        // If it's a test, teacher might submit question-level grades
        if ($request->has('question_scores') && is_array($request->question_scores)) {
            $questionScores = $request->question_scores;
            $totalScore = 0;
            foreach ($questionScores as $qId => $score) {
                $totalScore += intval($score);
            }

            $answers = $submission->answers ?: [];
            $answers['question_grades'] = $questionScores;

            $submission->update([
                'score' => $totalScore,
                'feedback' => $request->feedback,
                'answers' => $answers,
                'graded_at' => now(),
            ]);
        } else {
            $request->validate([
                'score' => 'required|integer|min:0',
                'feedback' => 'nullable|string',
            ]);

            $submission->update([
                'score' => $request->score,
                'feedback' => $request->feedback,
                'graded_at' => now(),
            ]);
        }

        $submission->load(['user', 'task.course']);
        \App\Models\Activity::log('submission_evaluation', "Graded task submission for student {$submission->user->name} on task: {$submission->task->title}");
        \App\Models\Activity::log('grade_received', "Your submission for task: {$submission->task->title} has been graded by " . Auth::user()->name . ".", $submission->user_id);

        return redirect()->back()->with('success', 'Submission evaluated and graded successfully!');
    }

    /**
     * Schedule a virtual class.
     */
    public function scheduleClass(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'scheduled_at' => 'required|date',
            'duration_minutes' => 'required|integer|min:15|max:180',
            'platform' => 'required|string',
            'meeting_link' => 'nullable|url',
        ]);

        $scheduledClass = ScheduledClass::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'scheduled_at' => $request->scheduled_at,
            'duration_minutes' => $request->duration_minutes,
            'platform' => $request->platform,
            'meeting_link' => $request->meeting_link,
            'is_active' => false,
        ]);

        $course = Course::find($request->course_id);
        \App\Models\Activity::log('class_scheduling', "Scheduled class: {$scheduledClass->title} for " . ($course ? $course->title : 'Course'));

        return redirect()->back()->with('success', 'Class session scheduled successfully!');
    }

    /**
     * Start/Toggle a class active state.
     */
    public function toggleClassActive(Request $request, ScheduledClass $class)
    {
        $isActive = !$class->is_active;
        $updateData = ['is_active' => $isActive];
        
        // If starting the class, set scheduled_at to now so duration starts from start time
        if ($isActive) {
            $updateData['scheduled_at'] = now();
        }

        $class->update($updateData);

        $status = $isActive ? 'started' : 'ended';

        $class->load('course');
        \App\Models\Activity::log('class_toggle', "Class '{$class->title}' has been {$status} for {$class->course->title}");

        return redirect()->back()->with('success', "Class session has been {$status}!");
    }

    /**
     * Live Virtual Classroom simulation.
     */
    public function classroom(ScheduledClass $class)
    {
        $class->load([
            'course',
            'rootComments.user',
            'rootComments.replies.user'
        ]);
        $user = Auth::user();
        
        $endTime = $class->scheduled_at->copy()->addMinutes($class->duration_minutes);

        // Check if class is active or has expired for students
        if ($user->isStudent()) {
            if (!$class->is_active || now()->greaterThan($endTime)) {
                return redirect()->route('dashboard')->with('error', 'This live class session has ended.');
            }
        }

        // If the teacher joins and the class is not active/expired, activate it!
        if ($user->isTeacher() && !$class->is_active) {
            $class->update([
                'is_active' => true,
                'scheduled_at' => now()
            ]);
        }

        return view('teacher.classroom', compact('class', 'user'));
    }

    /**
     * Update Course Details.
     */
    public function updateCourseDetails(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:courses,code,' . $course->id,
            'enrollment_fee' => 'required|integer|min:0',
            'class' => 'required|string|in:Class 8,Class 9,Class 10,Class 11,Class 12',
            'description' => 'nullable|string',
        ]);

        $course->update([
            'title' => $request->title,
            'code' => strtoupper($request->code),
            'enrollment_fee' => $request->enrollment_fee,
            'class' => $request->class,
            'description' => $request->description,
        ]);

        \App\Models\Activity::log('course_update', "Updated course details for: {$course->code}");

        return redirect()->back()->with('success', 'Course details updated successfully!');
    }

    /**
     * Create a new class/lecture for a course.
     */
    public function createLecture(Request $request, Course $course)
    {
        $request->validate([
            'lecture_number' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'lecture_video' => 'nullable|file|max:51200', // Max 50MB
        ]);

        $videoPath = null;
        $runtime = null;

        if ($request->hasFile('lecture_video')) {
            $file = $request->file('lecture_video');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '', $file->getClientOriginalName());
            
            $destPath = public_path('uploads/lectures');
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }

            $file->move($destPath, $filename);
            $videoPath = 'uploads/lectures/' . $filename;
            
            // Auto calculate runtime based on a simple size mock or randomizer (e.g. between 10 and 45 mins)
            $runtime = rand(15, 60) . ' mins';
        }

        Lecture::create([
            'course_id' => $course->id,
            'lecture_number' => $request->lecture_number,
            'name' => $request->name,
            'details' => $request->details,
            'video_path' => $videoPath,
            'runtime' => $runtime,
        ]);

        \App\Models\Activity::log('lecture_creation', "Uploaded class lecture {$request->lecture_number} - {$request->name} for {$course->title}");

        return redirect()->back()->with('success', 'Class/Lecture uploaded successfully!');
    }

    /**
     * Update an existing lecture.
     */
    public function updateLecture(Request $request, Course $course, Lecture $lecture)
    {
        $request->validate([
            'lecture_number' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'lecture_video' => 'nullable|file|max:51200',
        ]);

        $updateData = [
            'lecture_number' => $request->lecture_number,
            'name' => $request->name,
            'details' => $request->details,
        ];

        if ($request->hasFile('lecture_video')) {
            // Delete old video if exists
            if ($lecture->video_path && file_exists(public_path($lecture->video_path))) {
                @unlink(public_path($lecture->video_path));
            }

            $file = $request->file('lecture_video');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '', $file->getClientOriginalName());
            
            $destPath = public_path('uploads/lectures');
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }

            $file->move($destPath, $filename);
            $updateData['video_path'] = 'uploads/lectures/' . $filename;
            $updateData['runtime'] = rand(15, 60) . ' mins';
        }

        $lecture->update($updateData);

        \App\Models\Activity::log('lecture_update', "Updated class lecture {$request->lecture_number} for {$course->title}");

        return redirect()->back()->with('success', 'Class/Lecture updated successfully!');
    }

    /**
     * Delete a lecture.
     */
    public function deleteLecture(Course $course, Lecture $lecture)
    {
        if ($lecture->video_path && file_exists(public_path($lecture->video_path))) {
            @unlink(public_path($lecture->video_path));
        }
        $lecture->delete();

        \App\Models\Activity::log('lecture_delete', "Deleted class lecture for {$course->title}");

        return redirect()->back()->with('success', 'Class/Lecture deleted successfully!');
    }

    /**
     * Evaluate/Review student note.
     */
    public function evaluateNote(Request $request, Course $course, CourseNote $note)
    {
        $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $note->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        \App\Models\Activity::log('note_evaluation', "Evaluated student note '{$note->title}'");

        return redirect()->back()->with('success', 'Student note feedback updated successfully!');
    }

    /**
     * Delete a shared note.
     */
    public function deleteNote(Course $course, CourseNote $note)
    {
        if ($note->file_path && file_exists(public_path($note->file_path))) {
            @unlink(public_path($note->file_path));
        }
        $note->delete();

        \App\Models\Activity::log('note_delete', "Deleted student note '{$note->title}'");

        return redirect()->back()->with('success', 'Shared note deleted successfully!');
    }

    /**
     * Post a comment or reply in the virtual classroom.
     */
    public function commentClass(Request $request, ScheduledClass $class)
    {
        $request->validate([
            'comment_text' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:scheduled_class_comments,id',
        ]);

        ScheduledClassComment::create([
            'scheduled_class_id' => $class->id,
            'user_id' => Auth::id(),
            'comment_text' => $request->comment_text,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('success', 'Comment posted in classroom!');
    }
}
