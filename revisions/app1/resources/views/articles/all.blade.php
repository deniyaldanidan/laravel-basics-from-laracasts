@extends('layouts.master')
@section('content')
@include('articles.searchBox')
<ul class="style1">
    @foreach ($articles as $item)
        @include('articles.card')
    @endforeach
    <h4>
        <a href="{{$previous}}" {{$previous==''?'hidden':''}}>Previous</a>
        &emsp;
        <span>Pages: {{$current}}/{{$npages}}<span>
        &emsp;
        <a href="{{$next}}" {{$next==''?'hidden':''}}>next</a>
    </h4>
</ul>

@endsection

