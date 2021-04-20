<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Marca</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/marca'">
              <i class="fas fa-arrow-left"></i>Regresar
            </router-link>
          </div>
        </div>

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Registrar Marca</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="col-md- offset-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Nombre</label>
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearMarca.cNombre"
                              @keypress.enter.prevent="setRegistrarMarca"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setRegistrarMarca"
                    >
                      Registrar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="limpiarMarcaBsq"
                    >
                      Limpiar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      :class="{ show: modalShow }"
      :style="modalShow ? mostrarModal : ocultarModal"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Sistemas Novesur</h5>
            <button class="close" @click="abrirModal"></button>
          </div>
          <div class="modal-body">
             <div
              class="callout callout-danger"
              style="padding: 5px"
              v-for="(item, index) in mensajeError"
              :key="index"
              v-text="item"
            ></div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" @click="abrirModal">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillCrearMarca: {
        cNombre: "",
      },
      modalShow:false,
      mostrarModal:{
          display:'block',
          background:'#0000006b',
      },
      ocultarModal:{
          display:'none',
      },
      error:0,
      mensajeError:[],
    };
  },
  computed: {},
  methods: {
    limpiarMarcaBsq() {
      this.fillCrearMarca.cNombre = "";
    },


    abrirModal(){
      this.modalShow = !this.modalShow;
  },
  setRegistrarMarca(){
      if(this.validarRegistrarMarca()){
          this.modalShow=true;
          return;
      }
      this.setGuardarMarca();

  },
  validarRegistrarMarca(){
      this.error = 0;
      this.mensajeError = [];
      if(!this.fillCrearMarca.cNombre){
          this.mensajeError.push("El campo nombre es obligatorio")
      }

      if(this.mensajeError.length){
          this.error=1;
      }
      return this.error;
  },
  setGuardarMarca(){
      var url = '/administracion/marcas/setRegistrarMarcas'
      axios.post(url,{
          'cNombre' : this.fillCrearMarca.cNombre,
      }).then(response=>{
          this.$router.push('/marca');
      })
  }
  },

};
</script>

<style>
</style>
