<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Consulta Requerimiento Materiales - Proyecto
                    </h1>
                </div>
            </div>
        </div>

        <div class="content container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <template
                            v-if="
                                listRolPermisoByUsuario.includes(
                                    'create.clientes'
                                )
                            "
                        >
                            <router-link
                                class="btn btn-info btn-sm"
                                :to="'/proyecto_ReqMateriales/create'"
                            >
                                <i class="fas fa-plus-square"></i>
                                Requerimientos de Materiales
                            </router-link>
                        </template>

                        <template
                            v-if="
                                listRolPermisoByUsuario.includes(
                                    'cliente.Excel'
                                )
                            "
                        >
                            <button
                                class="btn btn-success btn-sm"
                                @click.prevent="getExcelPReqMat"
                            >
                                <span
                                    ><i class="fas fa-file-excel"></i>
                                    EXCEL</span
                                >
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
                                                <label
                                                    class="col-md-2 col-form-label"
                                                    >Fecha</label
                                                >
                                                <div class="col-md-6">
                                                    <el-date-picker
                                                        v-model="
                                                            fillBPReqMateriales.cFecha
                                                        "
                                                        type="date"
                                                        placeholder="Indique la fecha"
                                                        format="dd/MM/yyyy"
                                                        value-format="yyyy-MM-dd"
                                                    >
                                                    </el-date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-2 col-form-label"
                                                    >Nro: O/S</label
                                                >
                                                <div class="col-md-7">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-model="
                                                            fillBPReqMateriales.cServicio
                                                        "
                                                        :maxlength="11"
                                                        @keyup.enter="
                                                            getListarPReqMateriales
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <template
                                            v-if="
                                                listRolPermisoByUsuario.includes(
                                                    'consulta.ventas'
                                                )
                                            "
                                        >
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >Proyecto</label
                                                    >
                                                    <div class="col-md-6">
                                                        <el-select
                                                            v-model="
                                                                fillBPReqMateriales.nIdProyecto
                                                            "
                                                            style="width: 100%"
                                                            filterable
                                                            placeholder="Select"
                                                            clearable
                                                        >
                                                            <el-option
                                                                v-for="item in listCCostos"
                                                                :key="item.id"
                                                                :label="
                                                                    item.codigo +
                                                                    ' - ' +
                                                                    item.nombre
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
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button
                                            class="btn btn-flat btn-info btnWidth"
                                            @click.prevent="
                                                getListarPReqMateriales
                                            "
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
                                            <th>Codigo</th>
                                            <th>Nombre Proyecto</th>
                                            <th>Cliente</th>
                                            <th>Detalle Servicio</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Final</th>
                                            <th>O/S Nro</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                item, index
                                            ) in listarClientesPaginated"
                                            :key="index"
                                        >
                                            <!--       <td>
                          <template
                            v-if="
                              listRolPermisoByUsuario.includes(
                                'cotizacion.create'
                              )
                            "
                          >
                            <router-link
                              class="btn btn-success btn-sm"
                              :to="{
                                name: 'cotizacion.create',
                                params: { id: item.id },
                              }"
                            >
                              <i class="far fa-clipboard"></i> Cotizar
                            </router-link>
                          </template>
                        </td>
  
                        <template
                          v-if="
                            listRolPermisoByUsuario.includes('cliente.editar')
                          "
                        >
                          <td>
                            <router-link
                              class="btn btn-info btn-sm"
                              :to="{
                                name: 'cliente.editar',
                                params: { id: item.id },
                              }"
                            >
                              <i class="fas fa-pencil-alt"></i>Editar
                            </router-link>
                          </td> 
                        </template> -->

                                            <td v-text="item.fecha"></td>
                                            <td v-text="item.codigo"></td>
                                            <td
                                                v-text="item.ccostos.nombre"
                                            ></td>
                                            <td v-text="item.cliente"></td>
                                            <td v-text="item.detservicio"></td>
                                            <td v-text="item.fechainicio"></td>
                                            <td v-text="item.fechafinal"></td>
                                            <td v-text="item.ord_servicio"></td>
                                            <td>
                                                <button
                                                    class="btn btn-danger btn-sm"
                                                    @click.prevent="
                                                        SetGenerarPreqMaterialesPDF(
                                                            item.id
                                                        )
                                                    "
                                                >
                                                    <i
                                                        class="fas fa-file-pdf"
                                                    ></i>
                                                    PDF
                                                </button>
              
                                                <button   v-if="listRolPermisoByUsuario.includes('proyMateriales.add')"
                                                    class="btn btn-success btn-sm"
                                                    @click.prevent="
                                                        abrirModalReqMaterialesProy(
                                                            item.id
                                                        )
                                                    "
                                                >
                                                    <i class="fas fa-tools"></i>
                                                    Agregar Materiales
                                                </button>


                                            </td>
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
                                            :class="[
                                                page == pageNumber
                                                    ? 'active'
                                                    : '',
                                            ]"
                                        >
                                            <a
                                                href=""
                                                class="page-link"
                                                @click.prevent="
                                                    selectPage(page)
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
                    </div>
                </div>
            </div>
        </div>

        <!--    MODAL DE REQUERIMIENTOS DE MATERIALES -->

        <div
            class="modal fade"
            :class="{ show: modalShowEditProyMat }"
            :style="modalShowEditProyMat ? mostrarModal : ocultarModal"
        >
            <div class="modal-editcotitem modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Requerimiento de Materiales</h5>
                        <button
                            class="close"
                            @click="abrirModalReqMaterialesProy"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="content container-fluid">
                            <form role="form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div
                                                class="card-body table-responsive"
                                            >
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-md-2 col-form-label"
                                                            >DESCRIPCION DEL
                                                            MATERIAL</label
                                                        >

                                                        <div class="col-md-10">
                                                            <el-select
                                                                v-model="
                                                                    fillBPReqMateriales.nIdmaterial
                                                                "
                                                                style="
                                                                    width: 90%;
                                                                "
                                                                filterable
                                                                placeholder="Select"
                                                            >
                                                                <v-row
                                                                    align="right"
                                                                >
                                                                    <el-option
                                                                        v-for="item in listProd"
                                                                        :key="
                                                                            item.id
                                                                        "
                                                                        :label="
                                                                            item.codigo +
                                                                            ' - ' +
                                                                            item
                                                                                .familia
                                                                                .nombre +
                                                                            ' , ' +
                                                                            item
                                                                                .subfamilia
                                                                                .nombre +
                                                                            ' , Modelo: ' +
                                                                            item
                                                                                .modelotipo
                                                                                .nombre +
                                                                            ' , Marca : ' +
                                                                            item
                                                                                .marca
                                                                                .nombre +
                                                                            ' , Material : ' +
                                                                            item
                                                                                .material
                                                                                .nombre +
                                                                            ' ,' +
                                                                            item
                                                                                .homologacion
                                                                                .nombre
                                                                        "
                                                                        :value="
                                                                            item.id
                                                                        "
                                                                    >
                                                                    </el-option>
                                                                </v-row>
                                                            </el-select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-md-2 col-form-label"
                                                            >CANTIDAD</label
                                                        >
                                                        <div class="col-md-3">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                v-model="
                                                                    fillBPReqMateriales.cCantMaterial
                                                                "
                                                                vint
                                                            />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div
                                                            class="form-group row"
                                                        >
                                                            <label
                                                                class="col-md-4 col-form-label"
                                                                >MEDIDA</label
                                                            >
                                                            <div
                                                                class="col-md-4"
                                                            >
                                                                <el-select
                                                                    v-model="
                                                                        fillBPReqMateriales.nIdUnidMedMat
                                                                    "
                                                                    placeholder="Select"
                                                                    style="
                                                                        width: 70%;
                                                                    "
                                                                >
                                                                    <el-option
                                                                        v-for="item in listUnidMed"
                                                                        :key="
                                                                            item.id
                                                                        "
                                                                        :label="
                                                                            item.nombre
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button
                                class="btn btn-success"
                                @click="setSaveMatReqMatProy"
                            >
                                Guardar
                            </button>
                            <button
                                class="btn btn-secondary"
                                @click="abrirModalReqMaterialesProy"
                            >
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  FIN DEL MODAL DE REQUERIMIENTOS DE MATERIALES -->
    </div>
