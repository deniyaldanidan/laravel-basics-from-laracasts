<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    /*
    public function getRouteKeyName()
    {
      return 'title';
      // use this one if you want to fetch articles by title not by id
      // note title has to be unique
    }
    */
    protected $fillable = ['title', 'excerpt', 'body']; // to avoid mass assignment vulnerability

    public function path()
    {
      // return path of the current article
      return route('articles.show', $this);
    }

    public function author()
    {
      // code...
      return $this->belongsTo(User::class,'user_id'); // select * from user where article_id=this->id
    }

    public function tag(){
      return $this->belongsToMany(Tag::class)->withTimestamps();
    }

}


// to get user of the current article we need
// $article->user;

// an article has many tags
// tag belongs to many articles
