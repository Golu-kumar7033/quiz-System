<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quiz_categorie extends Model
{
    //
      protected $table = "quiz_categories";

      protected $fillable = [
        'category_id',
        'title',
        'slug',
    ];




  public function quizzes()
    {
        return $this->hasMany(category_quize::class, 'category_id', 'id');
    }

    public function topic()
    {
        return $this->hasMany(quiz_categorie::class, 'quize_id');

    }


    

    
      
     

}
