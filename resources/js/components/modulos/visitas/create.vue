<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Gestión de Visitas</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Formulario Registrar Visitas
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
                                                        >Distrito :</label
                                                    >
                                                    <div class="col-md-6">
                                                        <el-select
                                                            v-model="
                                                                fillBsqVisitaCreate.nIdDistrito
                                                            "
                                                            filterable
                                                            placeholder="Seleccione una Distrito"
                                                            :style="{
                                                                width: '350px',
                                                            }"
                                                        >
                                                            <el-option
                                                                v-for="item in this
                                                                    .listTipoDistrito"
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
                                                        >Cliente :</label
                                                    >
                                                    <div class="col-md-6">
                                                        <el-select
                                                            v-model="
                                                                fillBsqVisitaCreate.nIdCliente
                                                            "
                                                            filterable
                                                            placeholder="Seleccione una Cliente"
                                                            :style="{
                                                                width: '350px',
                                                            }"
                                                        >
                                                            <el-option
                                                                v-for="item in this
                                                                    .listCliente"
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
                                    </div>

                            

                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-1 col-form-label"
                                                        >Proyecto
                                                    </label>
                                                    <div class="col-md-6">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillBsqVisitaCreate.cProyecto
                                                            "
                                                            style="width: 90%"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-2 col-form-label"
                                                    >Dirección</label
                                                >
                                                <div class="col-md-10">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-model="
                                                            fillBsqVisitaCreate.cDireccion
                                                        "
                                                        style="width: 100%"
                                                    />
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
                                                        >Estado :</label
                                                    >
                                                    <div class="col-md-6">
                                                        <el-select
                                                            v-model="
                                                                fillBsqVisitaCreate.nidEstadoObra
                                                            "
                                                            filterable
                                                            placeholder="Estado de obra"
                                                            :style="{
                                                                width: '350px',
                                                            }"
                                                        >
                                                            <el-option
                                                                v-for="item in this
                                                                    .listEstadoObra"
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
                                                        >Personal Contacto :</label
                                                    >
                                                    <div class="col-md-6">
                                                        <el-select
                                                            v-model="
                                                                fillBsqVisitaCreate.nIdContacto
                                                            "
                                                            filterable
                                                            placeholder="Estado de obra"
                                                            :style="{
                                                                width: '350px',
                                                            }"
                                                        >
                                                            <el-option
                                                                v-for="item in this
                                                                    .listContacto"
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
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-1 col-form-label"
                                                        >Nombre</label
                                                    >
                                                    <div class="col-md-6">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillBsqVisitaCreate.cNombre
                                                            "
                                                            style="width: 90%"
                                                        />
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
                                                    <div class="col-md-6">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillBsqVisitaCreate.cObservacion
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
                                                        setRegistrarVisita
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
                                </form>
                            </div>
                        </div>
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
            fillBsqVisitaCreate: {
                nIdUsuario: sessionStorage.getItem("iduser"),
                cDireccion: "",
                nIdCliente: "",
                cProyecto: "",
                nidEstadoObra: "",
                cNombre: "",
                cObservacion: "",
                nIdContacto:"",
                nIdDistrito:"",
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

            listTipoDistrito: [],
            listCliente: [],
            listEstadoObra: [],
            listContacto: [],

    

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
        this.getlistTipoDistrito();
        this.getlistCliente();
        this.cargaListEstadoObras();
        this.cargaListContacto();
    },

    methods: {
  

        cargaListEstadoObras() {
            var url = "/administracion/EstadoObra/list";
            axios.get(url).then((response) => {
                this.listEstadoObra = response.data;
            });
        },

        cargaListContacto() {
            var url = "/administracion/personalContacto/list";
            axios.get(url).then((response) => {
                this.listContacto = response.data;
            });
        },

        cargaFechaActual() {
            this.fillBsqVisitaCreate.dFecha = new Date();
        },

        abrirModalbyVendedor(item) {
            this.modalShow = !this.modalShow;
            this.fillBsqVisitaCreate.itemid = item;
            
        },
        abrirModal(item) {
            this.modalShow = !this.modalShow;
            this.fillBsqVisitaCreate.itemid = item;
        },

        abrirEstadobyVendedor(item) {
            this.modalEstado = !this.modalEstado;
            this.fillBsqVisitaCreate.itemid = item;
           
        },


        limpiarCriteriosBsq() {
            this.fillBsqVisitaCreate.nIdCliente = '';
            this.fillBsqVisitaCreate.cProyecto = "";
            this.fillBsqVisitaCreate.nidEstadoObra = "";
            this.fillBsqVisitaCreate.nIdContacto = "";
            this.fillBsqVisitaCreate.cNombre = "";
            this.fillBsqVisitaCreate.cObservacion = "";
            this.fillBsqVisitaCreate.cDireccion = "";
        },
        limpiarBandejaMaterial() {
            this.listDetPapeletaSalida = [];
        },

        getlistTipoDistrito() {
            var url = "/administracion/distrito/index";
            axios.get(url).then((response) => {
                this.listTipoDistrito = response.data;
                this.fillBsqVisitaCreate.nIdDistrito =
                    this.listTipoDistrito[0].id;
            });
        },

        getlistCliente() {
            var url = "/administracion/cliente/getListarCliente";
            axios
                .get(url, {
                    params: {
                        nIdVendedor: this.fillBsqVisitaCreate.nIdUsuario,
                    },
                })
                .then((response) => {
                    /* (this.fillBsqCotizacion.nIdCliente = ""), */
                    
                        (this.listCliente = response.data)
                    
                });
        },

        getlistExtra() {
            var url = "/administracion/PedidoExtra/listNow";
            axios.get(url).then((response) => {
                this.listMenuExtra = response.data;
            });
        },

        setRegistrarVisita() {
            if (this.validarVisita()) {
                this.modalShow = true;
                return;
            }
            this.setGuardarVisita();
        },

        validarVisita() {
            this.error = 0;
            this.mensajeError = [];
            //alert(this.fillBsqVisitaCreate.nIdTipo)

            if (!this.fillBsqVisitaCreate.nIdCliente) {
                this.mensajeError.push(
                    "El Campo Cliente es un campo obligatorio"
                );
            }

            if (!this.fillBsqVisitaCreate.cDireccion) {
                this.mensajeError.push(
                    "El Campo Dirección es un campo obligatorio"
                );
            }

            if (!this.fillBsqVisitaCreate.cProyecto) {
                this.mensajeError.push(
                    "El Campo Proyecto es un campo obligatorio"
                );
            }
                if (!this.fillBsqVisitaCreate.nidEstadoObra) {
                    this.mensajeError.push(
                        "El Campo Estado es un campo obligatorio"
                    );
                }

                if (!this.fillBsqVisitaCreate.cNombre) {
                    this.mensajeError.push(
                        "El Campo Contacto es un campo obligatorio"
                    );
                }

        
            

            if (this.mensajeError.length) {
                this.error = 1;
            }
            return this.error;
        },

        setGuardarVisita() {
            var url = "/administracion/visita/create";
            /* let today = new Date();
            const hora = today.toLocaleTimeString(); */

            axios
                .post(url, {
                    nIdDistrito: this.fillBsqVisitaCreate.nIdDistrito,
                    cDireccion: this.fillBsqVisitaCreate.cDireccion,
                    nIdCliente : this.fillBsqVisitaCreate.nIdCliente,
                    cProyecto : this.fillBsqVisitaCreate.cProyecto,
                    nidEstadoObra : this.fillBsqVisitaCreate.nidEstadoObra,
                    nIdContacto : this.fillBsqVisitaCreate.nIdContacto,
                    cNombre : this.fillBsqVisitaCreate.cNombre,
                    cObservacion : this.fillBsqVisitaCreate.cObservacion,
                    nIdUsuario : this.fillBsqVisitaCreate.nIdUsuario

             

                    /* hora, */
                })
                .then((response) => {
                    Swal.fire("Grabado!", "Visita Agregada.", "success");
                    this. limpiarCriteriosBsq();

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
                        nIdTipo: this.fillBsqVisitaCreate.nIdUser,
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
