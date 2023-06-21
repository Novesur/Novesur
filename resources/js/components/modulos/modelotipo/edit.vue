<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Modelo/Tipo</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/modelotipo'">
              <i class="fas fa-arrow-left"></i>Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Editar Modelo/Tipo</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="col-md-8 offset-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Nombre</label>
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillEditarModelotipo.cNombre"
                              @keypress.prevent.enter="setRegistrarModelotipo"
                              style="width: 390px"
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
                      @click.prevent="setRegistrarModelotipo"
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillEditarModelotipo: {
        nIdModelotipo: this.$attrs.id,
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
  mounted() {
    this.getMaterialById();
  },
  methods: {
    getMaterialById() {
      var url = "/administracion/modelotipo/listByIdModelotipo";
      axios
        .get(url, {
          params: {
            nIdModelotipo: this.fillEditarModelotipo.nIdModelotipo,
          },
        })
        .then((response) => {
          this.fillEditarModelotipo.cNombre = response.data[0].nombre;
        });
    },

    limpiarCriteriosBsq() {
      this.fillEditarModelotipo.cNombre = "";
    },
    setRegistrarModelotipo() {
      if (this.validaRegistrarMaterial()) {
        this.modalShow = true;
        return;
      }
      this.setEditarMaterial();
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    validaRegistrarMaterial() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillEditarModelotipo.cNombre) {
        this.mensajeError.push("El campo nombre es obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },
    setEditarMaterial() {
      var url = "/administracion/modelotipo/setEditarModelotipo";
      axios
        .post(url, {
          nIdModelotipo: this.fillEditarModelotipo.nIdModelotipo,
          cNombre: this.fillEditarModelotipo.cNombre,
        })
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Se edito correctamente",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$router.push("/modelotipo");
        });
    },
  },
};
</script>

<style>
</style>
