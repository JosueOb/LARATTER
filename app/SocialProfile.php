<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class SocialProfile extends Model
{
    //protege los datos de la BDD
    protected $guarded = [];

    public function user(){
        //se indica que un perfil pertenece solo a un solo usuario
        return $this->belongsTo(User::class);
    }
}
