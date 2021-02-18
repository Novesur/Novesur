<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Editar Proveedor</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/proveedor'">
              <i class="fas fa-plus-square"></i> Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Editar Proveedor</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarProveedor.cNombre"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Ruc</label>
                        <div class="col-md-7">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarProveedor.cRuc"
                            v-int
                            :maxlength="11"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Dirección</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarProveedor.cDireccion"
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
                            v-model="fillEditarProveedor.cTelefono"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-7">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarProveedor.cEmail"
                          />
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Contacto</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarProveedor.cContacto"
                          />
                        </div>
                      </div>
                    </div>
                        <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Cuenta1 en S/.</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarProveedor.cCuentaNro1"
                            placeholder="Nro Cuenta / Banco"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                      <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Cuenta2 en S/.</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarProveedor.cCuentaNro2"
                            placeholder="Nro Cuenta / Banco"
                          />
                        </div>
                      </div>
                    </div>
                        <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Cuenta3 en S/.</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarProveedor.cCuentaNro3"
                            placeholder="Nro Cuenta / Banco"
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
                      @click.prevent="setRegistrarProveedor"
                    >
                      Editar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="limpiarProveedorBsq"
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
      fillEditarProveedor: {
        nIdProveedor: this.$attrs.id,
        cNombre: "",
        cRuc: "",
        cDireccion: "",
        cTelefono: "",
        cEmail: "",
        cContacto: "",
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
    this.getProveedorById();
  },
  methods: {
    getProveedorById() {
      var url = "/administracion/proveedor/getListarProveedorById";
      axios
        .get(url, {
          params: {
            'nIdProveedor' : this.fillEditarProveedor.nIdProveedor,
          },
        })
        .then((response) => {

          this.fillEditarProveedor.cNombre = response.data.nombre;
          this.fillEditarProveedor.cRuc = response.data.ruc;
          this.fillEditarProveedor.cDireccion = response.data.direccion;
          this.fillEditarProveedor.cTelefono = response.data.telefono;
          this.fillEditarProveedor.cEmail = response.data.email;
          this.fillEditarProveedor.cContacto = response.data.contacto;
          this.fillEditarProveedor.cCuentaNro1 = response.data.nrocuenta1;
          this.fillEditarProveedor.cCuentaNro2 = response.data.nrocuenta2;
          this.fillEditarProveedor.cCuentaNro3 = response.data.nrocuenta3;

        });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    limpiarProveedorBsq() {
      this.fillEditarProveedor.cNombre = "";
      this.fillEditarProveedor.cRuc = "";
      this.fillEditarProveedor.cDireccion = "";
      this.fillEditarProveedor.cTelefono = "";
      this.fillEditarProveedor.cEmail = "";
      this.fillEditarProveedor.cContacto = "";
    },
    limpiarBandejaProveedor() {
      this.listProveedor = [];
    },
    setRegistrarProveedor() {
      if (this.validarProveedor()) {
        this.modalShow = true;
        return;
      }
      this.setEditarProveedor();
    },
    setEditarProveedor() {
      var url = "/administracion/proveedor/setEditarProveedor";
      axios
        .post(url, {
          'nIdProveedor' : this.fillEditarProveedor.nIdProveedor,
          'cNombre': this.fillEditarProveedor.cNombre,
          'cRuc': this.fillEditarProveedor.cRuc,
          'cDireccion': this.fillEditarProveedor.cDireccion,
          'cTelefono': this.fillEditarProveedor.cTelefono,
          'cEmail': this.fillEditarProveedor.cEmail,
          'cContacto': this.fillEditarProveedor.cContacto,
          'cCuentaNro1' : this.fillEditarProveedor.cCuentaNro1,
         'cCuentaNro2' : this.fillEditarProveedor.cCuentaNro2,
        'cCuentaNro3' : this.fillEditarProveedor.cCuentaNro3
        })
        .then((response) => {
               Swal.fire({
            icon: "success",
            title: "Se edito correctamente",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$router.push("/proveedor");
        });
    },
    validarProveedor() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillEditarProveedor.cNombre) {
        this.mensajeError.push("El Campo Nombre es un campo obligatorio");
      }
      if (!this.fillEditarProveedor.cRuc) {
        this.mensajeError.push("El Campo Ruc es un campo obligatorio");
      }
      if (!this.fillEditarProveedor.cDireccion) {
        this.mensajeError.push("El Campo Direccion es un campo obligatorio");
      }

      if (!this.fillEditarProveedor.cTelefono) {
        this.mensajeError.push("El Campo Telefono es un campo obligatorio");
      }

      if (!this.fillEditarProveedor.cEmail) {
        this.mensajeError.push("El Campo Email es un campo obligatorio");
      }

      if (!this.fillEditarProveedor.cContacto) {
        this.mensajeError.push("El Campo Contacto es un campo obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },
  },
};
</script>

<style>
</style>
