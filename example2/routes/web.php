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

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/enterprise', function () {
  // getting all of them
  //  $articles = App\Models\Article::all();

  // getting unique two of them
  //  $articles = App\Models\Article::take(2)->get();

  // paginate them
  //  $articles = App\Models\Article::paginate(2);

  // showing all in descending order showing the recently created_at
  //  $articles = App\Models\Article::latest('created_at')->get();

  // showing all in descending order showing the recently updated_at
  //  $articles = App\Models\Article::latest('updated_at')->get();

  // showing latest 3 articles
    $articles = App\Models\Article::take(5)->latest('updated_at')->get();

  //  return $articles;
    return view('enterprise', [
      'articles' => $articles
    ]);
})->name('enterprise');



// Create new one
Route::get('/articles/create', 'App\Http\Controllers\ArticleController@create')->name('articles.create');
//Store new one
Route::post('articles/', 'App\Http\Controllers\ArticleController@store')->name('articles.store');

//Show specifice one
Route::get('/articles/{article}', 'App\Http\Controllers\ArticleController@showArticle')->name('articles.show');
// Show all
Route::get('/articles', 'App\Http\Controllers\ArticleController@allArticle')->name('articles.all');

//edit the existing one
Route::get('/articles/{article}/edit', 'App\Http\Controllers\ArticleController@editArticle')->name('articles.edit');

//update the existing one
Route::put('/articles/{article}', 'App\Http\Controllers\ArticleController@updateArticle')->name('articles.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
