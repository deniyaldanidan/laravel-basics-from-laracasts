<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('containertest1', function () {
    $container = new App\Container();
    $container->bind('example', function(){
        return new App\Example();
    });

    $container->resolve('example')->go();
});

// To make things easy laravel is its own container
Route::get('containertest2', function () {
    app()->bind('example', function(){
        return new App\Example();
    });
    resolve('example')->go();
});