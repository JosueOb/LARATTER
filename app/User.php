<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Message;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relación, en donde se indica que el modelo de usuarios que otro modelo (mensaje) tiene su id
    //es decir, que otro modelo tiene su id
    public function messages(){
        //se puede preconfigurar una relación para que siempre este ordenada de una forma
        //se ordena basandose en el campo created_at de forma descendiente
        return $this->hasMany(Message::class)->orderBy('created_at','desc');
    }
    //esta relación permitirá conocer los usuarios que sigue un usuario 
    public function follows(){
        // recibe el modelo, la tabla, la foreign key y la related key
        //de esta forma se busca los otros usuarios, en donde yo soy el user_id 
        //y los follws son los otros, es decir, yo los sigo a ellos
        //seguidos
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'followed_id');
    }
    //esta relación permitirá conocer mis seguidores
    public function followers(){
        //yo soy el que es seguido, dime quien son los que me siguen
        //seguidores
        return $this->belongsToMany(User::class, 'followers', 'followed_id','user_id');
    }
}
