<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Rol</h1>
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
                <h3 class="card-title">Formulario Editar Usuario</h3>
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
                            v-model="fillEditarRol.cNombre"
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
                            v-model="fillEditarRol.cSlug"
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
                    @click.prevent="setEditarRolPermisos"
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
                    <tr
                      v-for="(item, index) in listPermisosFilter"
                      :key="index"
                      @click.prevent="marcarFila(index)"
                    >
                      <td>
                        <el-checkbox v-model="item.checked" :class="{disabled:isactive}"
                          >Seleccionar</el-checkbox
                        >
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

      fillEditarRol: {
        nIdRol: this.$attrs.id,
        cNombre: "",
        cSlug: "",
      },
      active: true,
      listPermisos: [],
      listPermisosFilter: [],
       lisRolPermisosByUsuario:[],
       lisRolPermisosByUsuarioFilter:[],

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
    this.getListarRoles();
  },
  methods: {
    marcarFila(index) {
      this.listPermisosFilter[index].checked = !this.listPermisosFilter[index]
        .checked;
    },
    filtrarPermisoByRol() {
      let me = this;
      me.listPermisos.map(function (x, y) {
        me.listPermisosFilter.push({
          'id'        : x.id,
          'name'      : x.name,
          'slug'      : x.slug,
          'checked'   : (x.checked==1)? true:false,
        });
      });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },


    getListarRoles() {
      var url = "/administracion/rol/listRolByUSer";
      axios
        .get(url, {
          params: {
            nIdRol: this.fillEditarRol.nIdRol,
          },
        })
        .then((response) => {
          this.listRoles = response.data;
          this.fillEditarRol.cNombre = response.data[0].nombre;
          this.fillEditarRol.cSlug = response.data[0].slug;
        });
    },
    getListarPermisosByRol() {
      var url = "/administracion/rol/getListarPermisosByRol";
      axios.get(url,{
          params:{
              'nIdRol' : this.fillEditarRol.nIdRol,
          }
      }).then((response) => {
        this.listPermisos = response.data;
        this.filtrarPermisoByRol();
      });
    },
    inicializarPaginacion() {
      this.pageNumber = 0;
    },

    limpiarCriteriosBsq() {
      this.fillEditarRol.cNombre = "";
      this.fillEditarRol.cSlug = "";
    },

    setValidarRoles() {
      if (this.validarEditarRol()) {
        this.modalShow = true;
        return;
      }
      this.setEditarRolPermisos();
    },

      getListarRolPermisosByUsuario() {
      var url = "/administracion/usuario/getListarRolPermisosByUsuario";
      axios.get(url).then(response => {
          this.lisRolPermisosByUsuario = response.data;
          this.filterListarPermisosByUsuario();

        });
    },

    filterListarPermisosByUsuario(){
        let me = this;
        me.lisRolPermisosByUsuario.map(function (x,y){
             me.lisRolPermisosByUsuarioFilter.push(x.slug)
        })

        sessionStorage.setItem('listRolPermisosByUsuario', JSON.stringify(me.lisRolPermisosByUsuarioFilter));
        EventBus.$emit('notifyRolPermisosByUsuario',me.lisRolPermisosByUsuarioFilter)
            Swal.fire({
            icon: "success",
            title: "Se actualizo el rol correctamente",
            showConfirmButton: false,
            timer: 1500,
          });



    },


    setEditarRolPermisos() {
      var url = "/administracion/rol/setEditarRolPermiso";
      axios
        .post(url, {
          'nIdRol': this.fillEditarRol.nIdRol,
          'cNombre': this.fillEditarRol.cNombre,
          'cSlug': this.fillEditarRol.cSlug,
          'listPermisosFilter': this.listPermisosFilter,
        })
        .then((response) => {
            this.getListarRolPermisosByUsuario();

        });
    },
  },
};
</script>

<style>
</style>
