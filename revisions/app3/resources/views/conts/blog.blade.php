@extends('layouts.main')
@section('content')
    @if (auth()->user()->blogs->pluck('id')->contains($blog->id))
        <a href="{{route('editblog', $blog->id)}}">Edit</a>
        
        <form method="POST" action="{{route('deleteblog')}}" style="display:inline;">
            @csrf
            @method('DELETE')
            <input hidden type="text" name="id" value="{{$blog->id}}">
            <button type="submit">DELETE</button>
        </form>

    @endif
    <span style="text-transform: uppercase;font-weight:bold">{{$blog->premium ? "premium" : 'regular'}} content</span>
    <h2>{{$blog->title}}</h2>
    <h3>{{$blog->excerpt}}</h3>
    <p>&emsp;&emsp;&emsp;{{$blog->body}}</p>
    <h4>written by {{$blog->author->name}}</h4>
    <p>About me</p>
    <p style="margin:auto;width:95%">{{$blog->author->profile->about}}</p>
    <p> Tags: 
    @foreach ($blog->tags as $tag)
        {{$tag->name}} 
    @endforeach
    </p>
    @auth
        @if ($blog->likes->pluck('user_id')->contains(auth()->user()->id))
            <form action="{{route('unlike')}}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <input type="text" name="blog_id" value="{{$blog->id}}" hidden>
                <button style="color: red;">{{$blog->likes->count()}} likes</button>
            </form>
        @else
            <form action="{{route('like')}}" method="POST" style="display:inline;">
                @csrf
                <input type="text" name="blog_id" value="{{$blog->id}}" hidden>
                <button>{{$blog->likes->count()}} likes</button>
            </form>
            @endif
        
    @else
        <span>{{$blog->likes->count()}} likes</span>
    @endauth
    
    {{$blog->comments->count()}} comments
    <h3>Comments</h3>
    @foreach ($blog->comments as $comment)
        <div style="margin-bottom: 80px">
            <h4 style="margin-bottom:0px;text-transform:uppercase;">{{$comment->user->name}}</h4>
            <span style="font-size:0.7rem;">commented at {{$comment->created_at}}</span>
            <p style="margin:auto;width:95%; margin-top:12px;">{{$comment->content}}</p>
            @if (auth()->user()->id == $comment->user_id)
                <form method="POST" action="{{route('delcomment')}}">
                    @csrf
                    @method('DELETE')
                    <input type="text" name="id" value="{{$comment->id}}" hidden>
                    <input type="text" name="blogid" value="{{$blog->id}}" hidden>
                    <button type="submit">Delete</button>
                </form>
            @endif
            <hr>
        </div>
    @endforeach
    @auth
        <h4>Submit you comment here:</h4>
        <form action="{{route('comment')}}" method="POST">
            @csrf
            <input type="text" name="blog_id" value="{{$blog->id}}" hidden>
            <textarea name="content" cols="120" style="background-color:lightgray"></textarea>
            <button type="submit">Comment</button>
        </form>
    @else
        <a href="{{route('login')}}" style="color: lightblue">Sign in </a>to comment/like in the blog.
    @endauth
    

@endsection