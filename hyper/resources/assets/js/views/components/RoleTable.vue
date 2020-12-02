<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">

        <router-link :to="{ name: 'CrearRol'}">
          <b-button variant="success" v-if="permissionGenerator('agregar',maestroo)"><i class="fa fa-plus"></i>&nbsp; Nuevo Rol</b-button>
        </router-link>
 

        <br><br> 


        <b-card header="Listado de roles">
  
          <div class="col-sm-2 mb-5">
            <label> Por página</label>
            <b-form-select :options="pageOptions" v-model="perPage">
            </b-form-select>
          </div>
      
          <div>
            <div v-if="!hasRecords" style="text-align: center"><br><br>No hay Datos para Mostrar...</div>
            <div v-if="hasRecords">

            <b-table responsive :items="roles" :fields="fields" :current-page="currentPage" :per-page="perPage">

              <template slot="active" slot-scope="row">
                    {{ row.item.active ? 'Habilitado' : 'Deshabilitado' }}
              </template>

              <template slot="options" slot-scope="row">
            
                <router-link :to="{ name: 'EditarRol', params: { id: row.item.id }}">
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

    <b-modal id="myModal" title="Eliminar"  @ok="del(selectedRole.id)" class="text-center">
      <h6>Eliminar rol {{selectedRole.name}}</h6>
      <h6>¿Estas seguro que deseas eliminar rol {{selectedRole.name}} ?</h6>
    </b-modal>

    
  </div>

</template>

<script>



function Roles({ id, name, active}) {
  this.id = id;
  this.name = name;
  this.active = active;

}


import VueOnToast from 'vue-on-toast';
import constSystem from '../../_const';
import { http, str } from '../../utils';
 

export default {
  name: 'role-table',
  components: {
    VueOnToast
  },
  data () {
    return {
      roles: [],
      ruta: this.$route.name,
      permisos : this.$store.getters.permisos,
      maestroo: constSystem.MAESTRO_ROLES,
      selectedRole: '',
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
      return this.roles.length > 0;
    },
    totalRows() {
      return this.roles.length;
    }
  },
  methods: {

    read() {


      http.get("api/Roles",null).then((res) => {

          res.data.forEach(rol => {
              this.roles.push(new Roles(rol));
          });

      })
      .catch(error => {
         alert(error)
      });


    },
    del(id) {
      this.$store.dispatch('deleteRole', { id: id}).then( data => {
        VueOnToast.ToastService.pop('success', 'Rol Eliminado', 'El rol fue eliminado con éxito.');
        this.roles = [];
        this.read();
      });
    },
    sendInfo(item) {
      this.selectedRole = item;
    },
    status(id,value) {

      if (value) {
        status = 0;
      }else{
        status = 1;
      }

      this.$store.dispatch('blockedRole', { id: id, status : status}).then( data => {
        VueOnToast.ToastService.pop('success', 'Estatus cambiado', 'El rol cambio de estatus con éxito.');
        this.roles = [];
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
        if (! this.permissionGenerator(seccion,constSystem.MAESTRO_ROLES)) {

            this.$router.go(-1);
            
        }
    },
  },
  created() {
    this.read();
  }
}
</script>


