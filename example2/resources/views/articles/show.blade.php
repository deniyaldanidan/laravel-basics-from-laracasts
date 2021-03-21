@extends('layout2')
@section('enterp')
<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">
				<h2>{{$articles->title}}</h2>
				<span class="byline">{{$articles->excerpt}}</span> </div>
			<p><img src="images/banner.jpg" alt="" class="image image-full" /> </p>
			<p>{{$articles->body}}</p>

			<?php $tgs = $articles->tag->pluck('name'); ?>
			<p>Tags:
				@foreach ($tgs as $value)
					<a href="{{ route('articles.all', ['tag' => $value]) }}"><span>{{$value}}</span></a>
				@endforeach
			</p>

			<a style="background-color:lightblue;color:green;border-radius:50px;font-size: 18px; padding:10px 50px;text-decoration: none;" type="button" href="{{ route('articles.edit', $articles->id) }}" name="button">Edit</a>
		</div>
	</div>
</div>
<!-- header-wrapper ends here -->
</div>
@endsection
