<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    //
    protected $table = "questions";

    protected $fillable = [
    'quize_id',
    'topic_id',
    'question',
    'question_type',
 
];



    
public function options()
{
    return $this->hasMany(Option::class);
}
public function topic()
{
    return $this->belongsTo(quiz_topic::class,'topic_id');
}
}
