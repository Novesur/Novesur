<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Crear Personal</h1>
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
                            :to="'/personal/index'"
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
                                    Formulario Registrar Personal
                                </h3>
                            </div>
                            <div class="card-body">
                                <form role="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-form-label"
                                                    >Nr°</label
                                                >
                                                <div class="col-md-1">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-model="
                                                            fillCrearPersonal.cNumPersonal
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-form-label"
                                                    >Nombres</label
                                                >
                                                <div class="col-md-9">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-model="
                                                            fillCrearPersonal.cNombres
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-form-label"
                                                    >Apellido Paterno</label
                                                >
                                                <div class="col-md-9">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-model="
                                                            fillCrearPersonal.cSecondname
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-form-label"
                                                    >Apellido Materno</label
                                                >
                                                <div class="col-md-9">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-model="
                                                            fillCrearPersonal.cLastname
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-form-label"
                                                    >DNI</label
                                                >
                                                <div class="col-md-9">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-model="
                                                            fillCrearPersonal.cDni
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-form-label"
                                                    >Cargo</label
                                                >
                                                <div class="col-md-9">
                                                    <el-select
                                                        v-model="
                                                            fillCrearPersonal.nIdCargo
                                                        "
                                                        placeholder="Seleccione un Rol"
                                                        clearable
                                                    >
                                                        <el-option
                                                            v-for="item in listCargo"
                                                            :key="item.id"
                                                            :label="item.nombre"
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
                                                    >Zonal</label
                                                >
                                                <div class="col-md-9">
                                                    <el-select
                                                        v-model="
                                                            fillCrearPersonal.nIdZonal
                                                        "
                                                        placeholder="Seleccione un Rol"
                                                        clearable
                                                    >
                                                        <el-option
                                                            v-for="item in listZonal"
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
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button
                                            class="btn btn-flat btn-info btnWidth"
                                            @click.prevent="setValidarPersonal"
                                        >
                                            Registrar
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
            fillCrearPersonal: {
                cNombres: "",
                cSecondname: "",
                cLastname: "",
                cNumPersonal: "",
                nIdCargo: "",
                cDni: "",
                nIdZonal: "",
            },
            listZonal: [],
            listCargo: [],
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
      this.getListarAlmacen();
      this.getListarGradoAcad();
      this.getListCargo();
      this.getListarZonal();
    },
    methods: {
        abrirModal() {
            this.modalShow = !this.modalShow;
        },
        getListarZonal() {
            var url = "/administracion/zonal/list";
            axios.get(url).then((response) => {
                this.listZonal = response.data;
            });
        },

        getListCargo() {
            var url = "/administracion/cargo/list";
            axios.get(url).then((response) => {
                this.listCargo = response.data;
            });
        },
        getListarAlmacen() {
            var url = "/administracion/almacen/listAlmacen";
            axios.get(url).then((response) => {
                this.listAlmacen = response.data;
            });
        },

        getListarGradoAcad() {
            var url = "/administracion/usuario/getListarGradoAcad";
            axios.get(url).then((response) => {
                this.listGradoAcad = response.data;
            });
        },

        validarRegistrarPersonal() {
            this.error = 0;
            this.mensajeError = [];
            if (!this.fillCrearPersonal.cNombres) {
                this.mensajeError.push("El Nombre Obligatorio");
            }

            if (!this.fillCrearPersonal.cSecondname) {
                this.mensajeError.push("Apellido Paterno Obligatorio");
            }
            if (!this.fillCrearPersonal.cLastname) {
                this.mensajeError.push("Apellido Materno Obligatorio");
            }
            if (!this.fillCrearPersonal.cDni) {
                this.mensajeError.push("El Numero DNI es Obligatorio");
            }

            if (!this.fillCrearPersonal.nIdZonal) {
                this.mensajeError.push("La Zona es Obligatorio");
            }

            if (!this.fillCrearPersonal.nIdCargo) {
                this.mensajeError.push("El Cargo es Obligatorio");
            }

            if (this.mensajeError.length) {
                this.error = 1;
            }
            return this.error;
        },

        limpiarCriteriosBsq() {
            this.fillCrearPersonal.cNumPersonal = "";
            this.fillCrearPersonal.cNombres = "";
            this.fillCrearPersonal.cSecondname = "";
            this.fillCrearPersonal.cLastname = "";
            this.fillCrearPersonal.cDni = "";
            this.fillCrearPersonal.cNombre = "";
            this.fillCrearPersonal.cEmail = "";
            this.fillCrearPersonal.cPassword = "";
            this.fillCrearPersonal.nIdCargo = "";
            this.fillCrearPersonal.nIdZonal = "";
        },

        setValidarPersonal() {
            if (this.validarRegistrarPersonal()) {
                this.modalShow = true; 
                return;
            }
            this.setRegistrarPersonal();
        },

        setRegistrarPersonal() {
            var url = "/administracion/personal/create";
            axios
                .post(url, {
                    cNumPersonal: this.fillCrearPersonal.cNumPersonal,
                    cNombres: this.fillCrearPersonal.cNombres,
                    cSecondname: this.fillCrearPersonal.cSecondname,
                    cLastname: this.fillCrearPersonal.cLastname,
                    cDni: this.fillCrearPersonal.cDni,
                    nIdCargo: this.fillCrearPersonal.nIdCargo,
                    cEmail: this.fillCrearPersonal.cEmail,
                    cPassword: this.fillCrearPersonal.cDni,
                    nIdZonal: this.fillCrearPersonal.nIdZonal, 

                })
                .then((response) => {
                    
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });
                    this.$router.push("/personal/index");
                });
        },
    },
};
</script>

<style></style>
