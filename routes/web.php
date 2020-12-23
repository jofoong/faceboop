<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;

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

Route::get('/posts/create', [PostController::class, "create"])->name('posts.create')->middleware('auth');
Route::post('posts/user/{user_id}', [PostController::class, "store"])->name('posts.store')->middleware('auth');
Route::post('posts/{post_id}/user/{user_id}', [PostController::class, "update"])->name('posts.update')->middleware('auth');
Route::get('/posts/{post}', [PostController::class, "show"])->name('posts.show');
Route::get('posts/{post}/edit', [PostController::class, "edit"])->name('posts.edit');
Route::delete('/posts/{post}', [PostController::class, "destroy"])->name('posts.destroy')->middleware('auth');


Route::post('comments/user/{user_id}/post/{post_id}', [CommentController::class, "store"])->name('comments.store')->middleware('auth');
Route::get('/comments/{comment}', [CommentController::class, "show"])->name('comments.show');
Route::post('comments/{comment_id}/user/{user_id}', [CommentController::class, "update"])->name('comments.update')->middleware('auth');
Route::delete('/comments/{comment}', [CommentController::class, "destroy"])->name('comments.destroy')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
