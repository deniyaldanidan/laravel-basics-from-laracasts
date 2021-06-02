@extends('layouts.master')

@section('content')
<h1>{{$post->slug}}</h1>
<p>{{$post->body}}</p>
    
@endsection



