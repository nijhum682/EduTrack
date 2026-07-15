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
        'rating',
        'comment',
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

    /**
     * Relationship: A note has many comments.
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseNoteComment::class, 'course_note_id')->orderBy('created_at', 'asc');
    }

    /**
     * Relationship: A note has many likes.
     */
    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseNoteLike::class, 'course_note_id');
    }

    /**
     * Helper to check if a note is liked by a given user.
     */
    public function isLikedBy($user): bool
    {
        if (!$user) {
            return false;
        }
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
