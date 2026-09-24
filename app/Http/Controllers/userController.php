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
use App\Models\attempt;
use App\Models\user_answer;





class userController extends Controller
{


    public function userData(){
        $user = Auth::user();
        $id=Auth::user()->id;
        Session::put('user', $user);

        $attempts = Attempt::with('topic')
        ->where('user_id',$id)
        ->orderByDesc('created_at')
        ->get();

        $score=user_answer::where('user_id',$id)->select('score')->where('score', 1)->count();
        return view('user_data',compact('user','attempts','score'));
  
    }
    //index page
    public function index(){
        $categories = quiz_categorie::with('quizzes')->get(); 
        return view('welcome', compact('categories'));

    }

    //quizess category page
    public function quizes($type){
        $quizMcq =quiz_topic::with([ 'questions.options'])
        ->where('slug', $type)->firstOrFail();
        $topic_id=$quizMcq->id;
        $user = Auth::user()->id;
        $topic=session::put('Quiztopic',$quizMcq);

        /*user attempt on topic*/
        attempt::create([
            'user_id'=>$user,
            'topic_id'=>$topic_id,

        ]);
        $currentAttempt = attempt::where('user_id', $user)->latest('id')->first();
        Session::put('attempt',$currentAttempt);
               

       return view('topic_quiz',compact('quizMcq','currentAttempt'));

    }

    /**quiz submit */

    function quizsubmit(Request $request){

        $attempt= Session::get('attempt');
            if ($attempt) {
                $attemptId = $attempt->id;
            }
       

      try {
            $attemptId = $attemptId ;
            $userId    = Auth::id(); 

            $allInputs = $request->all();//request all data
             $totalScore = 0; 

             foreach ($allInputs as $key => $value) {//q id 
                if (strpos($key, 'question_') === 0) {
                    $questionId = str_replace('question_', '', $key); 
                    $selectedOptionId = $value;

                     $isCorrect = DB::table('options')
                    ->where('id', $selectedOptionId)
                    ->where('is_correct', 1)
                    ->exists();

                    $scoreForThisQuestion = $isCorrect ? 1 : 0;
                    
                    $totalScore += $scoreForThisQuestion; 
//databse
                    $submit = new user_answer();
                    $submit->attempt_id = $attemptId;
                    $submit->user_id    = $userId;
                    $submit->question_id  = $questionId;
                    $submit->select_ans = $selectedOptionId; 
                    $submit->score   = $scoreForThisQuestion; 
                    $submit->save();

                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Quiz submitted successfully!',
                'score'=>$totalScore,
            ], 200);

        } catch (\Exception $e) {
            // database error
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }


        return response()->json([
            'success' => true,
            'message' => 'quize submited',
        ], 200);

    }


    //user profils and quiz history
    public function review($attempt,$topic){

        $quizAtquestion=quiz_topic::with([ 'questions.options'])
        ->where('Topic', $topic)->firstOrFail();
        $userAns=user_answer::where('attempt_id',$attempt)->get();
        return view('history',compact('quizAtquestion','attempt','userAns'));
    }

    public function quizSearch($serach){//search topic quiz

    }



}

