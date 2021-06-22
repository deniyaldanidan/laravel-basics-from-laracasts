@extends('layouts.main')
@section('content')
    @php
        $blogs = auth()->user()->blogs;
        $no = $blogs->count();
    @endphp
    <h1>Total blogs written by {{auth()->user()->name}} are {{$no}}</h1>
    @foreach ($blogs as $blog)
        @include('conts.card')
    @endforeach
@endsection