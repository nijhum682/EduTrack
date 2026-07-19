<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Task;
use App\Models\ScheduledClass;
use App\Models\TaskSubmission;

class CourseAuthorization
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $course = null;

        // 1. Resolve Course from Route Parameters
        if ($request->route('course')) {
            $course = $request->route('course');
            if (!($course instanceof Course)) {
                $course = Course::find($course);
            }
        } elseif ($request->route('task')) {
            $task = $request->route('task');
            if (!($task instanceof Task)) {
                $task = Task::find($task);
            }
            if ($task) {
                $course = $task->course;
            }
        } elseif ($request->route('class')) {
            $class = $request->route('class');
            if (!($class instanceof ScheduledClass)) {
                $class = ScheduledClass::find($class);
            }
            if ($class) {
                $course = $class->course;
            }
        } elseif ($request->route('submission')) {
            $submission = $request->route('submission');
            if (!($submission instanceof TaskSubmission)) {
                $submission = TaskSubmission::find($submission);
            }
            if ($submission && $submission->task) {
                $course = $submission->task->course;
            }
        }

        // 2. Resolve Course from Request Body / Input
        if (!$course && $request->has('course_id')) {
            $course = Course::find($request->input('course_id'));
        }

        // 3. Perform Authorization Check
        if ($course) {
            if ($user->isStudent()) {
                // Students must be enrolled (skip check for payment process routes so they can enroll)
                $isPaymentRoute = $request->routeIs('course.payment') || $request->routeIs('course.payment.complete');
                if (!$isPaymentRoute && !$user->courses()->where('course_id', $course->id)->exists()) {
                    if ($request->expectsJson()) {
                        return response()->json(['success' => false, 'message' => 'Unauthorized. You must be enrolled in this course.'], 403);
                    }
                    return redirect()->route('dashboard')->with('error', 'You are not enrolled in this course.');
                }
            } elseif ($user->isTeacher()) {
                // Teachers must own/teach the course
                $isOwner = ($course->instructor_id === $user->id) || ($course->instructor === $user->name);
                if (!$isOwner) {
                    if ($request->expectsJson()) {
                        return response()->json(['success' => false, 'message' => 'Unauthorized. You do not teach this course.'], 403);
                    }
                    return redirect()->route('teacher.dashboard')->with('error', 'You do not have permission to manage this course.');
                }
            }
        }

        return $next($request);
    }
}
