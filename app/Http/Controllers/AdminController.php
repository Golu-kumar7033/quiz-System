<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\Models\quiz_categorie;
use App\Models\category_quize;
use App\Models\quiz_topic;
use App\Models\question;
use App\Models\option;
use App\Models\User;





class AdminController extends Controller
{
    //
    
    
    public function index(){
        
        $navdata = quiz_categorie::with('quizzes')->get(); 

        return view('admin.dashbord',compact('navdata'));
    }

    public function category(){
        $navdata = quiz_categorie::with('quizzes')->get(); 
        $data= quiz_categorie::simplePaginate(10);
        return view('admin.quiz_category',compact('data','navdata'));
    }

    //create category

    function createCategory(Request $request ){

     $request->validate([
            'category' => 'required|min:3',
        ]);

        $category= new quiz_categorie();
        $category->Title=$request->category;
        $category->slug= Str::slug($request->category);
        if($category->save()){
            return redirect()->back()->with('success', 'Category saved successfully!');
        }else{
            return redirect()->back()->with('success', 'Somthing wrong!');
        }

    }

/*==========================================================================================*/  
  //delete controller function for all
    public function delete(Request $request,$type, $id){
        try{

            //mapping between type names and models
            $models=[
                'category'=>quiz_categorie::class,     
                'quize'=>category_quize::class,
                'topic'=>quiz_topic::class,
                'question'=>question::class,
                'user'=>User::class,

            ];
            //check which item type id deleted if exits in models
            if(!isset($models[$type])){
                abort(404);
            }

            $model=$models[$type];
            $item=$model::findOrFail($id);
            $item->delete();
            return redirect()->back()->with('success', ucfirst($type) . ' item deleted successfully.');

        }catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }


    }
/*======================================================================================================*/
    //search function for all



    /**======================================================================================================= */
   //category quizes
  
    public function categoryQuiz($type)
    {
    $category =quiz_categorie::where('slug', $type)->firstOrFail();
    $navdata = quiz_categorie::with('quizzes')->get(); 

    $quizzes =category_quize::where('category_id', $category->id)->simplePaginate(10);

    return view('admin.category_Quize', compact('category', 'quizzes','navdata'));
    }

    function createQuize(Request $request){

        $request->validate([
            'category' => 'required',
            'quiz'=>'required|min:3',
        ]);

       $quiz= new category_quize();
        $quiz->category_id=$request->category;
        $quiz->title=$request->quiz;
        $quiz->slug= Str::slug($request->quiz);
        if($quiz->save()){
            return redirect()->back()->with('success', 'quiz saved successfully!');
        }else{
            return redirect()->back()->with('success', 'Somthing wrong!');
        } 
        
    }

    //quiz topics
    public function quizTopics( $type){

        $quiz=category_quize::where('slug', $type)->firstOrFail();
        $navdata = quiz_categorie::with('quizzes')->get(); 

        $topic =quiz_topic::where('quize_id', $quiz->id)->simplePaginate(10);

        return view('admin.quiz-topics',compact('quiz','topic','navdata'));

    }

    //create topic
    function createTopic(Request $request){

        $request->validate([
            'quiz' => 'required',
            'topic'=>'required|min:3'
        ]);

       $topic= new quiz_topic();
        $topic->quize_id=$request->quiz;
        $topic->Topic=$request->topic;
        $topic->slug= Str::slug($request->topic);
        if($topic->save()){
            return redirect()->back()->with('success', 'quiz saved successfully!');
        }else{
            return redirect()->back()->with('success', 'Somthing wrong!');
        } 
        
    }

    //question bank

    public function Question($slug)
    {
        $categories = category_quize::with('topics:id,quize_id,Topic,slug')->get(['id', 'title']);
        $navdata= quiz_categorie::with('quizzes')->get(); 
        $topic = \App\Models\quiz_topic::where('slug', $slug)->firstOrFail();

        $question = question::with(['options' => function($query){
            $query->select('question_id','options','is_correct','why_is_correct');
        }])->where('topic_id', $topic->id)->simplePaginate(10);


        return view('admin.question_bank', compact('categories','question','topic','navdata'));
    }



    //create questions

    public function createQuestion(Request $request){


        $request->validate([
            'question' => 'required',
            'quiz' => 'required',
            'topic' => 'required',
            'qtype' => 'required',
            'is_correct' => 'required',
        ]);

          DB::transaction(function () use ($request) {

            $question = Question::create([
                'quize_id' => $request->quiz,
                'topic_id' => $request->topic,
                'question' => $request->question,
                'question_type' => $request->qtype,
            ]);
           
            if ($request->qtype == 'mcq') {

                $options = [
                    'A' => $request->option_a,
                    'B' => $request->option_b,
                    'C' => $request->option_c,
                    'D' => $request->option_d,
                ];

                foreach ($options as $key => $value) {

                    Option::create([
                        'question_id' => $question->id,
                        'options' => $value,
                        'is_correct' => ($request->is_correct == $key) ? 1 : 0,
                        'why_is_correct'=>$request->whyis,
                    ]);

                }

            } else {

                Option::create([
                    'question_id' => $question->id,
                    'options' => 'True',
                    'is_correct' => ($request->is_correct == 'True') ? 1 : 0,
                ]);

                Option::create([
                    'question_id' => $question->id,
                    'options' => 'False',
                    'is_correct' => ($request->is_correct == 'False') ? 0 : 1,
                ]);
            }

        });

        return back()->with('success', 'Question added successfully.');
  

    
    }

//question details
    public function viewQuestion(Request $request)
    {
        $question = question::with('options')->findOrFail($request->id);

        return response()->json([
            'question_id' => $question->id,
            'question' => $question->question,
            'question_type' => $question->question_type,

            'options' => $question->options->map(function ($option) {
                return [
                    'option' => $option->options,
                    'is_correct' => $option->is_correct,
                ];
            }),
        ]);
    }

    //edit question
   public function editQuestion(Request $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $question = Question::findOrFail($request->question_id);

                // Update question
                $question->update([
                    'question' => $request->question,
                ]);

                // MCQ
                if ($request->question_type == 'mcq') {

                    $options = [
                        'A' => $request->option_A,
                        'B' => $request->option_B,
                        'C' => $request->option_C,
                        'D' => $request->option_D,
                    ];

                    foreach ($options as $key => $value) {

                        $option = Option::where('question_id', $question->id)
                            ->where('options', $key)
                            ->first();

                        if ($option) {
                            $option->update([
                                'options' => $value,
                                'is_correct' => ($request->is_correct == $key) ? 1 : 0,
                                'why_is_correct' => $request->whyis,
                            ]);
                        }
                    }

                } else {

                    // True option
                    $trueOption = Option::where('question_id', $question->id)
                        ->where('options', 'True')
                        ->first();

                    if ($trueOption) {
                        $trueOption->update([
                            'is_correct' => ($request->is_correct == 'True') ? 1 : 0,
                            'why_is_correct' => $request->whyis,
                        ]);
                    }

                    // False option
                    $falseOption = Option::where('question_id', $question->id)
                        ->where('options', 'False')
                        ->first();

                    if ($falseOption) {
                        $falseOption->update([
                            'is_correct' => ($request->is_correct == 'False') ? 1 : 0,
                            'why_is_correct' => $request->whyis,
                        ]);
                    }
                }
            });

            return back()->with('success', 'Question Updated successfully.');

        } catch (\Throwable $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }


    //manageusers
    function Users(Request $request){
        $navdata = quiz_categorie::with('quizzes')->get(); 

        $users=User::simplePaginate(10);
        return view('admin.user',compact('navdata','users'));


    }


    
}