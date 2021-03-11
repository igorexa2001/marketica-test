
<div>
    <h2>
        @foreach($breadcrumbs as $title => $link)
            @if($loop->last)
                {{$title}}
                @break
            @endif
            <a href="{{$link}}">{{$title}}</a> |
        @endforeach
    </h2>
</div>
