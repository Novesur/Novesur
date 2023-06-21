<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Reporte de Informe de Producción</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools"></div>
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
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Producto</label>
                        <div class="col-md-10">
                          <el-select v-model="fillReporteInfoProduccion.nIdprod" style="width: 90%" filterable clearable
                            placeholder="Select">

                            <v-row align="right">
                              <el-option v-for="item in listProd" :key="item.id" :label="
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
                              " :value="item.id">
                              </el-option>
                            </v-row>

                          </el-select>
                        </div>
                      </div>
                    </div>



                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Fecha</label>
                        <el-date-picker v-model="fillReporteInfoProduccion.dFecha" type="daterange" range-separator="To"
                          start-placeholder="Start date" end-placeholder="End date" value-format="yyyy-MM-dd" clearable
                          :style="{ width: '530px', height: '38px' }">
                        </el-date-picker>
                      </div>
                    </div>

                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-6 offset-3">
                    <button class="btn btn-flat btn-info btnWidth3buttons" @click.prevent="getListReportProduc">
                      Buscar
                    </button>
                    <button class="btn btn-flat btn-default btnWidth3buttons" @click.prevent="limpiarListClientsBsq">
                      Limpiar
                    </button>

                    <button class="btn btn-flat btn-success btnWidth3buttons" @click.prevent="ExcelListOrdProd">
                      Excel
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
                <table class="
                    table table-hover table-head-fixed
                    text-nowrap
                    projects
                  ">
                  <thead>
                    <tr>
                      <th>CODIGO </th>
                      <th>COD. REQUERIMIENTO</th>
                      <th>FECHA </th>
                      <th>CODIGO PRODUCTO</th>
                      <th>PRODUCTO</th>
                      <th>CANTIDAD</th>
                      <th>ACCION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in listarClientesPaginated" :key="index">
                      <td>{{ item.codigo }}</td>
                      <td v-text="item.requerimiento_materiales.codigo"></td>
                      <td>{{ item.fecha | moment("DD - MM - Y")  }}
                        <!--    {{
                          item.user == null
                            ? "Dado de Baja"
                            : item.user.fullname
                        }} -->
                      </td>
                      <td v-text="item.producto.codigo"></td>
                      <td v-text="
                        item.producto.familia.nombre +
                        ' ' +
                        item.producto.subfamilia.nombre +
                        ', MARCA :' +
                        item.producto.marca.nombre +
                        ', MODELO/TIPO :' +
                        item.producto.modelotipo.nombre +
                        ', MATERIAL :' +
                        item.producto.material.nombre
                      ">
                      </td>

                      <td>{{ item.cantidad }}</td>


                      <td>

                        <button class="btn btn-danger btn-sm" @click.prevent="
                          SetGenerarreqMaterialesPDF(item.id)
                        ">
                          <i class="fas fa-file-pdf"></i> PDF
                        </button>

                        <template v-if="
                          listRolPermisoByUsuario.includes(
                            'infoProduccion_precio'
                          )
                        ">

                          <button class="btn btn-secondary btn-sm" @click.prevent="
                            abrirModalInfoProd(item.id)
                          ">
                            <i class="fas fa-wrench"></i> Material
                          </button>

                          <button class="btn btn-primary btn-sm" @click.prevent="
                            abrirModalManoObra(item.id)
                          ">
                            <i class="fas fa-user-cog"></i> Mano de Obra
                          </button>

                          <button class="btn btn-info btn-sm" @click.prevent="
                            abrirModalOtrosReque(item.id)
                          ">
                            <i class="fas fa-list-alt"></i> Otros Reque..
                          </button>

                          <button class="btn btn-success btn-sm" @click.prevent="
                            getExcelReporte(item.id)
                          ">
                           <i class="far fa-file-excel"></i> Reporte
                          </button>


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


    <!--    MODAL DE REQUERIMIENTOS DE MATERIALES -->

    <div class="modal fade" :class="{ show: modalShowEditItem }"
      :style="modalShowEditItem ? mostrarModal : ocultarModal">

      <div class="modal-editcotitem modal-lg" role="document">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Requerimiento de Materiales</h5>
            <button class="close" @click="abrirModalInfoProd"></button>
          </div>
          <div class="modal-body">
            <div class="content container-fluid">
              <form role="form">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">

                      <div class="card-body table-responsive">

                        <table class="
                            table table-hover table-head-fixed
                            text-nowrap
                            projects
                          ">
                          <thead>
                            <tr>
                              <th>Descripcion Material</th>
                              <th>Cantidad</th>
                              <th>Precio Unit</th>
                              <th>Total</th>
                              <th>Accion</th>

                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in listReqMateriales" :key="index">
                              <td>
                                {{
                                    item.producto.codigo +
                                    ' - ' +
                                    item.producto.familia.nombre +
                                    ' , ' +
                                    item.producto.subfamilia.nombre +
                                    ' , Modelo: ' +
                                    item.producto.modelotipo.nombre +
                                    ' , Marca : ' +
                                    item.producto.marca.nombre +
                                    ' , Material : ' +
                                    item.producto.material.nombre +
                                    ' ,' +
                                    item.producto.homologacion.nombre
                                
                                }}

                              </td>
                              <td>{{ item.cantidad }}</td>
                              <td>{{ item.costunit }}</td>
                              <td>{{ item.cantidad * item.costunit }}</td>
                              <td> <button class="btn btn-primary btn-sm" @click.prevent="
                                MandarDatosPrecio(item.id, item.costunit, item.cantidad, item.informeproduccion_id)
                              ">
                                  <i class="fas fa-comment-dollar"></i> Precio
                                </button></td>

                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <!--    <button class="btn btn-success" @click="EditModalReqMateriales()">
                    Editar
                  </button> -->
              <button class="btn btn-secondary" @click="abrirModalInfoProd">
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--  FIN DEL MODAL DE REQUERIMIENTOS DE MATERIALES -->


    <!--    MODAL DE MANO DE OBRA  -->

    <div class="modal fade" :class="{ show: modalShowEditMObra }"
      :style="modalShowEditMObra ? mostrarModal : ocultarModal">

      <div class="modal-editcotitem modal-lg" role="document">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Mano de Obra</h5>
            <button class="close" @click="abrirModalManoObra"></button>
          </div>
          <div class="modal-body">
            <div class="content container-fluid">
              <form role="form">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">

                      <div class="card-body table-responsive">

                        <table class="
                            table table-hover table-head-fixed
                            text-nowrap
                            projects
                          ">
                          <thead>
                            <tr>
                              <th>Personal</th>
                              <th>Horas</th>
                              <th>Días</th>
                              <th>Costo Dias</th>
                              <th>Costo Horas</th>
                              <th>Total</th>

                              <th>Acción</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in listManObra" :key="index">
                              <td>{{ item.personal }}</td>
                              <td>{{ item.horas }}</td>
                              <td>{{ item.dias }}</td>
                              <td>{{ item.costdias }}</td>
                              <td>{{ item.costhoras }}</td>
                              <td>{{ item.total }}</td>


                              <td> <button class="btn btn-primary btn-sm" @click.prevent="
                                MandarDiaMObra(item.id , item.informeproduccion_id, total = (item.dias * item.costdias ) + (item.horas * item.costhoras))
                              ">
                                  <i class="fas fa-comment-dollar"></i> Días
                                </button>
                                <button class="btn btn-primary btn-sm" @click.prevent="
                                  MandarHoraMObra(item.id,  item.informeproduccion_id, total = (item.dias * item.costdias ) + (item.horas * item.costhoras))
                                ">
                                  <i class="fas fa-comment-dollar"></i> Horas
                                </button>

                              </td>


                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <!--    <button class="btn btn-success" @click="EditModalReqMateriales()">
                    Editar
                  </button> -->
              <button class="btn btn-secondary" @click="abrirModalManoObra">
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN DEL MODAL DE MANO DE OBRA  -->




    <!--    MODAL DE OTROS REQUERIMIENTOS  -->

    <div class="modal fade" :class="{ show: modalShowEditOtrosReque }"
      :style="modalShowEditOtrosReque ? mostrarModal : ocultarModal">

      <div class="modal-editcotitem modal-lg" role="document">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Otros Requerimientos</h5>
            <button class="close" @click="abrirModalOtrosReque"></button>
          </div>
          <div class="modal-body">
            <div class="content container-fluid">
              <form role="form">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">

                      <div class="card-body table-responsive">

                        <table class="
                            table table-hover table-head-fixed
                            text-nowrap
                            projects
                          ">
                          <thead>
                            <tr>
                              <th>Descripción</th>
                              <th>Cantidad</th>
                              <th>Precio</th>
                              <th>Total</th>
                              <th>Acción</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in listOtrosReq" :key="index">
                              <td>{{ item.descripcion }}</td>
                              <td>{{ item.cantidad }}</td>
                              <td>{{ item.precio }}</td>
                              <td>{{ item.total }}</td>
                      
                              <td> <button class="btn btn-primary btn-sm" @click.prevent="
                                MandarDiaOtroReq(item.id , item.informeproduccion_id, item.cantidad)
                              ">
                                  <i class="fas fa-comment-dollar"></i> Precio
                                </button>
                           

                              </td>


                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <!--    <button class="btn btn-success" @click="EditModalReqMateriales()">
                    Editar
                  </button> -->
              <button class="btn btn-secondary" @click="abrirModalOtrosReque">
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN DEL MODAL DE OTROS REQUERIMIENTOS  -->




  </div>



