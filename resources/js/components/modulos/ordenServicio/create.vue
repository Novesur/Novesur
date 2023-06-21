<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Orden de Servicio</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/proveedor'">
              <i class="fas fa-arrow-left"></i>Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Orden de Servicio</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Proveedor</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearOrdenServicio.cProveedor"
                              style="width: 300px"
                              readonly
                            />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Referencia</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearOrdenServicio.cReferencia"
                              style="width: 300px"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Fecha Emision</label
                          >
                          <div class="col-md-9">
                            <el-date-picker
                              v-model="fillCrearOrdenServicio.cFechaEmision"
                              type="date"
                              placeholder="Ingrese una Fecha"
                              format="dd/MM/yyyy"
                              value-format="yyyy-MM-dd"
                            >
                            </el-date-picker>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Fecha Entrega</label
                          >
                          <div class="col-md-9">
                            <el-date-picker
                              v-model="fillCrearOrdenServicio.cFechaEntrega"
                              type="date"
                              placeholder="Ingrese una Fecha"
                              format="dd/MM/yyyy"
                              value-format="yyyy-MM-dd"
                            >
                            </el-date-picker>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Tipo de Moneda</label
                          >
                          <div class="col-md-9">
                          <el-select
                              v-model="fillCrearOrdenServicio.nIdTipoMoneda"
                              placeholder="Select"
                              style="width: 70%"
                            >
                              <el-option
                                v-for="item in listTipoCambio"
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
                            >Lugar de Entrega</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearOrdenServicio.cLEntrega"
                              style="width: 300px"
                            />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">

                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Preferencias de Pago</label
                          >
                          <div class="col-md-9">
                            <el-select
                              v-model="fillCrearOrdenServicio.nIdTipoPago"
                              placeholder="Select"
                              style="width: 70%"
                            >
                              <el-option
                                v-for="item in listDescripPago"
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
                            >Observación</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearOrdenServicio.cObservacion"

                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="container-fluid">
                    <form role="form">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">DETALLE DEL PRODUCTO</h3>
                            </div>
                            <div class="card-body">
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label"
                                  >DESCRIPCION DEL PRODUCTO</label
                                >

                                <div class="col-md-10">
                                  <el-select
                                    v-model="fillCrearOrdenServicio.nIdprod"
                                    style="width: 90%"
                                    filterable
                                    placeholder="Select"
                                  >
                                    <el-option
                                      v-for="item in listProd"
                                      :key="item.id"
                                      :label="
                                        item.codigo +
                                        ' - ' +
                                        item.familia.nombre
                                      "
                                      :value="item.id"
                                    >
                                    </el-option>
                                  </el-select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-1 col-form-label"
                                  >CANTIDAD</label
                                >
                                <div class="col-md-3">
                                  <input
                                    type="text"
                                    class="form-control"
                                    v-model="fillCrearOrdenServicio.cCantidad"
                                  />
                                </div>

                                <label class="col-md-1 col-form-label"
                                  >MEDIDA</label
                                >
                                <div class="col-md-3">
                                  <el-select
                                    v-model="fillCrearOrdenServicio.nIdUnidMed"
                                    placeholder="Select"
                                    style="width: 70%"
                                  >
                                    <el-option
                                      v-for="item in listUnidMed"
                                      :key="item.id"
                                      :label="item.nombre"
                                      :value="item.id"
                                    >
                                    </el-option>
                                  </el-select>
                                </div>

                                <label class="col-md-1 col-form-label"
                                  >PRECIO</label
                                >
                                <div class="col-md-3">
                                  <input
                                    type="text"
                                    class="form-control"
                                    v-model="fillCrearOrdenServicio.cPrecio"
                                  />
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setRegistrarPIngreso"
                    >
                      Agregar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="setResetCampos"
                    >
                      Limpiar
                    </button>
                  </div>
                </div>
              </div>

              <!--  Bandeja de Resultados -->
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
                        <th>Codigo</th>
                        <th>Cantidad</th>
                         <th>Precio</th>
                        <th>Unid. Medida</th>
                        <th>Descripcion</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(item, index) in listartempOrder"
                        :key="index"
                      >
                        <td v-text="item.codigo"></td>
                        <td v-text="item.cantidad"></td>
                         <td v-text="item.punit"></td>
                        <td v-text="item.unidmedNombre"></td>

                        <td
                          v-text="
                            item.productoFamilia +
                            ' ' +
                            item.productoSubfamilia +
                            ', MARCA :' +
                            item.productoMarca +
                            ', MODELO/TIPO :' +
                            item.productoModelotipo +
                            ', MATERIAL :' +
                            item.material
                          "
                        ></td>


                      </tr>


                    </tbody>
                  </table>
                </div>
              </div>

              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setGrabarOrderCompra"
                    >
                      Guardar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="eliminarTempitemOrders"
                    >
                      Limpiar
                    </button>
                  </div>
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
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Sistemas Novesur</h5>
              <button class="close" @click="abrirModal"></button>
            </div>
            <div class="modal-body">
              <div
                class="callout callout-danger"
                style="padding: 5px"
                v-for="(item, index) in mensajeError"
                :key="index"
                v-text="item"
              ></div>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillCrearOrdenServicio: {
        nIdProveedor: this.$attrs.id,
        cProveedor: "",
        cReferencia: "",
        cDocumento: "",
        cFechaEntrega: "",
        cFechaEmision: "",
        cLEntrega: "",
        nIdUnidMed: "",
        nIdprod: "",
        cPrecio: "",
        cCantidad: "",
        nIdTipoPago:"",
        nIdTipoMoneda:"",
        nIdUser: sessionStorage.getItem("iduser"),
        cObservacion: "",
      },

      listUnidMed: [],
      listProd: [],
      listartempOrder: [],
      listDescripPago: [],
      listTipoCambio : [],

      modalShow: false,
      mostrarModal: {
        display: "block",
        background: "#0000006b",
      },
      ocultarModal: {
        display: "none",
      },
      error: 0,
      mensajeError: [],
    };
  },
  mounted() {
    this.getListarByProveedor();
    this.getListarUnidadMedida();
    this.getListarproductosByName();
   // this.setListtemOrders();
    this.getlistDescricionPago();
    this.getlistTipoCambio()
    this.fillCrearOrdenServicio.cFechaEntrega = new Date();
    this.fillCrearOrdenServicio.cFechaEmision = new Date();

  },
  computed: {},
  methods: {
    getListarByProveedor() {
      var url = "/administracion/proveedor/getListarProveedorById";
      axios
        .get(url, {
          params: {
            nIdProveedor: this.fillCrearOrdenServicio.nIdProveedor,
          },
        })
        .then((response) => {
          this.fillCrearOrdenServicio.cProveedor = response.data.nombre;
        });
    },

    getlistDescricionPago() {
      var url = "/administracion/pago/index";
      axios.get(url).then((response) => {
        this.listDescripPago = response.data;
        this.fillCrearOrdenServicio.nIdDescripPago = this.listDescripPago[0].id;
      });
    },

        getlistTipoCambio() {
      var url = "/administracion/ordenCompra/TipoCambio";
      axios.get(url).then((response) => {
        this.listTipoCambio = response.data;
        this.fillCrearOrdenServicio.nIdTipoMoneda = this.listTipoCambio[0].id;
      });
    },

    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillCrearOrdenServicio.nIdprod,
          },
        })
        .then((response) => {
          this.listProd = response.data;
        });
    },

    getListarUnidadMedida() {
      var url = "/administracion/KardexDetalle/listUnidMed";
      axios.get(url).then((response) => {
        this.listUnidMed = response.data;
        this.fillCrearOrdenServicio.nIdUnidMed = this.listUnidMed[7].id;
      });
    },
    limpiarCriteriosBsq() {
      this.fillCrearOrdenServicio.cProveedor = "";
    },
    setRegistrarPIngreso() {
      if (this.validaPIngreso()) {
        this.modalShow = true;
        return;
      }
      this.setAddPMaterial();
    },

    setGrabarOrderCompra() {
      var url = "/administracion/OrdenServicio/create";
      axios
        .post(url, {

            cFechaEmision : this.fillCrearOrdenServicio.cFechaEmision,
            cReferencia : this.fillCrearOrdenServicio.cReferencia,
            nIdProveedor : this.fillCrearOrdenServicio.nIdProveedor,
            cFechaEntrega : this.fillCrearOrdenServicio.cFechaEntrega,
            cLEntrega: this.fillCrearOrdenServicio.cLEntrega,
            nIdTipoPago : this.fillCrearOrdenServicio.nIdTipoPago,
            nIdTipoMoneda : this.fillCrearOrdenServicio.nIdTipoMoneda,
            nIdUser : this.fillCrearOrdenServicio.nIdUser,
            cObservacion : this.fillCrearOrdenServicio.cObservacion
        })
        .then((response) => {

           Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 1500,
          });

          this.setResetCampos();
          this.eliminarTempitemOrders();

        });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    validaPIngreso() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillCrearOrdenServicio.cProveedor) {
        this.mensajeError.push("El campo nombre es obligatorio");
      }

           if(this.fillCrearOrdenServicio.cCantidad <=   0){
         this.mensajeError.push("Cantidad no puede ser menor o igual a cero");
      }
        if(!this.fillCrearOrdenServicio.cCantidad){
         this.mensajeError.push("Cantidad es campo obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },
    setAddPMaterial() {
      var url = "/administracion/ordenCompra/addOrden";
      axios
        .post(url, {
          nIdprod: this.fillCrearOrdenServicio.nIdprod,
          nIdUnidMed: this.fillCrearOrdenServicio.nIdUnidMed,
          cCantidad: this.fillCrearOrdenServicio.cCantidad,
          cPrecio: this.fillCrearOrdenServicio.cPrecio,
          CestadoDet:this.fillCrearOrdenServicio.CestadoDet,
          cPUnit : this.fillCrearOrdenServicio.cPUnit,
        })
        .then((response) => {
     this.listartempOrder = response.data.datos
     this.setLimpiaCampos();

        if (response.data.message == "Ya fue agregado anteriormente") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 1500,
            });
          }
        });
    },

    setLimpiaCampos() {
      this.fillCrearOrdenServicio.nIdprod = null;
      this.fillCrearOrdenServicio.cCantidad = "";
      this.fillCrearOrdenServicio.cPrecio = "";
    },

    setResetCampos() {
      this.fillCrearOrdenServicio.nIdprod = null;
      this.fillCrearOrdenServicio.cCantidad = "";
      this.fillCrearOrdenServicio.cPrecio = "";
      this.fillCrearOrdenServicio.cReferencia = "";
      this.fillCrearOrdenServicio.cDocumento = "";
      this.fillCrearOrdenServicio.cLEntrega = "";
      this.fillCrearOrdenServicio.cObservacion = "";
    },

    setListtemOrders() {
      var url = "/administracion/ordenCompra/ListtempOrden";
      axios.get(url, {}).then((response) => {
        this.listartempOrder = response.data.datos;
      });
    },

    eliminarTempitemOrders() {
      var url = "/administracion/ordenCompra/eliminarTemporder";
      axios.post(url).then((response) => {
        this.setListtemOrders();
      });
    },
  },
};
</script>

<style>
</style>
