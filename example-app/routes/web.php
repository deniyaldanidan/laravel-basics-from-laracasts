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
/*
  Basic Routing and views
*/
Route::get('/', function () {
    return view('index');
});

/*
Pass request data to views
*/

Route::get('/json', function () {
    $name = request("name");
    $age = request("age");
    return array("name"=>$name,"age"=>$age);
});

Route::get('/test', function(){
  $name = request('name');
  $age = request("age");
  $g = request("g");
  return view("test", [
    "name" => $name,
    "age" => $age,
    "g" => $g
]);
});


/*
Route wildcards
*/

Route::get('wildu/{some}', function($some){
  return $some;
});


Route::get('/wild/{some}', function($some){
  $posts = [
    'First-blog' => "This is my First Blog",
    'Second-blog' => "This is my Second Blog",
  ];
  if (! array_key_exists($some, $posts)){
    abort(404);
  };
  return view('wildcard', [
    "blogHead" => $some,
    "post" => $posts[$some]// ?? 'Not added yet. '
  ]);
});


/*
Routing to controllers
*/
Route::get('/contents/{content}', 'App\Http\Controllers\ContentsController@show');

Route::get('/posts/{postId}', 'App\Http\Controllers\PostsController@retrieve');
