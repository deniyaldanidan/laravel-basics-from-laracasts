@extends('layout2')
@section('enterp')
<!-- header-wrapper ends here -->
</div>
<div id="wrapper">
	<div id="page" class="container">

    @foreach ($articles as $value)
		<a href="articles/{{$value->id}}"><div id="content">
			<div class="title">
				<h2>{{$value->title}}</h2>
				<span class="byline">{{$value->excerpt}}</span>
        </div>
		</div></a>
    @endforeach

	</div>
  <h3 style="text-align:center">Page:
    @for ($i=0; $i < $total; $i++)
    <a href="?page={{$i+1}}" style="text-decoration:none"><span {{ $i+1==$current_page ? 'style=color:red;' : '' }}>{{$i+1}}</span></a>
    @endfor
  </h3>

</div>

@endsection
