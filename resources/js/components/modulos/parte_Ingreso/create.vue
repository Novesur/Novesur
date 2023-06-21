<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Parte de Ingreso</h1>
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
                <h3 class="card-title">Formulario Parte de Ingreso</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Proveedor</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillPIngreso.cProveedor"
                              @keypress.prevent.enter="setRegistrarPIngreso"
                              readonly="true"
                            />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Motivo</label>
                          <div class="col-md-10">
                            <el-select
                              v-model="fillPIngreso.nIdMotivo"
                              placeholder="Select"
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

                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >Orden de Compra</label
                          >
                          <div class="col-md-7">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillPIngreso.cOrdenComPra"
                              readonly="true"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Nro Factura</label
                          >
                          <div class="col-md-4">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillPIngreso.nroFactura"
                              @keypress.prevent.enter="setRegistrarPIngreso"
                              style="width: 300px"
                            />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >Nro Guia</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillPIngreso.cNroGuia"
                              @keypress.prevent.enter="setRegistrarPIngreso"
                              style="width: 300px"
                            />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Fecha</label>
                          <div class="col-md-9">
                            <el-date-picker
                              v-model="fillPIngreso.cFecha"
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
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-md-1 col-form-label"
                            >Observación</label
                          >
                          <div class="col-md-10">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillPIngreso.cObservacion"
                              @keypress.prevent.enter="setRegistrarPIngreso"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
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
                        <th>Estado</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(item, index) in listarDetalleOrdeCompra"
                        :key="index"
                      >
                        <td v-text="item.producto.codigo"></td>
                        <td v-text="item.cantidadKardex"></td>
                        <td v-text="item.unidmedida.nombre"></td>

                        <td
                          v-text="
                            item.producto.familia.nombre +
                            ' ' +
                            item.producto.subfamilia.nombre +
                            ', MARCA :' +
                            item.producto.marca.nombre +
                            ', MODELO/TIPO :' +
                            item.producto.modelotipo.nombre +
                            ', MATERIAL :' +
                            item.producto.material.nombre
                          "
                        ></td>
                        <td>
                          <template v-if="item.estado == '2'">
                            <button
                              class="btn btn-flat btn-danger btn-sm"
                              @click.prevent="
                                setCambiarEstadoDetalleOC(1, item.id)
                              "
                            >
                              <i class="far fa-bell-slash"></i> Pendiente
                            </button>

                            <!--    <button
                            class="btn btn-flat btn-primary btn-sm"
                            @click.prevent="
                              setCambiarEstadoDetalleOC(1, item.id)
                            "
                          >
                            <i class="far fa-edit"></i> Cantidad
                          </button> -->
                          </template>
                          <template v-else>
                            <button
                              class="btn btn-flat btn-success btn-sm"
                              @click.prevent="
                                setCambiarEstadoDetalleOC(2, item.id)
                              "
                            >
                              <i class="far fa-bell"></i> Atendido
                            </button>

                            <button
                              class="btn btn-flat btn-primary btn-sm"
                              @click.prevent="
                              setValorCantidadModal(item.id)
                              "
                            >
                              <i class="far fa-edit"></i> Cantidad
                            </button>
                          </template>
                        </td>

                        <!--  <td v-text="item.estado"></td> -->
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
                      @click.prevent="setRegistrarPIngreso"
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
            <button class="btn btn-secondary" @click="abrirModal">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
    <!--  Fin del  Modal de Validacion de campos -->

    <!-- Modal de editar cantidad de Parte de Ingreso -->
    <div
      class="modal fade"
      :class="{ show: modalCantidad }"
      :style="modalCantidad ? mostrarModal : ocultarModal"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ingrese la cantidad</h5>
            <button class="close" @click="abrirModal"></button>
          </div>
          <div class="modal-body">
          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillPIngreso.cCantidadModal"
                              style="width: 300px"
                            />
                          </div>
          </div>
          <div class="modal-footer">
               <button class="btn btn-primary" @click="setEditarCantidad()">
              Editar
            </button>
            <button class="btn btn-secondary" @click="abrirModalCantidad()">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!--Fin del  Modal de editar cantidad de Parte de Ingreso -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillPIngreso: {
        nIdOrdenCompra: this.$attrs.id,
        cProveedor: "",
        nIdProveedor: "",
        cOrdenComPra: "",
        cNroGuia: "",
        nroFactura: "",
        cFecha: "",
        cObservacion: "",
        nIdUser: sessionStorage.getItem("iduser"),
        nIdMotivo: "",
        cCantidadModal:"",

      },

      listarDetalleOrdeCompra: [],
      listMotivo: [],
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
    this.getListarByProveedor();
    this.setListarDatosOrdenCompraXId();
    this.setListarDetalleOrdenCompraxId();
    this.setSelectMovimiento();

    this.setListtempPIngreso();
    this.fillPIngreso.cFecha = new Date();
  },
  computed: {},
  methods: {
    getListarByProveedor() {
      var url = "/administracion/proveedor/getListarProveedorById";
      axios
        .get(url, {
          params: {
            nIdOrdenCompra: this.fillPIngreso.nIdOrdenCompra,
          },
        })
        .then((response) => {

          this.fillPIngreso.cProveedor = response.data.nombre;
        });
    },

    limpiarCriteriosBsq() {
      this.fillPIngreso.cProveedor = "";
    },
    setRegistrarPIngreso() {
      if (this.validaPIngreso()) {
        this.modalShow = true;
        return;
      }
      this.setGrabarPIngreso();
    },

    setListarDatosOrdenCompraXId() {
      var url = "/administracion/ordenCompra/ListarDatosOrdenCompraXId";
      axios
        .post(url, {
          nIdOrdenCompra: this.fillPIngreso.nIdOrdenCompra,
        })
        .then((response) => {
          (this.fillPIngreso.cProveedor = response.data.proveedor.nombre),
            (this.fillPIngreso.nIdProveedor = response.data.proveedor.id),
            (this.fillPIngreso.cOrdenComPra =
              this.fillPIngreso.nIdOrdenCompra.toString().padStart(3, "000") +
              "-" +
              response.data.Femision.substr(0, 4));
        });
    },

    setGrabarPIngreso() {
      var url = "/administracion/parte_ingreso/setGrabarPIngreso";
      axios
        .post(url, {
          nIdProveedor: this.fillPIngreso.nIdProveedor,
          nIdOrdenCompra: this.fillPIngreso.nIdOrdenCompra,
          nroFactura: this.fillPIngreso.nroFactura,
          nroguia: this.fillPIngreso.cNroGuia,
          cfecha: this.fillPIngreso.cFecha,
          cobservacion: this.fillPIngreso.cObservacion,
          nIdUser: this.fillPIngreso.nIdUser,
          nIdMotivo: this.fillPIngreso.nIdMotivo,
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
          /* this.setLimpiaCampos();
          this.eliminarTempitemPIngreso(); */
        });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },


    setValorCantidadModal(item){
         var url = "/administracion/DetalleordenCompra/setMandarValorDetalleParteIngresoXId";
      axios
        .post(url, {
          item: item,
        })
        .then((response) => {
            this.fillPIngreso.cCantidadModal = response.data.cantidadKardex
             sessionStorage.item = response.data.id;
             this.abrirModalCantidad();
        });
    },



    setEditarCantidad(){

   var url = "/administracion/DetalleordenCompra/setEditarCantidadParteIngre";
      axios
        .post(url, {
          item: sessionStorage.item,
          cCantidadModal : this.fillPIngreso.cCantidadModal
        })
        .then((response) => {
             this.abrirModalCantidad();
this.setListarDetalleOrdenCompraxId();
sessionStorage.removeItem(item)
    Swal.fire({
                position: "center",
                icon: response.icon,
                title: response.message,
                showConfirmButton: false,
                timer: 1500,
              });
        });

    },


      abrirModalCantidad() {
           this.modalCantidad = !this.modalCantidad
    },
    validaPIngreso() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillPIngreso.nroFactura) {
        this.mensajeError.push("El campo Factura es obligatorio");
      }
      if (!this.fillPIngreso.cNroGuia) {
        this.mensajeError.push("El campo Nro Guia es obligatorio");
      }

      if (!this.fillPIngreso.nIdMotivo) {
        this.mensajeError.push("El Campo Motivo es obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },

    setResetCampos() {
      this.fillPIngreso.nroFactura = "";
      this.fillPIngreso.cNroGuia = "";
      this.fillPIngreso.cObservacion = "";
      this.fillPIngreso.nIdMotivo = "";
    },

    setListtempPIngreso() {
      var url = "/administracion/parte_ingreso/ListtempParteIngreso";
      axios.get(url, {}).then((response) => {
        this.listartempPIngreso = response.data.datos;
      });
    },

    eliminarTempitemPIngreso() {
      var url = "/administracion/parte_ingreso/eliminarTempitemPIngreso";
      axios.post(url).then((response) => {
        this.setListtempPIngreso();
      });
    },

    setListarDetalleOrdenCompraxId() {
      var url = "/administracion/DetalleordenCompra/view";
      axios
        .get(url, {
          params: {
            item: this.fillPIngreso.nIdOrdenCompra,
          },
        })
        .then((response) => {
          this.listarDetalleOrdeCompra = response.data;
        });
    },
    setCambiarEstadoDetalleOC(op, id) {
      Swal.fire({
        title:
          "Estas seguro de" + (op == 2 ? "Poner Pendiente" : "Poner Atendido"),
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText:
          op == 2 ? "Si, Poner Pendiente" : "Si, Poner Atendido",
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/DetalleordenCompra/CambiarEstadoDetalleOC";
          axios
            .post(url, {
              nIdDetalleOC: id,
              cEstado: op,
            })
            .then((response) => {
              Swal.fire({
                position: "center",
                icon: "success",
                title: "Se edito el cambio",
                showConfirmButton: false,
                timer: 1500,
              });

              this.setListarDetalleOrdenCompraxId();
            });
        }
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
      this.fillPIngreso.nIdMotivo = "";
      this.getListarMotivo(1);
    },
  },
};
</script>

<style>
</style>
