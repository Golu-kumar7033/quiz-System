<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\authController;
use App\Http\Controllers\userController;




/**login signin */
    Route::get('/login',[authController::class,'login'])->name('login');
    Route::get('/sign-up',[authController::class,'signin'])->name('signUP');
    Route::post('/user-signUp',[authController::class,'signUp'])->name('user-signUp');
    Route::post('/sign-In',[authController::class,'user_signIn'])->name('sign-In');
    Route::get('/logout',[authController::class,'logout'])->name('logout');

    Route::get('/varifyUser/{email}',[authController::class,'varifyUser'])->name('varifyUser');

    //search
    Route::get('search', [UserController::class, 'Search'])
    ->name('search');

/**========================================================================================== */
/**user rotes */
/*user home page*/
Route::get('/',[userController::class,'index'])->name('home');

Route::middleware('auth','role:user')->prefix('quiz')->name('quiz.')->group(function(){

    Route::get('/{type}', [UserController::class, 'quizes'])
        ->name('topic_quiz');

    Route::Post('quiz-submit', [UserController::class, 'quizsubmit'])
    ->name('quiz-submit');
//user attempt history
    Route::get('review/{attempt}/{topic}', [UserController::class, 'review'])
    ->name('review');



});

Route::middleware('auth','role:user')->prefix('user')->name('user.')->group(function(){

    Route::get('/profile', [UserController::class, 'userData'])
        ->name('profile');

    Route::Post('quiz-submit', [UserController::class, 'quizsubmit'])
    ->name('quiz-submit');
    //change password
    Route::post('/change-password',[authController::class,'passwordUpdate'])->name('change-password');


});



/**========================================================================================== */
/**admin rotes */

Route::middleware('auth','role:admin')->prefix('admin')->name('admin.')->group(function(){

    Route::get('/',[AdminController::class,'index'])->name('dashboard');


    Route::get('quiz-category',[AdminController::class,'category'])->name('category');
//user manegement page
    Route::get('users',[AdminController::class,'Users'])->name('users');

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

     //change password
    Route::post('/change-password',[authController::class,'passwordUpdate'])->name('change-password');

    //user activity Logs
    Route::get('user-activity',[AdminController::class,'Activity'])->name('user-activity');



});