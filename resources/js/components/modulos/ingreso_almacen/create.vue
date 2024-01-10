<template>
    <div>
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Ingreso de Almacén</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="content container-fluid">
        <div class="card">
          <div class="card-header">
            <div class="card-tools">
              <router-link class="btn btn-info btn-sm" :to="'/ordenCompra/list'">
                <i class="fas fa-arrow-left"></i>Regresar
              </router-link>
            </div>
          </div>
          <div class="card-body">
            <div class="container-fluid">
              <div class="card card-info">
          
       
  
                <div class="container-fluid">
                  <form role="form">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card card-primary">
                          <div class="card-header">
                            <h3 class="card-title">DETALLE DEL PRODUCTO</h3>
                          </div>
                          <div class="card-body">
                            <div class="form-group row">
                              <label class="col-md-2 col-form-label"
                                >DESCRIPCION DEL MEDIDOR</label
                              >
  
                              <div class="col-md-10">
                                <el-select
                                  v-model="fillIngAlmacen.nIdprod"
                                  style="width: 90%"
                                  filterable
                                  placeholder="Select"
                                  @change="getBuscaStockProducto()"
                                >
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
                                </el-select>
                              </div>
                            </div>
  
                            <form role="form">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group row">
                                    <label class="col-md-2 col-form-label"
                                      >CANTIDAD</label
                                    >
                                    <div class="col-md-2">
                                      <input
                                        type="text"
                                        class="form-control"
                                        v-model="fillIngAlmacen.cCantidad"
                                        v-int
                                      />
                                    </div>
  
                                    <label class="col-md-1 col-form-label"
                                      >MEDIDA</label
                                    >
                                    <div class="col-md-3">
                                      <el-select
                                        v-model="fillIngAlmacen.nIdUnidMed"
                                        placeholder="Select"
                                        style="width: 70%"
                                      >
                                        <el-option
                                          v-for="item in listUnidMed"
                                          :key="item.id"
                                          :label="item.nombre"
                                          :value="item.id"
                                        >
                                        </el-option>
                                      </el-select>
                                    </div>
  
                                    <label class="col-md-1 col-form-label"
                                      >P.UNIT
                                    </label>
                                    <div class="col-md-2">
                                      <input
                                        type="text"
                                        class="form-control"
                                        v-model="fillIngAlmacen.punit"
    
                                      />
                                    </div>



                                  </div>
                                </div>
                              </div>


                              
                              <div class="row">
                                        <div class="col-md-12">
                                  <div class="form-group row">
                                        <label class="col-md-2 col-form-label"
                                          >STOCK
                                        </label>
                                        <div class="col-md-1">
                                          <input
                                            type="text"
                                            class="form-control"
                                            v-model="fillIngAlmacen.cStock"
                                            v-int
                                            readonly
                                          />
                                        </div>
                                        </div>
                                        </div>
                                    </div>

                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-md-4 offset-4">
                        <button
                          class="btn btn-flat btn-info btnWidth"
                          @click.prevent="setSaveIngAlmacen"
                        >
                          Guardar
                        </button>
                        <button
                          class="btn btn-flat btn-default btnWidth"
                          @click.prevent="limpiarDetallePSalida"
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
  
      <!--  Modal de Validacion de campos -->
      <div
        class="modal fade"
        :class="{ show: modalShow }"
        :style="modalShow ? mostrarModal : ocultarModal"
      >
        <div class="modal-dialog" role="document">
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
            <div class="modal-footer">
              <button class="btn btn-secondary" @click="abrirModal">
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>
      <!--  Fin del  Modal de Validacion de campos -->
  
      <!--Fin del  Modal de editar cantidad de Parte de Ingreso -->
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        fillIngAlmacen: {
         
          nIdprod: "",
          punit:"",
          nIdUser: sessionStorage.getItem("iduser"),
          
          cCantidadModal: "",
          cCantidad: "",
          nIdUnidMed: "",
  
          cStock: "",
        },
  
        listarDetalleOrdeCompra: [],
       
    
        listProd: [],
        listUnidMed: [],
      
        estadoProv: false,
        estadoCliente: false,
  
        modalCantidad: false,
  
        modalShow: false,
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
    mounted() {
     
      this.getListarUnidadMedida();
      this.getListarproductosByName();
      this.fillIngAlmacen.punit=0;
  
    
   
     
    },
    computed: {},
    methods: {

  
      limpiarCriteriosBsq() {},

  

  
      setSaveIngAlmacen() {
        var url = "/administracion/parte_ingreso/setSaveIngAlmacen";
        axios
          .post(url, {
            nIdUser: this.fillIngAlmacen.nIdUser,
            cCantidad: this.fillIngAlmacen.cCantidad,
            nIdUnidMed: this.fillIngAlmacen.nIdUnidMed,
            nIdprod: this.fillIngAlmacen.nIdprod,
            cStock: this.fillIngAlmacen.cStock,
            punit: this.fillIngAlmacen.punit 
          })
          .then((response) => {
     
              //this.listarPSalidaPaginated = response.data.datos;
           
               // this.setLimpiaDetalleProducto();
                this.getBuscaStockProducto()
  
            
          });
      },


      abrirModal() {
        this.modalShow = !this.modalShow;
      },
  
      abrirModalCantidad() {
        this.modalCantidad = !this.modalCantidad;
      },
      validaPIngreso() {
        this.error = 0;
        this.mensajeError = [];
  
     /*    if (!this.fillIngAlmacen.nroFactura) {
          this.mensajeError.push("El campo Factura es obligatorio");
        } */
  
  
     
  
        if (this.mensajeError.length) {
          this.error = 1;
        }
  
        return this.error;
      },
  
      limpiarDetallePSalida() {
       
     

     
    
        this.fillIngAlmacen.nIdprod = "";
        this.fillIngAlmacen.cCantidad = "";
        this.fillIngAlmacen.cStock = "";
      },
  
      setLimpiaDetalleProducto(){
          this.fillIngAlmacen.nIdprod = "";
          this.fillIngAlmacen.cCantidad ="";
          this.fillIngAlmacen.cStock ="";
      },
  

  
  

  


  
      getListarproductosByName() {
        var url = "/administracion/detallecotizancion/listProdByName";
        axios
          .get(url, {
            params: {
              nIdprod: this.fillIngAlmacen.nIdprod,
            },
          })
          .then((response) => {
            this.listProd = response.data;
          });
      },
  
      getListarUnidadMedida() {
        var url = "/administracion/KardexDetalle/listUnidMed";
        axios.get(url).then((response) => {
          this.listUnidMed = response.data;
          this.fillIngAlmacen.nIdUnidMed = this.listUnidMed[3].id;
        });
      },
  
  
  
      getBuscaStockProducto() {
        var url = "/administracion/kardex/BuscaStockxProducto";
        axios
          .post(url, {
            nIdprod: this.fillIngAlmacen.nIdprod,
          })
          .then((response) => {
            this.fillIngAlmacen.cStock = response.data.stock;
          });
      },
    },
  

  };
  </script>
  
  <style>
  </style>
  