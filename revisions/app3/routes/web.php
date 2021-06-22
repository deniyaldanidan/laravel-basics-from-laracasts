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
    return view('welcome', ['blogs'=>App\Models\Blog::latest()->get()]);
})->name('rootindex');

Auth::routes();

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

# profile-links
Route::get('/myprofile', [Controllers\ProfileController::class, 'myprofile'])->middleware('auth')->name('profilepage');
Route::get('/mylikes', [Controllers\ProfileController::class, 'mylikes'])->middleware('auth')->name('mylikes');
Route::get('/mycomments', [Controllers\ProfileController::class, 'mycomments'])->middleware('auth')->name('mycomments');
Route::get('/myblogs', [Controllers\ProfileController::class, 'myblogs'])->middleware('auth')->name('myblogs');

#like/unlike
Route::post('/like', [Controllers\ProfileController::class, 'like'])->middleware('auth')->name('like');
Route::delete('/unlike', [Controllers\ProfileController::class, 'unlike'])->middleware('auth')->name('unlike');

#comment/uncomment
Route::post('/comment', [Controllers\ProfileController::class, 'comment'])->middleware('auth')->name('comment');
Route::delete('/comment', [Controllers\ProfileController::class, 'delcomment'])->middleware('auth')->name('delcomment');

#Blog's page
Route::get('blog/{blog}', [Controllers\BlogController::class, 'showBlog'])->name('showblog');

#Blog create
Route::get('blog', [Controllers\BlogController::class, 'create'])->name('blogcreate')->middleware('auth');
Route::post('blog', [Controllers\BlogController::class, 'store'])->name('blogstore')->middleware('auth');

#Blog Edit
Route::get('edit/blog/{blog_id}', [Controllers\BlogController::class, 'edit'])->name('editblog')->middleware('auth');
Route::put('edit/blog/{blog_id}', [Controllers\BlogController::class, 'update'])->name('updateblog')->middleware('auth');

#Blog delete
Route::delete('blog', [Controllers\BlogController::class, 'delete'])->name('deleteblog')->middleware('auth');