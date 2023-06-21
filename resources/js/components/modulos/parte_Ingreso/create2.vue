<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Parte de Ingreso</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <router-link
                            class="btn btn-info btn-sm"
                            :to="'/ordenCompra/list'"
                        >
                            <i class="fas fa-arrow-left"></i>Regresar
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Formulario Parte de Ingreso
                                </h3>
                            </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-3 col-form-label"
                                                        >Orden Compra</label
                                                    >
                                                    <div class="col-md-6">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPIngreso.cOrdenComPra
                                                            "
                                                            :disabled="
                                                                this
                                                                    .estadoCodOrd
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <div
                                                            class="btn-toolbar"
                                                            role="toolbar"
                                                            aria-label="Toolbar with button groups"
                                                        >
                                                            <div
                                                                class="btn-group mr-2"
                                                                role="group"
                                                                aria-label="First group"
                                                            >
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-primary mr-2"
                                                                    @click.prevent="
                                                                        getListarOrdenCompra
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-search"
                                                                    ></i>
                                                                </button>

                                                                <button
                                                                    type="button"
                                                                    class="btn btn-success"
                                                                    @click.prevent="
                                                                        getListarNew
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-undo"
                                                                    ></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-3 col-form-label"
                                                        >Proveedor</label
                                                    >
                                                    <div class="col-md-9">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPIngreso.cProveedor
                                                            "
                                                            @keypress.prevent.enter="
                                                                setRegistrarPIngreso
                                                            "
                                                            readonly="true"
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >Motivo</label
                                                    >
                                                    <div class="col-md-10">
                                                        <el-select
                                                            v-model="
                                                                fillPIngreso.nIdMotivo
                                                            "
                                                            placeholder="Select"
                                                        >
                                                            <el-option
                                                                v-for="item in listMotivo"
                                                                :key="item.id"
                                                                :label="
                                                                    item.nombre
                                                                "
                                                                :value="item.id"
                                                            >
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-3 col-form-label"
                                                        >Nro Factura</label
                                                    >
                                                    <div class="col-md-4">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPIngreso.nroFactura
                                                            "
                                                            @keypress.prevent.enter="
                                                                setRegistrarPIngreso
                                                            "
                                                            style="width: 30vh"
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-3 col-form-label"
                                                        >Nro Guia</label
                                                    >
                                                    <div class="col-md-7">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPIngreso.cNroGuia
                                                            "
                                                            @keypress.prevent.enter="
                                                                setRegistrarPIngreso
                                                            "
                                                            style="width: 30vh"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <!--     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Fecha</label>
                          <div class="col-md-6">
                            <el-date-picker
                              v-model="fillPIngreso.cFecha"
                              type="date"
                              placeholder="Ingrese una Fecha"
                              format="dd/MM/yyyy"
                              value-format="yyyy-MM-dd"
                            >
                            </el-date-picker>
                          </div>
                        </div>
                      </div>
                    </div> -->
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >Observación</label
                                                    >
                                                    <div class="col-md-10">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillPIngreso.cObservacion
                                                            "
                                                            @keypress.prevent.enter="
                                                                setRegistrarPIngreso
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!--  Bandeja de Resultados -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Bandeja de Resultados
                                    </h3>
                                </div>

                                <div class="card-body table-responsive">
                                    <table
                                        class="table table-hover table-head-fixed text-nowrap projects"
                                    >
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Cantidad</th>
                                                <th>Cantidad Ingresada</th>
                                                <th>Unid. Medida</th>
                                                <th>Descripcion</th>
                                                <th>Estado</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    item, index
                                                ) in listCompletFilter"
                                                :key="index"
                                            >
                                                <td
                                                    v-text="
                                                        item.producto_codigo
                                                    "
                                                ></td>

                                                <!--   <td v-text="item.cantidad-item.cantidadKardex"></td> -->
                                                <td
                                                    v-text="item.cantidadKardex"
                                                ></td>
                                                <td v-text="item.canting"></td>
                                                <td
                                                    v-text="
                                                        item.unidmedida_nombre
                                                    "
                                                ></td>
                                                <td
                                                    v-text="item.producto_desc"
                                                ></td>

                                                <td v-if="item.estado == '1'">
                                                    Completo
                                                </td>
                                                <td v-if="item.estado == '2'">
                                                    Pendiente
                                                </td>

                                                <td>
                                                    <el-checkbox
                                                        @change="
                                                            marcarFila(
                                                                index,
                                                                item.iddetalleOrdenCompra,
                                                                item.cantidadKardex,
                                    
                                                            )
                                                        "
                                                        v-model="item.checked"
                                                        >Completo</el-checkbox
                                                    >
                                                </td>
                                                <!--      <template v-if="item.estado == '1'">
                            <button
                              class="btn btn-flat btn-primary btn-sm"
                              @click.prevent="
                                setCambiarEstadoDetalleOC(1, item.id)
                              "
                            >
                              <i class="far fa-bell-slash"></i> Pendiente
                            </button>

                      

                     
                          </template> -->
                                                <template
                                                    v-if="item.estado == '2'"
                                                >
                                                    <!--     <button
                              class="btn btn-flat btn-success btn-sm"
                              @click.prevent="
                                setCambiarEstadoDetalleOC(2, item.id)
                              "
                            >
                              <i class="far fa-bell"></i> Completo
                            </button> -->
                                                    <button
                                                        class="btn btn-flat btn-danger btn-sm"
                                                        @click.prevent="
                                                            setValorCantidadModal(
                                                                item.iddetalleOrdenCompra
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="far fa-edit"
                                                        ></i>
                                                        Cantidad
                                                    </button>
                                                </template>

                                                <!--  <td v-text="item.estado"></td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button
                                            class="btn btn-flat btn-info btnWidth"
                                            @click.prevent="
                                                setRegistrarPIngreso
                                            "
                                        >
                                            Guardar
                                        </button>
                                        <button
                                            class="btn btn-flat btn-default btnWidth"
                                            @click.prevent="setResetCampos"
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

        <!-- Modal de editar cantidad de Parte de Ingreso -->
        <div
            class="modal fade"
            :class="{ show: modalCantidad }"
            :style="modalCantidad ? mostrarModal : ocultarModal"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ingrese la cantidad</h5>
                        <button class="close" @click="abrirModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-9">
                            <input
                                type="text"
                                class="form-control"
                                v-model="fillPIngreso.cCantidadModal"
                                style="width: 300px"
                            />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            class="btn btn-primary"
                            @click="setEditarCantidad()"
                        >
                            Editar
                        </button>
                        <button
                            class="btn btn-secondary"
                            @click="abrirModalCantidad()"
                        >
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--Fin del  Modal de editar cantidad de Parte de Ingreso -->
    </div>
</template>

<script>
import { Alert } from "element-ui";

export default {
    data() {
        return {
            fillPIngreso: {
                nIdOrdenCompra: this.$attrs.id,
                cProveedor: "",
                nIdProveedor: "",
                cOrdenComPra: "",
                cNroGuia: "",
                nroFactura: "",

                cObservacion: "",
                nIdUser: sessionStorage.getItem("iduser"),
                nIdMotivo: "",
                cCantidadModal: "",
            },

            listarDetalleOrdeCompra: [],
            listCompletFilter: [],
            listMotivo: [],
            estadoProv: false,
            estadoCliente: false,

            modalCantidad: false,

            modalShow: false,
            mostrarModal: {
                display: "block",
                background: "#0000006b",
            },

            estadoCodOrd: false,

            ocultarModal: {
                display: "none",
            },
            error: 0,
            mensajeError: [],
        };
    },
    mounted() {
        this.getListarMotivo();
        /*     this.getListarByProveedor();
    this.setListarDatosOrdenCompraXId();
    this.setListarDetalleOrdenCompraxId();
    this.setSelectMovimiento();

    this.setListtempPIngreso();
    this.fillPIngreso.cFecha = new Date(); */
    },
    computed: {},
    methods: {
        getListarOrdenCompra() {
            var url = "/administracion/parteIngreso/ListarDatosOrdenCompra";
            axios
                .post(url, {
                    cOrdenComPra: this.fillPIngreso.cOrdenComPra,
                })
                .then((response) => {
                    this.fillPIngreso.cProveedor =
                        response.data[0].ordencompras.proveedor.nombre;

                    //console.log(response.data)
                    this.listarDetalleOrdeCompra = response.data;
                    this.listCompletFilter = [];
                    this.filtrarPermisoByRol();
                    this.estadoCodOrd = true;
                });
        },
        getListarOrdenCompraEstado() {
            var url = "/administracion/parteIngreso/ListarDatosOrdenCompra";
            axios
                .post(url, {
                    cOrdenComPra: this.fillPIngreso.cOrdenComPra,
                })
                .then((response) => {
                    //console.log(response.data)
                    this.listarDetalleOrdeCompra = response.data;
                    this.estadoCodOrd = true;
                });
        },

        getListarNew() {
            this.estadoCodOrd = false;
            this.listarDetalleOrdeCompra = [];
            this.fillPIngreso.cProveedor = "";
            this.fillPIngreso.cOrdenComPra = "";
        },

        getListarByProveedor() {
            var url = "/administracion/proveedor/getListarProveedorById";
            axios
                .get(url, {
                    params: {
                        nIdOrdenCompra: this.fillPIngreso.nIdOrdenCompra,
                    },
                })
                .then((response) => {
                    this.fillPIngreso.cProveedor = response.data.nombre;
                });
        },

        limpiarCriteriosBsq() {
            this.fillPIngreso.cProveedor = "";
        },
        setRegistrarPIngreso() {
            if (this.validaPIngreso()) {
                this.modalShow = true;
                return;
            }
            this.setGrabarPIngreso();
        },

        setListarDatosOrdenCompraXId() {
            var url = "/administracion/ordenCompra/ListarDatosOrdenCompraXId";
            axios
                .post(url, {
                    nIdOrdenCompra: this.fillPIngreso.nIdOrdenCompra,
                })
                .then((response) => {
                    (this.fillPIngreso.cProveedor =
                        response.data.proveedor.nombre),
                        (this.fillPIngreso.nIdProveedor =
                            response.data.proveedor.id),
                        (this.fillPIngreso.cOrdenComPra =
                            this.fillPIngreso.nIdOrdenCompra
                                .toString()
                                .padStart(3, "000") +
                            "-" +
                            response.data.Femision.substr(0, 4));
                });
        },

        setGrabarPIngreso() {
            var url = "/administracion/parte_ingreso/setGrabarPIngreso";
            axios
                .post(url, {
                    cOrdenComPra: this.fillPIngreso.cOrdenComPra,
                    nroFactura: this.fillPIngreso.nroFactura,
                    nroguia: this.fillPIngreso.cNroGuia,
                    cobservacion: this.fillPIngreso.cObservacion,
                    nIdUser: this.fillPIngreso.nIdUser,
                    nIdMotivo: this.fillPIngreso.nIdMotivo,
                    listCompletFilter: this.listCompletFilter,
                })
                .then((response) => {
                    Swal.fire({
                        position: "center",
                        icon: response.data.icon,
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    this.setResetCampos();
                    this.getListarOrdenCompra();

                    /* this.setLimpiaCampos();
          this.eliminarTempitemPIngreso(); */
                });
        },
        abrirModal() {
            this.modalShow = !this.modalShow;
        },

        setValorCantidadModal(item) {
            var url =
                "/administracion/DetalleordenCompra/setMandarValorDetalleParteIngresoXId";
            axios
                .post(url, {
                    item: item,
                })
                .then((response) => {
                    this.fillPIngreso.cCantidadModal =
                        response.data.cantidadKardex;
                    sessionStorage.item = response.data.id;
                    this.abrirModalCantidad();
                });
        },

        setEditarCantidad() {
            var url =
                "/administracion/DetalleordenCompra/setEditarCantidadParteIngre";
            axios
                .post(url, {
                    item: sessionStorage.item,
                    cCantidadModal: this.fillPIngreso.cCantidadModal,
                })
                .then((response) => {
                    //console.log(response)
                    Swal.fire({
                        position: "center",
                        icon: response.data.icon,
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    this.abrirModalCantidad();
                    this.getListarOrdenCompra();
                    sessionStorage.removeItem(item);
                });
        },

        abrirModalCantidad() {
            this.modalCantidad = !this.modalCantidad;
        },
        validaPIngreso() {
            this.error = 0;
            this.mensajeError = [];

            if (!this.fillPIngreso.nIdMotivo) {
                this.mensajeError.push("El Campo Motivo es obligatorio");
            }

            if (!this.fillPIngreso.nroFactura) {
                this.mensajeError.push("El Nro de Factura es obligatorio");
            }

            if (this.mensajeError.length) {
                this.error = 1;
            }

            return this.error;
        },

        setResetCampos() {
            this.fillPIngreso.nroFactura = "";
            this.fillPIngreso.cNroGuia = "";
            this.fillPIngreso.cObservacion = "";
            this.fillPIngreso.nIdMotivo = "";
        },

        setListtempPIngreso() {
            var url = "/administracion/parte_ingreso/ListtempParteIngreso";
            axios.get(url, {}).then((response) => {
                this.listartempPIngreso = response.data.datos;
            });
        },

        eliminarTempitemPIngreso() {
            var url = "/administracion/parte_ingreso/eliminarTempitemPIngreso";
            axios.post(url).then((response) => {
                this.setListtempPIngreso();
            });
        },

        setListarDetalleOrdenCompraxId() {
            var url = "/administracion/DetalleordenCompra/view";
            axios
                .get(url, {
                    params: {
                        item: this.fillPIngreso.nIdOrdenCompra,
                    },
                })
                .then((response) => {
                    this.listarDetalleOrdeCompra = response.data;
                });
        },
        setCambiarEstadoDetalleOC(op, id) {
            //alert(id)

            Swal.fire({
                title:
                    "Estas seguro de" +
                    (op == 1 ? "Poner Pendiente" : "Poner Completo"),
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText:
                    op == 1 ? "Si,Poner Pendiente " : "Si,  Poner Completo",
            }).then((result) => {
                if (result.isConfirmed) {
                    var url =
                        "/administracion/parteIngreso/CambiarEstadoDetalleOC";
                    axios
                        .post(url, {
                            nIdOC: id,
                            cEstado: op,
                        })
                        .then((response) => {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Se edito el cambio",
                                showConfirmButton: true,
                                timer: 1500,
                            });

                            this.getListarOrdenCompraEstado();
                            //this.setListarDetalleOrdenCompraxId();
                        });
                }
            });
        },

        marcarFila(index, iddetalleOrdenCompra,cantidadKardex) {

       
            this.listCompletFilter.map(function(x,y){

           if(x.checked == true){
            
              var url = "/administracion/DetalleordenCompra/editCantComplete";
          axios.post(url,{
            iddetalleOrdenCompra,
            cantidadKardex
          }
        
          ).then((response) => {
   
            
          });
          x.checked == false;
          } 

      })
      this.getListarOrdenCompra();
  
           
        },

        filtrarPermisoByRol() {
            let me = this;
            me.listarDetalleOrdeCompra.map(function (x, y) {
                me.listCompletFilter.push({
                    producto_id: x.producto.id,
                    producto_codigo: x.producto.codigo,
                    cantidad: x.cantidad,
                    cantidadKardex: x.cantidadKardex,
                    canting: x.canting,
                    unidmedida_nombre: x.unidmedida.nombre,
                    unidmedida_id: x.unidmedida.id,
                    producto_desc:
                        x.producto.familia.nombre +
                        " " +
                        x.producto.subfamilia.nombre +
                        ", MARCA :" +
                        x.producto.marca.nombre +
                        ", MODELO/TIPO :" +
                        x.producto.modelotipo.nombre +
                        ", MATERIAL :" +
                        x.producto.material.nombre,
                    estado: x.estado,
                    punit: x.punit,
                    iddetalleOrdenCompra: x.id,
                    checked: false,
                });
            });
        },
        getListarMotivo(idMovimiento) {
            var url = "/administracion/KardexDetalle/listMotivo";
            axios
                .get(url, {
                    params: {
                        idMovimiento: 1,
                    },
                })
                .then((response) => {
                    this.listMotivo = [];
                    this.listMotivo = response.data;
                });
        },
        setSelectMovimiento() {
            this.fillPIngreso.nIdMotivo = "";
            this.getListarMotivo(1);
        },
    },
};
</script>

<style>
</style>
