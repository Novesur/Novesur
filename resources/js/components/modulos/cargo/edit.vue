<template>
    <div>
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Editar Cargo </h1>
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
                  <h3 class="card-title">Formulario Editar Cargo</h3>
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
                                v-model="fillEditarCargo.cNombre"
                                @keypress.enter.prevent="setRegistrarCargo"
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
                        @click.prevent="setRegistrarCargo"
                      >
                        Editar
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
        fillEditarCargo: {
          nIdCargo: this.$attrs.id,
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
    mounted() {
  
        this.getCargoById();
  
    },
    methods: {
      getCargoById(){
      var url = '/administracion/cargo/listByIdCargos'
        axios.get(url, {
            params: {
              'nIdCargo' : this.fillEditarCargo.nIdCargo
            }
          }).then(response=>{
              this.fillEditarCargo.cNombre = response.data.nombres;
          })
  
      },
  
      limpiarMarcaBsq() {
        this.fillEditarCargo.cNombre = "";
      },
  
  
      abrirModal(){
        this.modalShow = !this.modalShow;
    },
    setRegistrarCargo(){
        if(this.validarRegistrarMarca()){
            this.modalShow=true;
            return;
        }
        this.setEditarCargo();
  
    },
    validarRegistrarMarca(){
        this.error = 0;
        this.mensajeError = [];
        if(!this.fillEditarCargo.cNombre){
            this.mensajeError.push("El campo nombre es obligatorio")
        }
  
        if(this.mensajeError.length){
            this.error=1;
        }
        return this.error;
    },
    setEditarCargo(){
        var url = '/administracion/cargo/edit'
        axios.post(url,{
            'nIdCargo' : this.fillEditarCargo.nIdCargo,
            'cNombre' : this.fillEditarCargo.cNombre,
        }).then(response=>{
              Swal.fire({
              icon: "success",
              title: "Se edito correctamente",
              showConfirmButton: false,
              timer: 1500,
            });
            this.$router.push('/cargo/index');
        })
    }
    },
  
  };
  </script>
  
  <style>
  </style>
  