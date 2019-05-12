@extends('layouts.app')
@section('content')
    {{-- @foreach ($user->follows as $follow)
        <li>{{ $follow->username }}</li>
    @endforeach --}}
    <h1>{{$user->username}}</h1>
    <ul>
        @foreach ($follows as $follow)
            <li>{{ $follow->username }}</li>
        @endforeach
    </ul>
@endsection