<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\VideoCourseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    
});

Route::get('/token', function () {
    return csrf_token(); 
});

Route::get('/videoCourse',[VideoCourseController::class,'index']);

// Route::resource('message',MessageController::class);

//Routes to manage users
// Route::get('/message',[MessageController::class,'index'])->name('message');
// Route::post('/addMessage',[MessageController::class,'index'])->name('message.add');
// Route::put('/updateMessage/{id}',[MessageController::class,'index'])->name('message.update');
// Route::delete('/deleteMessage/{id}',[MessageController::class,'index'])->name('message.delete');
Route::resource('projects', 'ProjectsController');