{{-- <img class='img-thumbnail' src="{{ $message['image'] }}"> --}}
{{-- se utilizó el disco pubic y para armar un link a dicho directorio --}}
{{-- <img class='img-thumbnail' src="{{ Storage::disk('public')->url($message->image) }}"> --}}
<img class='img-thumbnail' src="{{ $message->image }}">
{{-- <div class="text-muted">Escrito por {{$message->user_id}}</div> --}}
{{-- se invola la función user que fue definida en el modelo, y como se retorna un objeto
    de la clase User, se utiliza su atributo name --}}
<div class="text-muted">Escrito por <a href="/{{$message->user->username}}">{{$message->user->name}}</a></div>

{{-- <p class='card-text'>{{ $message['content'] }}</p> --}}
<p class='card-text'>{{ $message->content }}
    {{-- <a href="/messages/{{ $message['id'] }}">Leer más</a> --}}
    <a href="/messages/{{ $message->id }}">Leer más</a>
</p>
<div class="card-text text-muted float-right">
    {{$message->created_at}}
</div>