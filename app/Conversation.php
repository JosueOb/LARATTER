<?php

namespace App;
// use App\User;
// user App\

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
    public function users(){
        //esta relación indica que una conversatión pertenece a varios usuarios
        return $this->belongsToMany(User::class);
    }
    //relacion para desplegar los mensajes de una conversación
    //relación en donde una conversación tiene varios mensajes privados
    public function privateMessages(){
        return $this->hasMany(PrivateMessage::class);
    }
}
