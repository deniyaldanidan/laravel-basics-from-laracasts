<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
//use Illuminate\Support\Facades\DB;


class PostsController extends Controller
{
    public function show($slug){
        # use backslash to fetch DB from global space
        #$post = \DB::table('posts')->where('slug', $slug)->first();
        
        $post = Models\Post::where('slug', $slug)->firstOrFail();

        //dd($post->body);
        return view('post', [
            'post'=> $post
        ]);
    }
}
