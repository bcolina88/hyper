<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">

        <router-link :to="{ name: 'CrearGasto'}">
          <b-button variant="success" v-if="permissionGenerator('agregar',maestroo)"><i class="fa fa-plus"></i>&nbsp; Nuevo Gasto</b-button>
        </router-link>
 

        <br><br> 


        <b-card header="Listado de gastos">
  
          <div class="col-sm-2 mb-5">
            <label> Por página</label>
            <b-form-select :options="pageOptions" v-model="perPage">
            </b-form-select>
          </div>
      
          <div>
            <div v-if="!hasRecords" style="text-align: center"><br><br>No hay Datos para Mostrar...</div>
            <div v-if="hasRecords">

            <b-table responsive :items="gastos" :fields="fields" :current-page="currentPage" :per-page="perPage">

          

              <template slot="options" slot-scope="row">
            
                <router-link :to="{ name: 'EditarGasto', params: { id: row.item.id }}">
                  <span v-if="permissionGenerator('editar',maestroo)" class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Editar" >
                    <i class="icon-pencil icons font-2xl mr-2"></i>
                  </span>
                </router-link> 

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

    <b-modal id="myModal" title="Eliminar"  @ok="del(selectedExpense.id)" class="text-center">
      <h6>Eliminar gasto {{selectedExpense.id}}</h6>
      <h6>¿Estas seguro que deseas eliminar gasto {{selectedExpense.id}} ?</h6>
    </b-modal>

    
  </div>

</template>

<script>



function Gastos({ id, nombre, metodo_pago, monto, fecha}) {
  this.id = id;
  this.nombre = nombre;
  this.monto = monto;
  this.metodo_pago = metodo_pago;
  this.fecha = fecha;
}


import VueOnToast from 'vue-on-toast';
import constSystem from '../../_const';


export default {
  name: 'expense-table',
  components: {
    VueOnToast
  },
  data () {
    return {
      gastos: [],
      ruta: this.$route.name,
      selectedExpense: '',
      selectAll: false,
      maestroo: constSystem.MAESTRO_GASTOS,
      permisos : this.$store.getters.permisos,
      perPage: 10,
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
        nombre: {
          label: 'Nombre',
          sortable: true,
          class: 'text-center'
        },
        metodo_pago: {
          label: 'Tipo de pago',
          sortable: true,
          class: 'text-center'
        },
        monto: {
          label: 'Monto',
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
      return this.gastos.length > 0;
    },
    totalRows() {
      return this.gastos.length;
    }
  },
  methods: {

    read() {
      this.$store.dispatch('getExpenses', null).then(({data}) => {
        data.gastos.forEach(gastos => {
          this.gastos.push(new Gastos(gastos));
        });
      });
    },
    del(id) {
      this.$store.dispatch('deleteExpense', { id: id}).then(({data}) => {
        VueOnToast.ToastService.pop('success', 'Gasto Eliminado', 'El gasto fue eliminado con éxito.');
        this.gastos = [];
        this.read();
      });
    },
    sendInfo(item) {
      this.selectedExpense = item;
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
        if (! this.permissionGenerator(seccion,constSystem.MAESTRO_GASTOS)) {

            this.$router.go(-1);
            
        }
    },
  },
  created() {
    this.read();
  }
}
</script>


