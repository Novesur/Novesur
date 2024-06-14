<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reporte de Alertas</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/material/crear'">
              <i class="fas fa-plus-square"></i>Regresar
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
                <!-- BUSCAR POR FECHA -->

                <form role="form">
                  <div class="col-md-12">
                    <div class="row"></div>

                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-7">
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                              >Fecha de Vencimiento</label
                            >
                            <el-date-picker
                              v-model="fillListAlertas.dFecha"
                              type="daterange"
                              range-separator="To"
                              start-placeholder="Start date"
                              end-placeholder="End date"
                              value-format="yyyy-MM-dd"
                              clearable
                              :style="{ width: '600px', height: '38px' }"
                            >
                            </el-date-picker>
                          </div>
                        </div>

                        <div class="col flex items-center text-sm">
                          <el-radio-group v-model="fillListAlertas.rEstados">
                            <el-radio value="4" size="large" label="4"
                              >Pendientes</el-radio
                            >
                            <el-radio value="3" size="large" label="3"
                              >Atendidos</el-radio
                            >
                          </el-radio-group>
                        </div>

                        <div class="col">
                          <button
                            class="btn btn-flat btn-info"
                            @click.prevent="getAlertasListByDate"
                          >
                            Buscar
                          </button>
                          <button
                            class="btn btn-flat btn-success"
                            @click.prevent="getExcelAlertasByFecha"
                          >
                            <span><i class="fas fa-file-excel"></i> EXCEL</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>

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
                          <th>F. Registro</th>
                          <th>F. Vencimiento</th>
                          <th>Obligación</th>
                          <th>Entidad</th>
                          <th>Importe</th>
                          <th>Moneda</th>
                          <th>Usuario</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(item, index) in listAlertasPaginatedbyDate"
                          :key="index"
                        >
                          <td>
                            {{ item.fRegistro | moment("DD - MM - Y") }}
                          </td>
                          <td>
                            {{ item.fVencimiento | moment("DD - MM - Y") }}
                          </td>

                          <td>
                            {{ item.obligacion }}
                          </td>
                          <td>
                            {{ item.entidad }}
                          </td>
                          <td>{{ item.tipocambio.signo }} {{ item.importe }}</td>
                          <td v-text="item.tipocambio.nombre"></td>
                          <td v-text="item.user.fullname"></td>
                          <td>
                            <button
                              type="button"
                              class="btn btn-danger btn-sm"
                              @click.prevent="setEstadoAtendido(item.id)"
                            >
                              <span><i class="far fa-calendar-check"></i> Atendido</span>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="card-footer">
                      <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item" v-if="pageNumber > 0">
                          <a href="#" class="page-link" @click.prevent="prevPage">Ant</a>
                        </li>
                        <li
                          class="page-item"
                          v-for="(page, index) in pagesListByDate"
                          :key="index"
                          :class="page == pageNumber ? 'active' : ''"
                        >
                          <a href="#" class="page-link" @click.prevent="selectPage(page)">
                            {{ page + 1 }}</a
                          >
                        </li>
                        <li class="page-item" v-if="pageNumber < pageCountByDate - 1">
                          <a href="#" class="page-link" @click.prevent="nextPage">Post</a>
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
    </div>
  </div>
</template>

