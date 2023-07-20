<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Editar Personal</h1>
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
                                    Formulario Editar Personal
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
                                                            fillEditPersonal.cNumPersonal
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
                                                            fillEditPersonal.cNombres
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
                                                            fillEditPersonal.cSecondname
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
                                                            fillEditPersonal.cLastname
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
                                                            fillEditPersonal.cDni
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
                                                            fillEditPersonal.nIdCargo
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
                                                            fillEditPersonal.nIdZonal
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

                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-form-label"
                                                    >Estado</label
                                                >
                                                <div class="col-md-9">
                                                    <el-checkbox v-model="estado">{{this.fillEditPersonal.datEstado}}</el-checkbox>
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
                                            Editar
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
            fillEditPersonal: {
                nIdPersonal: this.$attrs.id,
                cNombres: "",
                cSecondname: "",
                cLastname: "",
                cNumPersonal: "",
                nIdCargo: "",
                cDni: "",
                nIdZonal: "",
                datEstado:"",
            },
            estado : "",
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
      this.getDatoPersonalById();
    },

    watch: {
        estado(value){
            if(value === true){
                this.fillEditPersonal.datEstado='Activo'
            }else{
                this.fillEditPersonal.datEstado='Inactivo'
            }
        }
    
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
            if (!this.fillEditPersonal.cNombres) {
                this.mensajeError.push("El Nombre Obligatorio");
            }

            if (!this.fillEditPersonal.cSecondname) {
                this.mensajeError.push("Apellido Paterno Obligatorio");
            }
            if (!this.fillEditPersonal.cLastname) {
                this.mensajeError.push("Apellido Materno Obligatorio");
            }
            if (!this.fillEditPersonal.cDni) {
                this.mensajeError.push("El Numero DNI es Obligatorio");
            }

            if (!this.fillEditPersonal.nIdZonal) {
                this.mensajeError.push("La Zona es Obligatorio");
            }

            if (!this.fillEditPersonal.nIdCargo) {
                this.mensajeError.push("El Cargo es Obligatorio");
            }

            if (this.mensajeError.length) {
                this.error = 1;
            }
            return this.error;
        },

        limpiarCriteriosBsq() {
            this.fillEditPersonal.cNumPersonal = "";
            this.fillEditPersonal.cNombres = "";
            this.fillEditPersonal.cSecondname = "";
            this.fillEditPersonal.cLastname = "";
            this.fillEditPersonal.cDni = "";
            this.fillEditPersonal.cNombre = "";
            this.fillEditPersonal.cEmail = "";
            this.fillEditPersonal.cPassword = "";
            this.fillEditPersonal.nIdCargo = "";
            this.fillEditPersonal.nIdZonal = "";
        },

        setValidarPersonal() {
            if (this.validarRegistrarPersonal()) {
                this.modalShow = true;
                return;
            }
            this.setEditPersonal();
        },

        setEditPersonal() {
            var url = "/administracion/personal/edit";
            axios
                .post(url, {
                    nIdPersonal : this.fillEditPersonal.nIdPersonal,
                    cNumPersonal: this.fillEditPersonal.cNumPersonal,
                    cNombres: this.fillEditPersonal.cNombres,
                    cSecondname: this.fillEditPersonal.cSecondname,
                    cLastname: this.fillEditPersonal.cLastname,
                    cDni: this.fillEditPersonal.cDni,
                    nIdCargo: this.fillEditPersonal.nIdCargo,
                    cEmail: this.fillEditPersonal.cEmail,
                    cPassword: this.fillEditPersonal.cDni,
                    nIdZonal: this.fillEditPersonal.nIdZonal, 
                    estado: this.estado


                })
                .then((response) => {
                    this.$router.push("/personal/index");
                });
        },

        getDatoPersonalById(){
            var url = "/administracion/personal/DatoPersonalById";
            axios
                .get(url, {
                    params: {
                        nIdPersonal: this.fillEditPersonal.nIdPersonal,
                    },
                })
                .then((response) => {
                    console.log(response.data)
                    this.fillEditPersonal.cNumPersonal =response.data.codigo,
                    this.fillEditPersonal.cNombres =  response.data.nombres,
                    this.fillEditPersonal.cSecondname = response.data.ApPaterno,
                    this.fillEditPersonal.cLastname = response.data.ApMaterno,
                    this.fillEditPersonal.cDni = response.data.DNI,
                    this.fillEditPersonal.nIdCargo = response.data.cargo_personal_id,
                    this.fillEditPersonal.nIdZonal = response.data.zonal_id
                    if(response.data.estado === 'A'){
                        this.estado=true
                        this.fillEditPersonal.datEstado= 'Activo'
                    }else{
                        this.estado=false
                        this.fillEditPersonal.datEstado= 'Inactivo'
                    }


             
                });
        }
    },
};
</script>

<style></style>
