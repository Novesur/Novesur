<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Clientes</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <template
              v-if="listRolPermisoByUsuario.includes('create.clientes')"
            >
              <router-link class="btn btn-info btn-sm" :to="'/cliente/create'">
                <i class="fas fa-plus-square"></i> Nuevo Clientes
              </router-link>
            </template>

            <template v-if="listRolPermisoByUsuario.includes('cliente.Excel')">
              <button
                class="btn btn-success btn-sm"
                @click.prevent="getExcelCliente"
              >
                <span><i class="fas fa-file-excel"></i> EXCEL</span>
              </button>
            </template>
          </div>
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
                        <label class="col-md-2 col-form-label"
                          >Razon Social</label
                        >
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillBsqProveedor.cNombre"
                            @keyup.enter="getListarCliente"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Ruc</label>
                        <div class="col-md-5">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillBsqProveedor.cRuc"
                            v-int
                            :maxlength="11"
                            @keyup.enter="getListarCliente"
                          />
                        </div>
                      </div>
                    </div>
                    <template
                      v-if="listRolPermisoByUsuario.includes('consulta.ventas')"
                    >
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-md-1 col-form-label"
                            >Vendedor</label
                          >
                          <div class="col-md-9">
                            <el-select
                              v-model="fillBsqProveedor.nIdVendedor"
                              style="width: 100%"
                              filterable
                              placeholder="Select"
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
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="getListarCliente"
                    >
                      Buscar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="limpiarProveedorBsq"
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
                  class="
                    table table-hover table-head-fixed
                    text-nowrap
                    projects
                  "
                >
                  <thead>
                    <tr>
                      <th>Cotizar</th>
                      <th>Acciones</th>
                      <th>Vendedor</th>
                      <th>Razon Social</th>
                      <th>Ruc</th>
                      <th>Atencion</th>
                      <th>Telefono</th>
                      <th>Celular</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(item, index) in listarClientesPaginated"
                      :key="index"
                    >
                      <td>
                        <template
                          v-if="
                            listRolPermisoByUsuario.includes(
                              'cotizacion.create'
                            )
                          "
                        >
                          <router-link
                            class="btn btn-success btn-sm"
                            :to="{
                              name: 'cotizacion.create',
                              params: { id: item.id },
                            }"
                          >
                            <i class="far fa-clipboard"></i> Cotizar
                          </router-link>
                        </template>
                      </td>

                      <template
                        v-if="
                          listRolPermisoByUsuario.includes('cliente.editar')
                        "
                      >
                        <td>
                          <router-link
                            class="btn btn-info btn-sm"
                            :to="{
                              name: 'cliente.editar',
                              params: { id: item.id },
                            }"
                          >
                            <i class="fas fa-pencil-alt"></i>Editar
                          </router-link>
                        </td>
                      </template>
                      <td>
                        {{
                          item.user == null
                            ? "Dado de Baja"
                            : item.user.fullname
                        }}
                      </td>

                      <td v-text="item.razonsocial"></td>
                      <td v-text="item.ruc"></td>
                      <td v-text="item.atencion"></td>
                      <td v-text="item.telefono"></td>
                      <td v-text="item.celular"></td>
                      <td v-text="item.email"></td>
                    </tr>
                  </tbody>
                </table>
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item" v-if="pageNumber > 0">
                      <a href="" class="page-link" @click.prevent="prevPage"
                        >Ant</a
                      >
                    </li>
                    <li
                      class="page-item"
                      v-for="(page, index) in pagesList"
                      :key="index"
                      :class="[page == pageNumber ? 'active' : '']"
                    >
                      <a
                        href=""
                        class="page-link"
                        @click.prevent="selectPage(page)"
                        >{{ page + 1 }}</a
                      >
                    </li>
                    <li class="page-item" v-if="pageNumber < pageCount - 1">
                      <a href="" class="page-link" @click.prevent="nextPage"
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
import FileSaver from "file-saver";
export default {
  data() {
    return {
      fillBsqProveedor: {
        cNombre: "",
        cRuc: "",
        nIdUser: sessionStorage.getItem("iduser"),
        nIdVendedor: "",
      },
      listCliente: [],
      listVendedorUser: [],
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
      pageNumber: 0,
      perPage: 50,
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
    };
  },
  mounted() {
    this.getlistVendedorAdmin();
  },

  computed: {
    pageCount() {
      let a = this.listCliente.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listarClientesPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listCliente.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listCliente.length,
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
    getlistVendedorAdmin() {
      var url = "/administracion/usuario/getListarVendedores";
      axios.get(url).then((response) => {
        this.listVendedorUser = response.data;
      });
    },
    limpiarProveedorBsq() {
      this.fillBsqProveedor.cNombre = "";
      this.fillBsqProveedor.cRuc = "";
    },
    limpiarBandejaProveedor() {
      this.listCliente = [];
    },
    getListarCliente() {
      var url = "/administracion/cliente/store";
      axios
        .get(url, {
          params: {
            cNombre: this.fillBsqProveedor.cNombre,
            cRuc: this.fillBsqProveedor.cRuc,
            nIdUser: this.fillBsqProveedor.nIdUser,
            nIdVendedor: this.fillBsqProveedor.nIdVendedor,
          },
        })
        .then((response) => {
          this.inicializarPAginacion();
          this.listCliente = response.data;
        });
    },

    getExcelCliente() {
      var url = "/operacion/Cliente/export";
      axios
        .post(
          url,
          {
            params: { listCliente: JSON.stringify(this.listCliente) },
          },
          { responseType: "blob" }
        )
        .then((response) => {
          FileSaver.saveAs(response.data, "Clientes.xlsx");
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

<style>
</style>
