@extends('layouts.master')

@section('content')

<h1>This is the test page</h1>
<div>
    <h4>{{$name}}</h4>
    <p>{!! $name !!}</p>
    <p>Add ?name=somethin in the url</p>
</div>

@endsection

<!--
<div style="padding: 10%; background-color:white;color:black;">

</div>
-->