<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Crear Platos</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Registrar Plato Entrada</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearPlato.cNomEntrada"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="btn-group offset-4">
                  <button
                    class="btn btn-flat btn-info btnWidth float-left"
                    @click.prevent="setValidarPEntrada()"
                    style="margin-right: 5px"
                  >
                    Registrar
                  </button>
                  <button
                    class="btn btn-flat btn-success btnWidth"
                    @click.prevent="setBuscarPEntrada"
                    style="margin-right: 5px"
                  >
                    Buscar
                  </button>
                  <button
                    class="btn btn-flat btn-default btnWidth float-right"
                    @click.prevent="limpiarPEntrada"
                  >
                    Limpiar
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Listado de Platos de Entrada</h3>
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
                    v-for="(item, index) in listPEntradaPaginated"
                    :key="index"
                  >
                    <td v-text="item.nombre"></td>
                    <td>
                      <button
                        class="btn btn-info btn-sm"
                        @click.prevent="abrirModalmenu(item.id, (tipo = 'ent'))"
                      >
                        <i class="fas fa-pencil-alt"></i>Editar
                      </button>

                      <button
                        class="btn btn-danger btn-sm"
                        @click.prevent="DeletePlatoEntrada(item.id)"
                      >
                        <i class="fas fa-trash"></i>Eliminar
                      </button>
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
                    v-for="(page, index) in pagesListPEntrada"
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

      <!--   Menu Segundo -->

      <div class="card">
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Registrar Plato Segundo</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearPlato.cNomSegundo"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="btn-group offset-4">
                  <button
                    class="btn btn-flat btn-info btnWidth float-left"
                    @click.prevent="setValidarPSegundo"
                    style="margin-right: 5px"
                  >
                    Registrar
                  </button>
                  <button
                    class="btn btn-flat btn-success btnWidth"
                    @click.prevent="setBuscarPSegundo"
                    style="margin-right: 5px"
                  >
                    Buscar
                  </button>
                  <button
                    class="btn btn-flat btn-default btnWidth float-right"
                    @click.prevent="limpiarPEntrada"
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
                    v-for="(item, index) in listarPSegundoPaginated"
                    :key="index"
                  >
                    <td v-text="item.nombre"></td>
                    <td>
                      <button
                        class="btn btn-info btn-sm"
                        @click.prevent="abrirModalmenu(item.id, (tipo = 'seg'))"
                      >
                        <i class="fas fa-pencil-alt"></i>Editar
                      </button>

                      <button
                        class="btn btn-danger btn-sm"
                        @click.prevent="DeletePlatoSegundo(item.id)"
                      >
                        <i class="fas fa-trash"></i>Eliminar
                      </button>
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
                    v-for="(page, index) in pagesListPSegundo"
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
      <!--   Fin del Menu Segundo -->

      <!--   Menu Extra -->

      <!-- <div class="card">
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Registrar Plato Extra</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearPlato.cNomExtra"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="btn-group offset-4">
                  <button
                    class="btn btn-flat btn-info btnWidth float-left"
                    @click.prevent="setValidarPExtra((tipo = 'reg'))"
                    style="margin-right: 5px"
                  >
                    Registrar
                  </button>
                  <button
                    class="btn btn-flat btn-success btnWidth"
                    @click.prevent="setBuscarPExtra"
                    style="margin-right: 5px"
                  >
                    Buscar
                  </button>
                  <button
                    class="btn btn-flat btn-default btnWidth float-right"
                    @click.prevent="limpiarPEntrada"
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
                    v-for="(item, index) in listarPExtraPaginated"
                    :key="index"
                  >
                    <td v-text="item.nombre"></td>
                    <td>
                      <button
                        class="btn btn-info btn-sm"
                        @click.prevent="abrirModalmenu(item.id, (tipo = 'ext'))"
                      >
                        <i class="fas fa-pencil-alt"></i>Editar
                      </button>

                      <button
                        class="btn btn-danger btn-sm"
                        @click.prevent="DeletePlatoExtra(item.id)"
                      >
                        <i class="fas fa-trash"></i>Eliminar
                      </button>
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
                    v-for="(page, index) in pagesListPExtra"
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
                  <li class="page-item" v-if="pageNumber < pageCountPExtra - 1">
                    <a href="#" class="page-link" @click.prevent="nextPage"
                      >Post</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div> -->
      <!--   Fin del Menu Extra -->



            <!--   Menu Dieta -->

            <div class="card">
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Registrar Plato Dieta</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearPlato.cNomDieta"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="btn-group offset-4">
                  <button
                    class="btn btn-flat btn-info btnWidth float-left"
                    @click.prevent="setValidarPDieta()"
                    style="margin-right: 5px"
                  >
                    Registrar
                  </button>
                  <button
                    class="btn btn-flat btn-success btnWidth"
                    @click.prevent="setBuscarPDieta"
                    style="margin-right: 5px"
                  >
                    Buscar
                  </button>
                  <button
                    class="btn btn-flat btn-default btnWidth float-right"
                    @click.prevent="limpiarPEntrada"
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
                    v-for="(item, index) in listarPDietaPaginated"
                    :key="index"
                  >
                    <td v-text="item.nombre"></td>
                    <td>
                      <button
                        class="btn btn-info btn-sm"
                        @click.prevent="abrirModalmenu(item.id, (tipo = 'diet'))"
                      >
                        <i class="fas fa-pencil-alt"></i>Editar
                      </button>

                      <button
                        class="btn btn-danger btn-sm"
                        @click.prevent="DeletePlatoDieta(item.id)"
                      >
                        <i class="fas fa-trash"></i>Eliminar
                      </button>
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
                    v-for="(page, index) in pagesListDieta"
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
                  <li class="page-item" v-if="pageNumber < pageCountDieta - 1">
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
      <!--   Fin del Menu Dieta -->

    </div>
    <div
      class="modal fade"
      :class="{ show: modalValidateShow }"
      :style="modalValidateShow ? mostrarModal : ocultarModal"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Sistemas Novesur</h5>
            <button class="close" @click="abrirModalValidacion"></button>
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
            <button class="btn btn-secondary" @click="abrirModalValidacion">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!--   <div
      class="modal fade"
      :class="{ show: modalShow }"
      :style="modalShow ? mostrarModal : ocultarModal"
    >
      <div class="modal-dialog" role="document"  >
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
          <div class="modal-footer" >
            <button class="btn btn-secondary" @click="abrirModal">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div> -->

    <div
      class="modal fade"
      :class="{ show: modalShow }"
      :style="modalShow ? mostrarModal : ocultarModal"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">EDITAR MENU</h5>
            <button class="close" @click="abrirModalmenu(id, tipo)"></button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-md-2 col-form-label">Nombre</label>
              <div class="col-md-9">
                <input
                  type="text"
                  class="form-control"
                  v-model="fillCrearPlato.cNomPlato"
                />
              </div>
            </div>
          </div>
          <!-- SI EL TIPO DE MENU ES PRIMERO  -->
          <div class="modal-footer" v-if="tipo == 'ent'">
            <button class="btn btn-primary" @click="EditEntrada()">
              Editar Entrada
            </button>

            <button class="btn btn-secondary" @click="abrirModalmenu(id, tipo)">
              Cerrar
            </button>
          </div>
          <!-- FIN DEL IF -->

          <!-- SI EL TIPO DE MENU ES SEGUNDO  -->
          <div class="modal-footer" v-if="tipo == 'seg'">
            <button class="btn btn-primary" @click="EditSegundo()">
              Editar Segundo
            </button>
            <button class="btn btn-secondary" @click="abrirModalmenu(id, tipo)">
              Cerrar
            </button>
          </div>
          <!-- FIN DEL IF -->

          <!-- SI EL TIPO DE MENU ES EXTRA  -->
          <div class="modal-footer" v-if="tipo == 'ext'">
            <button class="btn btn-primary" @click="EditExtra()">
              Editar Extra
            </button>
            <button class="btn btn-secondary" @click="abrirModalmenu(id, tipo)">
              Cerrar
            </button>
          </div>
          <!-- FIN DEL IF -->

            <!-- SI EL TIPO DE MENU ES DIETA  -->
            <div class="modal-footer" v-if="tipo == 'diet'">
            <button class="btn btn-primary" @click="EditDieta()">
              Editar Extra
            </button>
            <button class="btn btn-secondary" @click="abrirModalmenu(id, tipo)">
              Cerrar
            </button>
          </div>
          <!-- FIN DEL IF -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillCrearPlato: {
        cNomEntrada: "",
        cNomSegundo: "",
        cNomExtra: "",
        cNomPlato: "",
        cNomDieta : "",
      },
      listPEntrada: [],
      listPSegundo: [],
      listPExtra: [],
      listPDieta:[],
      pageNumber: 0,
      perPage: 10,
      tipo: "",
      id: "",

      modalShow: false,
      modalValidateShow: false,
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
  computed: {
    pageCount() {
      let a = this.listPEntrada.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    pageCountPSegundo() {
      let a = this.listPSegundo.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    pageCountPExtra() {
      let a = this.listPExtra.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    pageCountDieta() {
      let a = this.listPDieta.length,
        b = this.perPage;
      return Math.ceil(a / b);
    },
    listPEntradaPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listPEntrada.slice(inicio, fin);
    },
    listarPSegundoPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listPSegundo.slice(inicio, fin);
    },
    listarPExtraPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listPExtra.slice(inicio, fin);
    },

    listarPDietaPaginated() {
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listPDieta.slice(inicio, fin);
    },
    pagesListPEntrada() {
      let a = this.listPEntrada.length,
        b = this.perPage;
      let PageCount = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];

      while (count < PageCount) {
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    },

    pagesListPSegundo() {
      let a = this.listPSegundo.length,
        b = this.perPage;
      let PageCount = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];

      while (count < PageCount) {
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    },

    pagesListPExtra() {
      let a = this.listPExtra.length,
        b = this.perPage;
      let PageCount = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];

      while (count < PageCount) {
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    },
    pagesListDieta() {
      let a = this.listPDieta.length,
        b = this.perPage;
      let PageCount = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];

      while (count < PageCount) {
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    },


    
  },
  mounted() {
    /*    this.setBuscarPEntrada();
   this.setBuscarPSegundo();
   this.setBuscarPExtra(); */
    //Carga la fecha Actual
    /*  this.fillCrearPlato.dFecha = new Date(); */
  },
  methods: {
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    abrirModalValidacion() {
      this.modalValidateShow = !this.modalValidateShow;
    },

    abrirModalmenu(item, tipo) {
      this.modalShow = !this.modalShow;

      var url = "/administracion/Plato/getDataPlato";
      axios
        .post(url, {
          item,
          tipo,
        })
        .then((response) => {
          this.fillCrearPlato.cNomPlato = response.data.nombre;
          localStorage.Codigo = item;
        });
    },
    EditEntrada() {
      var url = "/administracion/Plato/EditPlatoEntrada";
      axios
        .post(url, {
          item: localStorage.Codigo,
          cNomPlato: this.fillCrearPlato.cNomPlato,
        })
        .then(() => {
          this.fillCrearPlato.cNomPlato = "";
          this.setBuscarPEntrada();
          this.modalShow = !this.modalShow;
          localStorage.removeItem(Codigo);
        });
    },

    EditSegundo() {
      var url = "/administracion/Plato/EditPlatoSegundo";
      axios
        .post(url, {
          item: localStorage.Codigo,
          cNomPlato: this.fillCrearPlato.cNomPlato,
        })
        .then(() => {
          this.fillCrearPlato.cNomPlato = "";
          this.setBuscarPSegundo();
          this.modalShow = !this.modalShow;
          localStorage.removeItem(Codigo);
        });
    },
    EditExtra() {
      var url = "/administracion/Plato/EditExtra";
      axios
        .post(url, {
          item: localStorage.Codigo,
          cNomPlato: this.fillCrearPlato.cNomPlato,
        })
        .then(() => {
          this.fillCrearPlato.cNomPlato = "";
          this.setBuscarPExtra();
          this.modalShow = !this.modalShow;
          localStorage.removeItem(Codigo);
        });
    },

    EditDieta(){
      var url = "/administracion/Plato/EditDieta"; 
      axios
        .post(url, {
          item: localStorage.Codigo,
          cNomPlato: this.fillCrearPlato.cNomPlato,
        })
        .then(() => {
          this.fillCrearPlato.cNomPlato = "";
          this.setBuscarPDieta();
          this.modalShow = !this.modalShow;
          localStorage.removeItem(Codigo);
        });
    },

    DeletePlatoEntrada(item) {
   
      Swal.fire({
        title: "Desea anular el plato de Entrada?",
        text: "Si elimina este plato tambien eliminara los menus que esten con este plato posteriormente",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Anulalo",
        cancelButtonText: "No, cancelo!",
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/Plato/DeletePlatoEntrada";
          axios
            .post(url, {
              item,
            })
            .then(() => {
              this.setBuscarPEntrada();
            });
          swalWithBootstrapButtons.fire(
            "Anulado!",
            "El Plato fue Anulado.",
            "success"
          );
        }
      });
    },

    DeletePlatoExtra(item) {
      Swal.fire({
        title: "Desea anular el plato de Extra?",
        text: "Si elimina este plato tambien eliminara los menus que esten con este plato posteriormente",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Anulalo",
        cancelButtonText: "No, cancelo!",
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/Plato/DeletePlatoExtra";
          axios
            .post(url, {
              item,
            })
            .then(() => {
              this.setBuscarPExtra();
            });
          swalWithBootstrapButtons.fire(
            "Anulado!",
            "El Plato fue Anulado.",
            "success"
          );
        }
      });
    },

    DeletePlatoSegundo(item) {
      Swal.fire({
        title: "Desea anular el plato Segundo?",
        text: "Si elimina este plato tambien eliminara los menus que esten con este plato posteriormente",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Anulalo",
        cancelButtonText: "No, cancelo!",
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/Plato/DeletePlatoSegundo";
          axios
            .post(url, {
              item,
            })
            .then(() => {
              this.setBuscarPSegundo();
            });
          swalWithBootstrapButtons.fire(
            "Anulado!",
            "El Plato fue Anulado.",
            "success"
          );
        }
      });
    },

    DeletePlatoDieta(item){
      Swal.fire({
        title: "Desea anular el plato Dieta?",
        text: "Si elimina este plato tambien eliminara los menus que esten con este plato posteriormente",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Anulalo",
        cancelButtonText: "No, cancelo!",
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/Plato/DeletePlatoDieta";
          axios
            .post(url, {
              item,
            })
            .then(() => {
              this.setBuscarPDieta();
            });
          swalWithBootstrapButtons.fire(
            "Anulado!",
            "El Plato fue Anulado.",
            "success"
          );
        }
      });
    },

    limpiarPEntrada() {
      this.fillCrearPlato.cNomEntrada = "";
    },
    limpiarPSegundo() {
      this.fillCrearPlato.cNomSegundo = "";
    },
    limpiarPExtra() {
      this.fillCrearPlato.cNomExtra = "";
    },

    setGuardarPEntrada() {
      var url = "/administracion/Plato/CrearPlatoEntrada";
      axios
        .post(url, {
          cNomEntrada: this.fillCrearPlato.cNomEntrada,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });
          this.fillCrearPlato.cNomEntrada = "";
          this.setBuscarPEntrada();
        });
    },

    setGuardarDieta(){
      var url = "/administracion/Plato/CrearPlatoDieta";
      axios
        .post(url, {
          cNomDieta: this.fillCrearPlato.cNomDieta,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });
          this.fillCrearPlato.cNomDieta = "";
          //this.setBuscarPEntrada();
          this.setBuscarPDieta();
        });

    },
    setValidarPEntrada() {
      if (this.validarRegistrarPEntrada()) {
        this.modalValidateShow = true;

        return;
      }
      this.setGuardarPEntrada();
    },

    setValidarPDieta(){
      if (this.validarRegistrarDieta()) {
        this.modalValidateShow = true;

        return;
      }
      this.setGuardarDieta();
    },

    setValidarPSegundo() {
      if (this.validarRegistrarPSegundo()) {
        this.modalValidateShow = true;
        return;
      }
      this.setGuardarPSegundo();
    },

    setValidarPExtra() {
      if (this.validarRegistrarPExtra()) {
        this.modalValidateShow = true;
        return;
      }
      this.setGuardarPExtra();
    },

    validarRegistrarPEntrada() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearPlato.cNomEntrada) {
        this.mensajeError.push("Ingrese Plato de Entrada");
      }
      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },

    validarRegistrarDieta(){
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearPlato.cNomDieta) {
        this.mensajeError.push("Ingrese Plato de Dieta");
      }
      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },

    validarRegistrarPSegundo() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearPlato.cNomSegundo) {
        this.mensajeError.push("Ingrese Plato de Segundo");
      }
      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },

    validarRegistrarPExtra() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearPlato.cNomExtra) {
        this.mensajeError.push("Ingrese Plato Extra");
      }
      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },

    setBuscarPEntrada() {
      var url = "/administracion/Plato/getListarPEntrada";
      axios
        .get(url, {
          params: {
            cNombre: this.fillCrearPlato.cNomEntrada,
          },
        })
        .then((response) => {
          this.inicializarPaginacion();
          this.listPEntrada = response.data;
        });
    },

    setBuscarPSegundo() {
      var url = "/administracion/Plato/getListarPSegundo";
      axios
        .get(url, {
          params: {
            cNombre: this.fillCrearPlato.cNomSegundo,
          },
        })
        .then((response) => {
          this.inicializarPaginacion();
          this.listPSegundo = response.data;
        });
    },

    setBuscarPExtra() {
      var url = "/administracion/Plato/getListarPExtra";
      axios
        .get(url, {
          params: {
            cNombre: this.fillCrearPlato.cNomExtra,
          },
        })
        .then((response) => {
          this.inicializarPaginacion();
          this.listPExtra = response.data;
        });
    },
    setGuardarPSegundo() {
      var url = "/administracion/Plato/CrearPlatoSegundo";
      axios
        .post(url, {
          cNomSegundo: this.fillCrearPlato.cNomSegundo,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });
          this.fillCrearPlato.cNomSegundo = "";
          this.setBuscarPSegundo();
        });
    },

    setGuardarPExtra() {
      var url = "/administracion/Plato/CrearPlatoExtra";
      axios
        .post(url, {
          cNomExtra: this.fillCrearPlato.cNomExtra,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });
          this.fillCrearPlato.cNomExtra = "";
          this.setBuscarPDieta();
          //this.$router.push("/proveedor");
        });
    },

    setBuscarPDieta(){
      var url = "/administracion/Plato/getListarPDieta";
      axios
        .get(url, {
          params: {
            cNomDieta: this.fillCrearPlato.cNomDieta,
          },
        })
        .then((response) => {
          this.inicializarPaginacion();
          this.listPDieta = response.data;
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
    inicializarPaginacion() {
      this.pageNumber = 0;
    },
  },
};
</script>

<style>
</style>
