<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class PagesController extends Controller
{
    
    public function home(){
        // $messages = Message::all();//trae todos los mensajes
        $messages = Message::paginate(10);//se indica solo 10 mensajes
        // dd($messages);
        return view('welcome',[
            'messages'=> $messages
        ]);
    }
}
