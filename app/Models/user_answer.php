<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_answer extends Model
{
    //
        protected $fillable = ['attempt_id','user_id', 'question_id','score','select_ans','is_correct'];

}
