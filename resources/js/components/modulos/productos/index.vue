<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Productos</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <button
              class="btn btn-success btn-sm"
              @click.prevent="setGenerarExcelProducto"
            >
              <i class="far fa-file-excel"></i> Reporte
            </button>
            <template
              v-if="listRolPermisoByUsuario.includes('productos.crear')"
            >
              <router-link class="btn btn-info btn-sm" :to="'/productos/crear'">
                <i class="fas fa-plus-square">Nuevo Producto</i>
              </router-link>
            </template>
          </div>
        </div>

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterios de busqueda</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Familia</label>
                        <div class="col-md-8">
                          <el-select
                            v-model="fillBsqProducto.nIdFamilia"
                            filterable
                            placeholder="Seleccione una Familia"
                            @change="getListarSubFamilia()"
                            clearable
                          >
                            <el-option
                              v-for="item in listFamilia"
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
                        <label class="col-md-3 col-form-label"
                          >Diametro/Longitud</label
                        >
                        <div class="col-md-8">
                          <el-select
                            v-model="fillBsqProducto.nIdSubFamilia"
                            filterable
                            placeholder="Seleccione una SubFamilia"
                            :style="{ width: '350px' }"
                            clearable
                          >
                            <el-option
                              v-for="item in listSubFamilia"
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
                        <label class="col-md-3 col-form-label">Marca</label>
                        <div class="col-md-8">
                          <el-select
                            v-model="fillBsqProducto.nIdMarca"
                            filterable
                            placeholder="Seleccione una Marca"
                            clearable
                          >
                            <el-option
                              v-for="item in listMarca"
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
                        <label class="col-md-3 col-form-label">Material</label>
                        <div class="col-md-8">
                          <el-select
                            v-model="fillBsqProducto.nIdMaterial"
                            filterable
                            placeholder="Seleccione una Material"
                            clearable
                          >
                            <el-option
                              v-for="item in listMaterial"
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
                        <label class="col-md-3 col-form-label"
                          >Modelo/Tipo</label
                        >
                        <div class="col-md-8">
                          <el-select
                            v-model="fillBsqProducto.nIdModeloTipo"
                            filterable
                            placeholder="Seleccione Modelo/Tipo"
                            clearable
                          >
                            <el-option
                              v-for="item in listModeloTipo"
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
                        <label class="col-md-3 col-form-label">Estado</label>
                        <div class="col-md-8">
                          <el-select
                            v-model="fillBsqProducto.nIdEstado"
                            filterable
                            placeholder="Seleccione una Estado"
                            clearable
                          >
                            <el-option
                              v-for="item in listEstadoProd"
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
                        <label class="col-md-3 col-form-label"
                          >Homologado</label
                        >
                        <div class="col-md-8">
                          <el-select
                            v-model="fillBsqProducto.nIdHomologado"
                            filterable
                            placeholder="Seleccione el tipo"
                            clearable
                          >
                            <el-option
                              v-for="item in listHomologado"
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
                        <label class="col-md-3 col-form-label">Codigo</label>
                        <div class="col-md-5">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillBsqProducto.nIdCodigo"
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
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="getListarProducto"
                    >
                      Buscar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="LimpiarProductoBsq"
                    >
                      Limpiar
                    </button>
                  </div>
                </div>
              </div>

              <div class="card card-info">
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
                      :class="page == pageNumber ? 'active' : ''"
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
                        <th>Acciones</th>
                        <th>Codigo</th>
                        <th>Familia</th>

                        <th>Modelo/Tipo</th>
                        <th>Marca</th>
                        <th>Material</th>
                        <th>Diametro/Longitud</th>
                        <th>Homologación</th>
                        <th>Precio</th>
                        <th>Prec.Dist</th>
                        <th>Estado</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(item, index) in listarProductosPaginated"
                        :key="index"
                      >
                          <td>
                            <template
                              v-if="
                                listRolPermisoByUsuario.includes(
                                  'productos.edit'
                                )
                              "
                            >
                              <router-link
                                class="btn btn-info btn-sm tamañoletra"
                                :to="{
                                  name: 'productos.editar',
                                  params: { id: item.id },
                                }"
                              >
                                <i class="fas fa-pencil-alt"></i> Editar
                              </router-link>
                            </template>
                            <template
                              v-if="
                                listRolPermisoByUsuario.includes('kardex.index')
                              "
                            >
                              <router-link
                                class="btn btn-secondary btn-sm tamañoletra"
                                :to="{
                                  name: 'kardex.index',
                                  params: { id: item.id },
                                }"
                              >
                                <i class="fas fa-clipboard-check"></i> Kardex
                              </router-link>
                            </template>
                          </td>
                        <td v-text="item.codigo" class="tamañoletra"></td>
                        <td v-text="item.familia.nombre" class="tamañoletra"></td>
                        <td v-text="item.modelotipo.nombre" class="tamañoletra"></td>
                        <td v-text="item.marca.nombre" class="tamañoletra"></td>
                        <td v-text="item.material.nombre" class="tamañoletra"></td>
                        <td v-text="item.subfamilia.nombre" class="tamañoletra"></td>
                        <td v-text="item.homologacion.nombre" class="tamañoletra"></td>
                        <td v-text="item.precioSugerido" class="tamañoletra"></td>
                        <td v-text="item.precioDistribuidor" class="tamañoletra"></td>
                        <td>
                          <template v-if="item.estado_id == '1'">
                            <span class="badge badge-success">Activo</span>
                          </template>
                          <template v-else>
                            <span class="badge badge-danger">Inactivo</span>
                          </template>
                        </td>
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
                        :class="page == pageNumber ? 'active' : ''"
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
  </div>
