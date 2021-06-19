<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Let's Blog</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    @include('layouts.header')
    <div class="main">
        @yield('content')
    </div>
    @include('layouts.footer')
</body>
</html>