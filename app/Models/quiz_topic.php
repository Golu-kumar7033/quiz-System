<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quiz_topic extends Model
{
    //
    protected $table = "quiz_topics";

      protected $fillable = [
        'quize_id',
        'Topic',
        'slug',
    ];

    public function quizes(){
        return $this->belongsTo(quiz_topic::class, 'quize_id');
    }

    public function category()
    {
        return $this->belongsTo(category_quize::class, 'quize_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(question::class,'topic_id');
    }
    public function attempts()
    {
        return $this->hasMany(attempt::class, 'topic_id');
    }
}
