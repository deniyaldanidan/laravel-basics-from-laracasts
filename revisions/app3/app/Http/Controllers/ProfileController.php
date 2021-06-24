<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function myprofile()
    {
        return view('conts.profile');
    }
    public function mylikes()
    {
        return view('conts.mylikes');
    }
    public function mycomments()
    {
        return view('conts.mycomments');
    }
    public function myblogs()
    {
        return view('conts.myblogs');
    }

    public function unlike()
    {
        $blogid = request('blog_id');
        if (auth()->user()->likes->pluck('blog_id')->contains($blogid)) {
            \App\Models\Like::where('blog_id',$blogid)->where('user_id',auth()->user()->id)->delete();
            return redirect(route('showblog', $blogid));
        } else {
            return redirect(route('showblog',$blogid));
        }
    }

    public function like()
    {
        $blogid = request('blog_id');
        if (auth()->user()->likes->pluck('blog_id')->contains($blogid)) {
            return redirect(route('showblog', $blogid));
        } else {
            \App\Models\Like::create([
                "blog_id" => $blogid,
                "user_id" => auth()->user()->id
            ]);
            return redirect(route('showblog',$blogid));
        }
    }
    
    public function comment()
    {   
        $validatedArts=request()->validate([
            'blog_id' => ['required', 'numeric'],
            'content' => 'required'
        ]);
        auth()->user()->comments()->create($validatedArts);
        return redirect(route('showblog',request('blog_id')));
    }

    public function delcomment()
    {
        $comm = \App\Models\Comment::find(request('id'));
        if ($comm->user_id == auth()->user()->id) {
            $comm->delete();
            return redirect(route('showblog', request('blogid')));
        } else {
            return redirect(route('showblog', request('blogid')));
        }
        
    }

    public function store()
    {
        if (auth()->user()->profile != null) {
            return redirect(route('rootindex'));
        }
        // dd(request()->all());
        $data = auth()->user()->profile()->create($this->validateprofile());
        return redirect(route('profilepage'));
    }

    public function edit(){
        return view('conts.editprofile', ['edit'=>true, 'profile' => auth()->user()->profile]);
    }

    public function update()
    {
        auth()->user()->profile()->update($this->validateprofile());
        return redirect(route('profilepage'));
    }

    protected function validateprofile(){
        return request()->validate([
            'firstname' => 'required|alpha|max:95',
            'lastname' => 'required|alpha|max:95',
            'country' => 'required|alpha_num|max:95',
            'state' => 'required|alpha_num|max:95',
            'city' => 'required|alpha_num|max:95',
            'twitter' => 'max:45',
            'instagram' => 'max:45',
            'birthdate' => 'required|date',
            'occupation' => 'max:195',
            'company' => 'max:195',
            'about' => 'max:490',
            'gender' => ['required', Rule::in(['male', 'female'])],
            'phone' => 'max:19'
        ]);
    }

    public function deleteme(){
        auth()->user()->delete();
        return redirect(route('rootindex'));
    }
}
