<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">

        <router-link :to="{ name: 'CrearCampana'}">
          <b-button variant="success" v-if="permissionGenerator('agregar',maestroo)"><i class="fa fa-plus"></i>&nbsp; Nueva
Campaña</b-button>
        </router-link>
 

        <br><br> 


        <b-card header="Listado de campañas">
  
          <div class="col-sm-2 mb-5">
            <label> Por página</label>
            <b-form-select :options="pageOptions" v-model="perPage">
            </b-form-select>
          </div>
      
          <div>
            <div v-if="!hasRecords" style="text-align: center"><br><br>No hay Datos para Mostrar...</div>
            <div v-if="hasRecords">

            <b-table responsive :items="ventas" :fields="fields" :current-page="currentPage" :per-page="perPage">


              <template slot="active" slot-scope="row">
                    {{ row.item.active ? 'Habilitado' : 'Deshabilitado' }}
              </template>

               <template slot="completada" slot-scope="row">
                    {{ row.item.completada ? 'Si' : 'No' }}
              </template>



              <template slot="options" slot-scope="row">
            
                <router-link :to="{ name: 'EditarCampana', params: { id: row.item.id }}">
                  <span v-if="permissionGenerator('editar',maestroo)" class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Editar" >
                    <i class="icon-pencil icons font-2xl mr-2"></i>
                  </span>
                </router-link> 

                <span v-if="permissionGenerator('borrar',maestroo)" class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
                  <i class="icon-trash icons font-2xl mr-2" v-b-modal="'myModal'" @click="sendInfo(row.item)"></i>
                </span>

                 <!-- Active -->

                <button  v-if="permissionGenerator('inhabilitar',maestroo)" type="button" @click="status(row.item.id,row.item.active)" v-show="!row.item.active" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Habilitar">
                  <i class="fa fa-toggle-on text-success-lter"></i>
                </button>

                <button  v-if="permissionGenerator('inhabilitar',maestroo)" type="button" @click="status(row.item.id,row.item.active)" v-show="row.item.active" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Deshabilitar">
                  <i class="fa fa-toggle-off text-light-dker"></i>
                </button>

                <!-- Active -->


                <!-- Completar -->

                <button type="button"  @click="completar(row.item.id,row.item.completada)" v-show="!row.item.completada" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Completar">
                  <i class="fa fa-star text-success-lter"></i>
                </button>

                <button   type="button"  @click="completar(row.item.id,row.item.completada)" v-show="row.item.completada" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Sin completar">
                  <i class="fa fa-star-half-empty text-light-dker"></i>
                </button>

                <!-- Completar -->
          


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

    <b-modal id="myModal" title="Eliminar"  @ok="del(selectedUser.id)" class="text-center">
      <h6>Eliminar campaña #{{selectedUser.id}}</h6>
      <h6>¿Estas seguro que deseas eliminar esta campaña #{{selectedUser.id}} ?</h6>
    </b-modal>

    
  </div>

</template>

<script>



function Ventas({ id,name, fecha_inicial, fecha_fin, palanca, tiempo, alcance, active, completada}) {

  this.id = id;
  this.name = name;
  this.fecha_inicial = fecha_inicial;
  this.fecha_fin = fecha_fin;
  this.tiempo = tiempo;
  this.alcance = alcance;
  this.palanca = palanca.name;
  this.active = active;
  this.completada = completada;


}


import VueOnToast from 'vue-on-toast';
import constSystem from '../../_const';

export default {
  name: 'sale-table',
  components: {
    VueOnToast
  },
  data () {
    return {
      ventas: [],
      imagenLogo:'',
      SelectCurrency:0,
      largeModal2: false,
      listCurrency: [],
      efectivo : 0,
      debito : 0,
      cheque : 0,
      transferencia : 0,
      inputDescription:'',
      otros : 0,
      currency :'',
      ruta: this.$route.name,
      maestroo: 1,
      permisos : this.$store.getters.permisos,
      selectedUser: '',
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
        name: {
          label: 'Nombre',
          sortable: true,
          class: 'text-center'
        },
        fecha_inicial: {
          label: 'Fecha Inicial',
          sortable: true,
          class: 'text-center'
        },
        fecha_fin: {
          label: 'Fecha Fin',
          sortable: true,
          class: 'text-center'
        },
        tiempo: {
          label: 'Tiempo',
          sortable: true,
          class: 'text-center'
        },
        alcance: {
          label: 'Alcance',
          sortable: true,
          class: 'text-center'
        },
        palanca: {
          label: 'Palanca',
          sortable: true,
          class: 'text-center'
        },
        completada: {
          label: 'Completada',
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

    this.denyAccessIfNotAuthorized ('ver', 'Dashboard', 'No tienes permisos para ver a los campaña.');
  },
  computed: {
    hasRecords() {
      return this.ventas.length > 0;
    },
    totalRows() {
      return this.ventas.length;
    }
  },
  methods: {

    read() {

      axios.get("api/Campanas",null).then(res => {

          res.data.forEach(user => {
              this.ventas.push(new Ventas(user));
          });

      })
      .catch(error => {
         alert(error)
      });


    },
    del(id) {
      this.$store.dispatch('deleteCampana', { id: id}).then( data => {
        VueOnToast.ToastService.pop('success', 'La campaña  fue eliminado', 'La campaña fue eliminado con éxito.');
        this.ventas = [];
        this.read();
      });
    },
    sendInfo(item) {
      this.selectedUser = item;
    },
    status(id,value) {

      if (value) {
        status = 0;
      }else{
        status = 1;
      }

      this.$store.dispatch('blockedCampana', { id: id, status : status}).then( data => {
        VueOnToast.ToastService.pop('success', 'Estatus cambiado', 'La campaña cambio de estatus con éxito.');
        this.ventas = [];
        this.read();
      });
    },
    completar(id,value1) {

      if (value1) {
        status = 0;
      }else{
        status = 1;
      }

      this.$store.dispatch('completCampana', { id: id, status : status}).then( data => {
        VueOnToast.ToastService.pop('success', 'Estado cambiado', 'La campaña cambio de estado con éxito.');
        this.ventas = [];
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
        if (! this.permissionGenerator(seccion,constSystem.MAESTRO_CAMPANA)) {

            this.$router.go(-1);
            
        }
    },
  },
  created() {
    this.read();
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">

</style>


