# One to One [Polymorphic]

Consider Two Models
- Post
- Member
- Image

Both the models Post and Member are related to the Image model, like..
- Post hasOne Image and that Image belongsTo Post
- Member hasOne Image and that Image belongsTo Member

Instead of creating seperate relaions we're using morphOne and morphTo.

Columns:
- Member
	- name -> string

- Post
	- name -> string

- Image
	- url -> string
	- imageable_id -> unsignedBigInteger
	- imageable_type -> string

Relations
- Member
```php
public function image()
{
    return $this->morphOne(Image::class, 'imageable');
}
```

- Post
```php
public function image(){
    return $this->morphOne(Image::class, 'imageable');
}
```

- Image
```php
    public function imageable()
    {
        return $this->morphTo(__FUNCTION__, 'imageable_type', 'imageable_id');
    }
```

tinkers
```php
❯ php artisan tinker
Psy Shell v0.10.8 (PHP 7.4.3 — cli) by Justin Hileman
>>> App\Models\Member::all()
=> Illuminate\Database\Eloquent\Collection {#4179
     all: [],
   }
>>> App\Models\Member::create(['name'=>'allen'])
=> App\Models\Member {#3390
     name: "allen",
     updated_at: "2021-06-29 11:47:14",
     created_at: "2021-06-29 11:47:14",
     id: 1,
   }
>>> App\Models\Post::create(['name'=>'post1'])
=> App\Models\Post {#4179
     name: "post1",
     updated_at: "2021-06-29 11:47:23",
     created_at: "2021-06-29 11:47:23",
     id: 1,
   }
>>> App\Models\Post::find(1)
=> App\Models\Post {#4111
     id: "1",
     name: "post1",
     created_at: "2021-06-29 11:47:23",
     updated_at: "2021-06-29 11:47:23",
   }
>>> App\Models\Post::find(1)->image
=> null
>>> App\Models\Post::find(1)->image()->create(['url'=>'url1'])
=> App\Models\Image {#4325
     url: "url1",
     imageable_id: 1,
     imageable_type: "post",
     updated_at: "2021-06-29 11:47:58",
     created_at: "2021-06-29 11:47:58",
     id: 1,
   }
>>> App\Models\Member::find(1)->image()->create(['url'=>'url2'])
=> App\Models\Image {#4179
     url: "url2",
     imageable_id: 1,
     imageable_type: "member",
     updated_at: "2021-06-29 11:48:15",
     created_at: "2021-06-29 11:48:15",
     id: 2,
   }
>>> App\Models\Member::all()
=> Illuminate\Database\Eloquent\Collection {#4324
     all: [
       App\Models\Member {#3706
         id: "1",
         name: "allen",
         created_at: "2021-06-29 11:47:14",
         updated_at: "2021-06-29 11:47:14",
       },
     ],
   }
>>> App\Models\Post::all()
=> Illuminate\Database\Eloquent\Collection {#4268
     all: [
       App\Models\Post {#4074
         id: "1",
         name: "post1",
         created_at: "2021-06-29 11:47:23",
         updated_at: "2021-06-29 11:47:23",
       },
     ],
   }
>>> App\Models\Image::all()
=> Illuminate\Database\Eloquent\Collection {#3390
     all: [
       App\Models\Image {#4327
         id: "1",
         url: "url1",
         imageable_id: "1",
         imageable_type: "post",
         created_at: "2021-06-29 11:47:58",
         updated_at: "2021-06-29 11:47:58",
       },
       App\Models\Image {#4332
         id: "2",
         url: "url2",
         imageable_id: "1",
         imageable_type: "member",
         created_at: "2021-06-29 11:48:15",
         updated_at: "2021-06-29 11:48:15",
       },
     ],
   }
>>> App\Models\Image::find(1)->imageable
=> App\Models\Post {#4334
     id: "1",
     name: "post1",
     created_at: "2021-06-29 11:47:23",
     updated_at: "2021-06-29 11:47:23",
   }
>>> App\Models\Image::find(2)->imageable
=> App\Models\Member {#4324
     id: "1",
     name: "allen",
     created_at: "2021-06-29 11:47:14",
     updated_at: "2021-06-29 11:47:14",
   }
>>> App\Models\Member::find(1)->image
=> App\Models\Image {#3390
     id: "2",
     url: "url2",
     imageable_id: "1",
     imageable_type: "member",
     created_at: "2021-06-29 11:48:15",
     updated_at: "2021-06-29 11:48:15",
   }
>>> App\Models\Post::find(1)->image
=> App\Models\Image {#4334
     id: "1",
     url: "url1",
     imageable_id: "1",
     imageable_type: "post",
     created_at: "2021-06-29 11:47:58",
     updated_at: "2021-06-29 11:47:58",
   }


```

