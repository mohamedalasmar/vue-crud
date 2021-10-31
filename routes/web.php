<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::view('header', 'vue');

Route::prefix('header')->group(function () {
    Route::view('/', 'vue');
    Route::post('create', [PostController::class, 'createPost']);
    Route::get('get', [PostController::class, 'getPosts']);
    Route::put('edit/{id}',[PostController::class,'updatePosts']);
    Route::delete('delete/{id}',[PostController::class,'deletePosts']);
    Route::post('register',[UserController::class,'register']);
    Route::post('login', [UserController::class, 'login']);
});


// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
