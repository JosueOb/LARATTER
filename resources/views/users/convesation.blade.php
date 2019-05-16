@extends('layouts.app')
@section('content')
    {{-- Para indicar ,en base a una convesación y un listado de usuario, quién no somos nosotros
        para ellos se utiliza los métodos de filtro de una colección en Laravel
        //se utiliza el método expect() nos permite armar una nueva colección con todos los datos expecto uno en específico, utilizando
        el id de nuestros objetos, por tal motivo se le indica el id del usuario logeado
        El método implode() convierte una colección de objetos en string, recibe dós parámetros siendo la propiedad del objeto
        se que tiene internamente en esta colleción , si se desea unir los usuario por el nombres, se inica 'name' y el segundo
        es el separador entre nombres
        --}}
    <h1>Conversación con {{ $conversation->users->except($user->id)->implode('name',', ') }}</h1>
    @foreach ($conversation->privateMessages as $message)
        <div class="card">
            <div class="card-header">
                {{ $message->user->name }} dijo...
            </div>
            <div class="card-text">
                {{ $message->message}}
            </div>
            <div class="card-footer">
                {{ $message->created_at}}
            </div>
        </div>
    @endforeach
        
@endsection