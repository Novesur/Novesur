<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Asignar Permiso</h1>
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
          <div class="container-fluid"></div>
        </div>

        <div class="row">


          <div class="col-md-5">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Listar Permisos del Rol {{this.fillPermiso.cNombreRol}}</h3>
              </div>
              <div class="card-body table-responsive">

                  <div class="scrollTable">
                <table
                  class="table table-hover table-head-fixed text-nowrap projects"
                >
                  <thead>
                    <tr>

                      <th>Nombre</th>
                      <th>Url Amigable</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in listPermisosByUser" :key="index" >

                      <td v-text="item.nombre"></td>
                      <td v-text="item.permiso"></td>
                    </tr>
                  </tbody>
                </table>
                  </div>

              </div>

                    <div class="card-footer">
                <div class="row">

                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setRegistrarRolPermisosByUSers"
                    >
                      Registrar
                    </button>

                </div>
              </div>

            </div>


          </div>


                <div class="col-md-7">
            <div class="card card-info">
              <div class="card-header">

                <h3 class="card-title">Listar Permisos  </h3>
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
      fillPermiso: {
        nIdUsuario: this.$attrs.id,
        cNombreRol:'',
        nIdRol:'',

      },
      listPermisosByRolAsignado: [],
      listPermisos: [],
      listPermisosByUser:[],
      lisRolPermisosByUsuarioFilter:[],
      lisRolPermisosByUsuario:[],
       listUsuarios: [],
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
    this.getListarUsuariosById();
  },

  methods: {

      getlistPermisosByRolAsignado(){
           var url = "/administracion/usuario/getListarPermisosByRol";
         axios.get(url,{
             params:{
                 'nIdUsuario': this.fillPermiso.nIdUsuario,
             }
         }).then((response) => {
        this.listPermisosByRolAsignado = response.data;
      });

      },

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
                 'checked'   : (x.checked==1)? true:false,
              }

              )

          })
      },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },

        getListarPermisosByRol() {
      var url = "/administracion/rol/getListarPermisosByRol";

      axios.get(url,{
          params:{
              'nIdRol' : this.fillPermiso.nIdRol  ,

          },
      }).then((response) => {
        this.listPermisos = response.data;
        this.filtrarPermisoByRol();
        this.getListarPermisosByUser();
      });
    },


    getListarUsuariosById() {
      var url = "/administracion/usuario/listUsuarioById";
      axios
        .get(url, {
          params: {
            nIdUsuario: this.fillPermiso.nIdUsuario,
          },
        })
        .then((response) => {
            this.fillPermiso.cNombreRol = (response.data.length == 0) ? '' : response.data.roles.nombre
             this.fillPermiso.nIdRol = (response.data.length == 0) ? '' : response.data.roles.id

    this.getListarPermisosByRol();
        });
    },
    getListarPermisosByUser() {
      var url = "/administracion/permiso/listUsuarioById";
      axios
        .get(url, {
          params: {
            nIdUsuario: this.fillPermiso.nIdUsuario,
          },
        })
        .then((response) => {
            this.listPermisosByUser = response.data;
        });
    },

    validarRegistrarRol() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillPermiso.cNombre) {
        this.mensajeError.push("El Nombre Obligatorio");
      }

      if (!this.fillPermiso.cSlug) {
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
      this.fillPermiso.cNombre = "";
      this.fillPermiso.cSlug = "";
    },

    setValidarRoles() {
      if (this.validarRegistrarRol()) {
        this.modalShow = true;
        return;
      }
      this.setRegistrarRolPermisosByUSers();
    },

    setRegistrarRolPermisosByUSers() {
      var url = "/administracion/permiso/RegistrarPermisosByUsuario";
      axios
        .post(url, {

          'nIdRol' : this.fillPermiso.nIdRol  ,
          'listPermisosFilter' : this.listPermisosFilter

        })
        .then((response) => {
            this. getListarRolPermisosByUsuario()

        });
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
         me.lisRolPermisosByUsuarioFilter=[];
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
  },
};
</script>

<style>
</style>
