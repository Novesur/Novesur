<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Reporte de Orden de Requerimiento de Materiales</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterio de Busqueda</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label"
                          >Producto</label
                        >
                       <div class="col-md-10">
                        <el-select
                          v-model="fillReporteOrdProduccion.nIdprod"
                          style="width: 90%"
                          filterable
                          clearable
                          placeholder="Select"
                        >

                            <v-row   align="right" >
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
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-1 col-form-label">Fecha</label>
                            <el-date-picker
                              v-model="fillReporteOrdProduccion.dFecha"
                              type="daterange"
                              range-separator="To"
                              start-placeholder="Start date"
                              end-placeholder="End date"
                              value-format="yyyy-MM-dd"
                              clearable
                              :style="{ width: '530px', height: '38px' }"
                            >
                            </el-date-picker>
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
                      @click.prevent="getListReportProduc"
                    >
                      Buscar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="limpiarListClientsBsq"
                    >
                      Limpiar
                    </button>
                  </div>
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
                      <th>CODIGO </th>
                      <th>FECHA </th>
                      <th>CODIGO PRODUCTO</th>
                      <th>PRODUCTO</th>
                      <th>CANTIDAD</th>
                      <th>FECHA INICIO</th>
                      <th>FECHA FINAL</th>
                      <th>ACCION</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr
                      v-for="(item, index) in listOrdenProduc"
                      :key="index"
                    >
                    <td v-text="item.codigo"></td>
                      <td>{{item.fecha | moment("DD - MM - Y") }}
                     <!--    {{
                          item.user == null
                            ? "Dado de Baja"
                            : item.user.fullname
                        }} -->
                      </td>

                       <td v-text="item.producto.codigo"></td>
                      <td  v-text="
                              item.producto.familia.nombre +
                              ' ' +
                              item.producto.subfamilia.nombre +
                              ', MARCA :' +
                              item.producto.marca.nombre +
                              ', MODELO/TIPO :' +
                              item.producto.modelotipo.nombre +
                              ', MATERIAL :' +
                              item.producto.material.nombre
                            ">
                            </td>

                            <td>{{item.cantidad}}</td>
                            <td>{{item.fechainicio | moment("DD - MM - Y")  }}</td>
                            <td>{{item.fechafinal | moment("DD - MM - Y") }}</td>
                            <td>     <button
                                class="btn btn-danger btn-sm"
                                @click.prevent="
                                  SetGenerarreqMaterialesPDF(item.id)
                                "
                              >
                                <i class="fas fa-file-pdf"></i> PDF
                              </button></td>
                    </tr>
                  </tbody>
                </table>
<!--                 <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item" v-if="pageNumber > 0">
                      <a href="" class="page-link" @click.prevent="prevPage"
                        >Ant</a
                      >
                    </li>
                    <li
                      class="page-item"
                      v-for="(page, index) in pagesList"
                      :key="index"
                      :class="[page == pageNumber ? 'active' : '']"
                    >
                      <a
                        href=""
                        class="page-link"
                        @click.prevent="selectPage(page)"
                        >{{ page + 1 }}</a
                      >
                    </li>
                    <li class="page-item" v-if="pageNumber < pageCount - 1">
                      <a href="" class="page-link" @click.prevent="nextPage"
                        >Post</a
                      >
                    </li>
                  </ul>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FileSaver from "file-saver";
export default {
  data() {
    return {
      fillReporteOrdProduccion: {
        nIdprod :"",
        dFecha: "",
      },
       listProd: [],
       listOrdenProduc:[],

      pageNumber: 0,
      perPage: 10,
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
    };
  },
  mounted() {
      this.getListarproductosByName();
  },

/*   computed: {
    pageCount() {
      let a = this.listOrdenProduc.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listarClientesPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listOrdenProduc.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listOrdenProduc.length,
        b = this.perPage;
      let pageCount = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];
      while (count < pageCount) {
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    },
  }, */
  methods: {

      SetGenerarreqMaterialesPDF(item){
 var config = { responseType: "blob" };
      var url = "/administracion/RequerimientoMateriales/setGenerarOrderPrduccionPdf";
      axios
        .post(
          url,
          {
            params: {
              idReqMatProduc: item,
            },
          },
          config
        )
        .then((response) => {
          console.log(response.data);
          var oMyBlob = new Blob([response.data], { type: "application/pdf" });
          var url = URL.createObjectURL(oMyBlob);
          window.open(url);
          //window.print();
        });
      },

   getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillReporteOrdProduccion.nIdprod,
          },
        })
        .then((response) => {
          this.listProd = response.data;
        });
    },

    limpiarListClientsBsq() {
      this.fillReporteOrdProduccion.cNombre = "";
      this.fillReporteOrdProduccion.cRuc = "";
        this.listOrdenProduc =[];

    },
    limpiarBandejaProveedor() {
      this.listOrdenProduc = [];
    },
    getListReportProduc() {
      var url = "/administracion/RequerimientoMateriales/list";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillReporteOrdProduccion.nIdprod,
            dFecha: this.fillReporteOrdProduccion.dFecha,
          },
        })
        .then((response) => {
               this.listOrdenProduc = response.data;
               console.log(response.data)

        });
    },

    nextPage() {
      this.pageNumber++;
    },
    prevPage() {
      this.pageNumber--;
    },
    selectPage(page) {
      this.pageNumber = page;
    },
    inicializarPAginacion() {
      this.pageNumber = 0;
    },
  },
};
</script>

<style>
</style>
