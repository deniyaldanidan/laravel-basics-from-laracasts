<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
    return view('home');
});


Route::get('test', function () {

    return view('test', [
        'name' => request('name')
    ]);
});


Route::get('tests/{id}', [Controllers\TestsController::class,'show']);

Route::get('posts/{id}', [Controllers\PostsController::class,'show']);