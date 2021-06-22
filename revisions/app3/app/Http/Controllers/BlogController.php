<?php

namespace App\Http\Controllers;

use App\Models\Blog;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function showBlog(Blog $blog)
    {
        if ($blog->premium && \Auth::guest()) {
            return redirect(route('login'));
        }
        return view('conts.blog', ['blog'=>$blog]);
    }

    public function create()
    {
        return view('conts.createblog', ["tags" => \App\Models\Tag::all()]);
    }

    public function store()
    {
        request()->validate([
            'title'=> 'required|max:240',
            'excerpt'=> 'required|max:290',
            'body'=> 'required|max:60000',
            'tags' => 'required|exists:tags,id'
        ]);
        $blog = auth()->user()->blogs()->create(request(['title', 'excerpt', 'body']));
        if (request('premium')) {
            $blog->premium = true;
            $blog->save();
        }
        $blog->tags()->attach(request('tags'));
        return redirect(route('rootindex'));
    }

    public function edit($blog_id)
    {
        return view('conts.createblog', ['blog' => auth()->user()->blogs()->findOrFail($blog_id)]);
        
    }

    public function update($blog_id)
    {
        request()->validate([
            'title' => 'required|max:240',
            'excerpt' => 'required|max:290',
            'body' => 'required|max:60000'
        ]);
        auth()->user()->blogs()->findOrFail($blog_id)->update(request(['title', 'excerpt', 'body']));
        return redirect(route('showblog', $blog_id));
    }


    public function delete()
    {
        auth()->user()->blogs()->findOrFail(request()->id)->delete();
        return redirect(route('rootindex'));
    }
}
