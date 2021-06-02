<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Orden de Pedido</h1>
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
                <h3 class="card-title">Formulario Orden de Pedido</h3>
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
                              v-model="fillCrearOrden.cProveedor"
                              @keypress.prevent.enter="setRegistrarPIngreso"
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
                              v-model="fillCrearOrden.cReferencia"
                              @keypress.prevent.enter="setRegistrarPIngreso"
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
                              v-model="fillCrearOrden.cFechaEmision"
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
                              v-model="fillCrearOrden.cFechaEntrega"
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
                            >Observacion</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearOrden.cObservacion"
                              @keypress.prevent.enter="setRegistrarPIngreso"

                            />
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
                              v-model="fillCrearOrden.cLEntrega"
                              @keypress.prevent.enter="setRegistrarPIngreso"
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
                              v-model="fillCrearOrden.nIdDescripPago"
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
                                  >DESCRIPCION DEL MEDIDOR</label
                                >

                                <div class="col-md-10">
                                  <el-select
                                    v-model="fillCrearOrden.nIdprod"
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
                                    v-model="fillCrearOrden.cCantidad"
                                    v-int
                                  />
                                </div>

                                <label class="col-md-1 col-form-label"
                                  >MEDIDA</label
                                >
                                <div class="col-md-3">
                                  <el-select
                                    v-model="fillCrearOrden.nIdUnidMed"
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
                                    v-model="fillCrearOrden.cPrecio"
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
                      @click.prevent="setAddPMaterial"
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
                        <th>Unid. Medida</th>
                        <th>Descripcion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(item, index) in listartempPIngreso"
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
                      @click.prevent="setGrabarPIngreso"
                    >
                      Guardar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="eliminarTempitemPIngreso"
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
      fillCrearOrden: {
        nIdProveedor: this.$attrs.id,
        cProveedor: "",
        cReferencia: "",
        cDocumento: "",
        cFechaEntrega: "",
        cFechaEmision: "",
        cObservacion: "",
        cLEntrega: "",
        nIdUnidMed: "",
        nIdprod: "",
        cPrecio: "",
        cCantidad: "",
        nIdUser: sessionStorage.getItem("iduser"),
      },
      listUnidMed: [],
      listProd: [],
      listartempPIngreso: [],
       listDescripPago:[],
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
    this.setListtempPIngreso();
    this.getlistDescricionPago();
    this.fillCrearOrden.cFechaEntrega = new Date();
    this.fillCrearOrden.cFechaEmision = new Date();
  },
  computed: {},
  methods: {
    getListarByProveedor() {
      var url = "/administracion/proveedor/getListarProveedorById";
      axios
        .get(url, {
          params: {
            nIdProveedor: this.fillCrearOrden.nIdProveedor,
          },
        })
        .then((response) => {
          this.fillCrearOrden.cProveedor = response.data.nombre;
        });
    },

          getlistDescricionPago(){
     var url = "/administracion/pago/index";
      axios
        .get(url)
        .then((response) => {
          this.listDescripPago = response.data;
              this.fillCrearOrden.nIdDescripPago = this.listDescripPago[0].id;
        });
},

    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillCrearOrden.nIdprod,
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
        this.fillCrearOrden.nIdUnidMed = this.listUnidMed[0].id;
      });
    },
    limpiarCriteriosBsq() {
      this.fillCrearOrden.cProveedor = "";
    },
    setRegistrarPIngreso() {
      if (this.validaPIngreso()) {
        this.modalShow = true;
        return;
      }
      this.setAddPMaterial();
    },

    setGrabarPIngreso() {
      var url = "/administracion/parte_ingreso/setGrabarPIngreso";
      axios
        .post(url, {
          cFecha: this.fillCrearOrden.cFecha,
          cObservacion: this.fillCrearOrden.cObservacion,
          cLEntrega: this.fillCrearOrden.cLEntrega,
          nIdProveedor: this.fillCrearOrden.nIdProveedor,
          nIdUser: this.fillCrearOrden.nIdUser,
          nIdUnidMed: this.fillCrearOrden.nIdUnidMed,
          cCantidad: this.fillCrearOrden.cCantidad,
          cPrecio: this.fillCrearOrden.cPrecio,
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
          this.setLimpiaCampos();
          this.eliminarTempitemPIngreso();
        });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    validaPIngreso() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillCrearOrden.cProveedor) {
        this.mensajeError.push("El campo nombre es obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },
    setAddPMaterial() {
      var url = "/administracion/parte_ingreso/create";
      axios
        .post(url, {
          nIdprod: this.fillCrearOrden.nIdprod,
          nIdUnidMed: this.fillCrearOrden.nIdUnidMed,
          cCantidad: this.fillCrearOrden.cCantidad,
          cPrecio: this.fillCrearOrden.cPrecio,
        })
        .then((response) => {
          if (response.data.icon == "error") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 1500,
            });
          }
          if (response.data.icon == "success") {
            this.setListtempPIngreso();
            this.setLimpiaCampos();
          }
        });
    },

    setLimpiaCampos() {
      this.fillCrearOrden.nIdprod = null;
      this.fillCrearOrden.cCantidad = "";
      this.fillCrearOrden.cPrecio = "";
    },

    setResetCampos() {
      this.fillCrearOrden.nIdprod = null;
      this.fillCrearOrden.cCantidad = "";
      this.fillCrearOrden.cPrecio = "";
      this.fillCrearOrden.cReferencia = "";
      this.fillCrearOrden.cDocumento = "";
      this.fillCrearOrden.cObservacion = "";
      this.fillCrearOrden.cLEntrega = "";
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
  },
};
</script>

<style>
</style>
