<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Laravel\Scout\Searchable;

class Message extends Model
{
    //esta manera el modelo esta listo para estar indexado para ser utilizado en argolia
    use Searchable;
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
    //función magica para convertir una propiedad en una función
    //esta función pisa a la funcion del objeto, interceptando el pedido a cualquier propiedad
    //como ejemplo getAvatarAtribute, se intercepta cualquier pedido a una propiedad
    public function getImageAttribute($image){
        //si no se tiene una imagen o empieza con http, se devuelve la image, es decir la url
        //starts_with recibe como parámetros la image y el texto con el que debería empresar
        //
        if(!$image || \starts_with($image, 'http')){
            return $image;
        }
        //caso contrario se retorna la ruta hacia la imgane guardada en Laravel
        return \Storage::disk('public')->url($image);
    }
    //se pisa el método de Searchable, y se le indica que se desea que contenga algolia
    //se devuelve un array
    public function toSearchableArray(){
        //se devuelve un mensaje con su usuario
        //se carga el usuario y luego se devuelve en forma de un array
        $this->load('user');
        return $this->toArray();
    }

    //un mensaje tiene varias repsuestas
    public function responses (){
        // return $this->hasMany(Response::class)->orderBy('created_at', 'desc');
        // latest() es una función ordena por creación descendiente
        return $this->hasMany(Response::class)->latest();
    }
}
