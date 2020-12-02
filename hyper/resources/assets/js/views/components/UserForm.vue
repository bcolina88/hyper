<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-6">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>Usuario</small>
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
                <b-form-fieldset label="Apellido">
                  <input class="form-control" type="text" name="lastName" v-model="lastName" placeholder="Ingrese el apellido"></input>
                </b-form-fieldset>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <b-form-fieldset label="Telefono">
                  <input class="form-control" type="text" name="phone" v-model="phone" placeholder="Ingrese el telefono"></input>
                </b-form-fieldset>
              </div>
              
              <div class="col-sm-6">
                <b-form-fieldset label="Rol">
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
                <b-form-fieldset label="Email">
                  <input class="form-control" type="text" name="email" v-model="email" placeholder="Ingrese el email"></input>
                </b-form-fieldset>
              </div>
              
              <div class="col-sm-6">
                <b-form-fieldset label="Nombre de usuario">
                  <input class="form-control" type="text" name="username" v-model="username" placeholder="Ingrese nombre de usuario"></input>
                </b-form-fieldset>
              </div>

            </div>

            <div class="row">
              
              <div class="col-sm-6" v-if="ventana === 'Crear'">
                <b-form-fieldset
                  label="Contraseña">
                  <input class="form-control" type="password" name="password" v-model="password" placeholder="Ingrese contraseña"></input>
                </b-form-fieldset>
              </div>
            </div>

            <div class="form-actions">
              <b-button v-if="ventana === 'Crear'" @click.prevent="submit" variant="success">Guardar</b-button>
              <b-button v-if="ventana === 'Editar'" @click.prevent="edit" variant="success">Editar</b-button>
              <router-link :to="{ name: 'Usuarios'}">
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
      lastName: '',
      name:'',
      email:'',
      phone:'',
      username:'',
      ruta: this.$route.name,
      ventana:'',
      password :'',
      role: 0,
      roles:[],
      maestroo: constSystem.MAESTRO_USUARIOS,
      permisos : this.$store.getters.permisos,


    }
  },
  mounted: function() {


    http.get("api/Roles").then(res => {

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


    if (this.ruta === 'EditarUsuario') {

      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

      this.ventana = 'Editar';

  
        http.get("api/UserById/"+this.$route.params.id).then(res => {

             this.lastName = res.data.lastName;
             this.name = res.data.name; 
             this.username = res.data.username; 
             this.email = res.data.email; 
             this.phone = res.data.phone;
             this.role = res.data.role_id;

        })
        .catch(error => {
           alert(error)
        });


    }

    if(this.ruta === 'CrearUsuario'){

      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

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
        formData.append('lastName',this.lastName)
        formData.append('username',this.username)
        formData.append('email',this.email)
        formData.append('phone',this.phone)
        formData.append('password',this.password)
        formData.append('role',this.role)

         
        http.post("api/CreateUser",formData)
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.lastName = '';
              this.name = '';
              this.email = '';
              this.phone = '';
              this.password = '';
              this.username = '';
              this.role = 0;
              VueOnToast.ToastService.pop('success', 'Usuario creado', 'El usuario fue creado con éxito.');
            }
        });
    
    },
    edit() {



        const formData = new FormData()
        formData.append('id',this.$route.params.id)
        formData.append('name',this.name)
        formData.append('lastName',this.lastName)
        formData.append('username',this.username)
        formData.append('email',this.email)
        formData.append('phone',this.phone)
        formData.append('role',this.role)


        http.post("api/UpdateUser",formData)
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.lastName = '';
              this.name = '';
              this.email = '';
              this.phone = '';
              this.password = '';
              this.username = '';
              this.role = 0;
              VueOnToast.ToastService.pop('success', 'Usuario editado', 'El usuario fue editado con éxito.');
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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_USUARIOS)) {

            this.$router.go(-1);
            
        }
    },
  }
}
</script>
