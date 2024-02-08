<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Visitas</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <button
              class="btn btn-success btn-sm"
              @click.prevent="setGenerarExcelVisitas"
            >
              <i class="far fa-file-excel"></i> Reporte
            </button>
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
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-md-3 col-form-label"
                                                            >Vendedor</label
                                                        >
                                                        <div class="col-md-6">
                                                            <el-select
                                                                v-model="
                                                                    fillBsqVisitas.nIdVendedor
                                                                "
                                                                filterable
                                                                placeholder="Seleccione una Vendedor"
                                                                :style="{
                                                                    width: '350px',
                                                                }"
                                                                @change="
                                                                    getlistCliente
                                                                "
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>

                                            <template v-else>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-md-3 col-form-label"
                                                            >Vendedor</label
                                                        >
                                                        <div class="col-md-6">
                                                            <el-select
                                                                v-model="
                                                                    fillBsqVisitas.nIdVendedor
                                                                "
                                                                filterable
                                                                placeholder="Seleccione una Vendedor"
                                                                :style="{
                                                                    width: '350px',
                                                                }"
                                                                default-value="2010-10-01"
                                                                @change="
                                                                    getlistCliente
                                                                "
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-1 col-form-label"
                                                        >Cliente</label
                                                    >
                                                    <div class="col-md-8">
                                                        <el-select
                                                            v-model="
                                                                fillBsqVisitas.nIdCliente
                                                            "
                                                            filterable
                                                            placeholder="Seleccione un cliente"
                                                            :style="{
                                                                width: '700px',
                                                            }"
                                                            clearable
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
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-md-2 col-form-label"
                                                            >Fecha</label
                                                        >
                                                        <el-date-picker
                                                            v-model="
                                                                fillBsqVisitas.dFecha
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
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-md-1 col-form-label"
                                                            >Estado</label
                                                        >
                                                        <div class="col-md-8">
                                                            <el-select
                                                                v-model="
                                                                    fillBsqVisitas.nIdtEstadoVisita
                                                                "
                                                                filterable
                                                                placeholder="Seleccione un estado"
                                                                :style="{
                                                                    width: '700px',
                                                                }"
                                                                clearable
                                                            >
                                                                <el-option
                                                                    v-for="item in listEstadoVisita"
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
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button
                                            class="btn btn-flat btn-info btnWidth"
                                            @click.prevent="getlistVisitas"
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
                                            <th>Distrito</th>
                                            <th>Cliente</th>
                                            <th>Proyecto</th>
                                            <th>Direccción</th>
                                            <th>Estado Obra</th>
                                            <th>Personal Contacto</th>
                                            <th>Contacto</th>
                                            <th>Observación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                item, index
                                            ) in listCotizacionPaginated"
                                            :key="index"
                                        >
                                            <td>
                                                {{
                                                    item.fecha
                                                        | moment("DD - MM - Y")
                                                }}
                                            </td>
                                            <td>
                                                {{ item.distrito.nombre }}
                                            </td>
                                            <td
                                                v-text="item.cliente.razonsocial"
                                            ></td>
                                            <td v-text="item.proyecto"></td>
                                            <td v-text="item.direccion"></td>
                                            <td v-text="item.estado_obra.nombre"></td>
                                            <td v-text="item.personal_contacto.nombre"></td>
                                            <td v-text="item.nombre"></td>
                                            <td v-text="item.observacion"></td>
                                       <!--      <td>
                                                <button
                                                    v-if="
                                                        listRolPermisoByUsuario.includes(
                                                            'cotizacion.estado'
                                                        )
                                                    "
                                                    class="btn btn-info btn-sm"
                                                    @click="
                                                        abrirEstado(item.codigo)
                                                    "
                                                >
                                                    <i
                                                        class="far fa-calendar-check"
                                                    ></i>
                                                    Estado
                                                </button>

                                                <button
                                                    class="btn btn-primary btn-sm"
                                                    @click="
                                                        abrirModal(item.codigo)
                                                    "
                                                >
                                                    <i class="far fa-eye"></i>
                                                    Detalle
                                                </button>

                                                <button
                                                    @click.prevent="
                                                        getPdfCotizacion(
                                                            item.codigo,
                                                            item.fecha
                                                        )
                                                    "
                                                    class="btn btn-danger btn-sm"
                                                >
                                                    <span
                                                        ><i
                                                            class="far fa-file-pdf"
                                                        ></i
                                                    ></span>
                                                    PDF
                                                </button>

                                                <template
                                                    v-if="
                                                        listRolPermisoByUsuario.includes(
                                                            'notaPedido_Create'
                                                        )
                                                    "
                                                >
                                                    <router-link
                                                        class="btn btn-success btn-sm"
                                                        :to="{
                                                            name: 'notapedido.create',
                                                            params: {
                                                                id: item.id,
                                                            },
                                                        }"
                                                    >
                                                        <i
                                                            class="fab fa-telegram-plane"
                                                        ></i>
                                                        Nota de Pedido
                                                    </router-link>
                                                </template>

                                                <template
                                                    v-if="item.estadodias <= 30"
                                                >
                                                    <router-link
                                                        class="btn btn-secondary btn-sm"
                                                        :to="{
                                                            name: 'cotizacion.editar',
                                                            params: {
                                                                id: item.codigo,
                                                            },
                                                        }"
                                                    >
                                                        <i
                                                            class="far fa-edit"
                                                        ></i>
                                                        Editar
                                                    </router-link>
                                                </template>

                                            </td> -->
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
                    </div>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            :class="{ show: modalShow }"
            :style="modalShow ? mostrarModal : ocultarModal"
        >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Detalle de cotizacion #
                            {{ this.fillBsqVisitas.itemid | fourchar }}
                        </h5>

                        <button
                            class="close"
                            @click="abrirModal(item.id)"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <!-- Listado de Detalle de Cotizaciones -->

                        <div class="card-body table-responsive">
                            <table
                                class="table table-hover table-head-fixed text-nowrap projects"
                            >
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>P.Unit</th>
                                        <th>Total</th>
                                        <th>Unidad Medida</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(item, index) in listDetPedido"
                                        :key="index"
                                    >
                                        <td
                                            v-text="
                                                item.producto.familia.nombre +
                                                ',' +
                                                item.producto.subfamilia
                                                    .nombre +
                                                ', MODELO :' +
                                                item.producto.modelotipo
                                                    .nombre +
                                                ', MATERIAL :' +
                                                item.producto.material.nombre +
                                                ', MARCA :' +
                                                item.producto.marca.nombre
                                            "
                                        ></td>

                                        <td v-text="item.cantidad"></td>
                                        <td v-text="item.punit"></td>
                                        <td>
                                            {{
                                                (item.cantidad * item.punit)
                                                    | formatPrice
                                            }}
                                        </td>
                                        <td
                                            v-text="item.unidmedida.nombre"
                                        ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" @click="abrirModal">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--  MODAL DE ESTADO DE COTIZACION -->

        <div
            class="modal fade"
            :class="{ show: modalEstado }"
            :style="modalEstado ? mostrarModal : ocultarModal"
            @keydown.esc="dialog = false"
        >
            <div
                class="modal-dialog modal-dialog-center modal-dialog-scrollable d-flex align-items-center"
                role="document"
                style="top: 50% !important"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Cambiar Estado de Cotizacion
                        </h5>
                        <button class="close" @click="abrirEstado()"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Listado de Detalle de Cotizaciones -->
                        <div class="col">
                            <el-select
                                v-model="fillBsqVisitas.nIdtEstadoCoti"
                                filterable
                                placeholder="Seleccione un estado"
                                :style="{ width: '400px' }"
                                @change="onChange()"
                            >
                                <el-option
                                    v-for="item in listEstadoVisita"
                                    :key="item.id"
                                    :label="item.nombre"
                                    :value="item.id"
                                >
                                </el-option>
                            </el-select>
                        </div>
                        <template v-if="fillBsqVisitas.nIdtEstadoCoti == 1">
                            <div class="col" :style="'padding-top : 20px'">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Motivo del Rechazo"
                                    v-model="fillBsqVisitas.cMotivoRechazo"
                                />
                            </div>
                        </template>
                    </div>
                    <div class="modal-footer">
                        <button
                            class="btn btn-primary"
                            @click.prevent="setEditarPedido"
                            :disabled="EstadoBotonEditar"
                        >
                            Editar
                        </button>
                        <button
                            class="btn btn-secondary"
                            @click.prevent="abrirEstado"
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
import FileSaver from "file-saver";
export default {
    data() {
        return {
            fillBsqVisitas: {
                cNombre: "",
                nIdCliente: "",
                nIdVendedor: "",
                itemid: "",
                dFecha: "",
                nIdtEstadoCoti: "",
                nIdtEstadoVisita: "",
                cMotivoRechazo: "",

                nIdUser: sessionStorage.getItem("iduser"),
            },
            EstadoBotonEditar: true,
            txtrechazo: {
                margin: 15,
            },
            listDetPedido: [],
            listVendedorAdmin: [],
            listVendedorUser: [],
            listVisitas: [],
            listCliente: [],
            listEstadoCoti: [],
            listEstadoVisita: [],
            modalShow: false,
            modalEstado: false,
            mostrarModal: {
                display: "block",
                background: "#0000006b",
                position: "fixed",
            },
            ocultarModal: {
                display: "none",
            },
            pageNumber: 0,
            perPage: 15,
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
        this.getlistVendedorAdmin();
        //this.cargaFechaActual();
        this.getlistVendedorxUsu();
        this.getlistEstadoPedido();
        this.getlistEstadoVisitas();
    },

    computed: {
        pageCount() {
            let a = this.listVisitas.length,
                b = this.perPage;
            return Math.ceil(a / b);
        },
        listCotizacionPaginated() {
            let inicio = this.pageNumber * this.perPage,
                fin = inicio + this.perPage;
            return this.listVisitas.slice(inicio, fin);
        },
        pagesList() {
            let a = this.listVisitas.length,
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
        cargaFechaActual() {
            this.fillBsqVisitas.dFecha = new Date();
        },

        onChange() {
            if (this.fillBsqVisitas.nIdtEstadoCoti == 2) {
                this.EstadoBotonEditar = true;
            } else {
                this.EstadoBotonEditar = false;
            }
        },
        abrirModal(item) {
            this.modalShow = !this.modalShow;
            this.fillBsqVisitas.itemid = item;
            this.getListDetCotizacion(item);
        },

        abrirEstado(item) {
            this.modalEstado = !this.modalEstado;
            this.fillBsqVisitas.itemid = item;
            this.BuscaCotizacionList(item);
        },

        limpiarCriteriosBsq() {
        
            this.fillBsqVisitas.nIdCliente = "";
            this.fillBsqVisitas.nIdtEstadoVisita = "";
            this.fillBsqVisitas.dFecha = "";
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

                    /*
  
          this.fillBsqVisitas.nIdCliente = this.listDetPedido[0].id; */
                });
        },
        getlistVendedorAdmin() {
            var url = "/administracion/usuario/getListarUsusarios";
            axios.get(url).then((response) => {
                this.listVendedorAdmin = response.data;
                this.getlistCliente();
            });
        },
        getlistVendedorxUsu() {
            var url = "/administracion/usuario/getListarUsusariosbyId";
            axios
                .get(url, {
                    params: {
                        nIdUsuario: this.fillBsqVisitas.nIdUser,
                    },
                })
                .then((response) => {
                    this.listVendedorUser = response.data;
                    this.fillBsqVisitas.nIdVendedor =
                        this.listVendedorUser[0].id;
                    this.getlistCliente();
                });
        },

        getlistVisitas() {
            var url = "/administracion/visita/list";
            axios
                .get(url, {
                    params: {
                        nIdCliente: this.fillBsqVisitas.nIdCliente,
                        nIdVendedor: this.fillBsqVisitas.nIdVendedor,
                        dFecha: this.fillBsqVisitas.dFecha,
                        nIdUser: this.fillBsqVisitas.nIdUser,
                        dFechainicio: !this.fillBsqVisitas.dFecha
                            ? ""
                            : this.fillBsqVisitas.dFecha[0],
                        dFechafin: !this.fillBsqVisitas.dFecha
                            ? ""
                            : this.fillBsqVisitas.dFecha[1],
                        nIdtEstadoVisita: this.fillBsqVisitas.nIdtEstadoVisita,
                    },
                })
                .then((response) => {
                    console.log(response.data);
                    this.listVisitas = response.data;

                    this.inicializarPaginacion();
                });
        },

        getlistCliente() {
            var url = "/administracion/cliente/getListarCliente";
            axios
                .get(url, {
                    params: {
                        nIdVendedor: this.fillBsqVisitas.nIdVendedor,
                    },
                })
                .then((response) => {
                    (this.fillBsqVisitas.nIdCliente = ""),
                        (this.listCliente = response.data);
                });
        },
        setGenerarExcelVisitas(){
            var url = "/operacion/visita/export";
      axios
        .post(
          url,
          {
            params: { listVisitas: JSON.stringify(this.listVisitas) },
          },
          { responseType: "blob" }
        )
        .then((response) => {
          FileSaver.saveAs(response.data, "Visitas.xlsx");
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
                    this.getlistEstadoPedido(response.data.id);
                });
        },
        getlistEstadoPedido(item) {
            var url = "/administracion/cotizacion/buscaEstado";
            axios
                .get(url, {
                    params: {
                        item: item,
                    },
                })
                .then((response) => {
                    //this.fillBsqVisitas.nIdtEstadoCoti =  response.data.estadopedido.nombre ;
                    this.fillBsqVisitas.nIdtEstadoCoti =
                        response.data.estadopedido_id;
                });
        },
        getlistEstadoVisitas() {
            var url = "/administracion/EstadoObra/list";
            axios.get(url).then((response) => {
                this.listEstadoVisita = response.data;
            });
        },

        setEditarPedido() {
            var url = "/administracion/cotizacion/editEstadoCotizacion";
            axios
                .post(url, {
                    itemid: this.fillBsqVisitas.itemid,
                    nIdtEstadoCoti: this.fillBsqVisitas.nIdtEstadoCoti,
                    cMotivoRechazo: this.fillBsqVisitas.cMotivoRechazo,
                })
                .then((response) => {
                    (this.fillBsqVisitas.cMotivoRechazo = ""),
                        //this.listVisitas = response.data;
                        this.getlistVisitas();
                });
        },

        getPdfCotizacion(item, fecha) {
            var config = { responseType: "blob" };
            var url = "/administracion/cotizacion/CotizacionPdf";
            axios
                .post(
                    url,
                    {
                        params: {
                            item: item,
                            fecha: fecha,
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
                    //window.print();
                });
        },

        getActualizarFecha(item) {
            Swal.fire({
                title: "Esta usted Seguro?",
                text: "La fecha de la cotizacion se cambiara a la actual",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Edita la fecha de la cotización!",
            }).then((result) => {
                if (result.isConfirmed) {
                    var url =
                        "/administracion/cotizacion/updateFechaCotizacion";
                    axios
                        .post(url, {
                            item: item,
                        })
                        .then((response) => {
                            this.listVisitas = response.data;
                        });
                }
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
