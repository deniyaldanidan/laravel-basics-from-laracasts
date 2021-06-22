@extends('layouts.main')

@section('content')
    @php
        $edit = url()->current()==route('blogcreate') ? false : true;
    @endphp
    @if ($edit)
        <h2>Edit</h2>
    @else
        <h2>Create new blog</h2>
    @endif
    <form method="POST" action="{{$edit ? route('updateblog', $blog->id) : route('blogstore')}}">
        @csrf
        @if ($edit)
            @method('PUT')
        @endif
        <div>
            <p>Title</p>
            <input type="text" name="title" value="{{$edit ? $blog->title : old('title')}}">
            @error('title')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div>
            <p>Excerpt</p>
            <input type="text" name="excerpt" value="{{$edit ? $blog->excerpt : old('excerpt')}}">
            @error('excerpt')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div>
            <p>body</p>
            <textarea name="body" cols="100" rows="10"  >{{$edit ? $blog->body : old('body')}}</textarea>
            @error('body')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        @if ($edit)
            
        @else
        <div>
            <input type="checkbox" name="premium" {{old('premium') ? "checked" : ""}}> Premium
            @error('premium')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div>
            <select name="tags[]" multiple>
                @foreach ($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
            @error('tags')
                <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        @endif

        
        <button type="submit" class="btn">submit</button>
        
    </form>
@endsection