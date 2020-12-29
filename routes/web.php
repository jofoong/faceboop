<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TagController;
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

Route::get('/profile/{profile}', [ProfileController::class, "show"])->name('profiles.show');
Route::post('/profile/{profile}', [ProfileController::class, "update"])->name('profile.update')->middleware('auth');
Route::get('/profile/{profile}/edit', [ProfileController::class, "edit"])->name('profiles.edit');

Route::get('/posts/create', [PostController::class, "create"])->name('posts.create')->middleware('auth');
Route::post('posts/user/{user_id}', [PostController::class, "store"])->name('posts.store')->middleware('auth');
Route::post('posts/{post_id}/user/{user_id}', [PostController::class, "update"])->name('posts.update')->middleware('auth');
Route::get('/posts/{post}', [PostController::class, "show"])->name('posts.show');
Route::get('posts/{post}/edit', [PostController::class, "edit"])->name('posts.edit');
Route::delete('/posts/{post}', [PostController::class, "destroy"])->name('posts.destroy')->middleware('auth');

Route::post('comments/user/{user_id}/post/{post_id}', [CommentController::class, "store"])->name('comments.store')->middleware('auth');
Route::get('/comments/{comment}', [CommentController::class, "show"])->name('comments.show');
Route::get('comments/{comment}/edit', [CommentController::class, "edit"])->name('comments.edit');
Route::post('comments/{comment_id}/user/{user_id}', [CommentController::class, "update"])->name('comments.update')->middleware('auth');
Route::delete('/comments/{comment}', [CommentController::class, "destroy"])->name('comments.destroy')->middleware('auth');

Route::get('/tag/{tag}', [TagController::class, "index"])->name('tags.index');

Route::post('/image/post/{post}', [ImageController::class, "store"])->name('images.store')->middleware('auth');

Route::namespace('Admin')->prefix('admin')->name('admin')->group(function(){
    Route::middleware('can:posts.update')->group(function(){
        Route::post('posts/{post_id}/user/{user_id}', [PostController::class, "update"],['except' => ['show']])->name('posts.update');
    });
    Route::middleware('can:posts.destroy')->group(function(){
        Route::delete('/posts/{post}', [PostController::class, "destroy"],['except' => ['show']])->name('posts.destroy');
    });
    Route::middleware('can:comments.store')->group(function(){
        Route::post('comments/user/{user_id}/post/{post_id}', [CommentController::class, "store"],['except' => ['show']])->name('comments.store');
    });
    Route::middleware('can:comments.update')->group(function(){
        Route::post('comments/{comment_id}/user/{user_id}', [CommentController::class, "update"],['except' => ['show']])->name('comments.update');
    });
    Route::middleware('can:comments.destroy')->group(function(){
        Route::delete('/comments/{comment}', [CommentController::class, "destroy"],['except' => ['show']])->name('comments.destroy');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
