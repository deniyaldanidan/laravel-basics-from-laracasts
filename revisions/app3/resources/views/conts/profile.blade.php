@extends('layouts.main')
@section('content')
    @if (auth()->user()->profile == null)
        @include('conts.createprofile')
    @else
    @php
        $profile = auth()->user()->profile;
        $username = auth()->user()->name;
    @endphp
    <h2 style="text-transform: uppercase">{{$username}}'s profile</h2>
    <div style="margin:auto;width:80%;padding:30px 0px; font-size:1.2rem">
        <p>First name:&emsp;{{$profile->firstname}}</p>
        <p>Last name:&emsp;{{$profile->lastname}}</p>
        <p>Country:&emsp;{{$profile->country}}</p>
        <p>City:&emsp;{{$profile->city}}</p>
        <p>State:&emsp;{{$profile->state}}</p>
        <p>Twitter:&emsp;{{$profile->twitter}}</p>
        <p>Instagram:&emsp;{{$profile->instagram}}</p>
        <p>Birth Date:&emsp;{{$profile->birthdate}}</p>
        <p>Job title:&emsp;{{$profile->occupation}}</p>
        <p>Working in:&emsp;{{$profile->company}}</p>
        <p style="text-transform: uppercase">Gender:&emsp;{{$profile->gender}}</p>
        <p>About me:&emsp;{{$profile->about}}</p>
        <p>Phone:&emsp;{{$profile->phone}}</p>
        <p>Liked blogs:&emsp;<a href="{{route('mylikes')}}" style="color:burlywood;">{{auth()->user()->likes->count()}}</a></p>
        <p>Total comments:&emsp;<a href="{{route('mycomments')}}" style="color:burlywood;">{{auth()->user()->comments->count()}}</a></p>
        <p>My blogs:&emsp;<a href="{{route('myblogs')}}" style="color:burlywood;">{{auth()->user()->blogs->count()}}</a></p>
    </div>
    @endif
    
@endsection