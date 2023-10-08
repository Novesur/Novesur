<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="float-right">
        <router-link class="btn btn-info btn-sm" :to="'/cliente/index'">
          <i class="fas fa-angle-double-left"></i> Regresar
        </router-link>
      </div>
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Generar Cotizacion</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card-body">
        <form role="form">
          <div class="row">
            <!-- FORMULARIO CLIENTES  -->
            <div class="col-md-7">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">CLIENTES</h3>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label">SEÑORES</label>
                    <div class="col-md-8">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillregistrarCotizacion.cNomClient"
                        :readonly="true"
                      />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-2 col-form-label">DIRECCION</label>
                    <div class="col-md-10">
                      <input
                        type="text"
                        class="form-control"
                        :readonly="true"
                        v-model="fillregistrarCotizacion.cDirClient"
                      />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-2 col-form-label">RUC</label>
                    <div class="col-md-8">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillregistrarCotizacion.cRucClient"
                        :readonly="true"
                      />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-2 col-form-label">ATENCION</label>
                    <div class="col-md-8">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillregistrarCotizacion.cAtencion"
                        :readonly="true"
                      />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-2 col-form-label">TELEFONO</label>
                    <div class="col-md-8">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillregistrarCotizacion.cFonoClient"
                        :readonly="true"
                      />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-2 col-form-label">EMAIL</label>
                    <div class="col-md-8">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillregistrarCotizacion.cEmail"
                        :readonly="true"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- FIN DEL FORMULARIO CLIENTES  -->

            <!-- FORMULARIO VENDEDOR  -->
            <div class="col-md-5">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">VENDEDOR</h3>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">VENDEDOR</label>
                    <div class="col-md-9">
                      <input
                        type="text"
                        class="form-control"
                        :readonly="true"
                        v-model="fillregistrarCotizacion.cVendedor"
                      />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">CELULAR</label>
                    <div class="col-md-9">
                      <input
                        type="text"
                        class="form-control"
                        :readonly="true"
                        v-model="fillregistrarCotizacion.cCeluVendedor"
                      />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">CENTRAL</label>
                    <div class="col-md-9">
                      <input
                        type="text"
                        class="form-control"
                        :readonly="true"
                        v-model="fillregistrarCotizacion.cCentral"
                      />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">EMAIL</label>
                    <div class="col-md-9">
                      <input
                        type="text"
                        class="form-control"
                        :readonly="true"
                        v-model="fillregistrarCotizacion.cEmailVendedor"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- FIN DEL FORMULARIO VENDEDOR  -->

            <!-- CONDICIONES COMERCIALES -->
            <div class="content container-fluid">
              <form role="form">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">CONDICIONES COMERCIALES</h3>
                      </div>
                      <div class="card-body">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >VALIDEZ DE OFERTA</label
                          >
                          <div class="col-md-3">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillregistrarCotizacion.cValidez"
                            />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">ENTREGA</label>
                          <div class="col-md-8">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillregistrarCotizacion.cEntrega"
                            />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >TIPO DE PAGO</label
                          >
                          <div class="col-md-4">
                            <el-select
                              v-model="fillregistrarCotizacion.nIdTipoPago"
                              placeholder="Select"
                              style="width: 70%"
                            >
                              <el-option
                                v-for="item in listTipoPago"
                                :key="item.id"
                                :label="item.nombre"
                                :value="item.id"
                              >
                              </el-option>
                            </el-select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >DESCRIPCION DEL PAGO</label
                          >
                          <div class="col-md-4">
                            <el-select
                              v-model="fillregistrarCotizacion.nIdDescripPago"
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

                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">FLETE</label>
                          <div class="col-md-8">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillregistrarCotizacion.cFlete"
                              maxlength="20"
                            />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >DOCUMENTACION</label
                          >
                          <div class="col-md-8">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillregistrarCotizacion.Docu"
                            />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >GARANTIA</label
                          >
                          <div class="col-md-4">
                            <el-select
                              v-model="fillregistrarCotizacion.nIdGarantia"
                              placeholder="Select"
                              style="width: 70%"
                            >
                              <el-option
                                v-for="item in listGarantia"
                                :key="item.id"
                                :label="item.nombre"
                                :value="item.id"
                              >
                              </el-option>
                            </el-select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >OBSERVACIÓN</label
                          >
                          <div class="col-md-8">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillregistrarCotizacion.cObservacion"
                              :maxlength="255"
                            />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >PUNTO DE LLEGADA CONSIGNADO :</label
                          >
                          <div class="col-md-8">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillregistrarCotizacion.cPuntoLlegada"
                              :maxlength="100"
                            />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >EMP. DE TRANSPORTE</label
                          >
                          <div class="col-md-8">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillregistrarCotizacion.cTransporte"
                            />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >CONSIGNADO</label
                          >
                          <div class="col-md-8">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillregistrarCotizacion.Cconsignado"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <!-- FIN DE CONDICIONES COMERCIALES -->

            <!-- ITEMS DE PRODUCTOS -->
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
                          v-int
                          v-model="fillregistrarCotizacion.cCantidad"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label">MEDIDA</label>
                      <div class="col-md-4">
                        <el-select
                          v-model="fillregistrarCotizacion.nIdUnidMed"
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

                      <div class="col-md-10">
                        <el-select
                          v-model="fillregistrarCotizacion.nIdprod"
                          style="width: 90%"
                          filterable
                          placeholder="Select"
                          @change="setBuscaPrecioXProducto()"
                        >
                          <v-row align="right">
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
                          </v-row>
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
                          v-model="fillregistrarCotizacion.cPUnit"
                          :onchange="this.setCalculaTotal()"
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
                          v-model="fillregistrarCotizacion.cTotal"
                          :readonly="true"
                          :onchange="this.setCalculaTotal()"
                        />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-4 offset-4">
                      <button
                        class="btn btn-flat btn-info btnWidth"
                        @click.prevent="setRegistrarCotizacion"
                      >
                        Agregar
                      </button>
                      <button
                        class="btn btn-flat btn-default btnWidth"
                        @click.prevent="limpiarCotizacionBsq"
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
                          <th>ITEM</th>
                          <th>CANT</th>
                          <th>MEDIDA</th>
                          <th>CODIGO</th>
                          <th>DESCRIPCION DEL PRODUCTO</th>
                          <th>HOMOLOGADO</th>
                          <th>P/UNIT</th>
                          <th>TOTAL S/IGV</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(item, index) in listarProductosPaginated"
                          :key="index"
                        >
                          <td v-text="Number(index)"></td>
                          <td v-text="item.cantidad"></td>
                          <td v-text="item.unidmedNombre"></td>
                          <td v-text="item.codigo"></td>
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
                          <td v-text="item.homologacion"></td>
                          <td v-text="item.punit"></td>
                          <td v-text="item.total"></td>

                          <td>
                            <button
                              class="btn btn-info btn-sm"
                              @click.prevent="borradoItems(item.producto_id)"
                            >
                              Eliminar
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="card-footer">
                    <div class="row">
                      <div class="col-md-4 offset-4">
                        <button
                          class="btn btn-flat btn-info btnWidth"
                          @click.prevent="setGrabarCotizacion"
                        >
                          Guardar
                        </button>
                        <button
                          class="btn btn-flat btn-default btnWidth"
                          @click.prevent="eliminarTempitemCoti"
                        >
                          Limpiar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!--  FIN DE ITEMS DE PRODUCTOS -->
          </div>
        </form>
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
</template>
<script>
export default {
  data() {
    return {
      fillregistrarCotizacion: {
        nIdCliente: this.$attrs.id,
        nIdUsuario: "",
        nIdDescripPago: "",
        nIdGarantia: "",
        cNomClient: "",
        cDirClient: "",
        cRucClient: "",
        cAtencion: "",
        cFonoClient: "",
        cCantidad: "",
        cEmail: "",
        cVendedor: "",
        cEmailVendedor: "",
        cCeluVendedor: "",
        cCentral: "01-2822376",
        vidUSer: "",
        nIdUnidMed: "",
        nIdTipoPago: "",
        nIdprod: "",
        cPUnit: "",
        cValidez: "",
        cEntrega: "",
        cFPago: "",
        cFlete: "",
        Docu: "",
        cGarantia: "",
        cTotal: "",
        cEstado: "",
        cPuntoLlegada: "",
        cTransporte: "",
        Cconsignado: "",
        cObservacion: "",
        ctipoPrecio:"",
      },

      listUnidMed: [],
      listTipoPago: [],
      listProd: [],
      listDescripPago: [],
      listGarantia: [],
      listarProductosPaginated: [],


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
    this.getClienteById();
    this.getListarUnidadMedida();
    this.getListarproductosByName();
    this.getListarTipoPago();
    this.setListtempCotizacion();
    this.cargaDatosPredeterminados();
    this.getlistDescricionPago();
    this.getListGarantia();
  },

  methods: {
    getlistDescricionPago() {
      var url = "/administracion/pago/index";
      axios.get(url).then((response) => {
        this.listDescripPago = response.data;
        this.fillregistrarCotizacion.nIdDescripPago =
          this.listDescripPago[0].id;
      });
    },

    getListGarantia() {
      var url = "/administracion/garantia/index";
      axios.get(url).then((response) => {
        this.listGarantia = response.data;
        this.fillregistrarCotizacion.nIdGarantia = this.listGarantia[0].id;
      });
    },

    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    getClienteById() {
      var url = "/administracion/cliente/listClientesById";
      axios
        .get(url, {
          params: {
            nIdCliente: this.fillregistrarCotizacion.nIdCliente,
          },
        })
        .then((response) => {
          this.fillregistrarCotizacion.cNomClient = response.data.razonsocial;
          this.fillregistrarCotizacion.cDirClient = response.data.direccion;
          this.fillregistrarCotizacion.cRucClient = response.data.ruc;
          this.fillregistrarCotizacion.cAtencion = response.data.atencion;
          this.fillregistrarCotizacion.cFonoClient = response.data.telefono;
          this.fillregistrarCotizacion.cEmail = response.data.email;
          this.fillregistrarCotizacion.ctipoPrecio = response.data.tipoPrecio

          this.fillregistrarCotizacion.vidUSer = JSON.parse(
            sessionStorage.getItem("iduser")
          );
          this.getUsuarioById();
          //console.log(this.fillregistrarCotizacion.vidUSer);
        });
    },

    getUsuarioById() {
      var url = "/administracion/usuario/listUsuarioById";
      axios
        .get(url, {
          params: {
            nIdUsuario: this.fillregistrarCotizacion.vidUSer,
          },
        })
        .then((response) => {
          this.fillregistrarCotizacion.cVendedor = response.data.fullname;
          this.fillregistrarCotizacion.cEmailVendedor = response.data.email;
          this.fillregistrarCotizacion.cCeluVendedor = response.data.celular;
          //console.log(response.data);
        });
    },
    limpiarCotizacionBsq() {
      this.fillregistrarCotizacion.cEntrega = "";
      this.fillregistrarCotizacion.cValidez = "";
      this.fillregistrarCotizacion.cFPago = "";
      this.fillregistrarCotizacion.cFlete = "";
      this.fillregistrarCotizacion.Docu = "";
      this.fillregistrarCotizacion.cGarantia = "";
      this.fillregistrarCotizacion.cCantidad = "";
      this.fillregistrarCotizacion.cMedida = "";
      this.fillregistrarCotizacion.cDescripcion = "";
      this.fillregistrarCotizacion.cPUnit = "";
      this.fillregistrarCotizacion.cTotal = "";
    },

    getListarUnidadMedida() {
      var url = "/administracion/KardexDetalle/listUnidMed";
      axios.get(url).then((response) => {
        this.listUnidMed = response.data;
        this.fillregistrarCotizacion.nIdUnidMed = this.listUnidMed[7].id;
      });
    },

    getListarTipoPago() {
      var url = "/administracion/cotizacion/listTipoPago";
      axios.get(url).then((response) => {
        this.listTipoPago = response.data;
        this.fillregistrarCotizacion.nIdTipoPago = this.listTipoPago[0].id;
      });
    },

    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillregistrarCotizacion.nIdprod,
          },
        })
        .then((response) => {
          this.listProd = response.data;
        });
    },

    setRegistrarCotizacion() {
      if (this.validarCotizacion()) {
        this.modalShow = true;
        return;
      }
      this.setAddTempCotizacion();
    },

    validarCotizacion() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillregistrarCotizacion.cValidez) {
        this.mensajeError.push(
          "La validacion de Oferta es un campo obligatorio"
        );
      }
      if (!this.fillregistrarCotizacion.cEntrega) {
        this.mensajeError.push("El Campo Entrega es un campo obligatorio");
      }

      if (!this.fillregistrarCotizacion.cFlete) {
        this.mensajeError.push("El Campo Flete es un campo obligatorio");
      }
      if (!this.fillregistrarCotizacion.Docu) {
        this.mensajeError.push("El Campo Documento es un campo obligatorio");
      }

      if (!this.fillregistrarCotizacion.cCantidad) {
        this.mensajeError.push("El Campo Cantidad es un campo obligatorio");
      }

      if (!this.fillregistrarCotizacion.nIdUnidMed) {
        this.mensajeError.push("El Campo Medida es un campo obligatorio");
      }

      if (!this.fillregistrarCotizacion.nIdprod) {
        this.mensajeError.push("El Campo Medidor es un campo obligatorio");
      }

      if (!this.fillregistrarCotizacion.cPUnit) {
        this.mensajeError.push("El Campo P.Unit es un campo obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },

    setAddTempCotizacion() {
      var url = "/administracion/cotizacion/addTempCotizacion";
      axios
        .post(url, {
          cCantidad: this.fillregistrarCotizacion.cCantidad,
          nIdUnidMed: this.fillregistrarCotizacion.nIdUnidMed,
          nIdprod: this.fillregistrarCotizacion.nIdprod,
          cPUnit: this.fillregistrarCotizacion.cPUnit,
          cTotal: this.fillregistrarCotizacion.cTotal,
          nIdCliente: this.fillregistrarCotizacion.nIdCliente,

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
          } else {
            this.listarProductosPaginated = response.data.datos;
            this.limpiaItems();
          }

          /*          if (response.data.message == "Ya fue agregado anteriormente") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 1500,
            });
          } */
        });
    },
    setGrabarCotizacion() {
      var url = "/administracion/tempcotizacion/grabaCotizacion";
      axios
        .post(url, {
          nIdCliente: this.fillregistrarCotizacion.nIdCliente,
          nIdUsuario: this.fillregistrarCotizacion.vidUSer,
          cEstado: 3,
          cValidez: this.fillregistrarCotizacion.cValidez,
          cEntrega: this.fillregistrarCotizacion.cEntrega,
          nIdTipoPago: this.fillregistrarCotizacion.nIdTipoPago,
          nIdDescripPago: this.fillregistrarCotizacion.nIdDescripPago,
          cFPago: this.fillregistrarCotizacion.cFPago,
          cFlete: this.fillregistrarCotizacion.cFlete,
          Docu: this.fillregistrarCotizacion.Docu,
          nIdGarantia: this.fillregistrarCotizacion.nIdGarantia,
          cGarantia: this.fillregistrarCotizacion.cGarantia,
          cPuntoLlegada: this.fillregistrarCotizacion.cPuntoLlegada,
          cTransporte: this.fillregistrarCotizacion.cTransporte,
          Cconsignado: this.fillregistrarCotizacion.Cconsignado,
          cObservacion: this.fillregistrarCotizacion.cObservacion,
          listarProductosPaginated: this.listarProductosPaginated,
        })
        .then((response) => {
          if (response.data.icon == "warning") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 3000,
            });
          } else {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 3000,
            });
            this.eliminarTempitemCoti();
            this.fillregistrarCotizacion.nIdprod = "";
          }
        });
    },

    setListtempCotizacion() {
      var url = "/administracion/tempcotizacion/ListtempCotizacion";
      axios.get(url, {}).then((response) => {
        this.listarProductosPaginated = response.data.datos;
      });
    },
    eliminarTempitemCoti() {
      var url = "/administracion/tempcotizacion/eliminarTempitemCoti";
      axios.post(url).then((response) => {
        this.setListtempCotizacion();
      });
    },
    setCalculaTotal() {
      const a = parseFloat(this.fillregistrarCotizacion.cCantidad);
      const b = parseFloat(this.fillregistrarCotizacion.cPUnit);
      const c = a * b;
      this.fillregistrarCotizacion.cTotal = parseFloat(c).toFixed(2);
    },
    limpiaItems() {
      this.fillregistrarCotizacion.cCantidad = "";
      this.fillregistrarCotizacion.cMedida = "";
      this.fillregistrarCotizacion.cDescripcion = "";
      this.fillregistrarCotizacion.cPUnit = "";
      this.fillregistrarCotizacion.cTotal = "";
    },

    borradoItems(item) {
      var url = "/administracion/tempcotizacion/reorder";
      axios
        .post(url, {
          item: item,
        })
        .then((response) => {
          this.listarProductosPaginated = response.data.datos;
          // this.fillregistrarCotizacion.nIdprod = '';

          //console.log(item);
        });
    },

    cargaDatosPredeterminados() {
      this.fillregistrarCotizacion.cValidez = "15 días";
      this.fillregistrarCotizacion.Docu = "Factura, guía y carta de Garantía";
      this.fillregistrarCotizacion.cFlete = "NOVESUR";
    },

    setBuscaPrecioXProducto() {
      var url = "/administracion/producto/getListarProductoById";  
      axios
        .get(url, {
          params: {
            nIdProducto: this.fillregistrarCotizacion.nIdprod,
            nIdCliente: this.fillregistrarCotizacion.nIdCliente,
           
          },
        })
        .then((response) => {
      
          if(this.fillregistrarCotizacion.ctipoPrecio=='Lista'){
            this.fillregistrarCotizacion.cPUnit = response.data.precioSugerido;
          }else if(this.fillregistrarCotizacion.ctipoPrecio=='Distribuidor')
          this.fillregistrarCotizacion.cPUnit = response.data.precioDistribuidor;
        });
    },
  },
};
</script>
