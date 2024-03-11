<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Movimiento Almacen</h1>
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
                            :to="'/ordenCompra/list'"
                        >
                            <i class="fas fa-arrow-left"></i>Regresar 
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid"> 
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Formulario Guia de Remisión
                                </h3>
                            </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >Tipo de Traslado</label
                                                    >
                                                    <div class="col-md-8">
                                                        <el-select
                                                            v-model="
                                                                fillGuiaRemisionCreate.nIdTipoTraslado
                                                            "
                                                            placeholder="Select"
                                                            style="width: 20vw"
                                                        >
                                                            <el-option
                                                                v-for="item in listTipoTraslado"
                                                                :key="item.id"
                                                                :label="
                                                                    item.nombre
                                                                "
                                                                :value="item.id"
                                                            >
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >Comprobante</label
                                                    >
                                                    <div class="col-md-8">
                                                      <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillGuiaRemisionCreate.cComprobante
                                                            "
                                                            
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >Punto de Partida</label
                                                    >
                                                    <div class="col-md-8">
                                                        <el-select
                                                            v-model="
                                                                fillGuiaRemisionCreate.nIdPartida
                                                            "
                                                            placeholder="Select"
                                                            style="width: 20vw"
                                                        >
                                                            <el-option
                                                                v-for="item in listAlmacenPPartida"
                                                                :key="item.id"
                                                                :label="
                                                                    item.nombre
                                                                "
                                                                :value="item.id"
                                                            >
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >Punto de LLegada</label
                                                    >
                                                    <div class="col-md-9">
                                                        <el-select
                                                            v-model="
                                                                fillGuiaRemisionCreate.nIdLlegada
                                                            "
                                                            placeholder="Select"
                                                            style="width: 20vw"
                                                        >
                                                            <el-option
                                                                v-for="item in listAlmacenPllegada"
                                                                :key="item.id"
                                                                :label="
                                                                    item.nombre
                                                                "
                                                                :value="item.id"
                                                            >
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >Cliente</label
                                                    >
                                                    <div class="col-md-9">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillGuiaRemisionCreate.nidCliente
                                                            "
                                                            :disabled="true"
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >RUC</label
                                                    >
                                                    <div class="col-md-4">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            :disabled="
                                                                isDisabled
                                                            "
                                                            v-model="
                                                                fillGuiaRemisionCreate.nIdRuc
                                                            "
                                                            v-int
                                                        />
                                                    </div>
                                                    <span
                                                        ><button
                                                            class="btn btn-flat btn-success"
                                                            @click.prevent="
                                                                getBuscaRucBD
                                                            "
                                                        >
                                                            <i
                                                                class="fas fa-search"
                                                            ></i>
                                                        </button>
                                                        <button
                                                            class="btn btn-flat btn-info"
                                                            @click.prevent="
                                                                getRefresh
                                                            "
                                                        >
                                                            <i
                                                                class="fas fa-sync-alt"
                                                            ></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-3 col-form-label"
                                                        >Motivo de
                                                        Traslado</label
                                                    >
                                                    <div class="col-md-4">
                                                        <el-select
                                                            v-model="
                                                                fillGuiaRemisionCreate.nIdMotivo
                                                            "
                                                            placeholder="Select"
                                                            style="width: 20vw"
                                                        >
                                                            <el-option
                                                                v-for="item in listMotivo"
                                                                :key="item.id"
                                                                :label="
                                                                    item.nombre
                                                                "
                                                                :value="item.id"
                                                            >
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-3 col-form-label"
                                                        >Fecha de Inicio de
                                                        Traslado</label
                                                    >
                                                    <div class="col-md-4">
                                                        <el-date-picker
                                                            v-model="
                                                                fillGuiaRemisionCreate.cFechaTraslado
                                                            "
                                                            type="date"
                                                            placeholder="Ingrese una Fecha"
                                                            format="dd/MM/yyyy"
                                                            value-format="yyyy-MM-dd"
                                                        >
                                                        </el-date-picker>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="container-fluid">
                                <form role="form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">
                                                        UNIDAD DE TRANSPORTE Y
                                                        CONDUCTOR
                                                    </h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="col-md-12">
                                                        <div
                                                            class="form-group row"
                                                        >
                                                            <label
                                                                class="col-md-2 col-form-label"
                                                                >PLACA DEL
                                                                VEHICULO</label
                                                            >

                                                            <div
                                                                class="col-md-4"
                                                            >
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    v-model="
                                                                        fillGuiaRemisionCreate.cPlacaVehiculo
                                                                    "
                                                                />
                                                            </div>

                                                            <label
                                                                class="col-md-2 col-form-label"
                                                                >MODALIDAD DE
                                                                TRANSPORTE</label
                                                            >

                                                            <div
                                                                class="col-md-4"
                                                            >
                                                                <el-select
                                                                    v-model="
                                                                        fillGuiaRemisionCreate.nIdModTransporte
                                                                    "
                                                                    placeholder="Select"
                                                                    style="
                                                                        width: 20vw;
                                                                    "
                                                                >
                                                                    <el-option
                                                                        v-for="item in listModTransporte"
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

                                                    <form role="form">
                                                        <div class="row">
                                                            <div
                                                                class="col-md-12"
                                                            >
                                                                <div
                                                                    class="form-group row"
                                                                >
                                                                    <label
                                                                        class="col-md-2 col-form-label"
                                                                        >DNI DEL
                                                                        CONDUCTOR</label
                                                                    >
                                                                    <div
                                                                        class="col-md-3"
                                                                    >
                                                                        <input
                                                                            type="text"
                                                                            class="form-control"
                                                                            v-model="
                                                                                fillGuiaRemisionCreate.cDniConductor
                                                                            "
                                                                            v-int
                                                                            :maxlength="12"
                                                                        />
                                                                    </div>

                                                                    <label
                                                                        class="col-md-1 col-form-label"
                                                                        >PESO
                                                                        TOTAL
                                                                        APROX.(KGM)
                                                                    </label>
                                                                    <div
                                                                        class="col-md-3"
                                                                    >
                                                                        <input
                                                                            type="text"
                                                                            class="form-control"
                                                                            v-model="
                                                                                fillGuiaRemisionCreate.cPesoTotal
                                                                            "
                                                                          
                                                                        />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="col-md-12"
                                                            >
                                                                <div
                                                                    class="row"
                                                                >
                                                                    <div
                                                                        class="col-md-12"
                                                                    >
                                                                        <div
                                                                            class="form-group row"
                                                                        >
                                                                            <label
                                                                                class="col-md-2 col-form-label"
                                                                                >OBSERVACION</label
                                                                            >
                                                                            <div
                                                                                class="col-md-10"
                                                                            >
                                                                                <input
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    v-model="
                                                                                        fillGuiaRemisionCreate.cObservacion
                                                                                    "
                                                                                    @keypress.prevent.enter="
                                                                                        setRegistrarGRemision
                                                                                    "
                                                                                />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-4 offset-4">
                                            <button
                                                class="btn btn-flat btn-default btnWidth"
                                                @click.prevent="
                                                    limpiarDetallePSalida
                                                "
                                            >
                                                Limpiar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--  Bandeja de Resultados -->
                            <div class="content container-fluid">
                                <form role="form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-2 col-form-label"
                                                    >DESCRIPCION DEL
                                                    MEDIDOR</label
                                                >

                                                <div class="col-md-10">
                                                    <el-select
                                                        v-model="
                                                            fillGuiaRemisionCreate.nIdprod
                                                        "
                                                        style="width: 90%"
                                                        filterable
                                                        placeholder="Select"
                                                    >
                                                        <v-row align="right">
                                                            <el-option
                                                                v-for="item in listProd"
                                                                :key="item.id"
                                                                :label="
                                                                    item.codigo +
                                                                    ' - ' +
                                                                    item.familia
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
                                                                    item.marca
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
                                                                :value="item.id"
                                                            >
                                                            </el-option>
                                                        </v-row>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-4 col-form-label"
                                                    >UNIDAD</label
                                                >
                                                <div class="col-md-4">
                                                    <el-select
                                                        v-model="
                                                            fillGuiaRemisionCreate.nIdUnidMed
                                                        "
                                                        placeholder="Select"
                                                        style="width: 70%"
                                                    >
                                                        <el-option
                                                            v-for="item in listUnidMed"
                                                            :key="item.id"
                                                            :label="item.nombre"
                                                            :value="item.id"
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
                                                    class="col-md-4 col-form-label"
                                                    >CANTIDAD</label
                                                >
                                                <div class="col-md-4">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-int
                                                        v-model="
                                                            fillGuiaRemisionCreate.cCantidad
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-4 col-form-label"
                                                    >KG</label
                                                >
                                                <div class="col-md-4">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        
                                                        v-model="
                                                            fillGuiaRemisionCreate.cPeso
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-4 offset-4">
                                                <button
                                                    class="btn btn-flat btn-info btnWidth"
                                                    @click.prevent="addProduct"
                                                >
                                                    Agregar
                                                </button>
                                                <button
                                                    class="btn btn-flat btn-default btnWidth"
                                                    @click.prevent="
                                                        setLimpiarTodo
                                                    "
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
                                                        <th>Nro</th>
                                                        <th>UNIDAD</th>
                                                        <th>CODIGO</th>
                                                        <th>
                                                            DESCRIPCION DEL
                                                            PRODUCTO
                                                        </th>
                                                        <th>CANTIDAD</th>
                                                        <th>PESO</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="(
                                                            item, index
                                                        ) in listarGuiaRemisionPaginated"
                                                        :key="index"
                                                    >
                                                        <td
                                                            v-text="
                                                                Number(index)
                                                            "
                                                        ></td>
                                                        <td
                                                            v-text="
                                                                item.unidmedNombre
                                                            "
                                                        ></td>
                                                        <td
                                                            v-text="item.codigo"
                                                        ></td>
                                                        <td
                                                            v-text="
                                                                item.productoFamilia +
                                                                ' ' +
                                                                item.productoSubfamilia +
                                                                ', MARCA :' +
                                                                item.productoMarca +
                                                                ', MODELO/TIPO :' +
                                                                item.productoModelotipo +
                                                                ', MATERIAL :' +
                                                                item.material
                                                            "
                                                        ></td>
                                                        <td
                                                            v-text="
                                                                item.cantidad
                                                            "
                                                        ></td>
                                                        <td
                                                            v-text="item.peso"
                                                        ></td>

                                                        <td>
                                                            <button
                                                                class="btn btn-info btn-sm"
                                                                @click.prevent="
                                                                    borradoItems(
                                                                        item.producto_id
                                                                    )
                                                                "
                                                            >
                                                                Eliminar
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-4 offset-4">
                                                    <button
                                                        class="btn btn-flat btn-info btnWidth"
                                                        @click.prevent="
                                                            setRegistrarGRemision
                                                        "
                                                    >
                                                        Procesar
                                                    </button>
                                                    <button
                                                        class="btn btn-flat btn-default btnWidth"
                                                        @click.prevent="
                                                            eliminarTempitemPSalida
                                                        "
                                                    >
                                                        Limpiar
                                                    </button>
                                                </div>
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

        <!--  Modal de Validacion de campos -->
        <div
            class="modal fade"
            :class="{ show: modalShow }"
            :style="modalShow ? mostrarModal : ocultarModal"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Sistemas Novesur</h5>
                        <button class="close" @click="abrirModal"></button>
                    </div>
                    <div class="modal-body">
                        <div
                            class="callout callout-danger"
                            style="padding: 5px"
                            v-for="(item, index) in mensajeError"
                            :key="index"
                            v-text="item"
                        ></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" @click="abrirModal">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--  Fin del  Modal de Validacion de campos -->

        <!--Fin del  Modal de editar cantidad de Parte de Ingreso -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            fillGuiaRemisionCreate: {
                nidCliente: "",
                nIdRuc: "",
                nIdMotivo: "",
                cFechaTraslado: "",
                cPlacaVehiculo: "",
                cModTransporte: "",
                cDniConductor: "",
                cPesoTotal: "",
                cObservacion: "",
                ncodCotizacion: this.$attrs.id,
                nIdUser: sessionStorage.getItem("iduser"),
                nIdLlegada: "",
                nIdPartida: "",
                nIdTipoTraslado: "",
                nIdprod: "",
                cPeso: "",
                nIdModTransporte: "",
                nIdUnidMed: "",
                cComprobante:"",
            },

            listarDetalleOrdeCompra: [],
            listProd: [],
            listAlmacenPPartida: [],
            listAlmacenPllegada: [],
            listMotivo: [],
            listTipoTraslado: [],
            listUnidMed: [],
            listModTransporte: [],

            listarGuiaRemisionPaginated: [],
            estadoProv: false,
            estadoCliente: false,

            modalCantidad: false,
            isDisabled: false,
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
        };
    },
    mounted() {
        this.setSelectMovimiento();
        this.cargaListAlmacenEntrada();
        this.getListAlmacen();
        this.getListTipoTraslado();
        this.getListarproductosByName();
        this.getListModTransporte();
        this.setListtempGuiaRemision();
        this.getListarUnidadMedida();

        this.fillGuiaRemisionCreate.cFecha = new Date();
        this.fillGuiaRemisionCreate.cPeso= '0.10'
      
    },
    computed: {},
    methods: {
        limpiarCriteriosBsq() {},
        setRegistrarGRemision() {
            if (this.validaGuiaRemision()) {
                this.modalShow = true;
                return;
            }
            this.setProcesar();
        },

        getListarproductosByName() {
            var url = "/administracion/detallecotizancion/listProdByName";
            axios
                .get(url, {
                    params: {
                        nIdprod: this.fillGuiaRemisionCreate.nIdprod,
                    },
                })
                .then((response) => {
                    this.listProd = response.data;
                });
        },

        getBuscaRucBD() {
            if (!this.fillGuiaRemisionCreate.nIdRuc) {
                Swal.fire("Ingrese el Ruc por favor!");
            } else {
                var url = "/administracion/cliente/BuscaRucBD";
                axios
                    .post(url, {
                        nIdRuc: this.fillGuiaRemisionCreate.nIdRuc,
                    })
                    .then((response) => {
                        this.fillGuiaRemisionCreate.nidCliente =
                            response.data.razonsocial;
                        this.isDisabled = true;
                    });
            }
        },

        getRefresh() {
            this.fillGuiaRemisionCreate.nidCliente = "";
            this.fillGuiaRemisionCreate.nIdRuc = "";
            this.isDisabled = false;
        },
        getListTipoTraslado() {
            var url = "/administracion/MovimientoAlmacen/tipotraslado";
            axios.get(url, {}).then((response) => {
                this.listTipoTraslado = response.data;
                this.fillGuiaRemisionCreate.nIdTipoTraslado =
                    this.listTipoTraslado[0].id;
            });
        },

        getListModTransporte() {
            var url = "/administracion/MovimientoAlmacen/ListModTransporte";
            axios.get(url, {}).then((response) => {
                this.listModTransporte = response.data;
                this.fillGuiaRemisionCreate.nIdModTransporte =
                    this.listModTransporte[0].id;
            });
        },

        setListtempPSalida() {
            var url = "/administracion/parte_salida/ListtempParteSalida";
            axios.get(url, {}).then((response) => {
                this.listarPSalidaPaginated = response.data.datos;
            });
        },

        cargaListAlmacenEntrada() {
            var url = "/administracion/almacen/AlmacenLlegada";
            axios
                .get(url, {
                    params: {
                        nIdUser: this.fillGuiaRemisionCreate.nIdUser,
                    },
                })
                .then((response) => {
                    this.listAlmacenPPartida = response.data;
                    this.fillGuiaRemisionCreate.nIdPartida =
                        this.listAlmacenPPartida[0].id;
                });
        },

        getListAlmacen() {
            var url = "/administracion/almacen/listAlmacen";
            axios.get(url).then((response) => {
                this.listAlmacenPllegada = response.data;
            });
        },

        borradoItems(item) {
            var url = "/administracion/parte_salida/reorder";
            axios
                .post(url, {
                    item: item,
                })
                .then((response) => {
                    this.listarPSalidaPaginated = response.data.datos;
                });
        },

        setProcesar() {
            var url = "/operacion/MovimientoAlmacen/create";
            axios
                .post(url, {
                    nIdTipoTraslado:
                        this.fillGuiaRemisionCreate.nIdTipoTraslado,
                    cFechaTraslado: this.fillGuiaRemisionCreate.cFechaTraslado,
                    nIdPartida: this.fillGuiaRemisionCreate.nIdPartida,
                    nIdLlegada: this.fillGuiaRemisionCreate.nIdLlegada,
                    nidCliente: this.fillGuiaRemisionCreate.nidCliente,
                    nIdRuc: this.fillGuiaRemisionCreate.nIdRuc,
                    cPlacaVehiculo: this.fillGuiaRemisionCreate.cPlacaVehiculo,
                    nIdMotivo: this.fillGuiaRemisionCreate.nIdMotivo,
                    nIdModTransporte:this.fillGuiaRemisionCreate.nIdModTransporte,
                    cComprobante: this.fillGuiaRemisionCreate.cComprobante,
                    cDniConductor: this.fillGuiaRemisionCreate.cDniConductor,
                    cPesoTotal: this.fillGuiaRemisionCreate.cPesoTotal,
                    cObservacion: this.fillGuiaRemisionCreate.cObservacion,
                    nIdUser: this.fillGuiaRemisionCreate.nIdUser,
                })
                .then((response) => {
                    Swal.fire({
                        position: "center",
                        icon: response.data.icon,
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    this.setLimpiarTodo();
                    
                });
        },
        addProduct() {
            var url = "/administracion/MovimientoAlmacen/addProduct";
            axios
                .post(url, {
                    nIdprod: this.fillGuiaRemisionCreate.nIdprod,
                    cCantidad: this.fillGuiaRemisionCreate.cCantidad,
                    cPeso: this.fillGuiaRemisionCreate.cPeso,
                    nIdUnidMed: this.fillGuiaRemisionCreate.nIdUnidMed,
                })
                .then((response) => {
                    if (response.data.icon == "error") {
                        Swal.fire({
                            position: "center",
                            icon: response.data.icon,
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    } else {
                        this.listarGuiaRemisionPaginated = response.data.datos;
                        this.setListtempGuiaRemision();
                        
                        this.fillGuiaRemisionCreate.nIdprod='',
                        this.fillGuiaRemisionCreate.cCantidad=''
                    }

                    /*          if (response.data.message == "Ya fue agregado anteriormente") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 1500,
            });
          } */
                });
        },
        abrirModal() {
            this.modalShow = !this.modalShow;
        },

        abrirModalCantidad() {
            this.modalCantidad = !this.modalCantidad;
        },
        validaGuiaRemision() {
            this.error = 0;
            this.mensajeError = [];

            if (!this.fillGuiaRemisionCreate.cComprobante) {
                this.mensajeError.push("Nro Guia  es obligatorio");
            }

            if (!this.fillGuiaRemisionCreate.nIdLlegada) {
                this.mensajeError.push("El Campo Punto de Llegada es obligatorio");
            }

            if (!this.fillGuiaRemisionCreate.nIdRuc) {
                this.mensajeError.push("El Campo Ruc es obligatorio");
            }

            if (!this.fillGuiaRemisionCreate.nIdMotivo) {
                this.mensajeError.push("El Campo Motivo es obligatorio");
            }

            if (!this.fillGuiaRemisionCreate.cFechaTraslado) {
                this.mensajeError.push("El Campo Fecha de Traslado es obligatorio");
            }

            if (!this.fillGuiaRemisionCreate.nIdModTransporte) {
                this.mensajeError.push("El Campo Modalidad de Transporte es obligatorio");
            }

            if (this.mensajeError.length) {
                this.error = 1;
            }

            return this.error;
        },

        limpiarDetallePSalida() {
            this.fillGuiaRemisionCreate.cObservacion = "";
            this.fillGuiaRemisionCreate.nIdMotivo = "";

            this.fillGuiaRemisionCreate.cCantidad = "";
            this.fillGuiaRemisionCreate.cStock = "";
        },

        setLimpiaDetalleProducto() {
            this.fillGuiaRemisionCreate.cCantidad = "";
            this.fillGuiaRemisionCreate.cStock = "";
        },

        setListtempGuiaRemision() {
            var url = "/administracion/MovimientoAlmacen/ListtempGuiaRemision";
            axios.get(url, {}).then((response) => {
                this.listarGuiaRemisionPaginated = response.data.datos;
            });
        },

        setResetCampos() {
            var url = "/administracion/tempcotizacion/eliminarTempitemCoti";
            axios.post(url).then((response) => {
                //this.setListtempCotizacion();
                this.listarPSalidaPaginated = response.data.datos;
            });
        },

        eliminarTempitemPSalida() {
            var url = "/administracion/MovimientoAlmacen/eliminarTemporder";
            axios.post(url).then((response) => {
                this.setListtempGuiaRemision();
            });
        },

        getListarMotivo(idMovimiento) {
            var url = "/administracion/KardexDetalle/listMotivo";
            axios
                .get(url, {
                    params: {
                        idMovimiento: idMovimiento,
                    },
                })
                .then((response) => {
                    this.listMotivo = [];
                    this.listMotivo = response.data;
                    this.fillGuiaRemisionCreate.nIdMotivo = this.listMotivo[0].id;
                    
                });
        },
        setSelectMovimiento() {
            this.fillGuiaRemisionCreate.nIdMotivo = "";
            this.getListarMotivo(2);
        },

        getListarUnidadMedida() {
            var url = "/administracion/KardexDetalle/listUnidMed";
            axios.get(url).then((response) => {
                this.listUnidMed = response.data;
                this.fillGuiaRemisionCreate.nIdUnidMed = this.listUnidMed[7].id;
            });
        },

        setLimpiarTodo(){
            this.fillGuiaRemisionCreate.nIdLlegada=''
            this.fillGuiaRemisionCreate.nidCliente=''
            this.fillGuiaRemisionCreate.nIdRuc=''
            this.fillGuiaRemisionCreate.nIdLlegada=''
            this.fillGuiaRemisionCreate.cPlacaVehiculo=''
            this.fillGuiaRemisionCreate.cDniConductor=''
            this.fillGuiaRemisionCreate.cPesoTotal=''
            this.fillGuiaRemisionCreate.cObservacion=''
            this.fillGuiaRemisionCreate.nIdprod='',
            this.fillGuiaRemisionCreate.cCantidad=''
            this.eliminarTempitemPSalida();
        }
    },
};
</script>

<style></style>
