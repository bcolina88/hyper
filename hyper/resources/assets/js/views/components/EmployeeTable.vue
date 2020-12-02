<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">

        <router-link :to="{ name: 'CrearEmpleado'}">
          <b-button variant="success" v-if="permissionGenerator('agregar',maestroo)"><i class="fa fa-plus"></i>&nbsp; Nuevo empleado</b-button>
        </router-link>
 
        <br><br>

        <b-card header="Listado de empleados">
  
          <div class="col-sm-2 mb-5">
            <label> Por página</label>
            <b-form-select :options="pageOptions" v-model="perPage">
            </b-form-select>
          </div>
      
          <div>
            <div v-if="!hasRecords" style="text-align: center"><br><br>No hay Datos para Mostrar...</div>
            <div v-if="hasRecords">

            <b-table responsive :items="empleados" :fields="fields" :current-page="currentPage" :per-page="perPage">

              <template slot="active" slot-scope="row">
                    {{ row.item.active ? 'Habilitado' : 'Deshabilitado' }}
              </template>

              <template slot="options" slot-scope="row">
            
                <router-link :to="{ name: 'EditarEmpleado', params: { id: row.item.id }}">
                  <span v-if="permissionGenerator('editar',maestroo)" class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Editar" >
                    <i class="icon-pencil icons font-2xl mr-2"></i>
                  </span>
                </router-link> 

                <span v-if="permissionGenerator('borrar',maestroo)" class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
                  <i class="icon-trash icons font-2xl mr-2" v-b-modal="'myModal'" @click="sendInfo(row.item)"></i>
                </span>

                <!-- Active -->

                <button v-if="permissionGenerator('inhabilitar',maestroo)" type="button" @click="status(row.item.id,row.item.active)" v-show="!row.item.active" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Habilitar">
                  <i class="fa fa-toggle-on text-success-lter"></i>
                </button>

                <button v-if="permissionGenerator('inhabilitar',maestroo)" type="button" @click="status(row.item.id,row.item.active)" v-show="row.item.active" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Deshabilitar">
                  <i class="fa fa-toggle-off text-light-dker"></i>
                </button>

                <!-- Active -->
                
              </template>
                
            </b-table>
                       
            </div>
          </div>
          
            
          <b-row>
            <b-col md="6" class="my-1">
              <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
            </b-col>
          </b-row>

        </b-card>
         
        </div>
      </div>
    </div>
    <!-- Notificacion Component -->
    <toast-container></toast-container>
    <!-- Modal Component -->

    <b-modal id="myModal" title="Eliminar"  @ok="del(selectedEmployee.id)" class="text-center">
      <h6>Eliminar empleado {{selectedEmployee.name}} {{selectedEmployee.lastName}}</h6>
      <h6>¿Estas seguro que deseas eliminar empleado {{selectedEmployee.name}} {{selectedEmployee.lastName}} ?</h6>
    </b-modal>

    
  </div>

</template>

<script>

function Empleados({ id, nombre, apellido, telefono, role, fecha, sueldo_mensual, sueldo_diario, active}) {

  this.id = id;
  this.name = nombre;
  this.lastName = apellido;
  this.phone = telefono;
  this.role = role.name;
  this.fecha = fecha;
  this.sueldo_mensual = sueldo_mensual;
  this.sueldo_diario = sueldo_diario;
  this.active = active;
}


import VueOnToast from 'vue-on-toast';
import constSystem from '../../_const';

export default {
  name: 'employee-table',
  components: {
    VueOnToast
  },
  data () {
    return {
      empleados: [],
      ruta: this.$route.name,
      selectedEmployee: '',
      selectAll: false,
      perPage: 10,
      maestroo: constSystem.MAESTRO_EMPLEADOS_LISTADO,
      permisos : this.$store.getters.permisos,
      currentPage: 1,
      pageOptions: [5, 10, 15],
      fields: {
        id: {
          label: '#',
          sortable: true,
          class: 'text-center'
        },
        name: {
          label: 'Nombre',
          sortable: true,
          class: 'text-center'
        },
        lastName: {
          label: 'Apellido',
          sortable: true,
          class: 'text-center'
        },
        phone: {
          label: 'Telefono',
          sortable: true,
          class: 'text-center'
        },
        role: {
          label: 'Rol',
          sortable: true,
          class: 'text-center'
        },
        active: {
          label: 'Estatus',
          sortable: true,
          class: 'text-center'
        },
        sueldo_diario: {
          label: 'Sueldo diario',
          sortable: true,
          class: 'text-center'
        },
        sueldo_mensual: {
          label: 'Sueldo mensual',
          sortable: true,
          class: 'text-center'
        },
        options: {
          label: 'Opciones',
          class: 'text-center' 
        }
      }
    }
  },
  mounted: function() {
    this.denyAccessIfNotAuthorized ('ver');
  },
  computed: {
    hasRecords() {
      return this.empleados.length > 0;
    },
    totalRows() {
      return this.empleados.length;
    }
  },
  methods: {

    read() {
      this.$store.dispatch('getEmpleados', null).then(({data}) => {
        data.empleados.forEach(employee => {
          this.empleados.push(new Empleados(employee));
        });
      });
    },
    del(id) {
      this.$store.dispatch('deleteEmployee', { id: id}).then(({data}) => {
        VueOnToast.ToastService.pop('success', 'Empleado Eliminado', 'El empleado fue eliminado con éxito.');
        this.empleados = [];
        this.read();
      });
    },
    sendInfo(item) {
      this.selectedEmployee = item;
    },
    status(id,value) {

      if (value) {
        status = false;
      }else{
        status = true;
      }

      this.$store.dispatch('blockedEmployee', { id: id, status : status}).then(({data}) => {
        VueOnToast.ToastService.pop('success', 'Estatus cambiado', 'El empleado cambio de estatus con éxito.');
        this.empleados = [];
        this.read();
      });
    },
    onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
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
    denyAccessIfNotAuthorized (seccion) {
        if (! this.permissionGenerator(seccion,this.maestroo)) {
            this.$router.go(-1);
        }
    },
  },
  created() {
    this.read();
  }
}
</script>


