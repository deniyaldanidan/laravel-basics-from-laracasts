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

Route::get('tests/{id}', [Controllers\TestsController::class,'show']);

Route::get('posts/{id}', [Controllers\PostsController::class,'show']);


Route::get('test', function () {

    return view('test', [
        'name' => request('name')
    ]);
})->name('test');

#CRUD
#1
Route::get('/', [Controllers\ArticlesController::class,'index'])->name('home');

Route::get('articles', [Controllers\ArticlesController::class,'all'])->name('allarts');

#2
Route::get('articles/{article}', [Controllers\ArticlesController::class,'show'])->name('showart');

#3
Route::get('article/create', [Controllers\ArticlesController::class,'create'])->name('createart');

#4
Route::post('article/', [Controllers\ArticlesController::class,'store'])->name('storeart');

#5
Route::get('article/edit/{article}', [Controllers\ArticlesController::class,'edit'])->name('editart');

#6
Route::put('article/{article}', [Controllers\ArticlesController::class,'update'])->name('updateart');

#7
Route::delete('article/{article}', [Controllers\ArticlesController::class, 'delete'])->name('deleteart');