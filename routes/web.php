<?php

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

Route::get('/who/{name?}', function ($name = null) {
    return '...who...? What is this place? Are you...who ARE you?';
});

Route::get('/who/{name}', function ($name) {
    return '...who...? What is this place? Are you...'.$name . '?';
});