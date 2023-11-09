<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="float-right">
                <router-link
                    class="btn btn-info btn-sm"
                    :to="'/cotizacion/index'"
                >
                    <i class="fas fa-angle-double-left"></i> Regresar
                </router-link>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>
                        Cotizacion Nro :
                        {{ this.fillEditarProducto.ncodCotizacion | fourchar }}
                    </h3>
                    <h1 class="m-0 text-dark">Editar Cotizacion</h1>
                </div>
            </div>
        </div>

        <div class="content container-fluid">
            <div class="card-body">
                <form role="form">
                    <div class="row">
                        <!-- FORMULARIO CLIENTES  -->
                        <div class="col-md-7">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">CLIENTES</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label"
                                            >SEÑORES</label
                                        >
                                        <div class="col-md-8">
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    fillEditarProducto.cNomClient
                                                "
                                                :readonly="true"
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label"
                                            >DIRECCION</label
                                        >
                                        <div class="col-md-10">
                                            <input
                                                type="text"
                                                class="form-control"
                                                :readonly="true"
                                                v-model="
                                                    fillEditarProducto.cDirClient
                                                "
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label"
                                            >RUC</label
                                        >
                                        <div class="col-md-8">
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    fillEditarProducto.cRucClient
                                                "
                                                :readonly="true"
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label"
                                            >ATENCION</label
                                        >
                                        <div class="col-md-8">
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    fillEditarProducto.cAtencion
                                                "
                                                :readonly="true"
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label"
                                            >TELEFONO</label
                                        >
                                        <div class="col-md-8">
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    fillEditarProducto.cFonoClient
                                                "
                                                :readonly="true"
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label"
                                            >EMAIL</label
                                        >
                                        <div class="col-md-8">
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    fillEditarProducto.cEmail
                                                "
                                                :readonly="true"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FIN DEL FORMULARIO CLIENTES  -->

                        <!-- FORMULARIO VENDEDOR  -->
                        <div class="col-md-5">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">VENDEDOR</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"
                                            >VENDEDOR</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                :readonly="true"
                                                v-model="
                                                    fillEditarProducto.cVendedor
                                                "
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"
                                            >CELULAR</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                :readonly="true"
                                                v-model="
                                                    fillEditarProducto.cCeluVendedor
                                                "
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"
                                            >CENTRAL</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                :readonly="true"
                                                v-model="
                                                    fillEditarProducto.cCentral
                                                "
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"
                                            >EMAIL</label
                                        >
                                        <div class="col-md-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                :readonly="true"
                                                v-model="
                                                    fillEditarProducto.cEmailVendedor
                                                "
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FIN DEL FORMULARIO VENDEDOR  -->

                        <!-- CONDICIONES COMERCIALES -->
                        <div class="content container-fluid">
                            <form role="form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    CONDICIONES COMERCIALES
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >VALIDEZ DE
                                                        OFERTA</label
                                                    >
                                                    <div class="col-md-3">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillEditarProducto.cValidez
                                                            "
                                                        />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >ENTREGA</label
                                                    >
                                                    <div class="col-md-8">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillEditarProducto.cEntrega
                                                            "
                                                        />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >TIPO DE PAGO</label
                                                    >
                                                    <div class="col-md-4">
                                                        <el-select
                                                            v-model="
                                                                fillEditarProducto.nIdTipoPago
                                                            "
                                                            placeholder="Select"
                                                            style="width: 70%"
                                                        >
                                                            <el-option
                                                                v-for="item in listTipoPago"
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

                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >DESCRIPCION DEL
                                                        PAGO</label
                                                    >
                                                    <div class="col-md-4">
                                                        <el-select
                                                            v-model="
                                                                fillEditarProducto.nIdDescripPago
                                                            "
                                                            placeholder="Select"
                                                            style="width: 70%"
                                                        >
                                                            <el-option
                                                                v-for="item in listDescripPago"
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

                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >FLETE</label
                                                    >
                                                    <div class="col-md-8">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillEditarProducto.cFlete
                                                            "
                                                        />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >DOCUMENTACION</label
                                                    >
                                                    <div class="col-md-8">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillEditarProducto.Docu
                                                            "
                                                        />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >GARANTIA</label
                                                    >
                                                    <div class="col-md-4">
                                                        <el-select
                                                            v-model="
                                                                fillEditarProducto.nIdGarantia
                                                            "
                                                            placeholder="Select"
                                                            style="width: 70%"
                                                        >
                                                            <el-option
                                                                v-for="item in listGarantia"
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

                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >OBSERVACION</label
                                                    >
                                                    <div class="col-md-8">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillEditarProducto.cObservacion
                                                            "
                                                            :maxlength="255"
                                                        />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >PUNTO DE LLEGADA
                                                        CONSIGNADO :</label
                                                    >
                                                    <div class="col-md-8">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillEditarProducto.cPuntoLlegada
                                                            "
                                                            :maxlength="100"
                                                        />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >EMP. DE
                                                        TRANSPORTE</label
                                                    >
                                                    <div class="col-md-8">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillEditarProducto.cTransporte
                                                            "
                                                        />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >CONSIGNADO</label
                                                    >
                                                    <div class="col-md-8">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillEditarProducto.Cconsignado
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

                        <!-- FIN DE CONDICIONES COMERCIALES -->

                        <!-- ITEMS DE PRODUCTOS -->
                        <div class="content container-fluid">
                            <form role="form">
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
                                                        fillEditarProducto.cCantidad
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label
                                                class="col-md-2 col-form-label"
                                                >MEDIDA</label
                                            >
                                            <div class="col-md-4">
                                                <el-select
                                                    v-model="
                                                        fillEditarProducto.nIdUnidMed
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
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label
                                                class="col-md-2 col-form-label"
                                                >DESCRIPCION DEL MEDIDOR</label
                                            >

                                            <div class="col-md-9">
                                                <el-select
                                                    v-model="
                                                        fillEditarProducto.nIdprod
                                                    "
                                                    style="width: 90%"
                                                    filterable
                                                    placeholder="Select"
                                                    @change="
                                                        setBuscaPrecioXProducto()
                                                    "
                                                >
                                                    <el-option
                                                        v-for="item in listProd"
                                                        :key="item.id"
                                                        :label="
                                                            item.codigo +
                                                            ' - ' +
                                                            item.familia
                                                                .nombre +
                                                            ' , ' +
                                                            item.subfamilia
                                                                .nombre +
                                                            ' , Modelo: ' +
                                                            item.modelotipo
                                                                .nombre +
                                                            ' , Marca : ' +
                                                            item.marca.nombre +
                                                            ' , Material : ' +
                                                            item.material
                                                                .nombre +
                                                            ' ,' +
                                                            item.homologacion
                                                                .nombre
                                                        "
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
                                                >P/UNIT</label
                                            >
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        fillEditarProducto.cPUnit
                                                    "
                                                    :onchange="
                                                        this.setCalculaTotal()
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label
                                                class="col-md-2 col-form-label"
                                                >TOTAL S/IGV</label
                                            >
                                            <div class="col-md-4">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        fillEditarProducto.cTotal
                                                    "
                                                    :readonly="true"
                                                    :onchange="
                                                        this.setCalculaTotal()
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
                                                @click.prevent="
                                                    setAddTempCotizacion
                                                "
                                            >
                                                Agregar
                                            </button>
                                            <button
                                                class="btn btn-flat btn-default btnWidth"
                                                @click.prevent="
                                                    limpiarCotizacionBsq
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
                                                    <th>ITEM</th>
                                                    <th>CANT</th>
                                                    <th>MEDIDA</th>
                                                    <th>CODIGO</th>
                                                    <th>
                                                        DESCRIPCION DEL PRODUCTO
                                                    </th>
                                                    <th>HOMOLOGADO</th>
                                                    <th>P/UNIT</th>
                                                    <th>TOTAL S/IGV</th>
                                                    <!-- <th>Acciones</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="(
                                                        item, index
                                                    ) in listDetCotizacion"
                                                    :key="index"
                                                >
                                                    <td v-text="index + 1"></td>
                                                    <td
                                                        v-text="item.cantidad"
                                                    ></td>
                                                    <td
                                                        v-text="
                                                            item.unidmedida
                                                                .nombre
                                                        "
                                                    ></td>
                                                    <td
                                                        v-text="
                                                            item.producto.codigo
                                                        "
                                                    ></td>
                                                    <td
                                                        v-text="
                                                            item.producto
                                                                .familia
                                                                .nombre +
                                                            ' ' +
                                                            item.producto
                                                                .subfamilia
                                                                .nombre +
                                                            ', MARCA :' +
                                                            item.producto.marca
                                                                .nombre +
                                                            ', MODELO/TIPO :' +
                                                            item.producto
                                                                .modelotipo
                                                                .nombre +
                                                            ', MATERIAL :' +
                                                            item.producto
                                                                .material.nombre
                                                        "
                                                    ></td>
                                                    <td
                                                        v-text="
                                                            item.producto
                                                                .homologacion
                                                                .nombre
                                                        "
                                                    ></td>
                                                    <td
                                                        v-text="item.punit"
                                                    ></td>
                                                    <td>
                                                        {{
                                                            (item.cantidad *
                                                                item.punit)
                                                                | formatPrice
                                                        }}
                                                    </td>
                                                    <td>
                                                        <button
                                                            class="btn btn-danger btn-sm"
                                                            @click.prevent="
                                                                borradoItems(
                                                                    item.id
                                                                )
                                                            "
                                                        >
                                                            <span
                                                                ><i
                                                                    class="far fa-trash-alt"
                                                                ></i
                                                            ></span>
                                                            Eliminar
                                                        </button>

                                                        <button
                                                            class="btn btn-primary btn-sm"
                                                            @click.prevent="
                                                                EditarItems(
                                                                    item.id
                                                                )
                                                            "
                                                        >
                                                            <span
                                                                ><i
                                                                    class="far fa-edit"
                                                                ></i
                                                            ></span>
                                                            Editar
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
                                                        setEditCotizacion
                                                    "
                                                >
                                                    Guardar
                                                </button>
                                                <button
                                                    class="btn btn-flat btn-default btnWidth"
                                                    @click.prevent="
                                                        eliminarTempitemCoti
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
                        <!--  FIN DE ITEMS DE PRODUCTOS -->
                    </div>
                </form>
            </div>
        </div>

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

        <div
            class="modal fade"
            :class="{ show: modalShowEditItem }"
            :style="modalShowEditItem ? mostrarModal : ocultarModal"
        >
            <div class="modal-editcotitem modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Cotización</h5>
                        <button
                            class="close"
                            @click="abrirModalEditItem"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="content container-fluid">
                            <form role="form">
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
                                                        fillEditarProducto.cCantidadEdit
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label
                                                class="col-md-2 col-form-label"
                                                >MEDIDA</label
                                            >
                                            <div class="col-md-4">
                                                <el-select
                                                    v-model="
                                                        fillEditarProducto.nIdUnidMedEdit
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
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label
                                                class="col-md-2 col-form-label"
                                                >DESCRIPCION DEL MEDIDOR</label
                                            >

                                            <div class="col-md-9">
                                                <el-select
                                                    v-model="
                                                        fillEditarProducto.nIdprodEdit
                                                    "
                                                    style="width: 90%"
                                                    filterable
                                                    placeholder="Select"
                                                    @change="
                                                        setBuscaPrecioXProductoModal()
                                                    "
                                                >
                                                    <el-option
                                                        v-for="item in listProd"
                                                        :key="item.id"
                                                        :label="
                                                            item.codigo +
                                                            ' - ' +
                                                            item.familia
                                                                .nombre +
                                                            ' , ' +
                                                            item.subfamilia
                                                                .nombre +
                                                            ' , Modelo: ' +
                                                            item.modelotipo
                                                                .nombre +
                                                            ' , Marca : ' +
                                                            item.marca.nombre +
                                                            ' , Material : ' +
                                                            item.material
                                                                .nombre +
                                                            ' ,' +
                                                            item.homologacion
                                                                .nombre
                                                        "
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
                                                >P/UNIT
                                            </label>
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        fillEditarProducto.cPUnitEdit
                                                    "
                                                    :onchange="
                                                        this.setCalculaTotalModal()
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label
                                                class="col-md-2 col-form-label"
                                                >TOTAL S/IGV</label
                                            >
                                            <div class="col-md-4">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        fillEditarProducto.cTotalEdit
                                                    "
                                                    :readonly="true"
                                                    :onchange="
                                                        this.setCalculaTotalModal()
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" @click="EditDatosItem">
                            Guardar
                        </button>
                        <button
                            class="btn btn-secondary"
                            @click="abrirModalEditItem"
                        >
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
            fillEditarProducto: {
                ncodCotizacion: this.$attrs.id,
                nIdUsuario: "",
                nIdDescripPago: "",
                nIdGarantia: "",
                cNomClient: "",
                cDirClient: "",
                cRucClient: "",
                cAtencion: "",
                cFonoClient: "",
                cCantidad: "",
                cPuntoLlegada: "",
                cTransporte: "",
                cEmail: "",
                cVendedor: "",
                cEmailVendedor: "",
                cCeluVendedor: "",
                cCentral: "01-2822376",
                vidUSer: "",
                nIdUnidMed: "",
                nIdTipoPago: "",
                nIdprod: "",
                cPUnit: "",
                cValidez: "",
                cEntrega: "",
                cFPago: "",
                cFlete: "",
                Docu: "",
                cGarantia: "",
                cTotal: "",
                cEstado: "",
                Cconsignado: "",
                cObservacion: "",
                cCantidadEdit: "",
                nIdUnidMedEdit: "",
                nIdprodEdit: " ",
                cPUnitEdit: "",
                cTotalEdit: "",
                ctipoPrecio: "",
            },

            listUnidMed: [],
            listTipoPago: [],
            listProd: [],
            listDescripPago: [],
            listGarantia: [],
            listDetCotizacion: [],

            listEditProductosPaginated: [],

            modalShow: false,
            modalShowEditItem: false,
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
        this.getClienteById();
        this.getListarTipoPago();
        this.getlistDescricionPago();
        this.getListGarantia();
        this.getListarUnidadMedida();
        this.getListarproductosByName();
        this.cargaDatosPredeterminados();
        this.getCargaCotizacionByCotizacion();

        /*
    this.setListtempCotizacion();
   */
    },

    methods: {
        getlistDescricionPago() {
            var url = "/administracion/pago/index";
            axios.get(url).then((response) => {
                this.listDescripPago = response.data;
            });
        },

        getListGarantia() {
            var url = "/administracion/garantia/index";
            axios.get(url).then((response) => {
                this.listGarantia = response.data;
            });
        },

        abrirModal() {
            this.modalShow = !this.modalShow;
        },

        abrirModalEditItem() {
            this.modalShowEditItem = !this.modalShowEditItem;
        },
        getClienteById() {
            var url = "/administracion/cliente/listGetClienteVendedor";
            axios
                .get(url, {
                    params: {
                        ncodCotizacion: this.fillEditarProducto.ncodCotizacion,
                    },
                })
                .then((response) => {
                    this.fillEditarProducto.cNomClient =
                        response.data.cliente.razonsocial;
                    this.fillEditarProducto.cDirClient =
                        response.data.cliente.direccion;
                    this.fillEditarProducto.cRucClient =
                        response.data.cliente.ruc;
                    this.fillEditarProducto.cAtencion =
                        response.data.cliente.atencion;
                    this.fillEditarProducto.cFonoClient =
                        response.data.cliente.telefono;
                    this.fillEditarProducto.cEmail =
                        response.data.cliente.email;
                    this.fillEditarProducto.cVendedor =
                        response.data.user.fullname;
                    this.fillEditarProducto.cEmailVendedor =
                        response.data.user.email;
                    this.fillEditarProducto.cCeluVendedor =
                        response.data.user.celular;
                    this.fillEditarProducto.cValidez =
                        response.data.validezoferta;
                    this.fillEditarProducto.cEntrega = response.data.Entrega;
                    this.fillEditarProducto.nIdTipoPago =
                        response.data.tipopago_id;
                    this.fillEditarProducto.nIdDescripPago =
                        response.data.pago_id;
                    this.fillEditarProducto.cFlete = response.data.flete;
                    this.fillEditarProducto.Docu = response.data.documentacion;
                    this.fillEditarProducto.nIdGarantia =
                        response.data.garantia_id;
                    this.fillEditarProducto.cPuntoLlegada =
                        response.data.punto_llegada;
                    this.fillEditarProducto.Cconsignado =
                        response.data.consignado;
                    this.fillEditarProducto.cTransporte =
                        response.data.transporte;
                    this.fillEditarProducto.cObservacion =
                        response.data.observacion;
                    this.fillEditarProducto.ctipoPrecio =
                        response.data.cliente.tipoPrecio;
                });
        },

        getCargaCotizacionByCotizacion() {
            var url = "/administracion/detallecotizancion/listDetCotizacionBy";
            axios
                .get(url, {
                    params: {
                        item: this.fillEditarProducto.ncodCotizacion,
                    },
                })
                .then((response) => {
                    this.listDetCotizacion = response.data;
                });
        },

        limpiarCotizacionBsq() {
            this.fillEditarProducto.cEntrega = "";
            this.fillEditarProducto.cValidez = "";
            this.fillEditarProducto.cFPago = "";
            this.fillEditarProducto.cFlete = "";
            this.fillEditarProducto.Docu = "";
            this.fillEditarProducto.cGarantia = "";
            this.fillEditarProducto.cCantidad = "";
            this.fillEditarProducto.cMedida = "";
            this.fillEditarProducto.cDescripcion = "";
            this.fillEditarProducto.cPUnit = "";
            this.fillEditarProducto.cTotal = "";
        },

        getListarUnidadMedida() {
            var url = "/administracion/KardexDetalle/listUnidMed";
            axios.get(url).then((response) => {
                this.listUnidMed = response.data;
                this.fillEditarProducto.nIdUnidMed = this.listUnidMed[7].id;
            });
        },

        getListarTipoPago() {
            var url = "/administracion/cotizacion/listTipoPago";
            axios.get(url).then((response) => {
                this.listTipoPago = response.data;
            });
        },

        getListarproductosByName() {
            var url = "/administracion/detallecotizancion/listProdByName";
            axios
                .get(url, {
                    params: {
                        nIdprod: this.fillEditarProducto.nIdprod,
                    },
                })
                .then((response) => {
                    this.listProd = response.data;
                });
        },

        setRegistrarCotizacion() {
            if (this.validarCotizacion()) {
                this.modalShow = true;
                return;
            }
            this.setAddTempCotizacion();
        },

        validarCotizacion() {
            this.error = 0;
            this.mensajeError = [];
            if (!this.fillEditarProducto.cValidez) {
                this.mensajeError.push(
                    "La validacion de Oferta es un campo obligatorio"
                );
            }
            if (!this.fillEditarProducto.cEntrega) {
                this.mensajeError.push(
                    "El Campo Entrega es un campo obligatorio"
                );
            }

            if (!this.fillEditarProducto.cFlete) {
                this.mensajeError.push(
                    "El Campo Flete es un campo obligatorio"
                );
            }
            if (!this.fillEditarProducto.Docu) {
                this.mensajeError.push(
                    "El Campo Documento es un campo obligatorio"
                );
            }

            if (!this.fillEditarProducto.cCantidad) {
                this.mensajeError.push(
                    "El Campo Cantidad es un campo obligatorio"
                );
            }

            if (!this.fillEditarProducto.nIdUnidMed) {
                this.mensajeError.push(
                    "El Campo Medida es un campo obligatorio"
                );
            }

            if (!this.fillEditarProducto.nIdprod) {
                this.mensajeError.push(
                    "El Campo Medidor es un campo obligatorio"
                );
            }

            if (!this.fillEditarProducto.cPUnit) {
                this.mensajeError.push(
                    "El Campo P.Unit es un campo obligatorio"
                );
            }

            if (this.mensajeError.length) {
                this.error = 1;
            }
            return this.error;
        },

        setAddTempCotizacion() {
            var url = "/administracion/cotizacion/addTempEditCotizacion";
            axios
                .post(url, {
                    item: this.fillEditarProducto.ncodCotizacion,
                    /*   cValidez: this.fillEditarProducto.cValidez,
          cEntrega: this.fillEditarProducto.cEntrega,
          nIdTipoPago: this.fillEditarProducto.nIdTipoPago,
          nIdDescripPago: this.fillEditarProducto.nIdDescripPago,
          cFlete: this.fillEditarProducto.cFlete,
          Docu: this.fillEditarProducto.Docu,
          nIdGarantia: this.fillEditarProducto.nIdGarantia, */
                    cCantidad: this.fillEditarProducto.cCantidad,
                    nIdUnidMed: this.fillEditarProducto.nIdUnidMed,
                    nIdprod: this.fillEditarProducto.nIdprod,
                    cPUnit: this.fillEditarProducto.cPUnit,
                })
                .then((response) => {
                    this.getCargaCotizacionByCotizacion();
                    (this.fillEditarProducto.cCantidad = ""),
                        (this.fillEditarProducto.nIdprod = ""),
                        (this.fillEditarProducto.cPUnit = "");
                });
        },
        setEditCotizacion() {
            var url = "/administracion/cotizacion/EditCotizacion";
            axios
                .post(url, {
                    ncodCotizacion: this.fillEditarProducto.ncodCotizacion,
                    nIdUsuario: this.fillEditarProducto.vidUSer,
                    cValidez: this.fillEditarProducto.cValidez,
                    cEntrega: this.fillEditarProducto.cEntrega,
                    nIdTipoPago: this.fillEditarProducto.nIdTipoPago,
                    nIdDescripPago: this.fillEditarProducto.nIdDescripPago,
                    cFPago: this.fillEditarProducto.cFPago,
                    cFlete: this.fillEditarProducto.cFlete,
                    Docu: this.fillEditarProducto.Docu,
                    nIdGarantia: this.fillEditarProducto.nIdGarantia,
                    cGarantia: this.fillEditarProducto.cGarantia,
                    cPuntoLlegada: this.fillEditarProducto.cPuntoLlegada,
                    Cconsignado: this.fillEditarProducto.Cconsignado,
                    cTransporte: this.fillEditarProducto.cTransporte,
                    cObservacion: this.fillEditarProducto.cObservacion,
                })
                .then((response) => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "El pedido ha sido grabado",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    this.eliminarTempitemCoti();
                });
        },

        setCargaDetalleCotizacionByCoti() {},

        setListtempCotizacion() {
            var url = "/administracion/tempcotizacion/ListtempCotizacion";
            axios.get(url, {}).then((response) => {
                this.listEditProductosPaginated = response.data.datos;
            });
        },
        eliminarTempitemCoti() {
            var url = "/administracion/tempcotizacion/eliminarTempitemCoti";
            axios.post(url).then((response) => {
                this.setListtempCotizacion();
            });
        },
        setCalculaTotal() {
            const a = parseFloat(this.fillEditarProducto.cCantidad);
            const b = parseFloat(this.fillEditarProducto.cPUnit);
            const c = a * b;
            this.fillEditarProducto.cTotal = parseFloat(c).toFixed(2);
        },

        setCalculaTotalModal() {
            const a = parseFloat(this.fillEditarProducto.cCantidadEdit);
            const b = parseFloat(this.fillEditarProducto.cPUnitEdit);
            const c = a * b;
            this.fillEditarProducto.cTotalEdit = parseFloat(c).toFixed(2);
        },
        setCalculaTotalEdit() {
            const a = parseFloat(this.fillEditarProducto.cCantidadEdit);
            const b = parseFloat(this.fillEditarProducto.cPUnitEdit);
            const c = a * b;
            this.fillEditarProducto.cTotalEdit = parseFloat(c).toFixed(2);
        },
        limpiaItems() {
            this.fillEditarProducto.cCantidad = "";
            this.fillEditarProducto.cMedida = "";
            this.fillEditarProducto.cDescripcion = "";
            this.fillEditarProducto.cPUnit = "";
            this.fillEditarProducto.cTotal = "";
        },

        borradoItems(item) {
            Swal.fire({
                title: "Esta usted seguro?",
                text: "Se elimanara del item",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Eliminalo!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );

                    var url =
                        "/administracion/cotizacion/dellTempEditCotizacion";
                    axios
                        .post(url, {
                            item: item,
                        })
                        .then((response) => {
                            this.getCargaCotizacionByCotizacion();
                        });
                }
            });
        },

        EditarItems(item) {
            this.modalShowEditItem = true;
            this.CargaDatosItemEdit(item);
            localStorage.Codigo = item;
        },

        CargaDatosItemEdit(item) {
            var url =
                "/administracion/detallecotizancion/DatosItemDetalleCotixItem";
            axios
                .post(url, {
                    item: item,
                })
                .then((response) => {
                    this.fillEditarProducto.cCantidadEdit =
                        response.data.cantidad;
                    this.fillEditarProducto.nIdUnidMedEdit =
                        response.data.unidmedida.id;
                    this.fillEditarProducto.nIdprodEdit =
                        response.data.producto_id;
                    this.fillEditarProducto.cPUnitEdit = response.data.punit;
                });
        },

        EditDatosItem() {
            var url = "/administracion/detallecotizancion/EditDatosItem";
            axios
                .post(url, {
                    item: localStorage.Codigo,
                    cCantidadEdit: this.fillEditarProducto.cCantidadEdit,
                    nIdUnidMedEdit: this.fillEditarProducto.nIdUnidMedEdit,
                    nIdprodEdit: this.fillEditarProducto.nIdprodEdit,
                    cPUnitEdit: this.fillEditarProducto.cPUnitEdit,
                })
                .then((response) => {
                    if (response.data.message) {
                        Swal.fire({
                            icon: response.data.icon,
                            title: response.data.message,
                            text: response.data.message,
                        });
                    }

                    this.getCargaCotizacionByCotizacion();
                    this.abrirModalEditItem();
                    localStorage.removeItem(Codigo);
                });
        },

        cargaDatosPredeterminados() {
            this.fillEditarProducto.cValidez = "15 días";
            this.fillEditarProducto.Docu = "Factura, guía y carta de Garantía";
            this.fillEditarProducto.cFlete = "NOVESUR";
        },

        setBuscaPrecioXProducto() {
            var url = "/administracion/producto/getListarProductoById";
            axios
                .get(url, {
                    params: {
                        nIdProducto: this.fillEditarProducto.nIdprod,
                    },
                })
                .then((response) => {
                    // this.fillEditarProducto.cPUnit = response.data.precioSugerido;
                    if (this.fillEditarProducto.ctipoPrecio == "Lista") {
                        this.fillEditarProducto.cPUnit =
                            response.data.precioSugerido;
                    } else if (
                        this.fillEditarProducto.ctipoPrecio == "Distribuidor"
                    )
                        this.fillEditarProducto.cPUnit =
                            response.data.precioDistribuidor;
                });
        },

        setBuscaPrecioXProductoModal() {
            var url = "/administracion/producto/getListarProductoById";
            axios
                .get(url, {
                    params: {
                        nIdProducto: this.fillEditarProducto.nIdprodEdit,
                    },
                })
                .then((response) => {
                    // this.fillEditarProducto.cPUnitEdit = response.data.precioSugerido;
                    if (this.fillEditarProducto.ctipoPrecio == "Lista") {
                        this.fillEditarProducto.cPUnitEdit =
                            response.data.precioSugerido;
                    } else if (
                        this.fillEditarProducto.ctipoPrecio == "Distribuidor"
                    )
                        this.fillEditarProducto.cPUnitEdit =
                            response.data.precioDistribuidor;
                });
        },
    },
};
</script>
