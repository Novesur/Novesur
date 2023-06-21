<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lista Parte de Salida</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">

        </div>

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label"> Fecha </label>

                        <div class="col-md-3">
                          <el-date-picker
                            v-model="fillBsqListPartSalida.dFecha"
                            type="daterange"
                            range-separator="A"
                            start-placeholder="Fecha Inicial"
                            end-placeholder="Fecha Final"
                            value-format="yyyy-MM-dd"
                            clearable
                          >
                          </el-date-picker>
                        </div><span><button class="btn btn-flat btn-info"  @click.prevent="getListarPartesalidaFecha">Buscar</button></span>
                      </div>
                    </div>
                  </div>

                     <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label"> Cliente </label>

                        <div class="col-md-3">
                         <el-select
                                v-model="fillBsqListPartSalida.nIdCliente"
                                filterable
                                placeholder="Select"
                                style="width: 100%"
                                clearable
                              >
                                <el-option
                                  v-for="item in listCliente"
                                  :key="item.id"
                                  :label="item.razonsocial"
                                  :value="item.id"
                                >
                                </el-option>
                              </el-select>
                        </div><span><button class="btn btn-flat btn-info"  @click.prevent="getListarPartesalidaCliente">Buscar</button></span>
                      </div>
                    </div>
                  </div>
                </form>

                <form role="form">
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-md-4 offset-4">

                        <button
                          class="btn btn-flat btn-default btnWidth"
                          @click.prevent="limpiarMarcaBsq"
                        >
                          Limpiar
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Bandeja de Entrada</h3>
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
                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Nro Factura</th>
                            <th>Nro Guia</th>
                            <th>Observación</th>
                            <th>Accion</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(
                              item, index
                            ) in listarProveedorfechaPaginated"
                            :key="index"
                          >
                            <td v-text="item.codigo"></td>
                            <td>{{ item.Fecha | moment("DD - MM - Y") }}</td>
                            <td v-text="item.cliente.razonsocial"></td>
                            <td v-text="item.Nrofactura"></td>
                            <td v-text="item.Nroguia"></td>
                            <td v-text="item.observacion"></td>

                            <td>
                              <button
                                @click.prevent="
                                  getPdfNroParteSalida(item.id)
                                "
                                class="btn btn-danger btn-sm"
                              >
                                <span><i class="far fa-file-pdf"></i></span>
                                PDF
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                          <li class="page-item" v-if="pageNumber > 0">
                            <a
                              href="#"
                              class="page-link"
                              @click.prevent="prevPage"
                              >Ant</a
                            >
                          </li>
                          <li
                            class="page-item"
                            v-for="(page, index) in pageCountlistProvfecha"
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
                          <li
                            class="page-item"
                            v-if="pageNumber < pageCountlistNroOrden - 1"
                          >
                            <a
                              href="#"
                              class="page-link"
                              @click.prevent="nextPage"
                              >Post</a
                            >
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </form>
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
      fillBsqListPartSalida: {
        nIdCliente: "",
        dFecha: "",
      },
      listCliente: [],
      listClienteFecha: [],
      listOrdenCompra: [],
      listOrdenCompraxOrdenCompra: [],
      pageNumber: 0,
      perPage: 10,
      activeName: "first",
    };
  },
  computed: {
    pageCountlistProvfecha() {
      let a = this.listClienteFecha.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },

    pageCountlistNroOrden() {
      let a = this.listOrdenCompraxOrdenCompra.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },

    listarProveedorfechaPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listClienteFecha.slice(inicio, fin);
    },

    listarxNroOrdenPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listOrdenCompraxOrdenCompra.slice(inicio, fin);
    },

    pageslistClienteFecha() {
      let a = this.listClienteFecha.length,
        b = this.perPage;
      let pageCountlistProvfecha = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];

      while (count < pageCountlistProvfecha) {
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    },

    pagesListxNroOrden() {
      let a = this.listOrdenCompraxOrdenCompra.length,
        b = this.perPage;
      let pageCountlistNroOrden = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];

      while (count < pageCountlistNroOrden) {
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    },
  },
  mounted() {
    this.getlistCliente();
  },
  methods: {
    limpiarMarcaBsq() {
      this.fillBsqListPartSalida.nIdCliente = "";
      this.fillBsqListPartSalida.dFecha="";

    },

    handleClick(tab, event) {
      console.log(tab, event);
    },

    limpiarBandejaMarca() {
      this.listCliente = [];
    },

    getlistCliente() {
      var url = "/administracion/cliente/getListarAllCliente";
      axios.get(url).then((response) => {
        this.listCliente = response.data;
      });
    },

    getlistVendedor() {
      var url = "/administracion/cliente/getListarAllCliente";
      axios.get(url).then((response) => {
        this.listCliente = response.data;
      });
    },
    getListarPartesalidaFecha() {
      var url = "/administracion/parte_salida/getListarPartesalidaFecha";
      axios
        .get(url, {
          params: {
            fecha1: this.fillBsqListPartSalida.dFecha[0],
            fecha2: this.fillBsqListPartSalida.dFecha[1],

          },
        })
        .then((response) => {
          this.listClienteFecha = response.data;
        });
    },

        getListarPartesalidaCliente() {
      var url = "/administracion/parte_salida/getListarPartesalidaCliente";
      axios
        .get(url, {
          params: {
            nIdCliente: this.fillBsqListPartSalida.nIdCliente,
          },
        })
        .then((response) => {
          console.log(response.data)
          this.listClienteFecha = response.data;
        });
    },

    getPdfProveedorFecha(item) {
      var config = { responseType: "blob" };
      var url = "/administracion/parte_ingreso/ProveedorFechaPdf";
      axios
        .post(
          url,
          {
            params: {
              item: item,
            },
          },
          config
        )
        .then((response) => {
          var oMyBlob = new Blob([response.data], { type: "application/pdf" });
          var url = URL.createObjectURL(oMyBlob);
          window.open(url);
          //window.print();
        });
    },

    getPdfNroParteSalida(item) {
      var config = { responseType: "blob" };
      var url = "/administracion/parte_salida/reporteParteSalidaPdf";
      axios
        .post(
          url,
          {
            params: {
              item: item,
            },
          },
          config
        )
        .then((response) => {
          var oMyBlob = new Blob([response.data], { type: "application/pdf" });
          var url = URL.createObjectURL(oMyBlob);
          window.open(url);
          //window.print();
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
