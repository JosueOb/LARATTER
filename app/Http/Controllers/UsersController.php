<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function show($username){
        // $user = User::where('username',$username)->firstOrFail();
        $user = $this->findByUsername($username);
        // dd($user);
        return view('users.show',[
            'user'=> $user
            ]);
        }

    public function follows($username){
        // $user = User::where('username',$username)->firstOrFail();
        $user = $this->findByUsername($username);

        return view('users.follows',[
            'user'=>$user
        ]);
    }
    
    public function follow($username, Request $request){
        $user = $this->findByUsername($username);
        //el usuario loggeado esta en el request
        $me = $request->user();
        //al usuario loggeado que de sus follows le agrega al usuario que va a seguir
        $me->follows()->attach($user);
        //al retornar se puede agregar un mensaje de exito
        return \redirect("/$username")->withSuccess('Usuario seguido');

    }

    // esta función se crea para eficar tener la query en las demás funciones
    private function findByUsername($username){
        return User::where('username',$username)->firstOrFail();
    }
}
