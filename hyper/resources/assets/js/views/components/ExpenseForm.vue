<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-6">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>Gasto</small>
          </div>
          <form action="" >
            <div class="row">

                <div class="col-sm-12"><span v-for="error in errors" class="text-danger">{{ error }}<br></span></div>
                
                <div class="col-sm-12">
                  <b-form-fieldset label="Nombre">
                    <input class="form-control" type="text" name="nombre" v-model="nombre" placeholder="Ingrese nombre"></input>
                  </b-form-fieldset>
                </div>
                <div class="col-sm-12">
                  <b-form-fieldset label="Tipo de gasto">
                    <b-form-select
                      name="metodo"
                      v-model="metodo"
                      :plain="true"
                      :options="metodos"
                      value="0">
                    </b-form-select>
                  </b-form-fieldset>
                </div>
                <div class="col-sm-12">
                  <b-form-fieldset label="Monto" :description="inputDescription">
                    <input class="form-control" type="text" id="monto" v-model="monto" placeholder="0.00"></input>
                  </b-form-fieldset>
                </div>
            </div>
            <div class="form-actions">
              <b-button v-if="ventana === 'Crear'" @click.prevent="submit" variant="success">Guardar</b-button>
              <b-button v-if="ventana === 'Editar'" @click.prevent="edit" variant="success">Editar</b-button>
              <router-link :to="{ name: 'Gastos'}">
                <b-button type="button" variant="secondary">Regresar</b-button>
              </router-link>
              
              
            </div>
          </form>

        </b-card>
      </div>
      <div class="col-sm-3"></div> 
      <toast-container></toast-container>
    </div>



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

import VueOnToast from 'vue-on-toast'
import constSystem from '../../_const';

export default {
  name: 'employee-form',
  components: {
    VueOnToast
  },
  data () {
    return {
      errors: [],
      metodo: '',
      nombre:'',
      monto:'',
      inputDescription:'',
      ruta: this.$route.name,
      ventana:'',
      metodos:["Efectivo","Debito","Cheque","Transferencia","Otros"],
      maestroo: constSystem.MAESTRO_GASTOS,
      permisos : this.$store.getters.permisos,

    }
  },
  mounted: function() {

    if (this.ruta === 'EditarGasto') {


      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

      this.ventana = 'Editar';

      this.$store.dispatch('expenseById', { id: this.$route.params.id})
        .then(({data}) => {

           this.nombre = data.expenseById.nombre;
           this.metodo = data.expenseById.metodo_pago; 
           this.monto = data.expenseById.monto; 

        });
    }

    if(this.ruta === 'CrearGasto'){
      this.ventana = 'Crear';
      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las categorias.');
    }
  }, 
  methods: {
    displayError(res) {


      VueOnToast.ToastService.pop('error', 'Error al crear gasto', 'Corrija para poder crear con éxito');
      
    },
    read() {

      this.$store.dispatch('getEmpresa', null).then(({data}) => {

          this.companys = data.companys;
          data.companys.forEach(company => {

              if(company){

                if(company.currency){
                  this.inputDescription = "Los montos se deben reflejar en ("+company.currency.description+")";
                }else{
                  this.inputDescription = "";
                }

              }


          });
      });

    },
    submit() {


      this.$store.dispatch('getEmpresa', null).then(({data}) => {

          data.companys.forEach(company => {

              if(company){

                if(company.currency){

  
                      this.$store.dispatch('createExpense', { nombre: this.nombre, monto: this.monto, metodo_pago:this.metodo})
                      .then(res => {
                          if(res.errors) {
                            this.errors = [];
                            this.displayError(res)
                          }else{
                            this.errors = [];
                            this.nombre = '';
                            this.metodo = '';
                            this.monto = '';
                            VueOnToast.ToastService.pop('success', 'Gasto creado', 'El gasto fue creado con éxito.');
                          }
                      });

                }else{
                   $('#myModal').modal('toggle');
                }

              }


          });
      });    
    },
    edit() {


      this.$store.dispatch('getEmpresa', null).then(({data}) => {

          data.companys.forEach(company => {

              if(company){

                if(company.currency){
  
                    this.$store.dispatch('updateExpense', { id: this.$route.params.id, nombre: this.nombre, monto: this.monto, metodo_pago:this.metodo})
                    .then(res => {
                        if(res.errors) {
                          this.errors = [];
                          this.displayError(res)
                        }else{
                          this.errors = [];
                          this.nombre = '';
                          this.metodo = '';
                          this.monto = '';
                          VueOnToast.ToastService.pop('success', 'Gasto editado', 'El gasto fue editado con éxito.');
                        }
                    });

                }else{
                   $('#myModal').modal('toggle');
                }

              }


          });
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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_GASTOS)) {

            this.$router.go(-1);
            
        }
    }
  },
  created() {
    this.read();
  }
}
</script>
