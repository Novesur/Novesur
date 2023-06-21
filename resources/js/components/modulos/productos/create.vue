<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Crear Producto</h1>
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
                <h3 class="card-title">Registrar Producto</h3>
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
                            v-model="fillCrearProducto.nIdCodigo"
                            maxlength="30"
                          />
                        </div>
                        <span style="color: #ff0000">
                          {{ this.fillCrearProducto.nIdCodigo.length }}
                          caracteres</span
                        >
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Diametro/Longitud</label
                        >
                        <div class="col-md-8">
                          <el-select
                            v-model="fillCrearProducto.nIdSubFamilia"
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
                        <label class="col-md-3 col-form-label">Familia</label>
                        <div class="col-md-8">
                          <el-select
                            v-model="fillCrearProducto.nIdFamilia"
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

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Homologado</label
                        >
                        <div class="col-md-8">
                          <el-select
                            v-model="fillCrearProducto.nIdHomologado"
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
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Marca</label>
                        <div class="col-md-8">
                          <el-select
                            v-model="fillCrearProducto.nIdMarca"
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

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Material</label>
                        <div class="col-md-8">
                          <el-select
                            v-model="fillCrearProducto.nIdMaterial"
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
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Modelo/Tipo</label
                        >
                        <div class="col-md-8">
                          <el-select
                            v-model="fillCrearProducto.nIdModeloTipo"
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


                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Precio Sugerido S/.</label>
                        <div class="col-md-3">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearProducto.cPrecioSugerido"
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
                            v-model="fillCrearProducto.nIdEstado"
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
                            v-model="fillCrearProducto.cPrecioDist"
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
                      @click.prevent="setRegistrarProductos"
                    >
                      Registrar
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
      fillCrearProducto: {
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
    this.getListarHomologacion();
    // console.log(sessionStorage.getItem('iduser'));
  },

  methods: {
    abrirModal() {
      this.modalShow = !this.modalShow;
    },

    getListarModeloTipo() {
      var url = "/administracion/modelotipo/getListarModelotipo";
      axios.get(url).then((response) => {
        this.listModeloTipo = response.data;
      });
    },

    validarProductos() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearProducto.nIdFamilia) {
        this.mensajeError.push("Seleccione una Familia");
      }
      if (!this.fillCrearProducto.nIdSubFamilia) {
        this.mensajeError.push("Seleccione una SubFamilia");
      }
      if (!this.fillCrearProducto.nIdMarca) {
        this.mensajeError.push("Seleccione una Marca");
      }
      if (!this.fillCrearProducto.nIdMaterial) {
        this.mensajeError.push("Seleccione un Material");
      }
      if (!this.fillCrearProducto.nIdEstado) {
        this.mensajeError.push("Seleccione un Estado");
      }
      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },
    LimpiarProductoBsq() {
      this.fillCrearProducto.nIdFamilia = "";
      this.fillCrearProducto.nIdSubFamilia = "";
      this.fillCrearProducto.nIdMarca = "";
      this.fillCrearProducto.nIdMaterial = "";
      this.fillCrearProducto.nIdEstado = "";
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
    /*     getListarSubFamilia() {
      var url = "/administracion/subfamilia/listSubFamiliabyFamilia";
      axios
        .get(url, {
          params: {
            nIdFamilia: this.fillCrearProducto.nIdFamilia,
          },
        })
        .then((response) => {
          (this.fillCrearProducto.nIdSubFamilia = ""),
            (this.listSubFamilia = response.data);
        });
    }, */

    getListarSubFamilia() {
      var url = "/administracion/subfamilia/listSubFamiliabyFamilia";
      axios.get(url).then((response) => {
        this.listSubFamilia = response.data;
      });
    },
    getListarMaterial() {
      var url = "/administracion/material/getListarMaterial";
      axios.get(url).then((response) => {
        this.listMaterial = response.data;
      });
    },
    getListarHomologacion() {
      var url = "/administracion/tempcotizacion/getListarHomologacion";
      axios.get(url).then((response) => {
        this.listHomologado = response.data;
        this.fillCrearProducto.nIdHomologado = this.listHomologado[2].id;
      });
    },
    getListarEstadoProd() {
      var url = "/administracion/estadoprod/getListarEstadoprod";
      axios.get(url).then((response) => {
        this.listEstadoProd = response.data;
        this.fillCrearProducto.nIdEstado = this.listEstadoProd[0].id;
      });
    },

    setRegistrarProductos() {
      if (this.validarProductos()) {
        this.modalShow = true;
        return;
      }
      this.setGuardarProductos();
    },
    setGuardarProductos() {
      var url = "/administracion/producto/setRegistrarProducto"; 
      axios
        .post(url, {
          nIdCodigo: this.fillCrearProducto.nIdCodigo,
          nIdFamilia: this.fillCrearProducto.nIdFamilia,
          nIdSubFamilia: this.fillCrearProducto.nIdSubFamilia,
          nIdMarca: this.fillCrearProducto.nIdMarca,
          nIdMaterial: this.fillCrearProducto.nIdMaterial,
          nIdEstado: this.fillCrearProducto.nIdEstado,
          nIdModeloTipo: this.fillCrearProducto.nIdModeloTipo,
          nIdUser: this.fillCrearProducto.nIdUser,
          nIdHomologado: this.fillCrearProducto.nIdHomologado,
          cPrecioSugerido : this.fillCrearProducto.cPrecioSugerido,
          cPrecioDist : this.fillCrearProducto.cPrecioDist,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });
          this.$router.push("/productos");
        });
    },
  },
};
</script>

<style>
</style>
