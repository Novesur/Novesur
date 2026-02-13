<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Informe de Producción  N° {{ fillEditInfoProduccion.codigoInfoProd }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content container-fluid">
            <div class="card">
                 <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/informeProduccion/list'">
              <i class="fas fa-plus-square"></i> Regresar
            </router-link>
          </div>
        </div>
                <div class="card-body">

                    <div class="container-fluid">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Formulario Informe de Producción</h3>
                            </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-md-1 col-form-label">Producto</label>
                                                    <div class="col-md-10">
                                                        <el-select v-model="fillEditInfoProduccion.nIdproduct"
                                                            style="width: 70vw" filterable disabled
                                                            placeholder="Select">
                                                            <v-row align="right">
                                                                <el-option v-for="item in listProd" :key="item.id"
                                                                    :label="item.codigo +
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
                                                                        " :value="item.id">
                                                                </el-option>
                                                            </v-row>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Cantidad</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control"
                                                            v-model="fillEditInfoProduccion.cCantprod" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-md-2 col-form-label">Unid. Medida</label>
                                                    <div class="col-md-6">
                                                        <el-select v-model="fillEditInfoProduccion.nIdUnidMed"
                                                            placeholder="Select"  style="width: 70%">
                                                            <el-option v-for="item in listUnidMed" :key="item.id"
                                                                :label="item.nombre" :value="item.id">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Cliente-Ref</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="fillEditInfoProduccion.nIdTipoPago"
                                                            placeholder="Select" disabled style="width: 70%">
                                                            <el-option v-for="item in listDescripPago" :key="item.id"
                                                                :label="item.label" :value="item.value">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div v-if="fillEditInfoProduccion.nIdTipoPago == 1" class="col-md-9">
                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Para Stock</label>
                                                <div class="col-md-9">
                                                    <el-select v-model="fillEditInfoProduccion.nidAlmacen"
                                                        style="width: 90%" filterable disabled placeholder="Select">
                                                        <el-option v-for="item in listAlmacen" :key="item.id"
                                                            :label="item.nombre" :value="item.id">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-1 col-form-label">Referencia  </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    v-model="fillEditInfoProduccion.cReferencia" :disabled="true" />
                                            </div>
                                        </div>
                                    </div>

                                    <div v-if="fillEditInfoProduccion.nIdTipoPago == 2" class="col-md-12">


                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-1 col-form-label">Empresa</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        v-model="fillEditInfoProduccion.cRSocial" :disabled="true" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <template> </template>


                                    <!-- INICIO  DE REQUERIMIENTOS DE MATERIALES -->

                                    <div v-if="listRolPermisoByUsuario.includes('informeproduccion.agregar')"
                                        class="container-fluid">
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card card-primary">
                                                        <div class="card-header">
                                                            <h3 class="card-title">REQUERIMIENTOS DE MATERIALES</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label class="col-md-2 col-form-label">DESCRIPCION DEL
                                                                    MATERIAL</label>

                                                                <div class="col-md-10">
                                                                    <el-select
                                                                        v-model="fillEditInfoProduccion.nIdmaterial"
                                                                        style="width: 60vw" filterable
                                                                        placeholder="Select">
                                                                        <v-row align="right">
                                                                            <el-option v-for="item in listProd"
                                                                                :key="item.id" :label="item.codigo +
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
                                                                                    " :value="item.id">
                                                                            </el-option>
                                                                        </v-row>
                                                                    </el-select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-2 col-form-label">CANTIDAD</label>
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" v-int
                                                                        v-model="fillEditInfoProduccion.cCantMaterial" />
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label
                                                                        class="col-md-4 col-form-label">MEDIDA</label>
                                                                    <div class="col-md-4">
                                                                        <el-select
                                                                            v-model="fillEditInfoProduccion.nIdUnidMedMat"
                                                                            placeholder="Select" style="width: 70%">
                                                                            <el-option v-for="item in listUnidMed"
                                                                                :key="item.id" :label="item.nombre"
                                                                                :value="item.id">
                                                                            </el-option>
                                                                        </el-select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </form>
                            </div>
                            <div v-if="listRolPermisoByUsuario.includes('informeproduccion.agregar')"
                                class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button class="btn btn-flat btn-primary btnWidth"
                                            @click.prevent="setAddPMaterialReqMateriales">
                                            Agregar
                                        </button>
                                        <button class="btn btn-flat btn-default btnWidth"
                                            @click.prevent="setCleanMaterial">
                                            Limpiar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!--  Bandeja de Resultados -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Requerimiento de Materiales</h3>
                                </div>

                                <div class="card-body table-responsive">
                                    <table class="table table-hover table-head-fixed text-nowrap projects">
                                        <thead>
                                            <tr>
                                                <th>Codigo Producto</th>
                                                <th>Descripcion</th>
                                                <th>Cantidad</th>
                                                <th>Unid. Medida</th>

                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in ListReqMatInfoProduc" :key="index">
                                                <td v-text="item.producto.codigo"></td>

                                                <td v-text="item.producto.familia.nombre +
                                                    ' ' +
                                                    item.producto.subfamilia.nombre +
                                                    ', MARCA :' +
                                                    item.producto.marca.nombre +
                                                    ', MODELO/TIPO :' +
                                                    item.producto.modelotipo.nombre +
                                                    ', MATERIAL :' +
                                                    item.producto.material.nombre
                                                    "></td>
                                                <td v-text="item.cantidad"></td>
                                                <td v-text="item.unidmedida.nombre"></td>

                                                <td>
                                                    <button class="btn btn-secondary btn-sm"
                                                        @click="ModalReqMateriales(item.id)">
                                                        <i class="far fa-edit"></i> Editar
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FIN   DE REQUERIMIENTOS DE MATERIALES -->

            <!-- INICIO DE REQUERIMIENTOS MANO DE OBRA -->
            <div class="container-fluid">


                <!--  Bandeja de Resultados -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Mano de Obra - Personal</h3>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-hover table-head-fixed text-nowrap projects">
                            <thead>
                                <tr>
                                    <th>Personal</th>
                                    <th>Días</th>
                                    <th>Horas</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in ListManoObraReqMateriales" :key="index">
                                    <td v-text="item.personal"></td>
                                    <td v-text="item.dias"></td>
                                    <td v-text="item.horas"></td>
                                    <td>
                                        <!--     <button class="btn btn-danger btn-sm" @click="DeleteManodeObra(item.id)">
                      <i class="far fa-trash-alt"></i> Eliminar
                    </button> -->

                                        <button class="btn btn-secondary btn-sm" @click="ModalManoObra(item.id)">
                                            <i class="far fa-edit"></i> Editar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- FIN DE REQUERIMIENTOS MANO DE OBRA -->

            <!-- INICIO DE OTROS REQUERIMIENTOS -->

            <div class="container-fluid">


                <!--  Bandeja de Resultados -->
                <div class="card card-light">
                    <div class="card-header" style="background-color: #9b59b6; color: white">
                        <h3 class="card-title">Otros Requerimientos</h3>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-hover table-head-fixed text-nowrap projects">
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in ListOtrosReqInfoReqMateriales" :key="index">
                                    <td v-text="item.descripcion"></td>
                                    <td v-text="item.cantidad"></td>
                                    <td>
                                        <!--    <button class="btn btn-danger btn-sm" @click="abrirModalOtrosRequerimientos(item.id)">
                      <i class="far fa-trash-alt"></i> Eliminar
                    </button> -->

                                        <button class="btn btn-secondary btn-sm"
                                            @click="abrirModalOtrosRequerimientos(item.id)">
                                            <i class="far fa-edit"></i> Editar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- FIN DE OTROS REQUERIMIENTOS -->

        <div class="modal fade" :class="{ show: modalShow }" :style="modalShow ? mostrarModal : ocultarModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Sistemas Novesur</h5>
                        <button class="close" @click="abrirModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="callout callout-danger" style="padding: 5px" v-for="(item, index) in mensajeError"
                            :key="index" v-text="item"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" @click="abrirModal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!--    MODAL DE REQUERIMIENTOS DE MATERIALES -->

        <div class="modal fade" :class="{ show: modalShowEditItem }"
            :style="modalShowEditItem ? mostrarModal : ocultarModal">
            <div class="modal-editcotitem modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Requerimiento de Materiales</h5>
                        <button class="close" @click="abrirModalEditItem"></button>
                    </div>

                    <div class="modal-body">
                        <div class="content container-fluid">
                            <form role="form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">DESCRIPCION DEL MEDIDOR</label>

                                            <div class="col-md-9">
                                                <el-select v-model="fillEditInfoProduccion.nIdEditmaterial"
                                                    style="width: 90%" filterable placeholder="Select">
                                                    <el-option v-for="item in listProd" :key="item.id" :label="item.codigo +
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
                                                        " :value="item.id">
                                                    </el-option>
                                                </el-select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Cantidad</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"
                                                        v-model="fillEditInfoProduccion.cCantprodEdit" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Unid. Medida</label>
                                                <div class="col-md-6">
                                                    <el-select v-model="fillEditInfoProduccion.nIdUnidMedEdit"
                                                        placeholder="Select" style="width: 70%">
                                                        <el-option v-for="item in listUnidMed" :key="item.id"
                                                            :label="item.nombre" :value="item.id">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-success" @click="EditModalReqMateriales()">
                                Editar
                            </button>
                            <button class="btn btn-secondary" @click="abrirModalEditItem">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  FIN DEL MODAL DE REQUERIMIENTOS DE MATERIALES -->

        <!-- MODAL DE MANO DE OBRA  -->

        <div class="modal fade" :class="{ show: modalShowEditManoObra }"
            :style="modalShowEditManoObra ? mostrarModal : ocultarModal">
            <div class="modal-editcotitem modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Requerimiento Mano de Obra</h5>
                        <button class="close" @click="modalShowEditManoObra"></button>
                    </div>

                    <div class="modal-body">
                        <div class="content container-fluid">
                            <form role="form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">PERSONAL</label>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    v-model="fillEditInfoProduccion.cPersonalModal" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label">DIAS</label>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control"
                                                        v-model="fillEditInfoProduccion.cDiasMObraModal" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">HORAS</label>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control"
                                                        v-model="fillEditInfoProduccion.cHorasMObraModal" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-success" @click="EditModalManoObra">Editar</button>
                            <button class="btn btn-secondary" @click="abrirModalEditManoObra">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DEL  MODAL DE MANO DE OBRA  -->

        <!-- MODAL OTROS REQUERIMIENTOS  -->

        <div class="modal fade" :class="{ show: modalShowEditOtrosRequ }"
            :style="modalShowEditOtrosRequ ? mostrarModal : ocultarModal">
            <div class="modal-editcotitem modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Otros Requermientos</h5>
                        <button class="close" @click="modalShowEditOtrosRequ"></button>
                    </div>

                    <div class="modal-body">
                        <div class="content container-fluid">
                            <form role="form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">DESCRIPCION</label>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    v-model="fillEditInfoProduccion.cDescripModal" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">CANTIDAD</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control"
                                                        v-model="fillEditInfoProduccion.cCantidadModal" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-success" @click="EditModalOtrosReq()">Editar</button>
                            <button class="btn btn-secondary" @click="abrirModalOtrosRequerimientos">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-success btnWidth" @click.prevent="setSaveOrdProduccion">
                        EDITAR
                    </button>
                    <!--        <button class="btn btn-flat btn-default btnWidth" @click.prevent="setCleanManoObra">
              Limpiar
            </button> -->
                </div>
            </div>
        </div>
        <!-- FIN DEL  MODAL OTROS REQUERIMIENTOS  -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            fillEditInfoProduccion: {
                nInfoProd: this.$attrs.id,
                nIdproduct: "",
                cReferencia: "",
                cDocumento: "",
                cFechaEmision: "",
                nidAlmacen: "",
                cRSocial: "",
                cRuc: "",
                nIdmaterial: "",
                cCantMaterial: "",
                cCantidad: "",
                cCantprod: "",
                nIdTipoPago: "",
                nIdTipoMoneda: "",
                nIdUser: sessionStorage.getItem("iduser"),
                cDuracion: "",
                cPersonal: "",
                cPersonalModal: "",
                cDiasMObra: "",
                cDiasMObraModal: "",
                cHorasMObra: "",
                cHorasMObraModal: "",
                cDescripcion: "",
                cDescripModal: "",
                cCantidadReq: "",
                cCantidadModal: "",
                nIdUnidMed: "",
                nIdUnidMedMat: "",
                radTipoTiempo: "1",
                codRequMateriales: "",
                cCostUnit: "",
                nIdEditmaterial: "",
                cCantprodEdit: "",
                nIdUnidMedEdit: "",
                codigoInfoProd:"",
            },

            modalShowEditItem: false,
            modalShowEditManoObra: false,
            modalShowEditOtrosRequ: false,
            mostrarModal: {
                display: "block",
                background: "#0000006b",
            },

            ocultarModal: {
                display: "none",
            },
            listAlmacen: [],
            listUnidMed: [],
            listProd: [],
            ListReqMatInfoProduc: [],
            ListManoObraReqMateriales: [],
            ListOtrosReqInfoReqMateriales: [],
            listartempProduccion: [],
            listartempMobra: [],
            listartempRequerimientos: [],
            listDescripPago: [
                {
                    value: "1",
                    label: "PARA STOCK",
                },
                {
                    value: "2",
                    label: "PARA PEDIDO DE CLIENTE",
                },
            ],
            listTipoCambio: [],

            validatedDias: false,
            validateHoras: true,

            modalShow: false,
            mostrarModal: {
                display: "block",
                background: "#0000006b",
            },
            ocultarModal: {
                display: "none",
            },
            error: 0,
            mensajeError: [],
            listRolPermisoByUsuario: JSON.parse(
                sessionStorage.getItem("listRolPermisosByUsuario")
            ),
        };
    },

    mounted() {
        this.getListarproductosByName();
        this.getlistTipoCambio();
        this.defaultDiaHora();
        this.getListarUnidadMedida();
        this.getListarAlmacen();
        this.CargaInfoProduccionById()
    },

    methods: {
        CargaInfoProduccionById() {

            var url = "/administracion/InformeProduccion/CargaInfoProduccionById";
            axios
                .get(url, {
                    params: {
                        nInfoProd: this.fillEditInfoProduccion.nInfoProd,
                    }
                })
                .then((response) => {
                    console.log(response.data)
                    if (response.data.icon == "warning") {
                        Swal.fire({
                            position: "center",
                            icon: response.data.icon,
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        this.fillEditInfoProduccion.cRSocial = "";
                    }

                    this.fillEditInfoProduccion.nIdproduct = response.data.producto_id;
                    this.fillEditInfoProduccion.cCantprod = response.data.cantidad;
                    this.fillEditInfoProduccion.nIdUnidMed = response.data.unidmedida_id;

                    if (response.data.cliente_id == "202") {
                        this.fillEditInfoProduccion.nIdTipoPago = this.listDescripPago[0].value;
                        this.fillEditInfoProduccion.nidAlmacen = response.data.almacen_id;
                    } else {
                        this.fillEditInfoProduccion.nIdTipoPago = this.listDescripPago[1].value;
                        this.fillEditInfoProduccion.cRSocial = response.data.cliente.razonsocial;
                    }
                    this.fillEditInfoProduccion.cReferencia = response.data.referencia;
                    this.fillEditInfoProduccion.codigoInfoProd= response.data.codigo
                      this.cargaRequeMateriales();
                });
        },

        buscaxCodRequMateriales() {
            this.CargaInfoProduccion();
        },

        abrirModalEditItem() {
            this.modalShowEditItem = !this.modalShowEditItem;
        },

        cargaRequeMateriales() {
            var url = "/administracion/InformeProduccion/getListReqMatInfoProd";
            axios
                .get(url, {
                    params: {
                        nInfoProd: this.fillEditInfoProduccion.nInfoProd
                    },
                })
                .then((response) => {
                    this.ListReqMatInfoProduc = response.data;
                    this.cargaReqManoObraRequMat();
                });
        },

        DeleteReqMateriales(item) {
            Swal.fire({
                title: "Desea eliminar el Registro?",
                text: "En caso de querer recuperarlo consulte con el administrador de sistemas!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, borralo!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Borrado!", "El item seleccionado a sido eliminado.", "success");
                    var url = "/administracion/InformeProduccion/DeleteReqMateriales";
                    axios
                        .post(url, {
                            item,
                        })
                        .then(() => {
                            this.CargaInfoProduccion();
                        });
                }
            });
        },
        cargaReqManoObraRequMat() {
            var url = "/administracion/InformeProduccion/getListReqManoObraInfoProd";
            axios
                .get(url, {
                    params: {
                         nInfoProd: this.fillEditInfoProduccion.nInfoProd
                    },
                })
                .then((response) => {
                    this.ListManoObraReqMateriales = response.data;
                    this.OtrosRequerimientosObraReqMat();
                });
        },

        DeleteManodeObra(item) {
            Swal.fire({
                title: "Desea eliminar el Registro?",
                text: "En caso de querer recuperarlo consulte con el administrador de sistemas!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, borralo!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Borrado!", "El item seleccionado a sido eliminado.", "success");
                    var url = "/administracion/InformeProduccion/DeleteManodeObra";
                    axios
                        .post(url, {
                            item,
                        })
                        .then(() => {
                            this.CargaInfoProduccion();
                        });
                }
            });
        },
        OtrosRequerimientosObraReqMat() {
            var url = "/administracion/InformeProduccion/getOtrosRequerimientosInfoProd";
            axios
                .get(url, {
                    params: {
                         nInfoProd: this.fillEditInfoProduccion.nInfoProd
                    },
                })
                .then((response) => {
                    this.ListOtrosReqInfoReqMateriales = response.data;
                });
        },

        DeleteOtrosReque(item) {
            Swal.fire({
                title: "Desea eliminar el Registro?",
                text: "En caso de querer recuperarlo consulte con el administrador de sistemas!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, borralo!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Borrado!", "El item seleccionado a sido eliminado.", "success");
                    var url = "/administracion/InformeProduccion/DeleteOtrosReque";
                    axios
                        .post(url, {
                            item,
                        })
                        .then(() => {
                            this.CargaInfoProduccion();
                        });
                }
            });
        },

        onChange(e) {
            if (e == 1) {
                this.fillEditInfoProduccion.cHorasMObra = 0;
                this.validateHoras = true;
                this.validatedDias = false;
            }
            if (e == 2) {
                this.fillEditInfoProduccion.cDiasMObra = 0;
                this.validateHoras = false;
                this.validatedDias = true;
            }
        },
        defaultDiaHora() {
            this.fillEditInfoProduccion.cCantidadReq = 0;
            this.fillEditInfoProduccion.cDiasMObra = 0;
            this.fillEditInfoProduccion.cHorasMObra = 0;
        },

        consultaRuc() {
            var url = "/administracion/cliente/consultaRuc";
            axios
                .post(url, {
                    cRuc: this.fillEditInfoProduccion.cRuc,
                })
                .then((response) => {
                    if (response.data.success == false) {
                        (this.fillEditInfoProduccion.cRSocial = ""),
                            Swal.fire({
                                position: "center",
                                icon: "info",
                                title: "Ruc no encontrado o numero equivocado",
                                showConfirmButton: false,
                                timer: 2000,
                            });
                    } else {
                        this.fillEditInfoProduccion.cRSocial = response.data.razonSocial;
                        /*        (this.fillRegistrarCliente.cDireccion = response.data.direccion),
                                      (this.estadobutton = false);
                                    this.disabledbtnRuc = true; */
                    }
                });
        },

        setAddMObra() {
            var url = "/administracion/InformeProduccion/addMObra";
            axios
                .post(url, {
                    codRequMateriales: this.fillEditInfoProduccion.codRequMateriales,
                    cPersonal: this.fillEditInfoProduccion.cPersonal,
                    cDiasMObra: this.fillEditInfoProduccion.cDiasMObra,
                    cHorasMObra: this.fillEditInfoProduccion.cHorasMObra,
                    estado: "P",
                })
                .then((response) => {
                    this.CargaInfoProduccion();
                    this.setcleanListMObra();
                });
        },

        setcleanListMObra() {
            (this.fillEditInfoProduccion.cPersonal = ""),
                (this.fillEditInfoProduccion.cDiasMObra = "");
            this.fillEditInfoProduccion.cHorasMObra = "";
        },

        setAddOtrosRequerimientos() {
            var url = "/administracion/InformeProduccion/addOtrosRequerimientos";
            axios
                .post(url, {
                    codRequMateriales: this.fillEditInfoProduccion.codRequMateriales,
                    cDescripcion: this.fillEditInfoProduccion.cDescripcion,
                    cCantidadReq: this.fillEditInfoProduccion.cCantidadReq,
                    estado: "P",
                })
                .then((response) => {
                    this.CargaInfoProduccion();
                    this.setCleanRequerimientos();
                });
        },

        setLimpiaRequerimientos() {
            (this.fillEditInfoProduccion.cDescripcion = ""),
                (this.fillEditInfoProduccion.cCantidadReq = 0);
        },

        getlistTipoCambio() {
            var url = "/administracion/ordenCompra/TipoCambio";
            axios.get(url).then((response) => {
                this.listTipoCambio = response.data;
                this.fillEditInfoProduccion.nIdTipoMoneda = this.listTipoCambio[0].id;
            });
        },

        getListarAlmacen() {
            var url = "/administracion/almacen/AlmacenbyEstado";
            axios.get(url).then((response) => {
                this.listAlmacen = response.data;
            });
        },
        getListarproductosByName() {
            var url = "/administracion/detallecotizancion/listProdByName";
            axios
                .get(url, {
                    params: {
                        nIdmaterial: this.fillEditInfoProduccion.nIdmaterial,
                    },
                })
                .then((response) => {
                    this.listProd = response.data;
                });
        },

        limpiarCriteriosBsq() {
            this.fillEditInfoProduccion.cCodProduct = "";
        },
        setRegistrarOProduccion() {
            if (this.validaOrdenProduccion()) {
                this.modalShow = true;
                return;
            }
            this.setGrabarOrdenProduccion();
        },

        setSaveOrdProduccion() {
            var url = "/administracion/InformeProduccion/editInfoProdSave";
            axios
                .post(url, {
                    nInfoProd: this.fillEditInfoProduccion.nInfoProd,
                    cCantprod: this.fillEditInfoProduccion.cCantprod,
                    nIdUser: this.fillEditInfoProduccion.nIdUser,
                    cReferencia: this.fillEditInfoProduccion.cReferencia,
                })
                .then((response) => {
                    this.$router.push("/informeProduccion/list");
                });
        },
        abrirModal() {
            this.modalShow = !this.modalShow;
        },
        validaOrdenProduccion() {
            this.error = 0;
            this.mensajeError = [];

            if (!this.fillEditInfoProduccion.nIdproduct) {
                this.mensajeError.push("El campo producto es obligatorio");
            }
            if (this.fillEditInfoProduccion.cCantprod <= 0) {
                this.mensajeError.push("Cantidad no puede ser menor o igual a cero");
            }
            if (!this.fillEditInfoProduccion.cCantprod) {
                this.mensajeError.push("Cantidad es campo obligatorio");
            }

            if (!this.fillEditInfoProduccion.nIdTipoPago) {
                this.mensajeError.push("Tipo de Pago es campo obligatorio");
            }

            if (this.mensajeError.length) {
                this.error = 1;
            }

            return this.error;
        },
        setAddPMaterialReqMateriales() {
            var url = "/administracion/InformeProduccion/addMaterialReqMateriales";
            axios
                .post(url, {
                    codRequMateriales: this.fillEditInfoProduccion.codRequMateriales,
                    nIdmaterial: this.fillEditInfoProduccion.nIdmaterial,
                    cCantMaterial: this.fillEditInfoProduccion.cCantMaterial,
                    nIdUnidMedMat: this.fillEditInfoProduccion.nIdUnidMedMat,
                    estado: "P",
                })
                .then((response) => {
                    this.CargaInfoProduccion();
                    this.setLimpiaCampos();
                });

            /*  var url = "/administracion/InformeProduccion/saveReqMateriales";

             axios
               .post(url, {
                 //codRequMateriales: this.fillEditInfoProduccion.codRequMateriales,
                 nIdmaterial: this.fillEditInfoProduccion.nIdmaterial,
                 cCantMaterial: this.fillEditInfoProduccion.cCantMaterial,
                 nIdUnidMedMat: this.fillEditInfoProduccion.nIdUnidMedMat,
                 estado: 'R',
               })
               .then((response) => {
                 this.listartempProduccion = response.data.datos;
                 this.CargaInfoProduccion();

                 if (response.data.message == "Ya fue agregado anteriormente") {
                   Swal.fire({
                     position: "center",
                     icon: response.data.icon,
                     title: response.data.message,
                     showConfirmButton: false,
                     timer: 1500,
                   });
                 }
               }); */
        },

        setLimpiaMaterial() {
            (this.fillEditInfoProduccion.nIdmaterial = ""),
                (this.fillEditInfoProduccion.cCantMaterial = 0);
        },

        setLimpiaCampos() {
            this.fillEditInfoProduccion.nIdmaterial = null;
            this.fillEditInfoProduccion.cCantidad = 0;
        },

        setResetCampos() {
            this.fillEditInfoProduccion.nIdmaterial = null;
            this.fillEditInfoProduccion.cCantidad = 0;

            this.fillEditInfoProduccion.cReferencia = "";
            this.fillEditInfoProduccion.cDocumento = "";
        },

        setCleanMaterial() {
            var url = "/administracion/ordenProduccion/eliminarTemporder";
            axios.get(url, {}).then((response) => {
                this.listartempProduccion = response.data.datos;
                this.setLimpiaMaterial();
            });
        },

        setCleanManoObra() {
            var url = "/administracion/ordenProduccion/CleanMaterialManoOBra";
            axios.get(url, {}).then((response) => {
                this.listartempMobra = response.data.datos;
                this.setcleanListMObra();
            });
        },

        setCleanRequerimientos() {
            var url = "/administracion/ordenProduccion/cleanRequerimientos";
            axios.get(url, {}).then((response) => {
                this.listartempRequerimientos = response.data.datos;
                this.setLimpiaRequerimientos();
            });
        },

        setListtemOrders() {
            var url = "/administracion/ordenCompra/ListtempOrden";
            axios.get(url, {}).then((response) => {
                this.listartempProduccion = response.data.datos;
            });
        },

        getListarUnidadMedida() {
            var url = "/administracion/KardexDetalle/listUnidMed";
            axios.get(url).then((response) => {
                this.listUnidMed = response.data;
                this.fillEditInfoProduccion.nIdUnidMed = this.listUnidMed[9].id;
                this.fillEditInfoProduccion.nIdUnidMedMat = this.listUnidMed[9].id;
            });
        },

        ModalReqMateriales(item) {
            this.abrirModalEditItem(item);
            this.ShowReqMateriales(item);
        },

        ModalManoObra(item) {
            this.abrirModalEditManoObra(item);
        },

        abrirModalEditManoObra(item) {
            this.modalShowEditManoObra = !this.modalShowEditManoObra;
            this.ShowReqManoObra(item);
        },

        abrirModalOtrosRequerimientos(item) {
            this.modalShowEditOtrosRequ = !this.modalShowEditOtrosRequ;
            this.ShowOtrosReq(item);
        },

        ShowReqMateriales(item) {
            var url = "/administracion/InformeProduccion/getDataReqMaterialesInfoProd";
            axios
                .post(url, {
                    nInfoProd:item,
                })
                .then((response) => {
                    (this.fillEditInfoProduccion.nIdEditmaterial = response.data.producto_id),
                        (this.fillEditInfoProduccion.cCantprodEdit = response.data.cantidad),
                        (this.fillEditInfoProduccion.nIdUnidMedEdit = response.data.unidmedida_id);
                    localStorage.Codigo = item;
                });
        },

        ShowReqManoObra(item) {
            var url = "/administracion/InformeProduccion/getDataReqManoObraInfoProd";
            axios
                .post(url, {
                    item,
                })
                .then((response) => {
                    (this.fillEditInfoProduccion.cPersonalModal = response.data.personal),
                        (this.fillEditInfoProduccion.cDiasMObraModal = response.data.dias),
                        (this.fillEditInfoProduccion.cHorasMObraModal = response.data.horas);
                    localStorage.Codigo = item;
                });
        },

        ShowOtrosReq(item) {
            var url = "/administracion/InformeProduccion/getDataOtrosReqInfoProd";
            axios
                .post(url, {
                    item,
                })
                .then((response) => {
                    this.fillEditInfoProduccion.cDescripModal = response.data.descripcion;
                    this.fillEditInfoProduccion.cCantidadModal = response.data.cantidad;
                    localStorage.Codigo = item;
                });
        },

        EditModalReqMateriales() {

            var url = "/administracion/InformeProduccion/EditModalReqMaterialesInfoProd";
            axios
                .post(url, {
                    item: localStorage.Codigo,
                    cCantprodEdit: this.fillEditInfoProduccion.cCantprodEdit,
                    nIdUnidMedEdit: this.fillEditInfoProduccion.nIdUnidMedEdit,
                })
                .then((response) => {
                    this.cargaRequeMateriales(this.fillEditInfoProduccion.codRequMateriales);
                    this.abrirModalEditItem();
                });
        },

        EditModalManoObra(item) {
            var url = "/administracion/InformeProduccion/EditModalManoObraInfoProd";
            axios
                .post(url, {
                    item: localStorage.Codigo,
                    cPersonalModal: this.fillEditInfoProduccion.cPersonalModal,
                    cDiasMObraModal: this.fillEditInfoProduccion.cDiasMObraModal,
                    cHorasMObraModal: this.fillEditInfoProduccion.cHorasMObraModal,
                })
                .then((response) => {
                    this.cargaReqManoObraRequMat(this.fillEditInfoProduccion.codRequMateriales);
                    this.abrirModalEditManoObra();
                });
        },

        EditModalOtrosReq() {
            var url = "/administracion/InformeProduccion/EditModalOtrosReqInfoProd";
            axios
                .post(url, {
                    item: localStorage.Codigo,
                    cDescripModal: this.fillEditInfoProduccion.cDescripModal,
                    cCantidadModal: this.fillEditInfoProduccion.cCantidadModal,
                })
                .then((response) => {
                    this.OtrosRequerimientosObraReqMat(
                        this.fillEditInfoProduccion.codRequMateriales
                    );
                });

            this.abrirModalOtrosRequerimientos();
        },
    },
};
</script>

<style></style>
