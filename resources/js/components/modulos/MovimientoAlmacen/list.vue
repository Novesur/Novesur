<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Movimiento de Almacén</h1>
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
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">RUC</label>
                          <div class="col-md-4">
                            <input type="text" class="form-control" :disabled="isDisabled"
                              v-model="fillBsqMovAlmacen.nIdRuc" v-int />
                          </div>
                          <span><button class="btn btn-flat btn-success" @click.prevent="getBuscaRucBD">
                              <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-flat btn-info" @click.prevent="getRefresh">
                              <i class="fas fa-sync-alt"></i>
                            </button>
                          </span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-1 col-form-label">Cliente</label>
                          <div class="col-md-8">
                            <input type="text" class="form-control" :disabled="isDisabled"
                              v-model="fillBsqMovAlmacen.nIdCliente" v-int />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label">Fecha</label>
                            <el-date-picker v-model="fillBsqMovAlmacen.dFecha" type="daterange" range-separator="To"
                              start-placeholder="Start date" end-placeholder="End date" value-format="yyyy-MM-dd"
                              clearable :style="{
              width: '530px',
              height: '38px',
            }">
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
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getlistMovAlmacen">
                      Buscar
                    </button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriteriosBsq">
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
                <table class="table table-hover table-head-fixed text-nowrap projects">
                  <thead>
                    <tr>
                      <th>CODIGO</th>
                      <th>FECHA EMISION</th>
                      <th>FECHA ENVIO</th>
                      <th>TIPO DE TRASLADO</th>
                      <th>NRO DOCUMENTO</th>
                      <th>PUNTO PARTIDA</th>
                      <th>PUNTO LLEGADA</th>
                      <th>CLIENTE</th>
                      <th>MOTIVO</th>
                      <th>ESTADO</th>
                      <th>ACCION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in lisMovAlmacenPaginated" :key="index">
                      <td>
                        {{ item.codigo }}
                      </td>
                      <td>
                        {{ item.fechaemision | moment("DD - MM - Y") }}
                      </td>
                      <td>
                        {{ item.fechaenvio | moment("DD - MM - Y") }}
                      </td>
                      <td v-text="item.tipo_traslado.nombre"></td>
                      <td v-text="item.comprobante"></td>
                      <td v-text="item.puntopartida[0].nombre"></td>
                      <td v-text="item.puntollegada[0].nombre"></td>
                      <td v-text="item.cliente.razonsocial"></td>
                      <td v-text="item.motivotraslado.nombre"></td>
                      <td v-text="item.estadopedido.nombre"></td>
                      <td>
                        <button class="btn btn-info btn-sm" @click="abrirModal(item.id)">
                          <i class="far fa-eye"></i> Detalle
                        </button>

                        <button v-if="item.estadopedido_id === 4" class="btn btn-primary btn-sm" @click="procesar(item.id)">
                          <i class="fas fa-file-import"></i> Procesar
                        </button>


                      </td>
                      <!--       <td>
                        <router-link class="btn btn-info btn-sm" :to="{
                          name: 'guiaremision.create',
                          params: {
                            id: item.codigo,
                          },
                        }">
                          <i class="fas fa-pencil-alt"></i>Guia de Remision
                        </router-link> -->

                      <!--  <button
                          class="btn btn-primary btn-sm"
                          @click="abrirModal(item.id)"
                        >
                          <i class="far fa-eye"></i> Detalle
                        </button>

                        <button
                          @click.prevent="getPdfCotizacion(item.id)"
                          class="btn btn-danger btn-sm"
                        >
                          <span><i class="far fa-file-pdf"></i></span> PDF
                        </button> -->

                      <!--    <router-link
                          class="btn btn-danger btn-sm"
                          :to="{
                            name: 'cotizacion.reportCotizacionPdf',
                            params: { id: item.id },
                          }"
                        >
                          <i class="far fa-file-pdf"></i> PDF
                        </router-link> -->
                      <!--
                        <template v-if="item.estadodias <= 30">
                          <router-link
                            class="btn btn-secondary btn-sm"
                            :to="{
                              name: 'cotizacion.editar',
                              params: { id: item.id },
                            }"
                          >
                            <i class="far fa-edit" ></i> Editar
                          </router-link>
                        </template> -->

                      <!--         <template v-else>
                          <button
                            @click.prevent="getActualizarFecha(item.id)"
                            class="btn btn-success btn-sm"
                          >
                            <i class="far fa-calendar-alt"></i> Actualizar
                          </button>
                        </template>
                      </td> -->
                    </tr>
                  </tbody>
                </table>
                <div class="card-footer">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item" v-if="pageNumber > 0">
                      <a href="#" class="page-link" @click.prevent="prevPage">Ant</a>
                    </li>
                    <li class="page-item" v-for="(page, index) in pagesList" :key="index"
                      :class="[page == pageNumber ? 'active' : '']">
                      <a href="#" class="page-link" @click.prevent="selectPage(page)">
                        {{ page + 1 }}</a>
                    </li>
                    <li class="page-item" v-if="pageNumber < pageCount - 1">
                      <a href="#" class="page-link" @click.prevent="nextPage">Post</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" :class="{ show: modalShow }" :style="modalShow ? mostrarModal : ocultarModal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              Detalle de Movimiento de Almacen #
              <!--    {{ this.fillBsqMovAlmacen.itemid | fourchar }} -->
            </h5>
            listDetPedido

            <button class="close" @click="abrirModal(item.id)"></button>
          </div>
          <div class="modal-body">
            <!-- Listado de Detalle de Cotizaciones -->

            <div class="card-body table-responsive">
              <table class="table table-hover table-head-fixed text-nowrap projects">
                <thead>
                  <tr>
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Unidad Medida</th>
                    <th>Cantidad</th>
                    <th>Peso</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in listDetPedido" :key="index">
                    <td v-text="item.producto.codigo"></td>

                    <td v-text="item.producto.familia.nombre +
              ',' +
              item.producto.subfamilia.nombre +
              ', MODELO :' +
              item.producto.modelotipo.nombre +
              ', MATERIAL :' +
              item.producto.material.nombre +
              ', MARCA :' +
              item.producto.marca.nombre
              "></td>

                    <td v-text="item.unidmedida.nombre"></td>
                    <td v-text="item.cantidad"></td>
                    <td v-text="item.peso"></td>
                    <td v-text="(item.cantidad * item.peso).toFixed(2)"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" @click="abrirModal">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!--  MODAL DE ESTADO DE COTIZACION -->

    <div class="modal fade" :class="{ show: modalEstado }" :style="modalEstado ? mostrarModal : ocultarModal"
      @keydown.esc="dialog = false">
      <div class="modal-dialog modal-dialog-center modal-dialog-scrollable d-flex align-items-center" role="document"
        style="top: 50% !important">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cambiar Estado de Cotizacion</h5>
            <button class="close" @click="abrirEstado()"></button>
          </div>
          <div class="modal-body">
            <!-- Listado de Detalle de Cotizaciones -->
            <div class="col">
              <el-select v-model="fillBsqMovAlmacen.nIdtEstadoCoti" filterable placeholder="Seleccione un estado"
                :style="{ width: '400px' }" @change="onChange()">
                <el-option v-for="item in listEstadoCoti2" :key="item.id" :label="item.nombre" :value="item.id">
                </el-option>
              </el-select>
            </div>

            <template v-if="fillBsqMovAlmacen.nIdtEstadoCoti == 2">
              <div class="col" :style="'padding-top : 20px'">
                <input type="text" class="form-control" placeholder="Motivo del Rechazo"
                  v-model="fillBsqMovAlmacen.cMotivoRechazo" />
              </div>
            </template>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" @click="setEditarPedido" :disabled="EstadoBotonEditar">
              Editar
            </button>
            <button class="btn btn-secondary" @click="abrirEstado">
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
      fillBsqMovAlmacen: {
        cNombre: "",
        nIdCliente: "",
        nIdVendedor: "",
        itemid: "",
        dFecha: "",
        nIdtEstadoCoti: "",
        cMotivoRechazo: "",
        nIdRuc: "",
        nIdUser: sessionStorage.getItem("iduser"),
      },
      EstadoBotonEditar: true,
      txtrechazo: {
        margin: 15,
      },
      listDetPedido: [],
      listVendedorAdmin: [],
      listVendedorUser: [],
      listMovAlmacen: [],
      listCliente: [],
      listEstadoCoti: [],
      listEstadoCoti2: [],
      modalShow: false,
      modalEstado: false,
      mostrarModal: {
        display: "block",
        background: "#0000006b",
        position: "fixed",
      },
      ocultarModal: {
        display: "none",
      },
      isDisabled: false,
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
    this.getListDetMovAlmacen();
    this.getlistVendedorAdmin();
    //this.cargaFechaActual();
    this.getlistVendedorxUsu();
    this.getlistEstadoPedido();
    this.getlistEstadoPedidoTodos();
  },

  computed: {
    pageCount() {
      let a = this.listMovAlmacen.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    lisMovAlmacenPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listMovAlmacen.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listMovAlmacen.length,
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

    getBuscaRucBD() {
      if (!this.fillBsqMovAlmacen.nIdRuc) {
        Swal.fire("Ingrese el Ruc por favor!");
      } else {
        var url = "/administracion/cliente/BuscaRucBD";
        axios
          .post(url, {
            nIdRuc: this.fillBsqMovAlmacen.nIdRuc
          })
          .then((response) => {
            this.fillBsqMovAlmacen.nIdCliente =
              response.data.razonsocial;
            this.isDisabled = true;
          });
      }
    },




    getRefresh() {
      this.fillBsqMovAlmacen.nIdCliente = "";
      this.fillBsqMovAlmacen.nIdRuc = "";
      this.isDisabled = false;
    },

    procesar(id) {
      var url = "/administracion/MovimientoAlmacen/procesar"; 
      axios
        .post(url, {
          id,
          nIdUser: this.fillBsqMovAlmacen.nIdUser,
          nIdRuc: this.fillBsqMovAlmacen.nIdRuc
        })
        .then((response) => {
         this.getlistMovAlmacen()
        });
    },

    cargaFechaActual() {
      this.fillBsqMovAlmacen.dFecha = new Date();
    },

    onChange() {
      if (this.fillBsqMovAlmacen.nIdtEstadoCoti == 1) {
        this.EstadoBotonEditar = true;
      } else {
        this.EstadoBotonEditar = false;
      }
    },
    abrirModal(item) {
      this.modalShow = !this.modalShow;
      this.fillBsqMovAlmacen.itemid = item;
      this.getListDetMovAlmacen(item);
    },

    abrirEstado(item) {
      this.modalEstado = !this.modalEstado;
      this.fillBsqMovAlmacen.itemid = item;
      this.BuscaCotizacionList(item);
    },

    limpiarCriteriosBsq() {
      this.fillBsqMovAlmacen.nIdVendedor = "";
      this.fillBsqMovAlmacen.nIdCliente = "";
      this.fillBsqMovAlmacen.dFecha = "";
    },
    limpiarBandejaMaterial() {
      this.listDetPedido = [];
    },
    getListDetMovAlmacen(item) {
      var url = "/administracion/MovimientoAlmacen/getListDetMovAlmacen";
      axios
        .get(url, {
          params: {
            item: item,
          },
        })
        .then((response) => {
          this.listDetPedido = response.data;
          console.log(response.data);

          /*

this.fillBsqMovAlmacen.nIdCliente = this.listDetPedido[0].id; */
        });
    },
    getlistVendedorAdmin() {
      var url = "/administracion/usuario/getListarUsusarios";
      axios.get(url).then((response) => {
        this.listVendedorAdmin = response.data;
        this.getlistCliente();
      });
    },
    getlistVendedorxUsu() {
      var url = "/administracion/usuario/getListarUsusariosbyId";
      axios
        .get(url, {
          params: {
            nIdUsuario: this.fillBsqMovAlmacen.nIdUser,
          },
        })
        .then((response) => {
          this.listVendedorUser = response.data;
          this.fillBsqMovAlmacen.nIdVendedor = this.listVendedorUser[0].id;
          this.getlistCliente();
        });
    },

    getlistMovAlmacen() {
      var url = "/administracion/MovimientoAlmacen/list";
      axios
        .get(url, {
          params: {
            nIdRuc: this.fillBsqMovAlmacen.nIdRuc,
            nIdVendedor: this.fillBsqMovAlmacen.nIdVendedor,
            dFecha: this.fillBsqMovAlmacen.dFecha,
            dFechainicio: !this.fillBsqMovAlmacen.dFecha
              ? ""
              : this.fillBsqMovAlmacen.dFecha[0],
            dFechafin: !this.fillBsqMovAlmacen.dFecha
              ? ""
              : this.fillBsqMovAlmacen.dFecha[1],
          },
        })
        .then((response) => {
          this.listMovAlmacen = response.data;

          //this.inicializarPaginacion();
        });
    },

    getlistCliente() {
      var url = "/administracion/cliente/getListarCliente";
      axios
        .get(url, {
          params: {
            nIdVendedor: this.fillBsqMovAlmacen.nIdVendedor,
          },
        })
        .then((response) => {
          (this.fillBsqMovAlmacen.nIdCliente = ""),
            (this.listCliente = response.data);
        });
    },
    BuscaCotizacionList(item) {
      var url = " /administracion/cotizacion/ListCotizacionbyId";
      axios
        .get(url, {
          params: {
            item: item,
          },
        })
        .then((response) => {
          this.getlistEstadoPedido(response.data.id);
        });
    },
    getlistEstadoPedido(item) {
      var url = "/administracion/cotizacion/buscaEstado";
      axios
        .get(url, {
          params: {
            item: item,
          },
        })
        .then((response) => {
          //this.fillBsqMovAlmacen.nIdtEstadoCoti =  response.data.estadopedido.nombre ;
          this.fillBsqMovAlmacen.nIdtEstadoCoti =
            response.data.estadopedido_id;
        });
    },
    getlistEstadoPedidoTodos() {
      var url = "/administracion/detallecotizancion/listEstadoCotizacion";
      axios.get(url).then((response) => {
        this.listEstadoCoti2 = response.data;
      });
    },

    setEditarPedido() {
      var url = "/administracion/cotizacion/editEstadoCotizacion";
      axios
        .post(url, {
          itemid: this.fillBsqMovAlmacen.itemid,
          nIdtEstadoCoti: this.fillBsqMovAlmacen.nIdtEstadoCoti,
          cMotivoRechazo: this.fillBsqMovAlmacen.cMotivoRechazo,
        })
        .then((response) => {
          (this.fillBsqMovAlmacen.cMotivoRechazo = ""),
            /*   this.listDetPedido = response.data; */
            this.getlistMovAlmacen();
        });
    },

    getPdfCotizacion(item) {
      var config = { responseType: "blob" };
      var url = "/administracion/cotizacion/CotizacionPdf";
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
          var oMyBlob = new Blob([response.data], {
            type: "application/pdf",
          });
          var url = URL.createObjectURL(oMyBlob);
          window.open(url);
          //window.print();
        });
    },

    getActualizarFecha(item) {
      Swal.fire({
        title: "Esta usted Seguro?",
        text: "La fecha de la cotizacion se cambiara a la actual",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Edita la fecha de la cotización!",
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/cotizacion/updateFechaCotizacion";
          axios
            .post(url, {
              item: item,
            })
            .then((response) => {
              this.listMovAlmacen = response.data;
            });
        }
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

<style></style>
