<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-6">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>Categoria</small>
          </div>
          <form action="" >

          <div class="col-sm-12"><span v-for="error in errors" class="text-danger">{{ error }}<br></span></div>
  

          <div class="row">
            <div class="col-sm-12">
              <b-form-fieldset label="Nombre">
                <input type="text" class="form-control" name="name" v-model="name" placeholder="Ingrese nombre"></input>
              </b-form-fieldset>
            </div>
          </div>
    

          <div class="form-actions">
              <b-button v-if="ventana === 'Crear'" @click.prevent="submit" variant="success">Guardar</b-button>
              <b-button v-if="ventana === 'Editar'" @click.prevent="edit" variant="success">Editar</b-button>
              <router-link :to="{ name: 'Categorias'}">
                <b-button type="button" variant="secondary">Regresar</b-button>
              </router-link>
          </div>

          </form>

        </b-card>
      </div>
      <div class="col-sm-3"></div> 
      <toast-container></toast-container>
    </div>
   
  </div>
</template>

<script>

import VueOnToast from 'vue-on-toast'
import constSystem from '../../_const';
export default {
  name: 'category-form',
  components: {
    VueOnToast
  },
  data () {
    return {
      errors: [],
      name:'',
      ruta: this.$route.name,
      ventana:'',
      permisos : this.$store.getters.permisos,
      maestroo: constSystem.MAESTRO_CATEGORIAS,
    }
  },
  mounted: function() {


    if (this.ruta === 'EditarCategoria') {

      this.ventana = 'Editar';
      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

      this.$store.dispatch('categoryById', { id: this.$route.params.id})
        .then(({data}) => {

           this.name = data.categoryById.name; 

        });
    }

    if(this.ruta === 'CrearCategoria'){
      this.ventana = 'Crear';
      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las categorias.');
    }

  }, 
  methods: {
    displayError(res) {

      if (res.errors[0].validation.name)
      this.errors.push(res.errors[0].validation.name[0]);

      VueOnToast.ToastService.pop('error', 'Error al crear categoria', 'Corrija para poder crear con éxito');
      
    },
    submit() {

     
  
        this.$store.dispatch('createCategory', { 
          name: this.name, 
        })
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.name = '';
      
              VueOnToast.ToastService.pop('success', 'Categoria creada', 'La categoria fue creado con éxito.');
            }
        });
    
    },
    edit() {

         
  
        this.$store.dispatch('updateCategory', { 
          id: this.$route.params.id, 
          name: this.name,
        })
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.name = '';

              VueOnToast.ToastService.pop('success', 'Categoria editada', 'La categoria fue editada con éxito.');
            }
        });
    
    },
    permissionGenerator(operacion, maestro) {

      if(this.permisos.length > 0){
        if(this.permisos[maestro][operacion] === 1){
          return 1;
        }else{
          return 0;
        }    
      }    
    },
    denyAccessIfNotAuthorized ( seccion, redirectTo, message ) {
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_CATEGORIAS)) {

            this.$router.go(-1);
            
        }
    },
  }
}
</script>
