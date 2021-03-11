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
