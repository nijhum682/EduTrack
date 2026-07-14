<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskQuestion extends Model
{
    protected $table = 'task_questions';

    protected $fillable = [
        'task_id',
        'question_text',
        'type',
        'options',
        'points',
        'correct_answer',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    /**
     * Relationship: A question belongs to a task/test.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
