<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Informe de Producción</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
     
        <div class="card-body">
          <div class="col-md-12">



            <div class="row">
              <div class="col-md-9">
                <div class="form-group row">
                  <label class="col-md-2 col-form-label">Cod. Reque. Materiales</label>
                  <div class="col-md-3 input-group">
                    <input type="text" class="form-control" v-model="fillCrearInfoProduccion.codRequMateriales" />
                  </div>
                  <span class="input-group-btn">
                    <button class="btn btn-info btn" @click.prevent="buscaxCodRequMateriales">
                      Generar Informe
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Informe de Producción</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-md-1 col-form-label">Producto</label>
                          <div class="col-md-10">
                            <el-select v-model="fillCrearInfoProduccion.nIdproduct" style="width: 70vw" filterable
                              disabled placeholder="Select">
                              <v-row align="right">
                                <el-option v-for="item in listProd" :key="item.id" :label="
                                  item.codigo + ' - '
                                  + item.familia.nombre +
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
                                " :value="item.id">
                                </el-option>
                              </v-row>
                            </el-select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Cantidad</label>
                          <div class="col-md-3">
                            <input type="text" class="form-control" v-model="fillCrearInfoProduccion.cCantprod" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Unid. Medida</label>
                          <div class="col-md-6">
                            <el-select v-model="fillCrearInfoProduccion.nIdUnidMed" placeholder="Select" disabled
                              style="width: 70%">
                              <el-option v-for="item in listUnidMed" :key="item.id" :label="item.nombre"
                                :value="item.id">
                              </el-option>
                            </el-select>
                          </div>
                        </div>
                      </div>

                      
                     
                    <div class="col-md-4">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Cliente-Ref</label>
                        <div class="col-md-9">
                          <el-select v-model="fillCrearInfoProduccion.nIdTipoPago" placeholder="Select" disabled
                            style="width: 70%">
                            <el-option v-for="item in listDescripPago" :key="item.id" :label="item.label"
                              :value="item.value">
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                 



                    </div>
                  </div>

                
           
                  

          





                  <div v-if="fillCrearInfoProduccion.nIdTipoPago == 1" class="col-md-9">
                    <div class="col-md-8">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Para Stock</label>
                        <div class="col-md-9">
                          <el-select v-model="fillCrearInfoProduccion.nidAlmacen" style="width: 90%" filterable disabled
                            placeholder="Select">
                            <el-option v-for="item in listAlmacen" :key="item.id" :label="item.nombre" :value="item.id">
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Referencia</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillCrearInfoProduccion.cReferencia" />

                        </div>
                      </div>
                    </div>

                  <div v-if="fillCrearInfoProduccion.nIdTipoPago == 2" class="col-md-12">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Busqueda de Clientes</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <input type="text" class="form-control" v-model="fillCrearInfoProduccion.cRuc" />
                            <div class="col">
                              <span><button class="btn btn-success btn-sm" @click.prevent="consultaRuc">
                                  Buscar Por Ruc
                                </button></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Empresa</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillCrearInfoProduccion.cRSocial"
                            :disabled="true" />
                        </div>
                      </div>


                    </div>

                  </div>
                  <template >




                  </template>
                     <div v-if="listRolPermisoByUsuario.includes('informeproduccion.agregar')" class="card-footer">
                    <div class="row">
                      <div class="col-md-4 offset-4">
                        <button class="btn btn-flat btn-info btnWidth" @click.prevent="setEditInfoProd">
                          Editar
                        </button>
                   
                      </div>
                    </div>
                  </div> 


                  <!-- INICIO  DE REQUERIMIENTOS DE MATERIALES -->

                   <div v-if="listRolPermisoByUsuario.includes('informeproduccion.agregar')" class="container-fluid">
                    <form role="form">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">
                                REQUERIMIENTOS DE MATERIALES
                              </h3>
                            </div>
                            <div class="card-body">
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label">DESCRIPCION DEL MATERIAL</label>

                                <div class="col-md-10">
                                  <el-select v-model="
                                    fillCrearInfoProduccion.nIdmaterial
                                  " style="width: 60vw" filterable placeholder="Select">
                                    <v-row align="right">
                                      <el-option v-for="item in listProd" :key="item.id" :label="
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
                                      " :value="item.id">
                                      </el-option>
                                    </v-row>
                                  </el-select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label">CANTIDAD</label>
                                <div class="col-md-3">
                                  <input type="text" class="form-control" v-int v-model="
                                    fillCrearInfoProduccion.cCantMaterial
                                  " />
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-md-4 col-form-label">MEDIDA</label>
                                  <div class="col-md-4">
                                    <el-select v-model="
                                      fillCrearInfoProduccion.nIdUnidMedMat
                                    " placeholder="Select" style="width: 70%">
                                      <el-option v-for="item in listUnidMed" :key="item.id" :label="item.nombre"
                                        :value="item.id">
                                      </el-option>
                                    </el-select>
                                  </div>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div> 


                </form>
              </div>
               <div v-if="listRolPermisoByUsuario.includes('informeproduccion.agregar')" class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-primary btnWidth" @click.prevent="setAddPMaterialReqMateriales">
                      Agregar
                    </button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="setCleanMaterial">
                      Limpiar
                    </button>
                  </div>
                </div>
              </div> 

              <!--  Bandeja de Resultados -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Requerimiento de Materiales</h3>
                </div>

                <div class="card-body table-responsive">
                  <table class="
                      table table-hover table-head-fixed
                      text-nowrap
                      projects
                    ">
                    <thead>
                      <tr>
                        <th>Codigo Producto</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>Unid. Medida</th>
                      
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in ListReqMatInfoProduc" :key="index">

                        <td v-text="item.producto.codigo"></td>

                        <td v-text="
                          item.producto.familia.nombre +
                          ' ' +
                          item.producto.subfamilia.nombre +
                          ', MARCA :' +
                          item.producto.marca.nombre +
                          ', MODELO/TIPO :' +
                          item.producto.modelotipo.nombre +
                          ', MATERIAL :' +
                          item.producto.material.nombre
                        "></td>
                        <td v-text="item.cantInfProd"></td>
                        <td v-text="item.unidmedida.nombre"></td>
                     
                        <td>
                        
                          <button class="btn btn-secondary btn-sm" @click="ModalReqMateriales(item.id)">
                            <i class="far fa-edit"></i> Editar
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

   
            </div>
          </div>
        </div>
      </div>

      <!-- FIN   DE REQUERIMIENTOS DE MATERIALES -->

      <!-- INICIO DE REQUERIMIENTOS MANO DE OBRA -->
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">
                  REQUERIMIENTOS MANO DE OBRA (DIAS, HORAS, HOMBRES)
                </h3>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-md-2 col-form-label">PERSONAL</label>

                  <div class="col-md-6">
                    <input type="text" class="form-control" v-model="fillCrearInfoProduccion.cPersonal" />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 col-form-label"></label>
                  <div class="col-md-6">
                    <el-radio v-model="fillCrearInfoProduccion.radTipoTiempo" @change="onChange($event)" label="1"
                      checked>POR DIAS
                    </el-radio>
                    <el-radio v-model="fillCrearInfoProduccion.radTipoTiempo" @change="onChange($event)" label="2">POR
                      HORAS
                    </el-radio>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 col-form-label">DIAS</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control" :disabled="validatedDias"
                      v-model="fillCrearInfoProduccion.cDiasMObra" v-int />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 col-form-label">HORAS</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control" :disabled="validateHoras"
                      v-model="fillCrearInfoProduccion.cHorasMObra" v-int />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-md-4 offset-4">
              <button class="btn btn-flat btn-success btnWidth" @click.prevent="setAddMObra">
                Agregar
              </button>
              <button class="btn btn-flat btn-default btnWidth" @click.prevent="setCleanManoObra">
                Limpiar
              </button>
            </div>
          </div>
        </div>

        <!--  Bandeja de Resultados -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Bandeja de Resultados</h3>
          </div>

          <div class="card-body table-responsive">
            <table class="table table-hover table-head-fixed text-nowrap projects">
              <thead>
                <tr>
                  <th>Personal</th>
                  <th>Días</th>
                  <th>Horas</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in ListManoObraReqMateriales" :key="index">
                  <td v-text="item.personalInfoProd"></td>
                  <td v-text="item.diasInfoProd"></td>
                  <td v-text="item.horasInfoProd"></td>
                  <td>
                    <!--     <button class="btn btn-danger btn-sm" @click="DeleteManodeObra(item.id)">
                      <i class="far fa-trash-alt"></i> Eliminar
                    </button> -->

                    <button class="btn btn-secondary btn-sm" @click="ModalManoObra(item.id)">
                      <i class="far fa-edit"></i> Editar
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- FIN DE REQUERIMIENTOS MANO DE OBRA -->

      <!-- INICIO DE OTROS REQUERIMIENTOS -->

      <div class="container-fluid">
        <div class="card card-primary">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header" style="background-color: #9b59b6; color: white">
                <h3 class="card-title">OTROS REQUERIMIENTOS</h3>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-md-2 col-form-label">DESCRIPCION</label>

                  <div class="col-md-10">
                    <input type="text" class="form-control" v-model="fillCrearInfoProduccion.cDescripcion" />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 col-form-label">CANTIDAD</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control" v-model="fillCrearInfoProduccion.cCantidadReq" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-md-4 offset-4">
              <button class="btn btn-flat btnWidth" style="background-color: #9b59b6; color: white"
                @click.prevent="setAddOtrosRequerimientos">
                Agregar
              </button>
              <button class="btn btn-flat btn-default btnWidth" @click.prevent="setCleanRequerimientos">
                Limpiar
              </button>
            </div>
          </div>
        </div>

        <!--  Bandeja de Resultados -->
        <div class="card card-light">
          <div class="card-header" style="background-color: #9b59b6; color: white">
            <h3 class="card-title">Bandeja de Resultados</h3>
          </div>

          <div class="card-body table-responsive">
            <table class="table table-hover table-head-fixed text-nowrap projects">
              <thead>
                <tr>
                  <th>Descripción</th>
                  <th>Cantidad</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in ListOtrosReqInfoReqMateriales" :key="index">
                  <td v-text="item.descripcionInfoProd"></td>
                  <td v-text="item.cantidadInfoProd"></td>
                  <td>
                    <!--    <button class="btn btn-danger btn-sm" @click="abrirModalOtrosRequerimientos(item.id)">
                      <i class="far fa-trash-alt"></i> Eliminar
                    </button> -->

                    <button class="btn btn-secondary btn-sm" @click="abrirModalOtrosRequerimientos(item.id)">
                      <i class="far fa-edit"></i> Editar
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>

    <!-- FIN DE OTROS REQUERIMIENTOS -->

    <div class="modal fade" :class="{ show: modalShow }" :style="modalShow ? mostrarModal : ocultarModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Sistemas Novesur</h5>
            <button class="close" @click="abrirModal"></button>
          </div>
          <div class="modal-body">
            <div class="callout callout-danger" style="padding: 5px" v-for="(item, index) in mensajeError" :key="index"
              v-text="item"></div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" @click="abrirModal">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!--    MODAL DE REQUERIMIENTOS DE MATERIALES -->

    <div class="modal fade" :class="{ show: modalShowEditItem }"
      :style="modalShowEditItem ? mostrarModal : ocultarModal">
      <div class="modal-editcotitem modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Requerimiento de Materiales</h5>
            <button class="close" @click="abrirModalEditItem"></button>
          </div>

          <div class="modal-body">
            <div class="content container-fluid">
              <form role="form">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label">DESCRIPCION DEL MEDIDOR</label>

                      <div class="col-md-9">
                        <el-select v-model="fillCrearInfoProduccion.nIdEditmaterial" style="width: 90%" filterable
                          placeholder="Select">
                          <el-option v-for="item in listProd" :key="item.id" :label="
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
                          " :value="item.id">
                          </el-option>
                        </el-select>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Cantidad</label>
                        <div class="col-md-3">
                          <input type="text" class="form-control" v-model="fillCrearInfoProduccion.cCantprodEdit" />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Unid. Medida</label>
                        <div class="col-md-6">
                          <el-select v-model="fillCrearInfoProduccion.nIdUnidMedEdit" placeholder="Select"
                            style="width: 70%">
                            <el-option v-for="item in listUnidMed" :key="item.id" :label="item.nombre" :value="item.id">
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


              </form>
            </div>

            <div class="modal-footer">
              <button class="btn btn-success" @click="EditModalReqMateriales()">
                Editar
              </button>
              <button class="btn btn-secondary" @click="abrirModalEditItem">
                Cerrar
              </button>
            </div>
          </div>
        </div>


      </div>
    </div>

    <!--  FIN DEL MODAL DE REQUERIMIENTOS DE MATERIALES -->


    <!-- MODAL DE MANO DE OBRA  -->

    <div class="modal fade" :class="{ show: modalShowEditManoObra }"
      :style="modalShowEditManoObra ? mostrarModal : ocultarModal">
      <div class="modal-editcotitem modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Requerimiento Mano de Obra</h5>
            <button class="close" @click="modalShowEditManoObra"></button>
          </div>

          <div class="modal-body">
            <div class="content container-fluid">
              <form role="form">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label">PERSONAL</label>

                      <div class="col-md-9">
                        <input type="text" class="form-control" v-model="fillCrearInfoProduccion.cPersonalModal" />
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-form-label">DIAS</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" v-model="fillCrearInfoProduccion.cDiasMObraModal" />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">HORAS</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" v-model="fillCrearInfoProduccion.cHorasMObraModal" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


              </form>
            </div>

            <div class="modal-footer">
              <button class="btn btn-success" @click="EditModalManoObra">
                Editar
              </button>
              <button class="btn btn-secondary" @click="abrirModalEditManoObra">
                Cerrar
              </button>
            </div>
          </div>
        </div>


      </div>
    </div>
    <!-- FIN DEL  MODAL DE MANO DE OBRA  -->


    <!-- MODAL OTROS REQUERIMIENTOS  -->

    <div class="modal fade" :class="{ show: modalShowEditOtrosRequ }"
      :style="modalShowEditOtrosRequ ? mostrarModal : ocultarModal">
      <div class="modal-editcotitem modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Otros Requermientos</h5>
            <button class="close" @click="modalShowEditOtrosRequ"></button>
          </div>

          <div class="modal-body">
            <div class="content container-fluid">
              <form role="form">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label">DESCRIPCION</label>

                      <div class="col-md-9">
                        <input type="text" class="form-control" v-model="fillCrearInfoProduccion.cDescripModal" />
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">CANTIDAD</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" v-model="fillCrearInfoProduccion.cCantidadModal" />
                        </div>
                      </div>
                    </div>


                  </div>
                </div>


              </form>
            </div>

            <div class="modal-footer">
              <button class="btn btn-success" @click="EditModalOtrosReq()">
                Editar
              </button>
              <button class="btn btn-secondary" @click="abrirModalOtrosRequerimientos">
                Cerrar
              </button>
            </div>
          </div>
        </div>


      </div>

    </div>
    <div class="card-footer">
      <div class="row">
        <div class="col-md-4 offset-4">
          <button class="btn btn-flat btn-success btnWidth" @click.prevent="setSaveOrdProduccion">
            GUARDAR
          </button>
          <!--        <button class="btn btn-flat btn-default btnWidth" @click.prevent="setCleanManoObra">
              Limpiar
            </button> -->
        </div>
      </div>
    </div>
    <!-- FIN DEL  MODAL OTROS REQUERIMIENTOS  -->




  </div>







