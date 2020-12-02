<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-12">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>Rol</small>
          </div>
          <form action="" >
            <div class="row">

                 <div class="container-fluid container-fullw">

          <div class="row">
            <div class="col-md-12" >
            
              <div>

              <form action="">

              <div class="col-sm-12"><span v-for="error in errors" class="text-danger">{{ error }}<br></span></div>

                  <div>
                    <div class="col-sm-4">
                      <b-form-fieldset label="Nombre">
                        <input type="text" class="form-control" name="namee" v-model="namee" placeholder="Ingrese nombre"></input>
                      </b-form-fieldset>
                    </div>
                  </div>
    
                  
                 
                  <div class="col-sm-12">
                     <label>Campo Obligatorio
                            <span class="symbol required"></span>
                     </label>
                     <br><br>
                     <span class="h4">Permisos</span>
                     <p class="text-muted">Seleccione los permisos del nuevo rol.</p>
                     <br><br>

                  </div> 

                  <div class="col-sm-12">              
                        <div class="panel-body">                
                            <div class="table-responsive">
                              <table class="table table-bordered table-hover" id="sample-table-1">
                                <thead>
                                  <tr>
                                  <th>Maestro</th>
                                  <th>Agregar</th>
                                  <th>Editar</th>
                                  <th>Ver</th>
                                  <th>Inhabilitar</th>
                                  <th>Borrar</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                <td></td>
                                <td>
                                
                                  <b-button @click="toggleAll('agregar')" :variant="variant1"><i :class="class1"></i>&nbsp; Todos</b-button>
                                </td>
                                <td>
                                  <b-button @click="toggleAll('editar')" :variant="variant2"><i :class="class2"></i>&nbsp; Todos</b-button>
                               
                                </td>
                                <td>
                                  <b-button @click="toggleAll('ver')" :variant="variant3"><i :class="class3"></i>&nbsp; Todos</b-button>
                                  
                                </td>
                                <td>
                                  <b-button @click="toggleAll('inhabilitar')" :variant="variant4"><i :class="class4"></i>&nbsp; Todos</b-button>
                                  
                                </td>
                                <td>
                                  <b-button @click="toggleAll('borrar')" :variant="variant5"><i :class="class5"></i>&nbsp; Todos</b-button>
                                  
                                </td>
                                  </tr>
                                 <tr v-for="(permi,index) in permissions">
                                 <td>{{permi.maestro.titulo}}</td>
                                 <td>
                                  <a  @click="changePermission(index,'agregar')" v-model="permissions[index]['agregar']" ><i :class="iconClasses(permissions[index]['agregar'])"></i></a>
                                </td>
                                <td>
                                  <a @click="changePermission(index,'editar')" v-model="permissions[index]['editar']"><i :class="iconClasses(permissions[index]['editar'])"></i></a>
                                </td>
                                <td>
                                  <a @click="changePermission(index,'ver')" v-model="permissions[index]['ver']"><i :class="iconClasses(permissions[index]['ver'])"></i></a>
                                </td>
                                <td>
                                  <a @click="changePermission(index,'inhabilitar')" v-model="permissions[index]['inhabilitar']"><i :class="iconClasses(permissions[index]['inhabilitar'])"></i></a>
                                </td>
                                <td>
                                  <a @click="changePermission(index,'borrar')" v-model="permissions[index]['borrar']"><i :class="iconClasses(permissions[index]['borrar'])"></i></a>
                                </td>
                                </tr>
                                </tbody>
                              </table>
                            </div>
                        
                        </div> 
                  </div>
               
                  </div>

                  <div class="col-sm-12">
                    <div class="form-actions">
                          <b-button v-if="ventana === 'Crear'" @click.prevent="submit" variant="success">Guardar</b-button>
                          <b-button v-if="ventana === 'Editar'" @click.prevent="edit" variant="success">Editar</b-button>
                          <router-link :to="{ name: 'Roles'}">
                            <b-button type="button" variant="secondary">Regresar</b-button>
                          </router-link>
                    </div>
                  </div>

                  <div class="col-sm-3"></div> 
          <toast-container></toast-container>
        </div>
                  

              </form>

            </div>
          </div>
        </div>

        

        </b-card>
      </div>
     
   
  </div>
</template>

<script>

import constSystem from '../../_const';
import VueOnToast from 'vue-on-toast';
import { http, str } from '../../utils';

