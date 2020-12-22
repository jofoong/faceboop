<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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
Route::get('/', [PostController::class, "index"])->name('homepage');

Route::get('/profile/{profile_id}', [ProfileController::class, "show"])->name('profiles.show');

Route::get('/posts/create', [PostController::class, "create"])->name('posts.create');
Route::post('posts/{user_id}', [PostController::class, "store"])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, "show"])->name('posts.show');
Route::delete('/post/{post_id}', [PostController::class, "destroy"])->name('posts.destroy');

Route::post('comments/user/{user_id}/post/{post_id}', [CommentController::class, "store"])->name('comments.store');
Route::get('/comments/{comment}', [CommentController::class, "show"])->name('comments.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
