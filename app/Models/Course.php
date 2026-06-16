<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Course Model
 * 
 * Represents an academic course. Tracks the title, code, instructor, credits,
 * and maintains relationships with enrolled users and course tasks.
 */
class Course extends Model
{
    protected $fillable = [
        'title',
        'code',
        'description',
        'instructor',
        'credits'
    ];

    /**
     * Relationship: A course has many tasks (assignments).
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Relationship: A course belongs to many users (enrolled students).
     * This represents the CRUD pivot relationship using the 'enrollments' table.
     */
    public function enrolledUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments')
                    ->withTimestamps();
    }
}
