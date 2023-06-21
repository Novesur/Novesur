<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Orden de Compra</h1>
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
                <h3 class="card-title">Editar Orden de Compra</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >Proveedor</label
                          >
                          <div class="col-md-8">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillEditOrdenCompra.cProveedor"
                              @keypress.prevent.enter="setRegistrarPIngreso"
                              readonly
                            />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >Referencia</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillEditOrdenCompra.cReferencia"
                              readonly
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
                              v-model="fillEditOrdenCompra.cFechaEmision"
                              type="date"
                              placeholder="Ingrese una Fecha"
                              format="dd/MM/yyyy"
                              value-format="yyyy-MM-dd"
                              readonly
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
                              v-model="fillEditOrdenCompra.cFechaEntrega"
                              type="date"
                              placeholder="Ingrese una Fecha"
                              format="dd/MM/yyyy"
                              value-format="yyyy-MM-dd"
                              readonly
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
                            >Lugar de Entrega</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillEditOrdenCompra.cLEntrega"
                              @keypress.prevent.enter="setRegistrarPIngreso"

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
                              v-model="fillEditOrdenCompra.nIdTipoPago"
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
                              v-model="fillEditOrdenCompra.cObservacion"

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
                                    v-model="fillEditOrdenCompra.nIdprod"
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
                              <div class="form-group row">
                                <label class="col-md-1 col-form-label"
                                  >CANTIDAD</label
                                >
                                <div class="col-md-3">
                                  <input
                                    type="text"
                                    class="form-control"
                                    v-model="fillEditOrdenCompra.cCantidad"

                                  />
                                </div>

                                <label class="col-md-1 col-form-label"
                                  >MEDIDA</label
                                >
                                <div class="col-md-3">
                                  <el-select
                                    v-model="fillEditOrdenCompra.nIdUnidMed"
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
                                    v-model="fillEditOrdenCompra.cPrecio"
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
                      class="btn btn-flat btn-info justify-content-center "
                      @click.prevent="setAddProduct"
                    >
                      Agregar
                    </button>
                 <!--    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="setResetCampos"
                    >
                      Limpiar
                    </button> -->
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
                        <th>Precio</th>
                        <th>Unid. Medida</th>
                        <th>Descripcion</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(item, index) in listDetalleOrder"
                        :key="index"
                      >
                        <td v-text="item.producto.codigo"></td>
                        <td v-text="item.cantidad"></td>
                        <td v-text="item.punit"></td>
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
                          <button
                            class="btn btn-primary"
                            @click="setEditarPedido(item.id)"
                          >
                            <span><i class="far fa-edit"></i></span>
                            Editar
                          </button>
                          <button
                            class="btn btn-danger"
                            @click="DeleteItemDetalleOrdenCompra(item.id)"
                          >
                            <i class="fas fa-minus-circle"></i>
                            Eliminar
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
<!--
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setGrabarOrderCompra"
                    >
                      Editar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="eliminarTempitemOrders"
                    >
                      Limpiar
                    </button>
                  </div>
                </div>
              </div> -->
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

    <!-- MODAL DE EDITAR ITEMS -->

    <div
      class="modal fade"
      :class="{ show: modalShowEditItem }"
      :style="modalShowEditItem ? mostrarModal : ocultarModal"
    >
      <div class="modal-editcotitem modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Orden de Compra</h5>
            <button class="close" @click="abrirModalEditItem"></button>
          </div>
          <div class="modal-body">
            <div class="content container-fluid">
              <form role="form">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">CANTIDAD</label>
                      <div class="col-md-4">
                        <input
                          type="text"
                          class="form-control"

                          v-model="fillEditOrdenCompra.cCantidadEdit"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label">MEDIDA</label>
                      <div class="col-md-4">
                        <el-select
                          v-model="fillEditOrdenCompra.nIdUnidMedEdit"
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
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"
                        >DESCRIPCION DEL MEDIDOR</label
                      >

                      <div class="col-md-9">
                        <el-select
                          v-model="fillEditOrdenCompra.nIdprodEdit"
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

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">P/UNIT</label>
                      <div class="col-md-6">
                        <input
                          type="text"
                          class="form-control"
                          v-model="fillEditOrdenCompra.cPUnitEdit"
                          :onchange="this.setCalculaTotalEdit()"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label">TOTAL S/IGV</label>
                      <div class="col-md-4">
                        <input
                          type="text"
                          class="form-control"
                          v-model="fillEditOrdenCompra.cTotalEdit"
                          :readonly="true"
                          :onchange="this.setCalculaTotalEdit()"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" @click="abrirModalSaveItem">
              Guardar
            </button>
            <button class="btn btn-secondary" @click="abrirModalEditItem">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN DEL MODAL  -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillEditOrdenCompra: {
        nidOrdenCompra: this.$attrs.id,
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
        nIdTipoPago: "",
        nIdUser: sessionStorage.getItem("iduser"),
        cCantidadEdit: "",
        nIdUnidMedEdit: "",
        nIdprodEdit: "",
        cPUnitEdit: "",
        cTotalEdit: "",
        cObservacion: "",
      },

      listUnidMed: [],
      listProd: [],
      listartempOrder: [],
      listDetalleOrder: [],
      listDescripPago: [],

      modalShowEditItem: false,
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
    this.getCargaDatosOrdenCompra();
    this.getListarUnidadMedida();
    this.getListarproductosByName();
    this.getlistDescricionPago();

  },
  computed: {},
  methods: {
    setCalculaTotalEdit() {
      const a = parseFloat(this.fillEditOrdenCompra.cCantidadEdit);
      const b = parseFloat(this.fillEditOrdenCompra.cPUnitEdit);
      const c = a * b;
      this.fillEditOrdenCompra.cTotalEdit = parseFloat(c).toFixed(2);
    },

    setEditarPedido(item) {
      this.abrirModalEditItem();
      this.getCargaDetalleOrdenCompraEdit(item);
      localStorage.Codigo = item;
    },
    getCargaDetalleOrdenCompraEdit(item) {
      var url =
        "/administracion/DetalleordenCompra/CargaDetalleOrdenCompraEdit";
      axios
        .post(url, {
          item: item,
        })
        .then((response) => {
          this.fillEditOrdenCompra.cCantidadEdit = response.data.cantidad;
          this.fillEditOrdenCompra.nIdUnidMedEdit = response.data.unidmedida_id;
          this.fillEditOrdenCompra.nIdprodEdit = response.data.producto_id;
          this.fillEditOrdenCompra.cPUnitEdit = response.data.punit;

        });
    },

    abrirModalSaveItem(){
//alert(localStorage.Codigo,)

      var url = "/administracion/DetalleordenCompra/ModalSaveItemsDetalleOC";
      axios
        .post(url, {
          id: localStorage.Codigo,
            cCantidadEdit : this.fillEditOrdenCompra.cCantidadEdit ,
          nIdUnidMedEdit :this.fillEditOrdenCompra.nIdUnidMedEdit ,
          nIdprodEdit : this.fillEditOrdenCompra.nIdprodEdit ,
         cPUnitEdit : this.fillEditOrdenCompra.cPUnitEdit
        })
        .then((response) => {
            this.abrirModalEditItem();
          this.getListaDetalleOrdenCompra();

        });

    },

    getCargaDatosOrdenCompra() {
      var url = "/administracion/ordenCompra/CargaDatosOrdenCompra";
      axios
        .post(url, {
          nidOrdenCompra: this.fillEditOrdenCompra.nidOrdenCompra,
        })
        .then((response) => {
          this.fillEditOrdenCompra.cProveedor =
            response.data.ordencompras.proveedor.nombre;
          this.fillEditOrdenCompra.cReferencia =
            response.data.ordencompras.Referencia;
          this.fillEditOrdenCompra.cFechaEmision =
            response.data.ordencompras.Femision;
          this.fillEditOrdenCompra.cFechaEntrega =
            response.data.ordencompras.Fentrega;

          this.fillEditOrdenCompra.cLEntrega =
            response.data.ordencompras.LugarEntrega;
          this.fillEditOrdenCompra.nIdTipoPago =
            response.data.ordencompras.pago_id;
            this.fillEditOrdenCompra.cObservacion = response.data.ordencompras.observacion;

          this.getListaDetalleOrdenCompra();
        });
    },

    DeleteItemDetalleOrdenCompra(item) {
      var url =
        "/administracion/DetalleordenCompra/DeleteItemDetalleOrdenCompra";
      axios
        .post(url, {
          item: item,
        })
        .then((response) => {
          this.getListaDetalleOrdenCompra();
        });
    },

    getListaDetalleOrdenCompra() {
      var url = "/administracion/DetalleordenCompra/view";
      axios
        .get(url, {
          params: {
            item: this.fillEditOrdenCompra.nidOrdenCompra,
          },
        })
        .then((response) => {

          this.listDetalleOrder = response.data;
        });
    },

    getlistDescricionPago() {
      var url = "/administracion/pago/index";
      axios.get(url).then((response) => {
        this.listDescripPago = response.data;
      });
    },



    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillEditOrdenCompra.nIdprod,
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
        this.fillEditOrdenCompra.nIdUnidMed = this.listUnidMed[3].id;
      });
    },
    limpiarCriteriosBsq() {
      this.fillEditOrdenCompra.cProveedor = "";
    },
    setRegistrarPIngreso() {
      if (this.validaPIngreso()) {
        this.modalShow = true;
        return;
      }
      this.setAddProduct();
    },

    setGrabarOrderCompra() {
      var url = "/administracion/ordenCompra/setGrabarOrderCompra";
      axios
        .post(url, {
          cFechaEmision: this.fillEditOrdenCompra.cFechaEmision,
          cReferencia: this.fillEditOrdenCompra.cReferencia,
          nidOrdenCompra: this.fillEditOrdenCompra.nidOrdenCompra,
          cFechaEntrega: this.fillEditOrdenCompra.cFechaEntrega,
          cLEntrega: this.fillEditOrdenCompra.cLEntrega,
          nIdTipoPago: this.fillEditOrdenCompra.nIdTipoPago,
          nIdUser: this.fillEditOrdenCompra.nIdUser,


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
    abrirModalEditItem() {
      this.modalShowEditItem = !this.modalShowEditItem;
    },
    validaPIngreso() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillEditOrdenCompra.cProveedor) {
        this.mensajeError.push("El campo nombre es obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },
    setAddProduct() {
      var url = "/administracion/DetalleordenCompra/addOrdenEdit";
      axios
        .post(url, {
          nidOrdenCompra: this.fillEditOrdenCompra.nidOrdenCompra,
          nIdprod: this.fillEditOrdenCompra.nIdprod,
          cCantidad: this.fillEditOrdenCompra.cCantidad,
          nIdUnidMed: this.fillEditOrdenCompra.nIdUnidMed,
          cPrecio: this.fillEditOrdenCompra.cPrecio,
          CestadoDet: this.fillEditOrdenCompra.CestadoDet,
          cLEntrega: this.fillEditOrdenCompra.cLEntrega,
          nIdTipoPago: this.fillEditOrdenCompra.nIdTipoPago,
          cObservacion : this.fillEditOrdenCompra.cObservacion

        })
        .then((response) => {
          this.getListaDetalleOrdenCompra();
            Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Orden de compra editado',
            showConfirmButton: false,
            timer: 1500
            })
        });

        this.setLimpiaCampos()
    },

    setLimpiaCampos() {
      this.fillEditOrdenCompra.nIdprod = null;
      this.fillEditOrdenCompra.cCantidad = "";
      this.fillEditOrdenCompra.cPrecio = "";
    },

    setResetCampos() {
      this.fillEditOrdenCompra.nIdprod = null;
      this.fillEditOrdenCompra.cCantidad = "";
      this.fillEditOrdenCompra.cPrecio = "";
      this.fillEditOrdenCompra.cReferencia = "";
      this.fillEditOrdenCompra.cDocumento = "";
      this.fillEditOrdenCompra.cLEntrega = "";
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
