<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Importar Asistencias</h1>
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
                                    Criterios de Busqueda
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form id="mainFormAsist">
                                            <div class="form-group row">
                                                <input
                                                    type="file"
                                                    name="select_file"
                                                />
                                            </div>
                                        </form>
                                    </div>
                                </div>

                 <!--                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label
                                                class="col-md-1 col-form-label"
                                                >Fecha
                                            </label>
                                            <div class="col-md-9">
                                                <el-date-picker
                                                    v-model="
                                                        fillBsqImportAsist.cFecha
                                                    "
                                                    type="date"
                                                    placeholder="Ingrese una Fecha"
                                                    format="dd/MM/yyyy"
                                                    value-format="yyyy-MM-dd"
                                                >
                                                </el-date-picker>
                                                <span style="margin-left: 10px;" ><button
                                                    class="btn btn-flat btn-primary"
                                                    @click.prevent="setImportFile"
                                                >
                                                <i class="fas fa-search"></i>
                                                    Buscar
                                                </button></span>
                                            </div>
                                            </div>
                                        </div>
                                </div> -->
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button
                                            class="btn btn-flat btn-success btnWidth"
                                            @click.prevent="setImportFile"
                                        >
                                            <i class="fas fa-upload"></i>
                                            Importar
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
                                            <th>Hora</th>
                                            <th>Personal</th>
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
                                            <td v-text="item.fecha"></td>
                                            <td v-text="item.tiempo"></td>
                                            <td v-text="item.personal"></td>
                                            <td v-text="item.DNI"></td>
                                            <td v-text="item.cargo"></td>
                                            <td v-text="item.zonal"></td>
                                            <td v-text="item.estado" ></td>
                                            

                               <!--              <td>
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
                                            </td> -->
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
            fillBsqImportAsist: {
                nIdUsuario: this.$attrs.id,
                cruta: "",
                cSecondname: "",
                cLastname: "",
            },
            listPersonal: [],
            listZonal: [],

            listRolPermisoByUsuario: JSON.parse(
                sessionStorage.getItem("listRolPermisosByUsuario")
            ),
            pageNumber: 0,
            perPage: 10,
        };
    },
    mounted() {
        this.getListarZonal();
       /*  this.fillBsqImportAsist.cFecha = new Date(); */
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
            this.fillBsqImportAsist.cruta = "";
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
                        var url = "/administracion/personal/delete";
                        axios
                            .post(url, {
                                nIdPersonal: id,
                            })
                            .then((response) => {
                                this.setImportFile();
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

        setImportFile() {
            var data = new FormData(document.getElementById("mainFormAsist"));
            var url = "/administracion/asistencia/import";
            axios
                .post(url, data, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    Swal.fire({
                        position: "center",
                        icon: response.data.icon,
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    this.setlistAsistNow();
                });

        },

        setlistAsistNow() {
            var f = new Date();
            const fechaActual =
                f.getFullYear() + "-" + (f.getMonth()+1) + "-" + f.getDate();

            var url = "/administracion/asistencia/listAsistByDate";
            axios
                .get(url, {
                    params: {
                        fechaActual: fechaActual,
                    },
                })
                .then((response) => {
                    this.listPersonal= response.data
                });
        },

        cargaImportacion() {
            var url = "/administracion/asistencia/list";
            axios.get(url).then((response) => {
                console.log(response.data);
                /*  this.listUnidMed = response.data;
        this.fillregistrarCotizacion.nIdUnidMed = this.listUnidMed[7].id; */
            });
        },
    },
};
</script>

<style></style>
