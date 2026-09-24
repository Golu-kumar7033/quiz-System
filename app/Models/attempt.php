<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class attempt extends Model
{
    //
 protected $fillable = [
        'user_id',
        'topic_id',
        'status',
    ];

    public function topic()
    {
        return $this->belongsTo(quiz_topic::class, 'topic_id');
    }

    public function userAnswers()
    {
        return $this->hasMany(user_answer::class, 'attempt_id');
    }
}
