<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Parte de Salida</h1>
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
                                    Formulario Parte de Ingreso
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
                                                        >Cliente</label
                                                    >
                                                    <div class="col-md-9">
                                                        <el-select
                                                            v-model="
                                                                fillPSalida.nIdCliente
                                                            "
                                                            filterable
                                                            placeholder="Select"
                                                            style="width: 25vw"
                                                        >
                                                            <el-option
                                                                v-for="item in listCliente"
                                                                :key="item.id"
                                                                :label="
                                                                    item.razonsocial
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
                                                        >Motivo</label
                                                    >
                                                    <div class="col-md-8">
                                                        <el-select
                                                            v-model="
                                                                fillPSalida.nIdMotivo
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
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-3 col-form-label"
                                                        >Nro Factura</label
                                                    >
                                                    <div class="col-md-4">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPSalida.nroFactura
                                                            "
                                                            @keypress.prevent.enter="
                                                                setRegistrarPSalida
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-3 col-form-label"
                                                        >Nro Guia</label
                                                    >
                                                    <div class="col-md-4">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPSalida.cNroGuia
                                                            "
                                                            @keypress.prevent.enter="
                                                                setRegistrarPSalida
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-3 col-form-label"
                                                        >Fecha</label
                                                    >
                                                    <div class="col-md-4">
                                                        <el-date-picker
                                                            v-model="
                                                                fillPSalida.cFecha
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

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-1 col-form-label"
                                                        >Observación</label
                                                    >
                                                    <div class="col-md-10">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPSalida.cObservacion
                                                            "
                                                            @keypress.prevent.enter="
                                                                setRegistrarPSalida
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-2 col-form-label"
                                                    >ALMACEN</label
                                                >
                                                <div class="col-md-3">
                                                    <el-select
                                                        v-model="
                                                            fillPSalida.nIdAlmacen
                                                        "
                                                        placeholder="Select"
                                                        style="width: 70%"
                                                    >
                                                        <el-option
                                                            v-for="item in listAlmacen"
                                                            :key="item.id"
                                                            :label="item.nombre"
                                                            :value="item.id"
                                                            :disabled="
                                                                item.nombre ===
                                                                    'Almacen Oficina' ||
                                                                item.nombre ===
                                                                    'NINGUNO'
                                                            "
                                                        >
                                                        </el-option>
                                                    </el-select>
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
                                                        DETALLE DEL PRODUCTO
                                                    </h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-md-2 col-form-label"
                                                            >DESCRIPCION DEL
                                                            MEDIDOR</label
                                                        >

                                                        <div class="col-md-10">
                                                            <el-select
                                                                v-model="
                                                                    fillPSalida.nIdprod
                                                                "
                                                                style="
                                                                    width: 90%;
                                                                "
                                                                filterable
                                                                placeholder="Select"
                                                                @change="
                                                                    getBuscaStockProducto()
                                                                "
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
                                                            </el-select>
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
                                                                        >CANTIDAD</label
                                                                    >
                                                                    <div
                                                                        class="col-md-2"
                                                                    >
                                                                        <input
                                                                            type="text"
                                                                            class="form-control"
                                                                            v-model="
                                                                                fillPSalida.cCantidad
                                                                            "
                                                                            v-int
                                                                        />
                                                                    </div>

                                                                    <label
                                                                        class="col-md-1 col-form-label"
                                                                        >MEDIDA</label
                                                                    >
                                                                    <div
                                                                        class="col-md-3"
                                                                    >
                                                                        <el-select
                                                                            v-model="
                                                                                fillPSalida.nIdUnidMed
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

                                                                    <label
                                                                        class="col-md-1 col-form-label"
                                                                        >STOCK
                                                                    </label>
                                                                    <div
                                                                        class="col-md-2"
                                                                    >
                                                                        <input
                                                                            type="text"
                                                                            class="form-control"
                                                                            v-model="
                                                                                fillPSalida.cStock
                                                                            "
                                                                            v-int
                                                                            readonly
                                                                        />
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
                                                class="btn btn-flat btn-info btnWidth"
                                                @click.prevent="
                                                    setAddTempPSalida
                                                "
                                            >
                                                Agregar
                                            </button>
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
                                                <th>Codigo</th>
                                                <th>Cantidad</th>
                                                <th>Unid. Medida</th>
                                                <th>Descripcion</th>
                                                <th>Opcion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    item, index
                                                ) in listarPSalidaPaginated"
                                                :key="index"
                                            >
                                                <td v-text="item.codigo"></td>
                                                <td v-text="item.cantidad"></td>
                                                <td
                                                    v-text="item.unidmedNombre"
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

                                                <td>
                                                    <button
                                                        class="btn btn-danger btn-sm"
                                                        @click.prevent="
                                                            borradoItems(
                                                                item.producto_id
                                                            )
                                                        "
                                                    >
                                                        <span
                                                            ><i
                                                                class="fas fa-minus-circle"
                                                            ></i
                                                        ></span>
                                                        Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button
                                            class="btn btn-flat btn-info btnWidth"
                                            @click.prevent="setRegistrarPSalida"
                                        >
                                            Guardar
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
            fillPSalida: {
                nIdCliente: "",
                nIdprod: "",
                cNroGuia: "",
                nroFactura: "",
                cFecha: "",
                cObservacion: "",
                nIdUser: sessionStorage.getItem("iduser"),
                nIdMotivo: "",
                cCantidadModal: "",
                cCantidad: "",
                nIdUnidMed: "",
                nIdAlmacen: "",
                cStock: "",
            },

            listarDetalleOrdeCompra: [],
            listMotivo: [],
            listCliente: [],
            listProd: [],
            listUnidMed: [],
            listarPSalidaPaginated: [],
            listAlmacen: [],
            estadoProv: false,
            estadoCliente: false,

            modalCantidad: false,

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
        this.getListarClientes();
        this.getListarUnidadMedida();
        this.getListarproductosByName();

        this.setSelectMovimiento();
        this.setAddTempPSalida();
        this.fillPSalida.cFecha = new Date();
        this.getListAlmacen();
    },
    computed: {},
    methods: {
        getListarClientes() {
            var url = "/administracion/cliente/getListarAllCliente";
            axios.get(url, {}).then((response) => {
                this.listCliente = response.data;
            });
        },

        limpiarCriteriosBsq() {},
        setRegistrarPSalida() {
            if (this.validaPIngreso()) {
                this.modalShow = true;
                return;
            }
            this.setGrabarPSalida();
        },

        setListtempPSalida() {
            var url = "/administracion/parte_salida/ListtempParteSalida";
            axios.get(url, {}).then((response) => {
                this.listarPSalidaPaginated = response.data.datos;
            });
        },

        setAddTempPSalida() {
            var url = "/administracion/parte_salida/addTempPSalida";
            axios
                .post(url, {
                    cCantidad: this.fillPSalida.cCantidad,
                    nIdUnidMed: this.fillPSalida.nIdUnidMed,
                    nIdprod: this.fillPSalida.nIdprod,
                    cStock: this.fillPSalida.cStock,
                })
                .then((response) => {
                    if (response.data.message == "Excede al stock actual") {
                        Swal.fire({
                            position: "center",
                            icon: response.data.icon,
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    } else {
                        //this.listarPSalidaPaginated = response.data.datos;
                        this.setListtempPSalida();
                        this.setLimpiaDetalleProducto();
                    }
                });
        },
        getListAlmacen() {
            var url = "/administracion/almacen/listAlmacen";
            axios.get(url).then((response) => {
                this.listAlmacen = response.data;
                this.fillPSalida.nIdAlmacen = this.listAlmacen[1].id;
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
                    // this.fillregistrarCotizacion.nIdprod = '';

                    //console.log(item);
                });
        },

        setGrabarPSalida() {
            var url = "/administracion/parteingSalida/saveParteSalida";
            axios
                .post(url, {
                    nIdCliente: this.fillPSalida.nIdCliente,
                    nroFactura: this.fillPSalida.nroFactura,
                    nroguia: this.fillPSalida.cNroGuia,
                    nIdMotivo: this.fillPSalida.nIdMotivo,
                    cfecha: this.fillPSalida.cFecha,
                    cobservacion: this.fillPSalida.cObservacion,
                    nIdUser: this.fillPSalida.nIdUser,
                    nIdAlmacen: this.fillPSalida.nIdAlmacen,
                })
                .then((response) => {
                    Swal.fire({
                        position: "center",
                        icon: response.data.icon,
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    this.limpiarDetallePSalida();
                    this.eliminarTempitemPSalida();
                });
        },
        abrirModal() {
            this.modalShow = !this.modalShow;
        },

        abrirModalCantidad() {
            this.modalCantidad = !this.modalCantidad;
        },
        validaPIngreso() {
            this.error = 0;
            this.mensajeError = [];

            if (!this.fillPSalida.nroFactura) {
                this.mensajeError.push("El campo Factura es obligatorio");
            }
            if (!this.fillPSalida.cNroGuia) {
                this.mensajeError.push("El campo Nro Guia es obligatorio");
            }

            if (!this.fillPSalida.nIdMotivo) {
                this.mensajeError.push("El Campo Motivo es obligatorio");
            }

            if (this.mensajeError.length) {
                this.error = 1;
            }

            return this.error;
        },

        limpiarDetallePSalida() {
            this.fillPSalida.nIdCliente = " ";
            this.fillPSalida.nroFactura = "";
            this.fillPSalida.cNroGuia = "";
            this.fillPSalida.cObservacion = "";
            this.fillPSalida.nIdMotivo = "";
            this.fillPSalida.nIdprod = "";
            this.fillPSalida.cCantidad = "";
            this.fillPSalida.cStock = "";
        },

        setLimpiaDetalleProducto() {
            this.fillPSalida.nIdprod = "";
            this.fillPSalida.cCantidad = "";
            this.fillPSalida.cStock = "";
        },

        setListtempPSalida() {
            var url = "/administracion/parte_salida/ListtempParteSalida";
            axios.get(url, {}).then((response) => {
                this.listarPSalidaPaginated = response.data.datos;
            });
        },

        eliminarTempitemPSalida() {
            var url = "/administracion/parte_salida/eliminarTempitemPSalida";
            axios.post(url).then((response) => {
                this.setListtempPSalida();
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
                });
        },
        setSelectMovimiento() {
            this.fillPSalida.nIdMotivo = "";
            this.getListarMotivo(2);
        },

        getListarproductosByName() {
            var url = "/administracion/detallecotizancion/listProdByName";
            axios
                .get(url, {
                    params: {
                        nIdprod: this.fillPSalida.nIdprod,
                    },
                })
                .then((response) => {
                    this.listProd = response.data;
                });
        },

        getListarUnidadMedida() {
            var url = "/administracion/KardexDetalle/listUnidMed";
            axios.get(url).then((response) => {
                this.listUnidMed = response.data;
                this.fillPSalida.nIdUnidMed = this.listUnidMed[3].id;
            });
        },

        getBuscaStockProducto() {
          var url = "/administracion/parteingSalida/StockProductByAlmacen"; 
            axios
                .post(url, {
                    nIdprod: this.fillPSalida.nIdprod,
                    nIdAlmacen: this.fillPSalida.nIdAlmacen
                })
                .then((response) => {
                  console.log(response.data[0].cantidad)

                  if(response.data[0].cantidad === ''){
                    console.log('vacio')
                  }
      

                  
                });

        },
        setResetCampos() {
            var url = "/administracion/tempcotizacion/eliminarTempitemCoti";
            axios.post(url).then((response) => {
                //this.setListtempCotizacion();
                this.listarPSalidaPaginated = response.data.datos;
            });
        },
    },


};
</script>

<style></style>
