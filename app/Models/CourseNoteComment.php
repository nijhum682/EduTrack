<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseNoteComment extends Model
{
    protected $fillable = [
        'course_note_id',
        'user_id',
        'comment_text'
    ];

    /**
     * Relationship: A comment belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A comment belongs to a course note.
     */
    public function note(): BelongsTo
    {
        return $this->belongsTo(CourseNote::class, 'course_note_id');
    }
}
