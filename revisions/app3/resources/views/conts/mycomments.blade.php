@extends('layouts.main')
@section('content')
    @php
        $comments = auth()->user()->comments;
        $no = $comments->count();
    @endphp
    <h1>Total commented blogs are {{$no}}</h1>
    @foreach ($comments as $comment)
        @php
            $blog = $comment->blog;
        @endphp
        @include('conts.card')
    @endforeach
@endsection