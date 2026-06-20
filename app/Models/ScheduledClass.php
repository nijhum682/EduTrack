<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduledClass extends Model
{
    protected $table = 'scheduled_classes';

    protected $fillable = [
        'course_id',
        'title',
        'scheduled_at',
        'duration_minutes',
        'platform',
        'meeting_link',
        'is_active',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Relationship: A class belongs to a course.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
