<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Guia de Remisión</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/ordenCompra/list'">
              <i class="fas fa-arrow-left"></i>Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Guia de Remisión</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Cliente</label>
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillGuiaRemisionCreate.nidCliente"
                            />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">RUC</label>
                          <div class="col-md-8">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillGuiaRemisionCreate.nIdRuc"
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
                          <label class="col-md-2 col-form-label"
                            >Punto de Partida</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillGuiaRemisionCreate.nIdPuntoPartida"
                            />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >Punto de Llegada</label
                          >
                          <div class="col-md-8">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillGuiaRemisionCreate.nIdPuntoSalida"
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
                            >Motivo de Traslado</label
                          >
                          <div class="col-md-4">
                            <el-select
                              v-model="fillGuiaRemisionCreate.nIdMotivo"
                              placeholder="Select"
                              style="width: 20vw"
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

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Fecha de Inicio de Traslado</label
                          >
                          <div class="col-md-4">
                            <el-date-picker
                              v-model="fillGuiaRemisionCreate.cFechaTraslado"
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
                </form>
              </div>

              <div class="container-fluid">
                <form role="form">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">
                            UNIDAD DE TRANSPORTE Y CONDUCTOR
                          </h3>
                        </div>
                        <div class="card-body">
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-md-2 col-form-label"
                                >PLACA DEL VEHICULO</label
                              >

                              <div class="col-md-4">
                                <input
                                  type="text"
                                  class="form-control"
                                  v-model="fillGuiaRemisionCreate.cPlacaVehiculo"
                                  v-int
                                />
                              </div>

                              <label class="col-md-2 col-form-label"
                                >MODALIDAD DE TRANSPORTE</label
                              >

                              <div class="col-md-4">
                                <input
                                  type="text"
                                  class="form-control"
                                  v-model="fillGuiaRemisionCreate.cModTransporte"
                                  v-int
                                />
                              </div>
                            </div>
                          </div>

                          <form role="form">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group row">
                                  <label class="col-md-2 col-form-label"
                                    >DNI DEL CONDUCTOR</label
                                  >
                                  <div class="col-md-3">
                                    <input
                                      type="text"
                                      class="form-control"
                                      v-model="fillGuiaRemisionCreate.cDniConductor"
                                      v-int
                                    />
                                  </div>

                                  <label class="col-md-1 col-form-label"
                                    >PESO TOTAL APROX.(KGM)
                                  </label>
                                  <div class="col-md-3">
                                    <input
                                      type="text"
                                      class="form-control"
                                      v-model="fillGuiaRemisionCreate.cPesoTotal"
                                      v-int
                                    />
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group row">
                                      <label class="col-md-2 col-form-label"
                                        >OBSERVACION</label
                                      >
                                      <div class="col-md-10">
                                        <input
                                          type="text"
                                          class="form-control"
                                          v-model="
                                            fillGuiaRemisionCreate.cObservacion
                                          "
                                          @keypress.prevent.enter="
                                            setRegistrarPSalida
                                          "
                                        />
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-4 offset-4">

                      <button
                        class="btn btn-flat btn-default btnWidth"
                        @click.prevent="limpiarDetallePSalida"
                      >
                        Limpiar
                      </button>
                    </div>
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
                    class="
                      table table-hover table-head-fixed
                      text-nowrap
                      projects
                    "
                  >
                    <thead>
                      <tr>
                        <th>Codigo</th>
                        <th>Cantidad</th>
                        <th>Unid. Medida</th>
                        <th>Descripcion</th>
                        <th>Opcion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(item, index) in listarPSalidaPaginated"
                        :key="index"
                      >
                        <td v-text="item.codigo"></td>
                        <td v-text="item.cantidad"></td>
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

                        <td>
                          <button
                            class="btn btn-danger btn-sm"
                            @click.prevent="borradoItems(item.producto_id)"
                          >
                            <span><i class="fas fa-minus-circle"></i></span>
                            Eliminar
                          </button>
                        </td>
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
                      @click.prevent="setRegistrarPSalida"
                    >
                      Guardar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="eliminarTempitemPSalida"
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
    </div>

    <!--  Modal de Validacion de campos -->
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
    <!--  Fin del  Modal de Validacion de campos -->

    <!--Fin del  Modal de editar cantidad de Parte de Ingreso -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillGuiaRemisionCreate: {
        nidCliente:"",
        nIdRuc:"",
        nIdPuntoPartida: "",
        nIdPuntoSalida: "",
        nIdMotivo: "",
        cFechaTraslado: "",
        cPlacaVehiculo:"",
        cModTransporte:"",
        cDniConductor:"",
        cPesoTotal:"",
        cObservacion: "",
        ncodCotizacion: this.$attrs.id,
        nIdUser: sessionStorage.getItem("iduser"),



      },

      listarDetalleOrdeCompra: [],
      listMotivo: [],

      listarPSalidaPaginated: [],
      estadoProv: false,
      estadoCliente: false,

      modalCantidad: false,

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
    this.getListarUnidadMedida();

    this.setSelectMovimiento();

    this.fillGuiaRemisionCreate.cFecha = new Date();
  },
  computed: {},
  methods: {
    limpiarCriteriosBsq() {},
    setRegistrarPSalida() {
      if (this.validaPIngreso()) {
        this.modalShow = true;
        return;
      }
      this.setGrabarPSalida();
    },

    setListtempPSalida() {
      var url = "/administracion/parte_salida/ListtempParteSalida";
      axios.get(url, {}).then((response) => {
        this.listarPSalidaPaginated = response.data.datos;
      });
    },



    borradoItems(item) {
      var url = "/administracion/parte_salida/reorder";
      axios
        .post(url, {
          item: item,
        })
        .then((response) => {
          this.listarPSalidaPaginated = response.data.datos;
          // this.fillregistrarCotizacion.nIdprod = '';

          //console.log(item);
        });
    },

    setGrabarPSalida() {
      var url = "/administracion/parte_salida/GrabarPSalida";
      axios
        .post(url, {
          nIdPuntoPartida: this.fillGuiaRemisionCreate.nIdPuntoPartida,
          nIdPuntoSalida: this.fillGuiaRemisionCreate.nIdPuntoSalida,

          nIdMotivo: this.fillGuiaRemisionCreate.nIdMotivo,
          cfecha: this.fillGuiaRemisionCreate.cFecha,
          cobservacion: this.fillGuiaRemisionCreate.cObservacion,
          nIdUser: this.fillGuiaRemisionCreate.nIdUser,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 1500,
          });

          this.limpiarDetallePSalida();
          this.eliminarTempitemPSalida();
        });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },

    abrirModalCantidad() {
      this.modalCantidad = !this.modalCantidad;
    },
    validaPIngreso() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillGuiaRemisionCreate.nIdPuntoSalida) {
        this.mensajeError.push("El campo Factura es obligatorio");
      }

      if (!this.fillGuiaRemisionCreate.nIdMotivo) {
        this.mensajeError.push("El Campo Motivo es obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },

    limpiarDetallePSalida() {
      this.fillGuiaRemisionCreate.nIdPuntoPartida = " ";
      this.fillGuiaRemisionCreate.nIdPuntoSalida = "";

      this.fillGuiaRemisionCreate.cObservacion = "";
      this.fillGuiaRemisionCreate.nIdMotivo = "";

      this.fillGuiaRemisionCreate.cCantidad = "";
      this.fillGuiaRemisionCreate.cStock = "";
    },

    setLimpiaDetalleProducto() {
      this.fillGuiaRemisionCreate.cCantidad = "";
      this.fillGuiaRemisionCreate.cStock = "";
    },

    setListtempPSalida() {
      var url = "/administracion/parte_salida/ListtempParteSalida";
      axios.get(url, {}).then((response) => {
        this.listarPSalidaPaginated = response.data.datos;
      });
    },

    eliminarTempitemPSalida() {
      var url = "/administracion/parte_salida/eliminarTempitemPSalida";
      axios.post(url).then((response) => {
        this.setListtempPSalida();
      });
    },

    getListarMotivo(idMovimiento) {
      var url = "/administracion/KardexDetalle/listMotivo";
      axios
        .get(url, {
          params: {
            idMovimiento: idMovimiento,
          },
        })
        .then((response) => {
          this.listMotivo = [];
          this.listMotivo = response.data;
        });
    },
    setSelectMovimiento() {
      this.fillGuiaRemisionCreate.nIdMotivo = "";
      this.getListarMotivo(2);
    },
  },

  setResetCampos() {
    var url = "/administracion/tempcotizacion/eliminarTempitemCoti";
    axios.post(url).then((response) => {
      //this.setListtempCotizacion();
      this.listarPSalidaPaginated = response.data.datos;
    });
  },
};
</script>

<style>
</style>
