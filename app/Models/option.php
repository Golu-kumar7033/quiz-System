<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class option extends Model
{
    //
    protected $table = "options";

  protected $fillable = [
    'question_id',
    'options',
    'is_correct',
    'why_is_correct',
];


    
public function question()
{
    return $this->belongsTo(question::class);
}
}
