<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\Lecture;
use App\Models\CourseNote;
use App\Models\CourseQuestion;
use App\Models\CourseAnswer;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * CourseApiController
 * 
 * Handles all AJAX API endpoints.
 * Demonstrates:
 * 1. API Controllers: JSON responses for asynchronous requests.
 * 2. Database Queries: Advanced Eloquent searches, filtering, and CRUD operations.
 * 3. Proper Commenting: Explanations of each endpoint and query.
 */
class CourseApiController extends Controller
{
    /**
     * Get list of courses with searching and filtering.
     * 
     * URL: GET /api/courses?q=computer&credits=3
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Start database query (MySQL)
        $query = Course::query();

        // 1. Database Search (CRUD - Read)
        if ($request->filled('q')) {
            $searchTerm = '%' . $request->query('q') . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                  ->orWhere('code', 'like', $searchTerm);
            });
        }

        // 2. Database Filtering (CRUD - Read)
        if ($request->filled('credits')) {
            $query->where('credits', intval($request->query('credits')));
        }

        $courses = $query->with(['tasks.submissions' => function ($q) use ($user) {
            $q->where('user_id', $user->id);
        }])->get();

        // Map courses to add 'is_enrolled' boolean based on user association
        $userCourses = $user->courses->pluck('id')->toArray();
        $courses->each(function ($course) use ($userCourses) {
            $course->is_enrolled = in_array($course->id, $userCourses);
        });

        // API Controller Response: Return data formatted as JSON
        return response()->json([
            'success' => true,
            'courses' => $courses
        ]);
    }

    /**
     * Enroll in a course.
     * 
     * URL: POST /api/courses/{course}/enroll
     */
    public function enroll(Course $course)
    {
        $user = Auth::user();

        // Block direct enrollment if course has fee
        if ($course->enrollment_fee > 0) {
            return response()->json([
                'success' => false,
                'message' => 'This course requires an enrollment fee. Please complete checkout.'
            ], 403);
        }

        // CRUD - Create: Check if already enrolled, if not create relation
        if (!$user->courses()->where('course_id', $course->id)->exists()) {
            $user->courses()->attach($course->id);
            
            \App\Models\Activity::log('course_enrollment', "Enrolled in course: {$course->code} - {$course->title}");

            // Session: Store flash status messages in user session
            session()->flash('success', "Enrolled in course: {$course->title} successfully!");
            
            return response()->json([
                'success' => true,
                'message' => 'Successfully enrolled in course.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'You are already enrolled in this course.'
        ], 400);
    }

    /**
     * Unenroll from a course.
     * 
     * URL: POST /api/courses/{course}/unenroll
     */
    public function unenroll(Course $course)
    {
        $user = Auth::user();

        // CRUD - Delete: Remove user-course relation
        if ($user->courses()->where('course_id', $course->id)->exists()) {
            $user->courses()->detach($course->id);

            \App\Models\Activity::log('course_unenrollment', "Unenrolled from course: {$course->code} - {$course->title}");

            // Clean up related TaskSubmissions when unenrolled from course
            $taskIds = $course->tasks->pluck('id');
            TaskSubmission::where('user_id', $user->id)
                ->whereIn('task_id', $taskIds)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Successfully unenrolled from course.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'You are not enrolled in this course.'
        ], 400);
    }

    /**
     * Toggle a task completion status.
     * 
     * URL: POST /api/tasks/{task}/toggle
     */
    public function toggleTask(Task $task)
    {
        $user = Auth::user();

        // Verify if user is enrolled in the course that owns the task
        if (!$user->courses()->where('course_id', $task->course_id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be enrolled in the course to complete its tasks.'
            ], 403);
        }

        // CRUD - Create or Update: Find existing or create new task submission
        $submission = TaskSubmission::firstOrNew([
            'user_id' => $user->id,
            'task_id' => $task->id
        ]);

        $submission->is_completed = !$submission->is_completed;
        $submission->save();

        \App\Models\Activity::log('task_toggle', ($submission->is_completed ? "Marked task as completed" : "Marked task as pending") . ": {$task->title} in {$task->course->title}");

