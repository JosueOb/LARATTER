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
        //se ordena a los mensajes privados de forma descendiente
        return $this->hasMany(PrivateMessage::class)->orderBy('created_at', 'desc');
    }
    public static function between(User $user, User $other){
        //la conversación que se tiene ente los usuarios que se recibe como parametros
        //en caso de que no exista se la va a crear
        $query = Conversation::whereHas('users', function($query) use ($user){
            $query->where('user_id', $user->id);
        })->whereHas('users', function($query) use($other){
            $query->where('user_id', $other->id);
        });
        //firstOrCreate recibe un array de atributos y si existe esa conversación con esos atributos
        //la va a devolver o sino la va a crear con dichos atributos
        //al realizar la query y firstOrCreate garantiza que se va tener una conversación
        $conversation = $query->firstOrCreate([]);

        //se garantiza que esta sincronizada la relación, a los usuarios de la conversación se los va a 
        //sincronizar con el usuario logeado y el otro usuario
        $conversation->users()->sync([
            $user->id,$other->id
        ]);
        return $conversation;
    }
}
