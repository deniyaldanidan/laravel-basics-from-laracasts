@extends('layout')

@section('content')
<div class="container">
  <div class="col align-self-center m-5">
  <form method="POST" action="{{route('articles.store')}}">
    @csrf

    <h2>Create new article</h2>
      <!-- Title input -->
    <div class="form-outline mb-5">
      <input type="text" id="form4Example1" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"
        value="{{old('title')}}"
      />
      <label class="form-label" for="form4Example1">Title</label>
      @error('title')
      <div class="invalid-tooltip">{{ $errors->first('title') }}</div>
      @enderror
    </div>

    <!-- excerpt input -->
    <div class="form-outline mb-5">
      <input type="text" id="form4Example1" class="form-control @error('excerpt') is-invalid @enderror" name="excerpt"
        value="{{old('excerpt')}}"
      />
      <label class="form-label" for="form4Example1">Excerpt</label>
      @error('excerpt')
      <div class="invalid-tooltip">{{ $errors->first('excerpt') }}</div>
      @enderror
    </div>

    <!-- Body input -->
    <div class="form-outline mb-5">
      <textarea class="form-control @error('body') is-invalid @enderror" id="form4Example3" name="body" rows="4">{{old('body')}}</textarea>
      <label class="form-label" for="form4Example3">Body</label>
      @error('body')
      <div class="invalid-tooltip">{{ $errors->first('body') }}</div>
      @enderror
    </div>

    <div class="col-md-1 mb-5">
      <label for="validationCustom04" class="form-label">Tags</label>
      <select multiple class="form-select @error('tags') is-invalid @enderror" id="validationCustom04" aria-label="multiple select example" name="tags[]">
        @foreach ($tags as $tag)
        <option value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach
      </select>
      @error('tags')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Submit</button>
  </form>
  </div>
</div>
@endsection