</template>

<script>
import FileSaver from "file-saver";
export default {
  data() {
    return {
      fillBsqProducto: {
        nIdFamilia: "",
        nIdSubFamilia: "",
        nIdMarca: "",
        nIdMaterial: "",
        nIdEstado: "",
        nIdModeloTipo: "",
        nIdHomologado: "",
        nIdCodigo: "",
      },
      pageNumber: 0,
      perPage: 70,
      listFamilia: [],
      listSubFamilia: [],
      listMarca: [],
      listMaterial: [],
      listEstadoProd: [],
      listProductos: [],
      listModeloTipo: [],
      listHomologado: [],
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
    };
  },
  mounted() {
    this.getListarFamilia();
    this.getListarSubFamilia();
    this.getListarMarca();
    this.getListarMaterial();
    this.getListarEstadoProd();
    this.getListarModeloTipo();
    this.getListarHomologacion();
  },
  computed: {
    pageCount() {
      let a = this.listProductos.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listarProductosPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listProductos.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listProductos.length,
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
    LimpiarProductoBsq() {
      this.fillBsqProducto.nIdFamilia = "";
      this.fillBsqProducto.nIdSubFamilia = "";
      this.fillBsqProducto.nIdMarca = "";
      this.fillBsqProducto.nIdMaterial = "";
      this.fillBsqProducto.nIdEstado = "";
      this.fillBsqProducto.nIdCodigo= "";

    },
    getListarHomologacion() {
      var url = "/administracion/tempcotizacion/getListarHomologacion";
      axios.get(url).then((response) => {
        this.listHomologado = response.data;
        // this.fillBsqProducto.nIdHomologado = this.listHomologado[2].id;
      });
    },
    getListarModeloTipo() {
      var url = "/administracion/modelotipo/getListarModelotipo";
      axios.get(url).then((response) => {
        this.listModeloTipo = response.data;
      });
    },
    getListarFamilia() {
      var url = "/administracion/familia/getListarFamilias";
      axios.get(url).then((response) => {
        this.listFamilia = response.data;
      });
    },
    getListarMarca() {
      var url = "/administracion/marcas/getListarMarcas";
      axios.get(url).then((response) => {
        this.listMarca = response.data;
      });
    },
    getListarSubFamilia() {
      var url = "/administracion/subfamilia/listSubFamiliabyFamilia";
      axios.get(url).then((response) => {
        this.listSubFamilia = response.data;
      });
    },
    getListarMaterial() {
      var url = "/administracion/material/getListarMaterial";
      axios.get(url).then((response) => {
        this.listMaterial = response.data;
      });
    },
    getListarEstadoProd() {
      var url = "/administracion/estadoprod/getListarEstadoprod";
      axios.get(url).then((response) => {
        this.listEstadoProd = response.data;
        //this.fillBsqProducto.nIdEstado = this.listEstadoProd[0].id;
      });
    },
    getListarProducto() {
      var url = "/administracion/producto/getListarProducto";
      axios
        .get(url, {
          params: {
            nIdFamilia: this.fillBsqProducto.nIdFamilia,
            nIdSubFamilia: this.fillBsqProducto.nIdSubFamilia,
            nIdMarca: this.fillBsqProducto.nIdMarca,
            nIdMaterial: this.fillBsqProducto.nIdMaterial,
            nIdEstado: this.fillBsqProducto.nIdEstado,
            nIdHomologado: this.fillBsqProducto.nIdHomologado,
            nIdCodigo: this.fillBsqProducto.nIdCodigo,
            nIdModeloTipo : this.fillBsqProducto.nIdModeloTipo
          },
        })
        .then((response) => {
          this.inicializarPaginacion();
          this.listProductos = response.data;
        });
    },

    setGenerarExcelProducto() {
      var url = "/operacion/producto/export";
      axios
        .post(
          url,
          {
            params: { listProductos: JSON.stringify(this.listProductos) },
          },
          { responseType: "blob" }
        )
        .then((response) => {
          FileSaver.saveAs(response.data, "Productos.xlsx");
        });
    },

    limpiarBandejaProductos() {
      this.listProductos = [];
    },

    inicializarPaginacion() {
      this.pageNumber = 0;
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
  },
};
</script>

<style scoped>
.tamañoletra{
  font-size: 11px;
}
</style>>
</style>
