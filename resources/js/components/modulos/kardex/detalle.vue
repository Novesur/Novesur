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
            <router-link class="btn btn-info btn-sm" :to="'/productos'">
              <i class="fas fa-arrow-left"></i>Regresar
            </router-link>
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
                  <div class="col-md-6">
                    <label class="col-md-3 col-form-label">Codigo</label>
                    <div class="col-md-6">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqDetalleKardex.cCodigo"
                        :readonly="true"
                      />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label class="col-md-3 col-form-label">Stock Actual</label>
                    <div class="col-md-6">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqDetalleKardex.stockAct"
                        :readonly="true"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label class="col-md-2 col-form-label"
                      >Medidor de Agua</label
                    >
                    <div class="col-md-10">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqDetalleKardex.cMedidor"
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
                        v-model="fillBsqDetalleKardex.nIdMovimiento"
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
                        v-model="fillBsqDetalleKardex.nIdMotivo"
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
                        v-model="fillBsqDetalleKardex.nICliente"
                        placeholder="Select"
                        style="width: 100%"
                        :disabled="estadoCliente"
                        filterable

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
                        v-model="fillBsqDetalleKardex.cFecha"
                        type="date"
                        placeholder="Ingrese una Fecha"
                        format="dd/MM/yyyy"
                        value-format="yyyy-MM-dd"
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
                        v-model="fillBsqDetalleKardex.cFacturaNro"
                      />
                    </div>
                  </div>

                  <div class="col-md-4">
                    <label class="col-md-4 col-form-label">Nro Guia</label>
                    <div class="col-md-8">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqDetalleKardex.cNroGuia"
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
                          v-model="fillBsqDetalleKardex.cRuc"
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
                        v-model="fillBsqDetalleKardex.nIdProveedor"
                        filterable
                        placeholder="Select"
                        style="width: 100%"
                        clearable
                        :disabled="estadoProv"

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
                        v-model="fillBsqDetalleKardex.nIdUnidMed"
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
                        v-model="fillBsqDetalleKardex.cCantidad"
                        :onchange="this.cCostUnitMoneda()"
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
                        v-model="fillBsqDetalleKardex.cCostUnit"
                        :onchange="this.cCostUnitMoneda()"
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
                        v-model="fillBsqDetalleKardex.cTotal"
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
                    Guardar
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
      fillBsqDetalleKardex: {
        nidKardex: this.$attrs.id,
        cCodigo: "",
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
        nIdUser: sessionStorage.getItem("iduser"),
        stockAct: "",
        nICliente: "",
      },

      valorcu: true,
      estadoProv: false,
      estadoCliente: false,
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
      listCliente: [],
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
    this.getListarKardex();
    this.getListarMovimiento();
    //this.getListarMotivo();
    this.buscaProveedorXRuc();
    this.getListarUnidadMedida();
    this.setRecuperaStockActual();
    this.getListarClientes();
  },

  methods: {
    valueDefault() {
      var url = "/administracion/kardex/getListarKardexByProduct";
      axios
        .get(url, {
          params: {
            nidKardex: this.fillBsqDetalleKardex.nidKardex,
          },
        })
        .then((response) => {
          this.listProduct = response.data;
          if (this.listProduct.length == 0) {
            this.fillBsqDetalleKardex.cStock = "0";
            this.fillBsqDetalleKardex.cCostUnit = "0.00";
          } else {
            this.fillBsqDetalleKardex.cStock = response.data.stock;
            this.fillBsqDetalleKardex.cCostUnit = this.convertMoney(
              response.data.costunit
            );
          }
        });
    },

    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    validarRegistarDetKardex() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillBsqDetalleKardex.nIdMovimiento) {
        this.mensajeError.push("Seleccione el tipo de Movimiento");
      }
      if (!this.fillBsqDetalleKardex.nIdMotivo) {
        this.mensajeError.push("Seleccione el Motivo");
      }
      if (!this.fillBsqDetalleKardex.cFecha) {
        this.mensajeError.push("Ingrese la Fecha");
      }
      /*    if (!this.fillBsqDetalleKardex.nIdProveedor) {
        this.mensajeError.push("Seleccione el Proveedor");
      } */
      if (!this.fillBsqDetalleKardex.nIdUnidMed) {
        this.mensajeError.push("Seleccione la Unidad de Medida");
      }
      if (!this.fillBsqDetalleKardex.cCantidad) {
        this.mensajeError.push("Ingrese la Cantidad");
      }
      if (!this.fillBsqDetalleKardex.cCostUnit) {
        this.mensajeError.push("Ingrese Costo unitario");
      }
      if (!this.fillBsqDetalleKardex.cTotal) {
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
      this.setGuardarDetalleKardex();
    },
    cCostUnitMoneda() {
      /*      this.fillBsqDetalleKardex.cCostUnit = this.convertMoney(
        this.fillBsqDetalleKardex.cCostUnit
      );
      this.fillBsqDetalleKardex.cTotal = this.convertMoney(
        this.fillBsqDetalleKardex.cCantidad *
          this.fillBsqDetalleKardex.cCostUnit.substring(2)
      ); */
      const a = this.fillBsqDetalleKardex.cCantidad;
      const b = this.fillBsqDetalleKardex.cCostUnit;
      const c = a * b;
      this.fillBsqDetalleKardex.cTotal = "S/." + parseFloat(c).toFixed(2);
    },

    /*     convertMoney(value) {
      const formatterPeso = new Intl.NumberFormat("es-PE", {
        style: "currency",
        currency: "PEN",
        minimumFractionDigits: 2,
      });
      let valueFinal = formatterPeso.format(value);

      return valueFinal;
    }, */

    getListarKardex() {
      var url = "/administracion/KardexDetalle/listKardexById";
      axios
        .get(url, {
          params: {
            nidKardex: this.fillBsqDetalleKardex.nidKardex,
          },
        })
        .then((response) => {
          this.fillBsqDetalleKardex.cCodigo = response.data.producto.codigo;
          this.fillBsqDetalleKardex.cMedidor =
            response.data.producto.familia.nombre +
            ", " +
            response.data.producto.subfamilia.nombre +
            " ,MODELO/TIPO :" +
            response.data.producto.modelotipo.nombre +
            " ,MATERIAL :" +
            response.data.producto.material.nombre +
            " ,MARCA :" +
            response.data.producto.marca.nombre;

          this.fillBsqDetalleKardex.nIdProduct = response.data.producto.id;
          this.fillBsqDetalleKardex.cFecha = new Date();
        });
    },

    getListarMovimiento() {
      var url = "/administracion/KardexDetalle/listMovimiento";
      axios.get(url).then((response) => {
        this.listMovimiento = response.data;


      });
    },

    getListarMotivo(idMovimiento) {
      var url = "/administracion/KardexDetalle/listMotivo";
      axios.get(url,{
          params:{
              idMovimiento : idMovimiento
          }
      }).then((response) => {
          this.listMotivo = [];
        this.listMotivo = response.data;
      });
    },

    getListarClientes() {
      var url = "/administracion/cliente/getListarAllCliente";
      axios.get(url).then((response) => {
        this.listCliente = response.data;
      });
    },

    /*     getListarProveedor() {
      var url = "/administracion/KardexDetalle/listProveedor";
      axios.get(url).then((response) => {
        this.listProveedor = response.data;
      });
    }, */

    getListarUnidadMedida() {
      var url = "/administracion/KardexDetalle/listUnidMed";
      axios.get(url).then((response) => {
        this.listUnidMed = response.data;
        this.fillBsqDetalleKardex.nIdUnidMed = this.listUnidMed[3].id;
      });
    },

    limpiarDetalleKardexBsq() {
      this.fillBsqDetalleKardex.cFecha = "";
      this.fillBsqDetalleKardex.cFacturaNro = "";
      this.fillBsqDetalleKardex.cNroGuia = "";
      this.fillBsqDetalleKardex.nIdProveedor = "";
      this.fillBsqDetalleKardex.nIdMotivo = "";
      this.fillBsqDetalleKardex.nIdUnidMed = "";
      //this.fillBsqDetalleKardex.cCantidad = "";
      this.fillBsqDetalleKardex.cCostUnit = "";
      this.fillBsqDetalleKardex.nIdMovimiento = "";
      this.fillBsqDetalleKardex.cTotal = "";
      this.fillBsqDetalleKardex.cRuc = "";
    },

    buscaProveedorXRuc() {
      var url = "/administracion/proveedor/ListarProveedorByRuc";
      axios
        .get(url, {
          params: {
            cRuc: this.fillBsqDetalleKardex.cRuc,
          },
        })
        .then((response) => {
          this.listProveedor = response.data;
          //this.fillBsqDetalleKardex.nIdProveedor = this.listProveedor[0].id;
        });
    },

    limpiarBandejaKardex() {
      this.listKardex = [];
    },
    setGuardarDetalleKardex() {
      var url = "/administracion/KardexDetalle/setRegistrarDetalleKardex";
      axios
        .post(url, {
          nidKardex: this.fillBsqDetalleKardex.nidKardex,
          cFecha: this.fillBsqDetalleKardex.cFecha,
          cFacturaNro: this.fillBsqDetalleKardex.cFacturaNro,
          cNroGuia: this.fillBsqDetalleKardex.cNroGuia,
          nIdProveedor: this.fillBsqDetalleKardex.nIdProveedor,
          nIdMotivo: this.fillBsqDetalleKardex.nIdMotivo,
          nIdUnidMed: this.fillBsqDetalleKardex.nIdUnidMed,
          cCantidad: this.fillBsqDetalleKardex.cCantidad,
          cCostUnit: this.fillBsqDetalleKardex.cCostUnit,
          nIdMovimiento: this.fillBsqDetalleKardex.nIdMovimiento,
          stockAct: this.fillBsqDetalleKardex.stockAct,
          nIdUser: this.fillBsqDetalleKardex.nIdUser,
          nIdProduct: this.fillBsqDetalleKardex.nIdProduct,
          nICliente: this.fillBsqDetalleKardex.nICliente,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 1500,
          });

          if ((response.data.message = "El stock actual es")) {
            this.fillBsqDetalleKardex.cTotal = "";
            //this.limpiarDetalleKardexBsq();
          } else {
            this.fillBsqDetalleKardex.stockAct = response.data.stock;
          }
          this.setRecuperaStockActual();
        })
        .catch(function (error) {
          console.log(error.message);
        });
    },

    setRecuperaStockActual() {
      var url = "/administracion/KardexDetalle/KardexReporteData";
      axios
        .post(url, {
          nidKardex: this.fillBsqDetalleKardex.nidKardex,
        })
        .then((response) => {
          if (response.data.length == 0) {
            this.fillBsqDetalleKardex.stockAct = "0";
          } else {
            this.fillBsqDetalleKardex.stockAct =
              response.data[0].stock_cantidad;
          }
        });
    },
    setSelectMovimiento() {
      var url = "/administracion/KardexDetalle/KardexReporteData";
      axios
        .post(url, {
          nidKardex: this.fillBsqDetalleKardex.nidKardex,
        })
        .then((response) => {
          if (this.fillBsqDetalleKardex.nIdMovimiento == 2) {
            if (response.data.length == 0) {
              this.valorcu = true;
              this.fillBsqDetalleKardex.cCostUnit = "0.00";
            } else {
              this.valorcu = true;
              this.fillBsqDetalleKardex.cCostUnit =
                response.data[0].saldo_cantidadlast;
            }
            this.fillBsqDetalleKardex.nIdMotivo = ''
            this.getListarMotivo(2)
            this.fillBsqDetalleKardex.nIdProveedor = this.listProveedor[18].id;
            this.estadoProv = true;
            this.estadoCliente = false;
            this.fillBsqDetalleKardex.nICliente =""


          } else {
            this.valorcu = false;
            this.fillBsqDetalleKardex.cCostUnit = "";
            this.fillBsqDetalleKardex.nIdMotivo = ''
            this.getListarMotivo(1)
 this.fillBsqDetalleKardex.nICliente = this.listCliente[201].id;
              this.estadoProv = false;
            this.estadoCliente = true;
            this.fillBsqDetalleKardex.nIdProveedor=""
          }
        });
    },

 /*    setSelectProveedor() {
      if (this.fillBsqDetalleKardex.nIdMotivo == 4) {
        this.estadoProv = true;
      } else {
        this.estadoProv = false;
      }
    }, */
  },
};
</script>

<style>
</style>
