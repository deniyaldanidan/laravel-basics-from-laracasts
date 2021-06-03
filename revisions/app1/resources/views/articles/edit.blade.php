@extends('layouts.master')
@section('content')
<h1 style="margin: auto; width:25%; padding-bottom:3%;">Edit Article</h1>
@include('articles.formstyle')

<form class="form" method="POST" action="{{route('updateart',['article'=>$article->id])}}">
    @csrf
    @method('PUT')
    <p type="Title:"><input name="title" value="{{$article->title}}"></p>
    <p type="Excerpt:"><input name="excerpt" value="{{$article->excerpt}}"></p>
    <p type="Body:"><textarea name="body" rows="22">{{$article->body}}</textarea></p>
    <div class="but">
        <button type="submit">Submit</button>
    </div>
    
</form>
@endsection