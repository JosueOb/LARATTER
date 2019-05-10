<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // este atributo guarded nos protege de creación de objetos de forma masiva
    //para crear un objeto se debe indicar que cosas proteger y que no.
    //guarded es una propiedad que contiene un array de las columnas que se van a proteger.
    protected $guarded = [];
}
