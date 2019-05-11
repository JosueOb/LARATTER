<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{
    // este atributo guarded nos protege de creación de objetos de forma masiva
    //para crear un objeto se debe indicar que cosas proteger y que no.
    //guarded es una propiedad que contiene un array de las columnas que se van a proteger.
    protected $guarded = [];

    //se crea una función en la cuál indica la relación que se tiene entre el mensaje y usuario
    //se busca en la tabla message el id del usuario, y lo relaciona con el modelo de User
    //se devuelve el usuario al que pertenece el mensaje
    public function user(){
        return $this->belongsTo(User::class);
    }
}
