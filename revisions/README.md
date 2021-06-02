<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
</p>

> learned from [laracasts](https://laracasts.com/series/laravel-6-from-scratch/episodes/5)
> always refer [docs](https://laravel.com/)

-----------------
<br>

## Useful commands

* To start dev server
> php artisan serve

> php artisan make:controller TestsController
> php artisan make:model Post
> php artisan make:migration create_posts_table
> php artisan migrate
> php artisan migrate:fresh
> php artisan migrate:rollback

* The below will create a model controller and migration files
> php artisan make:model Project -mc

* to ask help about certain action
> php artisan help make:controller

* create a resourceful controller [with 7-REST CRUD]
> php artisan make:controller ArticlesController -r

* php/laravel shell 
> php artisan tinker
--------------------
<br>

## Tips

* check if an array key exists
```php
if (! array_key_exists($key, $array)) {
    echo "Sorry not found";
}
```
* To produce not fount error
```php
 abort(404, 'Not found`);
```
--------------------
<br>

# Lessons learned:
    1. Routing
    2. blade
    3. Database connection



## Routing
web routes are defined on `routes/web.php`. On web.php file declare route using Route statement following `get/post/put/delete` **CRUD** request objects. 

request objects has 2 params: 
* web-route(`/test`)
* either a function() or controllerclass
  * function:
  
    ```php
    Route::get('test', function () {
        return view('test', [
            'name' => request('name')
        ]);
    });
    ```
  * [controllerclass](app1/app/Http/Controllers/TestsController.php):
    ```php
    use App\Http\Controllers\TestsController;
    Route::get('tests/{id}', [TestsController::class,'show']);
    ```
    on controller class create a public function named show and do the operations in there. controllers are in `App/Http/Controllers/TestController`

routes can either return a string/json object or a view file. views are on `resources/views/test.blade.php`.

in routes requests like `test?name=anna` can be retrieved by using `request=($name)` and wildcards like `test/{id}` can be retrieved as a functions params `show(id){$id}` [refer](app1/app/Http/Controllers/TestsController.php)

variables from routes or controllers can be passed down to view using 

```php
return view('test', [
    'name' => request('name')
]);
```

> full rendered views are in [here](app1/storage/framework/views/) check it out..

## Blade
* `{{$name}}` htmlspecialchars escaped echo
* `{!! $name !!}` not escaped raw echo


## Database
[for mysql]set up a connection to mysql check out [.env](app1/.env) file and fill out the field. for other DB's check docs. create a model file and a migration file using php artisan [check out](#useful-commands). 

* First setup the database connection .env.
* Now create the database using migrations file in [migrations file](app1/database/migrations/2021_05_31_134437_create_posts_table.php)
* Now run the migrations `php artisan migrate`
* write Model logics on [Model-file](app1/app/Models/Assignment.php)

[NOTE]
**Some queries**
```php
use App\Models;

\DB::table('posts')->where('slug', $slug)->first();
Models\Post::where('slug', $slug)->firstOrFail();
Models\Post::all();
Models\Post::first();

#making changes for the first one
$post1 = Models\Post::first();
$post1->completed = true;
$post1->save();

Models\Post::find($id);
Models\Post::latest()->take(3)->get(); #latest 3 posts
Models\Post::paginate(3);

# [Preferable]alternate to Post::where('slug',$post)->first() 
Route::get('api/posts/{post:slug}', function (App\Models\Post $post) {
    return $post;
});

```
check out [paginator-instance-methods](app1/app/Http/Controllers/ArticlesController.php) on docs

## views

for rendering views split everything using `extends yield|section & includes`. So it will be more arranged. use blade templates for dynamic data [check here](app1/resources/views/).
also check out these [headers](app1/resources/views/layouts/header.blade.php)

## 7 restful controller actions
