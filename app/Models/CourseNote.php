<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseNote extends Model
{
    protected $fillable = [
        'course_id',
        'user_id',
        'title',
        'file_path',
    ];

    /**
     * Relationship: A note belongs to a course.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relationship: A note belongs to a user (student who shared it).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
