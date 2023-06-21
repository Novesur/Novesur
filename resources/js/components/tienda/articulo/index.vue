<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Articulos</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <template
              v-if="listRolPermisoByUsuario.includes('productos.crear')"
            >
              <router-link class="btn btn-info btn-sm" :to="'/articulo/create'">
                <i class="fas fa-plus-square">Nuevo Articulo</i>
              </router-link>
            </template>
          </div>
        </div>

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterios de busqueda</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                       <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Articulo</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillBsqArticulo.cNombre"
                          />
                        </div>
                      </div>
                    </div>

                  <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Tipo</label>
                        <div class="col-md-9">
                          <el-select
                            v-model="fillBsqArticulo.nidTipo"
                            filterable
                            placeholder="Seleccione una Estado"
                            clearable
                            :style="{ width: '350px' }"
                          >
                            <el-option
                              v-for="item in listTipo"
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


                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Categoria</label>
                        <div class="col-md-9">
                          <el-select
                            v-model="fillBsqArticulo.nidcatArt"
                            filterable
                            placeholder="Seleccione una Estado"
                            clearable
                            :style="{ width: '350px' }"
                          >
                            <el-option
                              v-for="item in listCatArt"
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
                      @click.prevent="getListarArticulo"
                    >
                      Buscar
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

              <div class="card card-info">
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
                      :class="page == pageNumber ? 'active' : ''"
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

                <div class="card-header">
                  <h3 class="card-title">Bandeja de Resultados</h3>
                </div>

                <div class="card-body table-responsive">
                  <table
                    class="table table-hover table-head-fixed text-nowrap projects"
                  >
                    <thead>
                      <tr>
                        <th>Imagen</th>
                        <th>Articulo</th>
                        <th>Tipo</th>
                        <th>Categoria</th>
                        <th>Descripcion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(item, index) in listarArticuloPaginated"
                        :key="index"
                      >
                        <td>
                            <li class="user-block" style="list-style:none">
                                <img :src= "item.file.path" class="profile-avatar-img img-fluid img-circle">
                            </li>

                        </td>
                        <td v-text="item.nombre"></td>
                        <td v-text="item.tipo.nombre" ></td>
                        <td v-text="item.catarticulo.nombre" ></td>
                        <td v-text="item.descripcion" ></td>
                        <td ></td>
                        <td ></td>

                        <td>
                          <router-link
                            class="btn btn-info btn-sm"
                            :to="{
                              name: 'articulo.editar',
                              params: { id: item.id },
                            }"
                          >
                            <i class="fas fa-pencil-alt"></i> Editar
                          </router-link>


                        </td>
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
                        :class="page == pageNumber ? 'active' : ''"
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillBsqArticulo: {
        cNombre: "",
        nidTipo: "",
        nidcatArt: "",
      },
      listTipo: [],
      listCatArt: [],
      pageNumber: 0,
      perPage: 10,
      listArticulos: [],
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
    };
  },
  mounted() {
    this.getListarTipo()
    this.getListarCatArticulo();
  },
  computed: {
    pageCount() {
      let a = this.listArticulos.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listarArticuloPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listArticulos.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listArticulos.length,
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

          getListarCatArticulo() {
      var url = "/administracion/catart/index";
      axios.get(url).then((response) => {
        this.listCatArt = response.data;
        //this.fillBsqArticulo.nidcatArt = this.listCatArt[0].id;
      });
    },

          getListarTipo() {
      var url = "/administracion/tipo/create";
      axios.get(url).then((response) => {
        this.listTipo = response.data;
        //this.fillBsqArticulo.nidTipo = this.listTipo[0].id;
      });
    },
    LimpiarProductoBsq() {
      this.fillBsqArticulo.nIdFamilia = "";
      this.fillBsqArticulo.nIdSubFamilia = "";
      this.fillBsqArticulo.nIdMarca = "";
      this.fillBsqArticulo.nIdMaterial = "";
      this.fillBsqArticulo.nIdEstado = "";
    },



    getListarArticulo() {
      var url = "/administracion/articulo/index";
      axios
        .get(url, {
          params: {
            cNombre: this.fillBsqArticulo.cNombre,
            nidTipo: this.fillBsqArticulo.nidTipo,
            nidcatArt: this.fillBsqArticulo.nidcatArt,

          },
        })
        .then((response) => {
          this.inicializarPaginacion();
          this.listArticulos = response.data;
        });
    },

    limpiarBandejaProductos() {
      this.listArticulos = [];
    },

    inicializarPaginacion() {
      this.pageNumber = 0;
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
  },
};
</script>

<style>
</style>