## Advantage of Polymorphics
So if we want to add a Status model [totally new feature] which has relation with Image model just like Post and Member models. We just have to create a Status model and its table and add morphOne relation in its model-file. And it is done...

tinkers
```php
❯ php artisan tinker
Psy Shell v0.10.8 (PHP 7.4.3 — cli) by Justin Hileman
>>> App\Models\Status::all()
=> Illuminate\Database\Eloquent\Collection {#4179
     all: [],
   }
>>> App\Models\Status::create(['name'=>'status1'])
=> App\Models\Status {#3390
     name: "status1",
     updated_at: "2021-06-29 12:40:06",
     created_at: "2021-06-29 12:40:06",
     id: 1,
   }
>>> App\Models\Status::find(1)
=> App\Models\Status {#4322
     id: "1",
     name: "status1",
     created_at: "2021-06-29 12:40:06",
     updated_at: "2021-06-29 12:40:06",
   }
>>> App\Models\Status::find(1)->image
=> null
>>> App\Models\Status::find(1)->image()->create(['url'=>'Status Url'])
=> App\Models\Image {#4324
     url: "Status Url",
     imageable_id: 1,
     imageable_type: "status",
     updated_at: "2021-06-29 12:40:52",
     created_at: "2021-06-29 12:40:52",
     id: 3,
   }
>>> App\Models\Status::find(1)->image
=> App\Models\Image {#4321
     id: "3",
     url: "Status Url",
     imageable_id: "1",
     imageable_type: "status",
     created_at: "2021-06-29 12:40:52",
     updated_at: "2021-06-29 12:40:52",
   }
>>> App\Models\Image::find(3)
=> App\Models\Image {#4074
     id: "3",
     url: "Status Url",
     imageable_id: "1",
     imageable_type: "status",
     created_at: "2021-06-29 12:40:52",
     updated_at: "2021-06-29 12:40:52",
   }
>>> App\Models\Image::find(3)->imageable
=> App\Models\Status {#4323
     id: "1",
     name: "status1",
     created_at: "2021-06-29 12:40:06",
     updated_at: "2021-06-29 12:40:06",
   }
```

## Custome Polymorphic_types:
As default _type will be the particular class name like App\Models\Member or App\Models\Post. to change that add below code to the boot funcion on the [AppServiceProvider.php](app/Providers/AppServiceProvider.php).

```php
use Illuminate\Database\Eloquent\Relations\Relation;

public function boot()
    {
        Relation::morphMap([
            'post' => 'App\Models\Post',
            'member' => 'App\Models\Member',
        ]);
    }
```
# One to Many Polymorphics

Consider four models:
- Post
- Podcast
- Live
- Comment

Models Post, Podcast, Live are related with Comment model in one-To-Many relation. so we are using polymorphic relation to avoid repetitions.

columns:
- Post
	- name -> string
- Podcast
	- name -> string
- Live
	- name -> string
- Comment
	- comment -> string
	- commentable_id -> unsignedBigInteger
	- commentable_type -> string
	
