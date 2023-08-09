<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Usuarios</h1>
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
                <h3 class="card-title">Formulario Editar Usuario</h3>
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
                            v-model="fillEditarUsuario.cFirstname"
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
                            v-model="fillEditarUsuario.cSecondname"
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
                            v-model="fillEditarUsuario.cLastname"
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
                            v-model="fillEditarUsuario.cUsername"
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
                            v-model="fillEditarUsuario.cEmail"
                          />
                        </div>
                      </div>
                    </div>

                         <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Celular</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarUsuario.cCelular"
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
                            v-model="fillEditarUsuario.cPassword"
                            show-password
                          ></el-input>
                        </div>
                      </div>
                    </div>

                            <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Rol</label>
                            <div class="col-md-9">
                                <el-select v-model="fillEditarUsuario.nIdRol" placeholder="Seleccione un Rol" clearable>
                                    <el-option v-for="item in listRoles" :key="item.id" :label="item.nombre" :value="item.id">

                                    </el-option>

                                </el-select>
                            </div>


                        </div>

                    </div>


                              <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Grado Academico</label>
                            <div class="col-md-9">
                                <el-select v-model="fillEditarUsuario.nIdGradoAcad" placeholder="Seleccione un Grado" clearable>
                                    <el-option v-for="item in listGradoAcad" :key="item.id" :label="item.nombre" :value="item.id">

                                    </el-option>

                                </el-select>
                            </div>


                        </div>

                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nro Asistencia</label>
                        <div class="col-md-2">
                          <input
                          type="text"
                            class="form-control"
                            v-int
                            v-model="fillEditarUsuario.cAsistencia"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Zonal</label>
                            <div class="col-md-9">
                                <el-select v-model="fillEditarUsuario.nIdZonal" placeholder="Seleccione un Rol" clearable>
                                    <el-option v-for="item in listZonal" :key="item.id" :label="item.nombre" :value="item.id">

                                    </el-option>

                                </el-select>
                            </div>


                        </div>

                    </div>


                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">DNI</label>
                        <div class="col-md-2">
                          <input
                          type="text"
                            class="form-control"
                            v-int
                            v-model="fillEditarUsuario.cDni"
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
                      @click.prevent="setValidarUsuarios"
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
      fillEditarUsuario: {
        nIdUsuario: this.$attrs.id,
        cFirstname: "",
        cSecondname: "",
        cLastname: "",
        cUsername: "",
        cEmail: "",
        cCelular:"",
        cPassword: "",
        nIdRol:'',
        nIdGradoAcad:'',
        cAsistencia:'',
        nIdZonal:'',
        cDni:'',
      },
      listRoles:[],
      listPermisosByUser:[],
      listZonal:[],
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
    this.getUsuarioById();
    this.getListarRoles();
    this.getListarGradoAcad();
    this.getListZonal();
  },
  methods: {

         getListarRoles() {
      var url = "/administracion/rol/listRoles";
      axios
        .get(url).then((response) => {
          this.listRoles = response.data;
        });
    },
    getListZonal(){
      var url = "/administracion/zonal/list";
      axios.get(url).then((response) => {
        this.listZonal = response.data;
      });
    },

    getUsuarioById() {
      var url = "/administracion/usuario/listUsuarioById";
      axios
        .get(url, {
          params: {
            'nIdUsuario': this.fillEditarUsuario.nIdUsuario,
          },
        })
        .then((response) => {
          this.fillEditarUsuario.cFirstname = response.data.firstname,
            this.fillEditarUsuario.cSecondname = response.data.secondname,
            this.fillEditarUsuario.cLastname = response.data.lastname,
            this.fillEditarUsuario.cUsername = response.data.username,
            this.fillEditarUsuario.cEmail = response.data.email,
            this.fillEditarUsuario.cCelular = response.data.celular,
            this.fillEditarUsuario.nIdRol = response.data.roles_id,
            this.fillEditarUsuario.nIdGradoAcad = response.data.gradousers_id
            this.fillEditarUsuario.cAsistencia = response.data.asistencia,
            this.fillEditarUsuario.nIdZonal = response.data.zonal_id,
            this.fillEditarUsuario.cDni = response.data.dni
            

        });
    },
getListarPermisosByUser(){

    var url = "/administracion/usuario/listUsuarioById";
      axios
        .get(url, {
          params: {
            'nIdUsuario': this.fillEditarUsuario.nIdUsuario,
          },
        })
        .then((response) => {
            listPermisosByUser =response.data;
        });


},

    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    validarRegistrarUsuario() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillEditarUsuario.cFirstname) {
        this.mensajeError.push("El Nombre Obligatorio");
      }

      if (!this.fillEditarUsuario.cSecondname) {
        this.mensajeError.push("Apellido Paterno Obligatorio");
      }
      if (!this.fillEditarUsuario.cLastname) {
        this.mensajeError.push("Apellido Materno Obligatorio");
      }
      if (!this.fillEditarUsuario.cUsername) {
        this.mensajeError.push("El Nombre de Usuario es Obligatorio");
      }
      if (!this.fillEditarUsuario.cEmail) {
        this.mensajeError.push("El Email es Obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },

    limpiarCriteriosBsq() {
      this.fillEditarUsuario.cFirstname = "";
      this.fillEditarUsuario.cSecondname = "";
      this.fillEditarUsuario.cLastname = "";
      this.fillEditarUsuario.cUsername = "";
      this.fillEditarUsuario.cNombre = "";
      this.fillEditarUsuario.cEmail = "";
      this.fillEditarUsuario.cPassword = "";
      this.fillEditarUsuario.cCelular = "";
    },

    setValidarUsuarios() {
      if (this.validarRegistrarUsuario()) {
        this.modalShow = true;
        return;
      }
      this.setEditarUsuarios();
    },

    setEditarUsuarios() {
      var url = "/administracion/usuario/setEditarUsuario";
      axios
        .post(url, {
          nIdUsuario: this.fillEditarUsuario.nIdUsuario,
          cFirstname: this.fillEditarUsuario.cFirstname,
          cSecondname: this.fillEditarUsuario.cSecondname,
          cLastname: this.fillEditarUsuario.cLastname,
          cUsername: this.fillEditarUsuario.cUsername,
          cEmail: this.fillEditarUsuario.cEmail,
          cPassword: this.fillEditarUsuario.cPassword,
          nIdRol : this.fillEditarUsuario.nIdRol,
          cCelular : this.fillEditarUsuario.cCelular,
          nIdGradoAcad : this.fillEditarUsuario.nIdGradoAcad,
          cAsistencia: this.fillEditarUsuario.cAsistencia,
          nIdZonal: this.fillEditarUsuario.nIdZonal,
          cDni: this.fillEditarUsuario.cDni
        })
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Se edito correctamente",
            showConfirmButton: false,
            timer: 1500,

          });
          this.$router.push("/usuario");
        });
    },

      getListarGradoAcad() {
      var url = "/administracion/usuario/getListarGradoAcad";
      axios.get(url).then((response) => {
        this.listGradoAcad = response.data;
      });
    },
  },
};
</script>

<style>
</style>