</template>

<script>
export default {
  data() {
    return {
      fillCrearInfoProduccion: {
        nIdproduct: "",
        cReferencia: "",
        cDocumento: "",
        cFechaEmision: "",
        nidAlmacen: "",
        cRSocial: "",
        cRuc: "",
        nIdmaterial: "",
        cCantMaterial: "",
        cCantidad: "",
        cCantprod: "",
        nIdTipoPago: "",
        nIdTipoMoneda: "",
        nIdUser: sessionStorage.getItem("iduser"),
        cDuracion: "",
        cPersonal: "",
        cPersonalModal: "",
        cDiasMObra: "",
        cDiasMObraModal: "",
        cHorasMObra: "",
        cHorasMObraModal: "",
        cDescripcion: "",
        cDescripModal: "",
        cCantidadReq: "",
        cCantidadModal: "",
        nIdUnidMed: "",
        nIdUnidMedMat: "",
        radTipoTiempo: "1",
        codRequMateriales: "",
        cCostUnit: "",
        nIdEditmaterial: "",
        cCantprodEdit: "",
        nIdUnidMedEdit: "",
       
      },


      modalShowEditItem: false,
      modalShowEditManoObra: false,
      modalShowEditOtrosRequ: false,
      mostrarModal: {
        display: "block",
        background: "#0000006b",
      },

      ocultarModal: {
        display: "none",
      },
      listAlmacen: [],
      listUnidMed: [],
      listProd: [],
      ListReqMatInfoProduc: [],
      ListManoObraReqMateriales: [],
      ListOtrosReqInfoReqMateriales: [],
      listartempProduccion: [],
      listartempMobra: [],
      listartempRequerimientos: [],
      listDescripPago: [
        {
          value: "1",
          label: "PARA STOCK",
        },
        {
          value: "2",
          label: "PARA PEDIDO DE CLIENTE",
        },
      ],
      listTipoCambio: [],

      validatedDias: false,
      validateHoras: true,

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
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),
    };
    
  },

  mounted() {
    this.getListarproductosByName();
    this.getlistTipoCambio();
    this.defaultDiaHora();
    this.getListarUnidadMedida();
    this.getListarAlmacen();
  },

  methods: {
    CargaInfoProduccion() {
      var url = "/administracion/InformeProduccion/CargaInfoProduccion";
      axios
        .post(url, {
          codRequMateriales: this.fillCrearInfoProduccion.codRequMateriales,
        })
        .then((response) => {
          if (response.data.icon == "warning") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 1500,
            });
            this.fillCrearInfoProduccion.cRSocial = "";
          }

          this.fillCrearInfoProduccion.nIdproduct = response.data.producto_id;
          this.fillCrearInfoProduccion.cCantprod = response.data.cantInfoProd;
          this.fillCrearInfoProduccion.nIdUnidMed = response.data.unidmedida_id;

          if (response.data.cliente_id == "202") {
            this.fillCrearInfoProduccion.nIdTipoPago =
              this.listDescripPago[0].value;
            this.fillCrearInfoProduccion.nidAlmacen = response.data.almacen_id;
          } else {
            this.fillCrearInfoProduccion.nIdTipoPago =
              this.listDescripPago[1].value;
            this.fillCrearInfoProduccion.cRSocial =
              response.data.cliente.razonsocial;
          }

          this.cargaRequeMateriales(
            this.fillCrearInfoProduccion.codRequMateriales
          );
        });
    },

    buscaxCodRequMateriales() {
      this.CargaInfoProduccion();
    },

    abrirModalEditItem() {
      this.modalShowEditItem = !this.modalShowEditItem;
    },

    cargaRequeMateriales(codReqMat) {
      var url = "/administracion/InformeProduccion/getListReqMatReqMat";
      axios
        .get(url, {
          params: {
            codReqMat,
          },
        })
        .then((response) => {
          this.ListReqMatInfoProduc = response.data;
          this.cargaReqManoObraRequMat(codReqMat);
        });
    },

    DeleteReqMateriales(item) {
      Swal.fire({
        title: "Desea eliminar el Registro?",
        text: "En caso de querer recuperarlo consulte con el administrador de sistemas!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, borralo!",
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            "Borrado!",
            "El item seleccionado a sido eliminado.",
            "success"
          );
          var url = "/administracion/InformeProduccion/DeleteReqMateriales";
          axios
            .post(url, {
              item,
            })
            .then(() => {
              this.CargaInfoProduccion();
            });
        }
      });
    },
    cargaReqManoObraRequMat(codReqMat) {
      var url = "/administracion/InformeProduccion/getListReqManoObraReqMat";
      axios
        .get(url, {
          params: {
            codReqMat,
          },
        })
        .then((response) => {
          this.ListManoObraReqMateriales = response.data;
          this.OtrosRequerimientosObraReqMat(codReqMat);
        });
    },

    DeleteManodeObra(item) {
      Swal.fire({
        title: "Desea eliminar el Registro?",
        text: "En caso de querer recuperarlo consulte con el administrador de sistemas!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, borralo!",
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            "Borrado!",
            "El item seleccionado a sido eliminado.",
            "success"
          );
          var url = "/administracion/InformeProduccion/DeleteManodeObra";
          axios
            .post(url, {
              item,
            })
            .then(() => {
              this.CargaInfoProduccion();
            });
        }
      });
    },
    OtrosRequerimientosObraReqMat(codReqMat) {
      var url =
        "/administracion/InformeProduccion/getOtrosRequerimientosReqMateriales";
      axios
        .get(url, {
          params: {
            codReqMat,
          },
        })
        .then((response) => {
          this.ListOtrosReqInfoReqMateriales = response.data;
        });
    },

    DeleteOtrosReque(item) {
      Swal.fire({
        title: "Desea eliminar el Registro?",
        text: "En caso de querer recuperarlo consulte con el administrador de sistemas!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, borralo!",
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            "Borrado!",
            "El item seleccionado a sido eliminado.",
            "success"
          );
          var url = "/administracion/InformeProduccion/DeleteOtrosReque";
          axios
            .post(url, {
              item,
            })
            .then(() => {
              this.CargaInfoProduccion();
            });
        }
      });

    },

    onChange(e) {
      if (e == 1) {
        this.fillCrearInfoProduccion.cHorasMObra = 0;
        this.validateHoras = true;
        this.validatedDias = false;
      }
      if (e == 2) {
        this.fillCrearInfoProduccion.cDiasMObra = 0;
        this.validateHoras = false;
        this.validatedDias = true;
      }
    },
    defaultDiaHora() {
      this.fillCrearInfoProduccion.cCantidadReq = 0;
      this.fillCrearInfoProduccion.cDiasMObra = 0;
      this.fillCrearInfoProduccion.cHorasMObra = 0;
    },

    consultaRuc() {
      var url = "/administracion/cliente/consultaRuc";
      axios
        .post(url, {
          cRuc: this.fillCrearInfoProduccion.cRuc,
        })
        .then((response) => {
          if (response.data.success == false) {
            (this.fillCrearInfoProduccion.cRSocial = ""),
              Swal.fire({
                position: "center",
                icon: "info",
                title: "Ruc no encontrado o numero equivocado",
                showConfirmButton: false,
                timer: 2000,
              });
          } else {
            this.fillCrearInfoProduccion.cRSocial = response.data.razonSocial;
            /*        (this.fillRegistrarCliente.cDireccion = response.data.direccion),
                          (this.estadobutton = false);
                        this.disabledbtnRuc = true; */
          }
        });
    },

    setAddMObra() {
      var url = "/administracion/InformeProduccion/addMObra"; 
      axios
        .post(url, {
          codRequMateriales: this.fillCrearInfoProduccion.codRequMateriales,
          cPersonal: this.fillCrearInfoProduccion.cPersonal,
          cDiasMObra: this.fillCrearInfoProduccion.cDiasMObra,
          cHorasMObra: this.fillCrearInfoProduccion.cHorasMObra,
          estado: 'P',
        })
        .then((response) => {
          this.CargaInfoProduccion();
          this.setcleanListMObra();
        });
    },

    setcleanListMObra() {
      (this.fillCrearInfoProduccion.cPersonal = ""),
        (this.fillCrearInfoProduccion.cDiasMObra = "");
      this.fillCrearInfoProduccion.cHorasMObra = "";
    },

    setAddOtrosRequerimientos() {
      var url = "/administracion/InformeProduccion/addOtrosRequerimientos";
      axios
        .post(url, {
          codRequMateriales: this.fillCrearInfoProduccion.codRequMateriales,
          cDescripcion: this.fillCrearInfoProduccion.cDescripcion,
          cCantidadReq: this.fillCrearInfoProduccion.cCantidadReq,
          estado: 'P',
        })
        .then((response) => {
          this.CargaInfoProduccion();
          this.setCleanRequerimientos();
        });
    },

    setLimpiaRequerimientos() {
      (this.fillCrearInfoProduccion.cDescripcion = ""),
        (this.fillCrearInfoProduccion.cCantidadReq = 0);
    },

    getlistTipoCambio() {
      var url = "/administracion/ordenCompra/TipoCambio";
      axios.get(url).then((response) => {
        this.listTipoCambio = response.data;
        this.fillCrearInfoProduccion.nIdTipoMoneda = this.listTipoCambio[0].id;
      });
    },

    getListarAlmacen() {
      var url = "/administracion/almacen/AlmacenbyEstado";
      axios.get(url).then((response) => {
        this.listAlmacen = response.data;
      });
    },
    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdmaterial: this.fillCrearInfoProduccion.nIdmaterial,
          },
        })
        .then((response) => {
          this.listProd = response.data;
        });
    },

    limpiarCriteriosBsq() {
      this.fillCrearInfoProduccion.cCodProduct = "";
    },
    setRegistrarOProduccion() {
      if (this.validaOrdenProduccion()) {
        this.modalShow = true;
        return;
      }
      this.setGrabarOrdenProduccion();
    },

    setSaveOrdProduccion() {
      var url = "/administracion/InformeProduccion/create";  
      axios
        .post(url, {
          codRequMateriales: this.fillCrearInfoProduccion.codRequMateriales,
          cCantprod: this.fillCrearInfoProduccion.cCantprod,
          nIdUser: this.fillCrearInfoProduccion.nIdUser,
          cReferencia: this.fillCrearInfoProduccion.cReferencia 
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 1500,
          });
          this.setCleanMaterial();
          this.setCleanManoObra();
          this.setCleanRequerimientos();
        });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    validaOrdenProduccion() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillCrearInfoProduccion.nIdproduct) {
        this.mensajeError.push("El campo producto es obligatorio");
      }
      if (this.fillCrearInfoProduccion.cCantprod <= 0) {
        this.mensajeError.push("Cantidad no puede ser menor o igual a cero");
      }
      if (!this.fillCrearInfoProduccion.cCantprod) {
        this.mensajeError.push("Cantidad es campo obligatorio");
      }

      if (!this.fillCrearInfoProduccion.nIdTipoPago) {
        this.mensajeError.push("Tipo de Pago es campo obligatorio");
      }

   

      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },
    setAddPMaterialReqMateriales() {


      var url = "/administracion/InformeProduccion/addMaterialReqMateriales";
      axios
        .post(url, {
          codRequMateriales: this.fillCrearInfoProduccion.codRequMateriales,
          nIdmaterial: this.fillCrearInfoProduccion.nIdmaterial,
          cCantMaterial: this.fillCrearInfoProduccion.cCantMaterial,
          nIdUnidMedMat: this.fillCrearInfoProduccion.nIdUnidMedMat,
          estado: 'P',

        }).then((response) => {
          this.CargaInfoProduccion();
          this.setLimpiaCampos();
        })

      /*  var url = "/administracion/InformeProduccion/saveReqMateriales";
 
       axios
         .post(url, { 
           //codRequMateriales: this.fillCrearInfoProduccion.codRequMateriales,
           nIdmaterial: this.fillCrearInfoProduccion.nIdmaterial,
           cCantMaterial: this.fillCrearInfoProduccion.cCantMaterial,
           nIdUnidMedMat: this.fillCrearInfoProduccion.nIdUnidMedMat,
           estado: 'R',
         })
         .then((response) => {
           this.listartempProduccion = response.data.datos;
           this.CargaInfoProduccion();
       
           if (response.data.message == "Ya fue agregado anteriormente") {
             Swal.fire({
               position: "center",
               icon: response.data.icon,
               title: response.data.message,
               showConfirmButton: false,
               timer: 1500,
             });
           } 
         }); */
    },

    setLimpiaMaterial() {
      (this.fillCrearInfoProduccion.nIdmaterial = ""),
        (this.fillCrearInfoProduccion.cCantMaterial = 0);
    },

    setLimpiaCampos() {
      this.fillCrearInfoProduccion.nIdmaterial = null;
      this.fillCrearInfoProduccion.cCantidad = 0;
    },

    setResetCampos() {
      this.fillCrearInfoProduccion.nIdmaterial = null;
      this.fillCrearInfoProduccion.cCantidad = 0;

      this.fillCrearInfoProduccion.cReferencia = "";
      this.fillCrearInfoProduccion.cDocumento = "";
    },

    setCleanMaterial() {
      var url = "/administracion/ordenProduccion/eliminarTemporder";
      axios.get(url, {}).then((response) => {
        this.listartempProduccion = response.data.datos;
        this.setLimpiaMaterial();
      });
    },

    setCleanManoObra() {
      var url = "/administracion/ordenProduccion/CleanMaterialManoOBra";
      axios.get(url, {}).then((response) => {
        this.listartempMobra = response.data.datos;
        this.setcleanListMObra();
      });
    },

    setCleanRequerimientos() {
      var url = "/administracion/ordenProduccion/cleanRequerimientos";
      axios.get(url, {}).then((response) => {
        this.listartempRequerimientos = response.data.datos;
        this.setLimpiaRequerimientos();
      });
    },

    setListtemOrders() {
      var url = "/administracion/ordenCompra/ListtempOrden";
      axios.get(url, {}).then((response) => {
        this.listartempProduccion = response.data.datos;
      });
    },


    getListarUnidadMedida() {
      var url = "/administracion/KardexDetalle/listUnidMed";
      axios.get(url).then((response) => {
        this.listUnidMed = response.data;
        this.fillCrearInfoProduccion.nIdUnidMed = this.listUnidMed[7].id;
        this.fillCrearInfoProduccion.nIdUnidMedMat = this.listUnidMed[7].id;
      });
    },

    ModalReqMateriales(item) {

      this.abrirModalEditItem(item);
      this.ShowReqMateriales(item)

    },

    ModalManoObra(item) {
      this.abrirModalEditManoObra(item)

    },

    abrirModalEditManoObra(item) {
      this.modalShowEditManoObra = !this.modalShowEditManoObra;
      this.ShowReqManoObra(item)
    },

    abrirModalOtrosRequerimientos(item) {
      this.modalShowEditOtrosRequ = !this.modalShowEditOtrosRequ;
      this.ShowOtrosReq(item);

    },


    ShowReqMateriales(item) {
      var url = "/administracion/RequerimientoMateriales/getDataReqMateriales";
      axios
        .post(url, {
          item,
        })
        .then((response) => {
          this.fillCrearInfoProduccion.nIdEditmaterial = response.data.producto_id,
            this.fillCrearInfoProduccion.cCantprodEdit = response.data.cantInfProd,
            this.fillCrearInfoProduccion.nIdUnidMedEdit = response.data.unidmedida_id
          localStorage.Codigo = item;
        });

    },

    ShowReqManoObra(item) {
      var url = "/administracion/RequerimientoMateriales/getDataReqManoObra";
      axios
        .post(url, {
          item,
        })
        .then((response) => {

          this.fillCrearInfoProduccion.cPersonalModal = response.data.personalInfoProd,
            this.fillCrearInfoProduccion.cDiasMObraModal = response.data.diasInfoProd,
            this.fillCrearInfoProduccion.cHorasMObraModal = response.data.horasInfoProd
          localStorage.Codigo = item;
        });

    },

    ShowOtrosReq(item) {
      var url = "/administracion/RequerimientoMateriales/getDataOtrosReq";
      axios
        .post(url, {
          item,
        })
        .then((response) => {
          this.fillCrearInfoProduccion.cDescripModal = response.data.descripcionInfoProd
          this.fillCrearInfoProduccion.cCantidadModal = response.data.cantidadInfoProd
          localStorage.Codigo = item;

        });

    },

    EditModalReqMateriales() {

      var url = "/administracion/RequerimientoMateriales/EditModalReqMateriales";
      axios
        .post(url, {
          item: localStorage.Codigo,
          cCantprodEdit: this.fillCrearInfoProduccion.cCantprodEdit,
          nIdUnidMedEdit: this.fillCrearInfoProduccion.nIdUnidMedEdit,

        })
        .then((response) => {
          this.cargaRequeMateriales(
            this.fillCrearInfoProduccion.codRequMateriales

          );
          this.abrirModalEditItem()
        });

    },

    EditModalManoObra(item) {

      var url = "/administracion/RequerimientoMateriales/EditModalManoObra";
      axios
        .post(url, {
          item: localStorage.Codigo,
          cPersonalModal: this.fillCrearInfoProduccion.cPersonalModal,
          cDiasMObraModal: this.fillCrearInfoProduccion.cDiasMObraModal,
          cHorasMObraModal: this.fillCrearInfoProduccion.cHorasMObraModal

        })
        .then((response) => {
          this.cargaReqManoObraRequMat(
            this.fillCrearInfoProduccion.codRequMateriales
          );
          this.abrirModalEditManoObra()

        });

    },

    EditModalOtrosReq() {

      var url = "/administracion/RequerimientoMateriales/EditModalOtrosReq";
      axios
        .post(url, {
          item: localStorage.Codigo,
          cDescripModal: this.fillCrearInfoProduccion.cDescripModal,
          cCantidadModal: this.fillCrearInfoProduccion.cCantidadModal,

        })
        .then((response) => {
          this.OtrosRequerimientosObraReqMat(this.fillCrearInfoProduccion.codRequMateriales);
        });

      this.abrirModalOtrosRequerimientos()

    }


  },

};
</script>

<style>

</style>
