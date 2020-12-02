<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">

        <router-link :to="{ name: 'CrearProyecto'}">
          <b-button variant="success" v-if="permissionGenerator('agregar',maestroo)"><i class="fa fa-plus"></i>&nbsp; Nuevo 
Proyecto</b-button>
        </router-link>
 

        <br><br> 


        <b-card header="Listado de proyectos">
  
          <div class="col-sm-2 mb-5">
            <label> Por página</label>
            <b-form-select :options="pageOptions" v-model="perPage">
            </b-form-select>
          </div>
      
          <div>
            <div v-if="!hasRecords" style="text-align: center"><br><br>No hay Datos para Mostrar...</div>
            <div v-if="hasRecords">

            <b-table responsive :items="ventas" :fields="fields" :current-page="currentPage" :per-page="perPage">

              <template slot="tipo_proy" slot-scope="row">
                    {{ row.item.tipo_proy ==="freelancer" ? 'Freelancer' : 'No Freelancer'  }}
              </template>

              <template slot="active" slot-scope="row">
                    {{ row.item.active ? 'Habilitado' : 'Deshabilitado'  }}
              </template>

              <template slot="options" slot-scope="row">
            
                <router-link :to="{ name: 'EditarProyecto', params: { id: row.item.id }}">
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
      <h6>Eliminar proyecto #{{selectedUser.id}}</h6>
      <h6>¿Estas seguro que deseas eliminar este proyecto #{{selectedUser.id}} ?</h6>
    </b-modal>

    
  </div>

</template>

<script>



function Ventas({ id,name, tipo_proy, active}) {

  this.id = id;
  this.name = name;
  this.tipo_proy = tipo_proy;
  this.active = active;

}


import VueOnToast from 'vue-on-toast';
import constSystem from '../../_const';

export default {
  name: 'palanca-table',
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
      inputDescription:'',
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
        tipo_proy: {
          label: 'Tipo proyecto',
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

    this.denyAccessIfNotAuthorized ('ver', 'Dashboard', 'No tienes permisos para ver a los proyectos.');
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


      axios.get("api/Proyectos",null).then(res => {

          res.data.forEach(user => {
              this.ventas.push(new Ventas(user));
          });

      })
      .catch(error => {
         alert(error)
      });


    },
    del(id) {
      this.$store.dispatch('deleteProyecto', { id: id}).then( data => {
        VueOnToast.ToastService.pop('success', 'El objetivo  fue eliminado', 'El proyecto fue eliminado con éxito.');
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

      this.$store.dispatch('blockedProyecto', { id: id, status : status}).then( data => {
        VueOnToast.ToastService.pop('success', 'Estatus cambiado', 'El proyecto cambio de estatus con éxito.');
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
        if (! this.permissionGenerator(seccion,constSystem.MAESTRO_PROYECTO)) {

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


