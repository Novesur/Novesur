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
            <router-link class="btn btn-info btn-sm" :to="'/material'">
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
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Proveedor</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearPIngreso.cProveedor"
                              @keypress.prevent.enter="setRegistrarPIngreso"
                              style="width: 300px"
                            />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Orden de Compra</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearPIngreso.cOrdenComPra"
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
                            >Documento</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearPIngreso.cDocumento"
                              @keypress.prevent.enter="setRegistrarPIngreso"
                              style="width: 300px"
                            />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Fecha</label>
                          <div class="col-md-9">
                            <el-date-picker
                              v-model="fillCrearPIngreso.cFecha"
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
                            >Nro Factura</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearPIngreso.cNumFactura"
                              @keypress.prevent.enter="setRegistrarPIngreso"
                              style="width: 300px"
                            />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Nro Guia</label
                          >
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearPIngreso.cNumGuia"
                              @keypress.prevent.enter="setRegistrarPIngreso"
                              style="width: 300px"
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
                                  >DESCRIPCION DEL MEDIDOR</label
                                >

                                <div class="col-md-10">
                                  <el-select
                                    v-model="fillCrearPIngreso.nIdprod"
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
                                    v-model="fillCrearPIngreso.cCantidad"
                                    v-int
                                  />
                                </div>

                                <label class="col-md-1 col-form-label"
                                  >MEDIDA</label
                                >
                                <div class="col-md-3">
                                  <el-select
                                    v-model="fillCrearPIngreso.nIdUnidMed"
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
                                    v-model="fillCrearPIngreso.cPrecio"
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
      fillCrearPIngreso: {
        nIdProveedor: this.$attrs.id,
        cProveedor: "",
        cOrdenComPra: "",
        cDocumento: "",
        cFecha: "",
        cNumFactura: "",
        cNumGuia: "",
        nIdUnidMed: "",
        nIdprod: "",
        cPrecio: "",
        cCantidad: "",
        nIdUser: sessionStorage.getItem("iduser"),
      },
      listUnidMed: [],
      listProd: [],
      listartempPIngreso: [],
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
    this.fillCrearPIngreso.cFecha = new Date();
  },
  computed: {},
  methods: {
    getListarByProveedor() {
      var url = "/administracion/proveedor/getListarProveedorById";
      axios
        .get(url, {
          params: {
            nIdProveedor: this.fillCrearPIngreso.nIdProveedor,
          },
        })
        .then((response) => {
          this.fillCrearPIngreso.cProveedor = response.data.nombre;
        });
    },

    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillCrearPIngreso.nIdprod,
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
        this.fillCrearPIngreso.nIdUnidMed = this.listUnidMed[0].id;
      });
    },
    limpiarCriteriosBsq() {
      this.fillCrearPIngreso.cProveedor = "";
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
          cFecha: this.fillCrearPIngreso.cFecha,
          cNumFactura: this.fillCrearPIngreso.cNumFactura,
          cNumGuia: this.fillCrearPIngreso.cNumGuia,
          nIdProveedor: this.fillCrearPIngreso.nIdProveedor,
          nIdUser: this.fillCrearPIngreso.nIdUser,
          nIdUnidMed: this.fillCrearPIngreso.nIdUnidMed,
          cCantidad: this.fillCrearPIngreso.cCantidad,
          cPrecio:this.fillCrearPIngreso.cPrecio,
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

      if (!this.fillCrearPIngreso.cProveedor) {
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
          nIdprod: this.fillCrearPIngreso.nIdprod,
          nIdUnidMed: this.fillCrearPIngreso.nIdUnidMed,
          cCantidad: this.fillCrearPIngreso.cCantidad,
          cPrecio: this.fillCrearPIngreso.cPrecio,
        })
        .then((response) => {
          if (response.data.icon == 'error') {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 1500,
            });
          }
          if (response.data.icon == 'success') {
            this.setListtempPIngreso();
            this.setLimpiaCampos();
          }
        });
    },

    setLimpiaCampos() {
      this.fillCrearPIngreso.nIdprod = null;
      this.fillCrearPIngreso.cCantidad = "";
      this.fillCrearPIngreso.cPrecio = "";
    },

    setResetCampos() {
      this.fillCrearPIngreso.nIdprod = null;
      this.fillCrearPIngreso.cCantidad = "";
      this.fillCrearPIngreso.cPrecio = "";
      this.fillCrearPIngreso.cOrdenComPra = "";
      this.fillCrearPIngreso.cDocumento = "";
      this.fillCrearPIngreso.cNumFactura = "";
      this.fillCrearPIngreso.cNumGuia = "";
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
