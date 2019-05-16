<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\PrivateMessage;

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
            'user'=>$user,
            'follows'=>$user->follows,
        ]);
    }
    public function followers($username){
        // $user = User::where('username',$username)->firstOrFail();
        $user = $this->findByUsername($username);

        return view('users.follows',[
            'user'=>$user,
            'follows'=> $user->followers,
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
    public function unfollow($username, Request $request){
        $user = $this->findByUsername($username);
        //el usuario loggeado esta en el request
        $me = $request->user();
        //al usuario loggeado que de sus follows se desagrega al usuario que va a seguir
        $me->follows()->detach($user);
        //al retornar se puede agregar un mensaje de exito
        return \redirect("/$username")->withSuccess('Usuario no seguido');

    }

    public function sendPrivateMessage($username, Request $request){
        $user = $this->findByUsername($username);
        $me = $request->user();
        $message = $request->input('message');

        //se obtiene la conversación entre estos dos usuarios
        $conversation = Conversation::create();
        //se utiliza la relación creado en el modelo de Conversation
        $conversation->users()->attach($me);
        $conversation->users()->attach($user);

        //se crea un mensaje privado a la conversación
        $privateMessage = PrivateMessage::create([
            'user_id' => $me->id,
            'conversation_id' => $conversation->id,
            'message'=> $message,
        ]);

        return redirect('/conversations/'.$conversation->id);

    }
    public function showConversation(Conversation $conversation){
        //se carga en conversación sus users y privateMessages metodos definidos 
        //en el modelo de conversation
        //el método load() indica al objeto que venga cargado con los usuarios y mensajes
        $conversation->load('users', 'privateMessages');
        // dd($conversation);

        return view('users.convesation',[
            'conversation'=> $conversation,
            'user'=>auth()->user(),//se envia el usuario logeado, se podrá saber en el template si el
            //mensaje es mío o de la otra persona
        ]);
    }

    // esta función se crea para eficar tener la query en las demás funciones
    private function findByUsername($username){
        return User::where('username',$username)->firstOrFail();
    }

}
