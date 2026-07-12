<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScheduledClassComment extends Model
{
    protected $fillable = [
        'scheduled_class_id',
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
     * Relationship: A comment belongs to a scheduled class.
     */
    public function scheduledClass(): BelongsTo
    {
        return $this->belongsTo(ScheduledClass::class, 'scheduled_class_id');
    }

    /**
     * Relationship: A comment can have a parent comment (if it is a reply).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(ScheduledClassComment::class, 'parent_id');
    }

    /**
     * Relationship: A comment has many replies.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(ScheduledClassComment::class, 'parent_id')->orderBy('created_at', 'asc');
    }
}