relation:
- Post
```php
public function comments(){
    return $this->morphMany(Comment::class, 'commentable');
}
```
- Comment
```php
public function commentable()
{
    return $this->morphTo(__FUNCTION__, 'commentable_type', 'commentable_id');
}
```

tinkers:
```php
❯ php artisan tinker
Psy Shell v0.10.8 (PHP 7.4.3 — cli) by Justin Hileman
>>> App\Models\Post::all()
=> Illuminate\Database\Eloquent\Collection {#4179
     all: [],
   }
>>> App\Models\Post::create(['name'=>'post1'])
=> App\Models\Post {#3390
     name: "post1",
     updated_at: "2021-06-29 13:23:35",
     created_at: "2021-06-29 13:23:35",
     id: 1,
   }
>>> App\Models\Podcast::create(['name'=>'podcast1'])
=> App\Models\Podcast {#4179
     name: "podcast1",
     updated_at: "2021-06-29 13:23:53",
     created_at: "2021-06-29 13:23:53",
     id: 1,
   }
>>> App\Models\Live::create(['name'=>'live1'])
=> App\Models\Live {#3390
     name: "live1",
     updated_at: "2021-06-29 13:24:09",
     created_at: "2021-06-29 13:24:09",
     id: 1,
   }
>>> App\Models\Podcast::find(1)
=> App\Models\Podcast {#4324
     id: "1",
     name: "podcast1",
     created_at: "2021-06-29 13:23:53",
     updated_at: "2021-06-29 13:23:53",
   }
>>> App\Models\Podcast::find(1)->comments
=> Illuminate\Database\Eloquent\Collection {#4325
     all: [],
   }
>>> App\Models\Podcast::find(1)->comments()->create(['comment'=>'nice post'])
=> App\Models\Comment {#4326
     comment: "nice post",
     commentable_id: 1,
     commentable_type: "podcast",
     updated_at: "2021-06-29 13:24:46",
     created_at: "2021-06-29 13:24:46",
     id: 1,
   }
>>> App\Models\Podcast::find(1)->comments()->create(['comment'=>'awesome post'])
=> App\Models\Comment {#4267
     comment: "awesome post",
     commentable_id: 1,
     commentable_type: "podcast",
     updated_at: "2021-06-29 13:24:56",
     created_at: "2021-06-29 13:24:56",
     id: 2,
   }
>>> App\Models\Podcast::find(1)->comments
=> Illuminate\Database\Eloquent\Collection {#4328
     all: [
       App\Models\Comment {#4113
         id: "1",
         comment: "nice post",
         commentable_id: "1",
         commentable_type: "podcast",
         created_at: "2021-06-29 13:24:46",
         updated_at: "2021-06-29 13:24:46",
       },
       App\Models\Comment {#4333
         id: "2",
         comment: "awesome post",
         commentable_id: "1",
         commentable_type: "podcast",
         created_at: "2021-06-29 13:24:56",
         updated_at: "2021-06-29 13:24:56",
       },
     ],
   }
>>> App\Models\Comment::all()
=> Illuminate\Database\Eloquent\Collection {#4327
     all: [
       App\Models\Comment {#4326
         id: "1",
         comment: "nice post",
         commentable_id: "1",
         commentable_type: "podcast",
         created_at: "2021-06-29 13:24:46",
         updated_at: "2021-06-29 13:24:46",
       },
       App\Models\Comment {#4334
         id: "2",
         comment: "awesome post",
         commentable_id: "1",
         commentable_type: "podcast",
         created_at: "2021-06-29 13:24:56",
         updated_at: "2021-06-29 13:24:56",
       },
     ],
   }
>>> App\Models\Comment::find(1)
=> App\Models\Comment {#4268
     id: "1",
     comment: "nice post",
     commentable_id: "1",
     commentable_type: "podcast",
     created_at: "2021-06-29 13:24:46",
     updated_at: "2021-06-29 13:24:46",
   }
>>> App\Models\Comment::find(1)->commentable
=> App\Models\Podcast {#4330
     id: "1",
     name: "podcast1",
     created_at: "2021-06-29 13:23:53",
     updated_at: "2021-06-29 13:23:53",
   }
>>> App\Models\Live::find(1)->comments()->create(['comment'=>'great song'])
=> App\Models\Comment {#4325
     comment: "great song",
     commentable_id: 1,
     commentable_type: "live",
     updated_at: "2021-06-29 13:26:29",
     created_at: "2021-06-29 13:26:29",
     id: 3,
   }
>>> App\Models\Live::find(1)->comments()->create(['comment'=>'great lightings'])
=> App\Models\Comment {#4111
     comment: "great lightings",
     commentable_id: 1,
     commentable_type: "live",
     updated_at: "2021-06-29 13:26:39",
     created_at: "2021-06-29 13:26:39",
     id: 4,
   }
>>> App\Models\Live::find(1)->comments
=> Illuminate\Database\Eloquent\Collection {#4268
     all: [
       App\Models\Comment {#4337
         id: "3",
         comment: "great song",
         commentable_id: "1",
         commentable_type: "live",
         created_at: "2021-06-29 13:26:29",
         updated_at: "2021-06-29 13:26:29",
       },
       App\Models\Comment {#4343
         id: "4",
         comment: "great lightings",
         commentable_id: "1",
         commentable_type: "live",
         created_at: "2021-06-29 13:26:39",
         updated_at: "2021-06-29 13:26:39",
       },
     ],
   }
>>> App\Models\Comment::find(3)
=> App\Models\Comment {#4338
     id: "3",
     comment: "great song",
     commentable_id: "1",
     commentable_type: "live",
     created_at: "2021-06-29 13:26:29",
     updated_at: "2021-06-29 13:26:29",
   }
>>> App\Models\Comment::find(3)->commentable
=> App\Models\Live {#4335
     id: "1",
     name: "live1",
     created_at: "2021-06-29 13:24:09",
     updated_at: "2021-06-29 13:24:09",
   }
>>> App\Models\Post::find(1)->comments()->create(['comment'=>'inspiring words'])
=> App\Models\Comment {#4340
     comment: "inspiring words",
     commentable_id: 1,
     commentable_type: "post",
     updated_at: "2021-06-29 13:27:31",
     created_at: "2021-06-29 13:27:31",
     id: 5,
   }
>>> App\Models\Post::find(1)->comments()->create(['comment'=>'smooth'])
=> App\Models\Comment {#4334
     comment: "smooth",
     commentable_id: 1,
     commentable_type: "post",
     updated_at: "2021-06-29 13:27:49",
     created_at: "2021-06-29 13:27:49",
     id: 6,
   }
>>> App\Models\Post::find(1)->comments
=> Illuminate\Database\Eloquent\Collection {#4338
     all: [
       App\Models\Comment {#4346
         id: "5",
         comment: "inspiring words",
         commentable_id: "1",
         commentable_type: "post",
         created_at: "2021-06-29 13:27:31",
         updated_at: "2021-06-29 13:27:31",
       },
       App\Models\Comment {#4352
         id: "6",
         comment: "smooth",
         commentable_id: "1",
         commentable_type: "post",
         created_at: "2021-06-29 13:27:49",
         updated_at: "2021-06-29 13:27:49",
       },
     ],
   }
>>> App\Models\Comment::find(5)
=> App\Models\Comment {#4347
     id: "5",
     comment: "inspiring words",
     commentable_id: "1",
     commentable_type: "post",
     created_at: "2021-06-29 13:27:31",
     updated_at: "2021-06-29 13:27:31",
   }
>>> App\Models\Comment::find(5)->commentable
=> App\Models\Post {#4344
     id: "1",
     name: "post1",
     created_at: "2021-06-29 13:23:35",
     updated_at: "2021-06-29 13:23:35",
   }
```