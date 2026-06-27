<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseQuestion extends Model
{
    protected $fillable = [
        'course_id',
        'user_id',
        'question_text',
        'image_path',
    ];

    /**
     * Relationship: A question belongs to a course.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relationship: A question belongs to a user (student who asked).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A question has many answers/replies.
     */
    public function answers(): HasMany
    {
        return $this->hasMany(CourseAnswer::class);
    }
}
