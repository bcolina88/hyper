<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-6">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>Moneda</small>
          </div>
          <form action="" >

          <div class="col-sm-12"><span v-for="error in errors" class="text-danger">{{ error }}<br></span></div>
  

          <div class="row">
            <div class="col-sm-12">
              <b-form-fieldset label="Nombre">
                <input type="text" class="form-control" name="description" v-model="description" placeholder="Ingrese nombre"></input>
              </b-form-fieldset>
            </div>
          </div>
    

          <div class="form-actions">
              <b-button v-if="ventana === 'Crear'" @click.prevent="submit" variant="success">Guardar</b-button>
              <b-button v-if="ventana === 'Editar'" @click.prevent="edit" variant="success">Editar</b-button>
              <router-link :to="{ name: 'Monedas'}">
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
  name: 'currency-form',
  components: {
    VueOnToast
  },
  data () {
    return {
      errors: [],
      description:'',
      ruta: this.$route.name,
      ventana:'',
      maestroo: constSystem.MAESTRO_MONEDAS,
      permisos : this.$store.getters.permisos,
    }
  },
  mounted: function() {


    if (this.ruta === 'EditarMoneda') {

      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

      this.ventana = 'Editar';

      this.$store.dispatch('currencyById', { id: this.$route.params.id})
        .then(({data}) => {

           this.description = data.currencyById.description; 

        });
    }

    if(this.ruta === 'CrearMoneda'){

      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

      this.ventana = 'Crear';
    }

  }, 
  methods: {
    displayError(res) {

      if (res.errors[0].validation.description)
      this.errors.push(res.errors[0].validation.description[0]);

      VueOnToast.ToastService.pop('error', 'Error al crear moneda', 'Corrija para poder crear con éxito');
      
    },
    submit() {
  
        this.$store.dispatch('createCurrency', { 
          description: this.description, 
        })
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.description = '';
      
              VueOnToast.ToastService.pop('success', 'Moneda creada', 'La moneda fue creada con éxito.');
            }
        });
    
    },
    edit() {
  
        this.$store.dispatch('updateCurrency', { 
          id: this.$route.params.id, 
          description: this.description,
        })
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.description = '';

              VueOnToast.ToastService.pop('success', 'Moneda editada', 'La moneda fue editada con éxito.');
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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_MONEDAS)) {

            this.$router.go(-1);
            
        }
    },
  }
}
</script>
