<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-6">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>Caja</small>
          </div>
          <form action="" >
            <div class="row">

                <div class="col-sm-12"><span v-for="error in errors" class="text-danger">{{ error }}<br></span></div>
                
               
                <div class="col-sm-12">
                    <b-form-fieldset label="Descripción">
                       <textarea class="form-control" :rows="9" name="description" v-model="description" placeholder="Descripción..">{{ description }}</textarea>
                    </b-form-fieldset>
                </div>
                <div class="col-sm-12">
                  <b-form-fieldset label="Tipo de caja">
                    <b-form-select
                      name="tipo"
                      v-model="tipo"
                      :plain="true"
                      :options="tipos"
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
              <router-link :to="{ name: 'Cajas'}">
                <b-button type="button" variant="secondary">Regresar</b-button>
              </router-link>
              
              
            </div>
          </form>

        </b-card>
      </div>
      <div class="col-sm-3"></div> 
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
   
  </div>
</template>

<script>

import VueOnToast from 'vue-on-toast'
import constSystem from '../../_const';
export default {
  name: 'boxe-form',
  components: {
    VueOnToast
  },
  data () {
    return {
      errors: [],
      tipo: '',
      description:'',
      monto:'',
      inputDescription:'',
      ruta: this.$route.name,
      ventana:'',
      tipos:["Apertura","Cierre"],
      maestroo: constSystem.MAESTRO_CAJAS,
      permisos : this.$store.getters.permisos,

    }
  },
  mounted: function() {

    if (this.ruta === 'EditarCaja') {

      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

      this.ventana = 'Editar';

      this.$store.dispatch('boxeById', { id: this.$route.params.id})
        .then(({data}) => {

           this.description = data.boxeById.descripcion;
           this.tipo = data.boxeById.tipo; 
           this.monto = data.boxeById.monto; 

        });
    }

    if(this.ruta === 'CrearCaja'){
      this.ventana = 'Crear';
      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las categorias.');
    }
  }, 
  methods: {
    displayError(res) {


      VueOnToast.ToastService.pop('error', 'Error al crear caja', 'Corrija para poder crear con éxito');
      
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

  
                    this.$store.dispatch('createBoxe', { descripcion: this.description, monto: this.monto, tipo:this.tipo})
                    .then(res => {
                        if(res.errors) {
                          this.errors = [];
                          this.displayError(res)
                        }else{
                          this.errors = [];
                          this.description = '';
                          this.tipo = '';
                          this.monto = '';
                          VueOnToast.ToastService.pop('success', 'Caja creada', 'La caja fue creada con éxito.');
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

  
                    this.$store.dispatch('updateBoxe', { id: this.$route.params.id, descripcion: this.description, monto: this.monto, tipo:this.tipo})
                    .then(res => {
                        if(res.errors) {
                          this.errors = [];
                          this.displayError(res)
                        }else{
                          this.errors = [];
                          this.description = '';
                          this.tipo = '';
                          this.monto = '';
                          VueOnToast.ToastService.pop('success', 'Caja editada', 'La caja fue editada con éxito.');
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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_CAJAS)) {

            this.$router.go(-1);
            
        }
    },
  },
  created() {
    this.read();
  }
}
</script>
