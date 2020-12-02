<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">

        <router-link :to="{ name: 'CrearCierre'}">
          <b-button variant="success" v-if="permissionGenerator('agregar',maestroo)"><i class="fa fa-plus"></i>&nbsp; Nuevo cierre</b-button>
        </router-link>
 

        <br><br> 


        <b-card header="Listado de cierres">
  
          <div class="col-sm-2 mb-5">
            <label> Por página</label>
            <b-form-select :options="pageOptions" v-model="perPage">
            </b-form-select>
          </div>
      
          <div>
            <div v-if="!hasRecords" style="text-align: center"><br><br>No hay Datos para Mostrar...</div>
            <div v-if="hasRecords">

            <b-table responsive :items="cierres" :fields="fields" :current-page="currentPage" :per-page="perPage">


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

    <b-modal id="myModal" title="Eliminar"  @ok="del(selectedClosure.id)" class="text-center">
      <h6>Eliminar cierre #{{selectedClosure.id}}</h6>
      <h6>¿Estas seguro que deseas eliminar este cierre #{{selectedClosure.id}} ?</h6>
    </b-modal>

    
  </div>

</template>

<script>



function Cierres({  id, fecha, total_pago, total_gastos, total_ventas}) {

  this.id = id;
  this.fecha = fecha;
  this.pago_empleado =  total_pago;
  this.gasto = total_gastos;
  this.venta = total_ventas; 

}

import VueOnToast from 'vue-on-toast';
import constSystem from '../../_const';

export default {
  name: 'closure-table',
  components: {
    VueOnToast
  },
  data () {
    return {
      cierres: [],
      ruta: this.$route.name,
      selectedClosure: '',
      selectAll: false,
      perPage: 10,
      maestroo: constSystem.MAESTRO_CIERRES,
      permisos : this.$store.getters.permisos,
      currentPage: 1,
      pageOptions: [5, 10, 15],
      fields: {
        id: {
          label: '#',
          sortable: true,
          class: 'text-center'
        },
        fecha: {
          label: 'Fecha',
          sortable: true,
          class: 'text-center'
        },
        gasto: {
          label: 'Total gastos',
          sortable: true,
          class: 'text-center'
        },
        pago_empleado: {
          label: 'Total pago de empleados',
          sortable: true,
          class: 'text-center'
        },
        venta: {
          label: 'Ventas de dia',
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

    this.denyAccessIfNotAuthorized ('ver', 'Dashboard', 'No tienes permisos para ver a las categorias.');
  },
  computed: {
    hasRecords() {
      return this.cierres.length > 0;
    },
    totalRows() {
      return this.cierres.length;
    }
  },
  methods: {

    read() {
      this.$store.dispatch('getCierres', null).then(({data}) => {
        data.cierres.forEach(closure => {
          this.cierres.push(new Cierres(closure));
        });
      });
    },
    del(id) {
      this.$store.dispatch('deleteClosure', { id: id}).then(({data}) => {
        VueOnToast.ToastService.pop('success', 'Cierre Eliminado', 'El cierre fue eliminado con éxito.');
        this.cierres = [];
        this.read();
      });
    },
    sendInfo(item) {
      this.selectedClosure = item;
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
        if (! this.permissionGenerator(seccion,constSystem.MAESTRO_CIERRES)) {

            this.$router.go(-1);
            
        }
    },

  },
  created() {
    this.read();
  }
}
</script>


