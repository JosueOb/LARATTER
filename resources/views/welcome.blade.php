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
    <form action="/messages/create" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="message" class="form-control" placeholder="Qué estás pensando?">
            <!--la variable contiene un objeto de tipo messageBack, que contiene con todos los errores presentados-->
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </form>
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

    <!--Se verifica si se tiene más de un mensage, ojo solo cuando se utiliza el método de paginación
    se obtiene el método links() que se agrena al objeto en el que se le aplica la paginación, 
    no se obtiene este método si se consulta todos los mensajes all(), o si se realiza una query
    al agregar el método links se aplica el template de paginación de bootsatrap-->
    @if(count($messages))
    <div class="mt-2 mx-auto">
        {{ $messages->links() }}
    </div>
    @endif
</div>
@endsection