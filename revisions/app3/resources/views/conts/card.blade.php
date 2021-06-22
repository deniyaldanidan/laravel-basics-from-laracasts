<a href="{{route('showblog', ['blog'=>$blog->id])}}"><div class="card">
    <h2>{{$blog->title}}</h2>
    <h4>{{$blog->excerpt}}</h4>
    <div class="tags">
        @foreach ($blog->tags as $tag)
            <p>{{$tag->name}}</p>
        @endforeach
    </div>
    <div class="details">
        <p>Published on {{$blog->created_at}}</p>
        <p>by {{$blog->author->name}}</p>
        <p style="text-transform: uppercase">{{$blog->premium ? "premium" : "regular"}}</p>
        <div>
            <p>likes {{$blog->likes->count()}}</p>
            <p>comments {{$blog->comments->count()}}</p>
        </div>
    </div>
    
    
</div></a>
