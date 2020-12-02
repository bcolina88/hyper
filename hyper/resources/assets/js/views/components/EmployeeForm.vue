<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-6">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>Empleado</small>
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
                <b-form-fieldset label="Rut">
                  <input class="form-control" type="text" name="rut" v-model="rut" placeholder="Ingrese el rut"></input>
                </b-form-fieldset>
              </div>
              <div class="col-sm-6">
                <b-form-fieldset label="Sueldo Mensual" :description="inputDescription1">
                  <input class="form-control" type="text" name="sueldo_mensual" v-model="sueldo_mensual" placeholder="0.00"></input>
                </b-form-fieldset>
              </div>
            </div>


            <div class="row">

              <div class="col-sm-6">
                <b-form-fieldset label="Sueldo Diario" :description="inputDescription2">
                  <input class="form-control" type="text" name="sueldo_diario" v-model="sueldo_diario" placeholder="0.00"></input>
                </b-form-fieldset>
              </div>
            </div>

            <div class="form-actions">
              <b-button v-if="ventana === 'Crear'" @click.prevent="submit" variant="success">Guardar</b-button>
              <b-button v-if="ventana === 'Editar'" @click.prevent="edit" variant="success">Editar</b-button>
              <router-link :to="{ name: 'Listado'}">
                <b-button type="button" variant="secondary">Regresar</b-button>
              </router-link>
            </div>

          </form>

        </b-card>
      </div>
      <div class="col-sm-3"></div> 
      <toast-container></toast-container>



      <div class="modal fade" tabindex="-1" role="dialog" id="myModal" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              
              <div class="modal-header">
                 <h4 class="modal-title">Moneda del sistema</h4>
              </div>
              
              <div class="modal-body" class="text-center">
                  <br><br> 
                  <h6>Debe elegir la moneda del sistema</h6>
                  <b><h6>Para hacerlo dirijase a la sección del menú Configuración/Empresa</h6></b>
                  <br><br>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light-grey" data-dismiss="modal" style="font-size: 14px;">Salir</button>
              </div>
            </div>
          </div>
      </div>


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
      lastName: '',
      name:'',
      email:'',
      phone:'',
      inputDescription1:'',
      inputDescription2:'',
      ruta: this.$route.name,
      ventana:'',
      role: 0,
      roles:[],
      sueldo_mensual:'',
      sueldo_diario:'',
      rut:'',
      permisos : this.$store.getters.permisos,
      maestroo: constSystem.MAESTRO_EMPLEADOS_LISTADO,


    }
  },
  mounted: function() {

    this.$store.dispatch('getRoles', null).then(({data}) => {

      let cat = {};
      cat.value = 0;
      cat.text = "Por favor seleccione una opción";
      this.roles.push(cat);

      data.roles.forEach(rol => {
        if(rol.active){
          let cat = {};
          cat.value = rol.id;
          cat.text = rol.name;
          this.roles.push(cat);
        }
      });

    });


    if (this.ruta === 'EditarEmpleado') {

      this.ventana = 'Editar';

      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

      this.$store.dispatch('employeeById', { id: this.$route.params.id})
        .then(({data}) => {

           this.lastName = data.employeeById.apellido;
           this.name = data.employeeById.nombre; 
           this.phone = data.employeeById.telefono;
           this.role = data.employeeById.role.id;
           this.rut = data.employeeById.rut;
           this.sueldo_mensual = data.employeeById.sueldo_mensual;
           this.sueldo_diario = data.employeeById.sueldo_diario;

        });
    }

    if(this.ruta === 'CrearEmpleado'){
      this.ventana = 'Crear';
      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las categorias.');
    }

  }, 
  methods: {
    displayError(res) {

      VueOnToast.ToastService.pop('error', 'Error al crear empleado', 'Corrija para poder crear con éxito');
      
    },
     read() {

      this.$store.dispatch('getEmpresa', null).then(({data}) => {

          this.companys = data.companys;
          data.companys.forEach(company => {

              if(company){

                if(company.currency){
                  this.inputDescription1 = "Los sueldos se deben reflejar en ("+company.currency.description+")";
                  this.inputDescription2 = "Los sueldos se deben reflejar en ("+company.currency.description+")";
                }else{
                  this.inputDescription1 = "";
                  this.inputDescription2 = "";
                }

              }


          });
      });

    },
    submit() {



      this.$store.dispatch('getEmpresa', null).then(({data}) => {

          data.companys.forEach(company => {

              if(company){

                if(company.currency){

  
                    this.$store.dispatch('createEmployee', { 
                      nombre: this.name, 
                      apellido: this.lastName,
                      telefono: this.phone,
                      role : this.role,
                      rut : this.rut,
                      sueldo_mensual : this.sueldo_mensual,
                      sueldo_diario : this.sueldo_diario,
                    })
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
                          this.role = 0;
                          this.rut = '';
                          this.sueldo_mensual = '';
                          this.sueldo_diario = '';
                          VueOnToast.ToastService.pop('success', 'Empleado creado', 'El empleado fue creado con éxito.');
                        }
                    });

                }else{
                   $('#myModal').modal('toggle');
                }

              }


          });
      });    
    
    },
    edit() {



      this.$store.dispatch('getEmpresa', null).then(({data}) => {

          data.companys.forEach(company => {

              if(company){

                if(company.currency){
  
                    this.$store.dispatch('updateEmployee', { 
                      id: this.$route.params.id, 
                      nombre: this.name, 
                      apellido: this.lastName, 
                      telefono: this.phone, 
                      role : this.role,
                      rut : this.rut,
                      sueldo_mensual : this.sueldo_mensual,
                      sueldo_diario : this.sueldo_diario,
                    })
                    .then(res => {
                        if(res.errors) {
                          this.errors = [];
                          this.displayError(res)
                        }else{
                          this.errors = [];
                          this.lastName = '';
                          this.name = '';
                          this.phone = '';
                          this.role = 0;
                          this.rut = '';
                          this.sueldo_mensual = '';
                          this.sueldo_diario = '';
                          VueOnToast.ToastService.pop('success', 'Empleado editado', 'El empleado fue editado con éxito.');
                        }
                    });


                }else{
                   $('#myModal').modal('toggle');
                }

              }


          });
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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_EMPLEADOS_LISTADO)) {

            this.$router.go(-1);
            
        }
    },
  },
  created() {
    this.read();
  }
}
</script>
