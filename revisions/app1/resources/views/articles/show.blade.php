@extends('layouts.master')

@section('content')
    <h1>{{$article->title}}</h1>
    <h2>{{$article->excerpt}}</h2>
    <p><strong>{{$article->body}}</strong></p>
    <a href="/article/edit/{{$article->id}}"><h4>Edit</h4></a>
@endsection