<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-6">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>Proveedor</small>
          </div>
          <form action="" >

          <div class="col-sm-12"><span v-for="error in errors" class="text-danger">{{ error }}<br></span></div>
  

          <div class="row">
            <div class="col-sm-12">
              <b-form-fieldset label="Nombre y apellido del responsable">
                <input type="text" class="form-control" name="name" v-model="name" placeholder="Ingrese nombre y apellido"></input>
              </b-form-fieldset>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <b-form-fieldset label="Empresa">
                <input type="text" class="form-control" name="company" v-model="company" placeholder="Ingrese nombre de la empresa"></input>
              </b-form-fieldset>
            </div>
            <div class="col-sm-6">
              <b-form-fieldset label="Rif">
                <input type="text" class="form-control" name="rif" v-model="rif" placeholder="Ingrese rif"></input>
              </b-form-fieldset>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <b-form-fieldset label="Email">
                <input type="text" class="form-control" name="email" v-model="email" placeholder="Ingrese el email"></input>
              </b-form-fieldset>
            </div>
            <div class="col-sm-6">
              <b-form-fieldset label="Telefono">
                <input type="text" class="form-control" name="phone" v-model="phone" placeholder="Ingrese el telefono"></input>
              </b-form-fieldset>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <b-form-fieldset label="Dirección">
                 <textarea class="form-control" :rows="9" name="address" v-model="address" placeholder="Dirección..">{{ address }}</textarea>
              </b-form-fieldset>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <b-form-fieldset label="Descripción">
                 <textarea class="form-control" :rows="9" name="description" v-model="description" placeholder="Descripción..">{{ description }}</textarea>
              </b-form-fieldset>
            </div>
          </div>


          <div class="form-actions">
              <b-button v-if="ventana === 'Crear'" @click.prevent="submit" variant="success">Guardar</b-button>
              <b-button v-if="ventana === 'Editar'" @click.prevent="edit" variant="success">Editar</b-button>
              <router-link :to="{ name: 'Proveedores'}">
                <b-button type="button" variant="secondary">Regresar</b-button>
              </router-link>
          </div>

          </form>

        </b-card>
      </div>
      <div class="col-sm-3"></div> 
      <toast-container></toast-container>
    </div>
   
  </div>
</template>

<script>

import VueOnToast from 'vue-on-toast'
import constSystem from '../../_const';

export default {
  name: 'company-form',
  components: {
    VueOnToast
  },
  data () {
    return {
      errors: [],
      company: '',
      name:'',
      email:'',
      phone:'',
      address:'',
      ruta: this.$route.name,
      ventana:'',
      rif:'',
      description:'',
      maestroo: constSystem.MAESTRO_PROVEEDORES,
      permisos : this.$store.getters.permisos,
    }
  },
  mounted: function() {


    if (this.ruta === 'EditarProveedor') {

      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

      this.ventana = 'Editar';

      this.$store.dispatch('providerById', { id: this.$route.params.id})
        .then(({data}) => {

           this.company = data.providerById.company;
           this.name = data.providerById.name; 
           this.rif = data.providerById.rif; 
           this.email = data.providerById.email; 
           this.phone = data.providerById.phone;
           this.address = data.providerById.address;
           this.description = data.providerById.description;

        });
    }

    if(this.ruta === 'CrearProveedor'){
      this.ventana = 'Crear';
       this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las categorias.');
    }

  }, 
  methods: {
    displayError(res) {

      if (res.errors[0].validation.name)
      this.errors.push(res.errors[0].validation.name[0]);

      if (res.errors[0].validation.email)
      this.errors.push(res.errors[0].validation.email[0]);

      VueOnToast.ToastService.pop('error', 'Error al crear proveedor', 'Corrija para poder crear con éxito');
      
    },
    submit() {
  
        this.$store.dispatch('createProvider', { 
          name: this.name, 
          company: this.company,
          rif: this.rif, 
          email: this.email,
          phone: this.phone,
          address : this.address,
          description : this.description,

        })
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.company = '';
              this.name = '';
              this.email = '';
              this.phone = '';
              this.rif = '';
              this.address = '';
              this.description = '';
              VueOnToast.ToastService.pop('success', 'Proveedor creado', 'El proveedor fue creado con éxito.');
            }
        });
    
    },
    edit() {
  
        this.$store.dispatch('updateProvider', { 
          id: this.$route.params.id, 
          name: this.name, 
          company: this.company, 
          rif: this.rif, 
          email: this.email, 
          phone: this.phone, 
          address : this.address,
          description : this.description,
        })
        .then(res => {
            if(res.errors) {
              this.errors = [];
              this.displayError(res)
            }else{
              this.errors = [];
              this.rif = '';
              this.name = '';
              this.email = '';
              this.phone = '';
              this.company = '';
              this.address = '';
              this.description = '';

              VueOnToast.ToastService.pop('success', 'Proveedor editado', 'El proveedor fue editado con éxito.');
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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_PROVEEDORES)) {

            this.$router.go(-1);
            
        }
    },
  }
}
</script>
