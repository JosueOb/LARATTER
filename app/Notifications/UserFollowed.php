<?php

namespace App\Notifications;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Notifications\Messages\BroadcastMessage;

class UserFollowed extends Notification
{
    use Queueable;
    //dependencias se las trae en entidades publicas
    public $follower;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $follower)
    {
        //
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //por donde se notifica el usuario
        //database indica a laravel que guarde la notificación en la BDD
        //se habilita boardcasting 
        return ['mail', 'database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // se envia el correo
        return (new MailMessage)
                    ->subject('Tienes un nuevo seguidor')
                    ->greeting('Hola, '.$notifiable->name)//se obtiene el nombre del usuario que va a recibir el correo
                    ->line('El usuario @'.$this->follower->username.'te ha seguido')
                    ->action('Ver perfil', url('/'.$this->follower->username))
                    ->line('Gracias por usar Laratter');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        //este array permite enviar datos en el campo data al guardarlo en la BDD
        //en formaro json
        return [
            'follower' => $this->follower,
        ];
    }
    //se tiene que convertir el mensaje a toBrodcast
    public function toBroadcast($notifiable){
    //devuelve un objeto BroadcastMessage, siendo un objeto que se puede serializar 
    //y que laravel lo va a usar para enviar desde el server hacia los clientes'
    //el único parámetro que tiene en construcción es un arrray de datos, se utiliza el array de toArray
    //es decir, se comparte los datos que se guarda en la BDD y se hace broadcast 

    
    //se agrega la key data para que sea compactive con la api y pusher 
        return new BroadcastMessage([
            'data'=>$this->toArray($notifiable),
        ]);
    }
}