<script>
import FileSaver from "file-saver";
export default {
  data() {
    return {
      fillListAlertas: {
        cNombre: "",
        itemid: "",
        dFecha: "",
        nIdtEstadoCoti: "",
        nIdVendedor: "",
        cSelectAnios: "2022",
        nIdUser: sessionStorage.getItem("iduser"),
        nIdprod: "",
        rEstados: "4",
      },
      rangoAnios: [
        { label: "2021", value: "2021" },
        { label: "2022", value: "2022" },
      ],
      activeName: "first",
      listDetPedido: [],
      listVendedorAdmin: [],
      listVendedorUser: [],
      listCotizacion: [],
      listAlertasByDate: [],
      listCliente: [],
      listEstadoCoti: [],

      listProd: [],
      modalShow: false,
      modalEstado: false,
      btnEditarEstado: false,
      mostrarModal: {
        display: "block",
        background: "#0000006b",
      },
      ocultarModal: {
        display: "none",
      },
      pageNumber: 0,
      perPage: 20,
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),

      ///Formato de la Fecha
      pickerOptions: {
        disabledDate(time) {
          return time.getTime() > Date.now.Date();
        },
        shortcuts: [
          {
            text: "Today",
            onClick(picker) {
              picker.$emit("pick", new Date());
            },
          },
          {
            text: "Yesterday",
            onClick(picker) {
              const date = new Date();
              date.setTime(date.getTime() - 3600 * 1000 * 24);
              picker.$emit("pick", date);
            },
          },
          {
            text: "A week ago",
            onClick(picker) {
              const date = new Date();
              date.setTime(date.getTime() - 3600 * 1000 * 24 * 7);
              picker.$emit("pick", date);
            },
          },
        ],
      },
    };
  },

  mounted() {
    //this.cargaFechaActual();
    this.getlistVendedorxUsu();
    this.getlistEstadoPedido();
    this.getlistVendedorAdmin();
    this.getListarproductosByName();
  },

  computed: {
    pageCount() {
      let a = this.listCotizacion.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },

    pageCountByDate() {
      let a = this.listAlertasByDate.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },

    listCotizacionPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listCotizacion.slice(inicio, fin);
    },

    listAlertasPaginatedbyDate() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listAlertasByDate.slice(inicio, fin);
    },

    pagesList() {
      let a = this.listCotizacion.length,
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

    pagesListByDate() {
      let a = this.listAlertasByDate.length,
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
    setEstadoAtendido(id) {
      var url = "/administracion/alertas/setEstadoAtendido";
      axios
        .post(url, {
          id,
        })
        .then((response) => {
          this.getAlertasListByDate();
        });
    },

    getlistCotizacionListByProd() {
      var url = "/administracion/cotizacion/listCotizacionList";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillListAlertas.nIdprod,
            cSelectAnios: this.fillListAlertas.cSelectAnios,
          },
        })
        .then((response) => {
          this.listCotizacion = response.data;
        });
    },

    getlistProdListByVendedor() {
      var url = "/administracion/cotizacion/listDetalleProductosListByVendedor";
      axios
        .get(url, {
          params: {
            nIdVendedor: this.fillListAlertas.nIdVendedor,
          },
        })
        .then((response) => {
          this.listAlertasByDate = response.data;
        });
    },

    getAlertasListByDate() {
      var url = "/administracion/alertas/list";
      axios
        .get(url, {
          params: {
            dFecha: this.fillListAlertas.dFecha,
            fecha1: this.fillListAlertas.dFecha[0],
            fecha2: this.fillListAlertas.dFecha[1],
            rEstados: this.fillListAlertas.rEstados,
          },
        })
        .then((response) => {
          this.listAlertasByDate = response.data;
        });
    },

    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillListAlertas.nIdprod,
          },
        })
        .then((response) => {
          this.listProd = response.data;
        });
    },

    cargaFechaActual() {
      this.fillListAlertas.dFecha = new Date();
    },

    limpiarCriteriosBsq() {
      this.fillListAlertas.cNombre = "";
    },
    limpiarBandejaMaterial() {
      this.listDetPedido = [];
    },

    getlistVendedorxUsu() {
      var url = "/administracion/usuario/getListarUsusariosbyId";
      axios
        .get(url, {
          params: {
            nIdUsuario: this.fillListAlertas.nIdUser,
          },
        })
        .then((response) => {
          this.listVendedorUser = response.data;
          this.fillListAlertas.nIdVendedor = this.listVendedorUser[0].id;
          this.getlistCliente();
        });
    },

    getlistEstadoPedido(item) {
      var url = "/administracion/detallecotizancion/listEstadoCotizacion";
      axios.get(url).then((response) => {
        this.listEstadoCoti = response.data;
      });
    },

    getExcelCotizacionProduct() {
      var url = "/operacion/cotizacionProduct/exportProduct";
      axios
        .post(
          url,
          {
            params: { listCotizacion: JSON.stringify(this.listCotizacion) },
          },
          { responseType: "blob" }
        )
        .then((response) => {
          FileSaver.saveAs(response.data, "CotizacionProduct.xlsx");
        });
    },
    getExcelAlertasByFecha() {
      var url = "/operacion/alertas/ExcelAlertasByFecha";
      axios
        .post(
          url,
          {
            params: {
              listAlertasByDate: JSON.stringify(this.listAlertasByDate),
            },
          },
          { responseType: "blob" }
        )
        .then((response) => {
          FileSaver.saveAs(response.data, "AlertaContabilidad.xlsx");
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

<style></style>
