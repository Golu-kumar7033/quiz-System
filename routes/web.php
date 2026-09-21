<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('/',[AdminController::class,'index'])->name('dashbord');


    Route::get('quiz-category',[AdminController::class,'category'])->name('category');
    //create category
    Route::post('create-category',[AdminController::class,'createCategory'])->name('create-category');

    //single delete route for all
    Route::get('delete/{type}/{id}', [AdminController::class, 'delete'])
    ->name('delete');

    //category quizes 
    Route::get('category-quizes/{type}', [AdminController::class, 'categoryQuiz'])
    ->name('category-quiz');

    //create quiz
    Route::post('create-quiz',[AdminController::class,'createQuize'])->name('create-quiz');

    //quiz topics
    Route::get('quiz-topics/{type}', [AdminController::class, 'quizTopics'])
    ->name('quiz-topics');
    //create quiz topic
    Route::post('create-topic',[AdminController::class,'createTopic'])->name('create-topic');
    //questions
     Route::get('question-bank/{type}', [AdminController::class, 'Question'])
    ->name('question-bank');

    //create question
    Route::post('create-question',[AdminController::class,'createQuestion'])->name('create-question');
    //Edit question
    Route::post('edit-question',[AdminController::class,'editQuestion'])->name('edit-question');
 
    //question details
    Route::get('question', [AdminController::class, 'viewQuestion'])
    ->name('question');



});