@extends('layouts.app')

@section('content')
    <h1>{{$user->name}}</h1>
    <a href="/{{$user->username}}/follows" class="btn btn-link">Sigue a <span class="badge badge-info">{{ $user->follows->count() }}</span></a>
    <a href="/{{$user->username}}/followers" class="btn btn-link">Siguidores <span class="badge badge-info">{{ $user->followers->count() }}</span></a>

    {{-- se verifica que el usuario este loggeado --}}
    @if (Auth::check())
    {{-- para utilizar una regla definida en la parte de providers AuthServiceProvider --}}
        @if (Gate::allows('dms', $user))
        <form action="/{{ $user->username }}/dms" method="POST">
            @csrf
            <input type="text" name="message" class="form-control">
            <button class="btn btn-success" type="submit">Enviar DM</button>
        </form>
            
        @endif

    {{-- Se verifica que si el usuario loggeado ya sigue o no un determinado usuario --}}
        @if (Auth::user()->isFollowing($user))
            <form action="/{{ $user->username }}/unfollow" method="POST">
                @csrf
                {{-- se muestra el mensaje de exito --}}
                @if (session('success'))
                    <span class="text-success"> {{ session('success') }} </span>
                @endif
                <button class="btn btn-danger">Dejar de seguir</button>
            </form>
        @else
            <form action="/{{ $user->username }}/follow" method="POST">
                @csrf
                {{-- se muestra el mensaje de exito --}}
                @if (session('success'))
                    <span class="text-success"> {{ session('success') }} </span>
                @endif
                <button class="btn btn-primary">Seguir</button>
            </form>
        @endif
    
    @endif

    <div class="row">
        @foreach ($user->messages as $message)
        <div class="col-6">
            @include('messages.message')
        </div>
        @endforeach
    </div>
@endsection