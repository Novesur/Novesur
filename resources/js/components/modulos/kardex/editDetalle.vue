<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Detalle de Kardex</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <button class="btn btn-info btn-sm" @click="$router.go(-1)">
              <i class="fas fa-undo-alt"> Regresar</i>
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="container-fluid">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Formulario de Detalle Kardex</h3>
            </div>
            <div class="card-body">
              <form role="form">
                <div class="row">
                  <div class="col-md-12">
                    <label class="col-md-2 col-form-label"
                      >Medidor de Agua</label
                    >
                    <div class="col-md-10">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqEditDetalleKardex.cMedidor"
                        :readonly="true"
                      />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <label class="col-md-3 col-form-label">Movimiento</label>
                    <div class="col-md-9">
                      <el-select
                        v-model="fillBsqEditDetalleKardex.nIdMovimiento"
                        placeholder="Select"
                        style="width: 100%"
                        @change="setSelectMovimiento"
                      >
                        <el-option
                          v-for="item in listMovimiento"
                          :key="item.id"
                          :label="item.nombre"
                          :value="item.id"
                        >
                        </el-option>
                      </el-select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <label class="col-md-3 col-form-label">Motivo</label>
                    <div class="col-md-9">
                      <el-select
                        v-model="fillBsqEditDetalleKardex.nIdMotivo"
                        placeholder="Select"
                        style="width: 100%"
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

                           <div class="col-md-4">
                    <label class="col-md-3 col-form-label">Clientes</label>
                    <div class="col-md-9">
                      <el-select
                        v-model="fillBsqEditDetalleKardex.nICliente"
                        placeholder="Select"
                        style="width: 100%"
                        :disabled="estadoProv"
                        :onchange="this.setSelectProveedor()"
                      >
                        <el-option
                          v-for="item in listCliente"
                          :key="item.id"
                          :label="item.razonsocial"
                          :value="item.id"

                        >
                        </el-option>
                      </el-select>
                    </div>
                  </div>


                </div>

                <div class="row">
                  <div class="col-md-4">
                    <label class="col-md-4 col-form-label">Fecha</label>
                    <div class="col-md-8">
                      <el-date-picker
                        v-model="fillBsqEditDetalleKardex.cFecha"
                        type="date"
                        placeholder="Ingrese una Fecha"
                        format="dd/MM/yyyy"
                        value-format="yyyy-MM-dd"
                      >
                        >
                      </el-date-picker>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <label class="col-md-4 col-form-label">Fact Nro</label>
                    <div class="col-md-8">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqEditDetalleKardex.cFacturaNro"
                      />
                    </div>
                  </div>

                  <div class="col-md-4">
                    <label class="col-md-4 col-form-label">Nro Guia</label>
                    <div class="col-md-8">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqEditDetalleKardex.cNroGuia"
                      />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <label class="col-md-5 col-form-label"
                      >Buscar por Ruc</label
                    >
                    <div class="col-md-7">
                      <div class="input-group">
                        <input
                          type="text"
                          class="form-control"
                          v-model="fillBsqEditDetalleKardex.cRuc"
                          v-int
                          :maxlength="11"
                          @keyup.enter="buscaProveedorXRuc"
                        />
                        <span class="input-group-btn">
                          <button
                            class="btn btn-info"
                            @click.prevent="buscaProveedorXRuc"
                            type="button"
                          >
                            <span class="fas fa-search"></span>
                          </button>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <label class="col-md-5 col-form-label"
                      >Proveedor/Referencia</label
                    >
                    <div class="col-md-9">
                      <el-select
                        v-model="fillBsqEditDetalleKardex.nIdProveedor"
                        filterable
                        placeholder="Select"
                        style="width: 100%"
                        :disabled="estadoProv"
                        :onchange="this.setSelectProveedor()"
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

                  <div class="col-md-4">
                    <label class="col-md-3 col-form-label">Unid. Medida</label>
                    <div class="col-md-9">
                      <el-select
                        v-model="fillBsqEditDetalleKardex.nIdUnidMed"
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
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <label class="col-md-3 col-form-label">Cantidad</label>
                    <div class="col-md-9">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqEditDetalleKardex.cCantidad"
                        v-on:keyup.enter="cCostUnitMoneda"
                        v-int
                      />
                    </div>
                  </div>

                  <div class="col-md-4">
                    <label class="col-md-3 col-form-label">C.U</label>
                    <div class="col-md-9">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqEditDetalleKardex.cCostUnit"
                        v-on:keyup.enter="cCostUnitMoneda"
                        :readonly="valorcu"
                      />
                    </div>
                  </div>

                  <div class="col-md-4">
                    <label class="col-md-3 col-form-label">Total</label>
                    <div class="col-md-9">
                      <input
                        id="stotal"
                        type="text"
                        class="form-control"
                        v-model="fillBsqEditDetalleKardex.cTotal"
                        :readonly="true"
                      />
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
                    @click.prevent="setRegistrarDetalleKardex"
                  >
                    Editar
                  </button>
                  <button
                    class="btn btn-flat btn-default btnWidth"
                    @click.prevent="limpiarDetalleKardexBsq"
                  >
                    Limpiar
                  </button>
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
      fillBsqEditDetalleKardex: {
        nidDetKardex: this.$attrs.id,
        cMedidor: "",
        cFecha: "",
        cFacturaNro: "",
        cNroGuia: "",
        cCantidad: "",
        cCostUnit: "",
        cTotal: "",
        cRuc: "",
        nIdMovimiento: "",
        nIdMotivo: "",
        nIdProveedor: "",
        nIdProduct: "",
        nIdUnidMed: "",
        nICliente:"",

      },

      valorcu: true,
      estadoProv: true,
      valorprov: 0,
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

      listMovimiento: [],
      listMotivo: [],
      listProveedor: [],
      listUnidMed: [],

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
      value1: "",
      value2: "",
      //// Fin del formato de la fecha
    };
  },
  mounted() {
    this.listenerEventBus();
    this.getListarKardex();
    this.getListarMovimiento();
    this.getListarMotivo();
    this.buscaProveedorXRuc();
    this.getListarUnidadMedida();
    this.getListarClientes();
  },

  methods: {
    listenerEventBus() {
      /* EventBus.$on('ProductKarvdex', data => {
            console.log('EditDetail', data);
        }) */

      this.fillBsqEditDetalleKardex.cMedidor = sessionStorage.getItem(
        "nproduct"
      );
    },

    getListarKardex() {
      var url = "/administracion/KardexDetalle/getListarEditXKardex";
      axios
        .get(url, {
          params: {
            nidDetKardex: this.fillBsqEditDetalleKardex.nidDetKardex,
          },
        })
        .then((response) => {
          this.fillBsqEditDetalleKardex.nIdMovimiento =
            response.data[0].movimiento.id;
          this.fillBsqEditDetalleKardex.nIdMotivo = response.data[0].motivo.id;
          this.fillBsqEditDetalleKardex.cFecha = response.data[0].fecha;
          this.fillBsqEditDetalleKardex.cFacturaNro = response.data[0].FactNo;
          this.fillBsqEditDetalleKardex.cNroGuia = response.data[0].GuiaNo;
          this.fillBsqEditDetalleKardex.nIdProveedor =
            response.data[0].proveedor.id;
          this.fillBsqEditDetalleKardex.nIdUnidMed =
            response.data[0].unidmedida.id;
          this.fillBsqEditDetalleKardex.cCantidad = response.data[0].cantidad;
          this.fillBsqEditDetalleKardex.cCostUnit = response.data[0].costunit;
          this.fillBsqEditDetalleKardex.cTotal =
            this.fillBsqEditDetalleKardex.cCantidad *
            this.fillBsqEditDetalleKardex.cCostUnit;
        });
    },

    abrirModal() {
      this.modalShow = !this.modalShow;
    },

          getListarClientes() {
      var url = "/administracion/cliente/getListarCliente";
      axios.get(url).then((response) => {
        this.listCliente = response.data;
      });
    },
    validarRegistarDetKardex() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillBsqEditDetalleKardex.nIdMovimiento) {
        this.mensajeError.push("Seleccione el tipo de Movimiento");
      }
      if (!this.fillBsqEditDetalleKardex.nIdMotivo) {
        this.mensajeError.push("Seleccione el Motivo");
      }
      if (!this.fillBsqEditDetalleKardex.cFecha) {
        this.mensajeError.push("Ingrese la Fecha");
      }
      if (!this.fillBsqEditDetalleKardex.nIdProveedor) {
        this.mensajeError.push("Seleccione el Proveedor");
      }
      if (!this.fillBsqEditDetalleKardex.nIdUnidMed) {
        this.mensajeError.push("Seleccione la Unidad de Medida");
      }
      if (!this.fillBsqEditDetalleKardex.cCantidad) {
        this.mensajeError.push("Ingrese la Cantidad");
      }
      if (!this.fillBsqEditDetalleKardex.cCostUnit) {
        this.mensajeError.push("Ingrese Costo unitario");
      }
      if (!this.fillBsqEditDetalleKardex.cTotal) {
        this.mensajeError.push("Campo Total vacio");
      }
      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },
    setRegistrarDetalleKardex() {
      if (this.validarRegistarDetKardex()) {
        this.modalShow = true;
        return;
      }
      this.setEditarDetalleKardex();
    },

    getDetalleKardeXId() {},

    cCostUnitMoneda() {
      this.fillBsqEditDetalleKardex.cCostUnit = this.convertMoney(
        this.fillBsqEditDetalleKardex.cCostUnit
      );
      this.fillBsqEditDetalleKardex.cTotal = this.convertMoney(
        this.fillBsqEditDetalleKardex.cCantidad *
          this.fillBsqEditDetalleKardex.cCostUnit.substring(2)
      );
    },

    convertMoney(value) {
      const formatterPeso = new Intl.NumberFormat("es-PE", {
        style: "currency",
        currency: "PEN",
        minimumFractionDigits: 2,
      });
      let valueFinal = formatterPeso.format(value);

      return valueFinal;
    },
    getListarMovimiento() {
      var url = "/administracion/KardexDetalle/listMovimiento";
      axios.get(url).then((response) => {
        this.listMovimiento = response.data;
      });
    },

    getListarMotivo() {
      var url = "/administracion/KardexDetalle/listMotivo";
      axios.get(url).then((response) => {
        this.listMotivo = response.data;
      });
    },

    getListarUnidadMedida() {
      var url = "/administracion/KardexDetalle/listUnidMed";
      axios.get(url).then((response) => {
        this.listUnidMed = response.data;
        this.fillBsqEditDetalleKardex.nIdUnidMed = this.listUnidMed[0].id;
      });
    },

    limpiarDetalleKardexBsq() {
      this.fillBsqEditDetalleKardex.cFecha = "";
      this.fillBsqEditDetalleKardex.cFacturaNro = "";
      this.fillBsqEditDetalleKardex.cNroGuia = "";
      this.fillBsqEditDetalleKardex.nIdProveedor = "";
      this.fillBsqEditDetalleKardex.nIdMotivo = "";
      this.fillBsqEditDetalleKardex.nIdUnidMed = "";
      this.fillBsqEditDetalleKardex.cCantidad = "";
      this.fillBsqEditDetalleKardex.cCostUnit = "";
      this.fillBsqEditDetalleKardex.nIdMovimiento = "";
      this.fillBsqEditDetalleKardex.cTotal = "";
      this.fillBsqEditDetalleKardex.cRuc = "";
    },

    buscaProveedorXRuc() {
      var url = "/administracion/proveedor/ListarProveedorByRuc";
      axios
        .get(url, {
          params: {
            cRuc: this.fillBsqEditDetalleKardex.cRuc,
          },
        })
        .then((response) => {
          this.listProveedor = response.data;
          this.fillBsqEditDetalleKardex.nIdProveedor = this.listProveedor[0].id;
        });
    },

    limpiarBandejaKardex() {
      this.listKardex = [];
    },
    setEditarDetalleKardex() {
      var url = "/administracion/KardexDetalle/setEditarDetalleKardex";
      axios
        .post(url, {
          nidDetKardex: this.fillBsqEditDetalleKardex.nidDetKardex,
          cFecha: this.fillBsqEditDetalleKardex.cFecha,
          cFacturaNro: this.fillBsqEditDetalleKardex.cFacturaNro,
          cNroGuia: this.fillBsqEditDetalleKardex.cNroGuia,
          nIdProveedor: this.fillBsqEditDetalleKardex.nIdProveedor,
          nIdMotivo: this.fillBsqEditDetalleKardex.nIdMotivo,
          nIdUnidMed: this.fillBsqEditDetalleKardex.nIdUnidMed,
          cCantidad: this.fillBsqEditDetalleKardex.cCantidad,
          cCostUnit: this.fillBsqEditDetalleKardex.cCostUnit
            .substring(0, 4)
            .trim(),
          nIdMovimiento: this.fillBsqEditDetalleKardex.nIdMovimiento,
          nICliente:this.fillBsqEditDetalleKardex.nICliente,
        })
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Se edito correctamente",
            showConfirmButton: false,
            timer: 1500,
          });
          localStorage.removeItem('nproduct');
          this.$router.push("/productos");
        })
        .catch(function (error) {
          console.log(error.message);
        });
    },

    setSelectMovimiento() {
      var url = "/administracion/KardexDetalle/KardexReporteData";
      axios
        .post(url, {
          nidDetKardex: this.fillBsqEditDetalleKardex.nidDetKardex,
        })
        .then((response) => {
          if (this.fillBsqEditDetalleKardex.nIdMovimiento == 2) {
            if (response.data.length == 0) {
              this.valorcu = true;
              this.fillBsqEditDetalleKardex.cCostUnit = "0.00";
            } else {
              this.valorcu = true;
              this.fillBsqEditDetalleKardex.cCostUnit =
                response.data[0].saldo_cantidadlast;
            }
          } else {
            this.valorcu = false;
            this.fillBsqEditDetalleKardex.cCostUnit = "";
          }
        });
    },
      setSelectProveedor() {
      if (this.fillBsqEditDetalleKardex.nIdMotivo == 4) {
        this.estadoProv = true;
      } else {
        this.estadoProv = false;
      }
    },
  },
};
</script>

<style>
</style>
