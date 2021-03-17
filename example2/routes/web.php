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
});

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
    $articles = App\Models\Article::take(3)->latest('updated_at')->get();

  //  return $articles;
    return view('enterprise', [
      'articles' => $articles
    ]);
});


Route::get('/articles/{article_id}', 'App\Http\Controllers\ArticleController@showArticle');

Route::get('/articles', 'App\Http\Controllers\ArticleController@allArticle');
