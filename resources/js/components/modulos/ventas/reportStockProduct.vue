<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reporte de Stock de productos</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/marca/crear'">
              <i class="fas fa-undo-alt"></i> Regresar
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
                <form role="form">
                  <div class="col-md- offset-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Producto</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillBsqReportStockProd.cNombre"
                              @keypress.enter.prevent="getListarStockProd"
                            />
                          </div>
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
                      @click.prevent="getListarStockProd"
                    >
                      Buscar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="limpiarReporteStockProdBsq"
                    >
                      Limpiar
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Bandeja de Entrada</h3>
              </div>
              <div class="card-body table-responsive">
                <table
                  class="table table-hover table-head-fixed text-nowrap projects"
                >
                  <thead>
                    <tr>
                      <th>Producto</th>
                      <th>Stock</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(item, index) in listarMarcasPaginated"
                      :key="index"
                    >
                      <td v-text="item.nombre"></td>
                      <td v-text="item.stock"> </td>

                    </tr>
                  </tbody>
                </table>
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item" v-if="pageNumber > 0">
                      <a href="#" class="page-link" @click.prevent="prevPage"
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
                        href="#"
                        class="page-link"
                        @click.prevent="selectPage(page)"
                        >{{ page + 1 }}</a
                      >
                    </li>
                    <li class="page-item" v-if="pageNumber < pageCount - 1">
                      <a href="#" class="page-link" @click.prevent="nextPage"
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
      fillBsqReportStockProd: {
        cNombre: "",
      },
      listStockProd: [],
      pageNumber: 0,
      perPage: 5,
    };
  },
  computed: {
    pageCount() {
      let a = this.listStockProd.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listarMarcasPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listStockProd.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listStockProd.length,
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
    limpiarReporteStockProdBsq() {
      this.fillBsqReportStockProd.cNombre = "";
    },

    getListarStockProd() {
      var url = "/administracion/ventas/getListarStockProds";
      axios
        .get(url, {
          params: {
            cNombre: this.fillBsqReportStockProd.cNombre,
          },
        })
        .then((response) => {
          console.log(response.data);
           this.inicializarPaginacion();
          this.listStockProd = response.data;
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
  },
};
</script>

<style>
</style>
