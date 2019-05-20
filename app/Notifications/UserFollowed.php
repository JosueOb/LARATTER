<?php

namespace App\Notifications;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

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
        return ['mail'];
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
        return [
            //
        ];
    }
}
