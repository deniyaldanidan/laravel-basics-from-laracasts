@extends('layout')

@section('content')
<div class="container">
  <div class="col align-self-center m-5">
  <form method="POST" action="{{route('articles.update',$article->id)}}">
    @csrf
    @method('PUT')
    <h2>Edit article</h2>
      <!-- Title input -->
    <div class="form-outline mb-4">
      <input type="text" id="form4Example1" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" value="{{$article->title}}" />
      <label class="form-label" for="form4Example1">Title</label>
      @error('title')
      <div class="invalid-tooltip">{{ $errors->first('title') }}</div>
      @enderror
    </div>

    <!-- excerpt input -->
    <div class="form-outline mb-4">
      <input type="text" id="form4Example1" class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" name="excerpt" value="{{$article->excerpt}}" />
      <label class="form-label" for="form4Example1">Excerpt</label>
      @error('excerpt')
      <div class="invalid-tooltip">{{ $errors->first('excerpt') }}</div>
      @enderror
    </div>

    <!-- Body input -->
    <div class="form-outline mb-4">
      <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" id="form4Example3" name="body" rows="4" >{{$article->body}}</textarea>
      <label class="form-label" for="form4Example3">Body</label>
      @error('body')
      <div class="invalid-tooltip">{{ $errors->first('body') }}</div>
      @enderror
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Submit</button>
  </form>
  </div>
</div>

@endsection
