<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Reporte Asistencia</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content container-fluid">
            <div class="card">
<!--                 <div class="card-header">
                    <div class="card-tools">
                        <template
                            v-if="
                                listRolPermisoByUsuario.includes(
                                    'personal.crear'
                                )
                            "
                        >
                        <button
                class="btn btn-success btn-sm"
                @click.prevent="getExcelCliente"
              >
                <span><i class="fas fa-file-excel"></i> EXCEL</span>
              </button>
                        </template>
                    </div>
                </div>
 -->

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
                                    <!-- Buscar por Personal -->
                                    <el-tab-pane
                                        label="Por Personal"
                                        name="first"
                                    >
                                        <form role="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-md-3 col-form-label"
                                                            >Personal</label
                                                        >
                                                        <div class="col-md-9">
                                                            <el-select
                                                                v-model="
                                                                    fillBsqReportePersonal.cPersonal
                                                                "
                                                                placeholder="Seleccione un Personal"
                                                                clearable
                                                                :style="{
                                                                    width: '70%',
                                                                }"
                                                            >
                                                                <el-option
                                                                    v-for="item in listPersonal"
                                                                    :key="
                                                                        item.id
                                                                    "
                                                                    :label="
                                                                        item.ApPaterno +
                                                                        ' ' +
                                                                        item.ApMaterno +
                                                                        ' ' +
                                                                        item.nombres
                                                                    "
                                                                    :value="
                                                                        item.id
                                                                    "
                                                                >
                                                                </el-option>
                                                            </el-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-md-3 col-form-label"
                                                            >Seleccione el
                                                            Rango</label
                                                        >
                                                        <div class="col-md-6">
                                                            <el-date-picker
                                                                v-model="
                                                                    fillBsqReportePersonal.dFecha
                                                                "
                                                                type="daterange"
                                                                range-separator="To"
                                                                start-placeholder="Start date"
                                                                end-placeholder="End date"
                                                                value-format="yyyy-MM-dd"
                                                                clearable
                                                                :style="{
                                                                    width: '530px',
                                                                    height: '38px',
                                                                }"
                                                            >
                                                            </el-date-picker>
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
                                            @click.prevent="
                                                getListReporteAsistencia
                                            "
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
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Personal</th>
                                            <th>DNI</th>
                                            <th>Zona</th>
                                            <th>Cargo</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                item, index
                                            ) in listAsistencia"
                                            :key="index"
                                        >
                                            <td v-text="item.fecha"></td>
                                            <td v-text="item.tiempo"></td>
                                            <td v-text="item.personal"></td>
                                            <td v-text="item.DNI"></td>
                                            <td v-text="item.zonal"></td>
                                            <td v-text="item.cargo"></td>
                                            <td v-text="item.estado"></td>
                                            <!--     <td v-if="item.estado === 'A'">
                                                Activo
                                            </td>
                                            <td v-else style="color: red">
                                                Inactivo
                                            </td>  -->

                                            <!--           <td>
                                                <router-link
                                                    class="btn btn-info btn-sm"
                                                    :to="{
                                                        name: 'personal.edit',
                                                        params: { id: item.id },
                                                    }"
                                                >
                                                    <i
                                                        class="fas fa-pencil-alt"
                                                    ></i
                                                    >Editar
                                                </router-link>

                                                <button
                                                    class="btn btn-danger btn-sm"
                                                    @click.prevent="
                                                        setConfirmaDeletePersonal(
                                                            item.id
                                                        )
                                                    "
                                                >
                                                    <i class="fas fa-trash"></i
                                                    >Dar de Baja
                                                </button>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="card-footer clearfix">
                                    <ul
                                        class="pagination pagination-sm m-0 float-right"
                                    >
                                        <li
                                            class="page-item"
                                            v-if="pageNumber > 0"
                                        >
                                            <a
                                                href=""
                                                class="page-link"
                                                @click.prevent="prevPage"
                                                >Ant</a
                                            >
                                        </li>
                                        <li
                                            class="page-item"
                                            v-for="(page, index) in pagesList"
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
                                                    SelectPage(page)
                                                "
                                                >{{ page + 1 }}</a
                                            >
                                        </li>
                                        <li
                                            class="page-item"
                                            v-if="pageNumber < pageCount - 1"
                                        >
                                            <a
                                                href=""
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
                                    <el-tab-pane
                                        label="Por Fecha - Vendedor"
                                        name="second"
                                    >
                                        <form role="">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-md-3 col-form-label"
                                                            >Seleccione la
                                                            Fecha</label
                                                        >
                                                        <div class="col-md-6">

                                                            <el-date-picker
                                                                v-model="
                                                                    fillBsqReportePersonal.dFecha2
                                                                "
                                                                type="daterange"
                                                                range-separator="To"
                                                                start-placeholder="Start date"
                                                                end-placeholder="End date"
                                                                value-format="yyyy-MM-dd"
                                                                clearable
                                                                :style="{
                                                                    width: '530px',
                                                                    height: '38px',
                                                                }"
                                                            >
                                                            </el-date-picker>
                                                      <!--       <el-date-picker
                                                                v-model="
                                                                    fillBsqReportePersonal.dFecha2
                                                                "
                                                                type="date"
                                                                placeholder="Ingrese una Fecha"
                                                                format="dd/MM/yyyy"
                                                                value-format="yyyy-MM-dd"

                                                            >
                                                            </el-date-picker> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </form>
                                        <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button
                                            class="btn btn-flat btn-info btnWidth3buttons"
                                            @click.prevent="
                                                getListReporteAsistenciaByDate
                                            "
                                        >
                                            Buscar
                                        </button>
                                        <button
                                            class="btn btn-flat btn-default btnWidth3buttons"
                                            @click.prevent="limpiarCriteriosBsq"
                                        >
                                            Limpiar
                                        </button>

                                        <button
                                            class="btn btn-flat btn-success btnWidth3buttons"
                                            @click.prevent="reporteByDateAsistExcel"
                                        >
                                        <span><i class="fas fa-file-excel"></i> EXCEL</span>
                                      </button>



                                    </div>
                                </div>
                            </div>

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
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Personal</th>
                                            <th>DNI</th>
                                            <th>Zona</th>
                                            <th>Cargo</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                item, index
                                            ) in listAsistenciaByDay"
                                            :key="index"
                                        >
                                            <td v-text="item.fecha"></td>
                                            <td v-text="item.tiempo"></td>
                                            <td v-text="item.personal"></td>
                                            <td v-text="item.DNI"></td>
                                            <td v-text="item.zonal"></td>
                                            <td v-text="item.cargo"></td>
                                            <td v-text="item.estado"></td>
                                            <!--     <td v-if="item.estado === 'A'">
                                                Activo
                                            </td>
                                            <td v-else style="color: red">
                                                Inactivo
                                            </td>  -->

                                            <!--           <td>
                                                <router-link
                                                    class="btn btn-info btn-sm"
                                                    :to="{
                                                        name: 'personal.edit',
                                                        params: { id: item.id },
                                                    }"
                                                >
                                                    <i
                                                        class="fas fa-pencil-alt"
                                                    ></i
                                                    >Editar
                                                </router-link>

                                                <button
                                                    class="btn btn-danger btn-sm"
                                                    @click.prevent="
                                                        setConfirmaDeletePersonal(
                                                            item.id
                                                        )
                                                    "
                                                >
                                                    <i class="fas fa-trash"></i
                                                    >Dar de Baja
                                                </button>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="card-footer clearfix">
                                    <ul
                                        class="pagination pagination-sm m-0 float-right"
                                    >
                                        <li
                                            class="page-item"
                                            v-if="pageNumber > 0"
                                        >
                                            <a
                                                href=""
                                                class="page-link"
                                                @click.prevent="prevPage"
                                                >Ant</a
                                            >
                                        </li>
                                        <li
                                            class="page-item"
                                            v-for="(page, index) in pagesList"
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
                                                    SelectPage(page)
                                                "
                                                >{{ page + 1 }}</a
                                            >
                                        </li>
                                        <li
                                            class="page-item"
                                            v-if="pageNumber < pageCount - 1"
                                        >
                                            <a
                                                href=""
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
                                      <el-tab-pane
                                        label="Reporte Detallado"
                                        name="tercer"
                                    >
                                        <form role="">

                          <!--                   <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-md-3 col-form-label"
                                                            >Seleccione la Fecha</label
                                                        >
                                                        <div class="col-md-6">

                                                            <el-date-picker
                                                                v-model="
                                                                    fillBsqReportePersonal.dFechaDetalle
                                                                "
                                                                type="daterange"
                                                                range-separator="To"
                                                                start-placeholder="Start date"
                                                                end-placeholder="End date"
                                                                value-format="yyyy-MM-dd"
                                                                clearable
                                                                :style="{
                                                                    width: '530px',
                                                                    height: '38px',
                                                                }"
                                                            >
                                                            </el-date-picker>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->


                                        </form>
                                        <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-9 offset-3">
                               <!--          <button
                                            class="btn btn-flat btn-info btnWidth3buttons"
                                            @click.prevent="
                                                getListReporteAsistenciaByDate
                                            "
                                        >
                                            Buscar
                                        </button>
                                        <button
                                            class="btn btn-flat btn-default btnWidth3buttons"
                                            @click.prevent="limpiarCriteriosBsq"
                                        >
                                            Limpiar
                                        </button> -->

                                        <button
                                            class="btn btn-flat btn-success btnWidth3buttons"
                                            @click.prevent="getListReporteAsistenciaByDate0113"
                                        >
                                        <span><i class="fas fa-file-excel"></i> De 01 al 13</span>
                                      </button>

                                        <button
                                            class="btn btn-flat btn-success btnWidth3buttons"
                                            @click.prevent="reporteByDateAsistExcel1431"
                                        >
                                        <span><i class="fas fa-file-excel"></i> De 14 al 31</span>
                                      </button>

                                      <button
                                            class="btn btn-flat btn-success btnWidth3buttons"
                                            @click.prevent="reporteByTardanza"
                                        >
                                        <span><i class="fas fa-file-excel"></i> Control por tardanzas</span>
                                      </button>



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
    </div>
