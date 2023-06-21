<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Pedido de Menus</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <form role="form">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="text-center">ENTRADA</h3>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">MENU</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="(
                                                        item, index
                                                    ) in listMenuEntrada"
                                                    :key="index"
                                                >
                                                    <template
                                                        v-if="
                                                            item.plato_entrada !=
                                                            null
                                                        "
                                                    >
                                                        <th
                                                            v-text="index + 1"
                                                        ></th>
                                                        <td
                                                            v-text="
                                                                item
                                                                    .plato_entrada
                                                                    .nombre
                                                            "
                                                        ></td>
                                                    </template>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-4">
                                        <h3 class="text-center">SEGUNDO</h3>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">MENU</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="(
                                                        item, index
                                                    ) in listMenuSegundo"
                                                    :key="index"
                                                >
                                                    <th v-text="index + 1"></th>
                                                    <td
                                                        v-text="
                                                            item.plato_segundo
                                                                .nombre
                                                        "
                                                    ></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!--     <div class="col-md-4">
                                        <h3 class="text-center">EXTRA</h3>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col" class="">MENU</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in listMenuExtra" :key="index">
                                                    <th v-text="index + 1"></th>
                                                    <td v-text="item.plato_extra.nombre"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> -->

                                    <div class="col-md-4">
                                        <h3 class="text-center">DIETA</h3>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col" class="">
                                                        MENU
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="(
                                                        item, index
                                                    ) in listMenuDieta"
                                                    :key="index"
                                                >
                                                    <th v-text="index + 1"></th>
                                                    <td
                                                        v-text="
                                                            item.plato_dieta
                                                                .nombre
                                                        "
                                                    ></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >TIPO DE MENU</label
                                                    >
                                                    <div class="col-md-6">
                                                        <el-select
                                                            v-model="
                                                                fillBsqPedidoMenu.nIdTipo
                                                            "
                                                            filterable
                                                            placeholder="Seleccione una Tipo"
                                                            :style="{
                                                                width: '350px',
                                                            }"
                                                            @change="
                                                                onChange(
                                                                    fillBsqPedidoMenu.nIdTipo
                                                                )
                                                            "
                                                        >
                                                            <el-option
                                                                v-for="item in this
                                                                    .listTipoMenu"
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
                                        <div class="form-group row">
                                            <label
                                                class="col-md-1 col-form-label"
                                                >ENTRADA</label
                                            >

                                            <div class="col-md-6">
                                                <el-select
                                                    v-model="
                                                        fillBsqPedidoMenu.nIdTipoEntrada
                                                    "
                                                    filterable
                                                    placeholder="Seleccione una Tipo"
                                                    :style="{ width: '350px' }"
                                                    clearable
                                                >
                                                    <v-row align="right">
                                                        <el-option
                                                            v-for="item in this
                                                                .listMenuEntrada"
                                                            :key="
                                                                item
                                                                    .plato_entrada
                                                                    .nombre.id
                                                            "
                                                            :label="
                                                                item
                                                                    .plato_entrada
                                                                    .nombre
                                                            "
                                                            :value="
                                                                item
                                                                    .plato_entrada
                                                                    .id
                                                            "
                                                            :disabled="
                                                                EstadoMenuEntrada
                                                            "
                                                        >
                                                        </el-option>
                                                    </v-row>
                                                </el-select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-2 col-form-label"
                                                    >Observación Entrada</label
                                                >
                                                <div class="col-md-10">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-model="
                                                            fillBsqPedidoMenu.cObsEntrada
                                                        "
                                                        style="width: 90%"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label
                                                class="col-md-1 col-form-label"
                                                >SEGUNDO</label
                                            >

                                            <div class="col-md-3">
                                                <el-select
                                                    v-model="
                                                        fillBsqPedidoMenu.nIdTipoSegundo
                                                    "
                                                    filterable
                                                    placeholder="Seleccione una Tipo"
                                                    :style="{ width: '350px' }"
                                                    clearable
                                                >
                                                    <v-row align="right">
                                                        <el-option
                                                            v-for="item in this
                                                                .listMenuSegundo"
                                                            :key="
                                                                item
                                                                    .plato_segundo
                                                                    .id
                                                            "
                                                            :label="
                                                                item
                                                                    .plato_segundo
                                                                    .nombre
                                                            "
                                                            :value="
                                                                item
                                                                    .plato_segundo
                                                                    .id
                                                            "
                                                            :disabled="
                                                                EstadoMenuSegundo
                                                            "
                                                        >
                                                        </el-option>
                                                    </v-row>
                                                </el-select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-1 col-form-label"
                                                        >Observación
                                                        Segundo</label
                                                    >
                                                    <div class="col-md-6">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillBsqPedidoMenu.cObsSegundo
                                                            "
                                                            style="width: 90%"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--                <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-1 col-form-label">EXTRA</label>

                                            <div class="col-md-3">
                                                <el-select v-model="fillBsqPedidoMenu.nIdTipoExtra" filterable
                                                    placeholder="Seleccione una Tipo" :style="{ width: '350px' }"
                                                    clearable>
                                                    <v-row align="right">
                                                        <el-option v-for="item in this.listMenuExtra" :key="item.plato_extra.nombre.id"
                                                            :label="item.plato_extra.nombre" :value="item.plato_extra.id"
                                                            :disabled="EstadoMenuExtra">
                                                        </el-option>
                                                    </v-row>
                                                </el-select>
                                            </div>

                                       



                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-md-1 col-form-label">Observación Extra</label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control"
                                                            v-model="fillBsqPedidoMenu.cObsExtra" style="width: 90%" />


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label
                                                class="col-md-1 col-form-label"
                                                >DIETA</label
                                            >

                                            <div class="col-md-3">
                                                <el-select
                                                    v-model="
                                                        fillBsqPedidoMenu.nIdTipoDieta
                                                    "
                                                    filterable
                                                    placeholder="Seleccione una Tipo"
                                                    :style="{ width: '350px' }"
                                                    clearable
                                                >
                                                    <v-row align="right">
                                                        <el-option
                                                            v-for="item in this
                                                                .listMenuDieta"
                                                            :key="
                                                                item.plato_dieta
                                                                    .nombre.id
                                                            "
                                                            :label="
                                                                item.plato_dieta
                                                                    .nombre
                                                            "
                                                            :value="
                                                                item.plato_dieta
                                                                    .id
                                                            "
                                                            :disabled="
                                                                EstadoMenuDieta
                                                            "
                                                        >
                                                        </el-option>
                                                    </v-row>
                                                </el-select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-1 col-form-label"
                                                        >Observación
                                                        Dieta</label
                                                    >
                                                    <div class="col-md-6">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillBsqPedidoMenu.cObsDieta
                                                            "
                                                            style="width: 90%"
                                                        />
                                                    </div>
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
                                                        getGuardarMenu
                                                    "
                                                >
                                                    Guardar
                                                </button>
                                                <button
                                                    class="btn btn-flat btn-default btnWidth"
                                                    @click.prevent="
                                                        limpiarCriteriosBsq
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
                                                        <th>Fecha</th>
                                                        <th>Hora</th>
                                                        <th>Vendedor</th>

                                                        <th>Entrada</th>
                                                        <th>
                                                            Observación Entrada
                                                        </th>

                                                        <th>Segundo</th>
                                                        <th>
                                                            Observación Segundo
                                                        </th>

                                                        <!--   <th>Extra</th>
                                                        <th>Observación_Extra</th> -->
                                                        <th>Dieta</th>
                                                        <th>
                                                            Observación Dieta
                                                        </th>
                                                        <th>Tipo de Menu</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="(
                                                            item, index
                                                        ) in listeMenusxFecha"
                                                        :key="index"
                                                    >
                                                        <td>
                                                            {{
                                                                item.menu.fecha
                                                                    | moment(
                                                                        "DD - MM - Y"
                                                                    )
                                                            }}
                                                        </td>
                                                        <td>
                                                            {{ item.menu.hora }}
                                                        </td>
                                                        <td>
                                                            {{
                                                                item.menu.user
                                                                    .fullname
                                                            }}
                                                        </td>
                                                        <td
                                                            v-text="
                                                                item
                                                                    .plato_entrada
                                                                    .nombre
                                                            "
                                                        ></td>
                                                        <td
                                                            v-text="
                                                                item.observacionEntrada
                                                            "
                                                        ></td>
                                                        <td
                                                            v-text="
                                                                item
                                                                    .plato_segundo
                                                                    .nombre
                                                            "
                                                        ></td>
                                                        <td
                                                            v-text="
                                                                item.observacionSegundo
                                                            "
                                                        ></td>
                                                        <!--   <td v-text="item.plato_extra.nombre"></td>
                                                        <td v-text="item.observacionExtra"></td> -->

                                                        <td
                                                            v-text="
                                                                item.plato_dieta
                                                                    .nombre
                                                            "
                                                        ></td>
                                                        <td
                                                            v-text="
                                                                item.observacionDieta
                                                            "
                                                        ></td>

                                                        <td
                                                            v-text="
                                                                item.menu
                                                                    .tipomenu
                                                                    .nombre
                                                            "
                                                        ></td>
                                                       
                                                        <td  v-if="listRolPermisoByUsuario.includes('menu.anular')">
                                                            <button
                                                                class="btn btn-info btn-sm"
                                                                @click.prevent="
                                                                    abrirAnularMenu(
                                                                        item
                                                                            .menu
                                                                            .id
                                                                    )
                                                                "
                                                            >
                                                                <i
                                                                    class="far fa-calendar-check"
                                                                ></i>
                                                                Anular
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
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
    </div>
