<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Papeleta de Salida</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link
              class="btn btn-info btn-sm"
              :to="'/papeletaSalida/create'"
            >
              <i class="fas fa-plus-square"></i>Regresar
            </router-link>

            <template
              v-if="listRolPermisoByUsuario.includes('Papeleta.Reporte.excel')"
            >
              <button
                class="btn btn-success btn-sm"
                @click.prevent="getExcelpapeletaSalida"
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
                <h3 class="card-title">Criterios de Busqueda</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <!--  Por Vendedor  -->
                  <el-tabs v-model="activeName">
                    <el-tab-pane label="Por Vendedor" name="first">
                      <div class="col-md-12">
                        <div class="row">
                          <template
                            v-if="
                              listRolPermisoByUsuario.includes(
                                'admin.listado_coti'
                              )
                            "
                          >
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                  >Vendedor</label
                                >
                                <div class="col-md-6">
                                  <el-select
                                    v-model="fillBsqPapeletaSalida.nIdVendedor"
                                    filterable
                                    placeholder="Seleccione una Vendedor"
                                    :style="{ width: '350px' }"
                                    clearable
                                  >
                                    <el-option
                                      v-for="item in this.listVendedorAdmin"
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
                                    v-model="fillBsqPapeletaSalida.nIdVendedor"
                                    filterable
                                    placeholder="Seleccione una Vendedor"
                                    :style="{ width: '350px' }"
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
                              <label class="col-md-1 col-form-label"
                                >Motivo</label
                              >
                              <div class="col-md-8">
                                <el-select
                                  v-model="fillBsqPapeletaSalida.nIdMotivo"
                                  filterable
                                  placeholder="Seleccione un cliente"
                                  :style="{ width: '700px' }"
                                  clearable
                                >
                                  <el-option
                                    v-for="item in listMotivo"
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

                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label"
                                  >Fecha</label
                                >
                                <el-date-picker
                                  v-model="fillBsqPapeletaSalida.dFecha"
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
                      </div>

                      <div class="card-footer">
                        <div class="row">
                          <div class="col-md-4 offset-4">
                            <button
                              class="btn btn-flat btn-info btnWidth"
                              @click.prevent="getlistPapeleByVendedor"
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
                               <!--  <th></th> -->
                                <th >Fecha</th>
                                <th>Fecha de Salida</th>
                                <th>Hora de emisión </th>
                                <th>Vendedor</th>
                                <th>Hora Salida</th>
                                <th>Hora Retorno</th>
                                <th>Estado</th>
                                <th>Motivo</th>
                                <th>Observación</th>
                                <th>Acción</th>
                              </tr>

                            </thead>
                            <tbody>
                              
                              <tr
                                v-for="(item, index) in listCotizacionPaginated"
                                :key="index"
                              >
                           <!--    <td>
                                <button class="btn btn-primary "   @click.prevent="
                                      addTagPapeleta(item.id)
                                    " type="button">+</button>
                              </td> -->
                                <!-- <td>{{ item.fecha | moment("DD - MM - Y") }}</td> -->
                                <td @click.prevent="getlistClientxIndex(item.id )">
                                  {{
                                    item.created_at.substring(0, 10)
                                      | moment("DD - MM - Y")
                                  }}
                                </td>
                                <td @click.prevent="getlistClientxIndex(item.id )">
                                  {{ item.fecha | moment("DD - MM - Y") }}

                                </td>

                                <td>
                                  {{ item.hora_emision }}
                                </td>
                                <td @click.prevent="getlistClientxIndex(item.id )">{{ item.user.fullname }}



                                </td>

                                <td v-text="item.horasalida"></td>
                                <td v-text="item.horaretorno"></td>
                                <td
                                  v-text="item.estado_papeleta_salida.nombre"
                                ></td>

                                <td
                                  v-text="item.motivopapeletasalida.nombre"
                                ></td>
                                <td v-text="item.observacion"></td>

                                <td>
                                  <button
                                    class="btn btn-primary btn-sm"
                                    @click.prevent="
                                      abrirModalbyVendedor(item.id)
                                    "
                                  >
                                    <i class="far fa-eye"></i> Detalle
                                  </button>

                                  <button
                                    @click.prevent="
                                      getPdfPSalidabyVendedor(item.id)
                                    "
                                    class="btn btn-danger btn-sm"
                                  >
                                    <span><i class="far fa-file-pdf"></i></span>
                                    PDF
                                  </button>

                                  <template
                                    v-if="
                                      listRolPermisoByUsuario.includes(
                                        'papeleta.admin'
                                      )
                                    "
                                  >
                                    <button
                                      class="btn btn-success btn-sm"
                                      @click.prevent="
                                        aprobarPartidaSalida(item.id)
                                      "
                                    >
                                      <i class="far fa-thumbs-up"></i> Aprobar
                                    </button>
                                    <button
                                      class="btn btn-info btn-sm"
                                      @click.prevent="
                                        abrirAnularVendedor(item.id)
                                      "
                                    >
                                      <i class="far fa-calendar-check"></i>
                                      Anular
                                    </button>
                                  </template>

                                  <template v-else>
                                    <td></td>
                                  </template>


                                  <template
                                    v-if="
                                      listRolPermisoByUsuario.includes(
                                        'observacion.papeleta'
                                      )
                                    "
                                  >
                                    <button
                                      class="btn btn-secondary btn-sm"
                                      @click.prevent="ObservacionPapeleta(item.id)"
                                    >
                                      <i class="far fa-pen-to-square"></i>
                                      Observación
                                    </button>
                                  </template>
                                </td>

                                <td id="ag_opcionales" class="Inputobservacion">
                                  <!--            <input
                              type="text"
                               v-model="fillBsqPapeletaSalida.nIdObservacion "
                              class="form-control form-control-sm"


                            /> -->
                                </td>


                              </tr>

                                        <th >Cliente</th>
                                <tr >
                                        <div v-for="(item, index) in listClientxId"
                                                                        :key="index">
                                            <td   >{{ item.cliente.razonsocial }}</td>

                                        </div>
                                 </tr>

                            </tbody>
                          </table>
                          <div class="card-footer">
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
                                v-for="(page, index) in pagesList"
                                :key="index"
                                :class="[page == pageNumber ? 'active' : '']"
                              >
                                <a
                                  href="#"
                                  class="page-link"
                                  @click.prevent="selectPage(page)"
                                >
                                  {{ page + 1 }}</a
                                >
                              </li>
                              <li
                                class="page-item"
                                v-if="pageNumber < pageCount - 1"
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
                    </el-tab-pane>
                    <!-- Fin del tab Panel Por Vendedor  -->

                    <!-- Por cliente -->
                    <el-tab-pane label="Por Cliente" name="second">
                      <div class="col-md-12">
                        <template
                          v-if="
                            listRolPermisoByUsuario.includes(
                              'admin.listado_coti'
                            )
                          "
                        >
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                  >Cliente</label
                                >
                                <div class="col-md-6">
                                  <el-select
                                    v-model="fillBsqPapeletaSalida.nIdClient"
                                    filterable
                                    placeholder="Seleccione una Cliente"
                                    :style="{ width: '350px' }"
                                    clearable
                                  >
                                    <el-option
                                      v-for="item in this.listClientAdmin"
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
                        </template>
                        <template v-else>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 col-form-label"
                                >Cliente</label
                              >
                              <div class="col-md-6">
                                <el-select
                                  v-model="fillBsqPapeletaSalida.nIdClient"
                                  filterable
                                  placeholder="Seleccione una Cliente"
                                  :style="{ width: '350px' }"
                                  clearable
                                >
                                  <el-option
                                    v-for="item in this.listClient"
                                    :key="item.id"
                                    :label="item.razonsocial"
                                    :value="item.id"
                                  >
                                  </el-option>
                                </el-select>
                              </div>
                            </div>
                          </div>
                        </template>
                      </div>

                      <div class="card-footer">
                        <div class="row">
                          <div class="col-md-4 offset-4">
                            <button
                              class="btn btn-flat btn-info btnWidth"
                              @click.prevent="getlistPapeleByCliente"
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
                            id="tablaprueba"
                          >
                            <thead>
                              <tr>
                                <th>Fecha</th>
                                <th>Vendedor</th>
                                <th>Hora Salida</th>
                                <th>Hora Retorno</th>
                              </tr>
                            </thead>
                            <tbody  >
                              <tr    
                                v-for="(item, index) in listPapeleByClient"
                                :key="index"

                             
                              >
                                <td >
                                  {{
                                    item.papeletasalida.fecha
                                      | moment("DD - MM - Y")
                                  }}
                                </td>
                                <td
                                  v-text="item.papeletasalida.user.fullname"
                                ></td>

                                <td
                                  v-text="item.papeletasalida.horaretorno"
                                ></td>
                                <td
                                  v-text="item.papeletasalida.horasalida"
                                ></td>

                                <button
                                  class="btn btn-primary btn-sm"
                                  @click.prevent="
                                    abrirModalbyVendedor(item.papeletasalida.id)
                                  "
                                >
                                  <i class="far fa-eye"></i> Detalle
                                </button>

                                <button
                                  @click.prevent="
                                    getPdfPSalidabyVendedor(
                                      item.papeletasalida.id
                                    )
                                  "
                                  class="btn btn-danger btn-sm"
                                >
                                  <span><i class="far fa-file-pdf"></i></span>
                                  PDF
                                </button>
                              </tr>


                            </tbody>
                          </table>
                          <div class="card-footer">
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
                                v-for="(page, index) in pagesList"
                                :key="index"
                                :class="[page == pageNumber ? 'active' : '']"
                              >
                                <a
                                  href="#"
                                  class="page-link"
                                  @click.prevent="selectPage(page)"
                                >
                                  {{ page + 1 }}</a
                                >
                              </li>
                              <li
                                class="page-item"
                                v-if="pageNumber < pageCount - 1"
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
                    </el-tab-pane>
                  </el-tabs>
                  <!-- Fin del tab Panel Por Cliente  -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      :class="{ show: modalShow }"
      :style="modalShow ? mostrarModal : ocultarModal"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detalle de Papeleta de Salida</h5>

            <button class="close" @click="abrirModal(item.id)"></button>
          </div>
          <div class="modal-body">
            <!-- Listado de Detalle de Cotizaciones -->

            <div class="card-body table-responsive">
              <table
                class="table table-hover table-head-fixed text-nowrap projects"
              >
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Contacto</th>
                    <th>Fundamento</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(item, index) in this.listModalVendedorAdmin"
                    :key="index"
                  >
                    <td v-text="item.cliente.razonsocial"></td>

                    <td v-text="item.contacto"></td>
                    <td v-text="item.papeletasalida.fundamento"></td>
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
  </div>
