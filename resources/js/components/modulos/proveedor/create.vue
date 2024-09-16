<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Crear Proveedor</h1>
                </div>
            </div>
        </div>

        <div class="content container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <router-link class="btn btn-info btn-sm" :to="'/proveedor'">
                            <i class="fas fa-plus-square"></i> Regresar
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Formulario Registrar Proveedor</h3>
                            </div>

                            <div class="card-body">
                                <form role="form">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Tipo Compra</label>
                                                <div class="col-md-9">
                                                    <el-select v-model="fillRegistrarProveedor.nIdtipoCompra
                                                        " placeholder="Seleccione un Tipo">
                                                        <el-option v-for="item in listTipoCompra" :key="item.id"
                                                            :label="item.nombre" :value="item.id">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </div>


                                    </div>




                                    <div class="row">
                                        <template v-if="fillRegistrarProveedor.nIdtipoCompra == 1">

                                            <div class="col-md-5">
                                                <div class="form-group row">
                                                    <label class="col-md-2 col-form-label">Nombre</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"
                                                            v-model="fillRegistrarProveedor.cNombreNacional"
                                                            :disabled="true" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group row">
                                                    <label class="col-md-2 col-form-label">Ruc o DNI</label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control"
                                                            v-model="fillRegistrarProveedor.cRuc" :maxlength="11"
                                                            :disabled="disabledbtnRuc" />
                                                    </div>
                                                </div>

                                            </div>



                                            <div class="col-md-2">
                                                <div class="input-group">
                                                    <span>
                                                        <button class="btn btn-success btn-sm"
                                                            @click.prevent="consultaRuc">
                                                            Buscar Por Ruc
                                                        </button>
                                                        <button class="btn btn-primary btn-sm"
                                                            @click.prevent="consultaDNI">
                                                            Buscar Por DNI
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </template>
                                        <template v-else>
                                            <div class="col-md-5">
                                                <div class="form-group row">
                                                    <label class="col-md-2 col-form-label">Nombre</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"
                                                            v-model="fillRegistrarProveedor.cNombreImportado" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group row">
                                                    <label class="col-md-2 col-form-label">Codigo</label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control"
                                                            v-model="fillRegistrarProveedor.cCodigo" :maxlength="13"
                                                            :disabled="disabledbtnRuc" />
                                                    </div>
                                                </div>

                                            </div>

                                        </template>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-1 col-form-label">Dirección</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                        v-model="fillRegistrarProveedor.cDireccion" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Telefono</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        v-model="fillRegistrarProveedor.cTelefono" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Email</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control"
                                                        v-model="fillRegistrarProveedor.cEmail" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Contacto</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        v-model="fillRegistrarProveedor.cContacto" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Cuenta1 en S/.</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        v-model="fillRegistrarProveedor.cCuentaNro1"
                                                        placeholder="Nro Cuenta / Banco" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Cuenta2 en S/.</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        v-model="fillRegistrarProveedor.cCuentaNro2"
                                                        placeholder="Nro Cuenta / Banco" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Cuenta3 en S/.</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        v-model="fillRegistrarProveedor.cCuentaNro3"
                                                        placeholder="Nro Cuenta / Banco" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" v-if="fillRegistrarProveedor.nIdtipoCompra == 2">

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Codigo Swift</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        v-model="fillRegistrarProveedor.swift"
                                                        :maxlength="15"
                                                        />
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button class="btn btn-flat btn-info btnWidth"
                                            @click.prevent="setRegistrarProveedor">
                                            Registrar
                                        </button>
                                        <button class="btn btn-flat btn-default btnWidth"
                                            @click.prevent="limpiarProveedorBsq">
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
            fillRegistrarProveedor: {
                cNombreNacional: "",
                cNombreImportado: "",
                cRuc: "",
                cCodigo: "",
                cDireccion: "",
                cTelefono: "",
                cEmail: "",
                cContacto: "",
                cCuentaNro1: "",
                cCuentaNro2: "",
                cCuentaNro3: "",
                nIdtipoCompra: "",
                swift:"",
            },
            listTipoCompra: [],
            disabledbtnRuc: false,
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
        this.getListTipoCompra();
        this.fillRegistrarProveedor.nIdtipoCompra = 1
    },
    methods: {

        getListTipoCompra() {
            var url = "/administracion/ordenCompra/listTipoOrdenCompra";
            axios.get(url).then((response) => {
                this.listTipoCompra = response.data;
            });
        },

        consultaRuc() {
            var url = "/administracion/cliente/consultaRuc";
            axios
                .post(url, {
                    cRuc: this.fillRegistrarProveedor.cRuc,
                })
                .then((response) => {
                    if (response.data.success == false) {
                        this.estadobutton = true;
                        (this.fillRegistrarProveedor.cRuc = ""),
                            (this.fillRegistrarProveedor.cDireccion = "");

                        Swal.fire({
                            position: "center",
                            icon: "info",
                            title: "Ruc no encontrado o numero equivocado",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        this.estadobutton = true;
                    } else {
                        (this.fillRegistrarProveedor.cNombreNacional = response.data.razonSocial),
                            (this.fillRegistrarProveedor.cDireccion = response.data.direccion),
                            (this.estadobutton = false);
                        this.disabledbtnRuc = true;
                    }
                });
        },

        consultaDNI() {
            var url = "/administracion/cliente/consultaDNI";
            axios
                .post(url, {
                    cRuc: this.fillRegistrarProveedor.cRuc,
                })
                .then((response) => {
                    if (response.data.success == false) {
                        this.estadobutton = true;
                        (this.fillRegistrarProveedor.cRSocial = ""),
                            (this.fillRegistrarProveedor.cDireccion = "");

                        Swal.fire({
                            position: "center",
                            icon: "info",
                            title: "DNI no encontrado o numero equivocado",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        this.estadobutton = false;
                    } else {
                        (this.fillRegistrarProveedor.cNombreNacional =
                            response.data.nombres +
                            " " +
                            response.data.apellidoPaterno +
                            " " +
                            response.data.apellidoMaterno),
                            (this.fillRegistrarProveedor.cDireccion = response.data.direccion);
                        this.estadobutton = false;
                        this.disabledbtnRuc = true;
                    }
                });
        },






        abrirModal() {
            this.modalShow = !this.modalShow;
        },
        limpiarProveedorBsq() {
            this.fillRegistrarProveedor.cNombreNacional = "";
            this.fillRegistrarProveedor.cRuc = "";
            this.fillRegistrarProveedor.cDireccion = "";
            this.fillRegistrarProveedor.cTelefono = "";
            this.fillRegistrarProveedor.cEmail = "";
            this.fillRegistrarProveedor.cContacto = "";
            this.fillRegistrarProveedor.cCuentaNro1 = "";
            this.fillRegistrarProveedor.cCuentaNro2 = "";
            this.fillRegistrarProveedor.cCuentaNro3 = "";
            this.disabledbtnRuc = false;
        },
        limpiarBandejaProveedor() {
            this.listProveedor = [];
        },
        setRegistrarProveedor() {
            if (this.validarProveedor()) {
                this.modalShow = true;
                return;
            }
            this.setGuardarProveedor();
        },
        setGuardarProveedor() {

            var url = "/administracion/proveedor/setRegistrarProveedor";
            axios
                .post(url, {
                    cNombreNacional: this.fillRegistrarProveedor.cNombreNacional,
                    cNombreImportado: this.fillRegistrarProveedor.cNombreImportado,
                    cCodigo: this.fillRegistrarProveedor.cCodigo,
                    cRuc: this.fillRegistrarProveedor.cRuc,
                    cDireccion: this.fillRegistrarProveedor.cDireccion,
                    cTelefono: this.fillRegistrarProveedor.cTelefono,
                    cEmail: this.fillRegistrarProveedor.cEmail,
                    cContacto: this.fillRegistrarProveedor.cContacto,
                    cCuentaNro1: this.fillRegistrarProveedor.cCuentaNro1,
                    cCuentaNro2: this.fillRegistrarProveedor.cCuentaNro2,
                    cCuentaNro3: this.fillRegistrarProveedor.cCuentaNro3,
                    nIdtipoCompra: this.fillRegistrarProveedor.nIdtipoCompra,
                    swift: this.fillRegistrarProveedor.swift,

                })
                .then((response) => {
                    Swal.fire({
                        position: "center",
                        icon: response.data.icon,
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    this.$router.push("/proveedor");
                });
        },
        validarProveedor() {
            this.error = 0;
            this.mensajeError = [];
            if (this.fillRegistrarProveedor.nIdtipoCompra == 1) {
                if (!this.fillRegistrarProveedor.cNombreNacional) {
                    this.mensajeError.push("El Campo Nombre es un campo obligatorio");

                }

                if (!this.fillRegistrarProveedor.cRuc) {
                    this.mensajeError.push("El Campo Ruc es un campo obligatorio");
                }
            } else {
                if (!this.fillRegistrarProveedor.cNombreImportado) {
                    this.mensajeError.push("El Campo Nombre es un campo obligatorio");
                }

                if (!this.fillRegistrarProveedor.cCodigo) {
                    this.mensajeError.push("El Campo Codigo es un campo obligatorio");
                }
            }


            if (!this.fillRegistrarProveedor.cDireccion) {
                this.mensajeError.push("El Campo Direccion es un campo obligatorio");
            }

            if (!this.fillRegistrarProveedor.cTelefono) {
                this.mensajeError.push("El Campo Telefono es un campo obligatorio");
            }

            if (!this.fillRegistrarProveedor.cEmail) {
                this.mensajeError.push("El Campo Email es un campo obligatorio");
            }

            if (!this.fillRegistrarProveedor.cContacto) {
                this.mensajeError.push("El Campo Contacto es un campo obligatorio");
            }

            if (this.mensajeError.length) {
                this.error = 1;
            }
            return this.error;
        },
    },
};
</script>

<style></style>
