<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // factory(App\Message::class,100)->create(); //se crearán 100 registros
        // Lo que se realiza es crear 50 usuarios y por cada usuario se le agrega
        // 20 mensajes, donde en cada user_id de message se le agrega el id del usuario al que pertenece
        factory(App\User::class,50)->create()->each(function(App\User $user){
            factory(App\Message::class,20)
            ->create([
                'user_id'=>$user->id
            ]);
        });
        // factory(App\Message::class)
        // ->times(100)//se crearán 100 registros
        // ->create();
    }
}
