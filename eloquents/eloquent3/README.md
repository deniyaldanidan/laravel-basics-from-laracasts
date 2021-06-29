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