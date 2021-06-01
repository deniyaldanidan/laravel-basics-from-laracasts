<div id="header-wrapper">
    <div id="header" class="container">
        <div id="logo">
            <h1><a href="#">SimpleWork</a></h1>
        </div>
        <div id="menu">
            <ul>
                <li class="{{Request::path() == "/" ? 'current_page_item': ''}}"><a href="/" accesskey="1" title="">Homepage</a></li>
                <li class="{{Request::is("test*") ? 'current_page_item': ''}}"><a href="/test" accesskey="2" title="">Test</a></li>
                <li><a href="#" accesskey="3" title="">About us</a></li>
                <li><a href="#" accesskey="4" title="">Blogs</a></li>
                <li><a href="#" accesskey="5" title="">Contact Us</a></li>
            </ul>
        </div>
    </div>
</div>