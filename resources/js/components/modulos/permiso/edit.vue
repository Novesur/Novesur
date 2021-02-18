<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Permiso</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/permiso'">
              <i class="fas fa-arrow-left"></i>Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid"></div>
        </div>



            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Editar Permiso</h3>
              </div>
              <div class="card-body">
                <form role="">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarPermiso.cNombre"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Url Amigable</label
                        >
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarPermiso.cSlug"
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
                    @click.prevent="setValidarPermiso"
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
      fillEditarPermiso: {
        nIdPermiso: this.$attrs.id,
        cNombre: "",
        cSlug: "",
      },
       listPermisos: [],
      listPermisosFilter:[],
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
  mounted(){
      this.getListarPermisosById();
  },

  methods: {


    abrirModal() {
      this.modalShow = !this.modalShow;
    },
        getListarPermisosById() {
      var url = "/administracion/permiso/listPermisosById";
      axios
        .get(url, {
          params: {
            'nIdPermiso': this.fillEditarPermiso.nIdPermiso,
          },
        })
        .then((response) => {
         this.fillEditarPermiso.cNombre = response.data.name;
         this.fillEditarPermiso.cSlug = response.data.slug;
        });
    },

    validarRegistrarPermiso() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillEditarPermiso.cNombre) {
        this.mensajeError.push("El Nombre Obligatorio");
      }

      if (!this.fillEditarPermiso.cSlug) {
        this.mensajeError.push("Apellido Paterno Obligatorio");
      }


      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },

    limpiarCriteriosBsq() {
      this.fillEditarPermiso.cNombre = "";
      this.fillEditarPermiso.cSlug = "";
    },

    setValidarPermiso() {
      if (this.validarRegistrarPermiso()) {
        this.modalShow = true;
        return;
      }
      this.setRegistraPermisos();
    },

    setRegistraPermisos() {
      var url = "/administracion/permiso/setEditarPermiso";
      axios
        .post(url, {
         'nIdPermiso': this.fillEditarPermiso.nIdPermiso,
         'cNombre' : this.fillEditarPermiso.cNombre,
          'cSlug'  : this.fillEditarPermiso.cSlug,

        })
        .then((response) => {
            Swal.fire({
            icon: "success",
            title: "Se actualizo el Permiso correctamente",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$router.push("/permiso");

        });
    },
  },
};
</script>

<style>
</style>
