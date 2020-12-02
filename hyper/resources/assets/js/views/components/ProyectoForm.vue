<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-6">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>Proyecto</small>
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
                <b-form-fieldset label="Tipo proyecto">
                    <b-form-select
                      v-model="role"
                      :plain="true"
                      :options="roles"
                      value="">
                    </b-form-select>
                </b-form-fieldset>
              </div>
             
            </div>
    

            <div class="form-actions">
              <b-button v-if="ventana === 'Crear'" @click.prevent="submit" variant="success">Guardar</b-button>
              <b-button v-if="ventana === 'Editar'" @click.prevent="edit" variant="success">Editar</b-button>
              <router-link :to="{ name: 'Proyectos'}">
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
      tipo_proy:'',
      ruta: this.$route.name,
      ventana:'',
      role: "",
      roles:[{value:"",text:"Por favor seleccione una opción"},{value:"freelancer",text:"Freelancer"},{value:"no_freelancer",text:"No Freelancer"}],
      maestroo: constSystem.MAESTRO_PROYECTO,
      permisos : this.$store.getters.permisos,


    }
  },
  mounted: function() {



    if (this.ruta === 'EditarProyecto') {

      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a los proyectos.');

      this.ventana = 'Editar';

  
        http.get("api/ProyectoById/"+this.$route.params.id).then(res => {

             this.name = res.data.name; 
             this.role = res.data.tipo_proy; 

        })
        .catch(error => {
           alert(error)
        });


    }

    if(this.ruta === 'CrearProyecto'){

      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a los proyectos.');

      this.ventana = 'Crear';
    }

  }, 
  methods: {
    displayError(res) {

      if (res.errors[0].validation.name)
      this.errors.push(res.errors[0].validation.name[0]);


      VueOnToast.ToastService.pop('error', 'Error al crear proyecto', 'Corrija para poder crear con éxito');
      
    },
    submit() {


        const formData = new FormData()
        formData.append('name',this.name)
        formData.append('tipo_proy',this.role)

         
       http.post("api/CreateProyecto",formData)
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.role = '';
              this.name = '';
              VueOnToast.ToastService.pop('success', 'Proyecto creado', 'La palanca fue creado con éxito.');
            }
        });


    
    },
    edit() {



        const formData = new FormData()
        formData.append('id',this.$route.params.id)
        formData.append('tipo_proy',this.role)
        formData.append('name',this.name)


        http.post("api/UpdateProyecto",formData)
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.name = '';
              this.role = '';
              VueOnToast.ToastService.pop('success', 'Proyecto editado', 'El proyecto fue editado con éxito.');
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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_PROYECTO)) {

            this.$router.go(-1);
            
        }
    },
  }
}
</script>