        return response()->json([
            'success' => true,
            'is_completed' => $submission->is_completed,
            'message' => $submission->is_completed ? 'Task marked as completed.' : 'Task marked as pending.'
        ]);
    }

    /**
     * Get user enrollment and task progress statistics.
     * 
     * URL: GET /api/user/stats
     */
    public function getStats()
    {
        $user = Auth::user();
        
        // Refresh relations to get updated data
        $user->load('courses.tasks.submissions');

        $activeCoursesCount = $user->courses->count();
        $totalCredits = $user->courses->sum('credits');

        // Retrieve all task IDs for the courses this user is enrolled in
        $enrolledCourseIds = $user->courses->pluck('id');
        $allTasks = Task::whereIn('course_id', $enrolledCourseIds)->get();
        $totalTasksCount = $allTasks->count();

        // Count completed tasks for these enrolled courses
        $completedTasksCount = TaskSubmission::where('user_id', $user->id)
            ->whereIn('task_id', $allTasks->pluck('id'))
            ->where('is_completed', true)
            ->count();

        $completionPercentage = $totalTasksCount > 0 
            ? round(($completedTasksCount / $totalTasksCount) * 100) 
            : 0;

        // Overall Grade computation logic based on percentage
        if ($totalTasksCount === 0) {
            $overallGrade = 'N/A';
        } elseif ($completionPercentage >= 90) {
            $overallGrade = 'A+';
        } elseif ($completionPercentage >= 80) {
            $overallGrade = 'A';
        } elseif ($completionPercentage >= 70) {
            $overallGrade = 'B';
        } elseif ($completionPercentage >= 60) {
            $overallGrade = 'C';
        } else {
            $overallGrade = 'D';
        }

        // Retrieve last active time from session (added by custom middleware)
        $lastActiveSession = session('last_activity', 'Just now');

        return response()->json([
            'success' => true,
            'stats' => [
                'active_courses' => $activeCoursesCount,
                'total_credits' => $totalCredits,
                'completed_tasks_count' => $completedTasksCount,
                'total_tasks_count' => $totalTasksCount,
                'completion_percentage' => $completionPercentage,
                'overall_grade' => $overallGrade,
                'last_activity_session' => $lastActiveSession
            ]
        ]);
    }

    /**
     * Show the course payment page.
     */
    public function showPaymentPage(Course $course)
    {
        $user = Auth::user();
        if ($user->courses()->where('course_id', $course->id)->exists()) {
            return redirect()->route('dashboard')->with('success', 'You are already enrolled in this course.');
        }

        return view('course.payment', compact('course'));
    }

    /**
     * Complete the course payment and enroll.
     */
    public function completePayment(Request $request, Course $course)
    {
        $request->validate([
            'payment_method' => 'required|string|in:bkash,nagad,card',
            'account_number' => 'required|string|max:50',
        ]);

        $user = Auth::user();

        if (!$user->courses()->where('course_id', $course->id)->exists()) {
            $user->courses()->attach($course->id);
            
            // Log Student notification
            $fee = $course->enrollment_fee;
            $method = ucfirst($request->payment_method);
            $account = $request->account_number;
            
            \App\Models\Activity::log(
                'course_enrollment', 
                "Enrolled in {$course->code} - {$course->title} after paying {$fee} Taka via {$method} (Acc: {$account}).",
                $user->id
            );

            // Log Teacher notification
            $teacherId = $course->instructor_id;
            if (!$teacherId) {
                $teacher = \App\Models\User::where('name', $course->instructor)->where('role', 'teacher')->first();
                $teacherId = $teacher ? $teacher->id : null;
            }

            if ($teacherId) {
                \App\Models\Activity::log(
                    'student_enrollment', 
                    "{$user->name} enrolled in {$course->code} - {$course->title} and paid {$fee} Taka via {$method} (Acc: {$account}).",
                    $teacherId
                );
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Payment and enrollment completed successfully!'
        ]);
    }

    /**
     * Show enrolled course workspace page with details, classes, notes, and Q&A.
     */
    public function showCourseDetails(Course $course)
    {
        $course->load([
            'lectures' => function ($query) {
                $query->orderBy('lecture_number', 'asc');
            },
            'notes.user',
            'questions.user',
            'questions.answers.user'
        ]);

        return view('course.show', compact('course'));
    }

    /**
     * Upload course notes PDF file.
     */
    public function uploadNote(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'note_file' => 'required|file|mimes:pdf|max:10240', // Max 10MB PDF
        ]);

        $user = Auth::user();
        $filePath = null;

        if ($request->hasFile('note_file')) {
            $file = $request->file('note_file');
            $filename = time() . '_' . $user->id . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '', $file->getClientOriginalName());
            
            $destPath = public_path('uploads/notes');
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }

            $file->move($destPath, $filename);
            $filePath = 'uploads/notes/' . $filename;
        }

        CourseNote::create([
            'course_id' => $course->id,
            'user_id' => $user->id,
            'title' => $request->title,
            'file_path' => $filePath,
        ]);

        Activity::log('note_upload', "Uploaded notes: {$request->title} in {$course->title}");

        return redirect()->back()->with('success', 'Notes uploaded and shared successfully!');
    }

    /**
     * Post a question in the course Q&A.
     */
    public function askQuestion(Request $request, Course $course)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Max 5MB
        ]);

        $user = Auth::user();
        $imagePath = null;

        if ($request->hasFile('question_image')) {
            $file = $request->file('question_image');
            $filename = time() . '_' . $user->id . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '', $file->getClientOriginalName());
            
            $destPath = public_path('uploads/qa');
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }

            $file->move($destPath, $filename);
            $imagePath = 'uploads/qa/' . $filename;
        }

        CourseQuestion::create([
            'course_id' => $course->id,
            'user_id' => $user->id,
            'question_text' => $request->question_text,
            'image_path' => $imagePath,
        ]);

        Activity::log('question_ask', "Asked a question in {$course->title}");

        return redirect()->back()->with('success', 'Question posted successfully!');
    }

    /**
     * Reply to a course Q&A question.
     */
    public function replyQuestion(Request $request, Course $course, CourseQuestion $question)
    {
        $request->validate([
            'answer_text' => 'required|string',
            'answer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Max 5MB
        ]);

        $user = Auth::user();
        $imagePath = null;

        if ($request->hasFile('answer_image')) {
            $file = $request->file('answer_image');
            $filename = time() . '_' . $user->id . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '', $file->getClientOriginalName());
            
            $destPath = public_path('uploads/qa');
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }

            $file->move($destPath, $filename);
            $imagePath = 'uploads/qa/' . $filename;
        }

        CourseAnswer::create([
            'course_question_id' => $question->id,
            'user_id' => $user->id,
            'answer_text' => $request->answer_text,
            'image_path' => $imagePath,
        ]);

        Activity::log('question_reply', "Replied to a question in {$course->title}");

        // Notify the question owner if a teacher replies
        if ($user->isTeacher() && $question->user_id !== $user->id) {
            Activity::log('notification', "Teacher replied to your question in {$course->title}", $question->user_id);
        }

        return redirect()->back()->with('success', 'Reply posted successfully!');
    }
}
