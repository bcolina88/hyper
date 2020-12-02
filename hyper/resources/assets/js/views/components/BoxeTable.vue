<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">

        <router-link :to="{ name: 'CrearCaja'}">
          <b-button variant="success" v-if="permissionGenerator('agregar',maestroo)"><i class="fa fa-plus"></i>&nbsp; Nueva Caja</b-button>
        </router-link>
 

        <br><br> 


        <b-card header="Listado de cajas">
  
          <div class="col-sm-2 mb-5">
            <label> Por página</label>
            <b-form-select :options="pageOptions" v-model="perPage">
            </b-form-select>
          </div>
      
          <div>
            <div v-if="!hasRecords" style="text-align: center"><br><br>No hay Datos para Mostrar...</div>
            <div v-if="hasRecords">

            <b-table responsive :items="cajas" :fields="fields" :current-page="currentPage" :per-page="perPage">

          

              <template slot="options" slot-scope="row">
            
                <router-link :to="{ name: 'EditarCaja', params: { id: row.item.id }}">
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

    <b-modal id="myModal" title="Eliminar"  @ok="del(selectedBoxe.id)" class="text-center">
      <h6>Eliminar caja {{selectedBoxe.id}}</h6>
      <h6>¿Estas seguro que deseas eliminar caja {{selectedBoxe.id}} ?</h6>
    </b-modal>

    
  </div>

</template>

<script>



function Cajas({ id, descripcion, tipo, monto, fecha}) {
  this.id = id;
  this.descripcion = descripcion;
  this.monto = monto;
  this.tipo = tipo;
  this.fecha = fecha;
}


import VueOnToast from 'vue-on-toast';
import constSystem from '../../_const';

export default {
  name: 'boxe-table',
  components: {
    VueOnToast
  },
  data () {
    return {
      cajas: [],
      ruta: this.$route.name,
      maestroo: constSystem.MAESTRO_CAJAS,
      permisos : this.$store.getters.permisos,
      selectedBoxe: '',
      selectAll: false,
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
        descripcion: {
          label: 'Descripción',
          sortable: true,
          class: 'text-center'
        },
        tipo: {
          label: 'Tipo de caja',
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
      return this.cajas.length > 0;
    },
    totalRows() {
      return this.cajas.length;
    }
  },
  methods: {

    read() {
      this.$store.dispatch('getBoxes', null).then(({data}) => {
        data.cajas.forEach(cajas => {
          this.cajas.push(new Cajas(cajas));
        });
      });
    },
    del(id) {
      this.$store.dispatch('deleteBoxe', { id: id}).then(({data}) => {
        VueOnToast.ToastService.pop('success', 'Caja Eliminada', 'La caja fue eliminada con éxito.');
        this.cajas = [];
        this.read();
      });
    },
    sendInfo(item) {
      this.selectedBoxe = item;
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
        if (! this.permissionGenerator(seccion,constSystem.MAESTRO_CAJAS)) {

            this.$router.go(-1);
            
        }
    },
  },
  created() {
    this.read();
  }
}
</script>


