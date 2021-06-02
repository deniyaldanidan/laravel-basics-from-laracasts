<div id="header-wrapper">
    <div id="header" class="container">
        <div id="logo">
            <h1><a href="/">securebreads</a></h1>
        </div>
        <div id="menu">
            <ul>
                <li class="{{Request::path() == "/" ? 'current_page_item': ''}}"><a href="/" accesskey="1" title="">Homepage</a></li>
                <li class="{{Request::is("test*") ? 'current_page_item': ''}}"><a href="/test" accesskey="2" title="">Test</a></li>
                <li class="{{Request::is("articles*") ? 'current_page_item': ''}}"><a href="/articles" accesskey="3" title="">Articles</a></li>
                <li class="{{Request::is("article/*") ? 'current_page_item': ''}}"><a href="/article/create" accesskey="4" title="">New Article</a></li>
                <li><a href="#" accesskey="5" title="">Contact Us</a></li>
            </ul>
        </div>
    </div>
</div>