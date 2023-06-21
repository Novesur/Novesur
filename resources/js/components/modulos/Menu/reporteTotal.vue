<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reporte Total de Menu</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <button
              class="btn btn-success btn-sm"
              @click.prevent="getExcelDetalleMenuTotal"
            >
              <span><i class="fas fa-file-excel"></i> Reporte</span>
            </button>

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
                  <div class="col-md-8 offset-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Rango de Fechas</label
                          >
                          <div class="col-md-9">
                            <el-date-picker
                              v-model="fillBsqDetalleTotalMenu.cSelectDate"
                              type="daterange"
                              range-separator="A"
                              start-placeholder="Fecha Inicial"
                              end-placeholder="Fecha Final"
                            >
                            </el-date-picker>
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
                      @click.prevent="getListMenubyDate"
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
                  class="
                    table table-hover table-head-fixed
                    text-nowrap
                    projects
                  "
                >
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Personal</th>
                      <th>TipoMenu</th>
                      <th>Total</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(item, index) in listeMenuDetalleTotalFecha"
                      :key="index"
                    >
                       <td>{{ item.fecha | moment("DD - MM - Y") }}</td>
                      <td>{{ item.personal }}</td>
                      <td v-text="item.tipomenu"></td>
                       <td v-text="item.total"></td>

                    </tr>
                  </tbody>
                </table>
                <!--        <div class="card-footer">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item" v-if="pageNumber>0">
                      <a href="#" class="page-link" @click.prevent="prevPage">Ant</a>
                    </li>
                    <li class="page-item " v-for="(page,index) in pagesList" :key="index" :class="page == pageNumber ? 'active' : ''">
                      <a href="#" class="page-link" @click.prevent="selectPage(page)"> {{ page +1}}</a>
                    </li>
                    <li class="page-item" v-if="pageNumber < pageCount - 1">
                      <a href="#" class="page-link" @click.prevent="nextPage">Post</a>
                    </li>
                  </ul>
                </div> -->
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
      fillBsqDetalleTotalMenu: {
        cSelectDate: "",
      },
      listeMenuDetalleTotalFecha: [],
      pageNumber: 0,
      perPage: 10,
    };
  },
  computed: {
    pageCount() {
      let a = this.listMaterial.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listMaterialPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listMaterial.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listMaterial.length,
        b = this.perPage;
      let PageCount = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];

      while (count < PageCount) {
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    },
  },
  methods: {
    limpiarCriteriosBsq() {
      this.fillBsqDetalleTotalMenu.cSelectDate = "";
      this.listeMenuDetalleTotalFecha = [];
    },
    limpiarBandejaMaterial() {
      this.listMaterial = [];
    },

    getListMenubyDate() {
      var url = "/administracion/Menu/ListMenuTotal";
      axios
        .get(url, {
          params: {
            dFechainicio: !this.fillBsqDetalleTotalMenu.cSelectDate
              ? ""
              : this.fillBsqDetalleTotalMenu.cSelectDate[0],
            dFechafin: !this.fillBsqDetalleTotalMenu.cSelectDate
              ? ""
              : this.fillBsqDetalleTotalMenu.cSelectDate[1],
          },
        })
        .then((response) => {
          console.log(response);
          this.listeMenuDetalleTotalFecha = response.data;
        });
    },

    getExcelDetalleMenuTotal() {
      var url = "/operacion/Menu/exportTotal";
      axios
        .post(
          url,
          {
            params: {
              listeMenuDetalleTotalFecha: JSON.stringify(
                this.listeMenuDetalleTotalFecha
              ),
            },
          },
          { responseType: "blob" }
        )
        .then((response) => {
          FileSaver.saveAs(response.data, "DetalleTotalMenu.xlsx");
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
