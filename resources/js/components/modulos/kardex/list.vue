<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Listado por Kardex</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
              <template v-if="listRolPermisoByUsuario.includes('productos.crear')">
            <button class="btn btn-info btn-sm" @click="$router.go(-1)" >
              <i class="fas fa-undo-alt"> Regresar</i>
            </button>
              </template>
          </div>
        </div>

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">

              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Bandeja de Resultados</h3>
                </div>

                <div class="card-body table-responsive">
                  <table
                    class="table table-hover table-head-fixed text-nowrap projects"
                  >
                    <thead>
                      <tr>
                        <th>Fecha</th>
                        <th>Nro Factura</th>
                        <th>Nro Guia</th>
                        <th>Proveedor</th>
                         <th>Cliente</th>
                        <th>Motivo</th>
                        <th>Unid. Medida</th>
                        <th>Cantidad</th>
                        <th>Costo Unit.</th>
                        <th>Movimiento</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(item, index) in listarXKardex"
                        :key="index"
                      >

                        <td>{{ item.fecha | moment("DD - MM - Y") }}</td>
                         <td v-text="item.FactNo"></td>
                        <td v-text="item.GuiaNo"></td>
                        <td v-text="item.proveedor.nombre"></td>
                        <td v-text="item.cliente.razonsocial"></td>
                        <td v-text="item.motivo.nombre"></td>
                        <td>{{ item.unidmedida.nombre }}</td>
                        <td v-text="item.cantidad"></td>
                        <td v-text="item.costunit"></td>
                        <td v-text="item.movimiento.nombre"></td>

                        <td>
                            <router-link class="btn btn-info btn-sm" :to="{name:'detallekardex.edit' , params:{id:item.id}} ">
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
      fillListKardex: {
        nidKardex: this.$attrs.id,
      },
      pageNumber: 0,
      perPage: 5,
      listDetKardex: [],
        listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
    };
  },
  mounted() {
this.getListarXKardex();
  },
  computed: {
    pageCount() {
      let a = this.listDetKardex.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listarXKardex() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listDetKardex.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listDetKardex.length,
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

    getListarXKardex() {
      var url = "/administracion/KardexDetalle/getListarXKardex";
      axios
        .get(url, {
          params: {
            nidKardex: this.fillListKardex.nidKardex,
          },
        })
        .then((response) => {
          //this.inicializarPaginacion();
          this.listDetKardex = response.data;
          console.log(response.data);


        });
    },



    limpiarBandejaProductos() {
      this.listDetKardex = [];
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
