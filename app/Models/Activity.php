<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['user_id', 'type', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Log an activity for the currently authenticated user (or specified user).
     */
    public static function log($type, $description, $userId = null)
    {
        return self::create([
            'user_id' => $userId ?: auth()->id(),
            'type' => $type,
            'description' => $description,
        ]);
    }
}
