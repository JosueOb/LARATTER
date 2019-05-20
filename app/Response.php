<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $guarded = [];

    //RELACIONES
    //una respuesta tiene un usuario
    public function user(){
        return $this->belongsTo(User::class);
    }
    //una respuesta tiene un mensaje
    public function message(){
        return $this->belongsTo(Message::class);
    }
}
