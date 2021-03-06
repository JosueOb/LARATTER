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
    //método para la busqueda de mensajes
    public function search(Request $request){
        $query = $request->input('query');
        //se utiliza el modelo de mensajes para hacer una busqueda de texto, si se desea realizar en la BDD
        //se tendria que realizar la busqueda con un like para encontrar ese texto en alguna parte de contenido 
        //del mensaje
        // la variable query esta entre comillas y porcentajes, se reliaza para encontrar el texto en cualquier'
        //parte del mensaje
        //en este caso se pide que el mensaje venga con su usuario, y luego la query
        //laravel realiza la primer query y luego para todos los resultados obtenidos 
        //traer los usuarios correspondientes
        //esto evita hacer una query extra por cada resultado obtenido
        // $messages = Message::with('user')->where('content', 'LIKE', "%$query%")->get();
        //la función seach, utiliza laravel scout, que recibe la query, se puede paginar la busqueda 
        //ubicando al último ->paginate()
        //ojo al utilizar with, se esta armando una query, por lo cual no se puede utilizar algolia

        // $messages = Message::with('user')->search($query)->get();

        //para solucionar este problema se separa en dos la query y algolia
        //primero se realiza la busqueda 
        $messages = Message::search($query)->get();
        //a los resultados se pide que se carguen sus usuarios,
        //with sirve para armar una query y load es pra acuando ya se tiene una query ya ejecutada
        $messages->load('user');


        return view('messages.index', [
            'messages'=> $messages
        ]);
    }

    public function responses(Message $message){
        //para devolver un JSON en vez de una vista, para ello se devuelve un objeto Eloquent
        //siendo la manera más fácil de retornar un JSON
        // dd($message->responses);
        //se entrega las respuestas con el usuario que lo escribio
        return $message->responses->load('user');
    }
}

