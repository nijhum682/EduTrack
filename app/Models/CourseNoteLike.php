<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseNoteLike extends Model
{
    protected $fillable = [
        'course_note_id',
        'user_id',
    ];

    public function note(): BelongsTo
    {
        return $this->belongsTo(CourseNote::class, 'course_note_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
