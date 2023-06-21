<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Usuarios</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/usuario'">
              <i class="fas fa-plus-square"></i>Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Registrar Usuario</h3>
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
                            v-model="fillCrearUsuario.cFirstname"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Apellido Paterno</label
                        >
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearUsuario.cSecondname"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Apellido Materno</label
                        >
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearUsuario.cLastname"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Usuario</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearUsuario.cUsername"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Email</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearUsuario.cEmail"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">celular</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearUsuario.cCelular"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Password</label>
                        <div class="col-md-9">
                          <el-input
                            placeholder="Ingrese la contraseña"
                            v-model="fillCrearUsuario.cPassword"
                            show-password
                          ></el-input>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Rol</label>
                        <div class="col-md-9">
                          <el-select
                            v-model="fillCrearUsuario.nIdRol"
                            placeholder="Seleccione un Rol"
                            clearable
                          >
                            <el-option
                              v-for="item in listRoles"
                              :key="item.id"
                              :label="item.nombre"
                              :value="item.id"
                            >
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Almacen</label>
                        <div class="col-md-9">
                          <el-select
                            v-model="fillCrearUsuario.nIdAlmacen"
                            placeholder="Seleccione un Rol"
                            clearable
                          >
                            <el-option
                              v-for="item in listAlmacen"
                              :key="item.id"
                              :label="item.nombre"
                              :value="item.id"
                            >
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>

                            <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Grado Academico</label>
                        <div class="col-md-9">
                          <el-select
                            v-model="fillCrearUsuario.nIdGradoAcad"
                            placeholder="Seleccione un Grado"
                            clearable
                          >
                            <el-option
                              v-for="item in listGradoAcad"
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
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setValidarUsuarios"
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
      fillCrearUsuario: {
        cFirstname: "",
        cSecondname: "",
        cLastname: "",
        cUsername: "",
        cEmail: "",
        cCelular:"",
        cPassword: "",
        nIdRol: "",
        nIdAlmacen: "",
        nIdGradoAcad:"",
      },
      listRoles: [],
      listAlmacen: [],
      listGradoAcad:[],
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
    this.getListarRoles();
    this.getListarAlmacen();
    this.getListarGradoAcad();
  },
  methods: {
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    getListarRoles() {
      var url = "/administracion/rol/listRoles";
      axios.get(url).then((response) => {
        this.listRoles = response.data;
      });
    },

    getListarAlmacen() {
      var url = "/administracion/almacen/listAlmacen";
      axios.get(url).then((response) => {
        this.listAlmacen = response.data;
      });
    },

        getListarGradoAcad() {
      var url = "/administracion/usuario/getListarGradoAcad";
      axios.get(url).then((response) => {
        this.listGradoAcad = response.data;
      });
    },


    validarRegistrarUsuario() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearUsuario.cFirstname) {
        this.mensajeError.push("El Nombre Obligatorio");
      }

      if (!this.fillCrearUsuario.cSecondname) {
        this.mensajeError.push("Apellido Paterno Obligatorio");
      }
      if (!this.fillCrearUsuario.cLastname) {
        this.mensajeError.push("Apellido Materno Obligatorio");
      }
      if (!this.fillCrearUsuario.cUsername) {
        this.mensajeError.push("El Nombre de Usuario es Obligatorio");
      }
      if (!this.fillCrearUsuario.cEmail) {
        this.mensajeError.push("El Email es Obligatorio");
      }
      if (!this.fillCrearUsuario.cPassword) {
        this.mensajeError.push("El Password es Obligatorio");
      }

      if (!this.fillCrearUsuario.nIdRol) {
        this.mensajeError.push("El Rol es Obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },

    limpiarCriteriosBsq() {
      this.fillCrearUsuario.cFirstname = "";
      this.fillCrearUsuario.cSecondname = "";
      this.fillCrearUsuario.cLastname = "";
      this.fillCrearUsuario.cUsername = "";
      this.fillCrearUsuario.cNombre = "";
      this.fillCrearUsuario.cEmail = "";
      this.fillCrearUsuario.cPassword = "";
     this.fillCrearUsuario.cCelular = "";

    },

    setValidarUsuarios() {
      if (this.validarRegistrarUsuario()) {
        this.modalShow = true;
        return;
      }
      this.setRegistrarUsuarios();
    },

    setRegistrarUsuarios() {
      var url = "/administracion/usuario/setRegistrarUsuario";
      axios
        .post(url, {
          cFirstname: this.fillCrearUsuario.cFirstname,
          cSecondname: this.fillCrearUsuario.cSecondname,
          cLastname: this.fillCrearUsuario.cLastname,
          cUsername: this.fillCrearUsuario.cUsername,
          cEmail: this.fillCrearUsuario.cEmail,
          cPassword: this.fillCrearUsuario.cPassword,
          nIdRol: this.fillCrearUsuario.nIdRol,
          nIdAlmacen: this.fillCrearUsuario.nIdAlmacen,
          cCelular : this.fillCrearUsuario.cCelular,
          nIdGradoAcad : this.fillCrearUsuario.nIdGradoAcad,

        })
        .then((response) => {
          console.log("Usuario guardado");
          this.$router.push("/usuario");
        });
    },
  },
};
</script>

<style>
</style>
