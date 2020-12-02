<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-3"></div> 
      <div class="col-sm-6">
        <b-card>
          <div slot="header">
            <strong>{{ ventana }}</strong> <small>PlatoBebida</small>
          </div>
          <form action="" >

          <div class="col-sm-12"><span v-for="error in errors" class="text-danger">{{ error }}<br></span></div>
  

          <div class="row">
            <div class="col-sm-6">
              <b-form-fieldset label="Nombre">
                <input class="form-control" type="text" name="name" v-model="name" placeholder="Ingrese nombre"></input>
              </b-form-fieldset>
            </div>
            <div class="col-sm-6">
              <b-form-fieldset label="Precio" :description="inputDescription">
                <input class="form-control" type="text" name="price" v-model="price" placeholder="Ingrese el precio"></input>
              </b-form-fieldset>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <b-form-fieldset label="Código">
                <input class="form-control" type="text" name="code" v-model="code" placeholder="Ingrese código"></input>
              </b-form-fieldset>
            </div>
            <div class="col-sm-6">
              <b-form-fieldset
                label="Unidad">
                <input class="form-control" type="text" name="unity" v-model="unity" placeholder="Ingrese unidad"></input>
              </b-form-fieldset>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <b-form-fieldset label="Duración">
                <input class="form-control" type="text" name="duration" v-model="duration" placeholder="Ingrese el duración"></input>
              </b-form-fieldset>
            </div>
            <div class="col-sm-6">
              <b-form-fieldset label="Categorias">
                   <b-form-select
                      v-model="category"
                      :plain="true"
                      :options="categorys"
                      value="0">
                    </b-form-select>
              </b-form-fieldset>
            </div>
          </div>


          <div class="row">
            <div class="col-sm-6">
              <b-form-fieldset label="Stock">
                <input class="form-control" type="number" name="stock" v-model="stock" min="0" placeholder="Ingrese stock"></input>
              </b-form-fieldset>
            </div>
            <div class="col-sm-6">
              <b-form-fieldset label="Stock Minimo">
                <input class="form-control" type="number" name="stock_min" min="0" v-model="stock_min" placeholder="Ingrese el stock minimo"></input>
              </b-form-fieldset>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <b-form-fieldset label="Descripción">
                 <textarea class="form-control" name="description" v-model="description" :rows="9" placeholder="Descripción..">{{ description }}</textarea>

              </b-form-fieldset>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <b-form-fieldset label="Preparación">
                <textarea class="form-control" name="preparation" v-model="preparation" :rows="9" placeholder="Descripción..">{{ preparation }}</textarea>

              </b-form-fieldset>
            </div>
          </div>

           <div class="row">
            <div class="col-sm-12">
              <b-form-fieldset label="Imagen (Se recomienda que tenga dimensiones 215 x 215)">
    
                <input type="file" class="form-control" ref="file" v-on:change="onUploadImage()">

              </b-form-fieldset>
            </div>
          </div>
    

          <div class="form-actions">
              <b-button v-if="ventana === 'Crear'" @click.prevent="submit" variant="success">Guardar</b-button>
              <b-button v-if="ventana === 'Editar'" @click.prevent="edit" variant="success">Editar</b-button>
              <router-link :to="{ name: 'PlatosBebidas'}">
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
  name: 'dish-form',
  components: {
    VueOnToast
  },
  data () {
    return {
      errors: [],
      name:'',
      price:'',
      code:'',
      duration:'',
      description:'',
      preparation:'',
      unity:'',
      category:0,
      inputDescription:'',
      ruta: this.$route.name,
      ventana:'',
      categorys :[],
      stock_min:0,
      stock:0,
      picFile:null,
      maestroo: constSystem.MAESTRO_PLATOS_BEBIDAS,
      permisos : this.$store.getters.permisos,
    }
  },

  mounted: function() {

    this.$store.dispatch('getCategorys', null).then(({data}) => {

      let cat = {};
      cat.value = 0;
      cat.text = "Por favor seleccione una opción";
      this.categorys.push(cat);

      data.categorys.forEach(category => {
 
        if(category.active){
          let cat = {};
          cat.value = category.id;
          cat.text  = category.name;
          this.categorys.push(cat);
        }
        
      });

    });


    if (this.ruta === 'EditarPlatoBebida') {

      this.denyAccessIfNotAuthorized ('editar', 'Dashboard', 'No tienes permisos para ver a las categorias.');

      this.ventana = 'Editar';

      this.$store.dispatch('dishById', { id: this.$route.params.id})
        .then(({data}) => {

           this.name = data.dishById.name; 
           this.code = data.dishById.code; 
           this.price = data.dishById.price;
           this.description = data.dishById.description; 
           this.preparation = data.dishById.preparation; 
           this.unity = data.dishById.unity; 
           this.category = data.dishById.category.id; 
           this.duration = data.dishById.duration; 
           this.stock_min = data.dishById.stock_min; 
           this.stock = data.dishById.stock; 

      });
    }

    if(this.ruta === 'CrearPlatoBebida'){
      this.ventana = 'Crear';
      this.denyAccessIfNotAuthorized ('agregar', 'Dashboard', 'No tienes permisos para ver a las categorias.');
    }

  }, 
  methods: {

    displayError(res) {

      if (res.errors[0].validation.name)
      this.errors.push(res.errors[0].validation.name[0]);

      VueOnToast.ToastService.pop('error', 'Error al crear plato/bebida', 'Corrija para poder crear con éxito');
      
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
    onUploadImage(){
      this.picFile = this.$refs.file.files[0];
    },
    submit() {


      this.$store.dispatch('getEmpresa', null).then(({data}) => {

          data.companys.forEach(company => {

              if(company){

                if(company.currency){


                    const formData = new FormData()
                    formData.append('name',this.name)
                    formData.append('description',this.description)
                    formData.append('category',this.category)
                    formData.append('price',this.price)
                    formData.append('code',this.code)
                    formData.append('preparation',this.preparation)
                    formData.append('unity',this.unity)
                    formData.append('duration',this.duration)
                    formData.append('stock_min',this.stock_min)
                    formData.append('stock',this.stock)

                    // por si no esta nulo
                    if (this.picFile) {
                      formData.append('image',this.picFile)
                    }

                    
                    axios.post("api/Producto/create",formData)
                    .then(res => {
                            if(res.errors) {
                              this.errors = [];
                              this.displayError(res)
                            }else{
                              this.errors = [];
                              this.name = '';
                              this.price='';
                              this.code='';
                              this.description ='';
                              this.preparation ='';
                              this.unity ='';
                              this.duration = '';
                              this.category = 0;
                              this.stock_min = 0;
                              this.stock = 0;
                              this.picFile = null;
                              VueOnToast.ToastService.pop('success', 'Plato/bebida creado', 'El plato/bebida fue creado con éxito.');
                            }
                    })
                    .catch(error => {
                       alert(error)
                    })

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

                    const formData = new FormData()
                    formData.append('id',this.$route.params.id)
                    formData.append('name',this.name)
                    formData.append('description',this.description)
                    formData.append('category',this.category)
                    formData.append('price',this.price)
                    formData.append('code',this.code)
                    formData.append('preparation',this.preparation)
                    formData.append('unity',this.unity)
                    formData.append('duration',this.duration)
                    formData.append('stock_min',this.stock_min)
                    formData.append('stock',this.stock)

                    // por si no esta nulo
                    if (this.picFile) {
                      formData.append('image',this.picFile)
                    }

                    axios.post("api/Producto/edit",formData)
                    .then(res => {
                      if(res.errors) {
                          this.errors = [];
                          this.displayError(res)
                      }else{
                          this.errors = [];
                          this.name = '';
                          this.price='';
                          this.code='';
                          this.description='';
                          this.preparation='';
                          this.unity='';
                          this.duration='';
                          this.category=0;
                          this.stock_min=0;
                          this.stock=0;
                          this.picFile = null;
                          VueOnToast.ToastService.pop('success', 'Plato/bebida editado', 'El plato/bebida fue editado con éxito.');
                      }
                    })
                    .catch(error => {
                       alert(error)
                    })

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
        if (!this.permissionGenerator(seccion,constSystem.MAESTRO_PLATOS_BEBIDAS)) {

            this.$router.go(-1);
            
        }
    },
  },
  created() {
    this.read();
  }
}
</script>
