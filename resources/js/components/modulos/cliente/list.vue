<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Listado de Clientes</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterio de Busqueda</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label"
                          >Razon Social</label
                        >
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillBsqListclient.cNombre"
                            @keyup.enter="getListarCliente"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Ruc</label>
                        <div class="col-md-5">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillBsqListclient.cRuc"
                            v-int
                            :maxlength="11"
                            @keyup.enter="getListarCliente"
                          />
                        </div>
                      </div>
                    </div>
                <!--     <template
                      v-if="listRolPermisoByUsuario.includes('consulta.ventas')"
                    >
                    </template> -->
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="getListarCliente"
                    >
                      Buscar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="limpiarListClientsBsq"
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
                  class="
                    table table-hover table-head-fixed
                    text-nowrap
                    projects
                  "
                >
                  <thead>
                    <tr>
                      <th>Vendedor</th>
                      <th>Razon Social</th>
                      <th>Ruc</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(item, index) in listarClientesPaginated"
                      :key="index"
                    >
                      <td>
                        {{
                          item.user == null
                            ? "Dado de Baja"
                            : item.user.fullname
                        }}
                      </td>

                      <td v-text="item.razonsocial"></td>
                      <td v-text="item.ruc"></td>
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
import FileSaver from "file-saver";
export default {
  data() {
    return {
      fillBsqListclient: {
        cNombre: "",
        cRuc: "",
        nIdUser: sessionStorage.getItem("iduser"),
      },
      listCliente: [],
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
      pageNumber: 0,
      perPage: 10,
  
    };
  },
  mounted() {},

  computed: {
    pageCount() {
      let a = this.listCliente.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listarClientesPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listCliente.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listCliente.length,
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
    limpiarListClientsBsq() {
      this.fillBsqListclient.cNombre = "";
      this.fillBsqListclient.cRuc = "";
        this.listCliente =[];

    },
    limpiarBandejaProveedor() {
      this.listCliente = [];
    },
    getListarCliente() {
      var url = "/administracion/cliente/listClientAll";
      axios
        .get(url, {
          params: {
            cNombre: this.fillBsqListclient.cNombre,
            cRuc: this.fillBsqListclient.cRuc,
          },
        })
        .then((response) => {
          if (response.data.icon == "error") {
              Swal.fire({
        position: "center",
        icon: response.data.icon,
        title: response.data.message,
        showConfirmButton: false,
        timer: 2000,
      });
          }else{
                  this.inicializarPAginacion();
            this.listCliente = response.data;
          }
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
    inicializarPAginacion() {
      this.pageNumber = 0;
    },
  },
};
</script>

<style>
</style>
