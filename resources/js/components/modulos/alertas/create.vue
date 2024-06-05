<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Alertas</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/usuario'">
              <i class="fas fa-plus-square"></i>Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Registrar Usuario</h3>
              </div>
              <div class="card-body">
                <form role="">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Fecha de Vencimiento</label
                        >
                        <div class="col-md-9">
                          <el-date-picker
                            v-model="fillCrearAlertas.cFechaVencimiento"
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

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Obligación</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearAlertas.cObligacion"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Entidad</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearAlertas.cEntidad"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Importe</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearAlertas.cImporte"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Tipo de Moneda</label>
                        <div class="col-md-9">
                          <el-select
                            v-model="fillCrearAlertas.nIdTipoMoneda"
                            placeholder="Select"
                            style="width: 70%"
                          >
                            <el-option
                              v-for="item in listTipoCambio"
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
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setRegistrarAlertas"
                    >
                      Registrar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="limpiarCriteriosBsq"
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillCrearAlertas: {
        cImporte: "",
        cObligacion: "",
        cEntidad: "",
        nIdTipoMoneda: "",
        cFechaVencimiento: "",
        nIdUsuario: sessionStorage.getItem("iduser"),
      },

      listTipoCambio: [],
    };
  },
  mounted() {
    this.getlistTipoCambio();
  },

  methods: {
    getlistTipoCambio() {
      var url = "/administracion/ordenCompra/TipoCambio";
      axios.get(url).then((response) => {
        this.listTipoCambio = response.data;
        this.fillCrearAlertas.nIdTipoMoneda = this.listTipoCambio[0].id;
      });
    },

    setRegistrarAlertas() {
      if (this.validarRegistrarAlertas()) {
        this.modalShow = true;
        return;
      }
      this.setGuardarAlertas();
    },

    validarRegistrarAlertas() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearAlertas.cImporte) {
        this.mensajeError.push("El campor Importe es un campo obligatorio");
      }

      if (!this.fillCrearAlertas.cObligacion) {
        this.mensajeError.push("El campor Obligación es un campo obligatorio");
      }

      if (!this.fillCrearAlertas.cEntidad) {
        this.mensajeError.push("El campor Entidad es un campo obligatorio");
      }

      if (!this.fillCrearAlertas.nIdTipoMoneda) {
        this.mensajeError.push("El campor Tipo de Moneda es un campo obligatorio");
      }
      if (!this.fillCrearAlertas.cFechaVencimiento) {
        this.mensajeError.push("El campor Fecha de Vencimiento es un campo obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },
    setGuardarAlertas() {
      var url = "/administracion/alertas/create";
      axios
        .post(url, {
          cImporte: this.fillCrearAlertas.cImporte,
          cObligacion: this.fillCrearAlertas.cObligacion,
          cEntidad: this.fillCrearAlertas.cEntidad,
          nIdTipoMoneda: this.fillCrearAlertas.nIdTipoMoneda,
          cFechaVencimiento: this.fillCrearAlertas.cFechaVencimiento,
          nIdUsuario: this.fillCrearAlertas.nIdUsuario,
        })
        .then(() => {
          Swal.fire({
            icon: "success",
            title: "Se edito correctamente",
            showConfirmButton: false,
            timer: 1500,
          });
          this.limpiarCriteriosBsq();
        });
    },

    limpiarCriteriosBsq() {
      this.fillCrearAlertas.cImporte = "";
      this.fillCrearAlertas.cObligacion = "";
      this.fillCrearAlertas.cEntidad = "";
      this.fillCrearAlertas.nIdTipoMoneda = "";
      this.fillCrearAlertas.cFechaVencimiento = "";
    },
  },
};
</script>

<style></style>
