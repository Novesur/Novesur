<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Crear Articulo</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/articulo/index'">
              <i class="fas fa-plus-square"></i> Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Registrar Articulo</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Articulo</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillRegistrarArticulo.cNombre"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Tipo</label>
                        <div class="col-md-9">
                          <el-select
                            v-model="fillRegistrarArticulo.nidTipo"
                            filterable
                            placeholder="Seleccione una Estado"
                            :style="{ width: '350px' }"
                          >
                            <el-option
                              v-for="item in listTipo"
                              :key="item.id"
                              :label="item.nombre"
                              :value="item.id"
                            >
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Imagen</label>
                        <div class="col-md-9">
                          <input
                            type="file"
                            class="form-control"
                            @change="getfile"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Categoria</label>
                        <div class="col-md-9">
                          <el-select
                            v-model="fillRegistrarArticulo.nidcatArt"
                            filterable
                            placeholder="Seleccione una Estado"
                            :style="{ width: '350px' }"
                          >
                            <el-option
                              v-for="item in listCatArt"
                              :key="item.id"
                              :label="item.nombre"
                              :value="item.id"
                            >
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                  </div>

                      <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Descripcion</label>
                        <div class="col-md-10">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillRegistrarArticulo.cDescripcion"
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
                      Registrar
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
      fillRegistrarArticulo: {
        cNombre: "",
        nidTipo: "",
        nidcatArt:"",
        cFoto: "",
        oImagen: "",
        cDescripcion: "",
      },
      listTipo: [],
      listCatArt: [],
      form: new FormData(),
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
    this.getListarTipo();
    this.getListarCatArticulo();
  },
  methods: {
    getfile(e) {
      this.fillRegistrarArticulo.oImagen = e.target.files[0];
    },

    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    limpiarClienteBsq() {
      this.fillRegistrarArticulo.cNombre = "";
    },
    limpiarBandejaProveedor() {
      this.listProveedor = [];
    },

      getListarCatArticulo() {
      var url = "/administracion/catart/index";
      axios.get(url).then((response) => {
        this.listCatArt = response.data;
        this.fillRegistrarArticulo.nidcatArt = this.listCatArt[0].id;
      });
    },

    getListarTipo() {
      var url = "/administracion/tipo/create";
      axios.get(url).then((response) => {
        this.listTipo = response.data;
        this.fillRegistrarArticulo.nidTipo = this.listTipo[0].id;
      });
    },
    setRegistrarCliente() {
      /*     if (this.validarProveedor()) {
        this.modalShow = true;
        return;
      } */
      if (
        !this.fillRegistrarArticulo.oImagen ||
        this.fillRegistrarArticulo.oImagen == undefined
      ) {
        this.setGuardarArticulo(0);
      } else {
        this.setRegistrarArchivo();
      }
    },

    setRegistrarArchivo() {
      this.form.append("file", this.fillRegistrarArticulo.oImagen);
      const config = { headers: { "Content-type": "multipart/form-data" } };
      var url = "/administracion/setRegistrarArchivo";
      axios.post(url, this.form, config).then((response) => {
        var nidfile = response.data.idfile;
        this.setGuardarArticulo(nidfile);
      });
    },
    setGuardarArticulo(nidfile) {
      var url = "/administracion/articulo/store";
      axios
        .post(url, {
          cNombre: this.fillRegistrarArticulo.cNombre,
          nidTipo: this.fillRegistrarArticulo.nidTipo,
          nidfile: nidfile,
          nidcatArt : this.fillRegistrarArticulo.nidcatArt,
          cDescripcion : this.fillRegistrarArticulo.cDescripcion,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });
          // this.$router.push("/cliente/index");
        });
    },
    validarProveedor() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillRegistrarArticulo.cNombre) {
        this.mensajeError.push("El Campo Razon Social es un campo obligatorio");
      }
      if (!this.fillRegistrarArticulo.nidTipo) {
        this.mensajeError.push("El Campo Direccion es un campo obligatorio");
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
