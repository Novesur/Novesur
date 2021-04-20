<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tipo Articulo</h1>
          </div>
        </div>

        <div class="conten container-fluid">
          <div class="card">
            <div class="card-header">
              <div class="card-tools">
                <router-link
                  class="btn btn-info btn-sm"
                  :to="'/tipo/create'"
                >
                  <i class="fa fa-plus-square"></i>Nuevo
                </router-link>
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
                      <div class="row">
                        <div class="col-md-6 offset-3">
                          <div class="col-md-12">



                            <div class="form-group row">
                              <label class="col-md-3 col-form-label"
                                >Tipo</label
                              >
                              <div class="col-md-6">
                                <input
                                  type="text"
                                  class="form control"
                                  style="width: 410px"
                                  @keydown.enter.prevent="getListarTipo"
                                  v-model="fillBsqTipo.cNombre"
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
                          @click.prevent="getListarTipo"
                        >
                          Buscar
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

                  <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Bandeja de Resultados</h3>
                    </div>
                    <div class="card-body table-responsive">
                      <table
                        class="table table-hover table-head-fixed text-nowrap projects"
                      >
                        <thead>
                          <th>Tipo</th>
                          <th>Acciones</th>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(item, index) in listarSubfamiliaPaginated"
                            :key="index"
                          >
                            <td v-text="item.nombre"></td>
                            <td>
                              <router-link
                                class="btn btn-info btn-sm"
                                :to="{
                                  name: 'tipo.edit',
                                  params: { id: item.id },
                                }"
                              >
                                <i class="fas fa-pencil-alt"></i>Editar
                              </router-link>
                            </td>
                          </tr>
                        </tbody>
                      </table>

                      <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                          <li class="page-item" v-if="pageNumber > 0">
                            <a href="#" class="page-link" @click.prevent="prevPage">Ant</a
>
                          </li>
                          <li
                            class="page-item"
                            v-for="(page, index) in pagesList"
                            :key="index"
                             :class="page == pageNumber ? 'active' : ''"
                          >
                            <a
                              href="#"
                              class="page-link"
                              @click.prevent="SelectPage(page)"
                              >{{ page + 1 }}</a
                            >
                          </li>
                          <li
                            class="page-item"
                            v-if="pageNumber < pageCount - 1"
                          >
                            <a
                              href="#"
                              class="page-link"
                              @click.prevent="nextPage"
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
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillBsqTipo: {
        cNombre: "",
      },
      listTipo: [],
      pageNumber: 0,
      perPage: 10,
    };
  },

  computed: {
    pageCount() {
      let a = this.listTipo.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listarSubfamiliaPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listTipo.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listTipo.length,
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
    limpiarCriteriosBsq() {
      this.fillBsqTipo.cNombre = "";
    },
    LimpiarBandejaSubfamilia() {
      this.listTipo = [];
    },
    getListarTipo() {
      var url = "/administracion/tipo/index";
      axios
        .get(url, {
          params: {
            cNombre: this.fillBsqTipo.cNombre,
          },
        })
        .then((response) => {
          this.InicializarPaginacion();
          this.listTipo = response.data;

        });
    },

    nextPage() {
      this.pageNumber++;
    },
    prevPage() {
      this.pageNumber--;
    },
    SelectPage(page) {
      this.pageNumber = page;
    },
    InicializarPaginacion() {
      this.pageNumber = 0;
    },
  },
};
</script>

<style>
</style>
