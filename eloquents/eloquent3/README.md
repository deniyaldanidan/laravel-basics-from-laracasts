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

# many to many [Polymorphic]

Relations:
- Post
- Podcast
- Live
- Tag

Here Post, Podcast and Live are parent of Tag. Post belongsToMany Tags. Tag belongsToMany Posts.

Columns:
- Post
	- name -> string
- Podcast
	- name -> string
- Live
	- name -> string
- Tag
	- name -> string
- taggables
	- tag_id - unsignedBigInteger
	- taggable_id - unsignedBigInteger
	- taggable_type - string


Model:
- Post, Podcast, Live
	- tags()
		- ```php $this->morphToMany(Tag::class, 'taggable') ```
- Tag
```php
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function podcasts()
    {
        return $this->morphedByMany(Podcast::class, 'taggable');
    }

    public function lives()
    {
        return $this->morphedByMany(Live::class, 'taggable');
    }
```

**tinkers**
```php
>>> App\Models\Post::create(['name'=>'post1'])
=> App\Models\Post {#4267
     name: "post1",
     updated_at: "2021-07-02 05:53:37",
     created_at: "2021-07-02 05:53:37",
     id: 1,
   }
>>> App\Models\Post::create(['name'=>'post2'])
=> App\Models\Post {#3390
     name: "post2",
     updated_at: "2021-07-02 05:53:40",
     created_at: "2021-07-02 05:53:40",
     id: 2,
   }
>>> App\Models\Tag::create(['name'=>'tag1'])
=> App\Models\Tag {#4267
     name: "tag1",
     updated_at: "2021-07-02 05:53:57",
     created_at: "2021-07-02 05:53:57",
     id: 1,
   }
>>> App\Models\Tag::create(['name'=>'tag2'])
=> App\Models\Tag {#3390
     name: "tag2",
     updated_at: "2021-07-02 05:54:00",
     created_at: "2021-07-02 05:54:00",
     id: 2,
   }
>>> App\Models\Tag::create(['name'=>'tag3'])
=> App\Models\Tag {#4267
     name: "tag3",
     updated_at: "2021-07-02 05:54:04",
     created_at: "2021-07-02 05:54:04",
     id: 3,
   }
>>> App\Models\Tag::create(['name'=>'tag4'])
=> App\Models\Tag {#3390
     name: "tag4",
     updated_at: "2021-07-02 05:54:07",
     created_at: "2021-07-02 05:54:07",
     id: 4,
   }
>>> App\Models\Post::find(1)
=> App\Models\Post {#3389
     id: "1",
     name: "post1",
     created_at: "2021-07-02 05:53:37",
     updated_at: "2021-07-02 05:53:37",
   }
>>> App\Models\Post::find(1)->attach([1,2])
BadMethodCallException with message 'Call to undefined method App\Models\Post::attach()'
>>> App\Models\Post::find(1)->tags()->attach([1,2])
=> null
>>> App\Models\Post::find(1)->tags()->attach([1,3])
=> null
>>> App\Models\Tag::find(1)->posts
=> Illuminate\Database\Eloquent\Collection {#4326
     all: [
       App\Models\Post {#4333
         id: "1",
         name: "post1",
         created_at: "2021-07-02 05:53:37",
         updated_at: "2021-07-02 05:53:37",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#3389
           tag_id: "1",
           taggable_id: "1",
           taggable_type: "post",
         },
       },
       App\Models\Post {#4331
         id: "1",
         name: "post1",
         created_at: "2021-07-02 05:53:37",
         updated_at: "2021-07-02 05:53:37",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4330
           tag_id: "1",
           taggable_id: "1",
           taggable_type: "post",
         },
       },
     ],
   }
>>> App\Models\Post::find(2)->tags()->attach([1,3])
=> null
>>> App\Models\Tag::find(1)->posts
=> Illuminate\Database\Eloquent\Collection {#4346
     all: [
       App\Models\Post {#4341
         id: "1",
         name: "post1",
         created_at: "2021-07-02 05:53:37",
         updated_at: "2021-07-02 05:53:37",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4323
           tag_id: "1",
           taggable_id: "1",
           taggable_type: "post",
         },
       },
       App\Models\Post {#4329
         id: "1",
         name: "post1",
         created_at: "2021-07-02 05:53:37",
         updated_at: "2021-07-02 05:53:37",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4344
           tag_id: "1",
           taggable_id: "1",
           taggable_type: "post",
         },
       },
       App\Models\Post {#4347
         id: "2",
         name: "post2",
         created_at: "2021-07-02 05:53:40",
         updated_at: "2021-07-02 05:53:40",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4342
           tag_id: "1",
           taggable_id: "2",
           taggable_type: "post",
         },
       },
     ],
   }
>>> App\Models\Podcast::create(['name'=>'pod1'])
=> App\Models\Podcast {#4350
     name: "pod1",
     updated_at: "2021-07-02 05:55:54",
     created_at: "2021-07-02 05:55:54",
     id: 1,
   }
>>> App\Models\Podcast::create(['name'=>'pod2'])
=> App\Models\Podcast {#4345
     name: "pod2",
     updated_at: "2021-07-02 05:55:56",
     created_at: "2021-07-02 05:55:56",
     id: 2,
   }
>>> App\Models\Podcast::find(1)
=> App\Models\Podcast {#4351
     id: "1",
     name: "pod1",
     created_at: "2021-07-02 05:55:54",
     updated_at: "2021-07-02 05:55:54",
   }
>>> App\Models\Podcast::find(1)->tags
=> Illuminate\Database\Eloquent\Collection {#4178
     all: [],
   }
>>> App\Models\Podcast::find(1)->tags()->attach([1,2])
=> null
>>> App\Models\Podcast::find(1)->tags()->attach([3,2])
=> null
>>> App\Models\Tag::find(1)->posts
=> Illuminate\Database\Eloquent\Collection {#4339
     all: [
       App\Models\Post {#4358
         id: "1",
         name: "post1",
         created_at: "2021-07-02 05:53:37",
         updated_at: "2021-07-02 05:53:37",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4362
           tag_id: "1",
           taggable_id: "1",
           taggable_type: "post",
         },
       },
       App\Models\Post {#4343
         id: "1",
         name: "post1",
         created_at: "2021-07-02 05:53:37",
         updated_at: "2021-07-02 05:53:37",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4349
           tag_id: "1",
           taggable_id: "1",
           taggable_type: "post",
         },
       },
       App\Models\Post {#4366
         id: "2",
         name: "post2",
         created_at: "2021-07-02 05:53:40",
         updated_at: "2021-07-02 05:53:40",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4357
           tag_id: "1",
           taggable_id: "2",
           taggable_type: "post",
         },
       },
     ],
   }
>>> App\Models\Podcast::find(1)->tags
=> Illuminate\Database\Eloquent\Collection {#4356
     all: [
       App\Models\Tag {#4373
         id: "1",
         name: "tag1",
         created_at: "2021-07-02 05:53:57",
         updated_at: "2021-07-02 05:53:57",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4372
           taggable_id: "1",
           tag_id: "1",
           taggable_type: "podcast",
         },
       },
       App\Models\Tag {#4376
         id: "2",
         name: "tag2",
         created_at: "2021-07-02 05:54:00",
         updated_at: "2021-07-02 05:54:00",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4367
           taggable_id: "1",
           tag_id: "2",
           taggable_type: "podcast",
         },
       },
       App\Models\Tag {#4377
         id: "3",
         name: "tag3",
         created_at: "2021-07-02 05:54:04",
         updated_at: "2021-07-02 05:54:04",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4363
           taggable_id: "1",
           tag_id: "3",
           taggable_type: "podcast",
         },
       },
       App\Models\Tag {#4378
         id: "2",
         name: "tag2",
         created_at: "2021-07-02 05:54:00",
         updated_at: "2021-07-02 05:54:00",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4371
           taggable_id: "1",
           tag_id: "2",
           taggable_type: "podcast",
         },
       },
     ],
   }
>>> App\Models\Tag::find(1)->podcasts
=> Illuminate\Database\Eloquent\Collection {#4364
     all: [
       App\Models\Podcast {#4381
         id: "1",
         name: "pod1",
         created_at: "2021-07-02 05:55:54",
         updated_at: "2021-07-02 05:55:54",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4365
           tag_id: "1",
           taggable_id: "1",
           taggable_type: "podcast",
         },
       },
     ],
   }
>>> App\Models\Tag::find(1)
=> App\Models\Tag {#4383
     id: "1",
     name: "tag1",
     created_at: "2021-07-02 05:53:57",
     updated_at: "2021-07-02 05:53:57",
   }
>>> App\Models\Tagged::all()
=> Illuminate\Database\Eloquent\Collection {#3406
     all: [
       App\Models\Tagged {#3407
         id: "1",
         tag_id: "1",
         taggable_id: "1",
         taggable_type: "post",
         created_at: null,
         updated_at: null,
       },
       App\Models\Tagged {#3408
         id: "2",
         tag_id: "2",
         taggable_id: "1",
         taggable_type: "post",
         created_at: null,
         updated_at: null,
       },
       App\Models\Tagged {#3409
         id: "3",
         tag_id: "1",
         taggable_id: "1",
         taggable_type: "post",
         created_at: null,
         updated_at: null,
       },
       App\Models\Tagged {#3410
         id: "4",
         tag_id: "3",
         taggable_id: "1",
         taggable_type: "post",
         created_at: null,
         updated_at: null,
       },
       App\Models\Tagged {#3411
         id: "5",
         tag_id: "1",
         taggable_id: "2",
         taggable_type: "post",
         created_at: null,
         updated_at: null,
       },
       App\Models\Tagged {#3412
         id: "6",
         tag_id: "3",
         taggable_id: "2",
         taggable_type: "post",
         created_at: null,
         updated_at: null,
       },
       App\Models\Tagged {#3413
         id: "7",
         tag_id: "1",
         taggable_id: "1",
         taggable_type: "podcast",
         created_at: null,
         updated_at: null,
       },
       App\Models\Tagged {#3414
         id: "8",
         tag_id: "2",
         taggable_id: "1",
         taggable_type: "podcast",
         created_at: null,
         updated_at: null,
       },
       App\Models\Tagged {#3415
         id: "9",
         tag_id: "3",
         taggable_id: "1",
         taggable_type: "podcast",
         created_at: null,
         updated_at: null,
       },
       App\Models\Tagged {#3416
         id: "10",
         tag_id: "2",
         taggable_id: "1",
         taggable_type: "podcast",
         created_at: null,
         updated_at: null,
       },
     ],
   }
>>> App\Models\Tagged::where('tag_id', 2)->get()
=> Illuminate\Database\Eloquent\Collection {#3385
     all: [
       App\Models\Tagged {#3403
         id: "2",
         tag_id: "2",
         taggable_id: "1",
         taggable_type: "post",
         created_at: null,
         updated_at: null,
       },
       App\Models\Tagged {#3390
         id: "8",
         tag_id: "2",
         taggable_id: "1",
         taggable_type: "podcast",
         created_at: null,
         updated_at: null,
       },
       App\Models\Tagged {#3404
         id: "10",
         tag_id: "2",
         taggable_id: "1",
         taggable_type: "podcast",
         created_at: null,
         updated_at: null,
       },
     ],
   }
>>> App\Models\Tag::find(2)->posts
=> Illuminate\Database\Eloquent\Collection {#4117
     all: [
       App\Models\Post {#4274
         id: "1",
         name: "post1",
         created_at: "2021-07-02 05:53:37",
         updated_at: "2021-07-02 05:53:37",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4119
           tag_id: "2",
           taggable_id: "1",
           taggable_type: "post",
         },
       },
     ],
   }
>>> App\Models\Tag::find(2)->podcasts
=> Illuminate\Database\Eloquent\Collection {#4332
     all: [
       App\Models\Podcast {#3415
         id: "1",
         name: "pod1",
         created_at: "2021-07-02 05:55:54",
         updated_at: "2021-07-02 05:55:54",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#3385
           tag_id: "2",
           taggable_id: "1",
           taggable_type: "podcast",
         },
       },
       App\Models\Podcast {#4118
         id: "1",
         name: "pod1",
         created_at: "2021-07-02 05:55:54",
         updated_at: "2021-07-02 05:55:54",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#4329
           tag_id: "2",
           taggable_id: "1",
           taggable_type: "podcast",
         },
       },
     ],
   }
>>> exit
```