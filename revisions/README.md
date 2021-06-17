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
> full rendered views are in [here](app1/storage/framework/views/) check it out..
--------------------
<br>

# Lessons learned:
    1. Routing
    2. blade
    3. Database connection
    4. Controllers
    5. Model



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
### named-routes
* declare named routes <span style='font-size:30px;'>&#8594;</span> `Route::get('/', [Controllers\ArticlesController::class,'index'])->name('home');`
* redirects <span style='font-size:30px;'>&#8594;</span> `redirect()->route('allarts');`
* generate url <span style='font-size:30px;'>&#8594;</span> `<a href="{{route('home')}}">securebreads</a>`
* checking current-path <span style='font-size:30px;'>&#8594;</span> 
```php
<li class="{{Request::path() == "/" ? 'current_page_item': ''}}"><a href="{{route('home')}}" accesskey="1" title="">Homepage</a></li>
<li class="{{Request::is("test*") ? 'current_page_item': ''}}"><a href="{{route('test')}}" accesskey="2" title="">Test</a></li>
<li class="{{Request::is("articles*") ? 'current_page_item': ''}}"><a href="{{route('allarts')}}" accesskey="3" title="">Articles</a></li>
<li class="{{Request::is("article/*") ? 'current_page_item': ''}}"><a href="{{route('createart')}}" accesskey="4" title="">New Article</a></li>
```




## Blade
* `{{$name}}` htmlspecialchars escaped echo
* `{!! $name !!}` not escaped raw echo
* `@csrf` will include csrf token
* to use put methods [refer code](app1/resources/views/articles/edit.blade.php)
  * you have to use method='POST' on form and also add @method('PUT') in the input field.
* in forms-server side error handling use:
  * ```@error('title')
            <span style="color:red;font-size:14px;">{{$errors->first('title')}}</span>
        @enderror 
    ```
* foreach use 
  ```
  @foreach($list1 as @item) @endforeach
  ```


## Database
[for mysql]set up a connection to mysql check out [.env](app1/.env) file and fill out the field. for other DB's check docs. create a model file and a migration file using php artisan [check out](#useful-commands). 

* First setup the database connection .env.
* Now create the database using migrations file in [migrations file](app1/database/migrations/2021_05_31_134437_create_posts_table.php)
* Now run the migrations `php artisan migrate`
* write Model logics on [Model-file](app1/app/Models/Assignment.php)

> while creating foriegn-keys note-below:
```php
# creating the foriegn-key
$table->unsignedbigInteger('user_id');
# linking it to the appr..DB
$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
```
> While creating pivot tables naming conventions should be singlularcase seperated by underscore _ table1_table2 arranged in alphabatical order. for example article_tag for the tables articles and tags.


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
Models\Article::latest()->paginate(3);
#paginate provides
$articles->currentPage() # currentpage
$articles->lastPage() # lastpage or n-pages available
$articles->nextPageUrl()?$articles->nextPageUrl():'' # nextpage-no
$articles->previousPageUrl()?$articles->previousPageUrl():'' # previouspage-no

# for search queries use this:
Models\Article::where('title','like','%'.$sm.'%')->orWhere('excerpt','like','%'.$sm.'%')->latest()->paginate(3);


# [Preferable]alternate to Post::where('slug',$post)->first() 
Route::get('api/posts/{post:slug}', function (App\Models\Post $post) {
    return $post;
});

# when you want to create/update a row use
public function store()
    {
        Models\Article::create($this->validatedAttributes()); #create a new row
    }

public function update(Models\Article $article)
    {

        $article->update($this->validatedAttributes()); # update an existing row
    }

#validating inputs
protected function validatedAttributes(Type $var = null)
    {
        return request()->validate([
                'title'=>'required|min:3|max:199',
                'excerpt'=>'required|min:10|max:199',
                'body'=>'required|min:200'
                ]);
    }

#deleting a row
public function delete(Models\Article $article){
        $article->delete();
    }

```
check out [paginator-instance-methods](app1/app/Http/Controllers/ArticlesController.php) on docs

## views

for rendering views split everything using `extends yield|section & includes`. So it will be more arranged. use blade templates for dynamic data [check here](app1/resources/views/).
also check out these [headers](app1/resources/views/layouts/header.blade.php)

## 7 restful controller actions
**CRUD**

**C**reate **R**ead **U**pdate **D**elete

* Read <span style='font-size:30px;'>&#8594;</span> Read-one, Read-all
* Create <span style='font-size:30px;'>&#8594;</span>  create-form <span style='font-size:15px;'>&#9758;</span>  form-submit/store
* Update <span style='font-size:30px;'>&#8594;</span> edit-form[read the row and render it into the input fields of updateForm] <span style='font-size:15px;'>&#9758;</span> update-row
* delete <span style='font-size:30px;'>&#8594;</span> delete the specific row

So the 7 restful controller actions are:
1. read-one
2. read-all
3. create
4. store
5. edit
6. update
7. delete
[refer code](app1/app/Http/Controllers/ArticlesController.php)

----

1. Create <span style='font-size:30px;'>&#8594;</span>  post
2. Read <span style='font-size:30px;'>&#8594;</span> get
3. Update <span style='font-size:30px;'>&#8594;</span> put
4. Delete <span style='font-size:30px;'>&#8594;</span> delete

## Model
database-logics are written in model-file.
> declare $fillable variable to prevent **mass-assignment**

### Eloquent
* hasOne
* hasMany
* belongsTo
* belongsToMany
* morphMany
* morphToMany

## Factories
used to produce dummy data and testings. 

To create dummy user data's use 
```php
App\Models\User::factory()->create();
# to generate n dummy data's use:
App\Models\User::factory()->count(4)->create();
```
> Since user-class has factory as default you dont need to create a new factory. otherwise you have to create a factory file to create a factory-file use `php artisan make:factory ArticleFactory` if you want to refer it to specific model use `-m` model flag.laravel is equipped with [faker](https://fakerphp.github.io/) php library. so we can use that to generate fake info's. refer [code](app1/database/factories/ArticleFactory.php) to produce custom fake-data `App\Models\Article::factory()->count(4)->create(['user_id'=>2]);` <span style='font-size:15px;'>&#9756;</span> in  this we created 4 fake datas with user_id=2. 