export default {
  name: 'role-form',
  components: {
    VueOnToast
  },
  data () {
    return {
      errors: [],
      description: '',
      namee:'',
      ruta: this.$route.name,
      ventana:'',
      tipo: '',
      tipos:["Usuario","Empleado"],
      permissions: [],
      variant1 : 'outline-danger',
      status1 : false,
      class1 : 'fa fa-times',
      variant2 : 'outline-danger',
      status2 : false,
      class2 : 'fa fa-times',
      variant3 : 'outline-danger',
      status3 : false,
      class3 : 'fa fa-times',
      variant4 : 'outline-danger',
      status4 : false,
      class4 : 'fa fa-times',
      variant5 : 'outline-danger',
      status5 : false,
      class5 : 'fa fa-times',
      maestroo: constSystem.MAESTRO_ROLES,
      permisos : this.$store.getters.permisos,


    }
  },
  mounted: function() {

    if (this.ruta === 'EditarRol') {

      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

      this.ventana = 'Editar';
      this.readEdit();

    }

    if(this.ruta === 'CrearRol'){

      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las categorias.');
      this.ventana = 'Crear';

    }
  }, 
  methods: {
    displayError(res) {

      if (res.errors[0].validation.namee)
      this.errors.push(res.errors[0].validation.namee[0]);


      VueOnToast.ToastService.pop('error', 'Error al crear rol', 'Corrija para poder crear con éxito');
      
    },
    submit() {



        http.post('api/CreateRole', { 
          name: this.namee, 
          permissions: this.permissions,
        })
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.namee = '';


              this.variant1 = 'outline-danger';
              this.status1 = false;
              this.class1 = 'fa fa-times';
              this.variant2 = 'outline-danger';
              this.status2 = false;
              this.class2 = 'fa fa-times';
              this.variant3 = 'outline-danger';
              this.status3 = false;
              this.class3 = 'fa fa-times';
              this.variant4 = 'outline-danger';
              this.status4 = false;
              this.class4 = 'fa fa-times';
              this.variant5 = 'outline-danger';
              this.status5 = false;
              this.class5 = 'fa fa-times';



              this.read();
              

              VueOnToast.ToastService.pop('success', 'Rol creado', 'El rol fue creado con éxito.');
            }
        });

    
    },
    edit() {


        http.post('api/UpdateRole', { 
             id: this.$route.params.id, 
             name: this.namee, 
             permissions: this.permissions
        })
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];


              this.variant1 = 'outline-danger';
              this.status1 = false;
              this.class1 = 'fa fa-times';
              this.variant2 = 'outline-danger';
              this.status2 = false;
              this.class2 = 'fa fa-times';
              this.variant3 = 'outline-danger';
              this.status3 = false;
              this.class3 = 'fa fa-times';
              this.variant4 = 'outline-danger';
              this.status4 = false;
              this.class4 = 'fa fa-times';
              this.variant5 = 'outline-danger';
              this.status5 = false;
              this.class5 = 'fa fa-times';


              this.readEdit();



              VueOnToast.ToastService.pop('success', 'Rol editado', 'El rol fue editado con éxito.');
            }
        });
  
    
    },
    read() {

        http.get("api/Permissions",null).then((res) => {
           this.permissions =  res.data;
        })
        .catch(error => {
           alert(error)
        });

    },
    iconClasses(status) {
      return {
        'fa fa-times text-danger':!status,
        'fa fa-check text-success':status,
      }
    },
    toggleAll(tipo) {

        if(tipo === "agregar"){
          if(this.status1 === false){
              this.variant1 = 'outline-success';
              this.status1 = true;
              this.class1 = 'fa fa-check';

          }else{
              this.variant1 = 'outline-danger';
              this.status1 = false;
              this.class1 = 'fa fa-times';
          }

        }

        if(tipo === "inhabilitar"){
          if(this.status4 === false){
              this.variant4 = 'outline-success';
              this.status4 = true;
              this.class4 = 'fa fa-check';
          }else{
              this.variant4 = 'outline-danger';
              this.status4 = false;
              this.class4 = 'fa fa-times';
          }
        }

        if(tipo === "editar"){
          if(this.status2 === false){
              this.variant2 = 'outline-success';
              this.status2 = true;
              this.class2 = 'fa fa-check';
          }else{
              this.variant2 = 'outline-danger';
              this.status2 = false;
              this.class2 = 'fa fa-times';
          }
        }


        if(tipo === "ver"){
          if(this.status3 === false){
              this.variant3 = 'outline-success';
              this.status3 = true;
              this.class3 = 'fa fa-check';
          }else{
              this.variant3 = 'outline-danger';
              this.status3 = false;
              this.class3 = 'fa fa-times';
          }
        }

        if(tipo === "borrar"){
          if(this.status5 === false){
              this.variant5 = 'outline-success';
              this.status5 = true;
              this.class5 = 'fa fa-check';
          }else{
              this.variant5 = 'outline-danger';
              this.status5 = false;
              this.class5 = 'fa fa-times';
          }
        }

        let base = this.permissions[0][tipo] === 1 ? 0 : 1;
        for (var i = 0; i < this.permissions.length; i++) {
              this.permissions[i][tipo] = base;
        }

    },
    changePermission(index,tipo) {

        let changee = this.permissions[index][tipo] === 1 ? 0 : 1;
        this.permissions[index][tipo] = changee;
    },
    readEdit() {
 

      http.get("api/GetRoleInfo/"+this.$route.params.id).then((res) => {

          this.namee = res.data.role.name;
          this.permissions = res.data.permisos;

      })
      .catch(error => {
         alert(error)
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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_ROLES)) {

            this.$router.go(-1);
            
        }
    },
  },
  created() {
    this.read();
  },
}
</script>
