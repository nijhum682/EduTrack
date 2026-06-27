<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseAnswer extends Model
{
    protected $fillable = [
        'course_question_id',
        'user_id',
        'answer_text',
        'image_path',
    ];

    /**
     * Relationship: An answer belongs to a question.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(CourseQuestion::class, 'course_question_id');
    }

    /**
     * Relationship: An answer belongs to a user (teacher/instructor who replied).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
