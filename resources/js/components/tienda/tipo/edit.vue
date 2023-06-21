<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Tipo Articulo</h1>
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
                    <h3 class="card-title">Formulario Editar Tipo Articulo</h3>
                  </div>

                  <div class="card-body">
                    <form role="form">
                      <div class="row">
                        <div class="col-md-6 offset-3">
                          <div class="col-md-12">

                            <div class="form-group row">
                              <label class="col-md-3 col-form-label"
                                >Nombre</label
                              >
                              <div class="col-md-8">
                                <input
                                  type="text"
                                  class="form control"
                                  style="width: 410px"
                                  @keydown.enter.prevent="setRegistrarTipo"
                                  v-model="fillEditarTipo.Cnombre"
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
                          Editar
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
      fillEditarTipo: {
        nIdTipo: this.$attrs.id,
        Cnombre: "",
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
    this.getTipoById();

  },
  methods: {
    getTipoById() {
      var url = "/administracion/tipo/index";
      axios.get(url, {
          params: {
            nIdTipo: this.fillEditarTipo.nIdTipo,
          },
        })
        .then((response) => {
          this.fillEditarTipo.Cnombre = response.data[0].nombre;
        });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    limpiarCriteriosBsq() {
      this.fillEditarTipo.Cnombre = "";
    },
    setRegistrarTipo() {
      if (this.validarRegistrarDiametro()) {
        this.modalShow = true;
        return;
      }
      this.setEditarSubFamilia();
    },
    validarRegistrarDiametro() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillEditarTipo.Cnombre) {
        this.mensajeError.push("El campor Nombre es un campo obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },
    setEditarSubFamilia() {
      var url = "/administracion/tipo/edit";
      axios
        .post(url, {

            nIdTipo: this.fillEditarTipo.nIdTipo,
          cNombre: this.fillEditarTipo.Cnombre,
        })
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Se edito correctamente",
            showConfirmButton: false,
            timer: 1500,
          });
            this.$router.push("/tipo/index");
        });
    },

  },
};
</script>

<style>
</style>
