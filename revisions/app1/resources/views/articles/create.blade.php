@extends('layouts.master')
@section('content')
<h1 style="margin: auto; width:25%; padding-bottom:3%;">Create new Article</h1>
@include('articles.formstyle')

<form class="form" method="POST" action="{{route('storeart')}}">
    @csrf
    
    <p type="Title:" class="tooltip">
        <input name="title" value="{{old('title')}}">
        @error('title')
            <span style="color:red;font-size:14px;">{{$errors->first('title')}}</span>
        @enderror
    </p>
    
    <p type="Excerpt:">
        <input name="excerpt" value="{{old('excerpt')}}">
        @error('excerpt')
            <span style="color:red;font-size:14px;">{{$errors->first('excerpt')}}</span>
        @enderror
    </p>

    <p type="Body:">
        <textarea name="body" rows="22">{{old('body')}}</textarea>
        @error('body')
            <span style="color:red;font-size:14px;">{{$errors->first('body')}}</span>
        @enderror
    </p>
    
    <div class="but">
        <button type="submit">Submit</button>
    </div>
    
</form>

@endsection