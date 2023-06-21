<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Editar Clientes</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/cliente/index'">
              <i class="fas fa-plus-square"></i> Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Editar Cliente</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label"
                          >Razon Social</label
                        >
                        <div class="col-md-10">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cRSocial"
                            readonly
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Dirección</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cDireccion"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Ruc</label>
                        <div class="col-md-5">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cRuc"
                            :maxlength="11"
                            readonly
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Atencion</label>
                        <div v-if="listRolPermisoByUsuario.includes('cliente.editarCampos')" class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cAtencion"
                            
                          />
                        </div>
                        <div v-else class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cAtencion"
                             readonly
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Telefono</label>
                        <div   v-if="listRolPermisoByUsuario.includes('cliente.editarCampos')"  class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cTelefono"
                          />
                        </div>
                        <div   v-else class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cTelefono"
                            readonly
                          />
                        </div>

                      </div>
                    </div>
                   
                    <div class="col-md-6">
                      <div  v-if="listRolPermisoByUsuario.includes('cliente.editarCampos')"  class="form-group row">
                        <label class="col-md-2 col-form-label">Celular</label>
                        <div class="col-md-8">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cCelular"
                          />
                        </div>
                      </div>

                      <div  v-else  class="form-group row">
                        <label class="col-md-2 col-form-label">Celular</label>
                        <div class="col-md-8">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cCelular"
                          
                            readonly
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillEditarCliente.cEmail"
                          />
                        </div>
                      </div>
                    </div>

         


                    

                        <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Vendedor Actual</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                             readonly
                            v-model="fillEditarCliente.VendedorActual"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
            
   
                    

                   <template  v-if="listRolPermisoByUsuario.includes('cliente.traladar')">
                       <div class="row">
                        <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Tipo de Precio</label>
                        <div class="col-md-9">
                          <el-select v-model="fillEditarCliente.ctipoPrecio" class="m-2" placeholder="Select" size="large">
                            <el-option v-for="item in tipoPrecio" :key="item.value" :label="item.label" 
                              :value="item.value" />
                          </el-select>
                        </div>
                      </div>
                    </div>

                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"
                              >Seleccionar Vendedor</label
                            >
                                      <div class="col-md-6">
                              <el-select
                                v-model="fillEditarCliente.nIdVendedorfuture"
                                filterable
                                placeholder="Seleccione una Vendedor"
                                :style="{ width: '350px' }"

                                clearable
                              >
                                <el-option
                                  v-for="item in listVendedorFuturo"
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
                          </div><span><button type="button" class="btn btn-primary" @click.prevent="setUpdateClienteVendedor(fillEditarCliente.nIdCliente)">Cambiar</button></span>
                       </div>

                  </template>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setRegistrarCliente"
                    >
                      Editar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="limpiarClienteBsq"
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
      fillEditarCliente: {
        nIdCliente: this.$attrs.id,
        cRSocial: "",
        cDireccion: "",
        cRuc: "",
        cAtencion: "",
        cTelefono: "",
        cCelular: "",
        cEmail: "",
        VendedorActual :"",
        nIdVendedorfuture:"",
        ctipoPrecio:"",
      },
      listVendedorFuturo :[],
          listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),

      tipoPrecio: [
        {
          value: 'Lista',
          label: 'Lista',
        },
        {
          value: 'Distribuidor',
          label: 'Distribuidor',
        },
      ],
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
    this.getlistVendedores();
  },
  methods: {


    getlistVendedores() {
      var url = "/administracion/usuario/getListarUsusarios";
      axios.get(url).then((response) => {
        this.listVendedorFuturo = response.data;
        this.getlistCliente();
      });
    },

setUpdateClienteVendedor(idClient){

      var url = "/administracion/cliente/UpdateClientVendedor";
      axios
        .post(url, {
          idClient: idClient,
          nIdVendedorfuture : this.fillEditarCliente.nIdVendedorfuture
        })
        .then((response) => {
          if (response.data.icon == "success") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 2000,
            });
             this.$router.push("/cliente/index");
          }else{
                    Swal.fire({
              position: "center",
              icon: "error",
              title: "Verifique bien por favor",
              showConfirmButton: false,
              timer: 2000,
            });

          }
        });


},


    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    limpiarClienteBsq() {
      this.fillEditarCliente.cRSocial = "";
      this.fillEditarCliente.cDireccion = "";
      this.fillEditarCliente.cRuc = "";
      this.fillEditarCliente.cAtencion = "";
      this.fillEditarCliente.cTelefono = "";
      this.fillEditarCliente.cCelular = "";
      this.fillEditarCliente.cEmail = "";
    },
    limpiarBandejaProveedor() {
      this.listProveedor = [];
    },
    setRegistrarCliente() {
      if (this.validarProveedor()) {
        this.modalShow = true;
        return;
      }
      this.setEditarProveedor();
    },

    getClienteById() {
      var url = "/administracion/cliente/listClientesById";
      axios
        .get(url, {
          params: {
            nIdCliente: this.fillEditarCliente.nIdCliente,
          },
        })
        .then((response) => {
          this.fillEditarCliente.cRSocial = response.data.razonsocial;
          this.fillEditarCliente.cDireccion = response.data.direccion;
          this.fillEditarCliente.cRuc = response.data.ruc;
          this.fillEditarCliente.cAtencion = response.data.atencion;
          this.fillEditarCliente.cTelefono = response.data.telefono;
          this.fillEditarCliente.cCelular = response.data.celular;
          this.fillEditarCliente.cEmail = response.data.email;
          this.fillEditarCliente.VendedorActual = response.data.user.fullname
          this.fillEditarCliente.ctipoPrecio = response.data.tipoPrecio


        });
    },

    setEditarProveedor() {
      var url = "/administracion/cliente/EditClientes";
      axios
        .post(url, {
          nIdCliente: this.fillEditarCliente.nIdCliente,
          cRSocial: this.fillEditarCliente.cRSocial,
          cDireccion: this.fillEditarCliente.cDireccion,
          cRuc: this.fillEditarCliente.cRuc,
          cAtencion: this.fillEditarCliente.cAtencion,
          cTelefono: this.fillEditarCliente.cTelefono,
          cCelular: this.fillEditarCliente.cCelular,
          cEmail: this.fillEditarCliente.cEmail,
          ctipoPrecio : this.fillEditarCliente.ctipoPrecio
        })
        .then((response) => {
          if (response.data.icon == "success") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 2000,
            });
             this.$router.push("/cliente/index");
          }else{
                    Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 2000,
            });

          }
        });

    },
    validarProveedor() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillEditarCliente.cRSocial) {
        this.mensajeError.push("El Campo Razon Social es un campo obligatorio");
      }
      if (!this.fillEditarCliente.cDireccion) {
        this.mensajeError.push("El Campo Direccion es un campo obligatorio");
      }
      if (!this.fillEditarCliente.cRuc) {
        this.mensajeError.push("El Campo Ruc es un campo obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },
  },
};
</script>

<style>
</style>
