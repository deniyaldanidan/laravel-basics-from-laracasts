<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Models;

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

Route::get('test', function () {

    return view('test', [
        'name' => request('name')
    ]);
});


Route::get('tests/{id}', [Controllers\TestsController::class,'show']);

Route::get('posts/{id}', [Controllers\PostsController::class,'show']);


#1
Route::get('/', [Controllers\ArticlesController::class,'index']);

Route::get('articles', [Controllers\ArticlesController::class,'all']);

#2
Route::get('articles/{article}', [Controllers\ArticlesController::class,'show']);

#3
Route::get('article/create', [Controllers\ArticlesController::class,'create']);

#4
Route::post('article/', [Controllers\ArticlesController::class,'store']);