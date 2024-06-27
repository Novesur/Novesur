<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Requerimientos de Materiales2</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <!--      <div class="card-header">
                    <div class="card-tools">
                        <router-link class="btn btn-info btn-sm" :to="'/proveedor'">
                            <i class="fas fa-arrow-left"></i>Regresar
                        </router-link>
                    </div>
                </div> -->
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
                      <div class="col-md-9">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Producto</label>
                          <div class="col-md-10">
                            <el-select
                              v-model="fillCrearReqMateriales.nIdproduct"
                              style="width: 800px"
                              filterable
                              placeholder="Select"
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
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Cantidad</label>
                          <div class="col-md-3">
                            <input
                              type="text"
                              class="form-control"
                              v-int
                              v-model="fillCrearReqMateriales.cCantprod"
                            />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Unid. Medida</label>
                          <div class="col-md-6">
                            <el-select
                              v-model="fillCrearReqMateriales.nIdUnidMed"
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
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Cliente-Ref</label>
                          <div class="col-md-6">
                            <el-select
                              v-model="fillCrearReqMateriales.nIdTipoPago"
                              placeholder="Select"
                              style="width: 70%"
                              @change="onChangeClient($event)"
                            >
                              <el-option
                                v-for="item in listDescripPago"
                                :key="item.id"
                                :label="item.label"
                                :value="item.value"
                              >
                              </el-option>
                            </el-select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div v-if="fillCrearReqMateriales.nIdTipoPago == 1" class="col-md-9">
                    <div class="col-md-8">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Para Stock</label>
                        <div class="col-md-9">
                          <el-select
                            v-model="fillCrearReqMateriales.nidAlmacen"
                            style="width: 90%"
                            filterable
                            placeholder="Select"
                          >
                            <el-option
                              v-for="item in listAlmacen"
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

                  <div v-if="fillCrearReqMateriales.nIdTipoPago == 2" class="col-md-12">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Busqueda de Clientes</label
                        >
                        <div class="col-md-9">
                          <div class="input-group">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearReqMateriales.cRuc"
                            />
                            <div class="col">
                              <span
                                ><button
                                  class="btn btn-success btn-sm"
                                  @click.prevent="consultaRuc"
                                >
                                  Buscar Por Ruc
                                </button></span
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Empresa</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearReqMateriales.cRSocial"
                            :disabled="true"
                          />
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
                            <el-date-picker
                              v-model="fillCrearReqMateriales.FInicio"
                              type="date"
                              placeholder="Indique la fecha"
                              format="dd/MM/yyyy"
                              value-format="yyyy-MM-dd"
                            >
                            </el-date-picker>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Fecha Final</label>
                            <div class="col-md-6">
                              <el-date-picker
                                v-model="fillCrearReqMateriales.FFinal"
                                type="date"
                                placeholder="Indique la fecha"
                                format="dd/MM/yyyy"
                                value-format="yyyy-MM-dd"
                                @change="calculoFecha"
                              >
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
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearReqMateriales.cDuracion"
                            />
                          </div>
                          <!--     <div class="col-md-3">
                            <p v-if="calculoFechas">
                              {{ String(calculoFechas).padStart(2, 0) }} Día(s)
                            </p>
                          </div>  -->
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-9">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Referencia</label>
                          <div class="col-md-9">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearReqMateriales.cReferencia"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>



                  <div class="col-md-12">
                    <div class="row">
                  <div class="col-md-9">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >Zona de Producción</label
                          >
                          <div class="col-md-6">
                            <el-select
                              v-model="fillCrearReqMateriales.nIdZonaProduccion"
                              placeholder="Select"
                              style="width: 70%"
                            >
                              <el-option
                                v-for="item in listZonaProduccion"
                                :key="item.id"
                                :label="item.nombre"
                                :value="item.id"
                              >
                              </el-option>
                            </el-select>
                          </div>
                        </div>
                      </div>
                    </div></div>

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
                                <label class="col-md-2 col-form-label"
                                  >DESCRIPCION DEL MATERIAL</label
                                >

                                <div class="col-md-10">
                                  <el-select
                                    v-model="fillCrearReqMateriales.nIdmaterial"
                                    style="width: 90%"
                                    filterable
                                    placeholder="Select"
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
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label">CANTIDAD</label>
                                <div class="col-md-3">
                                  <input
                                    type="text"
                                    class="form-control"
                                    v-model="fillCrearReqMateriales.cCantMaterial"
                                  />
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-md-4 col-form-label">MEDIDA</label>
                                  <div class="col-md-4">
                                    <el-select
                                      v-model="fillCrearReqMateriales.nIdUnidMedMat"
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
                      class="btn btn-flat btn-primary btnWidth"
                      @click.prevent="setAddReqMaterial"
                    >
                      Agregar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="setCleanMaterial"
                    >
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
                      <tr v-for="(item, index) in listartempProduccion" :key="index">
                        <td v-text="item.codigo"></td>
                        <td v-text="item.cantidad"></td>

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
                        <td v-text="item.unidMedida"></td>
                        <td>
                          <button
                            class="btn btn-danger btn-sm"
                            @click.prevent="DeletListReqMateriales(item.producto_id)"
                          >
                            <i class="fas fa-trash-alt"></i> Eliminar
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

      <!-- FIN   DE REQUERIMIENTOS DE MATERIALES -->

      <!-- INICIO DE REQUERIMIENTOS MANO DE OBRA -->
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">
                  REQUERIMIENTOS MANO DE OBRA (DIAS, HORAS, HOMBRES)
                </h3>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-md-2 col-form-label">PERSONAL</label>

                  <div class="col-md-6">
                    <input
                      type="text"
                      class="form-control"
                      v-model="fillCrearReqMateriales.cPersonal"
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 col-form-label"></label>
                  <div class="col-md-6">
                    <el-radio
                      v-model="fillCrearReqMateriales.radTipoTiempo"
                      @change="onChange($event)"
                      label="1"
                      checked
                      >POR DIAS
                    </el-radio>
                    <el-radio
                      v-model="fillCrearReqMateriales.radTipoTiempo"
                      @change="onChange($event)"
                      label="2"
                      >POR HORAS
                    </el-radio>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 col-form-label">DIAS</label>
                  <div class="col-md-2">
                    <input
                      type="text"
                      class="form-control"
                      :disabled="validatedDias"
                      v-model="fillCrearReqMateriales.cDiasMObra"
                      v-int
                    />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 col-form-label">HORAS</label>
                  <div class="col-md-2">
                    <input
                      type="text"
                      class="form-control"
                      :disabled="validateHoras"
                      v-model="fillCrearReqMateriales.cHorasMObra"
                      v-int
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-md-4 offset-4">
              <button
                class="btn btn-flat btn-success btnWidth"
                @click.prevent="setAddMObra"
              >
                Agregar
              </button>
              <button
                class="btn btn-flat btn-default btnWidth"
                @click.prevent="setCleanManoObra"
              >
                Limpiar
              </button>
            </div>
          </div>
        </div>

        <!--  Bandeja de Resultados -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Bandeja de Resultados</h3>
          </div>

          <div class="card-body table-responsive">
            <table class="table table-hover table-head-fixed text-nowrap projects">
              <thead>
                <tr>
                  <th>Personal</th>
                  <th>Días</th>
                  <th>Horas</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in listartempMobra" :key="index">
                  <td v-text="item.personal"></td>
                  <td v-text="item.dias"></td>
                  <td v-text="item.horas"></td>
                  <td>
                    <button
                      class="btn btn-danger btn-sm"
                      @click.prevent="DeletListReqMaNObra(item.personal)"
                    >
                      <i class="fas fa-trash-alt"></i> Eliminar
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- FIN DE REQUERIMIENTOS MANO DE OBRA -->

      <!-- INICIO DE OTROS REQUERIMIENTOS -->

      <div class="container-fluid">
        <div class="card card-primary">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header" style="background-color: #9b59b6; color: white">
                <h3 class="card-title">OTROS REQUERIMIENTOS</h3>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-md-2 col-form-label">DESCRIPCION</label>

                  <div class="col-md-10">
                    <input
                      type="text"
                      class="form-control"
                      v-model="fillCrearReqMateriales.cDescripcion"
                    />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 col-form-label">CANTIDAD</label>
                  <div class="col-md-2">
                    <input
                      type="text"
                      class="form-control"
                      v-model="fillCrearReqMateriales.cCantidadReq"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-md-4 offset-4">
              <button
                class="btn btn-flat btnWidth"
                style="background-color: #9b59b6; color: white"
                @click.prevent="setAddRequerimientos"
              >
                Agregar
              </button>
              <button
                class="btn btn-flat btn-default btnWidth"
                @click.prevent="setCleanRequerimientos"
              >
                Limpiar
              </button>
            </div>
          </div>
        </div>

        <!--  Bandeja de Resultados -->
        <div class="card card-light">
          <div class="card-header" style="background-color: #9b59b6; color: white">
            <h3 class="card-title">Bandeja de Resultados</h3>
          </div>

          <div class="card-body table-responsive">
            <table class="table table-hover table-head-fixed text-nowrap projects">
              <thead>
                <tr>
                  <th>Descripción</th>
                  <th>Cantidad</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in listartempRequerimientos" :key="index">
                  <td v-text="item.descripcion"></td>
                  <td v-text="item.cantidad"></td>
                  <td>
                    <button
                      class="btn btn-danger btn-sm"
                      @click.prevent="DeletListOtrosReq(item.descripcion)"
                    >
                      <i class="fas fa-trash-alt"></i> Eliminar
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
                @click.prevent="setRegistrarReqMateriales"
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
        </div>
      </div>
    </div>

    <!-- FIN DE OTROS REQUERIMIENTOS -->

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
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillCrearReqMateriales: {
        nIdProveedor: this.$attrs.id,
        nIdproduct: "",
        cReferencia: "",
        cDocumento: "",
        cFechaEmision: "",
        nidAlmacen: "",
        cRSocial: "",
        cRuc: "",
        nIdmaterial: "",
        cCantMaterial: "",
        cCantidad: "",
        cCantprod: "",
        nIdTipoPago: "",
        nIdTipoMoneda: "",
        nIdUser: sessionStorage.getItem("iduser"),
        FInicio: "",
        FFinal: "",
        cDuracion: "",
        cPersonal: "",
        cDiasMObra: "",
        cHorasMObra: "",
        cDescripcion: "",
        cCantidadReq: "",
        nIdUnidMed: "",
        nIdUnidMedMat: "",
        radTipoTiempo: "1",
        nIdZonaProduccion: "",
        estado: "",
      },
      listAlmacen: [],
      listUnidMed: [],
      listProd: [],
      listartempProduccion: [],
      listartempMobra: [],
      listartempRequerimientos: [],
      listZonaProduccion: [],
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
    this.getListarByProveedor();
    this.getListarproductosByName();
    this.getlistTipoCambio();
    this.defaultDiaHora();
    this.getListarUnidadMedida();
    this.getListarAlmacen();
    this.getListarZonaProduccion();
  },

  methods: {
    calculoFecha() {
      if (
        this.fillCrearReqMateriales.FFinal != null &&
        this.fillCrearReqMateriales.FInicio != null
      ) {
        let valorfecha =
          new Date(this.fillCrearReqMateriales.FFinal).getTime() -
          new Date(this.fillCrearReqMateriales.FInicio).getTime();
        this.fillCrearReqMateriales.cDuracion = String(
          valorfecha / 86400000 + 1
        ).padStart(2, 0);
      }
    },
    onChange(e) {
      if (e == 1) {
        this.fillCrearReqMateriales.cHorasMObra = 0;
        this.validateHoras = true;
        this.validatedDias = false;
      }
      if (e == 2) {
        this.fillCrearReqMateriales.cDiasMObra = 0;
        this.validateHoras = false;
        this.validatedDias = true;
      }
    },

    onChangeClient(e) {
      if (e == 1) {
        this.fillCrearReqMateriales.cRuc = "";
      }
      if (e == 2) {
        this.fillCrearReqMateriales.nidAlmacen = "";
        this.fillCrearReqMateriales.cRSocial = "";
      }
    },
    defaultDiaHora() {
      this.fillCrearReqMateriales.cCantidadReq = 0;
      this.fillCrearReqMateriales.cDiasMObra = 0;
      this.fillCrearReqMateriales.cHorasMObra = 0;
    },

    getListarZonaProduccion() {
      var url = "/administracion/ZonaProduccion/list";
      axios.get(url).then((response) => {
        this.listZonaProduccion = response.data;
      });
    },

    consultaRuc() {
      var url = "/administracion/cliente/consultaRuc";
      axios
        .post(url, {
          cRuc: this.fillCrearReqMateriales.cRuc,
        })
        .then((response) => {
          if (response.data.success == false) {
            (this.fillCrearReqMateriales.cRSocial = ""),
              Swal.fire({
                position: "center",
                icon: "info",
                title: "Ruc no encontrado o numero equivocado",
                showConfirmButton: false,
                timer: 2000,
              });
          } else {
            this.fillCrearReqMateriales.cRSocial = response.data.razonSocial;
            /*        (this.fillRegistrarCliente.cDireccion = response.data.direccion),
                          (this.estadobutton = false);
                        this.disabledbtnRuc = true; */
          }
        });
    },

    setAddMObra() {
      var url = "/administracion/RequerimientoMateriales/addMObra";
      axios
        .post(url, {
          cPersonal: this.fillCrearReqMateriales.cPersonal,
          cDiasMObra: this.fillCrearReqMateriales.cDiasMObra,
          cHorasMObra: this.fillCrearReqMateriales.cHorasMObra,
          estado: "R",
        })
        .then((response) => {
          this.listartempMobra = response.data.datos;
          this.setcleanListMObra();
          this.fillCrearReqMateriales.cDiasMObra = 0;
          this.fillCrearReqMateriales.cHorasMObra = 0;
        });
    },

    setcleanListMObra() {
      (this.fillCrearReqMateriales.cPersonal = ""),
        (this.fillCrearReqMateriales.cDiasMObra = 0);
      this.fillCrearReqMateriales.cHorasMObra = 0;
    },

    setAddRequerimientos() {
      var url = "/administracion/RequerimientoMateriales/addRequerimientos";
      axios
        .post(url, {
          cDescripcion: this.fillCrearReqMateriales.cDescripcion,
          cCantidadReq: this.fillCrearReqMateriales.cCantidadReq,
          estado: "R",
        })
        .then((response) => {
          if (response.data.message == "El valor no puede ser cero ni vacio") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 1500,
            });
          } else {
            this.listartempRequerimientos = response.data.datos;
            this.setLimpiaRequerimientos();
            this.fillCrearReqMateriales.cCantidadReq = 0;
          }
        });
    },

    setLimpiaRequerimientos() {
      (this.fillCrearReqMateriales.cDescripcion = ""),
        (this.fillCrearReqMateriales.cCantidadReq = 0);
    },

    DeletListReqMateriales(item) {
      var url = "/administracion/RequerimientoMateriales/reorderReqMateriales";
      axios
        .post(url, {
          item: item,
        })
        .then((response) => {
          this.listartempProduccion = response.data.datos;
        });
    },

    DeletListReqMaNObra(item) {
      var url = "/administracion/RequerimientoMateriales/reorderReqManObra";
      axios
        .post(url, {
          item: item,
        })
        .then((response) => {
          this.listartempMobra = response.data.datos;
        });
    },

    DeletListOtrosReq(item) {
      var url = "/administracion/RequerimientoMateriales/reorderOtrosReq";
      axios
        .post(url, {
          item: item,
        })
        .then((response) => {
          this.listartempRequerimientos = response.data.datos;
        });
    },

    getListarByProveedor() {
      var url = "/administracion/proveedor/getListarProveedorById";
      axios
        .get(url, {
          params: {
            nIdProveedor: this.fillCrearReqMateriales.nIdProveedor,
          },
        })
        .then((response) => {
          this.fillCrearReqMateriales.cCodProduct = response.data.nombre;
        });
    },

    /*     getlistDescricionPago() {
          var url = "/administracion/pago/index";
          axios.get(url).then((response) => {
            this.listDescripPago = response.data;
            this.fillCrearReqMateriales.nIdDescripPago =
              this.listDescripPago[0].id;
          });
        }, */

    getlistTipoCambio() {
      var url = "/administracion/ordenCompra/TipoCambio";
      axios.get(url).then((response) => {
        this.listTipoCambio = response.data;
        this.fillCrearReqMateriales.nIdTipoMoneda = this.listTipoCambio[0].id;
      });
    },

    getListarAlmacen() {
      var url = "/administracion/almacen/AlmacenbyEstado";
      axios.get(url).then((response) => {
        this.listAlmacen = response.data;
      });
    },

    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdmaterial: this.fillCrearReqMateriales.nIdmaterial,
          },
        })
        .then((response) => {
          this.listProd = response.data;
        });
    },

    limpiarCriteriosBsq() {
      this.fillCrearReqMateriales.cCodProduct = "";
    },
    setRegistrarReqMateriales() {
      if (this.validaOrdenProduccion()) {
        this.modalShow = true;
        return;
      }
      this.setGrabarReqMateriales();
    },

    setGrabarReqMateriales() {
      var url = "/administracion/RequerimientoMateriales/create";
      axios
        .post(url, {
          nIdproduct: this.fillCrearReqMateriales.nIdproduct,
          cCantprod: this.fillCrearReqMateriales.cCantprod,
          nidAlmacen: this.fillCrearReqMateriales.nidAlmacen,
          cRuc: this.fillCrearReqMateriales.cRuc,
          FInicio: this.fillCrearReqMateriales.FInicio,
          FFinal: this.fillCrearReqMateriales.FFinal,
          nIdUser: this.fillCrearReqMateriales.nIdUser,
          Duracionfechas: this.fillCrearReqMateriales.cDuracion,
          nIdUnidMed: this.fillCrearReqMateriales.nIdUnidMed,
          cReferencia: this.fillCrearReqMateriales.cReferencia,
          nIdZonaProduccion: this.fillCrearReqMateriales.nIdZonaProduccion,

          //Requerimientos de Materiales ////
          nIdmaterial: this.fillCrearReqMateriales.nIdmaterial,
          cCantMaterial: this.fillCrearReqMateriales.cCantMaterial,

          //Fin de Requerimientos de Materiales ////

          //// Requerimientos de Mano de Obra /////
          cPersonal: this.fillCrearReqMateriales.cPersonal,
          cDiasMObra: this.fillCrearReqMateriales.cDiasMObra,
          cHorasMObra: this.fillCrearReqMateriales.cHorasMObra,
          //// Fin de Requerimientos de Mano de Obra /////

          ///// Otros Requerimientos //////
          cDescripcion: this.fillCrearReqMateriales.cDescripcion,
          cHorasRequ: this.fillCrearReqMateriales.cHorasRequ,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 1500,
          });
          this.setCleanMaterial();
          this.setCleanManoObra();
          this.setCleanRequerimientos();
        });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    validaOrdenProduccion() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillCrearReqMateriales.nIdproduct) {
        this.mensajeError.push("El campo producto es obligatorio");
      }
      if (this.fillCrearReqMateriales.cCantprod <= 0) {
        this.mensajeError.push("Cantidad no puede ser menor o igual a cero");
      }
      if (!this.fillCrearReqMateriales.cCantprod) {
        this.mensajeError.push("Cantidad es campo obligatorio");
      }

      if (!this.fillCrearReqMateriales.FInicio) {
        this.mensajeError.push("Fecha Inicio es campo obligatorio");
      }

      if (!this.fillCrearReqMateriales.FFinal) {
        this.mensajeError.push("Fecha Final es campo obligatorio");
      }

      if (!this.fillCrearReqMateriales.nIdTipoPago) {
        this.mensajeError.push("Tipo de Pago es campo obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },
    setAddReqMaterial() {
      var url = "/administracion/RequerimientoMateriales/addOrden";

      axios
        .post(url, {
          nIdmaterial: this.fillCrearReqMateriales.nIdmaterial,
          cCantMaterial: this.fillCrearReqMateriales.cCantMaterial,
          nIdUnidMedMat: this.fillCrearReqMateriales.nIdUnidMedMat,
          estado: "R",
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
            this.listartempProduccion = response.data.datos;
            this.setLimpiaMaterial();
            this.fillCrearReqMateriales.cCantMaterial = 0;
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
            this.listartempProduccion = response.data.datos;
            this.setLimpiaMaterial();
            this.fillCrearReqMateriales.cCantMaterial = 0;
          }
        });
    },

    setLimpiaMaterial() {
      (this.fillCrearReqMateriales.nIdmaterial = ""),
        (this.fillCrearReqMateriales.cCantMaterial = 0);
    },

    setLimpiaCampos() {
      this.fillCrearReqMateriales.nIdmaterial = null;
      this.fillCrearReqMateriales.cCantidad = 0;
    },

    setResetCampos() {
      this.fillCrearReqMateriales.nIdmaterial = null;
      this.fillCrearReqMateriales.cCantidad = 0;

      this.fillCrearReqMateriales.cReferencia = "";
      this.fillCrearReqMateriales.cDocumento = "";
    },

    setCleanMaterial() {
      var url = "/administracion/RequerimientoMateriales/eliminarTemporder";
      axios.get(url, {}).then((response) => {
        this.listartempProduccion = response.data.datos;
        this.setLimpiaMaterial();
      });
    },

    setCleanManoObra() {
      var url = "/administracion/RequerimientoMateriales/CleanMaterialReqMObra";
      axios.get(url, {}).then((response) => {
        this.listartempMobra = response.data.datos;
        this.setcleanListMObra();
      });
    },

    setCleanRequerimientos() {
      var url = "/administracion/RequerimientoMateriales/cleanRequerimientos";
      axios.get(url, {}).then((response) => {
        this.listartempRequerimientos = response.data.datos;
        this.setLimpiaRequerimientos();
      });
    },

    setListtemOrders() {
      var url = "/administracion/ordenCompra/ListtempOrden";
      axios.get(url, {}).then((response) => {
        this.listartempProduccion = response.data.datos;
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
        this.fillCrearReqMateriales.nIdUnidMed = this.listUnidMed[7].id;
        this.fillCrearReqMateriales.nIdUnidMedMat = this.listUnidMed[7].id;
      });
    },
  },
  computed: {
    calculoFechas() {
      if (
        this.fillCrearReqMateriales.FFinal != null &&
        this.fillCrearReqMateriales.FInicio != null
      ) {
        let valorfecha =
          new Date(this.fillCrearReqMateriales.FFinal).getTime() -
          new Date(this.fillCrearReqMateriales.FInicio).getTime();
        return String(valorfecha / 86400000 + 1).padStart(2, 0);
      }
    },
  },
};
</script>

<style></style>
