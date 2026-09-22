<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

use App\Models\quiz_categorie;
use App\Models\category_quize;
use App\Models\quiz_topic;
use App\Models\question;
use App\Models\option;
use App\Models\user;



class userController extends Controller
{


    public function userData(){
        $user = User::Auth();
        Session::put('user', $user);    
    }
    //index page
    public function index(){
        $categories = quiz_categorie::with('quizzes')->get(); 
        return view('welcome', compact('categories'));

    }

    //quizess category page
    public function quizes($type){
        return $type;
    }

}
