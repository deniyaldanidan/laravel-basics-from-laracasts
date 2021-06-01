@extends('layouts.master')

@section('content')
<div style="padding: 10%; background-color:white;color:black;">
    <h1>{{$post->slug}}</h1>
    <p>{{$post->body}}</p>
</div>
    
@endsection



