<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LectureComment extends Model
{
    protected $fillable = [
        'lecture_id',
        'user_id',
        'comment_text',
        'parent_id'
    ];

    /**
     * Relationship: A comment belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A comment belongs to a lecture.
     */
    public function lecture(): BelongsTo
    {
        return $this->belongsTo(Lecture::class);
    }

    /**
     * Relationship: A comment can have a parent comment (reply).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(LectureComment::class, 'parent_id');
    }

    /**
     * Relationship: A comment has many replies.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(LectureComment::class, 'parent_id')->orderBy('created_at', 'asc');
    }
}
