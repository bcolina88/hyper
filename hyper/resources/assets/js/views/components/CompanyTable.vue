<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

          <div class="row">
            <div class="col-md-12">
              <b-card>
                <form action="" >
                <div slot="header">
                  <strong>Datos de la</strong> Empresa
                </div>
                <br>
                  
                <b-form-fieldset
                  label="Nombre:"
                  :label-cols="3"
                  :horizontal="true">
                  <input type="text" class="form-control" name="name" v-model="name" ></input>
                </b-form-fieldset>
                <b-form-fieldset
                  label="Email:"
                  :label-cols="3"
                  :horizontal="true">
                  <input type="text" class="form-control" name="email" v-model="email" ></input>
                </b-form-fieldset>
                <b-form-fieldset
                  label="NIF:"
                  :label-cols="3"
                  :horizontal="true">
                  <input type="text" class="form-control" name="nif" v-model="nif" ></input>
                 
                </b-form-fieldset>
                <b-form-fieldset
                  label="Web:"
                  :label-cols="3"
                  :horizontal="true">
                  <input type="text" class="form-control" name="web" v-model="web" ></input>
                 
                </b-form-fieldset>
                <b-form-fieldset
                  label="Propietario:"
                  :label-cols="3"
                  :horizontal="true">
                  <input type="text" class="form-control" name="boss" v-model="boss" ></input>
                  
                </b-form-fieldset>
                <b-form-fieldset
                  label="Telefono:"
                  :label-cols="3"
                  :horizontal="true">
                  <input type="text" class="form-control" name="phone" v-model="phone" ></input>
                  
                </b-form-fieldset>
                <b-form-fieldset
                  label="Telefono2:"
                  :label-cols="3"
                  :horizontal="true">
                  <input type="text" class="form-control" name="phone2" v-model="phone2" ></input>
                  
                </b-form-fieldset>
                <b-form-fieldset
                  label="Telefono3:"
                  :label-cols="3"
                  :horizontal="true">
                  <input type="text" class="form-control" name="phone3" v-model="phone3" ></input>
                  
                </b-form-fieldset>
                <b-form-fieldset
                  label="Dirección:"
                  :label-cols="3"
                  :horizontal="true">
                  <input type="text" class="form-control" name="adrees" v-model="adrees" ></input>
                  
                </b-form-fieldset>
                <b-form-fieldset
                  label="Moneda en el que se representa montos del sistema:"
                  :label-cols="3"
                  :horizontal="true">
                  <b-form-select
                    v-model="currency"
                    size="sm"
                    :plain="true"
                    :options="listCurrency"
                    value="0">
                  </b-form-select>
                </b-form-fieldset>
      
                <b-form-fieldset
                  label="Logo"
                  :label-cols="3"
                  :horizontal="true">
                     <input type="file" class="form-control" ref="file" v-on:change="onUploadImage()">
                </b-form-fieldset>

                <b-form-fieldset
                  v-for="comp in companys"
                  label="jjjjjj"
                  :label-cols="3"
                  :horizontal="true" style="color:white;">
 
                  <div class="col-md-12" style="padding:0px;" v-if="comp.image != null && comp.image != ''">
                      <img class="card-img-top"  :src="comp.image" >
                  </div>
             
                </b-form-fieldset>


                <div slot="footer">
                  <b-button size="sm" variant="primary" @click.prevent="submit"><i class="fa fa-edit"></i> Editar</b-button>
               
                </div>
                </form>
              </b-card>
            </div>
            
          </div><!--/.row-->
    
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
    <!-- Notificacion Component -->
    <toast-container></toast-container>
    
  </div>

</template>

<script>

import VueOnToast from 'vue-on-toast';
import constSystem from '../../_const';


export default {
  name: 'company-table',
  components: {
    VueOnToast
  },
  data () {
    return {
      currency:0,
      listCurrency: [],
      companys: [],
      name:'',
      email:'',          
      web:'',
      boss:'',
      nif:'',
      phone:'',
      phone2:'',
      phone3:'',
      adrees:'',
      image:'',
      picFile:null,
      ruta: this.$route.name,
      maestroo: constSystem.MAESTRO_PROVEEDORES,
      permisos : this.$store.getters.permisos,
    }
  },
  mounted: function() {

    this.denyAccessIfNotAuthorized ('ver', 'Dashboard', 'No tienes permisos para ver a las categorias.');
    this.listCurrencys();
  },
  computed: {
    hasRecords() {
      return this.companys[0].image === null;
    }
  },
  methods: {
    onUploadImage(){
      this.picFile = this.$refs.file.files[0];
    },
    read() {
      this.$store.dispatch('getEmpresa', null).then(({data}) => {

        this.companys = data.companys;
        data.companys.forEach(company => {

          if(company){

            if(company.name){
             this.name = company.name;
            }

            if(company.email){
             this.email = company.email;
            }

            if(company.web){
             this.web = company.web;
            }

            if(company.boss){
             this.boss = company.boss;
            }

            if(company.nif){
             this.nif = company.nif;
            }

            if(company.phone){
             this.phone = company.phone;
            }

            if(company.phone2){
              this.phone2 = company.phone2;
            }

            if(company.phone3){
             this.phone3 = company.phone3;
            }

            if(company.adrees){
             this.adrees = company.adrees;
            }

            if(company.currency){
             this.currency = company.currency.id;
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
        if (! this.permissionGenerator(seccion,constSystem.MAESTRO_PROVEEDORES)) {

            this.$router.go(-1);
            
        }
    },
    listCurrencys(){

              this.$store.dispatch('getMonedas', null).then(({data}) => {

                let cat = {};
                cat.value = 0;
                cat.text = "Por favor seleccione una opción";
                this.listCurrency.push(cat);

                data.currencys.forEach(currency => {
                  if(currency.active){
                    let cat = {};
                    cat.value = currency.id;
                    cat.text = currency.description;
                    this.listCurrency.push(cat);
                  }
                });

              });

    },
    submit() {


        const formData = new FormData()
        formData.append('name',this.name)
        formData.append('email',this.email)
        formData.append('currency',this.currency)
        formData.append('boss',this.boss)
        formData.append('web',this.web)
        formData.append('phone',this.phone)
        formData.append('phone2',this.phone2)
        formData.append('phone3',this.phone3)
        formData.append('adrees',this.adrees)
        formData.append('nif',this.nif)

        // por si no esta nulo
        if (this.picFile) {
          formData.append('image',this.picFile)
        }
        
        axios.post("api/Companie/create",formData)
        .then(res => {
                if(res.errors) {
                  this.errors = [];
                  this.displayError(res)
                }else{
               
                  VueOnToast.ToastService.pop('success', 'Empresa editada', 'Datos de la empresa actualizados.');
                  this.read();
                }
        })
        .catch(error => {
           alert(error)
        })
        
    },
  },
  created() {
    this.read();
  }
}
</script>


