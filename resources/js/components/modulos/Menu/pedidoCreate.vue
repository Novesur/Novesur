<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Crear Plato</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Registrar Menu</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Elija el Plato Entrada</label>
                        <div class="col-md-10">
                          <el-select v-model="fillCrearPedidoMenu.nidPlatoEntrada" placeholder="Seleccione una Tipo"
                            filterable style="width: 70%">
                            <el-option v-for="item in listPlatoEntrada" :key="item.id" :label="item.nombre"
                              :value="item.id">
                            </el-option>
                          </el-select>
                          <span>
                            <button class="btn btn-info" @click.prevent="setGrabarPedidoEntrada">
                              Registrar
                            </button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Elija el Plato Segundo</label>
                        <div class="col-md-10">
                          <el-select v-model="fillCrearPedidoMenu.nidPlatoSegundo" placeholder="Seleccione una Tipo"
                            filterable style="width: 70%">
                            <el-option v-for="item in listPlatoSegundo" :key="item.id" :label="item.nombre"
                              :value="item.id">
                            </el-option>
                          </el-select>
                          <span>
                            <button class="btn btn-info" @click.prevent="setGrabarPedidoSegundo">
                              Registrar
                            </button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>

     <!--              <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Elija el Plato Extra</label>
                        <div class="col-md-10">
                          <el-select v-model="fillCrearPedidoMenu.nidPlatoExtra" placeholder="Seleccione una Tipo"
                            filterable style="width: 70%">
                            <el-option v-for="item in listPlatoExtra" :key="item.id" :label="item.nombre"
                              :value="item.id">
                            </el-option>
                          </el-select>
                          <span>
                            <button class="btn btn-info" @click.prevent="setGrabarPedidoExtra">
                              Registrar
                            </button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div> 
                  -->


                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Elija el Plato Dieta</label>
                        <div class="col-md-10">
                          <el-select v-model="fillCrearPedidoMenu.nidPlatoDieta" placeholder="Seleccione una Tipo"
                            filterable style="width: 70%">
                            <el-option v-for="item in listPlatoDieta" :key="item.id" :label="item.nombre"
                              :value="item.id">
                            </el-option>
                          </el-select>
                          <span>
                            <button class="btn btn-info" @click.prevent="setGrabarPedidoDieta">
                              Registrar
                            </button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Fecha</label>
                        <div class="col-md-8">
                          <el-date-picker v-model="fillCrearPedidoMenu.dFecha" type="date" value-format="yyyy-MM-dd"
                            :style="{ width: '180px', height: '38px' }" @change="listMenubyDate">
                          </el-date-picker>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <!--        <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setRegistrarDetallePlato"
                    >
                      Registrar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="limpiarPlato"
                    >
                      Limpiar
                    </button>
                  </div>
                </div>
              </div> -->
            </div>
          </div>

          <div class="container-fluid">
            <div class="row">
              <div class="col">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Menu Entrada</h3>
                  </div>
                  <div class="card-body table-responsive">
                    <table class="
                        table table-hover table-head-fixed
                        text-nowrap
                        projects
                      ">
                      <thead>
                        <tr></tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, index) in listPedidoEntrada" :key="index">
                          <template v-if="item.plato_entrada" !="null">
                            <td v-text="item.plato_entrada.nombre"></td>

                            <td>
                              <button class="btn btn-danger btn-sm" @click.prevent="DeletePedidoEntrada(item.id)">
                                <i class="fas fa-trash"></i>Eliminar
                              </button>
                            </td>
                          </template>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Menu Segundo</h3>
                  </div>
                  <div class="card-body table-responsive">
                    <table class="
                        table table-hover table-head-fixed
                        text-nowrap
                        projects
                      ">
                      <thead></thead>
                      <tbody>
                        <tr v-for="(item, index) in listPedidoSegundo" :key="index">
                          <template v-if="item.plato_segundo" !="null">
                            <td v-text="item.plato_segundo.nombre"></td>

                            <td>
                              <button class="btn btn-danger btn-sm" @click.prevent="DeletePedidoSegundo(item.id)">
                                <i class="fas fa-trash"></i>Eliminar
                              </button>
                            </td>
                          </template>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

      <!--         <div class="col">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Menu Extra</h3>
                  </div>
                  <div class="card-body table-responsive">
                    <table class="
                        table table-hover table-head-fixed
                        text-nowrap
                        projects
                      ">
                      <thead></thead>
                      <tbody>
                        <tr v-for="(item, index) in listPedidoExtra" :key="index">
                          <template v-if="item.plato_extra" !="null">
                            <td v-text="item.plato_extra.nombre"></td>

                            <td>
                              <button class="btn btn-danger btn-sm" @click.prevent="DeletePedidoExtra(item.id)">
                                <i class="fas fa-trash"></i>Eliminar
                              </button>
                            </td>
                          </template>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> -->

              <div class="col">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Menu Dieta</h3>
                  </div>
                  <div class="card-body table-responsive">
                    <table class="
                        table table-hover table-head-fixed
                        text-nowrap
                        projects
                      ">
                      <thead></thead>
                      <tbody>
                        <tr v-for="(item, index) in listPedidoDieta" :key="index">
                          <template v-if="item.plato_dieta" !="null">
                            <td v-text="item.plato_dieta.nombre"></td>

                            <td>
                              <button class="btn btn-danger btn-sm" @click.prevent="DeletePedidoDieta(item.id)">
                                <i class="fas fa-trash"></i>Eliminar
                              </button>
                            </td>
                          </template>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>



            </div>
          </div>
        </div>
      </div>
    </div>

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
      fillCrearPedidoMenu: {
        nidPlatoEntrada: "",
        nidPlatoSegundo: "",
        nidPlatoExtra: "",
        nidPlatoDieta: "",
        dFecha: "",
      },
      listPlatoEntrada: [],
      listPlatoSegundo: [],
      listPlatoExtra: [],
      listPlatoDieta:[],
      listPedidoEntrada: [],
      listPedidoSegundo: [],
      listPedidoExtra: [],
      listPedidoDieta: [],

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
    this.getListarPlatoEntrada();
    this.getListarPlatoSegundo();
    //this.getListarPlatoExtra();
    this.getListarPlatoDieta();
    this.getListarPedidoEntrada();
    this.getListarPedidoSegundo();
    //this.getListarPedidoExtra();
    this.getListarPedidoDieta();

    //Carga la fecha Actual
    this.fillCrearPedidoMenu.dFecha = new Date();
  },
  methods: {

    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    limpiarPlato() {
      this.fillCrearPedidoMenu.cNombre = "";
    },

    setGrabarPedidoEntrada() {
      var url = "/administracion/PedidoEntrada/create";
      axios
        .post(url, {
          nidPlato: this.fillCrearPedidoMenu.nidPlatoEntrada,
          dFecha: this.fillCrearPedidoMenu.dFecha,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });

          this.getListarPedidoEntrada();
        });
    },

    setGrabarPedidoSegundo() {
      var url = "/administracion/PedidoSegundo/create";
      axios
        .post(url, {
          nidPlato: this.fillCrearPedidoMenu.nidPlatoSegundo,
          dFecha: this.fillCrearPedidoMenu.dFecha,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });

          this.getListarPedidoSegundo();
        });
    },

    setGrabarPedidoExtra() {
      var url = "/administracion/PedidoExtra/create";
      axios
        .post(url, {
          nidPlato: this.fillCrearPedidoMenu.nidPlatoExtra,
          dFecha: this.fillCrearPedidoMenu.dFecha,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });

          this.getListarPedidoExtra();
        });
    },

    setGrabarPedidoDieta() {
      var url = "/administracion/PedidoDieta/create";
      axios
        .post(url, {
          nidPlato: this.fillCrearPedidoMenu.nidPlatoDieta,
          dFecha: this.fillCrearPedidoMenu.dFecha,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });

          this.getListarPedidoDieta();
        });
    },

    setRegistrarDetallePlato() {
      if (this.validarMenu()) {
        this.modalShow = true;
        return;
      }
      this.setGuardarDetallePlato();
    },

    getListarPlatoEntrada() {
      var url = "/administracion/plato/listEntrada";
      axios.get(url).then((response) => {
        this.listPlatoEntrada = response.data;
        this.fillCrearPedidoMenu.nidPlatoEntrada = this.listPlatoEntrada[0].id;
      });
    },

    getListarPedidoEntrada() {
      var url = "/administracion/PedidoEntrada/list";
      axios
        .get(url, {
          params: {
            dFecha: this.fillCrearPedidoMenu.dFecha,
          },
        })
        .then((response) => {
          this.listPedidoEntrada = response.data;
        });
    },

    DeletePedidoEntrada(id) {
      Swal.fire({
        title: "Desea anular el plato del menu Entrada?",
        text: "Si desea recuperarlo consulte con el administrador",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Anulalo",
        cancelButtonText: "No, cancelo!",
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/PedidoEntrada/delete";
          axios
            .post(url, {
              id,
            })
            .then(() => {
              this.getListarPedidoEntrada();
            });
          swalWithBootstrapButtons.fire(
            "Anulado!",
            "El Plato fue Anulado.",
            "success"
          );
        }
      });
    },

    DeletePedidoSegundo(id) {
      Swal.fire({
        title: "Desea anular el plato del menu Segundo?",
        text: "Si desea recuperarlo consulte con el administrador",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Anulalo",
        cancelButtonText: "No, cancelo!",
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/PedidoSegundo/delete";
          axios
            .post(url, {
              id,
            })
            .then(() => {
              this.getListarPedidoSegundo();
            });
          swalWithBootstrapButtons.fire(
            "Anulado!",
            "El Plato fue Anulado.",
            "success"
          );
        }
      });
    },

    DeletePedidoExtra(id) {
      Swal.fire({
        title: "Desea anular el plato del menu Extra?",
        text: "Si desea recuperarlo consulte con el administrador",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Anulalo",
        cancelButtonText: "No, cancelo!",
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/PedidoExtra/delete";
          axios
            .post(url, {
              id,
            })
            .then(() => {
              this.getListarPedidoExtra();
            });
          swalWithBootstrapButtons.fire(
            "Anulado!",
            "El Plato fue Anulado.",
            "success"
          );
        }
      });
    },

    DeletePedidoDieta(id) {
      Swal.fire({
        title: "Desea anular el plato del menu Dieta?",
        text: "Si desea recuperarlo consulte con el administrador",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Anulalo",
        cancelButtonText: "No, cancelo!",
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/PedidoDieta/delete";
          axios
            .post(url, {
              id,
            })
            .then(() => {
              this.getListarPedidoDieta();
            });
          swalWithBootstrapButtons.fire(
            "Anulado!",
            "El Plato fue Anulado.",
            "success"
          );
        }
      });
    },

    

    getListarPlatoSegundo() {
      var url = "/administracion/plato/listSegundo";
      axios.get(url).then((response) => {
        this.listPlatoSegundo = response.data;
        this.fillCrearPedidoMenu.nidPlatoSegundo = this.listPlatoSegundo[0].id;
      });
    },

    getListarPedidoSegundo() {
      var url = "/administracion/PedidoSegundo/list";
      axios
        .get(url, {
          params: {
            dFecha: this.fillCrearPedidoMenu.dFecha,
          },
        })
        .then((response) => {
          this.listPedidoSegundo = response.data;
          /*    this.fillBsqCotizacion.nIdVendedor = this.listVendedorUser[0].id;
          this.getlistCliente(); */
        });
    },

    getListarPlatoExtra() {
      var url = "/administracion/plato/listExtra";
      axios.get(url).then((response) => {
        this.listPlatoExtra = response.data;
        this.fillCrearPedidoMenu.nidPlatoExtra = this.listPlatoExtra[0].id;
      });
    },

    getListarPlatoDieta() {
      var url = "/administracion/plato/listDieta";
      axios.get(url).then((response) => {
        this.listPlatoDieta = response.data;
        this.fillCrearPedidoMenu.nidPlatoDieta = this.listPlatoDieta[0].id;
      });
    },


    getListarPedidoExtra() {
      var url = "/administracion/PedidoExtra/list";
      axios
        .get(url, {
          params: {
            dFecha: this.fillCrearPedidoMenu.dFecha,
          },
        })
        .then((response) => {
          this.listPedidoExtra = response.data;
          /*    this.fillBsqCotizacion.nIdVendedor = this.listVendedorUser[0].id;
          this.getlistCliente(); */
        });
    },

    getListarPedidoDieta() {
      var url = "/administracion/PedidoDieta/list";
      axios
        .get(url, {
          params: {
            dFecha: this.fillCrearPedidoMenu.dFecha,
          },
        })
        .then((response) => {
          
          this.listPedidoDieta = response.data;
          /*    this.fillBsqCotizacion.nIdVendedor = this.listVendedorUser[0].id;
          this.getlistCliente(); */
        });
    },

    setGuardarDetallePlato() {
      var url = "/administracion/Plato/CreateDetallePlato";
      axios
        .post(url, {
          nidPlato: this.fillCrearPedidoMenu.nidPlato,

          dFecha: this.fillCrearPedidoMenu.dFecha,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });

          //this.$router.push("/proveedor");
        });
    },

    listMenubyDate() {
      this.getListarPedidoEntrada();
      this.getListarPedidoSegundo();
      this.getListarPedidoExtra();
      this.getListarPedidoDieta();
    },


    validarMenu() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearPedidoMenu.nidPlato) {
        this.mensajeError.push("El Campo Plato es un campo obligatorio");
      }

      if (!this.fillCrearPedidoMenu.dFecha) {
        this.mensajeError.push("El Campo Fecha es un campo obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },
  },
};
</script>

<style>

</style>
