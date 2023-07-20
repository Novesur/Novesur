<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Personal</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <template
                            v-if="
                                listRolPermisoByUsuario.includes(
                                    'personal.crear'
                                )
                            "
                        >
                            <router-link
                                class="btn btn-info btn-sm"
                                :to="{ name: 'personal.create' }"
                            >
                                <i class="fas fa-plus-square"></i>Nuevo Personal
                            </router-link>
                        </template>
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
                                <form role="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-form-label"
                                                    >Nombre</label
                                                >
                                                <div class="col-md-9">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-model="
                                                            fillBsqPersonal.cFirstname
                                                        "
                                                        @keyup.enter="
                                                            getListarPersonal
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
                                                            fillBsqPersonal.cDNI
                                                        "
                                                        @keyup.enter="
                                                            getListarPersonal
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
                                                    >Zonal</label
                                                >
                                                <div class="col-md-6">
                                                    <el-select
                                                        v-model="
                                                            fillBsqPersonal.cZonal
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

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-form-label"
                                                    >Cargo</label
                                                >
                                                <div class="col-md-6">
                                                    <el-select
                                                        v-model="
                                                            fillBsqPersonal.cCargo
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
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button
                                            class="btn btn-flat btn-info btnWidth"
                                            @click.prevent="getListarPersonal"
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
                                            <th>Nombre</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>DNI</th>
                                            <th>Zona</th>
                                            <th>Cargo</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                item, index
                                            ) in listarPersonalPaginated"
                                            :key="index"
                                        >
                                            <td v-text="item.nombres"></td>
                                            <td v-text="item.ApPaterno"></td>
                                            <td v-text="item.ApMaterno"></td>
                                            <td v-text="item.DNI"></td>
                                            <td v-text="item.cargo.nombre"></td>
                                            <td v-text="item.zonal.nombre"></td>
                                            <td v-if="item.estado === 'A'">Activo</td>
                                            <td v-else style="color: red;">Inactivo</td>
                                          

                                            <td>
                                                <router-link
                                                    class="btn btn-info btn-sm"
                                                    :to="{
                                                        name: 'personal.edit',
                                                        params: { id: item.id },
                                                    }"
                                                >
                                                    <i
                                                        class="fas fa-pencil-alt"
                                                    ></i
                                                    >Editar
                                                </router-link>
                                          

                                                <button
                                                    class="btn btn-danger btn-sm"
                                                    @click.prevent="
                                                        setConfirmaDeletePersonal(
                                                            item.id
                                                        )
                                                    "
                                                >
                                                    <i class="fas fa-trash"></i
                                                    >Dar de Baja
                                                </button>
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
                                            :class="
                                                page == pageNumber
                                                    ? 'active'
                                                    : ''
                                            "
                                        >
                                            <a
                                                href="#"
                                                class="page-link"
                                                @click.prevent="
                                                    SelectPage(page)
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
    </div>
</template>

<script>
export default {
    data() {
        return {
            fillBsqPersonal: {
                nIdUsuario: this.$attrs.id,
                cFirstname: "",
                cSecondname: "",
                cLastname: "",
                cDNI: "",
                cZonal: "",
                cCargo:"",
            },
            listPersonal: [],
            listZonal: [],
            listCargo: [],
            listRolPermisoByUsuario: JSON.parse(
                sessionStorage.getItem("listRolPermisosByUsuario")
            ),
            pageNumber: 0,
            perPage: 10,
        };
    },
    mounted(){
       this.getListCargo();
      this.getListarZonal();
    },
    computed: {
        pageCount() {
            let a = this.listPersonal.length,
                b = this.perPage;
            return Math.ceil(a / b);
        },
        listarPersonalPaginated() {
            let inicio = this.pageNumber * this.perPage,
                fin = inicio + this.perPage;
            return this.listPersonal.slice(inicio, fin);
        },
        pagesList() {
            let a = this.listPersonal.length,
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
        limpiarCriteriosBsq() {
            this.fillBsqPersonal.cDNI = "";
            this.fillBsqPersonal.cFirstname = "";
            this.fillBsqPersonal.cZonal = "";
        },
        limpiarBandejaUsuario() {
            this.listPersonal = [];
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
        getListarPersonal() {
            var url = "/administracion/personal/index";
            axios
                .get(url, {
                    params: {
                        cFirstname: this.fillBsqPersonal.cFirstname,
                        cDNI: this.fillBsqPersonal.cDNI,
                        cZonal: this.fillBsqPersonal.cZonal,
                        cCargo: this.fillBsqPersonal.cCargo
                    },
                })
                .then((response) => {
                    this.inicializarPaginacion();
                    console.log(response.data);
                    this.listPersonal = response.data;
                });
        },
        nextPage() {
            this.pageNumber++;
        },
        prevPage() {
            this.pageNumber--;
        },
        SelectPage(page) {
            this.pageNumber = page;
        },
        inicializarPaginacion() {
            this.pageNumber = 0;
        },
        setConfirmaDeletePersonal(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger",
                },
                buttonsStyling: false,
            });

            swalWithBootstrapButtons
                .fire({
                    title: "Confirma que desea Dar de baja?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Si, Dale de baja!",
                    cancelButtonText: "No, cancelalo!",
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        var url =
                            "/administracion/personal/delete"; 
                        axios
                            .post(url, {
                                nIdPersonal: id,
                            })
                            .then((response) => {
                                this.getListarPersonal();
                            });
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            "Cancelado",
                            "Se cancelo el proceso",
                            "error"
                        );
                    }
                });
        },
    },
};
</script>

<style></style>
