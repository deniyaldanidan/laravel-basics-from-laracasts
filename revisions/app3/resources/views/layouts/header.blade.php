<div class="header">
    <div class="logo">Let's Blog</div>
    <div class="menu">
        <ul>
            <li><a href="{{route('rootindex')}}">Home</a></li>
            <li>Blogs</li>
            @auth
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
                <li>Hi {{Auth::user()->name}}</li>
            @else
                <li><a href="{{ route('login') }}" >Log in</a></li>
                <li><a href="{{ route('register') }}" >Register</a></li>
            @endauth
        </ul>
    </div>
</div>