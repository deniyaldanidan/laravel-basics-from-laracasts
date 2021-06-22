@extends('layouts.main')
@section('content')
    @foreach ($blogs as $blog)
        @include('conts.card')
    @endforeach
@endsection
