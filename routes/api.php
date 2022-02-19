<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\VideoCourseController;
use App\Http\Controllers\VideoCommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//routes for messages
Route::get('/message',[MessageController::class,'index']);
Route::post('/addMessage',[MessageController::class,'add']);  
Route::put('/updateMessage/{id}',[MessageController::class,'update']);  
Route::delete('/deleteMessage/{id}',[MessageController::class,'delete']);  

//routes of users
Route::get('/user',[UserController::class,'index']);
Route::post('/register',[UserController::class,'add']);  
Route::post('/login',[UserController::class,'login']);  
Route::put('/updateUser/{id}',[UserController::class,'update']);  
Route::delete('/deleteUser/{id}',[UserController::class,'delete']);  
Route::put('/disableUser/{id}',[UserController::class,'disable']);  
Route::put('/enableUser/{id}',[UserController::class,'enable']);  

//routes for messages
Route::get('/class',[ClasseController::class,'index']);
Route::post('/addClass',[ClasseController::class,'add']);  
Route::put('/updateClass/{id}',[ClasseController::class,'update']);  
Route::delete('/deleteClass/{id}',[ClasseController::class,'delete']);

//routes for subjects
Route::get('/subject',[SubjectController::class,'index']);
Route::post('/addSubject',[SubjectController::class,'add']);
Route::put('/updateSubject/{id}',[SubjectController::class,'update']);  
Route::delete('/deleteSubject/{id}',[SubjectController::class,'delete']);

//routes for course
Route::get('/course/{name?}',[CourseController::class,'index']);
Route::get('/getOneCourse/{id}',[CourseController::class,'getOneCourse']);
Route::post('/addCourse',[CourseController::class,'add']);  
Route::put('/updateCourse/{id}',[CourseController::class,'update']);  
Route::put('/updateCourseViews/{id}',[CourseController::class,'updateCourseViews']);  
Route::delete('/deleteCourse/{id}',[CourseController::class,'delete']);


//routes to add a resume 
Route::get('/resume/{id?}',[ResumeController::class,'index']);
Route::post('/addResume',[ResumeController::class,'add']);  
Route::put('/updateResume/{id}',[ResumeController::class,'update']);  
Route::delete('/deleteResume/{id}',[ResumeController::class,'delete']);

//routes for subjects
Route::get('/quiz/{id?}',[QuizController::class,'index']);
Route::post('/addQuiz',[QuizController::class,'add']);  
Route::put('/updateQuiz/{id}',[QuizController::class,'update']);  
Route::delete('/deleteQuiz/{id}',[QuizController::class,'delete']);

//routes for videocourse
Route::get('/videoCourse/{id?}',[VideoCourseController::class,'index']);
Route::post('/addVideoCourse',[VideoCourseController::class,'add']);
// Route::put('/updateQuiz/{id}',[QuizController::class,'update']);  
// Route::delete('/deleteQuiz/{id}',[QuizController::class,'delete']);

//routes for video comment
Route::get('/comment/{id?}',[VideoCommentController::class,'index']);
Route::post('/addComment',[VideoCommentController::class,'add']);  
Route::put('/updateComment/{id}',[VideoCommentController::class,'update']);  
Route::delete('/deleteComment/{id}',[VideoCommentController::class,'delete']);
