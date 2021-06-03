@extends('layouts.master')

@section('content')
    <h1>{{$article->title}}</h1>
    <h2>{{$article->excerpt}}</h2>
    <p><strong>{{$article->body}}</strong></p>
    <div style="display: flex; justify-content:end;">
        <a href="{{route('editart',['article'=>$article->id])}}" style="padding-right: 10px;text-decoration:none;"><h4>Edit</h4></a>
        <form method="POST" action="{{route('deleteart',['article'=>$article->id])}}" style="text-decoration:none;">
            @csrf
            @method('delete')
            <h4>
                <button type="submit" style="padding:none; border:none; background:none;font-weight:bold;cursor:pointer">Delete</button>
            </h4>
        </form>
    </div>
@endsection