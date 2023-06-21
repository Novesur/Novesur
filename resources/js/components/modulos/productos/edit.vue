<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Editar Producto</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/productos'">
              <i class="fas fa-arrow-left">Regresar</i>
            </router-link>
          </div>
        </div>

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Editar Producto</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Codigo</label>
                        <div class="col-md-3">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarProducto.nIdCodigo"
                            maxlength="30"
                          />
                        </div>

                        <div>
                          <button
                            class="btn btn-flat btn-success"
                            @click.prevent="setValidarcodigoProductos"
                          >
                            <span><i class="fas fa-search"></i></span>
                          </button>
                        </div>
                        <span style="color: #ff0000; padding: 0.5px">
                          {{ this.fillEditarProducto.nIdCodigo.length }}
                          caracteres</span
                        >
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Familia</label>
                        <div class="col-md-8">
                          <el-select
                            v-model="fillEditarProducto.nIdFamilia"
                            ref="theSelectFamilia"
                            filterable
                            placeholder="Seleccione una Familia"
                            @change="getListarSubFamilia()"
                          >
                            <el-option
                              v-for="item in listFamilia"
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
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Diametro/Longitud</label
                        >
                        <div class="col-md-8">
                          <el-select
                            v-model="fillEditarProducto.nIdSubFamilia"
                            filterable
                            placeholder="Seleccione una SubFamilia"
                            :style="{ width: '350px' }"
                          >
                            <el-option
                              v-for="item in listSubFamilia"
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
                        <label class="col-md-3 col-form-label">Marca</label>
                        <div class="col-md-8">
                          <el-select
                            v-model="fillEditarProducto.nIdMarca"
                            filterable
                            placeholder="Seleccione una Marca"
                          >
                            <el-option
                              v-for="item in listMarca"
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
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Material</label>
                        <div class="col-md-8">
                          <el-select
                            v-model="fillEditarProducto.nIdMaterial"
                            filterable
                            placeholder="Seleccione una Material"
                          >
                            <el-option
                              v-for="item in listMaterial"
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
                          >Modelo/Tipo</label
                        >
                        <div class="col-md-8">
                          <el-select
                            v-model="fillEditarProducto.nIdModeloTipo"
                            filterable
                            placeholder="Seleccione Modelo/Tipo"
                          >
                            <el-option
                              v-for="item in listModeloTipo"
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
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Homologado</label
                        >
                        <div class="col-md-8">
                          <el-select
                            v-model="fillEditarProducto.nIdHomologado"
                            filterable
                            placeholder="Seleccione el tipo"
                            clearable
                          >
                            <el-option
                              v-for="item in listHomologado"
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
                          >Precio Sugerido S/.</label
                        >
                        <div class="col-md-3">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarProducto.cPrecioSugerido"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Estado</label>
                        <div class="col-md-8">
                          <el-select
                            v-model="fillEditarProducto.nIdEstado"
                            filterable
                            placeholder="Seleccione una Estado"
                          >
                            <el-option
                              v-for="item in listEstadoProd"
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
                        <label class="col-md-3 col-form-label">Precio Distribuidor S/.</label>
                        <div class="col-md-3">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarProducto.cPrecioDist"
                          />
                        </div>
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
                      @click.prevent="setValidarProductos"
                    >
                      Editar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="LimpiarProductoBsq"
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
      fillEditarProducto: {
        nIdProducto: this.$attrs.id,
        nIdFamilia: "",
        nIdSubFamilia: "",
        nIdMarca: "",
        nIdMaterial: "",
        nIdEstado: "",
        nIdModeloTipo: "",
        nIdHomologado: "",
        nIdUser: sessionStorage.getItem("iduser"),
        nIdCodigo: "",
        cPrecioSugerido:"",
        cPrecioDist:"",
      },
      listFamilia: [],
      listSubFamilia: [],
      listMarca: [],
      listMaterial: [],
      listEstadoProd: [],
      listModeloTipo: [],
      listHomologado: [],
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
    this.getListarFamilia();
    this.getListarSubFamilia();
    this.getListarMarca();
    this.getListarMaterial();
    this.getListarEstadoProd();
    this.getListarModeloTipo();
    this.getProductoById();
    this.getListarHomologacion();
  },

  methods: {
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    getProductoById() {
      var url = "/administracion/producto/getListarProductoById";
      axios
        .get(url, {
          params: {
            nIdProducto: this.fillEditarProducto.nIdProducto,
          },
        })
        .then((response) => {
          this.fillEditarProducto.nIdFamilia = response.data.familia_id;
          this.getListarSubFamilia();
          this.fillEditarProducto.nIdMarca = response.data.marca_id;
          this.fillEditarProducto.nIdMaterial = response.data.material_id;
          this.fillEditarProducto.nIdModeloTipo = response.data.modelotipo_id;
          this.fillEditarProducto.nIdEstado = response.data.estado_id;
          this.fillEditarProducto.nIdSubFamilia = response.data.subfamilia_id;
          this.fillEditarProducto.nIdHomologado = response.data.homologacion_id;
          this.fillEditarProducto.nIdCodigo = response.data.codigo;
        this.fillEditarProducto.cPrecioSugerido = response.data.precioSugerido;
        this.fillEditarProducto.cPrecioDist = response.data.precioDistribuidor;
        });
    },

    getListarModeloTipo() {
      var url = "/administracion/modelotipo/getListarModelotipo";
      axios.get(url).then((response) => {
        this.listModeloTipo = response.data;
      });
    },

    setValidarcodigoProductos() {
      var url = "/administracion/producto/BuscaCodigoProducto";
      axios
        .get(url, {
          params: {
            nIdCodigo: this.fillEditarProducto.nIdCodigo,
          },
        })
        .then((response) => {
          Swal.fire({
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 1500,
          });
        });
    },

    getListarHomologacion() {
      var url = "/administracion/tempcotizacion/getListarHomologacion";
      axios.get(url).then((response) => {
        this.listHomologado = response.data;
      });
    },

    validarProductos() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillEditarProducto.nIdFamilia) {
        this.mensajeError.push("Seleccione una Familia");
      }
      if (!this.fillEditarProducto.nIdSubFamilia) {
        this.mensajeError.push("Seleccione una SubFamilia");
      }
      if (!this.fillEditarProducto.nIdMarca) {
        this.mensajeError.push("Seleccione una Marca");
      }
      if (!this.fillEditarProducto.nIdMaterial) {
        this.mensajeError.push("Seleccione un Material");
      }
      if (!this.fillEditarProducto.nIdEstado) {
        this.mensajeError.push("Seleccione un Estado");
      }
      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },
    LimpiarProductoBsq() {
      this.fillEditarProducto.nIdFamilia = "";
      this.fillEditarProducto.nIdSubFamilia = "";
      this.fillEditarProducto.nIdMarca = "";
      this.fillEditarProducto.nIdMaterial = "";
      this.fillEditarProducto.nIdEstado = "";
      this.fillEditarProducto.nIdModeloTipo = "";
    },
    getListarFamilia() {
      var url = "/administracion/familia/getListarFamilias";
      axios.get(url).then((response) => {
        this.listFamilia = response.data;
      });
    },
    getListarMarca() {
      var url = "/administracion/marcas/getListarMarcas";
      axios.get(url).then((response) => {
        this.listMarca = response.data;
      });
    },
    getListarSubFamilia() {
      var url = "/administracion/subfamilia/listSubFamiliabyFamilia";
      axios
        .get(url, {
          params: {
            nIdFamilia: this.fillEditarProducto.nIdFamilia,
          },
        })
        .then((response) => {
          /*  (this.fillEditarProducto.nIdSubFamilia = ""),
            (this.listSubFamilia = response.data); */
          this.listSubFamilia = response.data;
        });
    },
    getListarMaterial() {
      var url = "/administracion/material/getListarMaterial";
      axios.get(url).then((response) => {
        this.listMaterial = response.data;
      });
    },
    getListarEstadoProd() {
      var url = "/administracion/estadoprod/getListarEstadoprod";
      axios.get(url).then((response) => {
        this.listEstadoProd = response.data;
      });
    },
    setEditarProductos() {
      var url = "/administracion/producto/setRegistrarProducto";
      axios.post(url, {
        params: {},
      });
    },
    setValidarProductos() {
      if (this.validarProductos()) {
        this.modalShow = true;
        return;
      }
      this.setEditarProductos();
    },
    setEditarProductos() {
      var url = "/administracion/producto/setEditarProductos";
      axios
        .post(url, {
          nIdCodigo: this.fillEditarProducto.nIdCodigo,
          nIdProducto: this.fillEditarProducto.nIdProducto,
          nIdFamilia: this.fillEditarProducto.nIdFamilia,
          nIdSubFamilia: this.fillEditarProducto.nIdSubFamilia,
          nIdMarca: this.fillEditarProducto.nIdMarca,
          nIdMaterial: this.fillEditarProducto.nIdMaterial,
          nIdModeloTipo: this.fillEditarProducto.nIdModeloTipo,
          nIdEstado: this.fillEditarProducto.nIdEstado,
          nIdUser: this.fillEditarProducto.nIdUser,
          nIdHomologado: this.fillEditarProducto.nIdHomologado,
          cPrecioSugerido: this.fillEditarProducto.cPrecioSugerido,
          cPrecioDist : this.fillEditarProducto.cPrecioDist,
        })
        .then(() => {
          Swal.fire({
            icon: "success",
            title: "Se edito correctamente",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$router.push("/productos");
        });
    },
  },
};
</script>

<style>
</style>
