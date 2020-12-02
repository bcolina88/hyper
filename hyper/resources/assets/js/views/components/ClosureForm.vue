<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">

        <b-card header="Crear cierre">

            <div class="box-body">
              <div class="row invoice-info">
                  
                  <div class="col-sm-6 invoice-col">
                    <div class="box">
                        <div class="box-header">
                          <p class="lead">Lista de gastos</p>
                        </div>
                    </div>

                    <b-table :items="gastos" :fields="fields"></b-table>
                    <table class="table table-striped">
                          <tr>
                            <th style="width: 40px"></th>
                            <th style="width: 40px"></th>
                            <th style="width: 40px"></th>
                            <th style="width: 40px"><b>TOTAL:</b></th>
                            <th style="width: 40px"><b>$ {{total_gastos}}</b></th>
                          </tr>
                    </table>

                  </div>
                  <div class="col-sm-6 invoice-col">
                    <div class="box">
                      <div class="box-header">
                        <p class="lead">Pagos Empleados </p>
                      </div>
                    </div>

                    <b-table :items="pagos" :fields="fields"></b-table>
                    <table class="table table-striped">
                          <tr>
                            <th style="width: 50px"></th>
                            <th style="width: 50px"></th>
                            <th style="width: 50px"></th>
                            <th style="width: 50px"><b>TOTAL:</b></th>
                            <th style="width: 40px"><b>$ {{total_pago}}</b></th>
                          </tr>
                    </table>

                  </div>

                  <br><br>

                  <div class="col-sm-12">
                      <div class="box">
                        <div class="box-header">
                           <p class="lead">Ventas Pagados hoy </p>
                        </div>
                      </div>

                      <b-table :items="ventas" :fields="fields_ventas"></b-table>
                      <table class="table table-striped">
                          <tr>
                            <th style="width: 50px"></th>
                            <th style="width: 50px"></th>
                            <th style="width: 50px"></th>
                            <th style="width: 50px"><b>TOTAL:</b></th>
                            <th style="width: 35px"><b>$ {{total_ventas}}</b></th>
                          </tr>
                    </table>
                  </div>

              </div>
              <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-2 col-xs-2">
                        <div class="description-block border-right">
                          <h5 class="description-header">$ {{total_efectivo}}<br></h5>
                          <span class="description-text">TOTAL EFECTIVO</span>
                        </div>
                        <!-- /.description-block -->
                      </div>

                      <div class="col-sm-2 col-xs-2">
                            <div class="description-block border-right">
                              <h5 class="description-header">$ {{total_debito}} <br></h5>
                              <span class="description-text">TOTAL DEBITO</span>
                            </div>
                        <!-- /.description-block -->
                      </div>

                      <div class="col-sm-2 col-xs-2">
                        <div class="description-block border-right">
                          <h5 class="description-header">$ {{total_cheque}}<br></h5>
                          <span class="description-text">TOTAL CHEQUE</span>
                        </div>
                        <!-- /.description-block -->
                      </div>

                      <div class="col-sm-2 col-xs-2">
                        <div class="description-block">
                          <h5 class="description-header">$ {{total_transferencia}}<br></h5>
                          <span class="description-text">TOTAL TRANSF.</span>
                        </div>
                        <!-- /.description-block -->
                      </div>


                      <div class="col-sm-2 col-xs-2">
                        <div class="description-block border-right">
                          <h5 class="description-header">$ {{total_otros}}<br></h5>
                          <span class="description-text">TOTAL Otros</span>
                        </div>
                        <!-- /.description-block -->
                      </div>

                      <div class="col-sm-2 col-xs-2">
                        <div class="description-block border-right">
                          <h5 class="description-header">$ {{caja_apertura}} Mañana<br>
                          $ {{caja_cierre}} Noche</h5>
                          <span class="description-text">CAJAS</span>
                        </div>
                        <!-- /.description-block -->
                      </div>

                      <div class="col-sm-2 col-xs-2">
                        <div class="description-block border-right">
                        <h5 class="description-header">Retiro<br>
                        <input type="text" id="retiro" name="retiro" v-model="retiro" value="0" class="form-control" >
                        </div>
                        <!-- /.description-block -->
                      </div>

                      <div class="col-sm-2 col-xs-2">
                        <div class="description-block border-right">
                        <h5 class="description-header">Total cuadre<br>
                        <input type="text" id="total_cuadre" name="total_cuadre" v-model="total_cuadre" value="0" class="form-control" >
                        </div>
                        <!-- /.description-block -->
                      </div>

                    </div>
                  </div>

              <div class="col-xs-12">
                <br>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">

                   <textarea rows="2" class="form-control" name="notas" id="notas" v-model="notas" placeholder="Notas..."></textarea>

                </p>

                <br>

              
              </div>
        <!-- /.col -->

         <div class="form-actions">

            <b-button style="height: 40px;float: right; bottom: 20px; right: 7px; z-index: 1000;" @click.prevent="submit" v-if="hasRecords" variant="success">Cerrar dia</b-button>

            <router-link :to="{ name: 'Cierres'}">
             <b-button type="button" style="height: 40px;float: right; bottom: 20px; right: 7px; z-index: 1000;" variant="secondary">Regresar</b-button>
            </router-link>
              
          </div>
  
        </b-card>
         
        </div>
      </div>
    </div>
   <toast-container></toast-container>
  </div>

