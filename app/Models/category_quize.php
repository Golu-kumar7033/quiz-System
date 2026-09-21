<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category_quize extends Model
{
    //
    protected $table = "category_quizes";


    public function quizzes()
    {
        return $this->hasMany(category_quize::class, 'category_id');
    }

    public function category()
    {
        return $this->belongsTo(category_quize::class, 'category_id');
    }

     public function topics()
    {
        return $this->hasMany(quiz_topic::class, 'quize_id', 'id');
    }

}
