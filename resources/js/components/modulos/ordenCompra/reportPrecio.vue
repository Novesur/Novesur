<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Listado de Precios</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
      


        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterio de Busqueda</h3> 
              </div>

              <el-tabs type="border-card">
                <el-tab-pane>
                  <span slot="label"
                    ><i class="el-icon-date"></i> Buscar por Producto</span
                  >

                  <!-- FORMULARIO  DE  BUSCAR  DE PRODUCTO -->
                  <div class="card-body">
                    <form role="form">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-1 col-form-label"
                              >Producto</label
                            >
                            <div class="col-md-9">
                              <el-select
                                v-model="fillBsqListPrecioOC.nIdprod"
                                style="width: 100%"
                                filterable
                                placeholder="Select"
                                clearable
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
                      </div>
                    </form>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-md-4 offset-4">
                        <button
                          class="btn btn-flat btn-info btnWidth"
                          @click.prevent="getListPrecioOrdCompra"
                        >
                        <i class="fas fa-search"></i>
                          Buscar
                        </button>
                        <button
                          class="btn btn-flat btn-success btnWidth"
                          @click.prevent="getExcelPrecioOrdCompraxProduct"
                        >
                        <i class="fas fa-file-excel"></i>
                          Excel
                        </button>
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
                            <th>O/C</th>
                            <th>FECHA</th>
                            <th>PROVEEDOR</th>
                            <th>COD PRODUCT</th>
                            <th>PRODUCTO</th>
                            <th>MONEDA</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                            <th>TOTAL</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(item, index) in listarOrdenCompraProductoPaginated"
                            :key="index"
                          >
                          <template v-if="item.ordencompras">
                            <td v-text="item.ordencompras.codigo"></td>
                            <td>
                              {{
                                item.ordencompras.Femision
                                  | moment("DD - MM - Y")
                              }}
                            </td>
                            <td
                              v-text="item.ordencompras.proveedor.nombre"
                            ></td>

                          </template>
                      
                          
                          <template v-if="item.ordencompras">
                          <td v-text="item.producto.codigo"></td>

                          <td v-text="item.producto.familia.nombre  +
                                        ' , ' +
                                        item.producto.subfamilia.nombre +
                                        ' , Modelo: ' +
                                        item.producto.modelotipo.nombre +
                                        ' , Marca : ' +
                                        item.producto.marca.nombre +
                                        ' , Material : ' +
                                        item.producto.material.nombre +
                                        ' ,' +
                                        item.producto.homologacion.nombre "></td>

                          </template> 
                          <!--   <td v-text="item.ordencompras.tipocambio.nombre"></td> -->


                          <template v-if="item.ordencompras">
                            <td  v-text="item.ordencompras.tipocambio.nombre"></td>

                            
                            
                            
                            
                            <td v-text="item.cantidad"></td>
                            <td   v-text="Number(item.punit).toFixed(4)"></td>
                            <td v-text="Number(item.cantidad * item.punit).toFixed(2)"></td>
                          </template>

                          <!--   <td> 
                              <button
                                class="btn btn-info btn-sm"
                                @click="abrirDetalle(item.ordencompras.id)"
                              >
                                <i class="fas fa-eye"></i> Detalle
                              </button>

                              <button
                                class="btn btn-danger btn-sm"
                                @click.prevent="
                                  SetGenerarOrdenPedidoPDF(item.ordencompras.id)
                                "
                              >
                                <i class="fas fa-file-pdf"></i> PDF
                              </button>


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
                                  <i class="far fa-clipboard"></i> Parte de
                                  Ingreso
                                </router-link>
                              </template>

                            </td> -->
                          </tr>
                        </tbody>
                      </table>
                      <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                          <li class="page-item" v-if="pageNumber > 0">
                            <a
                              href=""
                              class="page-link"
                              @click.prevent="prevPage"
                              >Ant</a
                            >
                          </li>
                          <li
                            class="page-item"
                            v-for="(page, index) in pagesListxProducto"
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
                          <li
                            class="page-item"
                            v-if="pageNumber < pageCountProducto - 1"
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

                  <!--FIN  DE  FORMULARIO  DE  BUSCAR  DE PRODUCTO -->
                </el-tab-pane>
                <el-tab-pane label="Buscar por Proveedor">
                  <!-- FORMULARIO  DE  BUSCAR  DE PROVEEDOR -->
                  <div class="card-body">
                    <form role="form">
                      <div class="row"> 
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-1 col-form-label"
                              >Proveedor</label
                            >
                            <div class="col-md-6">
                              <el-select
                                v-model="fillBsqListPrecioOC.nidProveedor"
                                style="width: 50%"
                                filterable
                                placeholder="Select"
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


                        <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label"
                                  >Fecha</label
                                >
                                <el-date-picker
                                  v-model="fillBsqListPrecioOC.dFecha"
                                  type="daterange"
                                  range-separator="To"
                                  start-placeholder="Start date"
                                  end-placeholder="End date"
                                  value-format="yyyy-MM-dd"
                                  
                                  :style="{ width: '630px', height: '38px' }"
                                >
                                </el-date-picker>
                              </div>
                            </div>



                      </div>
                    </form>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-md-4 offset-3">
                        <button
                          class="btn btn-flat btn-info btnWidth3buttons"
                          @click.prevent="getListarPrecioxProveedorOC"
                        >
                        <i class="fas fa-search"></i>
                          Buscar
                        </button>
                        <button
                          class="btn btn-flat btn-success btnWidth3buttons"
                          @click.prevent="getExcelPrecioOrdCompraxProveedor"
                        >
                        <i class="fas fa-file-excel"></i>
                          Excel
                        </button>

                        <button
                          class="btn btn-flat btn-secondary btnWidth3buttons"
                          @click.prevent="getClean"
                        >
                        <i class="fas fa-redo-alt"></i>
                          Limpiar
                        </button>
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
                            <th>OC</th>
                            <th>FECHA</th>
                            <th>COD PROD</th>
                            <th>PRODUCTO</th>
                            <th>TIPO DE CAMBIO</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                            <th>TOTAL</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(
                              item, index
                            ) in listarOrdenCompraxProveedorPaginated"
                            :key="index"
                          >
                           <td v-text="item.codigo"></td>
                            <td v-text="item.Femision"></td>

                            <td v-text="item.detalle[0].producto.codigo "></td>
                            <td v-text="item.detalle[0].producto.familia.nombre  +
                                        ' , ' +
                                        item.detalle[0].producto.subfamilia.nombre +
                                        ' , Modelo: ' +
                                        item.detalle[0].producto.modelotipo.nombre +
                                        ' , Marca : ' +
                                        item.detalle[0].producto.marca.nombre +
                                        ' , Material : ' +
                                        item.detalle[0].producto.material.nombre +
                                        ' ,' +
                                        item.detalle[0].producto.homologacion.nombre "></td>
                                        
                                       
                                          <td  v-text="item.tipocambio.nombre"></td>
                                      
                                       
                                        <td v-text="item.detalle[0].cantidad"></td>
                                        <td v-text="Number(item.detalle[0].punit).toFixed(4)"></td>
                                        <td v-text="Number(item.detalle[0].cantidad * item.detalle[0].punit).toFixed(2)"></td>

                                       
                          </tr>
                        </tbody>
                      </table>
                      <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                          <li class="page-item" v-if="pageNumber > 0">
                            <a
                              href=""
                              class="page-link"
                              @click.prevent="prevPage"
                              >Ant</a
                            >
                          </li>
                          <li
                            class="page-item"
                            v-for="(page, index) in pagesListxProvedor"
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
                          <li
                            class="page-item"
                            v-if="pageNumber < pageCountProveedor - 1"
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

                  <!--FIN  DE  FORMULARIO  DE  BUSCAR  DE PROVEEDOR -->
                </el-tab-pane>
             
              </el-tabs>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL  BOOTSTRAP -->
    <div
      class="modal fade"
      :class="{ show: modalShow }"
      :style="modalShow ? mostrarModal : ocultarModal"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detalle de Orden de Pedido</h5>
            <button class="close" @click="abrirModal"></button>
          </div>
          <div class="modal-body">
            <div class="card-header">
              <h3 class="card-title">Bandeja de Resultados</h3>
            </div>
            <div class="card-body table-responsive">
              <table
                class="table table-hover table-head-fixed text-nowrap projects"
              >
                <thead>
                  <tr>
                    <th>OC</th>
                    <th>PRODUCTO</th>
                    <th>PRECIO</th>
                    <th>CANTIDAD</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(item, index) in listDetalleOrdenPedido"
                    :key="index"
                  >
                    <td
                      v-text="
                        item.producto.familia.nombre +
                        ',' +
                        item.producto.subfamilia.nombre +
                        ', MODELO :' +
                        item.producto.modelotipo.nombre +
                        ', MATERIAL :' +
                        item.producto.material.nombre +
                        ', MARCA :' +
                        item.producto.marca.nombre
                      "
                    ></td>
                    <td v-text="item.cantidad"></td>
                    <td v-text="item.punit"></td>
                    <td v-text="item.unidmedida.nombre"></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- <div class="callout callout-danger" style="padding: 5px" v-for="(item, index) in mensajeError" :key="index" v-text="item"></div> -->
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
import FileSaver from "file-saver";
export default {
  data() {
    return {
      fillBsqListPrecioOC: {
        nIdprod: "",
        nidProveedor: "",
        dFecha:"",
      },
      listProd: [],
      listProveedor: [],
      listOrdenPedidoXProduct: [],
      listOrdCompraxProveedor: [],

      listDetalleOrdenPedido: [],

      modalShow: false,
      mostrarModal: {
        display: "block",
        background: "#0000006b",
      },
      ocultarModal: {
        display: "none",
      },

      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
      pageNumber: 0,
      perPage: 30,
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
    };
  },
  mounted() {
    this.getListarproductosByName();
    this.setListProveedor();
  },

  computed: {

    pageCountProveedorxproveedor() {
      let a = this.listOrdCompraxProveedor.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listarOrdenCompraxProveedorPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listOrdCompraxProveedor.slice(inicio, fin);
    },
    pagesListxProvedor() {
      let a = this.listOrdCompraxProveedor.length,
        b = this.perPage;
      let pageCountProveedor = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];
      while (count < pageCountProveedor) {
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    },
    pageCountProveedor() {
      let a = this.listOrdCompraxProveedor.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },

    listarOrdenCompraProductoPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listOrdenPedidoXProduct.slice(inicio, fin);
    },
    pagesListxProducto() {
      let a = this.listOrdenPedidoXProduct.length,
        b = this.perPage;
      let pageCountProducto = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];
      while (count < pageCountProducto) {
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    },
    pageCountProducto() {
      let a = this.listOrdenPedidoXProduct.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
  },
  methods: {
    abrirModal() {
      this.modalShow = !this.modalShow;
    },

    getExcelPrecioOrdCompraxProduct() {
      var url = "/operacion/ordenCompra/exportPrecioOcExcelxProduct"; 
      axios
        .post(
          url,
          {
            params: { listOrdenPedidoXProduct: JSON.stringify(this.listOrdenPedidoXProduct) }, 
          },
          { responseType: "blob" }
        )
        .then((response) => {
       
          FileSaver.saveAs(response.data, "PrecioxProductOC.xlsx");
        });
    },

    getExcelPrecioOrdCompraxProveedor(){ 
      var url = "/operacion/ordenCompra/exportPrecioOcExcelxProveedor";
      axios
        .post(
          url,
          {
            params: { listOrdCompraxProveedor: JSON.stringify(this.listOrdCompraxProveedor) }, 
          },
          { responseType: "blob" }
        )
        .then((response) => {
          FileSaver.saveAs(response.data, "PrecioxProveedorOC.xlsx");
        });


    },

    getClean() {
      this.fillBsqListPrecioOC.nidProveedor = "";
      this.fillBsqListPrecioOC.dFecha = "";
      this.limpiarBandejaProveedor();
    },
    limpiarBandejaProveedor() {
      this.listOrdCompraxProveedor = [];
    },

    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillBsqListPrecioOC.nIdprod,
          },
        })
        .then((response) => {
          this.listProd = response.data;
        });
    },
    setListProveedor() {
      var url = "/administracion/proveedor/ListProveedor";
      axios.get(url, {}).then((response) => {
        this.listProveedor = response.data;
      });
    },

    getListPrecioOrdCompra() {
      var url = "/administracion/ordenCompra/ListPrecioOrdCompra";  
      axios
        .get(url, {
          params: {
            nIdprod: this.fillBsqListPrecioOC.nIdprod,
          },
        })
        .then((response) => {
          this.listOrdenPedidoXProduct = response.data;
        });
    },

    getListarPrecioxProveedorOC() {
      var url = "/administracion/ordenCompra/ListarPrecioxProveedorOC";  
      axios
        .get(url, {
          params: {
            nidProveedor: this.fillBsqListPrecioOC.nidProveedor,
            fecha : this.fillBsqListPrecioOC.dFecha,
            fecha1 : this.fillBsqListPrecioOC.dFecha[0],
            fecha2 : this.fillBsqListPrecioOC.dFecha[1]
            
          },
        })
        .then((response) => {
          this.listOrdCompraxProveedor = response.data;
        });
    },

    abrirDetalle(item) {
      this.modalShow = true;
      this.getListPrecioOrdCompraDetalle(item);
    },

    getListPrecioOrdCompraDetalle(item) {
      var url = "/administracion/DetalleordenCompra/viewModal";
      axios
        .get(url, {
          params: {
            item: item,
          },
        })
        .then((response) => {

          this.listDetalleOrdenPedido = response.data;
        });
    },

    SetGenerarOrdenPedidoPDF(idOrderPedido) {
      var config = { responseType: "blob" };
      var url = "/administracion/ordenCompra/setGenerarOrderPedidoPdf";
      axios
        .post(
          url,
          {
            params: {
              idOrderPedido: idOrderPedido,
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

    SetAnularxProveedor(codigo) {
      Swal.fire({
        title: "Desea darle de baja?",
        text: "No podrás revertir esto.!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, dale de baja!",
      }).then((result) => {

        if (result.isConfirmed) {
                var url = "/administracion/ordenCompra/setDarBajaOrderCompra";
        axios
          .post(url, {
            codigo: codigo,
          })
          .then((response) => {
            //this.listOrdCompraxProveedor = response.data;
           this.getListarPrecioxProveedorOC();
          });

          Swal.fire(
            "Anulado!",
            "Tu orden de Compra de Compra fue dado de Baja.",
            "success"
          );
        }
      });
    },


  },
};
</script>

<style>
</style>
