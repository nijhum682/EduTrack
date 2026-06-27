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
        'instructor_id',
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

    /**
     * Relationship: A course belongs to an instructor (User).
     */
    public function instructorUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    /**
     * Relationship: A course has many scheduled classes.
     */
    public function scheduledClasses(): HasMany
    {
        return $this->hasMany(ScheduledClass::class);
    }

    /**
     * Relationship: A course has many lectures.
     */
    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class);
    }

    /**
     * Relationship: A course has many shared notes.
     */
    public function notes(): HasMany
    {
        return $this->hasMany(CourseNote::class);
    }

    /**
     * Relationship: A course has many Q&A questions.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(CourseQuestion::class);
    }
}

