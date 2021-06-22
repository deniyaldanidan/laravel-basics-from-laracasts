@extends('layouts.main')
@section('content')
    @php
        $likes = auth()->user()->likes;
        $no = $likes->count();
    @endphp
    <h1>Total liked blogs are {{$no}}</h1>
    @foreach ($likes as $like)
        @php
            $blog = $like->blog;
        @endphp
        @include('conts.card')
    @endforeach
@endsection