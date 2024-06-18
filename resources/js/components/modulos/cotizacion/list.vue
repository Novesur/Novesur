<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Consulta de Cotizaciones</h1>
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
                <el-tabs v-model="activeName" >
                  <!-- Buscar por Producto -->
                  <el-tab-pane label="Por Producto" name="first">
                    <form role="form">
                      <div class="col-md-12">
                        <div class="row">
                          <template
                            v-if="
                              listRolPermisoByUsuario.includes(
                                'admin.listado_coti'
                              )
                            "
                          >
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-md-1 col-form-label"
                                  >Producto</label
                                >
                                <div class="col-md-9">
                                  <el-select
                                    v-model="fillListCotizacion.nIdprod"
                                    style="width: 100%"
                                    filterable
                                    placeholder="Select"
                                    clearable
                                  >
                                    <el-option
                                      v-for="item in listProd"
                                      :key="item.id"
                                      :label="
                                        item.codigo +
                                        ' - ' +
                                        item.familia.nombre +
                                        ' , ' +
                                        item.subfamilia.nombre +
                                        ' , Modelo: ' +
                                        item.modelotipo.nombre +
                                        ' , Marca : ' +
                                        item.marca.nombre +
                                        ' , Material : ' +
                                        item.material.nombre +
                                        ' ,' +
                                        item.homologacion.nombre
                                      "
                                      :value="item.id"
                                    >
                                    </el-option>
                                  </el-select>
                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-md-1 col-form-label"
                                  >Seleccione el año</label
                                >
                                <div class="col-md-9">
                                  <el-select
                                    v-model="fillListCotizacion.cSelectAnios"
                                    placeholder="Select"
                                  >
                                    <el-option
                                      v-for="item in rangoAnios"
                                      :key="item.value"
                                      :label="item.label"
                                      :value="item.value"
                                    >
                                    </el-option>
                                  </el-select>
                                </div>
                              </div>
                            </div>
                          </template>
                        </div>
                      </div>
                    </form>

                    <div class="card-footer">
                      <div class="row">
                        <div class="col-md-4 offset-4">
                          <button
                            class="btn btn-flat btn-info btnWidth_Excel"
                            @click.prevent="getlistCotizacionListByProd"
                          >
                            Buscar
                          </button>
                          <button
                            class="btn btn-flat btn-default btnWidth_Excel"
                            @click.prevent="limpiarCriteriosBsq"
                          >
                            Limpiar
                          </button>

                          <template
                            v-if="
                              listRolPermisoByUsuario.includes(
                                'CotizacionProducto.Excel'
                              )
                            "
                          >
                            <button
                              class="btn btn-flat btn-success btnWidth_Excel"
                              @click.prevent="getExcelCotizacionProduct"
                            >
                              <span
                                ><i class="fas fa-file-excel"></i> EXCEL</span
                              >
                            </button>
                          </template>
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
                              <th>Nro</th>
                              <th>Fecha</th>
                              <th>Cliente</th>
                              <th>Estado</th>
                              <th>Vendedor</th>
                              <th>Acción</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="(item, index) in listCotizacionPaginated"
                              :key="index"
                            >
                              <td>
                                {{ item.cotizacion.codigo }}
                                <!--  {{ item.id | fourchar }} -
                                {{ item.cotizacion.fecha | moment("YYYY") }} -->
                              </td>
                              <td>
                                {{
                                  item.cotizacion.fecha | moment("DD - MM - Y")
                                }}
                              </td>
                              <td
                                v-text="item.cotizacion.cliente.razonsocial"
                              ></td>
                              <td
                                v-text="item.cotizacion.estadopedido.nombre"
                              ></td>
                              <td v-text="item.cotizacion.user.fullname"></td>
                              <td>  <button
                          @click.prevent="getPdfCotizacion(item.cotizacion.codigo ,item.cotizacion.fecha)"
                          class="btn btn-danger btn-sm"
                        >
                          <span><i class="far fa-file-pdf"></i></span> PDF
                        </button></td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="card-footer">
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
                              v-for="(page, index) in pagesList"
                              :key="index"
                              :class="page == pageNumber ? 'active' : ''"
                            >
                              <a
                                href="#"
                                class="page-link"
                                @click.prevent="selectPage(page)"
                              >
                                {{ page + 1 }}</a
                              >
                            </li>
                            <li
                              class="page-item"
                              v-if="pageNumber < pageCount - 1"
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
                  </el-tab-pane>

                  <!-- BUSCAR POR FECHA -->

                  <el-tab-pane label="Por Fecha - Vendedor" name="second">
                    <form role="form">
                      <div class="col-md-12">
                        <div class="row">
                          <template
                            v-if="
                              listRolPermisoByUsuario.includes(
                                'admin.listado_coti'
                              )
                            "
                          >
                          </template>
                        </div>

                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label"
                                  >Fecha</label
                                >
                                <el-date-picker
                                  v-model="fillListCotizacion.dFecha"
                                  type="daterange"
                                  range-separator="To"
                                  start-placeholder="Start date"
                                  end-placeholder="End date"
                                  value-format="yyyy-MM-dd"
                                  clearable
                                  :style="{ width: '630px', height: '38px' }"
                                >
                                </el-date-picker>
                              </div>
                            </div>
                            <span
                              ><button
                                class="btn btn-flat btn-info"
                                @click.prevent="getlistCotizacionListByDate()"
                              >
                                Buscar
                              </button></span
                            >

                            <div class="col">
                              <template
                                v-if="
                                  listRolPermisoByUsuario.includes(
                                    'cliente.Excel'
                                  )
                                "
                              >
                                <button
                                  class="btn btn-flat btn-success"
                                  @click.prevent="getExcelCotizacionFecha"
                                >
                                  <span
                                    ><i class="fas fa-file-excel"></i>
                                    EXCEL</span
                                  >
                                </button>
                              </template>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-1 col-form-label"
                              >Vendedor</label
                            >
                            <div class="col-md-9">
                              <el-select
                                v-model="fillListCotizacion.nIdVendedor"
                                style="width: 100%"
                                filterable
                                placeholder="Select"
                                clearable
                              >
                                <el-option
                                  v-for="item in listVendedorUser"
                                  :key="item.id"
                                  :label="
                                    item.firstname +
                                    ' ' +
                                    item.secondname +
                                    ' ' +
                                    item.lastname
                                  "
                                  :value="item.id"
                                >
                                </el-option>
                              </el-select>
                            </div>
                            <span
                              ><button
                                class="btn btn-flat btn-info"
                                @click.prevent="getlistCotizacionListByVendedor"
                              >
                                Buscar
                              </button></span
                            >

                            <div class="col">
                              <template
                                v-if="
                                  listRolPermisoByUsuario.includes(
                                    'cliente.Excel'
                                  )
                                "
                              >
                                <button
                                  class="btn btn-flat btn-success"
                                  @click.prevent="getExcelCotizacionVendedor"
                                >
                                  <span
                                    ><i class="fas fa-file-excel"></i>
                                    EXCEL</span
                                  >
                                </button>
                              </template>
                            </div>
                          </div>
                        </div>





                        <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-md-1 col-form-label"
                                  >Cliente</label
                                >
                                <div class="col-md-5">
                                  <el-select
                                    v-model="fillListCotizacion.nIdClient"
                                    style="width: 100%"
                                    filterable
                                    placeholder="Select"
                                    clearable
                                  >
                                  <el-option
                                      v-for="item in this.listClientAdmin"
                                      :key="item.id"
                                      :label="item.razonsocial"
                                      :value="item.id"
                                    >
                                    </el-option>
                                  </el-select>
                                </div>
                                <span
                              ><button
                                class="btn btn-flat btn-info"
                                @click.prevent="getlistCotizacionListByClient"
                              >
                                Buscar
                              </button></span
                            >
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
                          class="
                            table table-hover table-head-fixed
                            text-nowrap
                            projects
                          "
                        >
                          <thead>
                            <tr>
                              <th>Nro</th>
                              <th>Fecha</th>
                              <th>Cliente</th>
                              <th>Estado</th>
                              <th>Vendedor</th>
                              <th>Total</th>
                              <th>Acción</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="(
                                item, index
                              ) in listCotizacionPaginatedbyDate"
                              :key="index"
                            >
                              <td>
                                {{ item.codigo }}
                                <!--  {{ item.id | fourchar }} -
                                {{ item.fecha | moment("YYYY") }} -->
                              </td>
                              <td>
                                {{ item.fecha | moment("DD - MM - Y") }}
                              </td>
                              <td v-text="item.cliente.razonsocial"></td>
                              <td v-text="item.estadopedido.nombre"></td>
                              <td v-text="item.user.fullname"></td>

                              <td>{{ item.detalle_sum | formatPrice }}</td>

                              <td>  <button
                          @click.prevent="getPdfCotizacion(item.codigo ,item.fecha)"
                          class="btn btn-danger btn-sm"
                        >
                          <span><i class="far fa-file-pdf"></i></span> PDF
                        </button></td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="card-footer">
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
                              v-for="(page, index) in pagesListByDate"
                              :key="index"
                              :class="page == pageNumber ? 'active' : ''"
                            >
                              <a
                                href="#"
                                class="page-link"
                                @click.prevent="selectPage(page)"
                              >
                                {{ page + 1 }}</a
                              >
                            </li>
                            <li
                              class="page-item"
                              v-if="pageNumber < pageCountByDate - 1"
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
                  </el-tab-pane>
                </el-tabs>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--  MODAL DE ESTADO DE COTIZACION -->

    <div
      class="modal fade"
      :class="{ show: modalEstado }"
      :style="modalEstado ? mostrarModal : ocultarModal"
    >
      <div
        class="modal-dialog modal-dialog-center"
        role="document"
        style="top: 40% !important"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cambiar Estado de Cotizacion</h5>
            <button class="close" @click="abrirEstado()"></button>
          </div>
          <div class="modal-body">
            <!-- Listado de Detalle de Cotizaciones -->

            <el-select
              v-model="fillListCotizacion.nIdtEstadoCoti"
              filterable
              placeholder="Seleccione un estado"
              :style="{ width: '400px' }"
            >
              <el-option
                v-for="item in listEstadoCoti"
                :key="item.id"
                :label="item.nombre"
                :value="item.id"
              >
              </el-option>
            </el-select>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" @click="abrirEstado">
              Cerrar
            </button>
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
      fillListCotizacion: {
        cNombre: "",
        itemid: "",
        dFecha: "",
        nIdtEstadoCoti: "",
        nIdVendedor: "",
        cSelectAnios: "2022",
        nIdUser: sessionStorage.getItem("iduser"),
        nIdprod: "",
        nIdClient:"",
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
      listCotizacionByDate: [],
      listClientAdmin: [],
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
      perPage: 10,
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
    //this.getListDetCotizacion();

    //this.cargaFechaActual();
    this.getlistVendedorxUsu();
    this.getlistEstadoPedido();
    this.getlistVendedorAdmin();
    this.getListarproductosByName();
    this.getlistClientAdmin();
  },

  computed: {
    pageCount() {
      let a = this.listCotizacion.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },

    pageCountByDate() {
      let a = this.listCotizacionByDate.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },

    listCotizacionPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listCotizacion.slice(inicio, fin);
    },

    listCotizacionPaginatedbyDate() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listCotizacionByDate.slice(inicio, fin);
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
      let a = this.listCotizacionByDate.length,
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


    getPdfCotizacion(item, fecha) {
      var config = { responseType: "blob" };
      var url = "/administracion/cotizacion/CotizacionPdf";
      axios
        .post(
          url,
          {
            params: {
              item: item,
              fecha: fecha,
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

    getlistVendedorAdmin() {
      var url = "/administracion/usuario/getListarVendedores";
      axios.get(url).then((response) => {
        this.listVendedorUser = response.data;
      });
    },

    getlistCotizacionListByProd() {
      var url = "/administracion/cotizacion/listCotizacionList";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillListCotizacion.nIdprod,
            cSelectAnios: this.fillListCotizacion.cSelectAnios,

          },
        })
        .then((response) => {
          this.listCotizacion = response.data;

        });
    },

    getlistCotizacionListByVendedor() {
      var url = "/administracion/cotizacion/listCotizacionListByVendedor";
      axios
        .get(url, {
          params: {
            nIdVendedor: this.fillListCotizacion.nIdVendedor,
          },
        })
        .then((response) => {

          this.listCotizacionByDate = response.data;
        });
    },

    getlistCotizacionListByClient() {
      var url = "/administracion/cotizacion/listCotizacionListByClient";
      axios
        .get(url, {
          params: {
            nIdClient: this.fillListCotizacion.nIdClient,
          },
        })
        .then((response) => {

          this.listCotizacionByDate = response.data;
        });
    },

    getlistCotizacionListByDate() {
      var url = "/administracion/cotizacion/listCotizacionListByDate";
      axios
        .get(url, {
          params: {
            fecha1: this.fillListCotizacion.dFecha[0],
            fecha2: this.fillListCotizacion.dFecha[1],
          },
        })
        .then((response) => {
          this.listCotizacionByDate = response.data;
        });
    },

    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillListCotizacion.nIdprod,
          },
        })
        .then((response) => {
          this.listProd = response.data;
        });
    },

    cargaFechaActual() {
      this.fillListCotizacion.dFecha = new Date();
    },

    abrirModal(item) {
      this.modalShow = !this.modalShow;
      this.getListDetCotizacion(item);
    },

    abrirEstado(item) {
      this.modalEstado = !this.modalEstado;
      this.fillListCotizacion.itemid = item;
      this.BuscaCotizacionList(item);
    },

    limpiarCriteriosBsq() {
      this.fillListCotizacion.cNombre = "";
    },
    limpiarBandejaMaterial() {
      this.listDetPedido = [];
    },
    getListDetCotizacion(item) {
      var url = "/administracion/detallecotizancion/listDetCotizacionBy";
      axios
        .get(url, {
          params: {
            item: item,
          },
        })
        .then((response) => {
          this.listDetPedido = response.data;
        });
    },

    getlistVendedorxUsu() {
      var url = "/administracion/usuario/getListarUsusariosbyId";
      axios
        .get(url, {
          params: {
            nIdUsuario: this.fillListCotizacion.nIdUser,
          },
        })
        .then((response) => {
          this.listVendedorUser = response.data;
          this.fillListCotizacion.nIdVendedor = this.listVendedorUser[0].id;
          this.getlistCliente();
        });
    },

    BuscaCotizacionList(item) {
      var url = " /administracion/cotizacion/ListCotizacionbyId";
      axios
        .get(url, {
          params: {
            item: item,
          },
        })
        .then((response) => {
          //console.log(item);
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
    getExcelCotizacionFecha() {
      var url = "/operacion/cotizacionProduct/getExcelCotizacionFecha";
      axios
        .post(
          url,
          {
            params: {
              listCotizacionByDate: JSON.stringify(this.listCotizacionByDate),
            },
          },
          { responseType: "blob" }
        )
        .then((response) => {
          //console.log(this.listCotizacionByDate)
          FileSaver.saveAs(response.data, "CotizacionFecha.xlsx");
        });
    },

    getExcelCotizacionVendedor() {
      var url = "/operacion/cotizacionProduct/exportVendedor";
      axios
        .post(
          url,
          {
            params: {
              listCotizacionByDate: JSON.stringify(this.listCotizacionByDate),
            },
          },
          { responseType: "blob" }
        )
        .then((response) => {
          FileSaver.saveAs(response.data, "CotizacionVendedor.xlsx");
        });
    },

    getlistClientAdmin() {
      var url = "/administracion/cliente/getListarAllCliente";
      axios.get(url).then((response) => {
        this.listClientAdmin = response.data;
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
