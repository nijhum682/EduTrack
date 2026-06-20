<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\ScheduledClass;
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
        $tasks = Task::whereIn('course_id', $courseIds)->with('course')->get();

        // 3. Get student submissions for these tasks
        $submissions = TaskSubmission::whereIn('task_id', $tasks->pluck('id'))
            ->with(['user', 'task.course'])
            ->orderBy('is_completed', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // 4. Get scheduled classes
        $scheduledClasses = ScheduledClass::whereIn('course_id', $courseIds)
            ->with('course')
            ->orderBy('scheduled_at', 'asc')
            ->get();

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
            'credits' => 'required|integer|min:1|max:6',
            'description' => 'nullable|string',
        ]);

        Course::create([
            'title' => $request->title,
            'code' => strtoupper($request->code),
            'credits' => $request->credits,
            'description' => $request->description,
            'instructor' => Auth::user()->name,
            'instructor_id' => Auth::id(),
        ]);

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
            'points' => 'required|integer|min:1',
        ]);

        // Verify the teacher owns the course or claim it
        $course = Course::findOrFail($request->course_id);
        if ($course->instructor_id !== Auth::id()) {
            $course->update(['instructor_id' => Auth::id(), 'instructor' => Auth::user()->name]);
        }

        Task::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'points' => $request->points,
        ]);

        return redirect()->back()->with('success', 'Task/Question created successfully!');
    }

    /**
     * Evaluate a student submission.
     */
    public function evaluateSubmission(Request $request, TaskSubmission $submission)
    {
        $request->validate([
            'score' => 'required|integer|min:0',
            'feedback' => 'nullable|string',
        ]);

        $submission->update([
            'score' => $request->score,
            'feedback' => $request->feedback,
            'graded_at' => now(),
        ]);

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

        ScheduledClass::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'scheduled_at' => $request->scheduled_at,
            'duration_minutes' => $request->duration_minutes,
            'platform' => $request->platform,
            'meeting_link' => $request->meeting_link,
            'is_active' => false,
        ]);

        return redirect()->back()->with('success', 'Class session scheduled successfully!');
    }

    /**
     * Start/Toggle a class active state.
     */
    public function toggleClassActive(Request $request, ScheduledClass $class)
    {
        $class->update([
            'is_active' => !$class->is_active
        ]);

        $status = $class->is_active ? 'started' : 'ended';

        return redirect()->back()->with('success', "Class session has been {$status}!");
    }

    /**
     * Live Virtual Classroom simulation.
     */
    public function classroom(ScheduledClass $class)
    {
        $class->load('course');
        $user = Auth::user();

        // Check if class is active or the teacher is launching it
        if (!$class->is_active && $user->isStudent()) {
            return redirect()->route('dashboard')->with('error', 'This class is not currently active.');
        }

        // If the teacher joins and the class is not active, activate it!
        if ($user->isTeacher() && !$class->is_active) {
            $class->update(['is_active' => true]);
        }

        return view('teacher.classroom', compact('class', 'user'));
    }
}
