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
        'is_completed'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
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
}
