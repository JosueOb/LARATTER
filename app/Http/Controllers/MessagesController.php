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
        $user = $request->user();//se obtiene el usuario loggeado
        $image = $request->file('image');//se obtiene un objeto file que representa a la imagen subida en el formulario
        $message = new Message();
        $message->content = $request->get('message');
        //se guarda la imagen en una carpeta, como segundo parámetro es el nombre de la carpeta, el método store entraga un link a la imagen guardada por laravel, 
        //el nombre es alazar para evitar colisiones de nombre
        //el primer parámetro es el nombre de la carpeta a crear para guardar las imagenes y el segundo el nombre 
        //de la carpeta que contendrá a la primera carpeta
        $message->image = $image->store('messages', 'public');
        $message->user_id = $user->id;
        $message->save();
        // dd($message);
        return \redirect('/messages/'.$message->id);
    }
}
