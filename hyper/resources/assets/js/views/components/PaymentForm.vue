<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">

        

        <b-card header="Pago de empleados">
  
          <div class="col-sm-2 mb-5">
            <label> Por página</label>
            <b-form-select :options="pageOptions" v-model="perPage">
            </b-form-select>
          </div>
      
          <div>
            <div v-if="!hasRecords" style="text-align: center"><br><br>No hay Datos para Mostrar...</div>
            <div v-if="hasRecords">


              <b-table :items="empleados" :fields="fields" :current-page="currentPage" :per-page="perPage">

                <template slot="sueldo_diario" slot-scope="row">
                    <input class="form-control" type="text"  :id="'sueldo_diario_'+row.item.id"  :name="'sueldo_diario_'+row.item.id" :value="row.item.sueldo_diario"  style="width: 70px;"></input>
                </template>

                <template slot="options" slot-scope="row">

                  <input :id="'empleado_'+row.item.id" :name="'empleado_'+row.item.id" type="checkbox">
                  
                </template>
                  
              </b-table>
                       
            </div>
          </div>


          {{inputDescription}}


          <div class="form-actions">

            <b-button  @click.prevent="submit" variant="success" style="height: 40px;float: right; bottom: 20px; right: 7px; z-index: 1000;">Pagar</b-button>

            <router-link :to="{ name: 'Pagos'}">
             <b-button type="button" style="height: 40px;float: right; bottom: 20px; right: 7px; z-index: 1000;" variant="secondary">Regresar</b-button>
            </router-link>
              
          </div>
        
          <br><br>

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

</template>

<script>

function Empleados({ id, rut, nombre, apellido, sueldo_mensual, sueldo_diario, role}) {

  this.id = id;
  this.rut = rut;
  this.name = nombre+' '+apellido;
  this.sueldo_mensual = sueldo_mensual;
  this.sueldo_diario = sueldo_diario;
  this.rol = role.name;
}


import VueOnToast from 'vue-on-toast';
import constSystem from '../../_const';

export default {
  name: 'payment-form',
  components: {
    VueOnToast
  },
  data () {
    return {
      empleados: [],
      payments: [],
      inputDescription:'',
      ruta: this.$route.name,
      selectedEmployee: '',
      selectAll: false,
      perPage: 5,
      ventana:'',
      currentPage: 1,
      permisos : this.$store.getters.permisos,
      maestroo: constSystem.MAESTRO_EMPLEADOS_PAGOS,
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
        rol: {
          label: 'Rol',
          sortable: true,
        },
        sueldo_diario: {
          label: 'Sueldo diario',
          sortable: true,
        },
        sueldo_mensual: {
          label: 'Sueldo mensual',
          sortable: true,
        },
        options: {
          label: 'Seleccione empleados a pagar',
        }
      }
    }
  },
  mounted: function() {

    if(this.ruta === 'CrearPagos'){
      this.ventana = 'Crear';
      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las categorias.');
    }

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
      this.$store.dispatch('getEmpleadosPayment', null).then(({data}) => {
        data.employeePayments.forEach(employee => {
          this.empleados.push(new Empleados(employee));
        });
      });

      this.$store.dispatch('getEmpresa', null).then(({data}) => {

          this.companys = data.companys;
          data.companys.forEach(company => {

              if(company){

                if(company.currency){
                  this.inputDescription = "Los sueldos se deben reflejar en ("+company.currency.description+")";
                }else{
                  this.inputDescription = "";
                }

              }


          });
      });

    },
    sendInfo(item) {
      this.selectedEmployee = item;
    },
    submit() {


        if(this.empleados.length > 0){

          for(let i=0;i < this.empleados.length;i++){

              let id = this.empleados[i].id;

             if($('[name="empleado_'+id+'"]').is(":checked")){

                let pay = {};

                pay.sueldo_diario = $('[name="sueldo_diario_'+id+'"]').val();
                pay.id = id;

                this.payments.push(pay);

             };

          }

        }


        if(this.payments.length === 0){


            VueOnToast.ToastService.pop('error', 'Error al crear los pagos', 'Debe seleccionar al menos un empleado a pagar');

        }else{



            this.$store.dispatch('getEmpresa', null).then(({data}) => {

              data.companys.forEach(company => {

                  if(company){

                    if(company.currency){


                        this.$store.dispatch('createPayment', { 

                          payments: this.payments
                 
                        })
                        .then(res => {
                              if(res.errors) {
                                this.errors = [];
                                VueOnToast.ToastService.pop('error', 'Error al crear los pagos', 'Verifique las opciones seleccionadas e intente nuevamente realizar los pagos');
                              }else{
                                
                                VueOnToast.ToastService.pop('success', 'Pagos creados', 'Los Pagos fueron creados con éxito.');
                                this.empleados = [];
                                this.payments = [];
                                this.read();
                              }
                        });


                    }else{
                      $('#myModal').modal('toggle');
                    }

                  }
              });
            });    

        }

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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_EMPLEADOS_PAGOS)) {

            this.$router.go(-1);
            
        }
    },
  },
  created() {
    this.read();
  }
}
</script>


