<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usuarios</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <template v-if="listRolPermisoByUsuario.includes('usuario.crear')">
              <router-link class="btn btn-info btn-sm" :to="{name:'usuario.crear'}">
                <i class="fas fa-plus-square"></i>Nuevo Usuario
              </router-link>
            </template>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterios de Busqueda</h3>
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
                            v-model="fillBsqUsuario.cFirstname"
                            @keyup.enter="getListarUsuarios"
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
                            v-model="fillBsqUsuario.cUsername"
                            @keyup.enter="getListarUsuarios"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Correo Electronico</label
                        >
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillBsqUsuario.cEmail"
                            @keyup.enter="getListarUsuarios"
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
                      @click.prevent="getListarUsuarios"
                    >
                      Buscar
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

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Bandeja de Resultados</h3>
              </div>
              <div class="card-body table-responsive">
                <table
                  class="table table-hover table-head-fixed text-nowrap projects"
                >
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellido Paterno</th>
                      <th>Apellido Materno</th>
                      <th>Usuario</th>
                      <th>Email</th>
                       <th>Celular</th>
                       <th>Almacen</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(item, index) in listarUsuariosPaginated"
                      :key="index"
                    >
                      <td v-text="item.firstname"></td>
                      <td v-text="item.secondname"></td>
                      <td v-text="item.lastname"></td>
                      <td v-text="item.username"></td>
                      <td v-text="item.email"></td>
                      <td v-text="item.celular"></td>
                      <td v-text="item.almacen.nombre"></td>

                      <td>
                        <router-link
                          class="btn btn-info btn-sm"
                          :to="{
                            name: 'usuario.editar',
                            params: { id: item.id },
                          }"
                        >
                          <i class="fas fa-pencil-alt"></i>Editar
                        </router-link>
                        <router-link
                          class="btn btn-success btn-sm"
                          :to="{
                            name: 'usuario.permiso',
                            params: { id: item.id },
                          }"
                        >
                          <i class="fas fa-key"></i>Permiso
                        </router-link>

                        <button
                          class="btn btn-danger btn-sm"
                          @click.prevent="setConfirmaDeleteUsuario(item.id)"
                        >
                          <i class="fas fa-trash"></i>Eliminar
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item" v-if="pageNumber > 0">
                      <a href="" class="page-link" @click.prevent="prevPage"
                        >Ant</a
                      >
                    </li>
                    <li
                      class="page-item"
                      v-for="(page, index) in pagesList"
                      :key="index"
                       :class="page == pageNumber ? 'active' : ''"
                    >
                       <a
                              href="#"
                              class="page-link"
                              @click.prevent="SelectPage(page)"
                              >{{ page + 1 }}</a
                            >
                    </li>
                    <li class="page-item" v-if="pageNumber < pageCount - 1">

                      <a href="" class="page-link" @click.prevent="nextPage"
                        >Post</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
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
      fillBsqUsuario: {
        nIdUsuario: this.$attrs.id,
        cFirstname: "",
        cSecondname: "",
        cLastname: "",
        cUsername: "",
        cEmail: "",
      },
      listUsuarios: [],
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
      pageNumber: 0,
      perPage: 10,
    };
  },
  computed: {
    pageCount() {
      let a = this.listUsuarios.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listarUsuariosPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listUsuarios.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listUsuarios.length,
        b = this.perPage;
      let pageCount = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];
      while (count < pageCount) {
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    },
  },
  methods: {
    limpiarCriteriosBsq() {
      this.fillBsqUsuario.cUsername = "";
      this.fillBsqUsuario.cFirstname = "";
      this.fillBsqUsuario.cEmail = "";
    },
    limpiarBandejaUsuario() {
      this.listUsuarios = [];
    },
    getListarUsuarios() {
      var url = "/administracion/usuario/listUsuario";
      axios
        .get(url, {
          params: {
            cFirstname: this.fillBsqUsuario.cFirstname,
            cUsername: this.fillBsqUsuario.cUsername,
            cEmail: this.fillBsqUsuario.cEmail,
          },
        })
        .then((response) => {
          this.inicializarPaginacion();
          this.listUsuarios = response.data;
        });
    },
    nextPage() {
      this.pageNumber++;
    },
    prevPage() {
      this.pageNumber--;
    },
     SelectPage(page) {
      this.pageNumber = page;
    },
    inicializarPaginacion() {
      this.pageNumber = 0;
    },
    setConfirmaDeleteUsuario(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });

      swalWithBootstrapButtons
        .fire({
          title: "Confirma que desea Dar de baja?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, Dale de baja!",
          cancelButtonText: "No, cancelalo!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            var url = "/administracion/usuario/setDesactivarUsuario";
            axios
              .post(url, {
                nIdUsuario: id,
              })
              .then((response) => {
                this.getListarUsuarios();
              });
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              "Cancelado",
              "Se cancelo el proceso",
              "error"
            );
          }
        });
    },
  },
};
</script>

<style>
</style>
