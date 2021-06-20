@extends('layouts.main')

@section('content')

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <label for="email">Email-here</label>

        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <strong>{{ $message }}</strong>
        @enderror
    </div>

    <div>
        <label for="password">Password-here</label>
        <input id="password" type="password" name="password" required autocomplete="current-password">
        @error('password')
            <strong>{{ $message }}</strong>
        @enderror
    </div>
    <div>
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember"> Remember me </label>
    </div>  
    <button type="submit" class="btn">Log in</button>

    @if (Route::has('password.request'))
    <a href="{{ route('password.request') }}">Forget Your password</a>
    @endif
</form>

@endsection
