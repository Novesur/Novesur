<template>
    <div class="content-header">
      <div class="container-fluid">
        <div class="float-right">
          <router-link class="btn btn-info btn-sm" :to="'/cotizacion/index'">
            <i class="fas fa-angle-double-left"></i> Regresar
          </router-link>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Nota de Pedido</h1>
          </div>
        </div>
      </div>
  
      <div class="content container-fluid">
        <div class="card-body">
          <form role="form">
            <div class="row">
              <!-- FORMULARIO CLIENTES  -->
              <div class="col-md-7">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">CLIENTES</h3>
                  </div>
                  <div class="card-body">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label">SEÑORES</label>
                      <div class="col-md-8">
                        <input
                          type="text"
                          class="form-control"
                          v-model="fillcreateNotaPedido.cNomClient"
                          :readonly="true"
                        />
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label">DIRECCION</label>
                      <div class="col-md-10">
                        <input
                          type="text"
                          class="form-control"
                          :readonly="true"
                          v-model="fillcreateNotaPedido.cDirClient"
                        />
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label">RUC</label>
                      <div class="col-md-8">
                        <input
                          type="text"
                          class="form-control"
                          v-model="fillcreateNotaPedido.cRucClient"
                          :readonly="true"
                        />
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label">ATENCION</label>
                      <div class="col-md-8">
                        <input
                          type="text"
                          class="form-control"
                          v-model="fillcreateNotaPedido.cAtencion"
                          :readonly="true"
                        />
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label">TELEFONO</label>
                      <div class="col-md-8">
                        <input
                          type="text"
                          class="form-control"
                          v-model="fillcreateNotaPedido.cFonoClient"
                          :readonly="true"
                        />
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label">EMAIL</label>
                      <div class="col-md-8">
                        <input
                          type="text"
                          class="form-control"
                          v-model="fillcreateNotaPedido.cEmail"
                          :readonly="true"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- FIN DEL FORMULARIO CLIENTES  -->
  
              <!-- FORMULARIO VENDEDOR  -->
              <div class="col-md-5">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">VENDEDOR</h3>
                  </div>
                  <div class="card-body">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">VENDEDOR</label>
                      <div class="col-md-9">
                        <input
                          type="text"
                          class="form-control"
                          :readonly="true"
                          v-model="fillcreateNotaPedido.cVendedor"
                        />
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">CELULAR</label>
                      <div class="col-md-9">
                        <input
                          type="text"
                          class="form-control"
                          :readonly="true"
                          v-model="fillcreateNotaPedido.cCeluVendedor"
                        />
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">CENTRAL</label>
                      <div class="col-md-9">
                        <input
                          type="text"
                          class="form-control"
                          :readonly="true"
                          v-model="fillcreateNotaPedido.cCentral"
                        />
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">EMAIL</label>
                      <div class="col-md-9">
                        <input
                          type="text"
                          class="form-control"
                          :readonly="true"
                          v-model="fillcreateNotaPedido.cEmailVendedor"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- FIN DEL FORMULARIO VENDEDOR  -->
  
              <!-- CONDICIONES COMERCIALES -->
              <div class="content container-fluid">
                <form role="form">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">CONDICIONES COMERCIALES</h3>
                        </div>
                        <div class="card-body">
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                              >VALIDEZ DE OFERTA</label
                            >
                            <div class="col-md-3">
                              <input
                                type="text"
                                class="form-control"
                                v-model="fillcreateNotaPedido.cValidez"
                                :readonly="true"
                              />
                            </div>
                          </div>
  
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label">ENTREGA</label>
                            <div class="col-md-8">
                              <input
                                type="text"
                                class="form-control"
                                v-model="fillcreateNotaPedido.cEntrega"
                                :readonly="true"
                              />
                            </div>
                          </div>
  
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                              >TIPO DE PAGO</label
                            >
                            <div class="col-md-4">
                              <el-select
                                v-model="fillcreateNotaPedido.nIdTipoPago"
                                placeholder="Select"
                                style="width: 70%"
                                :disabled="true"
                              >
                                <el-option
                                  v-for="item in listTipoPago"
                                  :key="item.id"
                                  :label="item.nombre"
                                  :value="item.id"
                                >
                                </el-option>
                              </el-select>
                            </div>
                          </div>
  
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                              >DESCRIPCION DEL PAGO</label
                            >
                            <div class="col-md-4">
                              <el-select
                                v-model="fillcreateNotaPedido.nIdDescripPago"
                                placeholder="Select"
                                style="width: 70%"
                                :disabled="true"
                              >
                                <el-option
                                  v-for="item in listDescripPago"
                                  :key="item.id"
                                  :label="item.nombre"
                                  :value="item.id"
                                >
                                </el-option>
                              </el-select>
                            </div>
                          </div>
  
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label">FLETE</label>
                            <div class="col-md-8">
                              <input
                                type="text"
                                class="form-control"
                                v-model="fillcreateNotaPedido.cFlete"
                                maxlength="20"
                                :readonly="true"
                              />
                            </div>
                          </div>
  
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                              >DOCUMENTACION</label
                            >
                            <div class="col-md-8">
                              <input
                                type="text"
                                class="form-control"
                                v-model="fillcreateNotaPedido.Docu"
                                :readonly="true"
                              />
                            </div>
                          </div>
  
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                              >GARANTIA</label
                            >
                            <div class="col-md-4">
                              <el-select
                                v-model="fillcreateNotaPedido.nIdGarantia"
                                placeholder="Select"
                                style="width: 70%"
                                :disabled="true"
                              >
                                <el-option
                                  v-for="item in listGarantia"
                                  :key="item.id"
                                  :label="item.nombre"
                                  :value="item.id"
                                >
                                </el-option>
                              </el-select>
                            </div>
                          </div>
  
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                              >OBSERVACIÓN</label
                            >
                            <div class="col-md-8">
                              <input
                                type="text"
                                class="form-control"
                                v-model="fillcreateNotaPedido.cObservacion"
                                :maxlength="255"
                                :readonly="true"
                              />
                            </div>
                          </div>
  
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                              >PUNTO DE LLEGADA CONSIGNADO :</label
                            >
                            <div class="col-md-8">
                              <input
                                type="text"
                                class="form-control"
                                v-model="fillcreateNotaPedido.cPuntoLlegada"
                                :maxlength="100"
                              />
                            </div>
                          </div>
  
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                              >EMP. DE TRANSPORTE</label
                            >
                            <div class="col-md-8">
                              <input
                                type="text"
                                class="form-control"
                                v-model="fillcreateNotaPedido.cTransporte"
                              />
                            </div>
                          </div>
  
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                              >CONSIGNADO</label
                            >
                            <div class="col-md-8">
                              <input
                                type="text"
                                class="form-control"
                                v-model="fillcreateNotaPedido.Cconsignado"
                              />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
  
              <!-- FIN DE CONDICIONES COMERCIALES -->
  
              <!-- ITEMS DE PRODUCTOS -->
              <div class="content container-fluid">
                <form role="form">
     
          
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
                            <th>ITEM</th>
                            <th>CANT</th>
                            <th>MEDIDA</th>
                            <th>CODIGO</th>
                            <th>DESCRIPCION DEL PRODUCTO</th>
                            <th>HOMOLOGADO</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(item, index) in listDetProductos"
                            :key="index"
                          >
                            <td v-text="Number(index)"></td>
                            <td v-text="item.cantidad"></td>
                            <td v-text="item.unidmedNombre"></td>
                            <td v-text="item.producto.codigo"></td>
                            <td
                              v-text="
                                item.producto.familia.nombre +
                                ' ' +
                                item.producto.subfamilia.nombre +
                                ', MARCA :' +
                                item.producto.marca.nombre +
                                ', MODELO/TIPO :' +
                                item.producto.modelotipo.nombre +
                                ', MATERIAL :' +
                                item.producto.material.nombre
                              "
                            ></td>
                            <td v-text="item.producto.homologacion.nombre"></td>
                  
                            <td>
                              <button
                                class="btn btn-info btn-sm"
                                @click.prevent="borradoItems(item.id,item.producto.id)"
                              >
                                Eliminar
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
  
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-md-4 offset-4">
                          <button
                            class="btn btn-flat btn-info btnWidth"
                            @click.prevent="setGrabarNotaPedido"
                          >
                            Guardar
                          </button>
                          <button
                            class="btn btn-flat btn-default btnWidth"
                            @click.prevent="eliminarTempitemCoti"
                          >
                            Limpiar
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!--  FIN DE ITEMS DE PRODUCTOS -->
            </div>
          </form>
        </div>
      </div>
  
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
    </div>
  </template>
  <script>
  export default {
    data() {
      return {
        fillcreateNotaPedido: {

          nIdCotizacion: this.$attrs.id,
          nIdUsuario: "",
          nIdDescripPago: "",
          nIdGarantia: "",
          cNomClient: "",
          cDirClient: "",
          cRucClient: "",
          cAtencion: "",
          cFonoClient: "",
        
          cEmail: "",
          cVendedor: "",
          cEmailVendedor: "",
          cCeluVendedor: "",
          cCentral: "01-2822376",
          vidUSer: "",
          nIdTipoPago: "",
          cValidez: "",
          cEntrega: "",
          cFPago: "",
          cFlete: "",
          Docu: "",
          cGarantia: "",
          cEstado: "",
          cPuntoLlegada: "",
          cTransporte: "",
          Cconsignado: "",
          cObservacion: "",
        },
  
        listUnidMed: [],
        listTipoPago: [],
        listProd: [],
        listDescripPago: [],
        listGarantia: [],
        listDetProductos: [],
  
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
      this.getClienteById();
      this.getListarTipoPago();
      this.cargaDatosPredeterminados();
      this.getlistDescricionPago();
      this.getListGarantia();
      this.getListCotizacion();

    },
  
    methods: {

      getPdfCotizacion(item, fecha) {
      var config = { responseType: "blob" };
      var url = "/administracion/cotizacion/CotizacionPdf";
      axios
        .post(
          url,
          {
            params: {
              item: item,
              fecha: fecha,
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

      getListCotizacion(){
        var url = "/administracion/detallecotizancion/listDetCotibyId"; 
        axios
          .get(url, {
            params: {
              nIdCotizacion: this.fillcreateNotaPedido.nIdCotizacion,
            },
          })
          .then((response) => {
          console.log(response.data)
          this.listDetProductos= response.data
          });
      },


      getlistDescricionPago() {
        var url = "/administracion/pago/index";
        axios.get(url).then((response) => {
          this.listDescripPago = response.data;
          this.fillcreateNotaPedido.nIdDescripPago =
            this.listDescripPago[0].id;
        });
      },
  
      getListGarantia() {
        var url = "/administracion/garantia/index";
        axios.get(url).then((response) => {
          this.listGarantia = response.data;
          this.fillcreateNotaPedido.nIdGarantia = this.listGarantia[0].id;
        });
      },
  
      abrirModal() {
        this.modalShow = !this.modalShow;
      },
      getClienteById() {
        var url = "/administracion/cliente/listClientesByIdCoti"; 
        axios
          .get(url, {
            params: {
              nIdCotizacion: this.fillcreateNotaPedido.nIdCotizacion,
            },
          })
          .then((response) => {
          
            this.fillcreateNotaPedido.cNomClient = response.data.cliente.razonsocial;
            this.fillcreateNotaPedido.cDirClient = response.data.cliente.direccion;
            this.fillcreateNotaPedido.cRucClient = response.data.cliente.ruc;
            this.fillcreateNotaPedido.cAtencion = response.data.cliente.atencion;
            this.fillcreateNotaPedido.cFonoClient = response.data.cliente.telefono;
            this.fillcreateNotaPedido.cEmail = response.data.cliente.email;
            this.fillcreateNotaPedido.cVendedor = response.data.user.fullname;
            this.fillcreateNotaPedido.cEmailVendedor = response.data.user.email;
            this.fillcreateNotaPedido.cCeluVendedor = response.data.user.celular;
            this.fillcreateNotaPedido.cValidez = response.data.validezoferta;
            this.fillcreateNotaPedido.cEntrega = response.data.Entrega;
            this.fillcreateNotaPedido.nIdTipoPago = response.data.tipopago_id;
            this.fillcreateNotaPedido.nIdDescripPago = response.data.pago_id;
            this.fillcreateNotaPedido.cFlete = response.data.flete;
            this.fillcreateNotaPedido.Docu = response.data.documentacion;
            this.fillcreateNotaPedido.cGarantia = response.data.garantia_id;
            this.fillcreateNotaPedido.cObservacion = response.data.observacion;
            this.fillcreateNotaPedido.cPuntoLlegada = response.data.punto_llegada;
            this.fillcreateNotaPedido.cTransporte = response.data.transporte;
            this.fillcreateNotaPedido.Cconsignado = response.data.consignado;
            this.fillcreateNotaPedido.vidUSer = JSON.parse(
              sessionStorage.getItem("iduser")
            );
          });
      },


  

/*       limpiarCotizacionBsq() {
        this.fillcreateNotaPedido.cEntrega = "";
        this.fillcreateNotaPedido.cValidez = "";
        this.fillcreateNotaPedido.cFPago = "";
        this.fillcreateNotaPedido.cFlete = "";
        this.fillcreateNotaPedido.Docu = "";
        this.fillcreateNotaPedido.cGarantia = "";
       
        this.fillcreateNotaPedido.cMedida = "";
        this.fillcreateNotaPedido.cDescripcion = "";
    

      }, */
  

  
      getListarTipoPago() {
        var url = "/administracion/cotizacion/listTipoPago";
        axios.get(url).then((response) => {
          this.listTipoPago = response.data;
          this.fillcreateNotaPedido.nIdTipoPago = this.listTipoPago[0].id;
        });
      },
  

  
/*       setRegistrarCotizacion() {
        if (this.validarCotizacion()) {
          this.modalShow = true;
          return;
        }
        this.setAddTempCotizacion();
      }, */
  
      validarCotizacion() {
        this.error = 0;
        this.mensajeError = [];
        if (!this.fillcreateNotaPedido.cValidez) {
          this.mensajeError.push(
            "La validacion de Oferta es un campo obligatorio"
          );
        }
        if (!this.fillcreateNotaPedido.cEntrega) {
          this.mensajeError.push("El Campo Entrega es un campo obligatorio");
        }
  
        if (!this.fillcreateNotaPedido.cFlete) {
          this.mensajeError.push("El Campo Flete es un campo obligatorio");
        }
        if (!this.fillcreateNotaPedido.Docu) {
          this.mensajeError.push("El Campo Documento es un campo obligatorio");
        }
  
    
      
  
        if (!this.fillcreateNotaPedido.nIdprod) {
          this.mensajeError.push("El Campo Medidor es un campo obligatorio");
        }
  
      
  
        if (this.mensajeError.length) {
          this.error = 1;
        }
        return this.error;
      },
  
      setAddTempCotizacion() {
        var url = "/administracion/cotizacion/addTempCotizacion";
        axios
          .post(url, {
            nIdUnidMed: this.fillcreateNotaPedido.nIdUnidMed,
            nIdprod: this.fillcreateNotaPedido.nIdprod,
          
          })
          .then((response) => {
            if (response.data.icon == "error") {
              Swal.fire({
                position: "center",
                icon: response.data.icon,
                title: response.data.message,
                showConfirmButton: false,
                timer: 1500,
              });
            } else {
              this.listDetProductos = response.data.datos;
              this.limpiaItems();
            }
  
            /*          if (response.data.message == "Ya fue agregado anteriormente") {
              Swal.fire({
                position: "center",
                icon: response.data.icon,
                title: response.data.message,
                showConfirmButton: false,
                timer: 1500,
              });
            } */
          });
      },
      setGrabarNotaPedido() {
        var url = "/administracion/NotaPedido/create"; 
        axios
          .post(url, {
            nIdCotizacion: this.$attrs.id,
            cPuntoLlegada: this.fillcreateNotaPedido.cPuntoLlegada,
            cTransporte: this.fillcreateNotaPedido.cTransporte,
            Cconsignado: this.fillcreateNotaPedido.Cconsignado,
            vidUSer :JSON.parse(sessionStorage.getItem("iduser"))

          })
          .then((response) => {
            if (response.data.icon == "warning") {
              Swal.fire({
                position: "center",
                icon: response.data.icon,
                title: response.data.message,
                showConfirmButton: false,
                timer: 3000,
              });
            } else {
              Swal.fire({
                position: "center",
                icon: response.data.icon,
                title: response.data.message,
                showConfirmButton: false,
                timer: 3000,
              });
              this.eliminarTempitemCoti();
              this.fillcreateNotaPedido.nIdprod = "";
            }
          });
      },

 
      limpiaItems() {
        this.fillcreateNotaPedido.cMedida = "";
        this.fillcreateNotaPedido.cDescripcion = "";
       
      },
  
      borradoItems(idDetCoti,idProducto) {


         
Swal.fire({
  title: 'Esta usted seguro?',
  text: "Sera eliminado del item!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, borralo!'
}).then((result) => {
  if (result.isConfirmed) {

    var url = "/administracion/NotaPedido/delete";
        axios
          .post(url, {
            idDetCoti,
            idProducto,
           
          })
          .then(() => {
            this.getListCotizacion();
          });

    Swal.fire(
      'Borrado!',
      'El item fue borrado correctamente.',
      'success'
  
    )
  }
})
    
      
      },
  
      cargaDatosPredeterminados() {
        this.fillcreateNotaPedido.cValidez = "15 días";
        this.fillcreateNotaPedido.Docu = "Factura, guía y carta de Garantía";
        this.fillcreateNotaPedido.cFlete = "NOVESUR";
      },
  
    
    },
  };
  </script>
  