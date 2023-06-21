<template>
    <div>
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Cargo</h1>
            </div>
          </div>
        </div>
      </div>
  
      <div class="content container-fluid">
        <div class="card">
          <div class="card-header">
          <div class="card-tools">
              <router-link class="btn btn-info btn-sm" :to="'/cargo/create'">
                <i class="fas fa-plus-square"></i>Nuevo
              </router-link>
  
                 <button
                        class="btn  btn-success btn-sm "
                        @click.prevent="getExcelMarca"
                      >
                      <span><i class="fas fa-file-excel"></i> EXCEL</span>
                      </button>
            </div> 
          </div>
  
          <div class="card-body">
            <div class="container-fluid">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Criterios de Busqueda</h3>
                </div>
                <div class="card-body">
                  <form role="form">
                    <div class="col-md- offset-3">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nombre</label>
                            <div class="col-md-9">
                              <input
                                type="text"
                                class="form-control"
                                v-model="fillBsqMarca.cNombre" @keypress.enter.prevent="getListarCargos"
                              />
                            </div>
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
                        @click.prevent="getListarCargos"
                      >
                        Buscar
                      </button>
                      <button
                        class="btn btn-flat btn-default btnWidth"
                        @click.prevent="limpiarMarcaBsq"
                      >
                        Limpiar
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Bandeja de Entrada</h3>
                </div>
                <div class="card-body table-responsive">
                  <table
                    class="table table-hover table-head-fixed text-nowrap projects"
                  >
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(item, index) in listarCargosPaginated"
                        :key="index"
                      >
                        <td v-text="item.nombre"></td>
                        <td>
                          <router-link class="btn btn-info btn-sm" :to="{name:'cargo.edit', params:{id: item.id}}">
                            <i class="fas fa-pencil-alt"></i>Editar
                          </router-link>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                      <li class="page-item" v-if="pageNumber > 0">
                        <a href="#" class="page-link" @click.prevent="prevPage"
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
                          href="#"
                          class="page-link"
                          @click.prevent="selectPage(page)"
                          >{{ page + 1 }}</a
                        >
                      </li>
                      <li class="page-item" v-if="pageNumber < pageCount - 1">
                        <a href="#" class="page-link" @click.prevent="nextPage"
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
        fillBsqMarca: {
          cNombre: "",
        },
        listCargos: [],
        pageNumber: 0,
        perPage: 10,
      };
    },
    computed: {
      pageCount() {
        let a = this.listCargos.length,
          b = this.perPage;
        return Math.ceil(a / b);
      },
      listarCargosPaginated() {
        let inicio = this.pageNumber * this.perPage,
          fin = inicio + this.perPage;
        return this.listCargos.slice(inicio, fin);
      },
      pagesList() {
        let a = this.listCargos.length,
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
      limpiarMarcaBsq() {
        this.fillBsqMarca.cNombre = "";
      },
      limpiarBandejaMarca() {
        this.listCargos = [];
      },
      getListarCargos() {
        var url = "/administracion/cargo/index";
        axios
          .get(url, {
            params: {
              cNombre: this.fillBsqMarca.cNombre,
            },
          })
          .then((response) => {
              this.inicializarPaginacion();
            this.listCargos = response.data;
          });
      },
      getExcelMarca(){
            var url = "/operacion/marcas/export";
        axios
          .post(
            url,
            {
              params: { listCargos: JSON.stringify(this.listCargos) },
            },
            { responseType: "blob" }
          )
          .then((response) => {
            FileSaver.saveAs(response.data, "Marcas.xlsx");
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
      inicializarPaginacion(){
          this.pageNumber = 0;
      }
    },
  };
  </script>
  
  <style>
  </style>
  