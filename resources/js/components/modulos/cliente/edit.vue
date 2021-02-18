<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Editar Clientes</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/cliente/index'">
              <i class="fas fa-plus-square"></i> Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Editar Cliente</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Razon Social</label>
                        <div class="col-md-10">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cRSocial"
                          />
                        </div>
                      </div>
                    </div>

                           <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Dirección</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cDireccion"
                          />
                        </div>
                      </div>
                    </div>


                  </div>

                  <div class="row">
              <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Ruc</label>
                        <div class="col-md-5">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cRuc"
                            v-int
                            :maxlength="11"
                          />
                        </div>
                      </div>
                    </div>

                         <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Atencion</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cAtencion"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Telefono</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cTelefono"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Celular</label>
                        <div class="col-md-8">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cCelular"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cEmail"
                          />
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
                      @click.prevent="setRegistrarCliente"
                    >
                      Editar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="limpiarClienteBsq"
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
      fillEditarCliente: {
        nIdCliente: this.$attrs.id,
        cRSocial: "",
        cDireccion:"",
        cRuc: "",
        cAtencion: "",
        cTelefono: "",
        cCelular: "",
        cEmail: "",
      },
      modalShow: false,
      mostrarModal: {
        display: "block",
        background: "#0000006b",
      },
      ocultarModal: {
        display: "none",
      },
      error: 0,
      mensajeError: [],
    };
  },
  mounted() {
    this.getClienteById();
  },
  methods: {
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    limpiarClienteBsq() {
      this.fillEditarCliente.cRSocial = "";
      this.fillEditarCliente.cDireccion= "";
      this.fillEditarCliente.cRuc = "";
      this.fillEditarCliente.cAtencion = "";
      this.fillEditarCliente.cTelefono = "";
      this.fillEditarCliente.cCelular = "";
      this.fillEditarCliente.cEmail = "";
    },
    limpiarBandejaProveedor() {
      this.listProveedor = [];
    },
    setRegistrarCliente(){
        if(this.validarProveedor()){
            this.modalShow = true;
            return;
        }
        this.setEditarProveedor();

    },

    getClienteById() {
      var url = "/administracion/cliente/listClientesById";
      axios
        .get(url, {
          params: {
            nIdCliente: this.fillEditarCliente.nIdCliente,
          },
        })
        .then((response) => {
         this.fillEditarCliente.cRSocial = response.data.razonsocial;
         this.fillEditarCliente.cDireccion = response.data.direccion;
         this.fillEditarCliente.cRuc = response.data.ruc;
         this.fillEditarCliente.cAtencion = response.data.atencion;
         this.fillEditarCliente.cTelefono = response.data.telefono;
         this.fillEditarCliente.cCelular = response.data.celular;
         this.fillEditarCliente.cEmail = response.data.email;
        });
    },


    setEditarProveedor() {
      var url = '/administracion/cliente/EditClientes';
      axios
        .post(url, {
            nIdCliente: this.fillEditarCliente.nIdCliente,
            cRSocial: this.fillEditarCliente.cRSocial,
            cDireccion: this.fillEditarCliente.cDireccion,
            cRuc: this.fillEditarCliente.cRuc,
            cAtencion: this.fillEditarCliente.cAtencion,
            cTelefono: this.fillEditarCliente.cTelefono,
            cCelular : this.fillEditarCliente.cCelular,
            cEmail : this.fillEditarCliente.cEmail,
          }).then((response) => {
          this.$router.push("/cliente/index");
        });
    },
    validarProveedor() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillEditarCliente.cRSocial) {
        this.mensajeError.push("El Campo Razon Social es un campo obligatorio");
      }
      if (!this.fillEditarCliente.cDireccion) {
        this.mensajeError.push("El Campo Direccion es un campo obligatorio");
      }
      if (!this.fillEditarCliente.cRuc) {
        this.mensajeError.push("El Campo Ruc es un campo obligatorio");
      }

      if(this.mensajeError.length){
          this.error=1;
      }
      return this.error;
    },
  },
};
</script>

<style>
</style>
