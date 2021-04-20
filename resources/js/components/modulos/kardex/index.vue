<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kardex</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card-body">
        <div class="container-fluid">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Formulario de Kardex</h3>
            </div>
            <div class="card-body">
              <form role="form">
                <div class="row">
                  <div class="col-md-6">
                    <label class="col-md-3 col-form-label">Codigo</label>
                    <div class="col-md-6">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqKardex.cCodigo"
                        :readonly="true"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label class="col-md-2 col-form-label"
                      >Medidor de Agua</label
                    >
                    <div class="col-md-10">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqKardex.cMedidor"
                        :readonly="true"
                      />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label class="col-md-3 col-form-label">Marca</label>
                    <div class="col-md-9">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqKardex.cMarca"
                        :readonly="true"
                      />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label class="col-md-3 col-form-label">Stock</label>
                    <div class="col-md-8">
                      <input
                        type="text"
                        class="form-control"
                        v-model.number="fillBsqKardex.cStock"
                        v-int
                        :readonly="true"
                      />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label class="col-md-3 col-form-label"
                      >Costo Unitario</label
                    >
                    <div class="col-md-9">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqKardex.cCostUnit"
                        v-on:keyup.enter="cCostUnitMoneda"
                        :readonly="true"
                      />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label class="col-md-3 col-form-label">Diferencia</label>
                    <div class="col-md-8">
                      <input
                        type="text"
                        class="form-control"
                        v-model="fillBsqKardex.cDiferencia"
                      />
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
                    @click.prevent="setGuardarKardex"
                  >
                    Generar
                  </button>
                  <button
                    class="btn btn-flat btn-default btnWidth"
                    @click.prevent="limpiarKardexBsq"
                  >
                    Limpiar
                  </button>
                </div>
              </div>
            </div>
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Bandeja de Listado</h3>
              </div>
              <div class="card-body table-responsive">
                <table
                  class="table table-hover table-head-fixed text-nowrap projects"
                >
                  <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Medidores de Agua</th>
                      <th>Marca</th>
                      <th>Stock</th>
                      <th>Costo unitario</th>

                      <th>Almacen</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in listKardex" :key="index">
                      <td v-text="item.producto.codigo"></td>
                      <td
                        v-text="
                          item.producto.subfamilia.nombre +
                          ', MODELO :' +
                          item.producto.modelotipo.nombre +
                          ', MATERIAL :' +
                          item.producto.material.nombre
                        "
                      ></td>
                      <td v-text="item.producto.marca.nombre"></td>
                      <td v-text="item.stock"></td>
                      <td v-text="item.costunit"></td>

                      <td v-text="item.producto.user.almacen.nombre"></td>
                      <td>
                        <router-link
                          class="btn btn-primary btn-sm"
                          :to="{
                            name: 'kardex.detalle',
                            params: { id: item.id },
                          }"
                        >
                          <i class="fas fa-dolly"></i> Detalle
                        </router-link>
                        <template
                          v-if="
                            listRolPermisoByUsuario.includes(
                              'reporte.movimientoXProducto'
                            )
                          "
                        >
                          <router-link
                            class="btn btn-success btn-sm"
                            :to="{
                              name: 'reporte.movimientoXProducto',
                              params: { id: item.id },
                            }"
                          >
                            <i class="far fa-file-excel"></i> Reporte
                          </router-link>
                        </template>

                        <router-link
                          class="btn btn-info btn-sm"
                          :to="{ name: 'kardex.list', params: { id: item.id } }"
                        >
                          <i class="far fa-clipboard"></i> Listado
                        </router-link>
                      </td>
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
</template>

<script>
export default {
  data() {
    return {
      fillBsqKardex: {
        nidProducto: this.$attrs.id,
        cCodigo: "",
        cMedidor: "",
        cMarca: "",
        cStock: "",
        cCostUnit: "",
        cDiferencia: "",
      },
      cproduct: "Jorge",
      listKardex: [],
      listProduct: [],
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
    };
  },
  mounted() {
    this.getProductoById();
    this.valueDefault();
    this.getListarKardex();
  },

  methods: {
    valueDefault() {
      var url = "/administracion/kardex/getListarKardexByProduct";
      axios
        .get(url, {
          params: {
            nIdProducto: this.fillBsqKardex.nidProducto,
          },
        })
        .then((response) => {
          this.listProduct = response.data;
          if (this.listProduct.length == 0) {
            this.fillBsqKardex.cStock = "0";
            this.fillBsqKardex.cCostUnit = "0.00";
          } else {
            this.fillBsqKardex.cStock = response.data.stock;
            this.fillBsqKardex.cCostUnit = this.convertMoney(
              response.data.costunit
            );
          }
        });
    },

    cCostUnitMoneda() {
      this.fillBsqKardex.cCostUnit = this.convertMoney(
        this.fillBsqKardex.cCostUnit
      );
    },

    convertMoney(value) {
      const formatterPeso = new Intl.NumberFormat("es-PE", {
        style: "currency",
        currency: "PEN",
        minimumFractionDigits: 2,
      });
      let valueFinal = formatterPeso.format(value);

      return valueFinal;
    },

    getProductoById() {
      var url = "/administracion/producto/ListarProductoByIdKardex";
      axios
        .get(url, {
          params: {
            nIdProducto: this.fillBsqKardex.nidProducto,
          },
        })
        .then((response) => {
          this.fillBsqKardex.cCodigo = response.data.codigo;
          this.fillBsqKardex.cMedidor =
            response.data.familia.nombre +
            ", " +
            response.data.subfamilia.nombre +
            " ,MODELO :" +
            response.data.modelotipo.nombre +
            " ,MATERIAL :" +
            response.data.material.nombre;
          this.fillBsqKardex.cMarca = response.data.marca.nombre;
          // EventBus.$emit('ProductKardex', response.data);
          sessionStorage.setItem(
            "nproduct",
            String(this.fillBsqKardex.cMedidor)
          );
        });
    },

    getListarKardex() {
      var url = "/administracion/kardex/getListarKardex";
      axios
        .get(url, {
          params: {
            nIdProducto: this.fillBsqKardex.nidProducto,
          },
        })
        .then((response) => {
          this.listKardex = response.data;
        });
    },

    getReporteMovimientoxProducto() {
      var url = "/administracion/reporte/getMovimientoxProducto";
      axios
        .get(url, {
          params: {
            nidKardex: item.id,
          },
        })
        .then((response) => {});
    },

    limpiarKardexBsq() {
      this.fillBsqKardex.cStock = "";
      this.fillBsqKardex.cCostUnit = "";
      this.fillBsqKardex.cDiferencia = "";
    },

    setGuardarKardex() {
      var url = "/administracion/kardex/setRegistrarKardex";
      axios
        .post(url, {
          nidProducto: this.fillBsqKardex.nidProducto,
          cStock: this.fillBsqKardex.cStock,
          cCostUnit: this.fillBsqKardex.cCostUnit,
          cDiferencia: this.fillBsqKardex.cDiferencia,
        })
        .then((response) => {
          console.log("grabado");
          this.getListarKardex();
        });
    },
  },
};
</script>

<style>
</style>
