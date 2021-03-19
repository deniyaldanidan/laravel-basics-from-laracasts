@extends('layout2')
@section('enterp')
<!-- header-wrapper ends here -->
</div>
<div id="wrapper">
	<div id="page" class="container">
		<h1>All Articles</h1>

    @foreach ($articles as $value)
		<a href="{{route('articles.show', $value->id)}}"><div id="content">
			<div class="title">
				<h2>{{$value->title}}</h2>
				<span class="byline">{{$value->excerpt}}</span>
        </div>
		</div></a>
    @endforeach
	</div>
<?php
	$total = $total/3;
	$total = (int)$total;
	$total = $total+2;
?>
  <h3 style="text-align:center">Page:
    @for ($i=1; $i < $total; $i++)
    <a href="?page={{$i}}" style="text-decoration:none"><span {{ $i==$current_page ? 'style=color:red;' : '' }}>{{$i}}</span></a>
    @endfor
  </h3>

</div>

@endsection
