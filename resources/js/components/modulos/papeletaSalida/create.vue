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
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Papeleta de Salida</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Motivo</label>
                          <div class="col-md-8">
                            <el-select
                              v-model="fillPapeletasalida.nIdMotivo"
                              placeholder="Select"
                              @change="onChangeMotivo(fillPapeletasalida.nIdMotivo)"
                              :style="{
                                width: '200px',
                              }"
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
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Hora de Visita</label>
                          <div class="col-md-4">
                            <el-time-picker
                              v-model="fillPapeletasalida.tHoraSalida"
                              :picker-options="rangoFechaPapeleta"
                              placeholder="Ingrese la Hora"
                              format="hh:mm:ss A"
                              value-format="hh:mm:ss A"
                            >
                            </el-time-picker>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Fin de Visita</label>
                          <div class="col-md-9">
                            <el-time-picker
                              v-model="fillPapeletasalida.tHoraRetorno"
                              :picker-options="{
                                selectableRange: '08:00:00 - 18:00:00',
                              }"
                              placeholder="Ingrese la Hora"
                              format="hh:mm:ss A"
                              value-format="hh:mm:ss A"
                            >
                            </el-time-picker>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Fecha</label>
                          <div class="col-md-4">
                            <el-date-picker
                              v-model="fillPapeletasalida.cFecha"
                              type="date"
                              placeholder="Ingrese una Fecha"
                              format="dd/MM/yyyy"
                              value-format="yyyy-MM-dd"
                              :picker-options="pickerOptions"
                            >
                            </el-date-picker>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-md-1 col-form-label">Referencia</label>
                          <div class="col-md-5">
                            <el-input
                              type="textarea"
                              :autosize="{
                                minRows: 2,
                                maxRows: 4,
                              }"
                              v-model="fillPapeletasalida.cReferencia"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Agregar Clientes</h3>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <!--              <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-1 col-form-label"
                              >Cliente</label
                            >
                            <div class="col-md-6">
                              <el-select
                                v-model="fillPapeletasalida.nIdCliente"
                                filterable
                                placeholder="Seleccione un cliente"
                                :style="{ width: '300px' }"
                                :disabled="this.fillPapeletasalida.estadoMotivo"
                                clearable
                              >
                                <el-option
                                  v-for="item in listVendedorUser"
                                  :key="item.id"
                                  :label="item.razonsocial"
                                  :value="item.id"
                                  :disabled="item.razonsocial === 'NINGUNO'"
                                >
                                </el-option>
                              </el-select>
                            </div>
                          </div>
                        </div> -->

                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <el-radio v-model="rpapeleta" label="3">
                                  <label class="col-md-2 col-form-label">Cliente</label>
                                </el-radio>
                                <div class="col-md-9">
                                  <input
                                    type="text"
                                    class="form-control"
                                    v-model="fillPapeletasalida.nidCliente"
                                    :disabled="true"
                                  />
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label">RUC</label>
                                <div class="col-md-4">
                                  <input
                                    type="text"
                                    class="form-control"
                                    v-model="fillPapeletasalida.nIdRuc"
                                    v-int
                                    :disabled="this.fillPapeletasalida.estadoMotivo"
                                  />
                                </div>
                                <span
                                  ><button
                                    class="btn btn-flat btn-success"
                                    @click.prevent="getBuscaRucBD"
                                  >
                                    <i class="fas fa-search"></i>
                                  </button>
                                  <button
                                    class="btn btn-flat btn-info"
                                    @click.prevent="getRefresh"
                                  >
                                    <i class="fas fa-sync-alt"></i>
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label">Otros</label>
                                <div class="col-md-9">
                                  <el-radio v-model="rpapeleta" label="680"
                                    >Cliente en Evaluacion</el-radio
                                  >
                                  <el-radio v-model="rpapeleta" label="729"
                                    >Despacho</el-radio
                                  >
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label">Contacto</label>
                            <div class="col-md-6">
                              <input
                                type="text"
                                class="form-control"
                                v-model="fillPapeletasalida.cContacto"
                                :disabled="this.fillPapeletasalida.estadoContacto"
                              />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-11">
                        <div class="form-group row">
                          <label class="col-md-1 col-form-label">Direccion</label>
                          <div class="col-md-8">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillPapeletasalida.cDireccion"
                              :disabled="this.fillPapeletasalida.estadoDireccion"
                            />
                          </div>
                          <span>
                            <button
                              class="btn btn-flat btn-success"
                              @click.prevent="setAddTempClient"
                            >
                              Agregar
                            </button>

                            <button
                              class="btn btn-flat btn-info"
                              @click.prevent="setResetCamposClientTemp"
                            >
                              Limpiar
                            </button>
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="card-body table-responsive">
                      <table
                        class="table table-hover table-head-fixed text-nowrap projects"
                      >
                        <thead>
                          <tr>
                            <th>Cliente</th>
                            <th>Direccion</th>
                            <th>Contacto</th>
                            <th>Acción</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(item, index) in listTempClientPSalida" :key="index">
                            <td>
                              {{ item.razonsocial }}
                            </td>
                            <td v-text="item.direccion"></td>
                            <td v-text="item.contacto"></td>

                            <button
                              @click.prevent="getEliminarClientTemp(item.id)"
                              class="btn btn-danger btn-sm"
                            >
                              <span><i class="far fa-file-pdf"></i></span>
                              Eliminar
                            </button>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </form>
              </div>

              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setRegistrarPapeletaSalida"
                    >
                      Guardar
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
            <button class="btn btn-secondary" @click="abrirModal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!--  Fin del  Modal de Validacion de campos -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillPapeletasalida: {
        nIdCliente: "",
        nIdUser: sessionStorage.getItem("iduser"),
        tHoraSalida: "",
        tHoraRetorno: "",
        cReferencia: "",
        cContacto: "",
        cFecha: "",
        nIdMotivo: "",
        cDireccion: "",
        estadoContacto: false,
        estadoDireccion: false,
        nIdRuc: "",

        cCantidadModal: "",
      },

      rpapeleta: "3",
      listVendedorUser: [],
      listarDetalleOrdeCompra: [],
      listTempClientPSalida: [],
      listMotivo: [],
      estadoProv: false,
      estadoCliente: false,
      isDisabled: false,

      modalCantidad: false,

      modalShow: false,

      pickerOptions: {
        disabledDate(time) {
          return time.getTime() < Date.now();
        },
      },

      mostrarModal: {
        display: "block",
        background: "#0000006b",
      },
      ocultarModal: {
        display: "none",
      },
      rangoFechaPapeleta: {
        selectableRange: "'08:00:00 - 17:00:00'",
      },
      error: 0,
      mensajeError: [],
    };
  },
  mounted() {
    this.getlistVendedorxUsu();
    this.getListarMotivo();
    this.fillPapeletasalida.cFecha = new Date();
    // this.setConfigTime();
    //  this.cargaRangoHorasPapeleta();

    //this.fillPapeletasalida.cFecha = new Date();
  },
  watch: {
    rpapeleta(value) {
      if (value === "3" || value === "729") {
        this.fillPapeletasalida.estadoContacto = false;
        this.fillPapeletasalida.estadoDireccion = false;
      }

      if (value === "680") {
        this.fillPapeletasalida.estadoContacto = true;
        this.fillPapeletasalida.estadoDireccion = false;
      }
    },
  },

  methods: {
    getBuscaRucBD() {
      if (!this.fillPapeletasalida.nIdRuc) {
        Swal.fire("Ingrese el Ruc por favor!");
      } else {
        var url = "/administracion/cliente/BuscaRucBD";
        axios
          .post(url, {
            nIdRuc: this.fillPapeletasalida.nIdRuc,
          })
          .then((response) => {
            this.fillPapeletasalida.nidCliente = response.data.razonsocial;
            this.rpapeleta = "680";
            this.rpapeleta = "3";
          });
      }
    },

    getRefresh() {
      this.fillPapeletasalida.nidCliente = "";
      this.fillPapeletasalida.nIdRuc = "";
      this.isDisabled = false;
    },

    cargaRangoHorasPapeleta() {
      const hoy = new Date();
      // let horaActual = hoy.getHours().toString().padStart(2,'0') + ':' + hoy.getMinutes().toString().padStart(2,'0') + ':' + hoy.getSeconds().toString().padStart(2,'0');
      let horaSalida = this.fillPapeletasalida.tHoraSalida.toString().substring(16, 25);
      let vHoraSalida = horaSalida.toString().substring(0, 2);
      let vMinSalida = horaSalida.toString().substring(3, 5);

      //var today  = new Date();
      /*       var vfecha = today.toLocaleDateString("es");
             var vfechaPapeleta = this.fillPapeletasalida.cFecha.toLocaleDateString("es") */

      var minHoraASctual = hoy.getHours() * 60 + hoy.getMinutes();

      var minutosHoraSalida = Number(vHoraSalida) * 60 + Number(vMinSalida);

      //  alert(minHoraASctual +' - '+ vMinSalida +' - '+ horaSalida)

      //alert(horaActual +' - ' + horaSalida  )
    },

    setResetCamposClientTemp() {
      var url = "/administracion/papeletasalida/CleanTempClient";
      axios.post(url).then((response) => {
        this.listTempClientPSalida = response.data.datos;
      });
    },

    getEliminarClientTemp(id) {
      var url = "/administracion/papeletasalida/EliminarClientTemp";
      axios
        .post(url, {
          id: id,
        })
        .then((response) => {
          this.listTempClientPSalida = response.data.datos;
        });
    },

    onChangeMotivo(event) {
      if (event == 3 || event == 2) {
        this.fillPapeletasalida.estadoContacto = false;
        this.fillPapeletasalida.estadoContacto = false;
        this.rpapeleta = "3";
      } else {
        this.fillPapeletasalida.estadoContacto = true;
        this.fillPapeletasalida.estadoContacto = true;
        this.rpapeleta = "680";
      }
    },

    setAddTempClient() {
      var url = "/administracion/papeletasalida/AddTempClient";
      axios
        .post(url, {
          nIdRuc: this.fillPapeletasalida.nIdRuc,
          cDireccion: this.fillPapeletasalida.cDireccion,
          cContacto: this.fillPapeletasalida.cContacto,
          rpapeleta: this.rpapeleta,
        })
        .then((response) => {
          this.listTempClientPSalida = response.data.datos;
          this.fillPapeletasalida.cDireccion = "";
          this.fillPapeletasalida.cContacto = "";
        });
    },

    setConfigTime() {
      this.fillPapeletasalida.tHoraSalida = new Date(2016, 9, 10, 8, 0);
      this.fillPapeletasalida.tHoraRetorno = new Date(2016, 9, 10, 17, 0);
    },

    getlistVendedorxUsu() {
      var url = "/administracion/papeletasalida/getListarCliente";
      axios
        .get(url, {
          params: {
            nIdVendedor: this.fillPapeletasalida.nIdUser,
          },
        })
        .then((response) => {
          this.listVendedorUser = response.data;
          this.fillPapeletasalida.nIdCliente = this.listVendedorUser[1].id;
        });
    },

    limpiarCriteriosBsq() {},
    setRegistrarPapeletaSalida() {
      if (this.validaPapeletaSalida()) {
        this.modalShow = true;
        return;
      }
      this.setGrabarPapeletaSalida();
    },

    setGrabarPapeletaSalida() {
      var url = "/administracion/papeletasalida/create";
      let today = new Date();
      const hora = today.toLocaleTimeString();
      const fecha = today.toLocaleDateString();
      axios
        .post(url, {
          nIdUser: this.fillPapeletasalida.nIdUser,
          cfecha: this.fillPapeletasalida.cFecha,
          tHoraSalida: this.fillPapeletasalida.tHoraSalida,
          tHoraRetorno: this.fillPapeletasalida.tHoraRetorno,
          nIdMotivo: this.fillPapeletasalida.nIdMotivo,
          cReferencia: this.fillPapeletasalida.cReferencia,
          listTempClientPSalida: this.listTempClientPSalida,
          rpapeleta: this.rpapeleta,
          hora,
          fecha,
        })
        .then((response) => {
          if (response.data.icon == "warning" || response.data.icon == "info") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 2500,
            });
          } else {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 2500,
            });
            this.setResetCampos();
            this.setResetCamposClientTemp();
          }
        });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },

    validaPapeletaSalida() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillPapeletasalida.cReferencia) {
        this.mensajeError.push("El Campo referencia es obligatorio");
      }

      if (!this.fillPapeletasalida.tHoraSalida) {
        this.mensajeError.push("La Hora de salida es obligatorio");
      }

      if (!this.fillPapeletasalida.tHoraRetorno) {
        this.mensajeError.push("La Hora de retorno es obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },

    setResetCampos() {
      this.fillPapeletasalida.cReferencia = "";
      this.fillPapeletasalida.nIdMotivo = "";
    },

    getListarMotivo() {
      var url = "/administracion/PapeletaSalida/Motivo";
      axios.get(url).then((response) => {
        this.listMotivo = response.data;
        this.fillPapeletasalida.nIdMotivo = this.listMotivo[4].id;
        this.fillPapeletasalida.estadoMotivo = false;
      });
    },
  },
};
</script>

<style></style>
