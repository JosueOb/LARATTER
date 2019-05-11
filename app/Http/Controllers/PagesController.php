<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class PagesController extends Controller
{
    
    public function home(){
        // $messages = Message::all();//trae todos los mensajes
        //con latest() ordena los mensajes donde los últimos sean los primeros, es decir los que recien 
        //se crearon.También se pueden ordenar los mensajes desde la realción en el Modelo
        $messages = Message::latest()->paginate(10);//se indica solo 10 mensajes
        // dd($messages);
        return view('welcome',[
            'messages'=> $messages
        ]);
    }
}