</template>

<script>
import FileSaver from "file-saver";
export default {
    data() {
        return {
            fillBsqReportePersonal: {
                dFecha: "",
                dFecha2: "",
                cPersonal: "",
                dFechaDetalle:""
            },
            activeName: "first",
            listPersonal: [],
            listAsistencia: [],
            listAsistenciaByDay0113: [],

            listRolPermisoByUsuario: JSON.parse(
                sessionStorage.getItem("listRolPermisosByUsuario")
            ),
            pageNumber: 0,
            perPage: 10,


        };
    },
    mounted() {
        this.getListarPersonal();
        this.fillBsqReportePersonal.dFecha2 = new Date();
    },
    computed: {
        pageCount() {
            let a = this.listAsistencia.length,
                b = this.perPage;
            return Math.ceil(a / b);
        },
        listarPersonalPaginated() {
            let inicio = this.pageNumber * this.perPage,
                fin = inicio + this.perPage;
            return this.listAsistencia.slice(inicio, fin);
        },
        pagesList() {
            let a = this.listAsistencia.length,
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
            this.fillBsqReportePersonal.cFirstname = "";
            this.fillBsqReportePersonal.cZonal = "";
        },
        limpiarBandejaUsuario() {
            this.listPersonal = [];
        },
        getListarZonal() {
            var url = "/administracion/zonal/list";
            axios.get(url).then((response) => {
                this.dFecha = response.data;
            });
        },

        getListarPersonal() {
            var url = "/administracion/personal/personalAsistencia";
            axios.get(url).then((response) => {
                this.listPersonal = response.data;
            });
        },

        getListReporteAsistencia() {
            var url = "/administracion/asistencia/listByDatePersonal";
            axios
                .get(url, {
                    params: {
                        dFechainicio: !this.fillBsqReportePersonal.dFecha
                            ? ""
                            : this.fillBsqReportePersonal.dFecha[0],
                        dFechafin: !this.fillBsqReportePersonal.dFecha
                            ? ""
                            : this.fillBsqReportePersonal.dFecha[1],
                        personal: this.fillBsqReportePersonal.cPersonal,
                    },
                })
                .then((response) => {
                    this.listAsistencia = response.data;

                    /*
        this.fillBsqCotizacion.nIdCliente = this.listDetPedido[0].id; */
                });
        },

        getListReporteAsistenciaByDate0113() {
            var url = "/administracion/asistencia/listAsistByDate0113";
            axios
                .get(url)
                .then((response) => {
                    this.listAsistenciaByDay0113= response.data
                    this.reporteByDateAsistExcel0113();
                });
        },

        reporteByDateAsistExcel0113(){
            var url = "/operacion/asistencia/reporteByDateAsistExcel0113";
      axios
        .post(
          url,
          {
            params: { listAsistenciaByDay0113: JSON.stringify(this.listAsistenciaByDay0113) },
          },
          { responseType: "blob" }
        )
        .then((response) => {
          FileSaver.saveAs(response.data, "AsistByDate0113.xlsx");
        });

        },
        nextPage() {
            this.pageNumber++;
        },
        prevPage() {
            this.pageNumber--;
        },
        SelectPage(page) {
            this.pageNumber = page;
        },
        inicializarPaginacion() {
            this.pageNumber = 0;
        },
        setConfirmaDeletePersonal(id) {
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
                        var url = "/administracion/personal/delete";
                        axios
                            .post(url, {
                                nIdPersonal: id,
                            })
                            .then((response) => {
                                this.getListarPersonal();
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

<style></style>
