<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Gate = Puerta, sirve para definir ciertas reglas de autorización
        //se define una regla, para ello se define una clave y una función anónima
        //que recibe como parámetros el usuario logeado y el usuario al que se le enviará el mensaje
        //privado
        Gate::define('dms',function(User $user, User $other){
            //la regla debe se que los usuarios que se deseen enviar un mensaje
            //deben seguirse mutuamente
            return $user->isFollowing($other) && $other->isFollowing($user);
        });
    }
}
