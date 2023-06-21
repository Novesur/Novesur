<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Proveedor</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/proveedor/crear'">
              <i class="fas fa-plus-square"></i> Nuevo Proveedor
            </router-link>

                 <template v-if="listRolPermisoByUsuario.includes('proveedor.Excel')">
              <button
                class="btn btn-success btn-sm"
                @click.prevent="getExcelProveedor"
              >
                <span><i class="fas fa-file-excel"></i> EXCEL</span>
              </button>
            </template>
          </div>
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
                        <label class="col-md-2 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillBsqProveedor.cNombre"
                            @keyup.enter="getListarProveedor"
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
                            v-model="fillBsqProveedor.cRuc"
                            v-int
                            :maxlength="11"
                            @keyup.enter="getListarProveedor"
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
                      @click.prevent="getListarProveedor"
                    >
                      Buscar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="limpiarProveedorBsq"
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
                      <th>Orden</th>
                      <th>Nombre</th>
                      <th>Ruc</th>
                      <th>Direccion</th>
                      <th>Telefono</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(item, index) in listarProveedoresPaginated"
                      :key="index"
                    >
                      <td>
                        <router-link
                          class="btn btn-success btn-sm"
                          :to="{
                            name: 'ordenCompra.create',
                            params: { id: item.id },
                          }"
                        >
                          <i class="fas fa-cart-plus"></i> Orden de Bienes
                        </router-link>

                             <router-link
                          class="btn btn-secondary btn-sm"
                          :to="{
                            name: 'ordenServicio.create',
                            params: { id: item.id },
                          }"
                        >
                          <i class="fas fa-hand-holding"></i> Orden de Servicio
                        </router-link>
                      </td>
                      <td v-text="item.nombre"></td>
                      <td v-text="item.ruc"></td>
                      <td v-text="item.direccion"></td>
                      <td v-text="item.telefono"></td>

                      <td>
                        <router-link
                          class="btn btn-info btn-sm"
                          :to="{
                            name: 'proveedor.editar',
                            params: { id: item.id },
                          }"
                        >
                          <i class="fas fa-pencil-alt"></i> Editar
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
                      :class="page == pageNumber ? 'active' : ''"
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
      fillBsqProveedor: {
        cNombre: "",
        cRuc: "",
      },
      listProveedor: [],
      listProveedor: [],
          listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
      pageNumber: 0,
      perPage: 10,
    };
  },
  computed: {
    pageCount() {
      let a = this.listProveedor.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listarProveedoresPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listProveedor.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listProveedor.length,
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
    limpiarProveedorBsq() {
      this.fillBsqProveedor.cNombre = "";
      this.fillBsqProveedor.cRuc = "";
      this.limpiarBandejaProveedor();
    },
    limpiarBandejaProveedor() {
      this.listProveedor = [];
    },
    getListarProveedor() {
      var url = "/administracion/proveedor/getListarProveedor";
      axios
        .get(url, {
          params: {
            cNombre: this.fillBsqProveedor.cNombre,
            cRuc: this.fillBsqProveedor.cRuc,
          },
        })
        .then((response) => {
          this.inicializarPAginacion();
          this.listProveedor = response.data;
        });
    },
        getExcelProveedor() {
      var url = "/operacion/Proveedor/export";
      axios
        .post(
          url,
          {
            params: { listProveedor: JSON.stringify(this.listProveedor) },
          },
          { responseType: "blob" }
        )
        .then((response) => {
          FileSaver.saveAs(response.data, "Proveedor.xlsx");
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
