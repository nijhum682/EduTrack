<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lecture extends Model
{
    protected $fillable = [
        'course_id',
        'lecture_number',
        'name',
        'details',
        'video_path',
        'runtime',
    ];

    /**
     * Relationship: A lecture belongs to a course.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relationship: A lecture has many comments.
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureComment::class)->orderBy('created_at', 'asc');
    }

    /**
     * Relationship: A lecture has many root comments (where parent_id is null).
     */
    public function rootComments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureComment::class)->whereNull('parent_id')->orderBy('created_at', 'asc');
    }

    /**
     * Relationship: A lecture has many likes.
     */
    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureLike::class);
    }

    /**
     * Helper to check if a lecture is liked by a given user.
     */
    public function isLikedBy($user): bool
    {
        if (!$user) {
            return false;
        }
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
