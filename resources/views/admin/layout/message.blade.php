
@if(session('message'))
    <div class="alert text-center alert-{{session('message')['type']}}">
        @foreach(session('message')['text'] as $text)
            <p class="mb-0">{{$text}}</p>
        @endforeach
    </div>
@endif
