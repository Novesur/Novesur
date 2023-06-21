<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Orden de Servicio</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterio de Busqueda</h3>
              </div>

              <el-tabs type="border-card">
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
                                v-model="fillBsqListOrdenServicio.nidProveedor"
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

                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-1 col-form-label"
                              >Fecha</label
                            >
                            <div class="col-md-6">
                              <el-date-picker
                              v-model="fillBsqListOrdenServicio.dFecha"
                              type="daterange"
                              range-separator="To"
                              start-placeholder="Start date"
                              end-placeholder="End date"
                              value-format="yyyy-MM-dd"
                              clearable
                              :style="{ width: '530px', height: '38px' }"
                            >
                            </el-date-picker>
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
                          @click.prevent="getListarOrdenServicioxProveedor"
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
                            <th>CODIGO</th>
                            <th>F. EMISION</th>
                            <th>PROVEEDOR</th>
                            <th>ESTADO</th>
                            <th>ACCION</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(
                              item, index
                            ) in listarOrdenCompraxProveedorPaginated"
                            :key="index"
                          >
                            <td v-text="item.codigo">
                  
                            </td>
                            <td>{{ item.Femision | moment("DD - MM - Y") }}</td>

                            <td v-text="item.proveedor.nombre"></td>

                            <td v-text="item.estadoordencompra.nombre"></td>
                            <td>
                              <button
                                class="btn btn-info btn-sm"
                                @click="abrirDetalle(item.id)"
                              >
                                <i class="fas fa-eye"></i> Detalle
                              </button>

                                <template v-if="item.estadoordencompra_id == 2">
                              <button
                                class="btn btn-danger btn-sm"
                                @click.prevent="
                                  SetGenerarOrdenPedidoPDF(item.id)
                                "
                              >
                                <i class="fas fa-file-pdf"></i> PDF
                              </button>


                                           <button
                                class="btn btn-secondary btn-sm"
                                @click.prevent="
                                  SetAnularxProveedor(item.codigo)
                                "
                              >
                                <i class="fas fa-eraser"></i> Anular
                              </button>


                               <router-link class="btn btn-info btn-sm" :to="{name:'ordenServicio.edit' , params:{id:item.codigo}} ">
                              <i class="fas fa-pencil-alt"></i> Editar
                             </router-link>





                                </template>

                              <template
                                v-if="
                                  listRolPermisoByUsuario.includes(
                                    'cotizacion.create'
                                  )
                                "
                              >
                                     <template v-if="item.estadoordencompra_id == 2">
                                <router-link
                                  class="btn btn-success btn-sm"
                                  :to="{
                                    name: 'parteingreso.create',
                                    params: { id: item.id },
                                  }"
                                >
                                  <i class="far fa-clipboard"></i> Parte de
                                  Ingreso
                                </router-link>
                                     </template>
                              </template>
                            </td>
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
                                v-model="fillBsqListOrdenServicio.nIdprod"
                                style="width: 100%"
                                filterable
                                placeholder="Select"
                                clearable
                              >
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
                          @click.prevent="getListarOrdenServicioxProducto"
                        >
                          Buscar
                        </button>
                        <button
                          class="btn btn-flat btn-default btnWidth"
                          @click.prevent="limpiarProductoBsq"
                        >
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
                            <th>CODIGO</th>
                            <th>F. EMISION</th>
                            <th>PROVEEDOR</th>
                            <th>ACCION</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(item, index) in listOrdenServicioXProduct"
                            :key="index"
                          >
                            <td v-text="item.ordenservicio.codigo">
                         
                            </td>
                            <td>
                              {{
                                item.ordenservicio.Femision
                                  | moment("DD - MM - Y")
                              }}
                            </td>

                            <td
                              v-text="item.ordenservicio.proveedor.nombre"
                            ></td>
                            <td>
                              <button
                                class="btn btn-info btn-sm"
                                @click="abrirDetalle(item.ordenservicio.id)"
                              >
                                <i class="fas fa-eye"></i> Detalle
                              </button>

                              <button
                                class="btn btn-danger btn-sm"
                                @click.prevent="
                                  SetGenerarOrdenPedidoPDF(item.ordenservicio.id)
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

                            </td>
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
            <h5 class="modal-title">Detalle de Orden de Pedido Nr°: {{ this.fillBsqListOrdenServicio.codOrdServ }}</h5>
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
                    <th>PRODUCTO</th>
                    <th>CANTIDAD</th>
                    <th>P.UNIT</th>
                    <th>UNID. MEDIDA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(item, index) in listDetalleOrdenServicio"
                    :key="index"
                  >
                    <td
                      v-text="item.producto.familia.nombre"
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
export default {
  data() {
    return {
      fillBsqListOrdenServicio: {
        nIdprod: "",
        nidProveedor: "",
        dFecha: "",
        codOrdServ:"",
      },
      listProd: [],
      listProveedor: [],
      listOrdenServicioXProduct: [],
      listOrdenServicioXProveedor: [],

      listDetalleOrdenServicio: [],

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
      perPage: 10,
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
      let a = this.listOrdenServicioXProveedor.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listarOrdenCompraxProveedorPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listOrdenServicioXProveedor.slice(inicio, fin);
    },
    pagesListxProvedor() {
      let a = this.listOrdenServicioXProveedor.length,
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
      let a = this.listOrdenServicioXProveedor.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },

    listarOrdenCompraProductoPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listOrdenServicioXProduct.slice(inicio, fin);
    },
    pagesListxProducto() {
      let a = this.listOrdenServicioXProduct.length,
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
      let a = this.listOrdenServicioXProduct.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
  },
  methods: {
    abrirModal() {
      this.modalShow = !this.modalShow;
    },

    limpiarProductoBsq() {
      this.fillBsqListOrdenServicio.nIdprod = "";
      this.limpiarBandejaProducto();
    },
    limpiarBandejaProducto() {
      this.listOrdenServicioXProduct = [];
    },
    limpiarProveedorBsq() {
      this.fillBsqListOrdenServicio.nidProveedor = "";
      this.limpiarBandejaProveedor();
    },
    limpiarBandejaProveedor() {
      this.listOrdenServicioXProveedor = [];
    },

    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillBsqListOrdenServicio.nIdprod,
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

    getListarOrdenServicioxProducto() {
      var url = "/administracion/ordenServicio/ListXProduct";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillBsqListOrdenServicio.nIdprod,
          },
        })
        .then((response) => {
          this.listOrdenServicioXProduct = response.data;
        });
    },

    getListarOrdenServicioxProveedor() {
      var url = "/administracion/ordenServicio/ListXProveedor"; 
      axios
        .get(url, {
          params: {
            nidProveedor: this.fillBsqListOrdenServicio.nidProveedor,
            dFecha: this.fillBsqListOrdenServicio.dFecha,
          },
        })
        .then((response) => {
          this.listOrdenServicioXProveedor = response.data;
        });
    },

    abrirDetalle(item) {
      this.modalShow = true;
      this.getListarOrdenServicioxProductoDetalle(item);
    },

    getListarOrdenServicioxProductoDetalle(item) {

      var url = "/administracion/DetalleOrdenservicio/view";
      axios
        .get(url, {
          params: {
            item: item,
          },
        })
        .then((response) => {
          this.listDetalleOrdenServicio = response.data;
          this.fillBsqListOrdenServicio.codOrdServ= response.data[0].ordenservicio.codigo
        });
    },

    SetGenerarOrdenPedidoPDF(idOrderPedido) {
      var config = { responseType: "blob" };
      var url = "/administracion/ordenServicio/setGenerarOrderPedidoPdf";
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
                var url = "/administracion/ordenServicio/setDarBajaOrderServicio";
        axios
          .post(url, {
            codigo: codigo,
          })
          .then((response) => {
            this.getListarOrdenServicioxProveedor();
            //this.listOrdenServicioXProveedor = response.data;
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
