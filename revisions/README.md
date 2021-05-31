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
* To create a controller file
> php artisan make:controller TestsController
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