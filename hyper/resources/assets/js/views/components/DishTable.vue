<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">

        <router-link :to="{ name: 'CrearPlatoBebida'}">
          <b-button variant="success" v-if="permissionGenerator('agregar',maestroo)"><i class="fa fa-plus"></i>&nbsp; Nuevo plato / bebida</b-button>
        </router-link>
 

        <br><br> 


        <b-card header="Listado de platos / bebidas">
  
          <div class="col-sm-2 mb-5">
            <label> Por página</label>
            <b-form-select :options="pageOptions" v-model="perPage">
            </b-form-select>
          </div>
      
          <div>
            <div v-if="!hasRecords" style="text-align: center"><br><br>No hay Datos para Mostrar...</div>
            <div v-if="hasRecords">

            <b-table responsive :items="dishs" :fields="fields" :current-page="currentPage" :per-page="perPage">


              <template slot="active" slot-scope="row">
                    {{ row.item.active ? 'Habilitado' : 'Deshabilitado' }}
              </template>

              <template slot="options" slot-scope="row">
            
                <router-link :to="{ name: 'EditarPlatoBebida', params: { id: row.item.id }}">
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

    <b-modal id="myModal" title="Eliminar"  @ok="del(selectedDish.id)" class="text-center">
      <h6>Eliminar plato {{selectedDish.name}}</h6>
      <h6>¿Estas seguro que deseas eliminar este plato {{selectedDish.name}} ?</h6>
    </b-modal>

    
  </div>

</template>

<script>



function Productos({  id, name, code, price, description, category, active, stock, stock_min}) {

  this.id = id;
  this.name = name;
  this.code = code;
  this.price = price;


  var srt = description;
  var description_final = srt.substring(0,80);
  description_final = description_final+"...";

  this.description = description_final;



  this.category = category.name; 
  this.active = active;
  this.stock = stock;
  this.stock_min = stock_min;

}


import VueOnToast from 'vue-on-toast';
import constSystem from '../../_const';

export default {
  name: 'dish-table',
  components: {
    VueOnToast
  },
  data () {
    return {
      dishs: [],
      ruta: this.$route.name,
      selectedDish: '',
      selectAll: false,
      perPage: 10,
      maestroo: constSystem.MAESTRO_PLATOS_BEBIDAS,
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
        code: {
          label: 'Codigo',
          sortable: true,
          class: 'text-center'
        },
        price: {
          label: 'Precio',
          sortable: true,
          class: 'text-center'
        },
        description: {
          label: 'Descripción',
          sortable: true,
          class: 'text-center'
        },
        category: {
          label: 'Categoria',
          sortable: true,
          class: 'text-center'
        },
        stock: {
          label: 'Stock',
          sortable: true,
          class: 'text-center'
        },
        stock_min: {
          label: 'Stock Minimo',
          sortable: true,
          class: 'text-center'
        },
        active: {
          label: 'Estatus',
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
      return this.dishs.length > 0;
    },
    totalRows() {
      return this.dishs.length;
    }
  },
  methods: {

    read() {
      this.$store.dispatch('getPlatos', null).then(({data}) => {
        data.dishs.forEach(product => {
          this.dishs.push(new Productos(product));
        });
      });
    },
    del(id) {
      this.$store.dispatch('deleteDish', { id: id}).then(({data}) => {
        VueOnToast.ToastService.pop('success', 'Plato/bebida Eliminado', 'El plato/bebida fue eliminado con éxito.');
        this.dishs = [];
        this.read();
      });
    },
    sendInfo(item) {
      this.selectedDish = item;
    },
    status(id,value) {

      if (value) {
        status = false;
      }else{
        status = true;
      }

      this.$store.dispatch('blockedDish', { id: id, status : status}).then(({data}) => {
        VueOnToast.ToastService.pop('success', 'Estatus cambiado', 'El plato/bebida cambio de estatus con éxito.');
        this.dishs = [];
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
        if (! this.permissionGenerator(seccion,constSystem.MAESTRO_PLATOS_BEBIDAS)) {

            this.$router.go(-1);
            
        }
    },

  },
  created() {
    this.read();
  }
}
</script>


