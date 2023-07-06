<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Crear Clientes</h1>
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
                <h3 class="card-title">Formulario Registrar Cliente</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Razon Social</label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" v-model="fillRegistrarCliente.cRSocial"
                            :disabled="true" />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Dirección</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillRegistrarCliente.cDireccion" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">RUC / DNI</label>
                        <div class="col-md-5">
                          <input type="text" class="form-control" v-model="fillRegistrarCliente.cRuc" :maxlength="11"
                            :disabled="disabledbtnRuc" />
                        </div>
                        <div class="text-center">
                          <span style="color: red; text-align: end">{{
                            this.fillRegistrarCliente.cRuc.length +
                              " " +
                              "Caracteres"
                          }}</span>
                        </div>
                        <div class="col">
                          <span>
                            <button class="btn btn-success btn-sm" @click.prevent="consultaRuc">
                              <span><i class="fas fa-search"></i> Consultar
                                Ruc</span>
                            </button></span>

                          <span>
                            <button class="btn btn-success btn-sm" @click.prevent="consultaDNI">
                              <span><i class="fas fa-search"></i> Consultar
                                DNI</span>
                            </button></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Atencion</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillRegistrarCliente.cAtencion" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Telefono</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillRegistrarCliente.cTelefono" />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Celular</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" v-model="fillRegistrarCliente.cCelular" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillRegistrarCliente.cEmail" />
                        </div>
                      </div>
                    </div>

                    <div v-if="listRolPermisoByUsuario.includes('cliente.tipoprecio')" class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Tipo de Precio</label>
                        <div class="col-md-9">
                          <el-select v-model="fillRegistrarCliente.ctipoPrecio" class="m-2" placeholder="Select" size="large">
                            <el-option v-for="item in tipoPrecio" :key="item.value" :label="item.label" 
                              :value="item.value" />
                          </el-select>
                        </div>
                      </div>
                    </div>

                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarCliente"
                      :disabled="isDisabled">
                      Registrar
                    </button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarClienteBsq">
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
    <div class="modal fade" :class="{ show: modalShow }" :style="modalShow ? mostrarModal : ocultarModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Sistemas Novesur</h5>
            <button class="close" @click="abrirModal"></button>
          </div>
          <div class="modal-body">
            <div class="callout callout-danger" style="padding: 5px" v-for="(item, index) in mensajeError" :key="index"
              v-text="item"></div>
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
      fillRegistrarCliente: {
        cRSocial: "",
        cDireccion: "",
        cRuc: "",
        cAtencion: "",
        cTelefono: "",
        cCelular: "",
        cEmail: "",
        ctipoPrecio:"",
        nIdUser: sessionStorage.getItem("iduser"),
      },
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
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
      estadobutton: true,
      disabledbtnRuc: false,



      tipoPrecio: [
        {
          value: 'Lista',
          label: 'Lista',
        },
        {
          value: 'Distribuidor',
          label: 'Distribuidor',
        },
      ],

    };
  },

  mounted() {
    this.fillRegistrarCliente.ctipoPrecio = this.tipoPrecio[0].value;
  },


  computed: {
    isDisabled: function () {
      return this.estadobutton;
    },
  },

  methods: {
    abrirModal() {
      this.modalShow = !this.modalShow;
    },

    limpiarClienteBsq() {
      this.fillRegistrarCliente.cRSocial = "";
      this.fillRegistrarCliente.cDireccion = "";
      this.fillRegistrarCliente.cRuc = "";
      this.fillRegistrarCliente.cAtencion = "";
      this.fillRegistrarCliente.cTelefono = "";
      this.fillRegistrarCliente.cCelular = "";
      this.fillRegistrarCliente.cEmail = "";
      this.disabledbtnRuc = false;
      this.estadobutton = true;
    },
    limpiarBandejaProveedor() {
      this.listProveedor = [];
    },
    setRegistrarCliente() {
      if (this.validarProveedor()) {
        this.modalShow = true;
        return;
      }
      this.setGuardarProveedor();
    },
    setGuardarProveedor() {
      var url = "/administracion/cliente/createClientes";
      axios
        .post(url, {
          cRSocial: this.fillRegistrarCliente.cRSocial,
          cDireccion: this.fillRegistrarCliente.cDireccion,
          cRuc: this.fillRegistrarCliente.cRuc,
          cAtencion: this.fillRegistrarCliente.cAtencion,
          cTelefono: this.fillRegistrarCliente.cTelefono,
          cCelular: this.fillRegistrarCliente.cCelular,
          cEmail: this.fillRegistrarCliente.cEmail,
          nIdUser: this.fillRegistrarCliente.nIdUser,
          ctipoPrecio: this.fillRegistrarCliente.ctipoPrecio
        })
        .then((response) => {
          if (response.data.icon == "success") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 2000,

            });
            this.$router.push("/cliente/index");
          } else {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 2000,
            });
          }
        });
    },
    validarProveedor() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillRegistrarCliente.cRSocial) {
        this.mensajeError.push("El Campo Razon Social es un campo obligatorio");
      }
      if (!this.fillRegistrarCliente.cDireccion) {
        this.mensajeError.push("El Campo Direccion es un campo obligatorio");
      }
      if (!this.fillRegistrarCliente.cRuc) {
        this.mensajeError.push("El Campo Ruc es un campo obligatorio");
      }

      if (!this.fillRegistrarCliente.cAtencion) {
        this.mensajeError.push("El Campo Atencion es un campo obligatorio");
      }
      if (!this.fillRegistrarCliente.cCelular) {
        this.mensajeError.push("El Nro Celular es un campo obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },
    consultaRuc() {
      var url = "/administracion/cliente/consultaRuc";
      axios
        .post(url, {
          cRuc: this.fillRegistrarCliente.cRuc,
        })
        .then((response) => {
          if (response.data.success == false) {
            this.estadobutton = true;
            (this.fillRegistrarCliente.cRSocial = ""),
              (this.fillRegistrarCliente.cDireccion = "");

            Swal.fire({
              position: "center",
              icon: "info",
              title: "Ruc no encontrado o numero equivocado",
              showConfirmButton: false,
              timer: 2000,
            });
            this.estadobutton = true;
          } else {
            (this.fillRegistrarCliente.cRSocial = response.data.razonSocial),
              (this.fillRegistrarCliente.cDireccion = response.data.direccion),
              (this.estadobutton = false);
            this.disabledbtnRuc = true;
          }
        });
    },

    consultaDNI() {
      var url = "/administracion/cliente/consultaDNI";
      axios
        .post(url, {
          cRuc: this.fillRegistrarCliente.cRuc,
        })
        .then((response) => {
          if (response.data.success == false) {
            this.estadobutton = true;
            (this.fillRegistrarCliente.cRSocial = ""),
              (this.fillRegistrarCliente.cDireccion = "");

            Swal.fire({
              position: "center",
              icon: "info",
              title: "DNI no encontrado o numero equivocado",
              showConfirmButton: false,
              timer: 2000,
            });
            this.estadobutton = false;
          } else {
            (this.fillRegistrarCliente.cRSocial =
              response.data.nombres +
              " " +
              response.data.apellidoPaterno +
              " " +
              response.data.apellidoMaterno),
              (this.fillRegistrarCliente.cDireccion = response.data.direccion);
            this.estadobutton = false;
            this.disabledbtnRuc = true;
          }
        });
    },
  },
};
</script>

<style>

</style>
