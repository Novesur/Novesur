<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Reporte de Informe de Valorización
                    </h1>
                </div>
            </div>
        </div>

        <div class="content container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools"></div>
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
                                                    >Proyecto</label
                                                >
                                                <div class="col-md-6">
                                                    <el-select
                                                        v-model="
                                                            fillBPInfValor.nIdProyecto
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
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-1 col-form-label"
                                                    >Fecha</label
                                                >
                                                <el-date-picker
                                                    v-model="
                                                        fillBPInfValor.dFecha
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

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-1 col-form-label"
                                                    >O/S Nro</label
                                                >
                                                <div class="col-md-2">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-model="
                                                            fillBPInfValor.cServicio
                                                        "
                                                        :maxlength="11"
                                                        @keyup.enter="
                                                            getListarPReqMateriales
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6 offset-3">
                                        <button
                                            class="btn btn-flat btn-info btnWidth3buttons"
                                            @click.prevent="
                                                getListInfoValorizacion
                                            "
                                        >
                                            Buscar
                                        </button>
                                        <button
                                            class="btn btn-flat btn-default btnWidth3buttons"
                                            @click.prevent="
                                                limpiarListClientsBsq
                                            "
                                        >
                                            Limpiar
                                        </button>

                                        <button
                                            class="btn btn-flat btn-success btnWidth3buttons"
                                            @click.prevent="ExcelListOrdProd"
                                        >
                                            Excel
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
                                            <td v-text="item.codigo"></td>
                                            <td v-text="item.fecha"></td>
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
                                                        SetGenerarInfoValorizacionPDF(
                                                            item.id
                                                        )
                                                    "
                                                >
                                                    <i
                                                        class="fas fa-file-pdf"
                                                    ></i>
                                                    PDF
                                                </button>

                                                <template
                                                    v-if="
                                                        listRolPermisoByUsuario.includes(
                                                            'infoProduccion_precio'
                                                        )
                                                    "
                                                >
                                                    <button
                                                        class="btn btn-secondary btn-sm"
                                                        @click.prevent="
                                                            abrirModalInfoProd(
                                                                item.id
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="fas fa-wrench"
                                                        ></i>
                                                        Material
                                                    </button>

                                                    <button
                                                        class="btn btn-primary btn-sm"
                                                        @click.prevent="
                                                            abrirModalManoObra(
                                                                item.id
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="fas fa-user-cog"
                                                        ></i>
                                                        Mano de Obra
                                                    </button>

                                                    <button
                                                        class="btn btn-info btn-sm"
                                                        @click.prevent="
                                                            abrirModalOtrosReque(
                                                                item.id
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="fas fa-list-alt"
                                                        ></i>
                                                        Otros Reque..
                                                    </button>

                                                    <button
                                                        class="btn btn-success btn-sm"
                                                        @click.prevent="
                                                            getExcelReporte(
                                                                item.id
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="far fa-file-excel"
                                                        ></i>
                                                        Reporte
                                                    </button>
                                                </template>
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
            :class="{ show: modalShowEditItem }"
            :style="modalShowEditItem ? mostrarModal : ocultarModal"
        >
            <div class="modal-editcotitem modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Requerimiento de Materiales</h5>
                        <button
                            class="close"
                            @click="abrirModalInfoProd"
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
                                                <table
                                                    class="table table-hover table-head-fixed text-nowrap projects"
                                                >
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                Descripcion
                                                                Material
                                                            </th>
                                                            <th>Cantidad</th>
                                                            <th>Precio Unit</th>
                                                            <th>Total</th>
                                                            <th>Accion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            v-for="(
                                                                item, index
                                                            ) in listInfoValMateriales"
                                                            :key="index"
                                                        >
                                                            <td>
                                                                {{
                                                                    item
                                                                        .producto
                                                                        .codigo +
                                                                    " - " +
                                                                    item
                                                                        .producto
                                                                        .familia
                                                                        .nombre +
                                                                    " , " +
                                                                    item
                                                                        .producto
                                                                        .subfamilia
                                                                        .nombre +
                                                                    " , Modelo: " +
                                                                    item
                                                                        .producto
                                                                        .modelotipo
                                                                        .nombre +
                                                                    " , Marca : " +
                                                                    item
                                                                        .producto
                                                                        .marca
                                                                        .nombre +
                                                                    " , Material : " +
                                                                    item
                                                                        .producto
                                                                        .material
                                                                        .nombre +
                                                                    " ," +
                                                                    item
                                                                        .producto
                                                                        .homologacion
                                                                        .nombre
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                    item.cantidad
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                    item.costunit
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                    item.cantidad *
                                                                    item.costunit
                                                                }}
                                                            </td>
                                                            <td>
                                                                <button
                                                                    class="btn btn-primary btn-sm"
                                                                    @click.prevent="
                                                                        MandarDatosPrecio(
                                                                            item.id,
                                                                            item.costunit,
                                                                            item.cantidad,
                                                                            item.pk_informe_valorizacion
                                                                        )
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-comment-dollar"
                                                                    ></i>
                                                                    Precio
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!--    <button class="btn btn-success" @click="EditModalReqMateriales()">
                    Editar
                  </button> -->
                            <button
                                class="btn btn-secondary"
                                @click="abrirModalInfoProd"
                            >
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  FIN DEL MODAL DE REQUERIMIENTOS DE MATERIALES -->

        <!--    MODAL DE MANO DE OBRA  -->

        <div
            class="modal fade"
            :class="{ show: modalShowEditMObra }"
            :style="modalShowEditMObra ? mostrarModal : ocultarModal"
        >
            <div class="modal-editcotitem modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mano de Obra</h5>
                        <button
                            class="close"
                            @click="abrirModalManoObra"
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
                                                <table
                                                    class="table table-hover table-head-fixed text-nowrap projects"
                                                >
                                                    <thead>
                                                        <tr>
                                                            <th>Personal</th>
                                                            <th>Horas</th>
                                                            <th>Días</th>
                                                            <th>Costo Dias</th>
                                                            <th>Costo Horas</th>
                                                            <th>Total</th>

                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            v-for="(
                                                                item, index
                                                            ) in listManObra"
                                                            :key="index"
                                                        >
                                                            <td>
                                                                {{
                                                                    item
                                                                        .personal
                                                                        .nombres
                                                                }}
                                                                {{
                                                                    item
                                                                        .personal
                                                                        .ApPaterno
                                                                }}
                                                                {{
                                                                    item
                                                                        .personal
                                                                        .ApMaterno
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{ item.horas }}
                                                            </td>
                                                            <td>
                                                                {{ item.dias }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                    item.costdias
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                    item.costhoras
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{ item.total }}
                                                            </td>

                                                            <td>
                                                                <button
                                                                    class="btn btn-primary btn-sm"
                                                                    @click.prevent="
                                                                        MandarDiaMObra(
                                                                            item.id,
                                                                            item.pk_informe_valorizacion,
                                                                            (total =
                                                                                item.dias *
                                                                                    item.costdias +
                                                                                item.horas *
                                                                                    item.costhoras)
                                                                        )
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-comment-dollar"
                                                                    ></i>
                                                                    Días
                                                                </button>
                                                                <button
                                                                    class="btn btn-primary btn-sm"
                                                                    @click.prevent="
                                                                        MandarHoraMObra(
                                                                            item.id,
                                                                            item.informeproduccion_id,
                                                                            (total =
                                                                                item.dias *
                                                                                    item.costdias +
                                                                                item.horas *
                                                                                    item.costhoras)
                                                                        )
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-comment-dollar"
                                                                    ></i>
                                                                    Horas
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!--    <button class="btn btn-success" @click="EditModalReqMateriales()">
                    Editar
                  </button> -->
                            <button
                                class="btn btn-secondary"
                                @click="abrirModalManoObra"
                            >
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DEL MODAL DE MANO DE OBRA  -->

        <!--    MODAL DE OTROS REQUERIMIENTOS  -->

        <div
            class="modal fade"
            :class="{ show: modalShowEditOtrosReque }"
            :style="modalShowEditOtrosReque ? mostrarModal : ocultarModal"
        >
            <div class="modal-editcotitem modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Otros Requerimientos</h5>
                        <button
                            class="close"
                            @click="abrirModalOtrosReque"
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
                                                <table
                                                    class="table table-hover table-head-fixed text-nowrap projects"
                                                >
                                                    <thead>
                                                        <tr>
                                                            <th>Descripción</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio</th>
                                                            <th>
                                                                Unid. Medida
                                                            </th>
                                                            <th>Alquiler</th>
                                                          <!--   <th>
                                                                Unid. Alquiler
                                                            </th> -->
                                                            <th>Total</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            v-for="(
                                                                item, index
                                                            ) in listOtrosReq"
                                                            :key="index"
                                                        >
                                                            <td>
                                                                {{
                                                                    item.descripcion
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                    item.cantidad
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                    item.precio
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                    item
                                                                        .unidmedida
                                                                        .nombre
                                                                }}
                                                            </td>
                                                       <!--      <td>
                                                                {{
                                                                    item.alquiler
                                                                }}
                                                            </td> -->
                                                            <td>
                                                                {{
                                                                    item
                                                                        .pk_tiempo_alquiler
                                                                        .nombre
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{ item.total }}
                                                            </td>

                                                            <td>
                                                                <button
                                                                    class="btn btn-primary btn-sm"
                                                                    @click.prevent="
                                                                        MandarPreciOtroReq(
                                                                            item.id,
                                                                            item.pk_informe_valorizacion,
                                                                            item.cantidad
                                                                        )
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-comment-dollar"
                                                                    ></i>
                                                                    Precio
                                                                </button>

                                                                <button
                                                                    class="btn btn-success btn-sm"
                                                                    tabindex="-1"
                                                                    role="dialog"
                                                                    @click.prevent="
                                                                        /*       MandarPreciOtroReq(
                                                                            item.id,
                                                                            item.pk_informe_valorizacion,
                                                                            item.cantidad
                                                                        ) */
                                                                        abrirModalOtrosReqAlquiler(
                                                                            item.id,
                                                                            item.pk_informe_valorizacion
                                                                        )
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-pencil-alt"
                                                                    ></i>
                                                                    Alquiler
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!--    <button class="btn btn-success" @click="EditModalReqMateriales()">
                    Editar
                  </button> -->
                            <button
                                class="btn btn-secondary"
                                @click="abrirModalOtrosReque"
                            >
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DEL MODAL DE OTROS REQUERIMIENTOS  -->

        <!--   MODAL  DEL  ALQUILER -->
        <div
            class="modal fade"
            :class="{ show: modalShowEditOtrosReqAquiler }"
            :style="modalShowEditOtrosReqAquiler ? mostrarModal : ocultarModal"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Alquiler</h5>
                        <button
                            class="close"
                            @click="abrirModalOtrosReque"
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
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >Unid. Medida</label
                                                    >
                                                    <div class="col-md-10">
                                                      <el-select
                                                                    v-model="
                                                                        fillBPInfValor.nIdUnidMedAlquiler
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

                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div
                                                        class="card-body table-responsive"
                                                    >
                                                        <div
                                                            class="form-group row"
                                                        >
                                                            <label
                                                                class="col-md-2 col-form-label"
                                                                >Unid.
                                                                Alquiler</label
                                                            >
                                                            <div
                                                                class="col-md-10"
                                                            >
                                                                <el-select
                                                                    v-model="
                                                                        fillBPInfValor.nIdAlquiler
                                                                    "
                                                                    placeholder="Select"
                                                                    style="
                                                                        width: 70%;
                                                                    "
                                                                >
                                                                    <el-option
                                                                        v-for="item in listUnidAlquiler"
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
                                @click="EditOtrosReqAlquiler()"
                            >
                                Editar
                            </button>
                            <button
                                class="btn btn-secondary"
                                @click="abrirModalOtrosReqAlquiler(id,pk_informe_valorizacion)"
                            >
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  FIN DEL MODAL ALQUILER -->
    </div>
</template>

<script>
import FileSaver from "file-saver";
export default {
    data() {
        return {
            fillBPInfValor: {
                nIdProyecto: "",
                dFecha: "",
                cServicio: "",
                precioMatInfoValor: "",
                totalInfoValor: "",
                precioDia: "",
                cantAlquiler: "",
                nIdAlquiler: "",
                nIdUnidMedAlquiler:"",
            },

            modalShowEditItem: false,
            mostrarModal: {
                display: "block",
                background: "#0000006b",
            },

            modalShowEditMObra: false,
            mostrarModal: {
                display: "block",
                background: "#0000006b",
            },

            modalShowEditOtrosReque: false,
            mostrarModal: {
                display: "block",
                background: "#0000006b",
            },

            modalShowEditOtrosReqAquiler: false,
            mostrarModal: {
                display: "block",
                background: "#0000006b",
            },

            ocultarModal: {
                display: "none",
            },

            listCCostos: [],
            listPInfoValorizacion: [],
            listInfoValMateriales: [],
            listProd: [],
            listManObra: [],
            listOtrosReq: [],
            listUnidAlquiler: [],
            listUnidMed: [],

            pageNumber: 0,
            perPage: 10,
            listRolPermisoByUsuario: JSON.parse(
                sessionStorage.getItem("listRolPermisosByUsuario")
            ),
        };
    },
    mounted() {
        this.getlistCcostos();
        this.getlistUnidAlquiler();
        this.getListarUnidadMedida();
    },
 
    computed: {
        pageCount() {
            let a = this.listPInfoValorizacion.length,
                b = this.perPage;
            return Math.ceil(a / b);
        },
        listarClientesPaginated() {
            let inicio = this.pageNumber * this.perPage,
                fin = inicio + this.perPage;
            return this.listPInfoValorizacion.slice(inicio, fin);
        },
        pagesList() {
            let a = this.listPInfoValorizacion.length,
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

      getListarUnidadMedida() {
      var url = "/administracion/KardexDetalle/listUnidMed";
      axios.get(url).then((response) => {
        this.listUnidMed = response.data;
        this.fillBPInfValor.nIdUnidMedAlquiler = this.listUnidMed[7].id;
      });
    },
        getlistCcostos() {
            var url = "/administracion/CentroCostos/list";
            axios.get(url).then((response) => {
                this.listCCostos = response.data;
            });
        },

        getlistUnidAlquiler() {
            var url = "/administracion/informeValorizacion/listUnidAlquiler";
            axios.get(url).then((response) => {
                this.listUnidAlquiler = response.data;
            });
        },

        abrirModalInfoProd(item) {
            this.modalShowEditItem = !this.modalShowEditItem;
            this.setMostrarInfo(item);
        },

        abrirModalManoObra(item) {
            this.modalShowEditMObra = !this.modalShowEditMObra;
            this.setMostrarInfoManObra(item);
        },

        abrirModalOtrosReque(item) {
            this.modalShowEditOtrosReque = !this.modalShowEditOtrosReque;
            this.setMostrarInfOtrosReq(item);
        },

        abrirModalOtrosReqAlquiler(id, pk_informe_valorizacion) {
            this.modalShowEditOtrosReqAquiler =
                !this.modalShowEditOtrosReqAquiler;
                
                var url = "/administracion/InformeValorizacion/getAlquiler";
      axios
        .post(url, {
          id,
          pk_informe_valorizacion,
        })
        .then((response) => {
          
          this.fillBPInfValor.nIdUnidMedAlquiler = response.data.unidmedida_id; 
          this.fillBPInfValor.nIdAlquiler = response.data.pk_tiempo_alquiler.id;
          localStorage.id = response.data.id; 
   /*        localStorage.IdAlquiler = response.data.pk_tiempo_alquiler.id; 
          localStorage.IdUnidMed = response.data.unidmedida_id; */
          localStorage.informe_valorizacion = pk_informe_valorizacion;
        });

        },

        EditOtrosReqAlquiler() {
          
      var url = "/administracion/InformeValorizacion/EditOtrosReqAlquiler";
      axios
        .post(url, {
          id: localStorage.id,
       /*    cantAlquiler: this.fillBPInfValor.cantAlquiler, */
          nIdAlquiler : this.fillBPInfValor.nIdAlquiler,
          IdUnidMed: this.fillBPInfValor.nIdUnidMedAlquiler
        })
        .then(() => {
          this.fillBPInfValor.cantAlquiler = "";
          this.setMostrarInfOtrosReq(localStorage.informe_valorizacion);
          this.modalShowEditOtrosReqAquiler = !this.modalShowEditOtrosReqAquiler;
          localStorage.removeItem(id);
       /*    localStorage.removeItem(localStorage.IdAlquiler);
          localStorage.removeItem(localStorage.IdUnidMed);
          localStorage.removeItem(localStorage.informe_valorizacion); */
        });
    },



        setMostrarInfo(item) {
            var url =
                "/administracion/informeValorizacion/mostrarInfoReqMateriales";
            axios
                .get(url, {
                    params: {
                        item,
                    },
                })
                .then((response) => {
                    this.listInfoValMateriales = response.data;
                });
        },

        setMostrarInfoManObra(item) {
            var url = "/administracion/informeValorizacion/mostrarInfoManObra";
            axios
                .get(url, {
                    params: {
                        item,
                    },
                })
                .then((response) => {
                    this.listManObra = response.data;
                });
        },
        setMostrarInfOtrosReq(item) {
            var url = "/administracion/informeValorizacion/mostrarInfOtrosReq";
            axios
                .get(url, {
                    params: {
                        item,
                    },
                })
                .then((response) => {
                    this.listOtrosReq = response.data;
                });
        },

        MandarDatosPrecio(item, costunit, cantidad, pk_informe_valorizacion) {
            this.fillBPInfValor.precioMatInfoValor = prompt(
                "Ingrese el precio a editar",
                costunit
            );
            this.fillBPInfValor.totalInfoValor =
                cantidad * this.fillBPInfValor.precioMatInfoValor;

            var url =
                "/administracion/InformeValorizacion/editPrecioMatInfoValor";
            axios
                .post(url, {
                    item,
                    precioMatInfoValor: this.fillBPInfValor.precioMatInfoValor,
                    totalInfoValor: this.fillBPInfValor.totalInfoValor,
                })
                .then((response) => {
                    this.setMostrarInfo(pk_informe_valorizacion);
                });
        },

        MandarDiaMObra(id, informeproduccion_id, total) {
            this.fillBPInfValor.precioDia = prompt(
                "Ingrese el precio de la Hora "
            );
            var url = "/administracion/InformeProduccion/editPrecioDiaOdrProd";
            axios
                .post(url, {
                    id,
                    precioDia: this.fillBPInfValor.precioDia,
                    total,
                })
                .then((response) => {
                    this.setMostrarInfoManObra(informeproduccion_id);
                });
        },

        MandarPreciOtroReq(id, informeproduccion_id, cantidad) {
            let precioDia = prompt("Ingrese el precio ");
            let total = parseInt(cantidad) * precioDia;

            var url = "/administracion/InformeValorizacion/editPrecioOtrosReq";
            axios
                .post(url, {
                    id,
                    precioDia,
                    total,
                })
                .then((response) => {
                    this.setMostrarInfOtrosReq(informeproduccion_id);
                });
        },

        MandarHoraMObra(id, informeproduccion_id, total) {
            let precioHora = prompt("Ingrese el precio de la Hora ");
            var url = "/administracion/InformeProduccion/editPrecioHoraOdrProd";
            axios
                .post(url, {
                    id,
                    precioHora,
                    total,
                })
                .then((response) => {
                    this.setMostrarInfoManObra(informeproduccion_id);
                });
        },

        SetGenerarInfoValorizacionPDF(id) {
            var config = { responseType: "blob" };
            var url =
                "/administracion/InformeValorizacion/setGenerarInfoValorizacionPdf";
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

        getExcelReporte(item) {
            var url = "/administracion/InformeValorizacion/ExcelDetalladoInfoValor"; 
            axios
                .post(
                    url,
                    {
                        params: { item },
                    },
                    { responseType: "blob" }
                )
                .then((response) => {
                    FileSaver.saveAs(response.data, "InfoValor.xlsx");
                });
        },

        getListarproductosByName() {
            var url = "/administracion/detallecotizancion/listProdByName";
            axios
                .get(url, {
                    params: {
                        nIdprod: this.fillBPInfValor.nIdprod,
                    },
                })
                .then((response) => {
                    this.listProd = response.data;
                });
        },

        limpiarListClientsBsq() {
            this.fillBPInfValor.cNombre = "";
            this.fillBPInfValor.cRuc = "";
            this.listPInfoValorizacion = [];
        },
        limpiarBandejaProveedor() {
            this.listPInfoValorizacion = [];
        },
        getListInfoValorizacion() {
            var url = "/administracion/InformeValorizacion/index";
            axios
                .get(url, {
                    params: {
                        cServicio: this.fillBPInfValor.cServicio,
                        cFecha: this.fillBPInfValor.cFecha,
                        nIdProyecto: this.fillBPInfValor.nIdProyecto,
                    },
                })
                .then((response) => {
                    this.listPInfoValorizacion = response.data;
                });
        },

        ExcelListOrdProd() {
            var url = "/operacion/InformeValorizacion/export";
            axios
                .post(
                    url,
                    {
                        params: {
                            listPInfoValorizacion: JSON.stringify(
                                this.listPInfoValorizacion
                            ),
                        },
                    },
                    { responseType: "blob" }
                )
                .then((response) => {
                    FileSaver.saveAs(response.data, "InfoProduccion.xlsx");
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
