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
}
