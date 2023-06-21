<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            Listado detallado de Productos
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <router-link
                            class="btn btn-info btn-sm"
                            :to="'/material/crear'"
                        >
                            <i class="fas fa-plus-square"></i>Regresar
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Criterios de Busqueda
                                </h3>
                            </div>

                            <div class="card-body">
                                <el-tabs v-model="activeName">
                                    <!-- BUSCAR POR FECHA -->

                                    <form role="form">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div
                                                            class="form-group row"
                                                        >
                                                            <label
                                                                class="col-md-2 col-form-label"
                                                                >Fecha</label
                                                            >
                                                            <el-date-picker
                                                                v-model="
                                                                    fillListCotizacion.dFecha
                                                                "
                                                                type="daterange"
                                                                range-separator="To"
                                                                start-placeholder="Start date"
                                                                end-placeholder="End date"
                                                                value-format="yyyy-MM-dd"
                                                                clearable
                                                                :style="{
                                                                    width: '630px',
                                                                    height: '38px',
                                                                }"
                                                            >
                                                            </el-date-picker>
                                                        </div>
                                                    </div>
                                                    <span
                                                        ><button
                                                            class="btn btn-flat btn-info"
                                                            @click.prevent="
                                                                getlistCotizacionListByDate
                                                            "
                                                        >
                                                            Buscar
                                                        </button></span
                                                    >

                                                    <div class="col">
                                                        <template
                                                            v-if="
                                                                listRolPermisoByUsuario.includes(
                                                                    'detalleproductos.Excel'
                                                                )
                                                            "
                                                        >
                                                            <button
                                                                class="btn btn-flat btn-success"
                                                                @click.prevent="
                                                                    getExcelCotizacionFecha
                                                                "
                                                            >
                                                                <span
                                                                    ><i
                                                                        class="fas fa-file-excel"
                                                                    ></i>
                                                                    EXCEL</span
                                                                >
                                                            </button>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-1 col-form-label"
                                                        >Vendedor</label
                                                    >
                                                    <div class="col-md-9">
                                                        <template
                                                            v-if="
                                                                listRolPermisoByUsuario.includes(
                                                                    'admin.listado_coti'
                                                                )
                                                            "
                                                        >
                                                            <el-select
                                                                v-model="
                                                                    fillListCotizacion.nIdVendedor
                                                                "
                                                                style="
                                                                    width: 100%;
                                                                "
                                                                filterable
                                                                placeholder="Select"
                                                                clearable
                                                            >
                                                                <el-option
                                                                    v-for="item in listVendedorAdmin"
                                                                    :key="
                                                                        item.id
                                                                    "
                                                                    :label="
                                                                        item.firstname +
                                                                        ' ' +
                                                                        item.secondname +
                                                                        ' ' +
                                                                        item.lastname
                                                                    "
                                                                    :value="
                                                                        item.id
                                                                    "
                                                                >
                                                                </el-option>
                                                            </el-select>
                                                        </template>
                                                        <template v-else>
                                                          <el-select
                                                                v-model="
                                                                    fillListCotizacion.nIdVendedor
                                                                "
                                                                style="
                                                                    width: 100%;
                                                                "
                                                                filterable
                                                                placeholder="Select"
                                                                clearable
                                                            >
                                                                <el-option
                                                                    v-for="item in listVendedorUser"
                                                                    :key="
                                                                        item.id
                                                                    "
                                                                    :label="
                                                                        item.firstname +
                                                                        ' ' +
                                                                        item.secondname +
                                                                        ' ' +
                                                                        item.lastname
                                                                    "
                                                                    :value="
                                                                        item.id
                                                                    "
                                                                >
                                                                </el-option>
                                                            </el-select>
                                                        </template>
                                                    </div>

                                                    <!--    <span
                                ><button
                                  class="btn btn-flat btn-info"
                                  @click.prevent="getlistProdListByVendedor"
                                >
                                  Buscar2
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
                              </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Bandeja de Resultados
                                            </h3>
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
                                                        <th>Cod Product</th>
                                                        <th>Producto</th>
                                                        <th>Cantidad</th>
                                                        <th>P.U</th>
                                                        <th>Total</th>
                                                        <th>Vendedor</th>
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
                                                            {{
                                                                item.fecha
                                                                    | moment(
                                                                        "DD - MM - Y"
                                                                    )
                                                            }}
                                                        </td>
                                                        <td
                                                            v-text="
                                                                item.razonsocial
                                                            "
                                                        ></td>
                                                        <td
                                                            v-text="
                                                                item.codprod
                                                            "
                                                        ></td>
                                                        <td
                                                            v-text="
                                                                item.familia +
                                                                ',' +
                                                                item.subfamilia +
                                                                ', MODELO :' +
                                                                item.modelotipo +
                                                                ', MATERIAL :' +
                                                                item.material +
                                                                ', MARCA :' +
                                                                item.marca
                                                            "
                                                        ></td>
                                                        <td
                                                            v-text="
                                                                item.cantidad
                                                            "
                                                        ></td>
                                                        <td
                                                            v-text="item.punit"
                                                        ></td>
                                                        <td
                                                            v-text="
                                                                item.cantidad *
                                                                item.punit
                                                            "
                                                        ></td>
                                                        <td
                                                            v-text="
                                                                item.usuario
                                                            "
                                                        ></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="card-footer">
                                                <ul
                                                    class="pagination pagination-sm m-0 float-right"
                                                >
                                                    <li
                                                        class="page-item"
                                                        v-if="pageNumber > 0"
                                                    >
                                                        <a
                                                            href="#"
                                                            class="page-link"
                                                            @click.prevent="
                                                                prevPage
                                                            "
                                                            >Ant</a
                                                        >
                                                    </li>
                                                    <li
                                                        class="page-item"
                                                        v-for="(
                                                            page, index
                                                        ) in pagesListByDate"
                                                        :key="index"
                                                        :class="
                                                            page == pageNumber
                                                                ? 'active'
                                                                : ''
                                                        "
                                                    >
                                                        <a
                                                            href="#"
                                                            class="page-link"
                                                            @click.prevent="
                                                                selectPage(page)
                                                            "
                                                        >
                                                            {{ page + 1 }}</a
                                                        >
                                                    </li>
                                                    <li
                                                        class="page-item"
                                                        v-if="
                                                            pageNumber <
                                                            pageCountByDate - 1
                                                        "
                                                    >
                                                        <a
                                                            href="#"
                                                            class="page-link"
                                                            @click.prevent="
                                                                nextPage
                                                            "
                                                            >Post</a
                                                        >
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </el-tabs>
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
            fillListCotizacion: {
                cNombre: "",
                itemid: "",
                dFecha: "",
                nIdtEstadoCoti: "",
                nIdVendedor: "",
                cSelectAnios: "2022",
                nIdUser: sessionStorage.getItem("iduser"),
                nIdprod: "",
             
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
            listDetProductByDate: [],
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
            let a = this.listDetProductByDate.length,
                b = this.perPage;
            return Math.ceil(a / b);
        },

        /*       listCotizacionPaginated() {
        let inicio = this.pageNumber * this.perPage,
          fin = inicio + this.perPage;
        return this.listCotizacion.slice(inicio, fin);
      }, */

        listCotizacionPaginatedbyDate() {
            let inicio = this.pageNumber * this.perPage,
                fin = inicio + this.perPage;
            return this.listDetProductByDate.slice(inicio, fin);
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
            let a = this.listDetProductByDate.length,
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
        getlistVendedorAdmin() {
            var url = "/administracion/usuario/getListarUsusarios";
            axios.get(url).then((response) => {
                this.listVendedorAdmin = response.data;
            });
        },

        getlistVendedorxUsu() {
      var url = "/administracion/usuario/getListarUsusariosbyId";
      axios
        .get(url, {
          params: {
            nIdUsuario: this.fillBsqCotizacion.nIdUser,
          },
        })
        .then((response) => {
          this.listVendedorUser = response.data;
          this.fillListCotizacion.nIdVendedor = this.listVendedorUser[0].id;
          this.getlistCliente();
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

        /*       getlistProdListByVendedor() {
        var url = "/administracion/cotizacion/listDetalleProductosListByVendedor";
        axios
          .get(url, {
            params: {
              nIdVendedor: this.fillListCotizacion.nIdVendedor,
            },
          })
          .then((response) => {
   console.log(response.data)
            this.listDetProductByDate = response.data;
          });
      }, */

        getlistCotizacionListByDate() {
            var url = "/administracion/cotizacion/listDetalleProductosbyDate";
            axios
                .get(url, {
                    params: {
                        nIdVendedor: this.fillListCotizacion.nIdVendedor,
                        fecha1: this.fillListCotizacion.dFecha[0],
                        fecha2: this.fillListCotizacion.dFecha[1],
                    },
                })
                .then((response) => {
                    console.log(response.data);
                    this.listDetProductByDate = response.data;
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

        limpiarCriteriosBsq() {
            this.fillListCotizacion.cNombre = "";
        },
        limpiarBandejaMaterial() {
            this.listDetPedido = [];
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
                    this.fillListCotizacion.nIdVendedor =
                        this.listVendedorUser[0].id;
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
                        params: {
                            listCotizacion: JSON.stringify(this.listCotizacion),
                        },
                    },
                    { responseType: "blob" }
                )
                .then((response) => {
                    FileSaver.saveAs(response.data, "CotizacionProduct.xlsx");
                });
        },
        getExcelCotizacionFecha() {
            var url = "/operacion/cotizacionProduct/getExcelListProductFecha";
            axios
                .post(
                    url,
                    {
                        params: {
                            listDetProductByDate: JSON.stringify(
                                this.listDetProductByDate
                            ),
                        },
                    },
                    { responseType: "blob" }
                )
                .then((response) => {
                    FileSaver.saveAs(response.data, "CotizacionFecha.xlsx");
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
