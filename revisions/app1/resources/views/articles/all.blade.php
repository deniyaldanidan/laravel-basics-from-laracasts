@extends('layouts.master')
@section('content')
@include('articles.searchBox')
<ul class="style1">
    @forelse ($articles as $item)
        @include('articles.card')
    @empty
        <h2>There's no article available</h2>
    @endforelse
    @if ($paginated)
        <h4>
            <a href="{{$previous}}" {{$previous==''?'hidden':''}}>Previous</a>
            &emsp;
            <span>Pages: {{$current}}/{{$npages}}<span>
            &emsp;
            <a href="{{$next}}" {{$next==''?'hidden':''}}>next</a>
        </h4>
    @else
        
    @endif
    
</ul>

@endsection

