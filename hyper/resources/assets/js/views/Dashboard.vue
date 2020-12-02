<template>
  <div class="animated fadeIn">
   

    <div class="row">
      

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


function Mesas({  id, name, active, status, sale}) {

  this.id = id;
  this.name = name;
  this.active = active;
  this.status = status;
  this.sale = sale;

  if(status){
    this.status_des = "Disponible";
  }else{
    this.status_des = "Ocupada";
  }

}

import constSystem from '../_const';

export default {
  name: 'dashboard',
  components: {
  },
  data: function () {
    return {
      tables: [],
      myModal: true,
      maestroo: constSystem.MAESTRO_VENTAS,
      permisos : this.$store.getters.permisos,
    }
  },

  methods: {
    read() {

      this.$store.dispatch('isUser', null).then(data => {


          this.responsee =  data.permisos;
          this.user =  data.role;
      });

    },
    btnClasses(status) {
      return {
        'bg-warning':!status,
        'bg-success':status,
      }
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
        if (! this.permissionGenerator(seccion,constSystem.MAESTRO_VENTAS)) {

            this.$router.go(-1);
            
        }
    },
    to(status,id){

        if(this.permissionGenerator('ver',this.maestroo)){
           
            if(!status){

                if(this.permissionGenerator('editar',this.maestroo)){
                  return { name: 'EditarVenta', params: { id: id }};
                }else{
                  return { name: 'Dashboard'};
                }


            }else{

                if(this.permissionGenerator('agregar',this.maestroo)){
                  return { name: 'CrearVenta'};
                }else{
                  return { name: 'Dashboard'};
                }
            }
         
        }else{
          return { name: 'Dashboard'};

        }

      

    }
  },
  created() {
    this.read();
  }
}
</script>
