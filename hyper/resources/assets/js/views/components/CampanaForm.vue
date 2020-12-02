<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-6">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>Campaña</small>
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
                <b-form-fieldset label="Palancas">
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

               <div class="col-sm-6">
                <b-form-fieldset label="Fecha Inicio">
                  <input class="form-control" type="date" name="fecha_inicial" v-model="fecha_inicial" ></input>
                </b-form-fieldset>
              </div>

              <div class="col-sm-6">
                <b-form-fieldset label="Fecha Fin">
                  <input class="form-control" type="date" name="fecha_fin" v-model="fecha_fin" ></input>
                </b-form-fieldset>
              </div>
            
            </div>

            <div class="row">

              <div class="col-sm-6">
                <b-form-fieldset label="Tiempo">
                  <input class="form-control" type="number" name="tiempo" min="1" v-model="tiempo" ></input>
                </b-form-fieldset>
              </div>
              
              
              <div class="col-sm-6">
                <b-form-fieldset label="Alcance">
                  <input class="form-control" type="number" name="alcance" min="1" v-model="alcance" ></input>
                </b-form-fieldset>
              </div>

            </div>

             <div class="row">

              <div class="col-sm-6">
                <b-form-fieldset label="Presupuesto">
                  <input class="form-control" type="number" name="presupuesto" min="1" v-model="presupuesto" ></input>
                </b-form-fieldset>
              </div>

               <div class="col-sm-6">
                <b-form-fieldset label="Usuarios">
                    <b-form-select
                      v-model="role1"
                      :plain="true"
                      :options="roles1"
                      value="0">
                    </b-form-select>
                </b-form-fieldset>
              </div>
              

            </div>

            <div class="form-actions">
              <b-button v-if="ventana === 'Crear'" @click.prevent="submit" variant="success">Guardar</b-button>
              <b-button v-if="ventana === 'Editar'" @click.prevent="edit" variant="success">Editar</b-button>
              <router-link :to="{ name: 'Campanas'}">
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
  name: 'user-form',
  components: {
    VueOnToast
  },
  data () {
    return {
      errors: [],
      fecha_inicial: '',
      name:'',
      fecha_fin:'',
      tiempo:'',
      alcance:'',
      presupuesto:'',
      ruta: this.$route.name,
      ventana:'',
      role: 0,
      role1: 0,
      roles:[],
      roles1:[],
      maestroo: constSystem.MAESTRO_CAMPANA,
      permisos : this.$store.getters.permisos,


    }
  },
  mounted: function() {


    http.get("api/Palancas").then(res => {

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


     http.get("api/Users").then(res => {

      let cat = {};
      cat.value = 0;
      cat.text = "Por favor seleccione una opción";
      this.roles1.push(cat);

      res.data.forEach(rol => {
        if(rol.active){
          let cat = {};
          cat.value = rol.id;
          cat.text = rol.name;
          this.roles1.push(cat);
        }
      });

    });


    if (this.ruta === 'EditarCampana') {

      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a las campañas.');

      this.ventana = 'Editar';

  
        http.get("api/CampanaById/"+this.$route.params.id).then(res => {

             this.fecha_fin = res.data.fecha_fin;
             this.name = res.data.name; 
             this.fecha_inicial = res.data.fecha_inicial; 
             this.tiempo = res.data.tiempo; 
             this.alcance = res.data.alcance;
             this.presupuesto = res.data.presupuesto;
             this.role = res.data.palanca_id;
             this.role1 = res.data.user_id;

        })
        .catch(error => {
           alert(error)
        });


    }

    if(this.ruta === 'CrearCampana'){

      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las campañas.');

      this.ventana = 'Crear';
    }

  }, 
  methods: {
    displayError(res) {

      if (res.errors[0].validation.name)
      this.errors.push(res.errors[0].validation.name[0]);


      VueOnToast.ToastService.pop('error', 'Error al crear campaña', 'Corrija para poder crear con éxito');
      
    },
    submit() {


        const formData = new FormData()
        formData.append('name',this.name)
        formData.append('fecha_fin',this.fecha_fin)
        formData.append('fecha_inicial',this.fecha_inicial)
        formData.append('tiempo',this.tiempo)
        formData.append('alcance',this.alcance)
        formData.append('presupuesto',this.presupuesto)
        formData.append('palanca',this.role)
        formData.append('user',this.role1)

         
        http.post("api/CreateCampana",formData)
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.fecha_fin = '';
              this.name = '';
              this.fecha_inicial = '';
              this.tiempo = '';
              this.alcance = '';
              this.presupuesto = '';
              this.role = 0;
              this.role1 = 0;
              VueOnToast.ToastService.pop('success', 'Campaña creado', 'La campaña fue creada con éxito.');
            }
        });
    
    },
    edit() {



        const formData = new FormData()
        formData.append('id',this.$route.params.id)
        formData.append('name',this.name)
        formData.append('fecha_fin',this.fecha_fin)
        formData.append('fecha_inicial',this.fecha_inicial)
        formData.append('tiempo',this.tiempo)
        formData.append('alcance',this.alcance)
        formData.append('palanca',this.role)
        formData.append('presupuesto',this.presupuesto)
        formData.append('user',this.role1)



        http.post("api/UpdateCampana",formData)
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.fecha_fin = '';
              this.name = '';
              this.fecha_inicial = '';
              this.tiempo = '';
              this.alcance = '';
              this.presupuesto = '';
              this.role = 0;
              this.role1 = 0;
              VueOnToast.ToastService.pop('success', 'Campaña editada', 'La camapaña fue editado con éxito.');
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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_CAMPANA)) {

            this.$router.go(-1);
            
        }
    },
  }
}
</script>
