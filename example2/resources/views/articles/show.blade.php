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
		</div>
	</div>
</div>
<!-- header-wrapper ends here -->
</div>
@endsection
