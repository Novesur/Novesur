<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Rol</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/roles/crear'">
              <i class="fas fa-plus-square"></i>Nuevo Rol
            </router-link>
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
                            v-model="fillBsqRol.cNombre"
                            @keyup.enter="getListarRoles"
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
                            v-model="fillBsqRol.cUrl"
                            @keyup.enter="getListarRoles"
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
                      @click.prevent="getListarRoles"
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
                      <th>Url Amigable</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(item, index) in listarRolesPaginated"
                      :key="index"
                    >
                      <td v-text="item.nombre"></td>
                      <td v-text="item.slug"></td>
                      <td>
                        <router-link
                          class="btn btn-info btn-sm"
                          :to="{
                            name: 'rol.editar',
                            params: { id: item.id },
                          }"
                        >
                          <i class="fas fa-pencil-alt"></i>Editar
                        </router-link>

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
                      :class="[page == pageNumber ? 'active' : '']"
                    >
                            <a
                          href=""
                          class="page-link"
                          @click.prevent="selectPage(page)"
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
      fillBsqRol: {
        cNombre: "",
        cUrl: "",
      },
      listRoles: [],
      pageNumber: 0,
      perPage: 5,
    };
  },
  computed: {
    pageCount() {
      let a = this.listRoles.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listarRolesPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listRoles.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listRoles.length,
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
      this.fillBsqRol.cUsername = "";
      this.fillBsqRol.cFirstname = "";
      this.fillBsqRol.cEmail = "";
    },
    limpiarBandejaUsuario() {
      this.listRoles = [];
    },
    getListarRoles() {
      var url = "/administracion/rol/listRoles";
      axios
        .get(url, {
          params: {
            'cNombre': this.fillBsqRol.cNombre,
            'cSlug': this.fillBsqRol.cSlug,
          },
        })
        .then((response) => {
          this.inicializarPaginacion();
          this.listRoles = response.data;
        });
    },
    nextPage() {
      this.pageNumber++;
    },
    prevPage() {
      this.pageNumber--;
    },
       selectPage(page) {
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
                this.getListarRoles();
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