</template>

<script>
export default {
    data() {
        return {
            fillBsqPedidoMenu: {
                cNombre: "",
                nIdTipo: "",
                nIdTipoEntrada: "",
                nIdTipoSegundo: "",
                nIdTipoExtra: "",
                nIdTipoDieta: "",
                itemid: "",
                dFecha: "",
                nIdtEstadoCoti: "",
                nIdMotivo: "",
                cMotivoRechazo: "",
                nIdUser: sessionStorage.getItem("iduser"),
                cObservacion: "",
                cObsEntrada: "",
                cObsSegundo: "",
                cObsExtra: "",
                cObsDieta: "",
            },

            activeName: "first",
            EstadoMenuEntrada: false,
            EstadoMenuSegundo: false,
            EstadoMenuExtra: true,
            EstadoMenuDieta: true,
            mensajeError: [],
            error: 0,

            txtrechazo: {
                margin: 15,
            },

            listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),

            listDetPapeletaSalida: [],
            listModalVendedorAdmin: [],
            listTipoMenu: [],
            listVendedorUser: [],
            listPaginacion: [],
            listMenuEntrada: [],
            listMenuSegundo: [],
            listMenuExtra: [],
            listMenuDieta: [],
            listClientAdmin: [],
            listClient: [],
            listeMenusxFecha: [],
            listPapeleByClient: [],
      

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
        this.getlistEntrada();
        this.getlistTipoMenu();
        this.getlistSegundo();
        //this.getlistExtra();
        this.getlistDieta();

        this.cargaListMenus();
    },

    methods: {
        cargaListMenus() {
            var url = "/administracion/Menu/ListMenubyDate";
            axios.get(url).then((response) => {
                console.log(response);
                this.listeMenusxFecha = response.data;
            });
        },

        cargaFechaActual() {
            this.fillBsqPedidoMenu.dFecha = new Date();
        },

        onChange(tipo) {
            //SOLO ENTRADA
            if (this.fillBsqPedidoMenu.nIdTipo == 1) {
                this.EstadoMenuEntrada = false;
                this.EstadoMenuSegundo = true;
                this.fillBsqPedidoMenu.nIdTipoSegundo = "";
                this.fillBsqPedidoMenu.cObsSegundo = "";
                this.fillBsqPedidoMenu.cObsDieta = "";

                /*  this.EstadoMenuExtra = true;
                this.fillBsqPedidoMenu.nIdTipoExtra = ""; */
            }

            //SOLO SEGUNDO

            if (this.fillBsqPedidoMenu.nIdTipo == 2) {
                this.EstadoMenuEntrada = true;
                this.fillBsqPedidoMenu.nIdTipoEntrada = "";
                this.EstadoMenuSegundo = false;
                this.fillBsqPedidoMenu.cObsEntrada = "";
                this.fillBsqPedidoMenu.cObsDieta = "";

                /*      this.EstadoMenuExtra = true;
                this.fillBsqPedidoMenu.nIdTipoExtra = ""; */
            }

            // MENU COMPLETO
            if (this.fillBsqPedidoMenu.nIdTipo == 3) {
                this.EstadoMenuEntrada = false;
                this.EstadoMenuSegundo = false;
                this.fillBsqPedidoMenu.cObsDieta = "";
                /*   this.EstadoMenuExtra = true;
                this.fillBsqPedidoMenu.nIdTipoExtra = ""; */
            }

            /*          // SOLO EXTRA
            if (this.fillBsqPedidoMenu.nIdTipo == 4) {
                this.EstadoMenuEntrada = true;
                this.fillBsqPedidoMenu.nIdTipoEntrada = "";
                this.EstadoMenuSegundo = true;
                this.fillBsqPedidoMenu.nIdTipoSegundo = "";
                this.EstadoMenuExtra = false;
            }

            // SOLO EXTRA Y ENTRADA
            if (this.fillBsqPedidoMenu.nIdTipo == 5) {
                this.EstadoMenuEntrada = false;
                this.EstadoMenuSegundo = true;
                this.fillBsqPedidoMenu.nIdTipoSegundo = "";
                this.EstadoMenuExtra = false;
            } */

            // SOLO DIETA
            if (this.fillBsqPedidoMenu.nIdTipo == 6) {
                this.EstadoMenuDieta = false;
                this.fillBsqPedidoMenu.nIdTipoEntrada = "";
                this.EstadoMenuEntrada = true;
                this.fillBsqPedidoMenu.nIdTipoSegundo = "";
                this.EstadoMenuSegundo = true;
                this.fillBsqPedidoMenu.cObsEntrada = "";
                this.fillBsqPedidoMenu.cObsSegundo = "";
            }
        },
        abrirModalbyVendedor(item) {
            this.modalShow = !this.modalShow;
            this.fillBsqPedidoMenu.itemid = item;
            this.BuscaClientePapeletaS(item);
        },
        abrirModal(item) {
            this.modalShow = !this.modalShow;
            this.fillBsqPedidoMenu.itemid = item;
        },

        abrirEstadobyVendedor(item) {
            this.modalEstado = !this.modalEstado;
            this.fillBsqPedidoMenu.itemid = item;
            this.BuscaClientePapeletaS(item);
        },
        abrirAnularMenu(item) {
            Swal.fire({
                title: "Desea cancelar el menu?",
                text: "No podrás revertir esto.!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, dale de baja!",
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "/administracion/menu/setAnularMenu";
                    axios
                        .post(url, {
                            item,
                        })
                        .then((response) => {
                            this.cargaListMenus();
                        });

                    Swal.fire(
                        "Anulado!",
                        "Tu Menu fue dado de Baja.",
                        "success"
                    );
                }
            });
        },

        limpiarCriteriosBsq() {
            this.fillBsqPedidoMenu.nIdTipo = 3;
            this.fillBsqPedidoMenu.nIdTipoEntrada = "";
            this.fillBsqPedidoMenu.nIdTipoSegundo = "";
            this.fillBsqPedidoMenu.nIdTipoExtra = "";
            this.fillBsqPedidoMenu.cObservacion = "";
        },
        limpiarBandejaMaterial() {
            this.listDetPapeletaSalida = [];
        },

        getlistTipoMenu() {
            var url = "/administracion/Menu/ListTipoMenuCrear";
            axios.get(url).then((response) => {
                this.listTipoMenu = response.data;
                this.fillBsqPedidoMenu.nIdTipo = this.listTipoMenu[2].id;
            });
        },

        getlistEntrada() {
            var url = "/administracion/PedidoEntrada/listNow";
            axios.get(url).then((response) => {
                this.listMenuEntrada = response.data;
            });
        },

        getlistSegundo() {
            var url = "/administracion/PedidoSegundo/listNow";
            axios.get(url).then((response) => {
                this.listMenuSegundo = response.data;
            });
        },

        getlistExtra() {
            var url = "/administracion/PedidoExtra/listNow";
            axios.get(url).then((response) => {
                this.listMenuExtra = response.data;
            });
        },

        getlistDieta() {
            var url = "/administracion/PedidoDieta/listNow";
            axios.get(url).then((response) => {
                this.listMenuDieta = response.data;
            });
        },

        setRegistrarMenu() {
            if (this.validarMenu()) {
                this.modalShow = true;
                return;
            }
            this.getGuardarMenu();
        },

        validarMenu() {
            this.error = 0;
            this.mensajeError = [];
            //alert(this.fillBsqPedidoMenu.nIdTipo)

            if (this.fillBsqPedidoMenu.nIdTipo == 1) {
                if (!this.fillBsqPedidoMenu.nIdTipoEntrada) {
                    this.mensajeError.push(
                        "El Campo Entrada es un campo obligatorio"
                    );
                }
            }

            if (this.fillBsqPedidoMenu.nIdTipo == 2) {
                if (!this.fillBsqPedidoMenu.nIdTipoSegundo) {
                    this.mensajeError.push(
                        "El Campo Segundo es un campo obligatorio"
                    );
                }
            }

            if (this.fillBsqPedidoMenu.nIdTipo == 3) {
                if (!this.fillBsqPedidoMenu.nIdTipoEntrada) {
                    this.mensajeError.push(
                        "El Campo Entrada es un campo obligatorio"
                    );
                }

                if (!this.fillBsqPedidoMenu.nIdTipoSegundo) {
                    this.mensajeError.push(
                        "El Campo Segundo es un campo obligatorio"
                    );
                }
            }

            /*      if (this.fillBsqPedidoMenu.nIdTipo == 4) {
                if (!this.fillBsqPedidoMenu.nIdTipoExtra) {
                    this.mensajeError.push("El Campo Extra es un campo obligatorio");
                }
            }




            if (this.fillBsqPedidoMenu.nIdTipo == 5) {
                if (!this.fillBsqPedidoMenu.nIdTipoEntrada) {
                    this.mensajeError.push("El Campo Entrada es un campo obligatorio");
                }

                if (!this.fillBsqPedidoMenu.nIdTipoExtra) {
                    this.mensajeError.push("El Campo Extra es un campo obligatorio");
                }
            } */
            if (this.fillBsqPedidoMenu.nIdTipo == 6) {
                if (!this.fillBsqPedidoMenu.nIdTipoDieta) {
                    this.mensajeError.push(
                        "El Campo Dieta es un campo obligatorio"
                    );
                }

                if (!this.fillBsqPedidoMenu.nIdTipoDieta) {
                    this.mensajeError.push(
                        "El Campo Dieta es un campo obligatorio"
                    );
                }
            }

            if (this.mensajeError.length) {
                this.error = 1;
            }
            return this.error;
        },

        getGuardarMenu() {
            var url = "/administracion/Menu/createMenu";
            let today = new Date();
            const hora = today.toLocaleTimeString();

            axios
                .post(url, {
                    nIdTipo: this.fillBsqPedidoMenu.nIdTipo,
                    nIdUser: this.fillBsqPedidoMenu.nIdUser,
                    nIdTipoEntrada: this.fillBsqPedidoMenu.nIdTipoEntrada,
                    cObsEntrada: this.fillBsqPedidoMenu.cObsEntrada,
                    nIdTipoSegundo: this.fillBsqPedidoMenu.nIdTipoSegundo,
                    cObsSegundo: this.fillBsqPedidoMenu.cObsSegundo,
                    /*  nIdTipoExtra: this.fillBsqPedidoMenu.nIdTipoExtra,
                    cObsExtra: this.fillBsqPedidoMenu.cObsExtra, */
                    nIdTipoDieta: this.fillBsqPedidoMenu.nIdTipoDieta,
                    cObsDieta: this.fillBsqPedidoMenu.cObsDieta,

                    hora,
                })
                .then((response) => {
                    Swal.fire("Grabado!", "Nuevo Menu Agregado.", "success");

                    this.cargaListMenus();
                });
        },

        BuscaClientePapeletaS(item) {
            var url =
                "/administracion/ClientePapeletaSalida/BuscaClientePapeletaS";
            axios
                .get(url, {
                    params: {
                        item: item,
                    },
                })
                .then((response) => {
                    this.listModalVendedorAdmin = response.data;
                });
        },

        /*         getPdfPSalidabyVendedor(item) {
            var config = { responseType: "blob" };
            var url = "/administracion/papeletasalida/PapeletasalidaPdf";
            axios
                .post(
                    url,
                    {
                        params: {
                            item: item,
                        },
                    },
                    config
                )
                .then((response) => {
                    var oMyBlob = new Blob([response.data], { type: "application/pdf" });
                    var url = URL.createObjectURL(oMyBlob);
                    window.open(url);
                    //window.print();
                });
        }, */

        getlistClientAdmin() {
            var url = "/administracion/cliente/getListarAllCliente";
            axios.get(url).then((response) => {
                this.listClientAdmin = response.data;
            });
        },

        getlistClient() {
            var url = "/administracion/cliente/getListarCliente";
            axios
                .get(url, {
                    params: {
                        nIdTipo: this.fillBsqPedidoMenu.nIdUser,
                    },
                })
                .then((response) => {
                    this.listClient = response.data;
                });
        },
    },
};
</script>

<style></style>
