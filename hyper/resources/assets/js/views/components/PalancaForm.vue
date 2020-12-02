<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-6">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>Palanca</small>
          </div>
          <form action="" >

            <div class="col-sm-12"><span v-for="error in errors" class="text-danger">{{ error }}<br></span></div>

            <div class="row">
              <div class="col-sm-6">
                <b-form-fieldset label="Nombre">
                  <input class="form-control" type="text" name="name" v-model="name" placeholder="Ingrese nombre"></input>
                </b-form-fieldset>
              </div>

               <div class="col-sm-6">
                <b-form-fieldset label="Objetivo">
                    <b-form-select
                      v-model="role"
                      :plain="true"
                      :options="roles"
                      value="0">
                    </b-form-select>
                </b-form-fieldset>
              </div>
             
            </div>
            <div class="row">

               <div class="col-sm-12">
                  <b-form-fieldset label="Estrategia">
                     <textarea class="form-control" name="estrategia" v-model="estrategia" :rows="9" placeholder="Estrategia..">{{ estrategia }}</textarea>

                  </b-form-fieldset>
               </div>
            </div>

            <div class="row" v-if="ventana === 'Editar'">

               <div class="col-sm-6">
                  <b-form-fieldset label="Experimentos Validados">
                     <input class="form-control" type="text" name="num_exp_valid" v-model="num_exp_valid" disabled></input>

                  </b-form-fieldset>
               </div>
            </div>



            <div class="form-actions">
              <b-button v-if="ventana === 'Crear'" @click.prevent="submit" variant="success">Guardar</b-button>
              <b-button v-if="ventana === 'Editar'" @click.prevent="edit" variant="success">Editar</b-button>
              <router-link :to="{ name: 'Palancas'}">
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
import { http, str } from '../../utils';


export default {
  name: 'palanca-form',
  components: {
    VueOnToast
  },
  data () {
    return {
      errors: [],
      name:'',
      num_exp_valid:'',
      estrategia:'',
      ruta: this.$route.name,
      ventana:'',
      role: 0,
      roles:[],
      maestroo: constSystem.MAESTRO_PALANCA,
      permisos : this.$store.getters.permisos,


    }
  },
  mounted: function() {


    http.get("api/Objetivos").then(res => {

      let cat = {};
      cat.value = 0;
      cat.text = "Por favor seleccione una opción";
      this.roles.push(cat);

      res.data.forEach(rol => {
        if((rol.active)&&(rol.completada)){
          let cat = {};
          cat.value = rol.id;
          cat.text = rol.name;
          this.roles.push(cat);
        }
      });

    });


    if (this.ruta === 'EditarPalanca') {

      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a las palancas.');

      this.ventana = 'Editar';

  
        http.get("api/PalancaById/"+this.$route.params.id).then(res => {

             this.name = res.data.name; 
             this.estrategia = res.data.estrategia; 
             this.role = res.data.objetivo_id;
             this.num_exp_valid = res.data.num_exp_valid;

        })
        .catch(error => {
           alert(error)
        });


    }

    if(this.ruta === 'CrearPalanca'){

      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las palancas.');

      this.ventana = 'Crear';
    }

  }, 
  methods: {
    displayError(res) {

      if (res.errors[0].validation.name)
      this.errors.push(res.errors[0].validation.name[0]);

      if (res.errors[0].validation.estrategia)
      this.errors.push(res.errors[0].validation.estrategia[0]);

      VueOnToast.ToastService.pop('error', 'Error al crear palanca', 'Corrija para poder crear con éxito');
      
    },
    submit() {


        const formData = new FormData()
        formData.append('name',this.name)
        formData.append('estrategia',this.estrategia)
        formData.append('objetivo',this.role)

         
        http.post("api/CreatePalanca",formData)
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.estrategia = '';
              this.name = '';
              this.role = 0;
              VueOnToast.ToastService.pop('success', 'Palanca creado', 'La palanca fue creado con éxito.');
            }
        });
    
    },
    edit() {



        const formData = new FormData()
        formData.append('id',this.$route.params.id)
        formData.append('estrategia',this.estrategia)
        formData.append('name',this.name)
        formData.append('objetivo',this.role)

        http.post("api/UpdatePalanca",formData)
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.name = '';
              this.estrategia = '';
              this.role = 0;
              VueOnToast.ToastService.pop('success', 'Palanca editado', 'La palanca fue editado con éxito.');
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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_PALANCA)) {

            this.$router.go(-1);
            
        }
    },
  }
}
</script>