</template>

<script>




import FileSaver from "file-saver";



export default {


  data() {
    return {
      fillBsqPapeletaSalida: {
        cNombre: "",
        nIdVendedor: "",
        itemid: "",
        dFecha: "",
        nIdtEstadoCoti: "",
        nIdMotivo: "",
        cMotivoRechazo: "",
        nIdUser: sessionStorage.getItem("iduser"),
        nIdClient: "",
        nIdObservacion: "",
      },
      activeName: "first",
      EstadoBotonEditar: true,
      txtrechazo: {
        margin: 30,
      },
      listDetPapeletaSalida: [],
      listModalVendedorAdmin: [],
      listVendedorAdmin: [],
      listVendedorUser: [],
      listPaginacion: [],
      listCliente: [],
      listMotivo: [],
      listClientAdmin: [],
      listClient: [],
      listPapeleByVendedor: [],
      listPapeleByClient: [],
      listClientxId: [],
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
        valormotivo:"",
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
      pageNumber: 0,
      perPage: 10,

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
    this.getlistVendedorAdmin();
    this.getlistMotivos();
    this.getlistVendedorxUsu();
    //this.getlistEstadoPedido();
    this.getlistClientAdmin();
    this.getlistClient();
  },

  computed: {
    pageCount() {
      let a = this.listPapeleByVendedor.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listCotizacionPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listPapeleByVendedor.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listPapeleByVendedor.length,
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


    ObservacionPapeleta(id) {
        this.valormotivo = prompt('Ingrese la observacion')

        var url = "/administracion/papeletasalida/ObservacionUpdate";
        axios.post(url,{
            valormotivo : this.valormotivo,
            idpapeleta: id
        }).then((response)=>{
     this.getlistPapeleByVendedor();
        })
    },


    getExcelpapeletaSalida() {
      var url = "/operacion/papeletaSalida/export";
      axios
        .post(
          url,
          {
            nIdMotivo : this.fillBsqPapeletaSalida.nIdMotivo,
            nIdVendedor: this.fillBsqPapeletaSalida.nIdVendedor,
            dFechainicio: !this.fillBsqPapeletaSalida.dFecha
              ? ""
              : this.fillBsqPapeletaSalida.dFecha[0],
            dFechafin: !this.fillBsqPapeletaSalida.dFecha
              ? ""
              : this.fillBsqPapeletaSalida.dFecha[1],
          },
          { responseType: "blob" }
        )
        .then((response) => {
          FileSaver.saveAs(response.data, "PapeletaSalida.xlsx");
          //console.log(response.data)
        });
    },

    cargaFechaActual() {
      this.fillBsqPapeletaSalida.dFecha = new Date();
    },

    onChange() {
      if (this.fillBsqPapeletaSalida.nIdtEstadoCoti == 2) {
        this.EstadoBotonEditar = true;
      } else {
        this.EstadoBotonEditar = false;
      }
    },
    abrirModalbyVendedor(item) {
      this.modalShow = !this.modalShow;
      this.fillBsqPapeletaSalida.itemid = item;
      this.BuscaClientePapeletaS(item);
    },
    abrirModal(item) {
      this.modalShow = !this.modalShow;
      this.fillBsqPapeletaSalida.itemid = item;
    },

    abrirEstadobyVendedor(item) {
      this.modalEstado = !this.modalEstado;
      this.fillBsqPapeletaSalida.itemid = item;
      this.BuscaClientePapeletaS(item);
    },
    abrirAnularVendedor(item) {
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
          var url = "/administracion/papeletasalida/setDarBajaPapeletaSalida";
          axios
            .post(url, {
              item: item,
            })
            .then((response) => {
              //this.getListarOrdenServicioxProveedor();
              this.getlistPapeleByVendedor();
            });

          Swal.fire(
            "Anulado!",
            "Tu Papeleta de Salida fue dado de Baja.",
            "success"
          );
        }
      });
    },

    aprobarPartidaSalida(item) {
      Swal.fire({
        title: "Desea aprobar la papeleta de salida?",
        text: "No podrás revertir esto.!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, quiero aprobarlo!",
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/papeletasalida/setAprobarPapeletaSalida";
          axios
            .post(url, {
              item: item,
            })
            .then(() => {
              //this.getListarOrdenServicioxProveedor();
              this.getlistPapeleByVendedor();
            });

          Swal.fire(
            "Aprobado!",
            "Tu Papeleta de Salida fue  aprobado.",
            "success"
          );
        }
      });
    },

    limpiarCriteriosBsq() {
      this.fillBsqPapeletaSalida.nIdVendedor = "";
      this.fillBsqPapeletaSalida.dFecha = "";
    },
    limpiarBandejaMaterial() {
      this.listDetPapeletaSalida = [];
    },

    getlistVendedorAdmin() {
      var url = "/administracion/usuario/getListarUsusarios";
      axios.get(url).then((response) => {
        this.listVendedorAdmin = response.data;
        this.fillBsqPapeletaSalida.nIdVendedor = this.listVendedorAdmin[0].id;
      });
    },
    getlistVendedorxUsu() {
      var url = "/administracion/usuario/getListarUsusariosbyId";
      axios
        .get(url, {
          params: {
            nIdUsuario: this.fillBsqPapeletaSalida.nIdUser,
          },
        })
        .then((response) => {
          this.listVendedorUser = response.data;
          this.fillBsqPapeletaSalida.nIdVendedor = this.listVendedorUser[0].id;
        });
    },

    getlistMotivos() {
      var url = "/administracion/papeletasalida/ListMotivos";
      axios.get(url).then((response) => {
        this.listMotivo = response.data;
        //this.fillBsqPapeletaSalida.nIdMotivo = this.listMotivo[2].id;
      });
    },

    getlistPapeleByVendedor() {
      var url = "/administracion/papeletasalida/listPapeleByVendedor";
      axios
        .get(url, {
          params: {
            nIdVendedor: this.fillBsqPapeletaSalida.nIdVendedor,
            nIdMotivo: this.fillBsqPapeletaSalida.nIdMotivo,
            dFechainicio: !this.fillBsqPapeletaSalida.dFecha
              ? ""
              : this.fillBsqPapeletaSalida.dFecha[0],
            dFechafin: !this.fillBsqPapeletaSalida.dFecha
              ? ""
              : this.fillBsqPapeletaSalida.dFecha[1],
          },
        })
        .then((response) => {
          this.listPapeleByVendedor = response.data;
          //console.log(response.data)
        });
    },

    getlistPapeleByCliente() {
      var url = "/administracion/papeletasalida/listPapeleByCliente";
      axios
        .get(url, {
          params: {
            nIdClient: this.fillBsqPapeletaSalida.nIdClient,
          },
        })
        .then((response) => {

          this.listPapeleByClient = response.data;
        });
    },

    BuscaClientePapeletaS(item) {
      var url = "/administracion/ClientePapeletaSalida/BuscaClientePapeletaS";
      axios
        .get(url, {
          params: {
            item: item,
          },
        })
        .then((response) => {
          this.listModalVendedorAdmin = response.data;
        });
    },

    getPdfPSalidabyVendedor(item) {
      var config = { responseType: "blob" };
      var url = "/administracion/papeletasalida/PapeletasalidaPdf";
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

    getlistClientAdmin() {
      var url = "/administracion/cliente/getListarAllCliente";
      axios.get(url).then((response) => {
        this.listClientAdmin = response.data;
      });
    },

    getlistClient() {
      var url = "/administracion/cliente/getListarCliente";
      axios
        .get(url, {
          params: {
            nIdVendedor: this.fillBsqPapeletaSalida.nIdUser,
          },
        })
        .then((response) => {
          this.listClient = response.data;
        });
    },

    getlistClientxIndex(papeletaId){

        var url = "/administracion/papeletasalida/getlistClientxIndex";
        axios.post(url,{
            papeletaId: papeletaId,
        }).then((response)=>{
     console.log(response.data)
     this.listClientxId  = response.data
        })
    },

    nextPage() {
      this.pageNumber++;
    },
    prevPage() {
      this.pageNumber--;
    },
    selectPage(page) {
      this.pageNumber = page;
      this.listClientxId =[]
    },

    inicializarPaginacion() {
      this.pageNumber = 0;
    },
  },
};
</script>

<style>
</style>
