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

    data(){
        return {
            notifications: [],
        }
    },
    //se realiza un pedido automático cuando se termina de cargar la página
    mounted(){
        //no se le envía ningún parámetro a get /api/notifications porque se utiliza la sesión 
        //para saber quien es el usuario logeado y saber que notificaciones devolver.
        axios.get('/api/notifications')
        .then(response => {
            this.notifications = response.data;
        })
    }
}
</script>