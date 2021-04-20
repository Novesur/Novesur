<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Rol</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/roles'">
              <i class="fas fa-plus-square"></i>Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid"></div>
        </div>

        <div class="row">
          <div class="col-md-5">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Registrar Rol</h3>
              </div>
              <div class="card-body">
                <form role="">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearRol.cNombre"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Url Amigable</label
                        >
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearRol.cSlug"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <button
                    class="btn btn-flat btn-info btnWidth"
                    @click.prevent="setValidarRoles"
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

          <div class="col-md-7">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Listar Permisos</h3>
              </div>
              <div class="card-body table-responsive">
                <table
                  class="table table-hover table-head-fixed text-nowrap projects"
                >
                  <thead>
                    <tr>
                      <th>Accion</th>
                      <th>Nombre</th>
                      <th>Url Amigable</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in listPermisosFilter" :key="index" @click.prevent="marcarFila(index)">
                      <td>
                        <el-checkbox v-model="item.checked">Seleccionar</el-checkbox>
                      </td>
                      <td v-text="item.name"></td>
                      <td v-text="item.slug"></td>
                    </tr>
                  </tbody>
                </table>
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
      fillCrearRol: {
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
  mounted() {
    this.getListarPermisosByRol();

  },
  methods: {

      marcarFila(index){
          this.listPermisosFilter[index].checked = !this.listPermisosFilter[index].checked
      },
      filtrarPermisoByRol(){
          let me = this;
          me.listPermisos.map(function(x,y){
              me.listPermisosFilter.push({
                  'id': x.id,
                  'name':x.name,
                  'slug':x.slug,
                  'checked':false,
              }

              )

          })
      },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    getListarPermisosByRol() {
      var url = "/administracion/rol/getListarPermisosByRol";
      axios.get(url).then((response) => {
        this.listPermisos = response.data;
         this.filtrarPermisoByRol();
      });
    },

    validarRegistrarRol() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearRol.cNombre) {
        this.mensajeError.push("El Nombre Obligatorio");
      }

      if (!this.fillCrearRol.cSlug) {
        this.mensajeError.push("Apellido Paterno Obligatorio");
      }
      let contador=0;
      this.listPermisosFilter.map(function(x,y){
          if(x.checked == true){
              contador ++;
          }
      })

        if(contador == 0){
            this.mensajeError.push("Debe seleccionar al menos un permiso");
          }


      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },

    limpiarCriteriosBsq() {
      this.fillCrearRol.cNombre = "";
      this.fillCrearRol.cSlug = "";
    },

    setValidarRoles() {
      if (this.validarRegistrarRol()) {
        this.modalShow = true;
        return;
      }
      this.setRegistrarRolPermisos();
    },

    setRegistrarRolPermisos() {
      var url = "/administracion/rol/setRegistrarRolPermiso";
      axios
        .post(url, {
         'cNombre' : this.fillCrearRol.cNombre,
          'cSlug'  : this.fillCrearRol.cSlug,
          'listPermisosFilter' : this.listPermisosFilter

        })
        .then((response) => {
          console.log("Permiso guardado");
          this.$router.push("/roles");

        });
    },
  },
};
</script>

<style>
</style>
