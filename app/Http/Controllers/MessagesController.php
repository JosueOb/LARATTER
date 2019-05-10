<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Http\Requests\CreateMessageRequest;

class MessagesController extends Controller
{
    
    public function show(Message $message){
        // $message = Message::find($id);
        return view('messages.show',[
            'message'=> $message
        ]);
    }

    // Al utilizar la clase CreateMessageRequest, es la clase que permite validad al mismo request
    // no permitirá ejecutar el código que esta dentro de la función, sino indicar los errores presnetados
    public function create(CreateMessageRequest $request){
        // dd($request->all());//contiene el token y message
        // $validateData = $request->validate([
        //     'message'=>'required|max:160'
        // ],[
        //     'message.required'=> 'Por favor, escribe tu mensaje.',
        //     'message.max'=>'El mensaje no puede superar los 160 caracteres.'
        // ]);
        // return 'Creación de mensaje';
        $message = new Message();
        $message->content = $request->get('message');
        $message->image = 'http://lorempixel.com/600/330?'.mt_rand(0,1000);
        $message->save();
        // dd($message);
        return \redirect('/messages/'.$message->id);
    }
}
