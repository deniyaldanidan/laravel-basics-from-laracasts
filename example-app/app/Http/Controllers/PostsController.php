<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function retrieve($postId)
    {
    //  $post = \DB::table('posts')->where('slug', $postId)->first();
    $post = Post::where('slug', $postId)->firstOrFail();
      //dd($post->body);
      // if the blog is not there abort
      /*
      if (! $post) {
        abort(404);
      }
      */
      return view('posts', [
        "blogHead" => $postId,
        "body" => $post->body
    ]);
    }
}