</template>

<script>
import FileSaver from "file-saver";
export default {
    data() {
        return {
            fillBPReqMateriales: {
                cServicio: "",
                cFecha: "",
                nIdProyecto: "",
                nIdmaterial: "",
                nIdUnidMedMat: "",
                cCantMaterial:"",
            },
            listProd: [],
            listUnidMed: [],

            modalShowEditProyMat: false,
            mostrarModal: {
                display: "block",
                background: "#0000006b",
            },

            ocultarModal: {
                display: "none",
            },

            listPReqMateriales: [],
            listCCostos: [],
            listRolPermisoByUsuario: JSON.parse(
                sessionStorage.getItem("listRolPermisosByUsuario")
            ),
            pageNumber: 0,
            perPage: 50,
            listRolPermisoByUsuario: JSON.parse(
                sessionStorage.getItem("listRolPermisosByUsuario")
            ),
        };
    },
    mounted() {
        this.getlistCcostos();
        this.getListarproductosByName();
        this.getListarUnidadMedida();
    },

    computed: {
        pageCount() {
            let a = this.listPReqMateriales.length,
                b = this.perPage;
            return Math.ceil(a / b);
        },
        listarClientesPaginated() {
            let inicio = this.pageNumber * this.perPage,
                fin = inicio + this.perPage;
            return this.listPReqMateriales.slice(inicio, fin);
        },
        pagesList() {
            let a = this.listPReqMateriales.length,
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
        getlistCcostos() {
            var url = "/administracion/CentroCostos/list";
            axios.get(url).then((response) => {
                this.listCCostos = response.data;
            });
        },
        limpiarProveedorBsq() {
            this.fillBPReqMateriales.cNombre = "";
            this.fillBPReqMateriales.cRuc = "";
        },
        limpiarBandejaProveedor() {
            this.listPReqMateriales = [];
        },
        getListarPReqMateriales() {
            var url = "/administracion/proyecto_ReqMateriales/list";
            axios
                .get(url, {
                    params: {
                        cServicio: this.fillBPReqMateriales.cServicio,
                        cFecha: this.fillBPReqMateriales.cFecha,
                        nIdProyecto: this.fillBPReqMateriales.nIdProyecto,
                    },
                })
                .then((response) => {
                    //this.inicializarPAginacion();
                    this.listPReqMateriales = response.data;
                });
        },

        getExcelPReqMat() {
            var url = "/operacion/proyecto_ReqMateriales/export";
            axios
                .post(
                    url,
                    {
                        params: {
                            listPReqMateriales: JSON.stringify(
                                this.listPReqMateriales
                            ),
                        },
                    },
                    { responseType: "blob" }
                )
                .then((response) => {
                    FileSaver.saveAs(response.data, "PReqMateriales.xlsx");
                });
        },

        SetGenerarPreqMaterialesPDF(id) {
            var config = { responseType: "blob" };
            var url =
                "/administracion/proyecto_ReqMateriales/setGenerarPReqMaterialesPdf";
            axios
                .post(
                    url,
                    {
                        params: {
                            id,
                        },
                    },
                    config
                )
                .then((response) => {
                    var oMyBlob = new Blob([response.data], {
                        type: "application/pdf",
                    });
                    var url = URL.createObjectURL(oMyBlob);
                    window.open(url);
                });
        },

        abrirModalReqMaterialesProy(idproy) {
            this.modalShowEditProyMat = !this.modalShowEditProyMat;
            localStorage.idproy = idproy;
            //this.setMostrarInfoMatProy(idproy);
        },

        getListarproductosByName() {
            var url = "/administracion/detallecotizancion/listProdByName";
            axios.get(url).then((response) => {
                this.listProd = response.data;
            });
        },

        getListarUnidadMedida() {
            var url = "/administracion/KardexDetalle/listUnidMed";
            axios.get(url).then((response) => {
                this.listUnidMed = response.data;
                this.fillBPInfValor.nIdUnidMedAlquiler = this.listUnidMed[7].id;
            });
        },

  /*       setMostrarInfoMatProy(item) {
            var url =
                "/administracion/proyecto_ReqMateriales/mostrarInfoReqMateriales";
            axios
                .get(url, {
                    params: {
                        item,
                    },
                })
                .then((response) => {
                    console.log(response.data);
                    // this.listProyValMateriales = response.data;
                });
        }, */

        setSaveMatReqMatProy() {
           

            var url = "/administracion/ProyectoMateriales/SaveMatReqMatProy";
            axios
                .post(url, {
                  idproy: localStorage.idproy,
                  nIdmaterial: this.fillBPReqMateriales.nIdmaterial,
                  nIdUnidMedMat: this.fillBPReqMateriales.nIdUnidMedMat,
                  cCantMaterial: this.fillBPReqMateriales.cCantMaterial,   
                })
                .then((response) => {
                  this.fillBPReqMateriales.nIdmaterial = '',
                  this.fillBPReqMateriales.nIdUnidMedMat='',
                  this.fillBPReqMateriales.cCantMaterial='',
                  localStorage.removeItem(localStorage.idproy);
                  this.abrirModalReqMaterialesProy(localStorage.idproy);

              
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

<style></style>
