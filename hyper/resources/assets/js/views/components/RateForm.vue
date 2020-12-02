<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-6">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>Tasa</small>
          </div>
          <form action="" >
            <div class="row">

                <div class="col-sm-12"><span v-for="error in errors" class="text-danger">{{ error }}<br></span></div>
                
  
                <div class="col-sm-12">
                  <b-form-fieldset label="Monedas">
                    <b-form-select
                      name="currency"
                      v-model="currency"
                      :plain="true"
                      :options="metodos"
                      value="0">
                    </b-form-select>
                  </b-form-fieldset>
                </div>
                <div class="col-sm-12">
                  <b-form-fieldset label="Monto">
                    <input class="form-control" type="text" id="value" v-model="value" placeholder="0.00"></input>
                  </b-form-fieldset>
                </div>
            </div>
            <div class="form-actions">
              <b-button v-if="ventana === 'Crear'" @click.prevent="submit" variant="success">Guardar</b-button>
              <b-button v-if="ventana === 'Editar'" @click.prevent="edit" variant="success">Editar</b-button>
              <router-link :to="{ name: 'Tasas'}">
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
  name: 'employee-form',
  components: {
    VueOnToast
  },
  data () {
    return {
      errors: [],
      currency: '',
      value:'',
      ruta: this.$route.name,
      ventana:'',
      metodos:[],
      maestroo: constSystem.MAESTRO_TASAS,
      permisos : this.$store.getters.permisos,

    }
  },
  mounted: function() {


    this.$store.dispatch('getMonedas', null).then(({data}) => {

      let cat = {};
      cat.value = 0;
      cat.text = "Por favor seleccione una opción";
      this.metodos.push(cat);

      data.currencys.forEach(moneda => {
        if(moneda.active){
          let cat = {};
          cat.value = moneda.id;
          cat.text = moneda.description;
          this.metodos.push(cat);
        }
      });

    });



    if (this.ruta === 'EditarTasa') {


      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

      this.ventana = 'Editar';

      this.$store.dispatch('rateById', { id: this.$route.params.id})
        .then(({data}) => {

           this.currency = data.rateById.currency.id; 
           this.value = data.rateById.value; 

        });
    }

    if(this.ruta === 'CrearTasa'){
      this.ventana = 'Crear';
      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las categorias.');
    }
  }, 
  methods: {
    displayError(res) {


      VueOnToast.ToastService.pop('error', 'Error al crear tasa', 'Corrija para poder crear con éxito');
      
    },
    submit() {

  
        this.$store.dispatch('createRate', { value: this.value, currency: this.currency})
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.currency = '';
              this.value = '';
              VueOnToast.ToastService.pop('success', 'Tasa creada', 'El tasa fue creada con éxito.');
            }
        });
    
    },
    edit() {
  
        this.$store.dispatch('updateRate', { id: this.$route.params.id, value: this.value, currency: this.currency})
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.currency = '';
              this.value = '';
              VueOnToast.ToastService.pop('success', 'Tasa editado', 'La Tasa fue editada con éxito.');
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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_TASAS)) {

            this.$router.go(-1);
            
        }
    },
  }
}
</script>
