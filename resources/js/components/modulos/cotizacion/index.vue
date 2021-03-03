<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Cotizaciones</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/material/crear'">
              <i class="fas fa-plus-square"></i>Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterios de Busqueda</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="col-md-12">
                    <div class="row">
                      <template
                        v-if="
                          listRolPermisoByUsuario.includes('admin.listado_coti')
                        "
                      >
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"
                              >Vendedor</label
                            >
                            <div class="col-md-6">
                              <el-select
                                v-model="fillBsqCotizacion.nIdVendedor"
                                filterable
                                placeholder="Seleccione una Vendedor"
                                :style="{ width: '350px' }"
                                clearable
                              >
                                <el-option
                                  v-for="item in listVendedorAdmin"
                                  :key="item.id"
                                  :label="
                                    item.firstname +
                                    ' ' +
                                    item.secondname +
                                    ' ' +
                                    item.lastname
                                  "
                                  :value="item.id"
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
                            <label class="col-md-3 col-form-label"
                              >Vendedor</label
                            >
                            <div class="col-md-6">
                              <el-select
                                v-model="fillBsqCotizacion.nIdVendedor"
                                filterable
                                placeholder="Seleccione una Vendedor"
                                :style="{ width: '350px' }"
                                clearable
                              >
                                <el-option
                                  v-for="item in listVendedorUser"
                                  :key="item.id"
                                  :label="
                                    item.firstname +
                                    ' ' +
                                    item.secondname +
                                    ' ' +
                                    item.lastname
                                  "
                                  :value="item.id"
                                >
                                </el-option>
                              </el-select>
                            </div>
                          </div>
                        </div>
                      </template>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Cliente</label>
                          <div class="col-md-6">
                            <el-select
                              v-model="fillBsqCotizacion.nIdCliente"
                              filterable
                              placeholder="Seleccione un cliente"
                              :style="{ width: '350px' }"
                              clearable
                            >
                              <el-option
                                v-for="item in listCliente"
                                :key="item.id"
                                :label="item.razonsocial"
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
                            <label class="col-md-3 col-form-label">Fecha</label>
                            <el-date-picker
                              v-model="fillBsqCotizacion.dFecha"
                              type="date"
                              placeholder="Ingrese la fecha"
                              format="dd/MM/yyyy"
                              value-format="yyyy-MM-dd"
                            >
                            </el-date-picker>
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
                      @click.prevent="getListCliente"
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
                <h3 class="card-title">Bandeja de Resultados</h3>
              </div>
              <div class="card-body table-responsive">
                <table
                  class="table table-hover table-head-fixed text-nowrap projects"
                >
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(item, index) in listClientePaginated"
                      :key="index"
                    >
                      <td v-text="item.nombre"></td>
                      <td>
                        <router-link
                          class="btn btn-primary btn-sm"
                          :to="{
                            name: 'material.editar',
                            params: { id: item.id },
                          }"
                        >
                          <i class="fas fa-pencil-alt"></i>Editar
                        </router-link>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="card-footer">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item" v-if="pageNumber > 0">
                      <a href="#" class="page-link" @click.prevent="prevPage"
                        >Ant</a
                      >
                    </li>
                    <li
                      class="page-item"
                      v-for="(page, index) in pagesList"
                      :key="index"
                      :class="page == pageNumber ? 'active' : ''"
                    >
                      <a
                        href="#"
                        class="page-link"
                        @click.prevent="selectPage(page)"
                      >
                        {{ page + 1 }}</a
                      >
                    </li>
                    <li class="page-item" v-if="pageNumber < pageCount - 1">
                      <a href="#" class="page-link" @click.prevent="nextPage"
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
      fillBsqCotizacion: {
        cNombre: "",
        nIdCliente: "",
        nIdVendedor: "",
        dFecha: "",
        nIdUser: sessionStorage.getItem("iduser"),
      },
      listCliente: [],
      listVendedorAdmin: [],
      listVendedorUser:[],
      pageNumber: 0,
      perPage: 10,
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
    this.getListCliente();
    this.getlistVendedorAdmin();
    this.cargaFechaActual();
    this.getlistVendedorxUsu();
  },

  computed: {
    pageCount() {
      let a = this.listCliente.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listClientePaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listCliente.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listCliente.length,
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
      this.fillBsqCotizacion.dFecha = new Date();
    },
    limpiarCriteriosBsq() {
      this.fillBsqCotizacion.cNombre = "";
    },
    limpiarBandejaMaterial() {
      this.listCliente = [];
    },
    getListCliente() {
      var url = "/administracion/cliente/getListarCliente";
      axios.get(url).then((response) => {
        this.listCliente = response.data;
      });
    },
    getlistVendedorAdmin() {
      var url = "/administracion/usuario/getListarUsusarios";
      axios.get(url).then((response) => {
        this.listVendedorAdmin = response.data;
      });
    },
        getlistVendedorxUsu() {
      var url = "/administracion/usuario/getListarUsusariosbyId";
      axios.get(url,{params:{
          'nIdUsuario': this.fillBsqCotizacion.nIdUser,
      }}).then((response) => {
        this.listVendedorUser = response.data;
          this.fillBsqCotizacion.nIdVendedor = this.listVendedorUser[0].id;

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

<style>
</style>
