<template>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Informe de Valorización - Proyecto</h1>
          </div>
        </div>
      </div>
  
      <div class="content container-fluid">
        <div class="card">
          <div class="card-header">
            <div class="card-tools">
              <template
                v-if="listRolPermisoByUsuario.includes('create.clientes')"
              >
                <router-link class="btn btn-info btn-sm" :to="'/proyecto_ReqMateriales/create'">
                  <i class="fas fa-plus-square"></i> Requerimientos de Materiales
                </router-link>
              </template>
  
              <template v-if="listRolPermisoByUsuario.includes('cliente.Excel')">
                <button
                  class="btn btn-success btn-sm"
                  @click.prevent="getExcelPReqMat"
                >
                  <span><i class="fas fa-file-excel"></i> EXCEL</span>
                </button>
              </template>
            </div>
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
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >Fecha</label
                          >
                          <div class="col-md-6">
                            <el-date-picker
                                v-model="fillBPInfValor.cFecha"
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
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Nro: O/S</label>
                          <div class="col-md-7">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillBPInfValor.cServicio"
                              :maxlength="11"
                              @keyup.enter="getListarPReqMateriales"
                            />
                          </div>
                        </div>
                      </div>
                      <template
                        v-if="listRolPermisoByUsuario.includes('consulta.ventas')"
                      >
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                              >Proyecto</label
                            >
                            <div class="col-md-6">
                              <el-select
                                v-model="fillBPInfValor.nIdProyecto"
                                style="width: 100%"
                                filterable
                                placeholder="Select"
                                clearable
                              >
                                <el-option
                                  v-for="item in listCCostos"
                                  :key="item.id"
                                  :label="
                                      item.codigo +
                                          ' - ' +
                                          item.nombre"
                                  :value="item.id"
                                >
                                </el-option>
                              </el-select>
                            </div>
                          </div>
                        </div>
                      </template>
                    </div>
                  </form>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-4 offset-4">
                      <button
                        class="btn btn-flat btn-info btnWidth"
                        @click.prevent="getListarPReqMateriales"
                      >
                        Buscar
                      </button>
                      <button
                        class="btn btn-flat btn-default btnWidth"
                        @click.prevent="limpiarProveedorBsq"
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
                        <th>Fecha</th>
                        <th>Codigo</th>
                        <th>Nombre Proyecto</th>
                        <th>Cliente</th>
                        <th>Detalle Servicio</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Final</th>
                        <th>O/S  Nro</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(item, index) in listarClientesPaginated"
                        :key="index"
                      >
             <!--       <td>
                          <template
                            v-if="
                              listRolPermisoByUsuario.includes(
                                'cotizacion.create'
                              )
                            "
                          >
                            <router-link
                              class="btn btn-success btn-sm"
                              :to="{
                                name: 'cotizacion.create',
                                params: { id: item.id },
                              }"
                            >
                              <i class="far fa-clipboard"></i> Cotizar
                            </router-link>
                          </template>
                        </td>
  
                        <template
                          v-if="
                            listRolPermisoByUsuario.includes('cliente.editar')
                          "
                        >
                          <td>
                            <router-link
                              class="btn btn-info btn-sm"
                              :to="{
                                name: 'cliente.editar',
                                params: { id: item.id },
                              }"
                            >
                              <i class="fas fa-pencil-alt"></i>Editar
                            </router-link>
                          </td> 
                        </template> -->
                   
  
                        <td v-text="item.fecha"></td>
                        <td v-text="item.codigo"></td>
                        <td v-text="item.ccostos.nombre"></td>
                        <td v-text="item.cliente"></td>
                        <td v-text="item.detservicio"></td>
                        <td v-text="item.fechainicio"></td>
                        <td v-text="item.fechafinal"></td>
                        <td v-text="item.ord_servicio"></td>
                        <td>     <button
                                class="btn btn-danger btn-sm"
                                @click.prevent="
                                  SetGenerarPreqMaterialesPDF(item.id)
                                "
                              >
                                <i class="fas fa-file-pdf"></i> PDF
                              </button></td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="card-footer clearfix">
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
  import FileSaver from "file-saver";
  export default {
    data() {
      return {
        fillBPInfValor: {
          cServicio: "",
          cFecha: "",
          nIdProyecto: "",
        },
        listPInfoValorizacion: [],
        listCCostos: [],
        listRolPermisoByUsuario: JSON.parse(
          sessionStorage.getItem("listRolPermisosByUsuario")
        ),
        pageNumber: 0,
        perPage: 50,
        listRolPermisoByUsuario: JSON.parse(
          sessionStorage.getItem("listRolPermisosByUsuario")
        ),
      };
    },
    mounted() {
      this.getlistCcostos();
    },
  
    computed: {
      pageCount() {
        let a = this.listPInfoValorizacion.length, 
          b = this.perPage;
        return Math.ceil(a / b);
      },
      listarClientesPaginated() {
        let inicio = this.pageNumber * this.perPage,
          fin = inicio + this.perPage;
        return this.listPInfoValorizacion.slice(inicio, fin);
      },
      pagesList() {
        let a = this.listPInfoValorizacion.length,
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
    },
    methods: {
      getlistCcostos() {
        var url = "/administracion/CentroCostos/list";
        axios.get(url).then((response) => {
          this.listCCostos = response.data;
        });
   
      },
      limpiarProveedorBsq() {
        this.fillBPInfValor.cNombre = "";
        this.fillBPInfValor.cRuc = "";
      },
      limpiarBandejaProveedor() {
        this.listPInfoValorizacion = [];
      },
      getListarPReqMateriales() {
        var url = "/administracion/InformeValorizacion/index"; 
        axios
          .get(url, {
            params: {
              cServicio: this.fillBPInfValor.cServicio,
              cFecha: this.fillBPInfValor.cFecha,
              nIdProyecto: this.fillBPInfValor.nIdProyecto,
            },
          })
          .then((response) => {
            console.log(response.data)
            //this.inicializarPAginacion();
            this.listPInfoValorizacion = response.data; 
          });
      },
  
      getExcelPReqMat() {
        var url = "/operacion/InformeValorizacion/export"; 
        axios
          .post(
            url,
            {
              params: { listPInfoValorizacion: JSON.stringify(this.listPInfoValorizacion) },
            },
            { responseType: "blob" }
          )
          .then((response) => {
            FileSaver.saveAs(response.data, "PReqMateriales.xlsx");
          });
      },
  
      SetGenerarPreqMaterialesPDF(id){
        var config = { responseType: "blob" };
      var url = "/administracion/InformeValorizacion/setGenerarInfoValorizacionPdf";
      axios
        .post(
          url,
          {
            params: {
            id
            },
          },
          config
        )
        .then((response) => {
          var oMyBlob = new Blob([response.data], { type: "application/pdf" });
          var url = URL.createObjectURL(oMyBlob);
          window.open(url);
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
  