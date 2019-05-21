<template>
    <div class="dropdown-menu">
        <!-- se enlaza a cada notificación al nombre del usuarion que te sigue -->
        <a :href="'/'+notification.data.follower.username" class="dropdown-item" v-for="notification in notifications">
            @{{ notification.data.follower.username }} te ha seguido!
        </a>
    </div>
</template>
<script>
export default {
    props:['user'],
    data(){
        return {
            notifications: [],
        }
    },
    //se realiza un pedido automático cuando se termina de cargar la página
    mounted(){
        //no se le envía ningún parámetro a get /api/notifications porque se utiliza la sesión 
        //para saber quien es el usuario logeado y saber que notificaciones devolver.

        //cuando se recibe la respuesta desde api, es la misma estructura de la BDD, por lo que tiene una columna
        //data, sin embargo, la notificación que se esta enviando no tiene la misma estructura, ya que falta
        //una key data, para que sea compactible entre la api y el mensaje que manda pusher, esto
        //se lo corrige en la clase UserFollowed en su método toBroadcast()
        axios.get('/api/notifications')
        .then(response => {
            this.notifications = response.data;
            //se configura el listener
            //cuando se completa el pedido, se establece un canal privado para este usuario
            //se utiliza el namespace de la clase, y se aprovecha que  a este notificación.view se le esta pasándo
            //por parámetro el user, que se lo tiene como propiedad, que es enviada desde el blade de app como :user
            Echo.private(`App.User.${this.user}`)
            .notification(notification =>{
                //en ese canal privado se van a escuchar las notifications y luego por cada una de ellas se va 
                //a ejecutar lo siguiente, se va a colocar a la notificación primero 
                //unshit permite que las notificaciones más nuevas aparezcan al comienzo
                this.notifications.unshift(notification);
            });
        });

    }
}
</script>