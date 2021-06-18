<li>
    <a href="{{route('showart',['article'=>$item->id])}}">
        <h3>
            {{$item->title}}<br>
            <span style="font-size: 12px">{{$item->excerpt}}</span>
        </h3>
        <p>{{substr($item->body, 0, 150)}}.......</p>
    </a>
        by <strong>{{$item->author->name}}</strong><br>
        @foreach ($item->tags as $tag)
            <span><a href="{{route('allarts', ['category'=>$tag->name])}}">{{$tag->name}}</a></span> &emsp;
        @endforeach
</li>