</template>

<script>


function Gastos({ id, monto, fecha, nombre}) {
  this.id = id;
  this.monto = monto;
  this.fecha = fecha;
  this.nombre = nombre;
}

function Pagos({ id, employee, sueldo_diario, fecha }) {
  this.id = id;
  this.monto = sueldo_diario;
  this.fecha = fecha;
  this.nombre = employee.nombre+' '+employee.apellido;
}

function Ventas({ id, date, total }) {
  this.id = id;
  this.monto = total;
  this.fecha = date;

}

import VueOnToast from 'vue-on-toast'
import constSystem from '../../_const';
export default {
  name: 'closure-form',
  components: {
    VueOnToast
  },
  data () {
    return {
      errors: [],
      name:'',
      ruta: this.$route.name,
      ventana:'',
      total_otros:'',
      caja_apertura:'',
      caja_cierre:'',
      total_debito:'',
      total_efectivo:'',
      total_cheque:'',
      total_transferencia:'',
      restante:'',
      total_gastos:'',
      gastos: [],
      pagos: [],
      ventas: [],
      total_ventas:'',
      total_pago:'',
      notas:'',
      total_cuadre:0,
      maestroo: constSystem.MAESTRO_CIERRES,
      permisos : this.$store.getters.permisos,
      retiro:0,
      is_closure:'',
      fields: {
        id: {
          label: '#',
          sortable: true,
          class: 'text-center'
        },
        nombre: {
          label: 'Nombre',
          sortable: true,
          class: 'text-center'
        },
        fecha: {
          label: 'Fecha',
          sortable: true,
          class: 'text-center'
        },
        monto: {
          label: 'Monto',
          sortable: true,
          class: 'text-center'
        }
      },
      fields_ventas: {
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
        monto: {
          label: 'Monto',
          sortable: true,
          class: 'text-center'
        }
      }
    }
  },
  mounted: function() {


    if(this.ruta === 'CrearCierre'){

      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

      this.ventana = 'Crear';
      this.read();
    }

  },
  computed: {
    hasRecords() {
      return !this.is_closure;
    }
  }, 
  methods: {
    read() {

      this.$store.dispatch('cierreDia', null).then(({data}) => {

          this.total_otros = data.cierreDia.total_otros;
          this.caja_apertura = data.cierreDia.caja_apertura;
          this.caja_cierre = data.cierreDia.caja_cierre;
          this.total_debito = data.cierreDia.total_debito;
          this.total_efectivo = data.cierreDia.total_efectivo;
          this.total_cheque = data.cierreDia.total_cheque;
          this.total_transferencia = data.cierreDia.total_transferencia;
          this.restante = data.cierreDia.restante;
          this.total_gastos = data.cierreDia.total_gastos;
          this.total_pago = data.cierreDia.total_pago;
          this.total_ventas = data.cierreDia.total_ventas;
          this.is_closure = data.cierreDia.is_closure;

          data.cierreDia.gastos.forEach(gasto => {
              this.gastos.push(new Gastos(gasto));
          });

          data.cierreDia.pagos.forEach(pago => {
              this.pagos.push(new Pagos(pago));
          });

          data.cierreDia.ventas.forEach(venta => {
              this.ventas.push(new Ventas(venta));
          });

      });
      
    },
    displayError(res) {

      VueOnToast.ToastService.pop('error', 'Error al crear cierre', 'Corrija para poder crear con éxito');
      
    },
    submit() {
  
        this.$store.dispatch('createClosure', { 

          total_efectivo: this.total_efectivo,
          total_debito:this.total_debito,
          total_cheque:this.total_cheque,
          total_pago:this.total_pago,
          total_otros:this.total_otros,
          total_ventas:this.total_ventas,
          total_gastos:this.total_gastos,
          total_transferencia:this.total_transferencia,
          caja_apertura:this.caja_apertura,
          caja_cierre:this.caja_cierre,
          notas:this.notas,
          retiro:this.retiro,
          total_cuadre:this.total_cuadre,

        })
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.gastos = [];
              this.pagos = [];
              this.ventas = [];
              this.read();
              VueOnToast.ToastService.pop('success', 'Cierre creado', 'El cierre del dia fue creado con éxito.');
            }
        });
    
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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_CIERRES)) {

            this.$router.go(-1);
            
        }
    },
  },
  created() {
    this.read();
  }
}
</script>
