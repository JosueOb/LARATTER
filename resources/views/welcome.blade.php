<!-- Se vincula al layout app, se extiende del archivo especificado-->
@extends('layouts.app')
<!-- Section nos permite agregar los elementos que contiene, pinsando a una de las 
secciones especificadas en el layout-->
@section('content')
    <div class="title m-b-md">
        Laratter my first web system by Platzi
    </div>

    <div class="links">
    @if(isset($links))
        @foreach ( $links as $link => $text)
            <a href="{{ $link }}" target='_blank'>{{ $text }}</a>
        @endforeach
    @else
        <p>No se encuentran los links</p>
    @endif
    </div>
@endsection