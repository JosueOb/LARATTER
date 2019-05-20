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

        // factory(App\User::class,50)->create()->each(function(App\User $user){
        //     factory(App\Message::class,20)
        //     ->create([
        //         'user_id'=>$user->id
        //     ]);
        // });

        // factory(App\Message::class)
        // ->times(100)//se crearán 100 registros
        // ->create();

        //Lo que se realiza es guardar en una variable los 50 usuarios y por cada usuario
        //siga a 20 usuarios alazar
        //A la función anónima se de la acceso a la variable externa $users para agregar al listado de follows 
        //esos users
        //$users es una colleción de usuarios
        $users = factory(App\User::class,50)->create();
        $users->each(function(App\User $user) use ($users) {
            //se toma a cada mensaje para agergarle entre una o 10 respuestas
            $messages = factory(App\Message::class,20)->create([
                'user_id'=>$user->id
            ]);

            $messages->each(function(App\Message $message) use ($users){
                factory(App\Response::class, random_int(1,10))->create([
                    'message_id'=> $message->id,
                    //se da alazar un user, devolviendo una colección y se toma al primero de dicha colección
                    'user_id'=> $users->random(1)->first()->id,
                ]);
            });
            //se lo pide como método para modificar la relación, ya que no se desea saber a quien sigue
            //para agregar usuarios alazar se utiliza el método sync, es decir, se realiza sincronizando
            // la relación con un array de usuarios, y el random se utiliza para seguir 10 usuarios de la colleción
            $user->follows()->sync(
                $users->random(10)
            );
        });
    }
}