</template>

<script>
import FileSaver from "file-saver";
export default {
  data() {
    return {
      fillReporteInfoProduccion: {
        nIdprod: "",
        dFecha: "",

      },
      modalShowEditItem: false,
      mostrarModal: {
        display: "block",
        background: "#0000006b",
      },

      modalShowEditMObra: false,
      mostrarModal: {
        display: "block",
        background: "#0000006b",
      },

      modalShowEditOtrosReque: false,
      mostrarModal: {
        display: "block",
        background: "#0000006b",
      },

      ocultarModal: {
        display: "none",
      },
      listProd: [],
      listOrdenProduc: [],
      listReqMateriales: [],
      listManObra: [],
      listOtrosReq : [],

      pageNumber: 0,
      perPage: 10,
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
    };
  },
  mounted() {
    this.getListarproductosByName();
  },

     computed: {
      pageCount() {
        let a = this.listOrdenProduc.length,
          b = this.perPage;
        return Math.ceil(a / b);
      },
      listarClientesPaginated() {
        let inicio = this.pageNumber * this.perPage,
          fin = inicio + this.perPage;
        return this.listOrdenProduc.slice(inicio, fin);
      },
      pagesList() {
        let a = this.listOrdenProduc.length,
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

    abrirModalInfoProd(item) {
      this.modalShowEditItem = !this.modalShowEditItem;
      this.setMostrarInfo(item)
    },

    abrirModalManoObra(item) {

      this.modalShowEditMObra = !this.modalShowEditMObra;
      this.setMostrarInfoManObra(item)
    },

    abrirModalOtrosReque(item){
      this.modalShowEditOtrosReque = !this.modalShowEditOtrosReque;
      this.setMostrarInfOtrosReq(item)
      
    },

    setMostrarInfo(item) {
      var url = "/administracion/InformeProduccion/mostrarInfoProd";
      axios
        .get(url, {
          params: {
            item
          },
        })
        .then((response) => {
          this.listReqMateriales = response.data;
        });
    },

    setMostrarInfoManObra(item) {
      var url = "/administracion/InformeProduccion/mostrarInfoManObra";
      axios
        .get(url, {
          params: {
            item
          },
        })
        .then((response) => {
          this.listManObra = response.data;
        });
    },
    setMostrarInfOtrosReq(item){
      var url = "/administracion/InformeProduccion/mostrarInfOtrosReq"; 
      axios
        .get(url, {
          params: {
            item
          },
        })
        .then((response) => {
          this.listOtrosReq = response.data;
        });
    },

    MandarDatosPrecio(item, costunit, cantidad, informeproduccion_id) {

      let precio = prompt("Ingrese el precio a editar", costunit);
      let total = cantidad * precio;

      var url = "/administracion/InformeProduccion/editPrecioMatOdrProd";
      axios
        .post(url, {
          item,
          precio,
          total
        })
        .then((response) => {
          this.setMostrarInfo(informeproduccion_id) 
        });

    },



    MandarDiaMObra(id, informeproduccion_id, total) {

    
      let precioDia = prompt("Ingrese el precio de la Hora ");
      var url = "/administracion/InformeProduccion/editPrecioDiaOdrProd";
      axios
        .post(url, {
          id,
          precioDia,
          total

        })
        .then((response) => {
          this.setMostrarInfoManObra(informeproduccion_id)

        });
    },

    MandarDiaOtroReq(id, informeproduccion_id, cantidad){
      let precioDia = prompt("Ingrese el precio ");
      let total = parseInt(cantidad) * precioDia
      
      var url = "/administracion/InformeProduccion/editPrecioOtrosReq";
      axios
        .post(url, {
          id,
          precioDia,
          total

        })
        .then((response) => {
          this.setMostrarInfOtrosReq(informeproduccion_id)

        });
    },

    MandarHoraMObra(id, informeproduccion_id, total) {
      let precioHora = prompt("Ingrese el precio de la Hora ");
      var url = "/administracion/InformeProduccion/editPrecioHoraOdrProd";
      axios
        .post(url, {
          id,
          precioHora,
          total
        })
        .then((response) => {
          this.setMostrarInfoManObra(informeproduccion_id)

        });
    },


    SetGenerarreqMaterialesPDF(item) {
      var config = { responseType: "blob" };
      var url = "/administracion/InformeProduccion/setGenerarInfoProduccionPdf";
      axios
        .post(
          url,
          {
            params: {
              item,
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

    
    getExcelReporte(item){
      var url = "/operacion/InformeProduccion/export"; 
      axios
        .post(
          url,
          {
            params: { item },
          },
          { responseType: "blob" }
        )
        .then((response) => {
          FileSaver.saveAs(response.data, "OrdenProd.xlsx");
        });

        },

    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillReporteInfoProduccion.nIdprod,
          },
        })
        .then((response) => {
          this.listProd = response.data;
        });
    },

    limpiarListClientsBsq() {
      this.fillReporteInfoProduccion.cNombre = "";
      this.fillReporteInfoProduccion.cRuc = "";
      this.listOrdenProduc = [];

    },
    limpiarBandejaProveedor() {
      this.listOrdenProduc = [];
    },
    getListReportProduc() {
      var url = "/administracion/InformeProduccion/list"; 
      axios
        .get(url, {
          params: {
            nIdprod: this.fillReporteInfoProduccion.nIdprod,
            dFecha: this.fillReporteInfoProduccion.dFecha,
          },
        })
        .then((response) => {
          this.listOrdenProduc = response.data;

        });
    },

    ExcelListOrdProd(){
      var url = "/administracion/InformeProduccion/ExcelListOrdProd"; 
      axios
        .post(
          url,
          {
            params: { listOrdenProduc: JSON.stringify(this.listOrdenProduc) },
          },
          { responseType: "blob" }
        )
        .then((response) => {
          FileSaver.saveAs(response.data, "InfoProduccion.xlsx");
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
