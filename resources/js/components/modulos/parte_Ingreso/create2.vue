<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Parte de Ingreso</h1>
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
                                                        class="col-md-3 col-form-label"
                                                        >Tipo de Orden</label
                                                    >
                                                    <div class="col-md-6">
                                                        <el-select
                                                            v-model="
                                                                fillPIngreso.nIdTipOrden
                                                            "
                                                            placeholder="Seleccione"
                                                            @change="
                                                                getListarNew()
                                                            "
                                                        >
                                                            <el-option
                                                                v-for="item in options"
                                                                :key="
                                                                    item.value
                                                                "
                                                                :label="
                                                                    item.label
                                                                "
                                                                :value="
                                                                    item.value
                                                                "
                                                            >
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        v-if="fillPIngreso.nIdTipOrden === 'C'"
                                        class="col-md-12"
                                    >
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-3 col-form-label"
                                                        >Orden Compra</label
                                                    >
                                                    <div class="col-md-6">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPIngreso.cOrdenComPra
                                                            "
                                                            :disabled="
                                                                this
                                                                    .estadoCodOrd
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <div
                                                            class="btn-toolbar"
                                                            role="toolbar"
                                                            aria-label="Toolbar with button groups"
                                                        >
                                                            <div
                                                                class="btn-group mr-2"
                                                                role="group"
                                                                aria-label="First group"
                                                            >
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-primary mr-2"
                                                                    @click.prevent="
                                                                        getListarOrdenCompra
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-search"
                                                                    ></i>
                                                                </button>

                                                                <button
                                                                    type="button"
                                                                    class="btn btn-success"
                                                                    @click.prevent="
                                                                        getListarNew
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-undo"
                                                                    ></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12" v-else>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-3 col-form-label"
                                                        >Orden Servicio</label
                                                    >
                                                    <div class="col-md-6">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPIngreso.cOrdenServicio
                                                            "
                                                            :disabled="
                                                                this
                                                                    .estadoCodOrd
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <div
                                                            class="btn-toolbar"
                                                            role="toolbar"
                                                            aria-label="Toolbar with button groups"
                                                        >
                                                            <div
                                                                class="btn-group mr-2"
                                                                role="group"
                                                                aria-label="First group"
                                                            >
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-primary mr-2"
                                                                    @click.prevent="
                                                                        getListarOrdenServicio
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-search"
                                                                    ></i>
                                                                </button>

                                                                <button
                                                                    type="button"
                                                                    class="btn btn-success"
                                                                    @click.prevent="
                                                                        getListarNew
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-undo"
                                                                    ></i>
                                                                </button>
                                                            </div>
                                                        </div>
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
                                                        class="col-md-3 col-form-label"
                                                        >Proveedor</label
                                                    >
                                                    <div class="col-md-9">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPIngreso.cProveedor
                                                            "
                                                            @keypress.prevent.enter="
                                                                setRegistrarPIngresoOC
                                                            "
                                                            readonly="true"
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >Motivo</label
                                                    >
                                                    <div class="col-md-10">
                                                        <el-select
                                                            v-model="
                                                                fillPIngreso.nIdMotivo
                                                            "
                                                            placeholder="Select"
                                                        >
                                                            <el-option
                                                                v-for="item in listMotivo"
                                                                :key="item.id"
                                                                :label="
                                                                    item.nombre
                                                                "
                                                                :value="item.id"
                                                                :disabled="
                                                                    item.nombre ===
                                                                    'INGRESO DE MERCADERIA'
                                                                "
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
                                                        class="col-md-3 col-form-label"
                                                        >Nro Factura</label
                                                    >
                                                    <div class="col-md-4">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPIngreso.nroFactura
                                                            "
                                                            @keypress.prevent.enter="
                                                                setRegistrarPIngresoOC
                                                            "
                                                            style="width: 30vh"
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-3 col-form-label"
                                                        >Nro Guia</label
                                                    >
                                                    <div class="col-md-7">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPIngreso.cNroGuia
                                                            "
                                                            @keypress.prevent.enter="
                                                                setRegistrarPIngresoOC
                                                            "
                                                            style="width: 30vh"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12"></div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >Observación</label
                                                    >
                                                    <div class="col-md-10">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPIngreso.cObservacion
                                                            "
                                                     
                                                        />
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
                                                                fillPIngreso.nIdAlmacen
                                                            "
                                                            placeholder="Select"
                                                            style="width: 70%"
                                                        >
                                                            <el-option
                                                                v-for="item in listAlmacen"
                                                                :key="item.id"
                                                                :label="
                                                                    item.nombre
                                                                "
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
                                    </div>
                                </form>
                            </div>

                            <!--  Bandeja de Resultados Ordenes de Compra -->
                            <div
                                class="card card-info"
                                v-if="fillPIngreso.nIdTipOrden === 'C'"
                            >
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Bandeja de Ordenes de Compra
                                    </h3>
                                </div>

                                <div class="card-body table-responsive">
                                    <table
                                        class="table table-hover table-head-fixed text-nowrap projects"
                                    >
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descripcion</th>
                                                <th>Cant. OrdCompra</th>
                                                <th>Cant. Total</th>
                                                <th>Cantidad Ingresada</th>

                                                <th>Unid. Medida</th>
                                                <th>Estado</th>
                                                <th>Cantidad</th>
                                                <th>Agregar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    item, index
                                                ) in listordenCompraFilter"
                                                :key="index"
                                            >
                                                <td
                                                    v-text="
                                                        item.producto_codigo
                                                    "
                                                ></td>
                                                <td
                                                    v-text="item.producto_desc"
                                                ></td>

                                                <td v-text="item.cantidad"></td>
                                                <td
                                                    v-text="item.cantidadKardex"
                                                ></td>

                                                <td v-text="item.canting"></td>

                                                <td
                                                    v-text="
                                                        item.unidmedida_nombre
                                                    "
                                                ></td>

                                                <td
                                                    v-if="
                                                        parseInt(
                                                            item.cantidad
                                                        ) !==
                                                        parseInt(
                                                            item.cantidadKardex
                                                        )
                                                    "
                                                >
                                                    Pendiente
                                                </td>
                                                <td v-else>Completo</td>

                                                <template
                                                    v-if="
                                                        parseInt(
                                                            item.cantidad
                                                        ) ==
                                                        parseInt(
                                                            item.cantidadKardex
                                                        )
                                                    "
                                                >
                                                    <td>
                                                        <!--           <button
                                                            class="btn btn-flat btn-danger btn-sm"
                                                            @click.prevent="
                                                                setValorCantModalOC(
                                                                    item.iddetalleOrdenCompra
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="far fa-edit"
                                                            ></i>
                                                            Cantidad
                                                        </button> -->
                                                    </td>

                                                    <td
                                                        v-if="
                                                            parseInt(
                                                                item.cantidad
                                                            ) !==
                                                            parseInt(
                                                                item.cantidadKardex
                                                            )
                                                        "
                                                    >
                                                        <el-checkbox
                                                            v-if="
                                                                parseInt(
                                                                    item.cantidad
                                                                ) !==
                                                                parseInt(
                                                                    item.cantidadKardex
                                                                )
                                                            "
                                                            @change="
                                                                marcarFila(
                                                                    index,
                                                                    item.iddetalleOrdenCompra,
                                                                    item.cantidadKardex
                                                                )
                                                            "
                                                            v-model="
                                                                item.checked
                                                            "
                                                            >Seleccionar</el-checkbox
                                                        >
                                                    </td>
                                                </template>

                                                <template v-else>
                                                    <td>
                                                        <button
                                                            class="btn btn-flat btn-danger btn-sm"
                                                            @click.prevent="
                                                                setValorCantModalOC(
                                                                    item.iddetalleOrdenCompra
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="far fa-edit"
                                                            ></i>
                                                            Cantidad
                                                        </button>
                                                    </td>

                                                    <td
                                                        v-if="
                                                            parseInt(
                                                                item.cantidad
                                                            ) !==
                                                            parseInt(
                                                                item.cantidadKardex
                                                            )
                                                        "
                                                    >
                                                        <el-checkbox
                                                            v-if="
                                                                parseInt(
                                                                    item.cantidad
                                                                ) !==
                                                                parseInt(
                                                                    item.cantidadKardex
                                                                )
                                                            "
                                                            @change="
                                                                marcarFila(
                                                                    index,
                                                                    item.iddetalleOrdenCompra,
                                                                    item.cantidadKardex
                                                                )
                                                            "
                                                            v-model="
                                                                item.checked
                                                            "
                                                            >Seleccionar</el-checkbox
                                                        >
                                                    </td>
                                                </template>

                                                <!--  <td v-text="item.estado"></td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Fin  Bandeja de Resultados Ordenes de Compra -->

                            <!--  Bandeja de Resultados Ordenes de Servicio -->
                            <div
                                class="card card-info"
                                v-if="fillPIngreso.nIdTipOrden === 'S'"
                            >
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Bandeja de Ordenes de Servicio
                                    </h3>
                                </div>

                                <div class="card-body table-responsive">
                                    <table
                                        class="table table-hover table-head-fixed text-nowrap projects"
                                    >
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descripcion</th>
                                                <th>Cant. OrdCompra</th>
                                                <th>Cant. Total</th>
                                                <th>Cantidad Ingresada</th>

                                                <th>Unid. Medida</th>
                                                <th>Estado</th>
                                                <th>Cantidad</th>
                                                <th>Agregar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    item, index
                                                ) in listordenServicioFilter"
                                                :key="index"
                                            >
                                                <td
                                                    v-text="
                                                        item.producto_codigo
                                                    "
                                                ></td>
                                                <td
                                                    v-text="item.producto_desc"
                                                ></td>

                                                <td v-text="item.cantidad"></td>
                                                <td
                                                    v-text="item.cantidadKardex"
                                                ></td>

                                                <td v-text="item.canting"></td>

                                                <td
                                                    v-text="
                                                        item.unidmedida_nombre
                                                    "
                                                ></td>

                                                <td
                                                    v-if="
                                                        parseInt(
                                                            item.cantidad
                                                        ) !==
                                                        parseInt(
                                                            item.cantidadKardex
                                                        )
                                                    "
                                                >
                                                    Pendiente
                                                </td>
                                                <td v-else>Completo</td>

                                                <template
                                                    v-if="
                                                        parseInt(
                                                            item.cantidad
                                                        ) ==
                                                        parseInt(
                                                            item.cantidadKardex
                                                        )
                                                    "
                                                >
                                                    <td>
                                                        <!--           <button
                                                            class="btn btn-flat btn-danger btn-sm"
                                                            @click.prevent="
                                                                setValorCantModalOC(
                                                                    item.iddetalleOrdenCompra
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="far fa-edit"
                                                            ></i>
                                                            Cantidad
                                                        </button> -->
                                                    </td>

                                                    <td
                                                        v-if="
                                                            parseInt(
                                                                item.cantidad
                                                            ) !==
                                                            parseInt(
                                                                item.cantidadKardex
                                                            )
                                                        "
                                                    >
                                                        <el-checkbox
                                                            v-if="
                                                                parseInt(
                                                                    item.cantidad
                                                                ) !==
                                                                parseInt(
                                                                    item.cantidadKardex
                                                                )
                                                            "
                                                            @change="
                                                                marcarFila(
                                                                    index,
                                                                    item.iddetalleOrdenServicio,
                                                                    item.cantidadKardex
                                                                )
                                                            "
                                                            v-model="
                                                                item.checked
                                                            "
                                                            >Seleccionar</el-checkbox
                                                        >
                                                    </td>
                                                </template>

                                                <template v-else>
                                                    <td>
                                                        <button
                                                            class="btn btn-flat btn-danger btn-sm"
                                                            @click.prevent="
                                                                setValorCantModalOS(
                                                                    item.iddetalleOrdenServicio
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="far fa-edit"
                                                            ></i>
                                                            Cantidad
                                                        </button>
                                                    </td>

                                                    <td
                                                        v-if="
                                                            parseInt(
                                                                item.cantidad
                                                            ) !==
                                                            parseInt(
                                                                item.cantidadKardex
                                                            )
                                                        "
                                                    >
                                                        <el-checkbox
                                                            v-if="
                                                                parseInt(
                                                                    item.cantidad
                                                                ) !==
                                                                parseInt(
                                                                    item.cantidadKardex
                                                                )
                                                            "
                                                            @change="
                                                                marcarFila(
                                                                    index,
                                                                    item.iddetalleOrdenCompra,
                                                                    item.cantidadKardex
                                                                )
                                                            "
                                                            v-model="
                                                                item.checked
                                                            "
                                                            >Seleccionar</el-checkbox
                                                        >
                                                    </td>
                                                </template>

                                                <!--  <td v-text="item.estado"></td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Fin  Bandeja de Resultados Ordenes de Servicio -->

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button
                                            class="btn btn-flat btn-info btnWidth"
                                            @click.prevent="
                                                setRegistrarPIngresoOC
                                            "
                                        >
                                            Guardar
                                        </button>
                                        <button
                                            class="btn btn-flat btn-default btnWidth"
                                            @click.prevent="
                                                setResetOrdenCompras
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

        <!-- Modal de editar cantidad de Parte de Ingreso -->
        <div
            class="modal fade"
            :class="{ show: modalCantidad }"
            :style="modalCantidad ? mostrarModal : ocultarModal"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ingrese la cantidad</h5>
                        <button class="close" @click="abrirModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-9">
                            <input
                                type="text"
                                class="form-control"
                                v-model="fillPIngreso.cCantidadModal"
                                style="width: 300px"
                            />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <template v-if="fillPIngreso.nIdTipOrden === 'C'">
                            <button
                                class="btn btn-primary"
                                @click="setAddCantidadOc()"
                            >
                                Agregar
                            </button>
                        </template>
                        <template v-if="fillPIngreso.nIdTipOrden === 'S'">
                            <button
                                class="btn btn-primary"
                                @click="setAddCantidadOS()"
                            >
                                Agregar2
                            </button>
                        </template>

                        <button
                            class="btn btn-secondary"
                            @click="abrirModalCantidad()"
                        >
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--Fin del  Modal de editar cantidad de Parte de Ingreso -->
    </div>
</template>

<script>
import { Alert } from "element-ui";

export default {
    data() {
        return {
            fillPIngreso: {
                nIdOrdenCompra: this.$attrs.id,
                cProveedor: "",
                nIdProveedor: "",
                cOrdenComPra: "",
                cNroGuia: "",
                nroFactura: "",
                nIdAlmacen: "",
                cOrdenServicio: "",
                nIdTipOrden: "",

                cObservacion: "",
                nIdUser: sessionStorage.getItem("iduser"),
                nIdMotivo: "",
                cCantidadModal: "",
            },
            options: [
                {
                    value: "C",
                    label: "Orden de Compra",
                },
                {
                    value: "S",
                    label: "Orden de Servicio",
                },
            ],

            listarDetalleOrdeCompra: [],
            listarDetalleOrdeServicio: [],
            listordenCompraFilter: [],
            listordenServicioFilter: [],
            listMotivo: [],
            listAlmacen: [],
            estadoProv: false,
            estadoCliente: false,

            modalCantidad: false,

            modalShow: false,
            mostrarModal: {
                display: "block",
                background: "#0000006b",
            },

            estadoCodOrd: false,

            ocultarModal: {
                display: "none",
            },
            error: 0,
            mensajeError: [],
        };
    },
    mounted() {
        this.getListarMotivo();
        this.getListAlmacen();
        this.fillPIngreso.nIdTipOrden = "C";
        /*     this.getListarByProveedor();
    this.setListarDatosOrdenCompraXId();
    this.setListarDetalleOrdenCompraxId();
    this.setSelectMovimiento();

    this.setListtempPIngreso();
    this.fillPIngreso.cFecha = new Date(); */
    },
    computed: {},
    methods: {
        getListAlmacen() {
            var url = "/administracion/almacen/listAlmacen";
            axios.get(url).then((response) => {
                this.listAlmacen = response.data;
                this.fillPIngreso.nIdAlmacen = this.listAlmacen[1].id;
            });
        },

        getListarOrdenCompra() {
            var url = "/administracion/parteingSalida/ListarDatosOrdenCompra";
            axios
                .post(url, {
                    cOrdenComPra: this.fillPIngreso.cOrdenComPra,
                })
                .then((response) => {
                    this.fillPIngreso.cProveedor =
                        response.data[0].ordencompras.proveedor.nombre;

                    //console.log(response.data)
                    this.listarDetalleOrdeCompra = response.data;
                    this.listordenCompraFilter = [];
                    this.filtrarOrdenCompra();
                    this.estadoCodOrd = true;
                });
        },

        getListarOrdenServicio() {
            var url = "/administracion/parteingSalida/ListarDatosOrdenServicio";
            axios
                .post(url, {
                    cOrdenServicio: this.fillPIngreso.cOrdenServicio,
                })
                .then((response) => {
                    this.fillPIngreso.cProveedor =
                        response.data[0].ordenservicio.proveedor.nombre;
                    this.listarDetalleOrdeServicio = response.data;
                    this.listordenServicioFilter = [];
                    this.filtrarOrdenServicio();
                    this.estadoCodOrd = true;
                });
        },

        getListarOrdenCompraEstado() {
            var url = "/administracion/parteIngreso/ListarDatosOrdenCompra";
            axios
                .post(url, {
                    cOrdenComPra: this.fillPIngreso.cOrdenComPra,
                })
                .then((response) => {
                    //console.log(response.data)
                    this.listarDetalleOrdeCompra = response.data;
                    this.estadoCodOrd = true;
                });
        },

        getListarNew() {
            this.estadoCodOrd = false;
            this.listarDetalleOrdeCompra = [];
            this.fillPIngreso.cProveedor = "";
            this.fillPIngreso.cOrdenComPra = "";
            this.listordenCompraFilter = [];
        },

        getListarByProveedor() {
            var url = "/administracion/proveedor/getListarProveedorById";
            axios
                .get(url, {
                    params: {
                        nIdOrdenCompra: this.fillPIngreso.nIdOrdenCompra,
                    },
                })
                .then((response) => {
                    this.fillPIngreso.cProveedor = response.data.nombre;
                });
        },

        limpiarCriteriosBsq() {
            this.fillPIngreso.cProveedor = "";
        },
        setRegistrarPIngresoOC() {
            if (this.validaPIngreso()) {
                this.modalShow = true;
                return;
            }
           
            if(this.fillPIngreso.nIdTipOrden ==='C'){
                this.setGrabarPIngresoOc();
            }
            if(this.fillPIngreso.nIdTipOrden ==='S'){
                this.setGrabarPIngresoOs();
            }
        },



        setListarDatosOrdenCompraXId() {
            var url = "/administracion/ordenCompra/ListarDatosOrdenCompraXId";
            axios
                .post(url, {
                    nIdOrdenCompra: this.fillPIngreso.nIdOrdenCompra,
                })
                .then((response) => {
                    (this.fillPIngreso.cProveedor =
                        response.data.proveedor.nombre),
                        (this.fillPIngreso.nIdProveedor =
                            response.data.proveedor.id),
                        (this.fillPIngreso.cOrdenComPra =
                            this.fillPIngreso.nIdOrdenCompra
                                .toString()
                                .padStart(3, "000") +
                            "-" +
                            response.data.Femision.substr(0, 4));
                });
        },

        setGrabarPIngresoOc() {
            var url = "/administracion/parteingSalida/saveParteIngresoOC";
            axios
                .post(url, {
                    cOrdenComPra: this.fillPIngreso.cOrdenComPra,
                    nroFactura: this.fillPIngreso.nroFactura,
                    nroguia: this.fillPIngreso.cNroGuia,
                    cobservacion: this.fillPIngreso.cObservacion,
                    nIdUser: this.fillPIngreso.nIdUser,
                    nIdMotivo: this.fillPIngreso.nIdMotivo,
                    listordenCompraFilter: this.listordenCompraFilter,
                    nIdAlmacen: this.fillPIngreso.nIdAlmacen,
                })
                .then((response) => {
                    Swal.fire({
                        position: "center",
                        icon: response.data.icon,
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    this.setResetOrdenCompras();
                    this.getListarOrdenCompra();
                });
        },



        setGrabarPIngresoOs() {
            
            var url = "/administracion/parteingSalida/saveParteIngresoOS";
            axios
                .post(url, {
                    cOrdenServicio: this.fillPIngreso.cOrdenServicio,
                    nroFactura: this.fillPIngreso.nroFactura,
                    nroguia: this.fillPIngreso.cNroGuia,
                    cobservacion: this.fillPIngreso.cObservacion,
                    nIdUser: this.fillPIngreso.nIdUser,
                    nIdMotivo: this.fillPIngreso.nIdMotivo,
                    listordenCompraFilter: this.listordenServicioFilter,
                    nIdAlmacen: this.fillPIngreso.nIdAlmacen,
                })
                .then((response) => {
                    Swal.fire({
                        position: "center",
                        icon: response.data.icon,
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    this.setResetOrdenCompras();
                    this.getListarOrdenCompra();
                }); 
        },
        abrirModal() {
            this.modalShow = !this.modalShow;
        },

        setValorCantModalOC(item) {
            var url =
                "/administracion/DetalleordenCompra/setMandarValorDetalleParteIngresoXId";
            axios
                .post(url, {
                    item: item,
                })
                .then((response) => {
                    this.fillPIngreso.cCantidadModal =
                        response.data.cantidadKardex;
                    sessionStorage.item = response.data.id;
                    this.abrirModalCantidad();
                });
        },

        setValorCantModalOS(item) {
            var url =
                "/administracion/DetalleOrdenservicio/setMandarValorDetalleParteSalidaXId";
            axios
                .post(url, {
                    item: item,
                })
                .then((response) => {
                    this.fillPIngreso.cCantidadModal =
                        response.data.cantidadKardex;
                    sessionStorage.item = response.data.id;
                    this.abrirModalCantidad();
                });
        },

        setAddCantidadOc() {
            var url =
                "/administracion/DetalleordenCompra/setAddCantidadParteIngre";
            axios
                .post(url, {
                    item: sessionStorage.item,
                    cCantidadModal: this.fillPIngreso.cCantidadModal,
                })
                .then((response) => {
                    //console.log(response)
                    Swal.fire({
                        position: "center",
                        icon: response.data.icon,
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    this.abrirModalCantidad();
                    this.getListarOrdenCompra();
                    sessionStorage.removeItem(item);
                });
        },

        setAddCantidadOS() {
            var url =
                "/administracion/DetalleOrdenservicio/setAddCantidadParteSali";
            axios
                .post(url, {
                    item: sessionStorage.item,
                    cCantidadModal: this.fillPIngreso.cCantidadModal,
                })
                .then((response) => {
                    //console.log(response)
                    Swal.fire({
                        position: "center",
                        icon: response.data.icon,
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    this.abrirModalCantidad();
                    this.getListarOrdenServicio();
                    sessionStorage.removeItem(item);
                });
        },

        abrirModalCantidad() {
            this.modalCantidad = !this.modalCantidad;
        },
        validaPIngreso() {
            this.error = 0;
            this.mensajeError = [];

            if (!this.fillPIngreso.nIdMotivo) {
                this.mensajeError.push("El Campo Motivo es obligatorio");
            }

            if (!this.fillPIngreso.nroFactura) {
                this.mensajeError.push("El Nro de Factura es obligatorio");
            }

            if (this.mensajeError.length) {
                this.error = 1;
            }

            return this.error;
        },

        setResetOrdenCompras() {
            this.fillPIngreso.nroFactura = "";
            this.fillPIngreso.cNroGuia = "";
            this.fillPIngreso.cObservacion = "";
            this.fillPIngreso.nIdMotivo = "";
            this.fillPIngreso.cProveedor = "";
            this.fillPIngreso.cOrdenComPra = "";
            this.fillPIngreso.cOrdenServicio = "";

            this.listordenCompraFilter = [];
            this.listordenServicioFilter = [];
        },

        setListtempPIngreso() {
            var url = "/administracion/parte_ingreso/ListtempParteIngreso";
            axios.get(url, {}).then((response) => {
                this.listartempPIngreso = response.data.datos;
            });
        },

        eliminarTempitemPIngreso() {
            var url = "/administracion/parte_ingreso/eliminarTempitemPIngreso";
            axios.post(url).then((response) => {
                this.setListtempPIngreso();
            });
        },

        setListarDetalleOrdenCompraxId() {
            var url = "/administracion/DetalleordenCompra/view";
            axios
                .get(url, {
                    params: {
                        item: this.fillPIngreso.nIdOrdenCompra,
                    },
                })
                .then((response) => {
                    this.listarDetalleOrdeCompra = response.data;
                });
        },
        setCambiarEstadoDetalleOC(op, id) {
            //alert(id)

            Swal.fire({
                title:
                    "Estas seguro de" +
                    (op == 1 ? "Poner Pendiente" : "Poner Completo"),
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText:
                    op == 1 ? "Si,Poner Pendiente " : "Si,  Poner Completo",
            }).then((result) => {
                if (result.isConfirmed) {
                    var url =
                        "/administracion/parteIngreso/CambiarEstadoDetalleOC";
                    axios
                        .post(url, {
                            nIdOC: id,
                            cEstado: op,
                        })
                        .then((response) => {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Se edito el cambio",
                                showConfirmButton: true,
                                timer: 1500,
                            });

                            this.getListarOrdenCompraEstado();
                            //this.setListarDetalleOrdenCompraxId();
                        });
                }
            });
        },

        marcarFila(index, iddetalleOrdenCompra, cantidadKardex, grabado) {
            this.listordenCompraFilter.map(function (x, y) {
                var url = "/administracion/DetalleordenCompra/editCantComplete";

                axios
                    .post(url, {
                        iddetalleOrdenCompra,
                        cantidadKardex,
                        checked: x.checked,
                    })
                    .then((response) => {
                        x.checked = false;
                    });
            });
            this.getListarOrdenCompra();
        },

        filtrarOrdenCompra() {
            let me = this;
            me.listarDetalleOrdeCompra.map(function (x, y) {
                me.listordenCompraFilter.push({
                    producto_id: x.producto.id,
                    producto_codigo: x.producto.codigo,
                    cantidad: x.cantidad,
                    cantidadKardex: x.cantidadKardex,
                    canting: x.canting,
                    unidmedida_nombre: x.unidmedida.nombre,
                    unidmedida_id: x.unidmedida.id,
                    producto_desc:
                        x.producto.familia.nombre +
                        " " +
                        x.producto.subfamilia.nombre +
                        ", MARCA :" +
                        x.producto.marca.nombre +
                        ", MODELO/TIPO :" +
                        x.producto.modelotipo.nombre +
                        ", MATERIAL :" +
                        x.producto.material.nombre,
                    estado: x.estado,
                    punit: x.punit,
                    iddetalleOrdenCompra: x.id,
                    grabado: x.grabado,
                    //checked: false,
                });
            });
        },

        filtrarOrdenServicio() {
            let me = this;
            me.listarDetalleOrdeServicio.map(function (x, y) {
                me.listordenServicioFilter.push({
                    producto_id: x.producto.id,
                    producto_codigo: x.producto.codigo,
                    cantidad: x.cantidad,
                    cantidadKardex: x.cantidadKardex,
                    canting: x.canting,
                    unidmedida_nombre: x.unidmedida.nombre,
                    unidmedida_id: x.unidmedida.id,
                    producto_desc:
                        x.producto.familia.nombre +
                        " " +
                        x.producto.subfamilia.nombre +
                        ", MARCA :" +
                        x.producto.marca.nombre +
                        ", MODELO/TIPO :" +
                        x.producto.modelotipo.nombre +
                        ", MATERIAL :" +
                        x.producto.material.nombre,
                    estado: x.estado,
                    punit: x.punit,
                    iddetalleOrdenServicio: x.id,
                    grabado: x.grabado,
                    //checked: false,
                });
            });
        },

        getListarMotivo(idMovimiento) {
            var url = "/administracion/KardexDetalle/listMotivo";
            axios
                .get(url, {
                    params: {
                        idMovimiento: 1,
                    },
                })
                .then((response) => {
                    this.listMotivo = [];
                    this.listMotivo = response.data;
                });
        },
        setSelectMovimiento() {
            this.fillPIngreso.nIdMotivo = "";
            this.getListarMotivo(1);
        },
    },
};
</script>

<style></style>
