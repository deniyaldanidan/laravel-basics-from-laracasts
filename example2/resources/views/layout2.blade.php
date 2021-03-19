<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enterprise</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="/css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="/css/fonts.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="/">Wepp</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li><a href="/" accesskey="1" title="">Homepage</a></li>
				<li><a href="{{ route('articles.create') }}" accesskey="2" title="">Create-Article</a></li>
				<li class="{{ Request::is('enterprise*') ? 'current_page_item' : '' }}"><a href="{{ route('enterprise') }}" accesskey="3" title="">About Us</a></li>
				<li class="{{ Request::is('articles*') ? 'current_page_item' : '' }}"><a href="{{ route('articles.all') }}" accesskey="4" title="">Articles</a></li>
				<li><a href="{{ route('contact') }}" accesskey="5" title="">Contact Us</a></li>
			</ul>
		</div>
	</div>
<!--Dynamic content-->
@yield('enterp')
<div id="copyright" class="container">
	<p>&copy; 2021. All rights reserved. | Copyrighted by <a href="/">Wepp</a></p>
</div>
</body>
</html>
