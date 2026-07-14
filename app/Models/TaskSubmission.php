<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * TaskSubmission Model
 * 
 * Tracks the completion status of a task for a particular user.
 * Part of the Database CRUD functionality.
 */
class TaskSubmission extends Model
{
    protected $table = 'task_submissions';

    protected $fillable = [
        'user_id',
        'task_id',
        'is_completed',
        'score',
        'feedback',
        'graded_at',
        'answers',
        'uploaded_file'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'answers' => 'array',
    ];

    /**
     * Relationship: A submission belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A submission belongs to a task.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Calculate auto-graded MCQ scores, apply negative marking deductions,
     * and combine with any manual grades for non-MCQ questions.
     */
    public static function calculateScoreAndDetails($submission, $questionScores = null)
    {
        $task = $submission->task;
        $questions = $task->questions;
        $answers = $submission->answers ?: [];

        if ($questionScores === null) {
            $questionScores = $answers['question_grades'] ?? [];
        }

        $mcqCorrect = 0;
        $mcqWrong = 0;
        $mcqScore = 0;

        foreach ($questions as $question) {
            $qId = (string)$question->id;
            if ($question->type === 'mcq') {
                $studentAnswer = $answers[$qId] ?? null;
                $isCorrect = ($studentAnswer !== null && strtolower(trim($studentAnswer)) === strtolower(trim($question->correct_answer)));

                if ($isCorrect) {
                    $mcqScore += $question->points;
                    $questionScores[$qId] = $question->points;
                    $mcqCorrect++;
                } else {
                    $questionScores[$qId] = 0;
                    if ($studentAnswer !== null && trim($studentAnswer) !== '') {
                        $mcqWrong++;
                    }
                }
            } else {
                // For non-MCQ questions, preserve existing score or default to 0 if not graded
                if (!isset($questionScores[$qId])) {
                    $questionScores[$qId] = 0;
                }
            }
        }

        // Apply negative marking to MCQ score
        $deduction = 0.00;
        if ($task->mcq_negative_marking) {
            if ($task->mcq_negative_marking_mode === 'per_wrong') {
                $deduction = $mcqWrong * (float)$task->mcq_negative_marking_value;
            } elseif ($task->mcq_negative_marking_mode === 'threshold' && $task->mcq_negative_marking_threshold_count > 0) {
                $deduction = floor($mcqWrong / $task->mcq_negative_marking_threshold_count) * (float)$task->mcq_negative_marking_value;
            }
        }

        $finalMcqScore = max(0.00, $mcqScore - $deduction);

        // Sum up non-MCQ question scores
        $manualScore = 0;
        foreach ($questions as $question) {
            if ($question->type !== 'mcq') {
                $manualScore += (int)($questionScores[$question->id] ?? 0);
            }
        }

        $totalScore = $finalMcqScore + $manualScore;

        return [
            'total_score' => $totalScore,
            'question_grades' => $questionScores,
            'mcq_details' => [
                'correct' => $mcqCorrect,
                'wrong' => $mcqWrong,
                'deduction' => $deduction,
            ]
        ];
    }
}
