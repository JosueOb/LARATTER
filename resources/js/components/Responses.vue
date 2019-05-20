
<template>
    <div class="row">

        <a href="#"  class="btn btn-outline-primary" v-on:click="load">Ver respuestas</a>

        <!-- directiva de vue -->
        <div class="col-12 mt-2" v-for="response in responses">
            <div class="card">
                <div class="card-header">
                    Escrito por {{response.user.name}}
                </div>
                <div class="card-body">
                    {{ response.message }}
                </div>
                <div class="card-footer text-muted">
                    {{ response.created_at}}
                </div>
            </div>
        </div>
    </div>
</template>
 <script>
 export default {
     //se definen las propiedades
     //no son datos modificables, se los recibe por parametros desde afuera y se cambian desde afuera
     props:[
         'message'
     ],
     //es el estado del componente, se lo puede cambiar pero no desde afuera
     data(){
         return {
             responses: [],
         }
     },
     methods:{
         load(){
            //una petición ajax a traves de promesas, ? this.message el id del message recibido como parametro
             axios.get('/api/messages/'+ this.message +'/responses')
             .then(res =>{
                 this.responses = res.data;
                 console.log(this.responses)
             })//prosesa la procesa la respuesta del pedido, recibe una función
         }
     }
 }
 </script>