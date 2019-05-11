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
}
