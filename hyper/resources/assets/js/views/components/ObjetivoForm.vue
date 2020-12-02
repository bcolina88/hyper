<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-6">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>Objetivo</small>
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
                <b-form-fieldset label="Proyecto">
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
                <b-form-fieldset label="Valor Inicial">
                  <input class="form-control" type="number" name="valor_inicial" min="1" v-model="valor_inicial" ></input>
                </b-form-fieldset>
              </div>
              
              
              <div class="col-sm-6">
                <b-form-fieldset label="Valor Objetivo">
                  <input class="form-control" type="number" name="valor_objetivo" min="1" v-model="valor_objetivo" ></input>
                </b-form-fieldset>
              </div>

            </div>

            <div class="form-actions">
              <b-button v-if="ventana === 'Crear'" @click.prevent="submit" variant="success">Guardar</b-button>
              <b-button v-if="ventana === 'Editar'" @click.prevent="edit" variant="success">Editar</b-button>
              <router-link :to="{ name: 'Objetivos'}">
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
      valor_inicial:'',
      valor_objetivo:'',
      ruta: this.$route.name,
      ventana:'',
      role: 0,
      roles:[],
      maestroo: constSystem.MAESTRO_OBJETIVO,
      permisos : this.$store.getters.permisos,


    }
  },
  mounted: function() {


    http.get("api/Proyectos").then(res => {

      let cat = {};
      cat.value = 0;
      cat.text = "Por favor seleccione una opción";
      this.roles.push(cat);

      res.data.forEach(rol => {
        if(rol.active){
          let cat = {};
          cat.value = rol.id;
          cat.text = rol.name;
          this.roles.push(cat);
        }
      });

    });


    if (this.ruta === 'EditarObjetivo') {

      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

      this.ventana = 'Editar';

  
        http.get("api/ObjetivoById/"+this.$route.params.id).then(res => {

             this.fecha_fin = res.data.fecha_fin;
             this.name = res.data.name; 
             this.fecha_inicial = res.data.fecha_inicial; 
             this.valor_inicial = res.data.valor_inicial; 
             this.valor_objetivo = res.data.valor_objetivo;
             this.role = res.data.proyecto_id;

        })
        .catch(error => {
           alert(error)
        });


    }

    if(this.ruta === 'CrearObjetivo'){

      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a los objetivos.');

      this.ventana = 'Crear';
    }

  }, 
  methods: {
    displayError(res) {

      if (res.errors[0].validation.name)
      this.errors.push(res.errors[0].validation.name[0]);

      if (res.errors[0].validation.email)
      this.errors.push(res.errors[0].validation.email[0]);

      if (res.errors[0].validation.password)
      this.errors.push(res.errors[0].validation.password[0]);

      VueOnToast.ToastService.pop('error', 'Error al crear usuario', 'Corrija para poder crear con éxito');
      
    },
    submit() {


        const formData = new FormData()
        formData.append('name',this.name)
        formData.append('fecha_fin',this.fecha_fin)
        formData.append('fecha_inicial',this.fecha_inicial)
        formData.append('valor_inicial',this.valor_inicial)
        formData.append('valor_objetivo',this.valor_objetivo)
        formData.append('proyect',this.role)

         
        http.post("api/CreateObjetivo",formData)
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.fecha_fin = '';
              this.name = '';
              this.fecha_inicial = '';
              this.valor_inicial = '';
              this.valor_objetivo = '';
              this.role = 0;
              VueOnToast.ToastService.pop('success', 'Objetivo creado', 'El objetivo fue creado con éxito.');
            }
        });
    
    },
    edit() {



        const formData = new FormData()
        formData.append('id',this.$route.params.id)
        formData.append('name',this.name)
        formData.append('fecha_fin',this.fecha_fin)
        formData.append('fecha_inicial',this.fecha_inicial)
        formData.append('valor_inicial',this.valor_inicial)
        formData.append('valor_objetivo',this.valor_objetivo)
        formData.append('proyect',this.role)

        http.post("api/UpdateObjetivo",formData)
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.fecha_fin = '';
              this.name = '';
              this.fecha_inicial = '';
              this.valor_inicial = '';
              this.valor_objetivo = '';
              this.role = 0;
              VueOnToast.ToastService.pop('success', 'Objetivo editado', 'El objetivo fue editado con éxito.');
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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_OBJETIVO)) {

            this.$router.go(-1);
            
        }
    },
  }
}
</script>
