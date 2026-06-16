<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Task Model
 * 
 * Represents an assignment or assessment under a specific course.
 */
class Task extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'due_date',
        'points'
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    /**
     * Relationship: A task belongs to a course.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relationship: A task has many submissions (completions by students).
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(TaskSubmission::class);
    }
}
