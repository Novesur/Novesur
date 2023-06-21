<template>
    <div>
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Listado Nota de Pedido</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="content container-fluid">
        <div class="card">
          <div class="card-header">
            <div class="card-tools">
              <router-link class="btn btn-info btn-sm" :to="'/cotizacion/index'">
                <i class="fas fa-plus-square"></i>Regresar
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
                  <el-tabs v-model="activeName">
                
                    <!-- BUSCAR POR FECHA -->
  
                   
                      <form role="form">
                       
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-md-2 col-form-label"
                                    >Fecha</label
                                  >
                                  <el-date-picker
                                    v-model="fillListNotaPedido.dFecha"
                                    type="daterange"
                                    range-separator="To"
                                    start-placeholder="Start date"
                                    end-placeholder="End date"
                                    value-format="yyyy-MM-dd"
                                    clearable
                                    :style="{ width: '630px', height: '38px' }"
                                  >
                                  </el-date-picker>
                                </div>
                              </div>
                              <span
                                ><button
                                  class="btn btn-flat btn-info"
                                  @click.prevent="getlistNotaPedidoList"
                                >
                                  Buscar
                                </button></span
                              >
  
                              <div class="col">
                                <template
                                  v-if="
                                    listRolPermisoByUsuario.includes(
                                      'cliente.Excel'
                                    )
                                  "
                                >
                                <!--   <button
                                    class="btn btn-flat btn-danger"
                                    @click.prevent="getExcelCotizacionFecha"
                                  >
                                    <span
                                      ><i class="far fa-file-pdf"></i>
                                      PDF</span
                                    >
                                  </button> -->
                                </template>
                              </div>
                            </div>
                          </div>


                          
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-md-1 col-form-label"
                                >Nro Nota</label
                              >
                              <div class="col-md-3">
                                <input
                              type="text"
                              class="form-control"
                              v-model="fillListNotaPedido.cNroNota"
                              @keypress.enter.prevent="setRegistrarMarca"
                            />
                              </div>
                
                            </div>
                          </div>

                          
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-md-1 col-form-label"
                                >Razon Social</label
                              >
                              <div class="col-md-9">
                                <el-select
                                  v-model="fillListNotaPedido.nIdRSocial"
                                  style="width: 100%"
                                  filterable
                                  placeholder="Select"
                                  clearable
                                >
                                  <el-option
                                    v-for="item in listCliente"
                                    :key="item.id"
                                    :label="item.razonsocial "
                                    :value="item.id"
                                  >
                                  </el-option>
                                </el-select>
                              </div>
                
                            </div>
                          </div>
  
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-md-1 col-form-label"
                                >Vendedor</label
                              >
                              <div class="col-md-9">
                                <el-select
                                  v-model="fillListNotaPedido.nIdUser"
                                  style="width: 100%"
                                  filterable
                                  placeholder="Select"
                                  clearable
                                >
                                  <el-option
                                    v-for="item in listVendedor"
                                    :key="item.id"
                                    :label="
                                      item.firstname +
                                      ' ' +
                                      item.secondname +
                                      ' ' +
                                      item.lastname
                                    "
                                    :value="item.id"
                                    
                                  >
                                  </el-option>
                                </el-select>
                              </div>
                
                            </div>
                          </div>
                        
                      </form>
  
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
                                <th>Nro</th>
                                <th>Cotizacion</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th>Acción</th>
                              
                              </tr>
                            </thead>
                            <tbody>
                              <tr
                                v-for="(
                                  item, index
                                ) in listNotPedidoPaginatedbyDate"
                                :key="index"
                              >
                                <td> {{ item.codigo }}</td>
                                <td>{{item.cotizacion.codigo}}</td>
                                <td>
                                  {{ item.fecha | moment("DD - MM - Y") }}
                                </td>
                                 <td v-text="item.cliente.razonsocial"></td>
                                 <td v-text="item.vendedor[0].fullname"></td>
                                 <td>
                                    <button
                          class="btn btn-primary btn-sm"
                          @click="abrirModal(item.id)"
                        >
                          <i class="far fa-eye"></i> Detalle
                        </button>

                        <button
                          @click.prevent="getPdfNotaPedido(item.id)"
                          class="btn btn-danger btn-sm"
                        >
                          <span><i class="far fa-file-pdf"></i></span> PDF
                        </button>
                                 </td>
                      
                              </tr>
                            </tbody>
                          </table>
                          <div class="card-footer">
                            <ul class="pagination pagination-sm m-0 float-right">
                              <li class="page-item" v-if="pageNumber > 0">
                                <a
                                  href="#"
                                  class="page-link"
                                  @click.prevent="prevPage"
                                  >Ant</a
                                >
                              </li>
                              <li
                                class="page-item"
                                v-for="(page, index) in pagesListByDate"
                                :key="index"
                                :class="page == pageNumber ? 'active' : ''"
                              >
                                <a
                                  href="#"
                                  class="page-link"
                                  @click.prevent="selectPage(page)"
                                >
                                  {{ page + 1 }}</a
                                >
                              </li>
                              <li
                                class="page-item"
                                v-if="pageNumber < pageCountByDate - 1"
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
                 
                  </el-tabs>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


     <!--  MODAL NOTA DE PEDIDO -->

     <div
      class="modal fade"
      :class="{ show: modalShow }"
      :style="modalShow ? mostrarModal : ocultarModal"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              Nota de Pedido #
              {{ this.fillListNotaPedido.itemid | fourchar }}
            </h5>

            <button class="close" @click="abrirModal(item.id)"></button>
          </div>
          <div class="modal-body">
            <!-- Listado de Detalle de Cotizaciones -->

            <div class="card-body table-responsive">
              <table
                class="table table-hover table-head-fixed text-nowrap projects"
              >

                  
                <thead>
                  <tr>
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th>Accion</th>
            
                   
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in listDetPedido" :key="index">
                    <td v-text="item.cantidad"></td>
                    <td
                      v-text="
                        item.producto.familia.nombre +
                        ',' +
                        item.producto.subfamilia.nombre +
                        ', MODELO :' +
                        item.producto.modelotipo.nombre +
                        ', MATERIAL :' +
                        item.producto.material.nombre +
                        ', MARCA :' +
                        item.producto.marca.nombre
                      "
                    ></td>

                    <button
                            class="btn btn-primary"
                            @click="setEditarCantidad(item.id, item.cantidad)"
                          >
                            <span><i class="far fa-edit"></i></span>
                            Editar
                          </button>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" @click="abrirModal">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- FIN DEL MODAL NOTA DE PEDIDO -->
  
 
    </div>
  </template>
  
  <script>
  import FileSaver from "file-saver";
  export default {
    data() {
      return {
        fillListNotaPedido: {
          cNroNota: "",
          itemid: "",
          dFecha: "",
          nIdtEstadoCoti: "",
          nIdRSocial: "",
          cSelectAnios: "2022",
          nIdUser: sessionStorage.getItem("iduser"),
         
        },
        rangoAnios: [
          { label: "2021", value: "2021" },
          { label: "2022", value: "2022" },
        ],
        activeName: "first",
        listDetPedido: [],
        listVendedor: [],
        listCliente: [],
        listCotizacion: [],
        listNotaPedido: [],
        
  
        listProd: [],
        modalShow: false,
        modalEstado: false,
        btnEditarEstado: false,
        mostrarModal: {
          display: "block",
          background: "#0000006b",
        },
        ocultarModal: {
          display: "none",
        },
        pageNumber: 0,
        perPage: 10,
        listRolPermisoByUsuario: JSON.parse(
          sessionStorage.getItem("listRolPermisosByUsuario")
        ),
  
        ///Formato de la Fecha
        pickerOptions: {
          disabledDate(time) {
            return time.getTime() > Date.now.Date();
          },
          shortcuts: [
            {
              text: "Today",
              onClick(picker) {
                picker.$emit("pick", new Date());
              },
            },
            {
              text: "Yesterday",
              onClick(picker) {
                const date = new Date();
                date.setTime(date.getTime() - 3600 * 1000 * 24);
                picker.$emit("pick", date);
              },
            },
            {
              text: "A week ago",
              onClick(picker) {
                const date = new Date();
                date.setTime(date.getTime() - 3600 * 1000 * 24 * 7);
                picker.$emit("pick", date);
              },
            },
          ],
        },
      };
    },
  
    mounted() {
   
  
      //this.cargaFechaActual();
      this.getlistCliente();
      this.getlistVendedores();
      this.fillListNotaPedido.nIdUser=''
   
    },
  
    computed: {
      pageCount() {
        let a = this.listCotizacion.length,
          b = this.perPage;
        return Math.ceil(a / b);
      },
  
      pageCountByDate() {
        let a = this.listNotaPedido.length,
          b = this.perPage;
        return Math.ceil(a / b);
      },
  
      listCotizacionPaginated() {
        let inicio = this.pageNumber * this.perPage,
          fin = inicio + this.perPage;
        return this.listCotizacion.slice(inicio, fin);
      },
  
      listNotPedidoPaginatedbyDate() {
        let inicio = this.pageNumber * this.perPage,
          fin = inicio + this.perPage;
        return this.listNotaPedido.slice(inicio, fin);
      },
  
      pagesList() {
        let a = this.listCotizacion.length,
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
  
      pagesListByDate() {
        let a = this.listNotaPedido.length,
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
  
    methods: {
      getlistVendedores() {
        var url = "/administracion/usuario/getListarUsusarios";
        axios.get(url).then((response) => {
          this.listVendedor = response.data;
        });
      }, 
  
      getlistNotaPedidoList() {
      
        var url = "/administracion/NotaPedido/list";
        axios
          .get(url, {
            params: {
              fecha : this.fillListNotaPedido.dFecha,
              fecha1: this.fillListNotaPedido.dFecha[0],
              fecha2: this.fillListNotaPedido.dFecha[1],
              nIdRSocial : this.fillListNotaPedido.nIdRSocial,
              nIdvendedor : this.fillListNotaPedido.nIdUser,
              cNroNota : this.fillListNotaPedido.cNroNota
            },
          })
          .then((response) => {
            console.log(response.data)
            this.listNotaPedido = response.data;
          });
      },

      cargaFechaActual() {
        this.fillListNotaPedido.dFecha = new Date();
      },
  
      setEditarCantidad(id,cantidad){
        let vcant = prompt("Ingrese la cantidad a editar",cantidad);

        var url = "/administracion/NotaPedido/editcantDetNotaPedido"; 
      axios
        .post(url, {
          id,
          vcant
        })
        .then((response) => {
          
          this.abrirModal(id)
          
          //this.setMostrarInfo(informeproduccion_id) 
        });


      },
  
      limpiarCriteriosBsq() {
        this.fillListNotaPedido.cNroNota = "";
      },
      limpiarBandejaMaterial() {
        this.listDetPedido = [];
      },
     
  
      getlistCliente() {
        var url = "/administracion/cliente/getListarAllCliente";
        axios
          .get(url)
          .then((response) => {
            this.listCliente = response.data;
            //this.fillListNotaPedido.nIdRSocial = this.listCliente[0].id;
         
          });
      },

      abrirModal(item) {
     this.modalShow = !this.modalShow;
      this.getListDetNotaPedido(item); 
    },
  
    getListDetNotaPedido(item){

      var url = "/administracion/NotaPedido/listNotaPedidoBy"; 
      axios
        .get(url, {
          params: {
            item: item,
          },
        })
        .then((response) => {
          this.listDetPedido = response.data;
        });

    },


      getPdfNotaPedido(id){
        var config = { responseType: "blob" };
      var url = "/administracion/NotaPedido/NotaPedidoPdf";
      axios
        .post(
          url,
          {
            params: {
              id,
            },
          },
          config
        )
        .then((response) => {
          var oMyBlob = new Blob([response.data], { type: "application/pdf" });
          var url = URL.createObjectURL(oMyBlob);
          window.open(url);
          //window.print();
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
  