@extends('layouts.app')
@section('content')
<h1 class="h3">Mensaje id: {{ $message->id }}</h1>
{{-- <img class="img-thumbnail" src="{{ $message->image }}" alt="">
<p class="card-text">{{ $message->content}}
<small class="text-muted"> {{$message->created_at}}</small>
</p> --}}
@include('messages.message')

{{-- Para utilizar Vuej, se utilizan etiquetas que Vue lo va a leer, cuando carge la aplicación
    y lo va a reemplazar  por un HTML generado en el lado del navegador --}}
    {{-- se envia como propiedad de la etiqueta response el id del mensaje --}}
<responses :message="{{ $message->id }}"></responses>
@endsection