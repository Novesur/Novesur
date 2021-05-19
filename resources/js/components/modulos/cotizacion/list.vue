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
                <el-tabs v-model="activeName" @tab-click="handleClick">
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
                          </template>
                        </div>

                      </div>
                    </form>

                    <div class="card-footer">
                      <div class="row">
                        <div class="col-md-4 offset-4">
                          <button
                            class="btn btn-flat btn-info btnWidth"
                            @click.prevent="getlistCotizacionListByProd"
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
                              <th>Nro</th>
                              <th>Fecha</th>
                              <th>Cliente</th>
                              <th>Estado</th>
                              <th>Vendedor</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="(item, index) in listCotizacion"
                              :key="index"
                            >
                              <td>
                                {{ item.cotizacion.id | fourchar }} -
                                {{ item.cotizacion.fecha | moment("YYYY") }}
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

                              <td></td>
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

                  <el-tab-pane label="Por Fecha" name="second">

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
                            <div class="col-md-6">
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
                                  :style="{ width: '530px', height: '38px' }"
                                >
                                </el-date-picker>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>

                    <div class="card-footer">
                      <div class="row">
                        <div class="col-md-4 offset-4">
                          <button
                            class="btn btn-flat btn-info btnWidth"
                            @click.prevent="getlistCotizacionListByDate"
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
                              <th>Nro</th>
                              <th>Fecha</th>
                              <th>Cliente</th>
                              <th>Estado</th>
                              <th>Vendedor</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="(item, index) in listCotizacionByDate"
                              :key="index"
                            >
                              <td>
                                {{ item.id | fourchar }} -
                                {{ item.fecha | moment("YYYY") }}
                              </td>
                              <td>
                                {{
                                  item.fecha | moment("DD - MM - Y")
                                }}
                              </td>
                               <td
                                v-text="item.cliente.razonsocial"
                              ></td>
                              <td

                                v-text="item.estadopedido.nombre"
                              ></td>
                              <td v-text="item.user.fullname"></td>

                              <td></td>
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

                    </el-tab-pane
                  >
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
export default {
  data() {
    return {
      fillListCotizacion: {
        cNombre: "",

        nIdVendedor: "",
        itemid: "",
        dFecha: "",
        nIdtEstadoCoti: "",

        nIdUser: sessionStorage.getItem("iduser"),
        nIdprod: "",
      },
       activeName: "first",
      listDetPedido: [],
      listVendedorAdmin: [],
      listVendedorUser: [],
      listCotizacion: [],
      listCotizacionByDate: [],
      listCliente: [],
      listEstadoCoti: [],

      listProd: [],
      modalShow: false,
      modalEstado: false,
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
    this.getListDetCotizacion();

    //this.cargaFechaActual();
    this.getlistVendedorxUsu();
    this.getlistEstadoPedido();

    this.getListarproductosByName();
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
    handleClick(tab, event) {
      console.log(tab, event);
    },
    getlistCotizacionListByProd() {
      var url = "/administracion/cotizacion/listCotizacionList";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillListCotizacion.nIdprod,
          },
        })
        .then((response) => {
          this.listCotizacion = response.data;
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
          console.log(this.listCotizacionByDate);
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
          this.getlistEstadoPedido(response.data.estadopedido_id);
        });
    },

    getlistEstadoPedido(item) {
      var url = "/administracion/detallecotizancion/listEstadoCotizacion";
      axios.get(url).then((response) => {
        this.listEstadoCoti = response.data;
        this.fillListCotizacion.nIdtEstadoCoti = this.listEstadoCoti[
          item - 1
        ].id;
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
