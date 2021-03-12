<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function retrieve($postId)
    {
      $post = \DB::table('posts')->where('slug', $postId)->first();
      //dd($post->body);
      return view('posts', [
        "blogHead" => $postId,
        "body" => $post->body
    ]);
    }
}
