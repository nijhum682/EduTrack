<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentExamController extends Controller
{
    /**
     * Start the exam arena.
     */
    public function startExam(Task $task)
    {
        $user = Auth::user();

        // 1. Verify student is enrolled in the course
        if (!$user->courses()->where('course_id', $task->course_id)->exists()) {
            return redirect()->route('dashboard')->with('error', 'You must be enrolled in the course to take this test.');
        }

        // 2. Verify if they already completed it
        $submission = TaskSubmission::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->first();

        if ($submission && $submission->is_completed) {
            return redirect()->route('dashboard')->with('error', 'You have already completed this test.');
        }

        // Log starting of exam if not logged yet
        if (!$submission) {
            $submission = TaskSubmission::create([
                'user_id' => $user->id,
                'task_id' => $task->id,
                'is_completed' => false,
                'answers' => [],
            ]);
        }

        // Load course and questions early so they're available in all branches
        $task->load(['course', 'questions']);

        // Calculate remaining seconds
        $durationSeconds = ($task->duration_minutes ?: 60) * 60;
        $elapsedSeconds = now()->diffInSeconds($submission->created_at);
        $remainingSeconds = $durationSeconds - $elapsedSeconds;

        if ($remainingSeconds <= 0) {
            $submission->is_completed = true;
            $submission->save();

            // Auto-grade MCQ questions
            $submission->load(['task.questions']);
            $result = TaskSubmission::calculateScoreAndDetails($submission);
            
            $answers = $submission->answers ?: [];
            $answers['question_grades'] = $result['question_grades'];
            $answers['mcq_details'] = $result['mcq_details'];

            $submission->update([
                'score' => $result['total_score'],
                'answers' => $answers,
            ]);

            \App\Models\Activity::log('exam_submission', "Submitted test (auto-submitted): {$task->title} for {$task->course->title}");

            return redirect()->route('dashboard')->with('error', 'Time is up! Your exam paper has been auto-submitted.');
        }

        return view('student.arena', compact('task', 'user', 'remainingSeconds'));
    }

    /**
     * Submit exam answers.
     */
    public function submitExam(Request $request, Task $task)
    {
        $user = Auth::user();

        // Verify enrollment
        if (!$user->courses()->where('course_id', $task->course_id)->exists()) {
            return redirect()->route('dashboard')->with('error', 'You must be enrolled in the course to take this test.');
        }

        $submission = TaskSubmission::firstOrCreate(
            ['user_id' => $user->id, 'task_id' => $task->id],
            ['is_completed' => false, 'answers' => []]
        );

        if ($submission->is_completed) {
            return redirect()->route('dashboard')->with('error', 'You have already submitted this test.');
        }

        // Check if time has expired with a 15-second grace period
        $durationSeconds = ($task->duration_minutes ?: 60) * 60;
        $elapsedSeconds = now()->diffInSeconds($submission->created_at);
        $isLate = $elapsedSeconds > ($durationSeconds + 15);

        // Handle khata image file upload
        $filePath = null;
        if ($request->hasFile('khata_file')) {
            $file = $request->file('khata_file');
            $filename = time() . '_' . $user->id . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '', $file->getClientOriginalName());
            
            // Create uploads directory if it doesn't exist
            $destPath = public_path('uploads/submissions');
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }

            $file->move($destPath, $filename);
            $filePath = 'uploads/submissions/' . $filename;
        }

        $submission->is_completed = true;
        $submission->answers = $request->input('answers', []);
        if ($filePath) {
            $submission->uploaded_file = $filePath;
        }
        $submission->save();

        // Auto-grade MCQ questions
        $submission->load(['task.questions']);
        $result = TaskSubmission::calculateScoreAndDetails($submission);
        
        $answers = $submission->answers ?: [];
        $answers['question_grades'] = $result['question_grades'];
        $answers['mcq_details'] = $result['mcq_details'];

        $submission->update([
            'score' => $result['total_score'],
            'answers' => $answers,
        ]);

        \App\Models\Activity::log('exam_submission', "Submitted test" . ($isLate ? " (auto-submitted)" : "") . ": {$task->title} for {$task->course->title}");

        if ($isLate) {
            return redirect()->route('dashboard')->with('error', 'Time is up! Your exam paper has been auto-submitted.');
        }

        return redirect()->route('dashboard')->with('success', 'Test submitted successfully!');
    }
}
