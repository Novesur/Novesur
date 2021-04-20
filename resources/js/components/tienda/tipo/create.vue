<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Tipo</h1>
          </div>
        </div>

        <div class="conten container-fluid">
          <div class="card">
            <div class="card-header">
              <div class="card-tools">
                <router-link class="btn btn-info btn-sm" :to="'/tipo/index'">
                  <i class="fa fa-arrow-left"></i>Regresar
                </router-link>
              </div>
            </div>

            <div class="card-body">
              <div class="container-fluid">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Formulario registrar Tipo</h3>
                  </div>

                  <div class="card-body">
                    <form role="form">
                      <div class="row">
                        <div class="col-md-6 offset-3">
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-md-2 col-form-label"
                                >Nombre</label
                              >
                              <div class="col-10">
                                <input
                                  type="text"
                                  class="form control"
                                  style="width: 410px"
                                  @keydown.enter.prevent="setRegistrarTipo"
                                  v-model="fillCrearTipo.cNombre"
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
                          @click.prevent="setRegistrarTipo"
                        >
                          Registrar
                        </button>
                        <button
                          class="btn btn-flat btn-default btnWidth"
                          @click.prevent="limpiarCriteriosBsq"
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
      fillCrearTipo: {
        cNombre: "",
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
  computed: {},
  methods: {
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    limpiarCriteriosBsq() {
      this.fillCrearTipo.cNombre = "";
    },
    setRegistrarTipo() {
      if (this.validarRegistrarFamilia()) {
        this.modalShow = true;
        return;
      }
      this.setGuardarTipo();
    },
    validarRegistrarFamilia() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearTipo.cNombre) {
        this.mensajeError.push("El campor Nombre es un campo obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },
    setGuardarTipo() {
      var url = "/administracion/tipo/store";
      axios
        .post(url, {
          cNombre: this.fillCrearTipo.cNombre,
        })
        .then((response) => {

          this.$router.push("/tipo/index");
        });
    },
  },
};
</script>

<style>
</style>
