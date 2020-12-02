<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">

        <router-link :to="{ name: 'CrearPagos'}">
          <b-button variant="success"  v-if="permissionGenerator('agregar',maestroo)"><i class="fa fa-plus"></i>&nbsp; Nuevo(s) pagos</b-button>
        </router-link>
 
        <br><br>

        <b-card header="Listado de pagos">
  
          <div class="col-sm-2 mb-5">
            <label> Por página</label>
            <b-form-select :options="pageOptions" v-model="perPage">
            </b-form-select>
          </div>
      
          <div>
            <div v-if="!hasRecords" style="text-align: center"><br><br>No hay Datos para Mostrar...</div>
            <div v-if="hasRecords">

           

              <b-table responsive :items="pagos" :fields="fields" :current-page="currentPage" :per-page="perPage">


                <template slot="options" slot-scope="row">

                <span v-if="permissionGenerator('borrar',maestroo)" class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
                  <i class="icon-trash icons font-2xl mr-2" v-b-modal="'myModal'" @click="sendInfo(row.item)"></i>
                </span>
                  
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

    <b-modal id="myModal" title="Eliminar"  @ok="del(selectedPayment.id)" class="text-center">
      <h6>Eliminar pago de empleado {{selectedPayment.name}} {{selectedPayment.lastName}}</h6>
      <h6>¿Estas seguro que deseas pago de empleado {{selectedPayment.name}} {{selectedPayment.lastName}} ?</h6>
    </b-modal>

    
  </div>

</template>

<script>

function Pagos({ id, sueldo_diario, fecha, employee}) {

  this.id = id;
  this.rut = employee.rut;
  this.name = employee.nombre+' '+employee.apellido;
  this.sueldo_diario = sueldo_diario;
  this.fecha = fecha;
}


import VueOnToast from 'vue-on-toast';
import constSystem from '../../_const';

export default {
  name: 'payment-table',
  components: {
    VueOnToast
  },
  data () {
    return {
      pagos: [],
      ruta: this.$route.name,
      selectedPayment: '',
      selectAll: false,
      perPage: 10,
      currentPage: 1,
      maestroo: constSystem.MAESTRO_EMPLEADOS_PAGOS,
      permisos : this.$store.getters.permisos,
      pageOptions: [5, 10, 15],
      fields: {
        rut: {
          label: 'Rut',
          sortable: true,
        },
        name: {
          label: 'Nombre',
          sortable: true,
        },
        sueldo_diario: {
          label: 'Sueldo diario',
          sortable: true,
        },
        fecha: {
          label: 'Fecha de pago',
          sortable: true,
        },
        options: {
          label: 'Opciones',
          class: 'text-center' 
        }
      }
    }
  },
  mounted: function() {

    this.denyAccessIfNotAuthorized ('ver', 'Dashboard', 'No tienes permisos para ver a las categorias.');
  },
  computed: {
    hasRecords() {
      return this.pagos.length > 0;
    },
    totalRows() {
      return this.pagos.length;
    }
  },
  methods: {

    read() {
      this.$store.dispatch('getPagos', null).then(({data}) => {
        data.pagos.forEach(pago => {
          this.pagos.push(new Pagos(pago));
        });
      });
    },
    sendInfo(item) {
      this.selectedPayment = item;
    },
    del(id) {
      this.$store.dispatch('deletePayment', { id: id}).then(({data}) => {
        VueOnToast.ToastService.pop('success', 'El pago eliminado', 'El pago fue eliminado con éxito.');
        this.pagos = [];
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
    denyAccessIfNotAuthorized ( seccion, redirectTo, message ) {
        if (! this.permissionGenerator(seccion,constSystem.MAESTRO_EMPLEADOS_PAGOS)) {

            this.$router.go(-1);
            
        }
    },
  },
  created() {
    this.read();
  }
}
</script>


