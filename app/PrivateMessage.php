<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{
    //se permite que se cree un mensaje con todos los parámetros necesarios
    protected $guarded = [];

    //relación en donde se indica que un mesaje privado pertenece a una usuario
    public function user(){
        return $this->belongsTo(User::class);
    }
}
