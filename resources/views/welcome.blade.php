<!-- Se vincula al layout app, se extiende del archivo especificado-->
@extends('layouts.app')
<!-- Section nos permite agregar los elementos que contiene, pinsando a una de las 
secciones especificadas en el layout-->
@section('content')
<div class="jumbotron text-center">
    <h1>Laratter</h1>
    <nav >
        <ul class='nav nav-pills'>
            <li class='nav-item'>
                <a class='nav-link' href="/">Home</a>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
<!-- Forelse nos permite recorrer un arreglo y mostrarlos, y en el caso de que no se tenga
ningún arreglo, entraría al apartado de empty -->
    @forelse($messages as $message)
    <div class="col-6">
        {{-- <img class='img-thumbnail' src="{{ $message['image'] }}"> --}}
        <img class='img-thumbnail' src="{{ $message->image }}">
        {{-- <p class='card-text'>{{ $message['content'] }}</p> --}}
        <p class='card-text'>{{ $message->content }}</p>
        {{-- <a href="/messages/{{ $message['id'] }}">Leer más</a> --}}
        <a href="/messages/{{ $message->id }}">Leer más</a>
    </div>
    @empty
        <p>No hay mensajes destacados</p>
    @endforelse
</div>
@endsection