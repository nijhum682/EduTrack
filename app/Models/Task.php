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
        'points',
        'is_test',
        'duration_minutes',
        'mcq_negative_marking',
        'mcq_negative_marking_mode',
        'mcq_negative_marking_value',
        'mcq_negative_marking_threshold_count'
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'mcq_negative_marking' => 'boolean',
        'mcq_negative_marking_value' => 'float',
        'mcq_negative_marking_threshold_count' => 'integer'
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

    /**
     * Relationship: A test has many questions.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(TaskQuestion::class);
    }
}
