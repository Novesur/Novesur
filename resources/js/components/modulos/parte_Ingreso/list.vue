<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lista Parte de Ingreso</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header"></div>

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <el-tabs v-model="activeName" @tab-click="handleClick">
                <el-tab-pane label="Proveedor - Fecha" name="first">
                  <!-- Busqueda por Proveedor y Fecha -->

                  <div class="card-body">
                    <form role="form">
                      <div class="row">
                        <div class="col-md-7">
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                              >Proveedor</label
                            >
                            <div class="col-md-9">
                              <el-select
                                v-model="fillBsqListPartIngreso.nIdProveedor"
                                filterable
                                placeholder="Select"
                                style="width: 100%"
                                clearable
                              >
                                <el-option
                                  v-for="item in listProveedor"
                                  :key="item.id"
                                  :label="item.nombre"
                                  :value="item.id"
                                >
                                </el-option>
                              </el-select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-5">
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label">Fecha</label>
                            <div class="col-md-3">
                              <el-date-picker
                                v-model="fillBsqListPartIngreso.dFecha"
                                type="daterange"
                                range-separator="A"
                                start-placeholder="Fecha Inicial"
                                end-placeholder="Fecha Final"
                              >
                              </el-date-picker>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>

                    <form role="form">
                      <div class="card-footer">
                        <div class="row">
                          <div class="col-md-4 offset-4">
                            <button
                              class="btn btn-flat btn-info btnWidth"
                              @click.prevent="getListarParteingreso"
                            >
                              Buscar
                            </button>
                            <button
                              class="btn btn-flat btn-default btnWidth"
                              @click.prevent="limpiarProveedorFecha"
                            >
                              Limpiar
                            </button>
                          </div>
                        </div>
                      </div>

                      <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Bandeja de Entrada</h3>
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
                                <th>Codigo</th>
                                <th>F. Emisión</th>
                                <th>Proveedor</th>
                                <th>Nro Factura</th>
                                <th>Nro Guia</th>
                                <th>Nro Orden Compra</th>
                                <th>Motivo</th>
                                <th>Accion</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr
                                v-for="(
                                  item, index
                                ) in listarProveedorfechaPaginated"
                                :key="index"
                              >
                             <td v-text="item.codigo"></td>
                                   <td v-text="item.Fecha"></td>
                                <td
                                  v-text="item.proveedor.nombre"
                                ></td>
                                <td v-text="item.Nrofactura"></td>
                                <td v-text="item.Nroguia"></td>
                                <td v-text="item.ordencompras.codigo"></td>
                                <td
                                  v-text="item.motivo.nombre"
                                ></td> 
                                <td> 
                                  <button
                                    @click.prevent="getPdfProveedorFecha(item.id)"
                                    class="btn btn-danger btn-sm"
                                  >
                                    <span><i class="far fa-file-pdf"></i></span>
                                    PDF
                                  </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <div class="card-footer clearfix">
                            <ul
                              class="pagination pagination-sm m-0 float-right"
                            >
                              <li class="page-item" v-if="pageNumber > 0">
                                <a
                                  href="#"
                                  class="page-link"
                                  @click.prevent="prevPage"
                                  >Ant</a
                                >
                              </li>
                              <li
                                class="page-item"
                                v-for="(page, index) in pageCountlistProvfecha"
                                :key="index"
                                :class="[page == pageNumber ? 'active' : '']"
                              >
                                <a
                                  href="#"
                                  class="page-link"
                                  @click.prevent="selectPage(page)"
                                  >{{ page + 1 }}</a
                                >
                              </li>
                              <li
                                class="page-item"
                                v-if="pageNumber < pageCountlistNroOrden - 1"
                              >
                                <a
                                  href="#"
                                  class="page-link"
                                  @click.prevent="nextPage"
                                  >Post</a
                                >
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- Busqueda por Proveedor y Fecha -->
                </el-tab-pane>

                <!-- Busqueda por Nro orden -->
                <el-tab-pane label="Nro de Orden" name="second">
                  <div class="card-body">
                    <form role="form">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-md-1 col-form-label"
                            >Nro Orden</label
                          >
                          <div class="col-md-3">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillBsqListPartIngreso.Norden"
                            />
                          </div>
                        </div>
                      </div>

                      <div class="card-footer">
                        <div class="row">
                          <div class="col-md-4 offset-4">
                            <button
                              class="btn btn-flat btn-info btnWidth"
                              @click.prevent="getListarParteingresoxNroOrden"
                            >
                              Buscar
                            </button>
                            <button
                              class="btn btn-flat btn-default btnWidth"
                              @click.prevent="limpiarNroOrden"
                            >
                              Limpiar
                            </button>
                          </div>
                        </div>
                      </div>

                      <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Bandeja de Entrada</h3>
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
                                 <th>Nro Orden</th>
                                <th>Fecha</th>
                                <th>Proveedor</th>
                                <th>Nro Factura</th>
                                <th>Nro Guia</th>
                                <th>Motivo</th>
                                <th>Accion</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr
                                v-for="(
                                  item, index
                                ) in listOrdenCompraxOrdenCompra"
                                :key="index"
                              >
                               <td v-text="item.ordencompras.codigo"></td>

                                 <td v-text="item.Fecha"></td>
                                 <td v-text="item.proveedor.nombre"></td>
                                 <td v-text="item.Nrofactura"></td>
                                <td v-text="item.Nroguia"></td>
                                 <td v-text="item.motivo.nombre"></td> 
                              <td>
                                  <button
                                    @click.prevent="getPdfNroOrden(item.ordencompras.id)"
                                    class="btn btn-danger btn-sm"
                                  >
                                    <span><i class="far fa-file-pdf"></i></span>
                                    PDF
                                  </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <div class="card-footer clearfix">
                            <ul
                              class="pagination pagination-sm m-0 float-right"
                            >
                              <li class="page-item" v-if="pageNumber > 0">
                                <a
                                  href="#"
                                  class="page-link"
                                  @click.prevent="prevPage"
                                  >Ant</a
                                >
                              </li>
                              <li
                                class="page-item"
                                v-for="(page, index) in pagesListxNroOrden"
                                :key="index"
                                :class="[page == pageNumber ? 'active' : '']"
                              >
                                <a
                                  href="#"
                                  class="page-link"
                                  @click.prevent="selectPage(page)"
                                  >{{ page + 1 }}</a
                                >
                              </li>
                              <li
                                class="page-item"
                                v-if="pageNumber < pageCountlistNroOrden - 1"
                              >
                                <a
                                  href="#"
                                  class="page-link"
                                  @click.prevent="nextPage"
                                  >Post</a
                                >
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </el-tab-pane>






                  <!-- Busqueda por Producto-->
                  <el-tab-pane label="Producto" name="tercer">
                  <div class="card-body">
                    <form role="form">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-md-1 col-form-label"
                            >Producto</label
                          >
                          <div class="col-md-10">
                            <el-select
                          v-model="fillBsqListPartIngreso.nIdprod"
                          style="width: 90%"
                          filterable
                          placeholder="Select"
                         
                        >
                          <v-row align="right">
                            <el-option
                              v-for="item in listProd"
                              :key="item.id"
                              :label="
                                item.codigo +
                                ' - ' +
                                item.familia.nombre +
                                ' , ' +
                                item.subfamilia.nombre +
                                ' , Modelo: ' +
                                item.modelotipo.nombre +
                                ' , Marca : ' +
                                item.marca.nombre +
                                ' , Material : ' +
                                item.material.nombre +
                                ' ,' +
                                item.homologacion.nombre
                              "
                              :value="item.id"
                            >
                            </el-option>
                          </v-row>
                        </el-select>
                          </div>
                        </div>
                      </div>

                      <div class="card-footer">
                        <div class="row">
                          <div class="col-md-4 offset-4">
                            <button
                              class="btn btn-flat btn-info btnWidth"
                              @click.prevent="getListarParteingresoxProduct"
                            >
                              Buscar
                            </button>
                            <button
                              class="btn btn-flat btn-default btnWidth"
                              @click.prevent="limpiarNroOrden"
                            >
                              Limpiar
                            </button>
                          </div>
                        </div>
                      </div>

                      <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Bandeja de Entrada</h3>
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
                                <th>Codigo</th>
                                 <th>Nro Orden</th>
                                <th>Fecha</th>
                                <th>Proveedor</th>
                                <th>Nro Factura</th>
                                <th>Nro Guia</th>
                                <th>Motivo</th>
                                <th>Accion</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr
                                v-for="(
                                  item, index
                                ) in listOrdenCompraxProduct"
                                :key="index"
                              >
                               <td v-text="item.parteingreso.codigo"></td>
                               <td v-text="item.parteingreso.ordencompras.codigo"></td>

                                 <td v-text="item.parteingreso.Fecha"></td>
                                 <td v-text="item.parteingreso.proveedor.nombre"></td>
                                 <td v-text="item.parteingreso.Nrofactura"></td>
                                <td v-text="item.parteingreso.Nroguia"></td>
                                 <td v-text="item.parteingreso.motivo.nombre"></td> 
                              <td>
                                  <button
                                    @click.prevent="getPdfNroOrden(item.parteingreso.ordencompras.id)"
                                    class="btn btn-danger btn-sm"
                                  >
                                    <span><i class="far fa-file-pdf"></i></span>
                                    PDF
                                  </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <div class="card-footer clearfix">
                            <ul
                              class="pagination pagination-sm m-0 float-right"
                            >
                              <li class="page-item" v-if="pageNumber > 0">
                                <a
                                  href="#"
                                  class="page-link"
                                  @click.prevent="prevPage"
                                  >Ant</a
                                >
                              </li>
                              <li
                                class="page-item"
                                v-for="(page, index) in pagesListxNroOrden"
                                :key="index"
                                :class="[page == pageNumber ? 'active' : '']"
                              >
                                <a
                                  href="#"
                                  class="page-link"
                                  @click.prevent="selectPage(page)"
                                  >{{ page + 1 }}</a
                                >
                              </li>
                              <li
                                class="page-item"
                                v-if="pageNumber < pageCountlistNroOrden - 1"
                              >
                                <a
                                  href="#"
                                  class="page-link"
                                  @click.prevent="nextPage"
                                  >Post</a
                                >
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </el-tab-pane>
              </el-tabs>
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
      fillBsqListPartIngreso: {
        nIdProveedor: "",
        dFecha: "",
        Norden: "",
      },
      listProveedor: [],
      listProd: [],
      listProveedorFecha: [],
      listOrdenCompra: [],
      listOrdenCompraxOrdenCompra: [],
      listOrdenCompraxProduct :[],
      pageNumber: 0,
      perPage: 10,
      activeName: "first",
    };
  },
  computed: {
    pageCountlistProvfecha() {
      let a = this.listProveedorFecha.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },

    pageCountlistNroOrden() {
      let a = this.listOrdenCompraxOrdenCompra.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },

    listarProveedorfechaPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listProveedorFecha.slice(inicio, fin);
    },

    listarxNroOrdenPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listOrdenCompraxOrdenCompra.slice(inicio, fin);
    },

    pagesListProveedorFecha() {
      let a = this.listProveedorFecha.length,
        b = this.perPage;
      let pageCountlistProvfecha = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];

      while (count < pageCountlistProvfecha) {
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    },

    pagesListxNroOrden() {
      let a = this.listOrdenCompraxOrdenCompra.length,
        b = this.perPage;
      let pageCountlistNroOrden = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];

      while (count < pageCountlistNroOrden) {
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    },
  },
  mounted() {
    this.getlistProveedor();
    this.getListarproductosByName();
  },
  methods: {
    limpiarProveedorFecha() {
      this.fillBsqListPartIngreso.nIdProveedor = "";
      this.fillBsqListPartIngreso.dFecha="";
    },

       limpiarNroOrden() {
      this.fillBsqListPartIngreso.Norden = "";

    },

    handleClick(tab, event) {
      console.log(tab, event);
    },

    limpiarBandejaMarca() {
      this.listProveedor = [];
    },

    getlistProveedor() {
      var url = "/administracion/proveedor/ListProveedor";
      axios.get(url).then((response) => {
        this.listProveedor = response.data;
      });
    },
    getListarParteingreso() {
      var url = "/administracion/parte_ingreso/ListParteIngreso"; 
      axios
        .get(url, {
          params: {
            dFecha: this.fillBsqListPartIngreso.dFecha,
            fecha1: this.fillBsqListPartIngreso.dFecha[0],
            fecha2: this.fillBsqListPartIngreso.dFecha[1],
            nIdProveedor: this.fillBsqListPartIngreso.nIdProveedor,
          },
        })
        .then((response) => {
          
          //this.inicializarPaginacion();
          // this.listMarca = response.data;
          this.listProveedorFecha = response.data;
        });
    },
    getListarParteingresoxNroOrden() {
      var url = "/administracion/parte_ingreso/ListParteIngresoxNroOrden";
      axios
        .get(url, {
          params: {
            Norden: this.fillBsqListPartIngreso.Norden,
          },
        })
        .then((response) => {
          //this.inicializarPaginacion();

          this.listOrdenCompraxOrdenCompra = response.data;
        });
    },

    getListarParteingresoxProduct(){
      var url = "/administracion/parte_ingreso/ListParteIngresoxProduct";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillBsqListPartIngreso.nIdprod,
          },
        })
        .then((response) => {
          //this.inicializarPaginacion();

          this.listOrdenCompraxProduct = response.data;
          console.log(response.data);
        });

    },
    getPdfProveedorFecha(item){
    

               var config = { responseType: "blob" };
      var url = "/administracion/parte_ingreso/ProveedorFechaPdf";
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
    },
    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillBsqListPartIngreso.nIdprod,
          },
        })
        .then((response) => {
          this.listProd = response.data;
        });
    },


        getPdfNroOrden(item){
              var config = { responseType: "blob" };
      var url = "/administracion/parte_ingreso/ProveedorOrdenCompraPdf";
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
