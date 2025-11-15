<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
              Editar Requerimientos de Materiales para servicio al Cliente
            </h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/servicio_ReqMateriales/list'">
              <i class="fas fa-arrow-left"></i>Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Requerimiento de Materiales</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Cliente</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" v-model="fillEditReqMaterialesServicio.cClient"
                              readonly="true" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">RUC o DNI </label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" v-model="fillEditReqMaterialesServicio.cRuc"
                              :maxlength="11" />
                          </div>
                          <div class="text-center">
                            <span style="color: red; text-align: end">{{
                              this.fillEditReqMaterialesServicio.cRuc.length +
                              " " +
                              "Caracteres"
                              }}</span>
                          </div>
                          <!--          <div class="col">
                          <span>
                            <button
                              class="btn btn-success btn-sm"
                              @click.prevent="consultaRuc"
                            >
                              <span><i class="fas fa-search"></i> Consultar Ruc</span>
                            </button></span
                          >

                          <span>
                            <button
                              class="btn btn-success btn-sm"
                              @click.prevent="consultaDNI"
                            >
                              <span><i class="fas fa-search"></i> Consultar DNI</span>
                            </button></span
                          >
                        </div> -->
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-9">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Detalle Servicio</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillEditReqMaterialesServicio.detservicio" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Fecha Inicio</label>
                          <div class="col-md-6">
                            <el-date-picker v-model="fillEditReqMaterialesServicio.FInicio" type="date"
                              placeholder="Indique la fecha" format="dd/MM/yyyy" value-format="yyyy-MM-dd">
                            </el-date-picker>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Fecha Final</label>
                            <div class="col-md-6">
                              <el-date-picker v-model="fillEditReqMaterialesServicio.FFinal" type="date"
                                placeholder="Indique la fecha" format="dd/MM/yyyy" value-format="yyyy-MM-dd"
                                @change="calculoFecha">
                              </el-date-picker>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Duracion (Días)</label>
                          <div class="col-md-3" v-if="calculoFechas != 'NaN'">
                            <input type="text" class="form-control" v-model="fillEditReqMaterialesServicio.cDuracion" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Cantidad</label>
                          <div class="col-md-3">
                            <input type="text" class="form-control" v-model="fillEditReqMaterialesServicio.cCantidad" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- INICIO  DE REQUERIMIENTOS DE MATERIALES -->

                  <div class="container-fluid">
                    <form role="form">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">REQUERIMIENTOS DE MATERIALES</h3>
                            </div>
                            <div class="card-body">
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label">DESCRIPCION DEL MATERIAL</label>

                                <div class="col-md-10">
                                  <el-select v-model="fillEditReqMaterialesServicio.nIdmaterial" style="width: 90%"
                                    filterable placeholder="Select">
                                    <v-row align="right">
                                      <el-option v-for="item in listProd" :key="item.id" :label="item.codigo +
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
                                        " :value="item.id">
                                      </el-option>
                                    </v-row>
                                  </el-select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label">CANTIDAD</label>
                                <div class="col-md-3">
                                  <input type="text" class="form-control"
                                    v-model="fillEditReqMaterialesServicio.cCantMaterial" />
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-md-4 col-form-label">MEDIDA</label>
                                  <div class="col-md-4">
                                    <el-select v-model="fillEditReqMaterialesServicio.nIdUnidMedMat
                                      " placeholder="Select" style="width: 70%">
                                      <el-option v-for="item in listUnidMed" :key="item.id" :label="item.nombre"
                                        :value="item.id">
                                      </el-option>
                                    </el-select>
                                  </div>
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
                    <button class="btn btn-flat btn-primary btnWidth" @click.prevent="setRegistrarServMaterialesList">
                      Agregar
                    </button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="setCleanReqMateriales">
                      Limpiar
                    </button>
                  </div>
                </div>
              </div>

              <!--  Bandeja de Resultados -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Bandeja de Resultados</h3>
                </div>

                <div class="card-body table-responsive">
                  <table class="table table-hover table-head-fixed text-nowrap projects">
                    <thead>
                      <tr>
                        <th>Codigo</th>
                        <th>Cantidad</th>
                        <th>Descripcion</th>
                        <th>Unid. Medida</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listServicioMateriales" :key="index">
                        <td v-text="item.producto.codigo"></td>
                        <td v-text="item.cantServicio"></td>

                        <td v-text="item.producto.familia.nombre +
                          ' ' +
                          item.producto.subfamilia.nombre +
                          ', MARCA :' +
                          item.producto.marca.nombre +
                          ', MODELO/TIPO :' +
                          item.producto.modelotipo.nombre +
                          ', MATERIAL :' +
                          item.producto.material.nombre
                          "></td>
                        <td v-text="item.unidmedida.nombre"></td>
                        <td>
                          <button class="btn btn-danger btn-sm" @click.prevent="DeletListReqMateriales(item.id)">
                            <i class="fas fa-trash-alt"></i>
                            Eliminar
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <!--         <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setGrabarReqMateriales"
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
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- FIN DE OTROS REQUERIMIENTOS -->

    <div class="modal fade" :class="{ show: modalShow }" :style="modalShow ? mostrarModal : ocultarModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Sistemas Novesur</h5>
            <button class="close" @click="abrirModal"></button>
          </div>
          <div class="modal-body">
            <div class="callout callout-danger" style="padding: 5px" v-for="(item, index) in mensajeError" :key="index"
              v-text="item"></div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" @click="abrirModal">Cerrar</button>
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
      fillEditReqMaterialesServicio: {
        nIdServicio: this.$attrs.id,
        cClient: "",
        FInicio: "",
        FFinal: "",
        cDuracion: "",
        nIdDetServ: "",
        cUnidMed: "",
        nIdUnidMedOtroReq: "",
        nIdPersonal: "",
        cRuc: "",
        cDocumento: "",
        cFechaEmision: "",
        nidAlmacen: "",
        cRSocial: "",
        cRuc: "",
        nIdmaterial: "",
        cCantMaterial: "",
        cCantidad: "",
        nIdTipoPago: "",
        nIdTipoMoneda: "",
        nIdUser: sessionStorage.getItem("iduser"),
        cPersonal: "",
        cDiasMObra: "",
        cHorasMObra: "",
        cDescripcion: "",
        cCantidadReq: "",
        nIdUnidMed: "",
        nIdUnidMedMat: "",
        radTipoTiempo: "1",
        estado: "",
      },

      listAlmacen: [],
      listPersonal: [],
      listUnidMed: [],
      listProd: [],
      listartempServicio: [],
      listartempMobra: [],
      listartempRequerimientos: [],
      listartempOtrosRequerimientos: [],
      listServicioMateriales: [],
      listDescripPago: [
        {
          value: "1",
          label: "PARA STOCK",
        },
        {
          value: "2",
          label: "PARA PEDIDO DE CLIENTE",
        },
      ],
      listTipoCambio: [],

      validatedDias: false,
      validateHoras: true,

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
    this.getListarproductosByName();
    this.getlistTipoCambio();
    this.defaultDiaHora();
    this.getListarUnidadMedida();
    this.getListServicioById();
    this.getListServicioMaterialesById();
  },

  methods: {
    getListServicioById() {
      var url = "/administracion/servicio/servicioById";
      axios
        .get(url, {
          params: {
            nIdServicio: this.fillEditReqMaterialesServicio.nIdServicio,
          },
        })
        .then((response) => {
          this.fillEditReqMaterialesServicio.cClient = response.data.cliente;
          this.fillEditReqMaterialesServicio.cRuc = response.data.ruc_dni;
          this.fillEditReqMaterialesServicio.detservicio = response.data.detservicio;
          this.fillEditReqMaterialesServicio.FInicio = response.data.fechainicio;
          this.fillEditReqMaterialesServicio.FFinal = response.data.fechafinal;
          this.fillEditReqMaterialesServicio.cDuracion = response.data.duracion;
          this.fillEditReqMaterialesServicio.cCantidad = response.data.cantidad;
        });
    },

    getListServicioMaterialesById() {
      var url = "/administracion/servicioReqMateriales/listMaterialById";
      axios
        .get(url, {
          params: {
            nIdServicio: this.fillEditReqMaterialesServicio.nIdServicio,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.listServicioMateriales = response.data;
        });
    },

    calculoFecha() {
      if (
        this.fillEditReqMaterialesServicio.FFinal != null &&
        this.fillEditReqMaterialesServicio.FInicio != null
      ) {
        let valorfecha =
          new Date(this.fillEditReqMaterialesServicio.FFinal).getTime() -
          new Date(this.fillEditReqMaterialesServicio.FInicio).getTime();
        this.fillEditReqMaterialesServicio.cDuracion = String(
          valorfecha / 86400000 + 1
        ).padStart(2, 0);
      }
    },
    onChange(e) {
      if (e == 1) {
        this.fillEditReqMaterialesServicio.cHorasMObra = 0;
        this.validateHoras = true;
        this.validatedDias = false;
      }
      if (e == 2) {
        this.fillEditReqMaterialesServicio.cDiasMObra = 0;
        this.validateHoras = false;
        this.validatedDias = true;
      }
    },

    onChangeClient(e) {
      if (e == 1) {
        this.fillEditReqMaterialesServicio.cRuc = "";
      }
      if (e == 2) {
        this.fillEditReqMaterialesServicio.nidAlmacen = "";
        this.fillEditReqMaterialesServicio.cRSocial = "";
      }
    },
    defaultDiaHora() {
      this.fillEditReqMaterialesServicio.cCantidadReq = 0;
      this.fillEditReqMaterialesServicio.cDiasMObra = 0;
      this.fillEditReqMaterialesServicio.cHorasMObra = 0;
    },

    consultaRuc() {
      var url = "/administracion/cliente/consultaRuc";
      axios
        .post(url, {
          cRuc: this.fillEditReqMaterialesServicio.cRuc,
        })
        .then((response) => {
          if (response.data.success == false) {
            (this.fillEditReqMaterialesServicio.cRSocial = ""),
              Swal.fire({
                position: "center",
                icon: "info",
                title: "Ruc no encontrado o numero equivocado",
                showConfirmButton: false,
                timer: 2000,
              });
          } else {
            this.fillEditReqMaterialesServicio.cClient = response.data.razonSocial;
            /*        (this.fillEditReqMaterialesServicio.cDireccion = response.data.direccion),
                          (this.estadobutton = false);
                        this.disabledbtnRuc = true; */
          }
        });
    },

    consultaDNI() {
      var url = "/administracion/cliente/consultaDNI";
      axios
        .post(url, {
          cRuc: this.fillEditReqMaterialesServicio.cRuc,
        })
        .then((response) => {
          if (response.data.success == false) {
            /*  this.estadobutton = true;
            (this.fillEditReqMaterialesServicio.cRSocial = ""),
              (this.fillEditReqMaterialesServicio.cDireccion = ""); */

            Swal.fire({
              position: "center",
              icon: "info",
              title: "DNI no encontrado o numero equivocado",
              showConfirmButton: false,
              timer: 2000,
            });
            this.estadobutton = false;
          } else {
            this.fillEditReqMaterialesServicio.cClient =
              response.data.nombres +
              " " +
              response.data.apellidoPaterno +
              " " +
              response.data.apellidoMaterno;
            // (this.fillEditReqMaterialesServicio.cClient  = response.data.direccion);
            /*     this.estadobutton = false;
            this.disabledbtnRuc = true;  */
          }
        });
    },

    setAddMObra() {
      var url = "/administracion/servicio/addServManObra";
      axios
        .post(url, {
          nIdPersonal: this.fillEditReqMaterialesServicio.nIdPersonal,
          cDiasMObra: this.fillEditReqMaterialesServicio.cDiasMObra,
          cHorasMObra: this.fillEditReqMaterialesServicio.cHorasMObra,
          estado: "S",
        })
        .then((response) => {
          this.listartempMobra = response.data.datos;
          this.setcleanListMObra();
          this.fillEditReqMaterialesServicio.cDiasMObra = 0;
          this.fillEditReqMaterialesServicio.cHorasMObra = 0;
        });
    },

    getListPersonal() {
      var url = "/administracion/personal/list";
      axios.get(url).then((response) => {
        this.listPersonal = response.data;
      });
    },

    setcleanListMObra() {
      (this.fillEditReqMaterialesServicio.cPersonal = ""),
        (this.fillEditReqMaterialesServicio.cDiasMObra = 0);
      this.fillEditReqMaterialesServicio.cHorasMObra = 0;
    },

    setOtrosRequerimientos() {
      var url = "/administracion/servicio/addOtrosServicios";
      axios
        .post(url, {
          cDescripcion: this.fillEditReqMaterialesServicio.cDescripcion,
          cCantidadReq: this.fillEditReqMaterialesServicio.cCantidadReq,
          nIdUnidMedOtroReq: this.fillEditReqMaterialesServicio.nIdUnidMedOtroReq,
          estado: "S",
        })
        .then((response) => {
          /*            if (
                        response.data.message ==
                        "El valor no puede ser cero ni vacio"
                    ) {
                        Swal.fire({
                            position: "center",
                            icon: response.data.icon,
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    } else {
                        this.listartempOtrosRequerimientos =
                            response.data.datos;
                        this.setLimpiaRequerimientos();
                        this.fillEditReqMaterialesServicio.cCantidadReq = 0;
                    } */

          this.listartempOtrosRequerimientos = response.data.datos;
          this.setLimpiaRequerimientos();
          this.fillEditReqMaterialesServicio.cCantidadReq = 0;
        });
    },

    setLimpiaRequerimientos() {
      (this.fillEditReqMaterialesServicio.cDescripcion = ""),
        (this.fillEditReqMaterialesServicio.cCantidadReq = 0);
    },

    DeletListReqMateriales(item) {
      var url = "/administracion/servicioReqMateriales/deleteItemMaterialById";
      axios
        .post(url, {
          item: item,
        })
        .then((response) => {
          this.getListServicioMaterialesById();
        });
    },

    DeletListReqMaNObra(item) {
      var url = "/administracion/servicio/reorderServicioManObra";
      axios
        .post(url, {
          item: item,
        })
        .then((response) => {
          this.listartempMobra = response.data.datos;
        });
    },

    DeletListOtrosReq(item) {
      var url = "/administracion/servicio/reorderOtrosReq";
      axios
        .post(url, {
          item: item,
        })
        .then((response) => {
          this.listartempOtrosRequerimientos = response.data.datos;
        });
    },

    getlistTipoCambio() {
      var url = "/administracion/ordenCompra/TipoCambio";
      axios.get(url).then((response) => {
        this.listTipoCambio = response.data;
        this.fillEditReqMaterialesServicio.nIdTipoMoneda = this.listTipoCambio[0].id;
      });
    },

    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdmaterial: this.fillEditReqMaterialesServicio.nIdmaterial,
          },
        })
        .then((response) => {
          this.listProd = response.data;
        });
    },

    limpiarCriteriosBsq() {
      this.fillEditReqMaterialesServicio.cCodProduct = "";
    },
    setRegistrarServicio() {
      if (this.validaOrdenProduccion()) {
        this.modalShow = true;
        return;
      }
      this.setGrabarReqMateriales();
    },

    setGrabarReqMateriales() {
      var url = "/administracion/servicio/create";
      axios
        .post(url, {
          nidAlmacen: this.fillEditReqMaterialesServicio.nidAlmacen,
          cRuc: this.fillEditReqMaterialesServicio.cRuc,
          FInicio: this.fillEditReqMaterialesServicio.FInicio,
          FFinal: this.fillEditReqMaterialesServicio.FFinal,
          nIdUser: this.fillEditReqMaterialesServicio.nIdUser,
          Duracionfechas: this.fillEditReqMaterialesServicio.cDuracion,
          nIdUnidMed: this.fillEditReqMaterialesServicio.nIdUnidMed,
          cClient: this.fillEditReqMaterialesServicio.cClient,
          detservicio: this.fillEditReqMaterialesServicio.detservicio,
          cCantidad: this.fillEditReqMaterialesServicio.cCantidad,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 1500,
          });
          this.setCleanServicios();
          this.setCleanReqMateriales();
          this.setCleanManoObra();
          this.setCleanOtrosReq();
        });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    validaOrdenProduccion() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillEditReqMaterialesServicio.FInicio) {
        this.mensajeError.push("Fecha Inicio es campo obligatorio");
      }

      if (!this.fillEditReqMaterialesServicio.FFinal) {
        this.mensajeError.push("Fecha Final es campo obligatorio");
      }

      if (!this.fillEditReqMaterialesServicio.cClient) {
        this.mensajeError.push("Cliente Campo Obligatorio");
      }

      if (!this.fillEditReqMaterialesServicio.detservicio) {
        this.mensajeError.push("Detalle Servicio Campo Obligatorio");
      }
      if (!this.fillEditReqMaterialesServicio.cCantidad) {
        this.mensajeError.push("Cantidad es obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },

    setRegistrarServMaterialesList() {
      if (this.setvalidarReqMateriales()) {
        this.modalShow = true;
        return;
      }
      this.setAddReqMaterial();
    },

    setvalidarReqMateriales() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillEditReqMaterialesServicio.nIdmaterial) {
        this.mensajeError.push("Campo Material de requerimientos Obligatorio");
      }

      if (!this.fillEditReqMaterialesServicio.cCantMaterial) {
        this.mensajeError.push("Campo Cantidad de requerimientos Obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },
    setAddReqMaterial() {
      var url = "/administracion/servicioReqMateriales/AddMaterialEdit";

      axios
        .post(url, {
          nIdServicio: this.fillEditReqMaterialesServicio.nIdServicio,
          nIdmaterial: this.fillEditReqMaterialesServicio.nIdmaterial,
          cCantMaterial: this.fillEditReqMaterialesServicio.cCantMaterial,
          nIdUnidMedMat: this.fillEditReqMaterialesServicio.nIdUnidMedMat,
          estado: "S",
        })
        .then((response) => {
          if (response.data.message == "Ya fue agregado anteriormente") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 1500,
            });
          } else {
            this.setLimpiaMaterial();
            this.fillEditReqMaterialesServicio.cCantMaterial = 0;
            this.getListServicioMaterialesById();
          }

          if (response.data.message == "El valor no puede ser cero") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 1500,
            });
          } else {
            this.setLimpiaMaterial();
            this.fillEditReqMaterialesServicio.cCantMaterial = 0;
            this.getListServicioMaterialesById();
          }
        });
    },

    setLimpiaMaterial() {
      (this.fillEditReqMaterialesServicio.nIdmaterial = ""),
        (this.fillEditReqMaterialesServicio.cCantMaterial = 0);
    },

    setLimpiaCampos() {
      this.fillEditReqMaterialesServicio.nIdmaterial = null;
      this.fillEditReqMaterialesServicio.cCantidad = 0;
    },

    setResetCampos() {
      this.fillEditReqMaterialesServicio.nIdmaterial = null;
      this.fillEditReqMaterialesServicio.cCantidad = 0;
      this.fillEditReqMaterialesServicio.cDocumento = "";
    },

    setCleanReqMateriales() {
      var url = "/administracion/ProyectoMateriales/eliminarTemporder";
      axios.get(url, {}).then((response) => {
        this.listartempServicio = response.data.datos;
        this.setLimpiaMaterial();
      });
    },

    setCleanManoObra() {
      var url = "/administracion/ProyectoManoObra/CleanProyectManObra";
      axios.get(url, {}).then((response) => {
        this.listartempMobra = response.data.datos;
        this.setcleanListMObra();
      });
    },

    setCleanOtrosReq() {
      var url = "/administracion/ProyectOtrosReq/CleanOtrosProyReqMateriales";
      axios.get(url, {}).then((response) => {
        this.listartempOtrosRequerimientos = response.data.datos;
        this.setcleanListMObra();
      });
    },

    setCleanServicios() {
      this.fillEditReqMaterialesServicio.cClient = "";
      this.fillEditReqMaterialesServicio.cRuc = "";
      this.fillEditReqMaterialesServicio.detservicio = "";
      this.fillEditReqMaterialesServicio.FInicio = "";
      this.fillEditReqMaterialesServicio.FFinal = "";
      this.fillEditReqMaterialesServicio.cDuracion = "";
    },

    setListtemOrders() {
      var url = "/administracion/ordenCompra/ListtempOrden";
      axios.get(url, {}).then((response) => {
        this.listartempServicio = response.data.datos;
      });
    },

    eliminarTempitemOrders() {
      var url = "/administracion/ordenCompra/eliminarTemporder";
      axios.post(url).then((response) => {
        this.setListtemOrders();
      });
    },
    getListarUnidadMedida() {
      var url = "/administracion/KardexDetalle/listUnidMed";
      axios.get(url).then((response) => {
        this.listUnidMed = response.data;
        this.fillEditReqMaterialesServicio.nIdUnidMed = this.listUnidMed[7].id;
        this.fillEditReqMaterialesServicio.nIdUnidMedMat = this.listUnidMed[7].id;
      });
    },
  },
  computed: {
    calculoFechas() {
      if (
        this.fillEditReqMaterialesServicio.FFinal != null &&
        this.fillEditReqMaterialesServicio.FInicio != null
      ) {
        let valorfecha =
          new Date(this.fillEditReqMaterialesServicio.FFinal).getTime() -
          new Date(this.fillEditReqMaterialesServicio.FInicio).getTime();
        return String(valorfecha / 86400000 + 1).padStart(2, 0);
      }
    },
  },
};
</script>

<style></style>
