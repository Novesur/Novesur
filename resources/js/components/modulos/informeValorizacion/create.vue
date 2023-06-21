<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">
                            Informe Valorización - Proyectos
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content container-fluid">
            <div class="card">
                <!--      <div class="card-header">
                      <div class="card-tools">
                          <router-link class="btn btn-info btn-sm" :to="'/proveedor'">
                              <i class="fas fa-arrow-left"></i>Regresar
                          </router-link>
                      </div>
                  </div> -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Formulario Requerimiento de Materiales
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
                                                        >Nombre Proyecto</label
                                                    >
                                                    <div class="col-md-8">
                                                        <el-select
                                                            v-model="
                                                                fillCrearInformeValorizacion.nIdCcostos
                                                            "
                                                            style="width: 90%"
                                                            filterable
                                                            placeholder="Select"
                                                        >
                                                            <v-row>
                                                                <el-option
                                                                    v-for="item in listCCostos"
                                                                    :key="
                                                                        item.id
                                                                    "
                                                                    :label="
                                                                        item.codigo +
                                                                        ' - ' +
                                                                        item.nombre
                                                                    "
                                                                    :value="
                                                                        item.id
                                                                    "
                                                                >
                                                                </el-option>
                                                            </v-row>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >Cliente</label
                                                    >
                                                    <div class="col-md-6">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillCrearInformeValorizacion.nIdClient
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-2 col-form-label"
                                                    >Detalle Servicio</label
                                                >
                                                <div class="col-md-9">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-model="
                                                            fillCrearInformeValorizacion.detservicio
                                                        "
                                                    />
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
                                                        >Fecha Inicio</label
                                                    >
                                                    <div class="col-md-6">
                                                        <el-date-picker
                                                            v-model="
                                                                fillCrearInformeValorizacion.FInicio
                                                            "
                                                            type="date"
                                                            placeholder="Indique la fecha"
                                                            format="dd/MM/yyyy"
                                                            value-format="yyyy-MM-dd"
                                                        >
                                                        </el-date-picker>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-md-3 col-form-label"
                                                            >Fecha Final</label
                                                        >
                                                        <div class="col-md-6">
                                                            <el-date-picker
                                                                v-model="
                                                                    fillCrearInformeValorizacion.FFinal
                                                                "
                                                                type="date"
                                                                placeholder="Indique la fecha"
                                                                format="dd/MM/yyyy"
                                                                value-format="yyyy-MM-dd"
                                                                @change="
                                                                    calculoFecha
                                                                "
                                                            >
                                                            </el-date-picker>
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
                                                        >Duracion (Días)</label
                                                    >
                                                    <div
                                                        class="col-md-3"
                                                        v-if="
                                                            calculoFechas !=
                                                            'NaN'
                                                        "
                                                    >
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillCrearInformeValorizacion.cDuracion
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >O/S N°</label
                                                    >
                                                    <div class="col-md-9">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillCrearInformeValorizacion.nIdOS
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-2 col-form-label"
                                                        >Importe O/S
                                                        (S/.)</label
                                                    >
                                                    <div class="col-md-2">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillCrearInformeValorizacion.cImporte
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- INICIO  DE REQUERIMIENTOS DE MATERIALES -->

                                    <div class="container-fluid">
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div
                                                        class="card card-primary"
                                                    >
                                                        <div
                                                            class="card-header"
                                                        >
                                                            <h3
                                                                class="card-title"
                                                            >
                                                                REQUERIMIENTOS
                                                                DE MATERIALES
                                                            </h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div
                                                                class="form-group row"
                                                            >
                                                                <label
                                                                    class="col-md-2 col-form-label"
                                                                    >DESCRIPCION
                                                                    DEL
                                                                    MATERIAL</label
                                                                >

                                                                <div
                                                                    class="col-md-10"
                                                                >
                                                                    <el-select
                                                                        v-model="
                                                                            fillCrearInformeValorizacion.nIdmaterial
                                                                        "
                                                                        style="
                                                                            width: 90%;
                                                                        "
                                                                        filterable
                                                                        placeholder="Select"
                                                                    >
                                                                        <v-row
                                                                            align="right"
                                                                        >
                                                                            <el-option
                                                                                v-for="item in listProd"
                                                                                :key="
                                                                                    item.id
                                                                                "
                                                                                :label="
                                                                                    item.codigo +
                                                                                    ' - ' +
                                                                                    item
                                                                                        .familia
                                                                                        .nombre +
                                                                                    ' , ' +
                                                                                    item
                                                                                        .subfamilia
                                                                                        .nombre +
                                                                                    ' , Modelo: ' +
                                                                                    item
                                                                                        .modelotipo
                                                                                        .nombre +
                                                                                    ' , Marca : ' +
                                                                                    item
                                                                                        .marca
                                                                                        .nombre +
                                                                                    ' , Material : ' +
                                                                                    item
                                                                                        .material
                                                                                        .nombre +
                                                                                    ' ,' +
                                                                                    item
                                                                                        .homologacion
                                                                                        .nombre
                                                                                "
                                                                                :value="
                                                                                    item.id
                                                                                "
                                                                            >
                                                                            </el-option>
                                                                        </v-row>
                                                                    </el-select>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="form-group row"
                                                            >
                                                                <label
                                                                    class="col-md-2 col-form-label"
                                                                    >CANTIDAD</label
                                                                >
                                                                <div
                                                                    class="col-md-3"
                                                                >
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        v-model="
                                                                            fillCrearInformeValorizacion.cCantMaterial
                                                                        "
                                                                    />
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="col-md-6"
                                                            >
                                                                <div
                                                                    class="form-group row"
                                                                >
                                                                    <label
                                                                        class="col-md-4 col-form-label"
                                                                        >MEDIDA</label
                                                                    >
                                                                    <div
                                                                        class="col-md-4"
                                                                    >
                                                                        <el-select
                                                                            v-model="
                                                                                fillCrearInformeValorizacion.nIdUnidMedMat
                                                                            "
                                                                            placeholder="Select"
                                                                            style="
                                                                                width: 70%;
                                                                            "
                                                                        >
                                                                            <el-option
                                                                                v-for="item in listUnidMed"
                                                                                :key="
                                                                                    item.id
                                                                                "
                                                                                :label="
                                                                                    item.nombre
                                                                                "
                                                                                :value="
                                                                                    item.id
                                                                                "
                                                                            >
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
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button
                                            class="btn btn-flat btn-primary btnWidth"
                                            @click.prevent="setAddReqMaterial"
                                        >
                                            Agregar
                                        </button>
                                        <button
                                            class="btn btn-flat btn-default btnWidth"
                                            @click.prevent="setCleanMaterial"
                                        >
                                            Limpiar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!--  Bandeja de Resultados -->
                            <div class="card card-primary">
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
                                                <th>Descripcion</th>
                                                <th>Unid. Medida</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    item, index
                                                ) in listartempProduccion"
                                                :key="index"
                                            >
                                                <td v-text="item.codigo"></td>
                                                <td v-text="item.cantidad"></td>

                                                <td
                                                    v-text="
                                                        item.productoFamilia +
                                                        ' ' +
                                                        item.productoSubfamilia +
                                                        ', MARCA :' +
                                                        item.productoMarca +
                                                        ', MODELO/TIPO :' +
                                                        item.productoModelotipo +
                                                        ', MATERIAL :' +
                                                        item.material
                                                    "
                                                ></td>
                                                <td
                                                    v-text="item.unidMedida"
                                                ></td>
                                                <td>
                                                    <button
                                                        class="btn btn-danger btn-sm"
                                                        @click.prevent="
                                                            DeletListInfoValMateriales(
                                                                item.producto_id
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="fas fa-trash-alt"
                                                        ></i>
                                                        Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!--         <div class="card-footer">
                  <div class="row">
                    <div class="col-md-4 offset-4">
                      <button
                        class="btn btn-flat btn-info btnWidth"
                        @click.prevent="setGrabarInfValorizacion"
                      >
                        Guardar
                      </button>
                      <button
                        class="btn btn-flat btn-default btnWidth"
                        @click.prevent="eliminarTempitemOrders"
                      >
                        Limpiar
                      </button>
                    </div>
                  </div>
                </div> -->
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
                                    REQUERIMIENTOS MANO DE OBRA (DIAS, HORAS,
                                    HOMBRES)
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label"
                                        >PERSONAL</label
                                    >

                                    <div class="col-md-6">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="
                                                fillCrearInformeValorizacion.cPersonal
                                            "
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-md-2 col-form-label"
                                    ></label>
                                    <div class="col-md-6">
                                        <el-radio
                                            v-model="
                                                fillCrearInformeValorizacion.radTipoTiempo
                                            "
                                            @change="onChange($event)"
                                            label="1"
                                            checked
                                            >POR DIAS
                                        </el-radio>
                                        <el-radio
                                            v-model="
                                                fillCrearInformeValorizacion.radTipoTiempo
                                            "
                                            @change="onChange($event)"
                                            label="2"
                                            >POR HORAS
                                        </el-radio>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label"
                                        >DIAS</label
                                    >
                                    <div class="col-md-2">
                                        <input
                                            type="text"
                                            class="form-control"
                                            :disabled="validatedDias"
                                            v-model="
                                                fillCrearInformeValorizacion.cDiasMObra
                                            "
                                            v-int
                                        />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label"
                                        >HORAS</label
                                    >
                                    <div class="col-md-2">
                                        <input
                                            type="text"
                                            class="form-control"
                                            :disabled="validateHoras"
                                            v-model="
                                                fillCrearInformeValorizacion.cHorasMObra
                                            "
                                            v-int
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-4 offset-4">
                            <button
                                class="btn btn-flat btn-success btnWidth"
                                @click.prevent="setAddMObra"
                            >
                                Agregar
                            </button>
                            <button
                                class="btn btn-flat btn-default btnWidth"
                                @click.prevent="setCleanManoObra"
                            >
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
                        <table
                            class="table table-hover table-head-fixed text-nowrap projects"
                        >
                            <thead>
                                <tr>
                                    <th>Personal</th>
                                    <th>Días</th>
                                    <th>Horas</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in listartempMobra"
                                    :key="index"
                                >
                                    <td v-text="item.personal"></td>
                                    <td v-text="item.dias"></td>
                                    <td v-text="item.horas"></td>
                                    <td>
                                        <button
                                            class="btn btn-danger btn-sm"
                                            @click.prevent="
                                                DeletListReqMaNObra(
                                                    item.personal
                                                )
                                            "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            Eliminar
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
                            <div
                                class="card-header"
                                style="background-color: #9b59b6; color: white"
                            >
                                <h3 class="card-title">OTROS REQUERIMIENTOS</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label"
                                        >DESCRIPCION</label
                                    >

                                    <div class="col-md-10">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="
                                                fillCrearInformeValorizacion.cDescripcion
                                            "
                                        />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label"
                                        >CANTIDAD</label
                                    >
                                    <div class="col-md-2">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="
                                                fillCrearInformeValorizacion.cCantidadReq
                                            "
                                        />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label"
                                        >PRECIO</label
                                    >
                                    <div class="col-md-2">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="
                                                fillCrearInformeValorizacion.precioOtros
                                            "
                                        />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label
                                                class="col-md-4 col-form-label"
                                                >CANTIDAD ALQUILER</label
                                            >
                                            <div class="col-md-2">
                                                <input
                                                    type="number"
                                                    min="0"
                                                    class="form-control"
                                                    v-model="
                                                        fillCrearInformeValorizacion.cCantAlq
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label
                                                class="col-md-4 col-form-label"
                                                >TIEMPO ALQUILER</label
                                            >
                                            <div class="col-md-4">
                                                <el-select
                                                    v-model="
                                                        fillCrearInformeValorizacion.nIdAlquiler
                                                    "
                                                    placeholder="Select"
                                                    style="width: 70%"
                                                >
                                                    <el-option
                                                        v-for="item in listTiempoAlquiler"
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-4 offset-4">
                            <button
                                class="btn btn-flat btnWidth"
                                style="background-color: #9b59b6; color: white"
                                @click.prevent="setOtrosRequerimientos"
                            >
                                Agregar
                            </button>
                            <button
                                class="btn btn-flat btn-default btnWidth"
                                @click.prevent="setCleanRequerimientos"
                            >
                                Limpiar
                            </button>
                        </div>
                    </div>
                </div>

                <!--  Bandeja de Resultados -->
                <div class="card card-light">
                    <div
                        class="card-header"
                        style="background-color: #9b59b6; color: white"
                    >
                        <h3 class="card-title">Bandeja de Resultados</h3>
                    </div>

                    <div class="card-body table-responsive">
                        <table
                            class="table table-hover table-head-fixed text-nowrap projects"
                        >
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Tiempo</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(
                                        item, index
                                    ) in listartempRequerimientos"
                                    :key="index"
                                >
                                    <td v-text="item.descripcion"></td>
                                    <td v-text="item.AlquilerNombre"></td>
                                    <td v-text="item.cantidad"></td>
                                    <td v-text="item.precioOtros"></td>
                                    <td v-text="item.cantidad * item.precioOtros"></td>
                                   

                                    <td>
                                        <button
                                            class="btn btn-danger btn-sm"
                                            @click.prevent="
                                                DeletListOtrosReq(
                                                    item.descripcion
                                                )
                                            "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            Eliminar
                                        </button>
                                    </td>
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
                                @click.prevent="setRegistrarInfValorizacion"
                            >
                                Guardar
                            </button>
                            <button
                                class="btn btn-flat btn-default btnWidth"
                                @click.prevent="eliminarTempitemOrders"
                            >
                                Limpiar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FIN DE OTROS REQUERIMIENTOS -->

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
            fillCrearInformeValorizacion: {
                nIdProveedor: this.$attrs.id,
                nIdCcostos: "",

                nIdClient: "",
                FInicio: "",
                FFinal: "",
                cDuracion: "",
                nIdDetServ: "",
                cImporte: "",
                nIdOS: "",
                cCantAlq:"",
                nIdAlquiler:"",
                precioOtros:"",

                cDocumento: "",
                cFechaEmision: "",
                nidAlmacen: "",
                cRSocial: "",
                cRuc: "",
                nIdmaterial: "",
                cCantMaterial: "",
                cCantidad: "",
                nIdTipoPago: "",
                nIdTipoMoneda: "",
                nIdUser: sessionStorage.getItem("iduser"),
                cPersonal: "",
                cDiasMObra: "",
                cHorasMObra: "",
                cDescripcion: "",
                cCantidadReq: "",
                nIdUnidMed: "",
                nIdUnidMedMat: "",
                radTipoTiempo: "1",
                estado: "",
            },
            listAlmacen: [],
            listUnidMed: [],
            listTiempoAlquiler:[],
            listProd: [],
            listCCostos: [],
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
        };
    },

    mounted() {
        this.getListarByProveedor();
        this.getListarproductosByName();
        this.getlistTipoCambio();
        this.defaultDiaHora();
        this.getListarUnidadMedida();
        this.getListarCentroCostos();
        this.getListarTiempoAlquiler();
    },

    methods: {
        calculoFecha() {
            if (
                this.fillCrearInformeValorizacion.FFinal != null &&
                this.fillCrearInformeValorizacion.FInicio != null
            ) {
                let valorfecha =
                    new Date(
                        this.fillCrearInformeValorizacion.FFinal
                    ).getTime() -
                    new Date(
                        this.fillCrearInformeValorizacion.FInicio
                    ).getTime();
                this.fillCrearInformeValorizacion.cDuracion = String(
                    valorfecha / 86400000 + 1
                ).padStart(2, 0);
            }
        },
        onChange(e) {
            if (e == 1) {
                this.fillCrearInformeValorizacion.cHorasMObra = 0;
                this.validateHoras = true;
                this.validatedDias = false;
            }
            if (e == 2) {
                this.fillCrearInformeValorizacion.cDiasMObra = 0;
                this.validateHoras = false;
                this.validatedDias = true;
            }
        },

        onChangeClient(e) {
            if (e == 1) {
                this.fillCrearInformeValorizacion.cRuc = "";
            }
            if (e == 2) {
                this.fillCrearInformeValorizacion.nidAlmacen = "";
                this.fillCrearInformeValorizacion.cRSocial = "";
            }
        },
        defaultDiaHora() {
            this.fillCrearInformeValorizacion.cCantidadReq = 0;
            this.fillCrearInformeValorizacion.cDiasMObra = 0;
            this.fillCrearInformeValorizacion.cHorasMObra = 0;
            this.fillCrearInformeValorizacion.cCantAlq = 0;
        },

        consultaRuc() {
            var url = "/administracion/cliente/consultaRuc";
            axios
                .post(url, {
                    cRuc: this.fillCrearInformeValorizacion.cRuc,
                })
                .then((response) => {
                    if (response.data.success == false) {
                        (this.fillCrearInformeValorizacion.cRSocial = ""),
                            Swal.fire({
                                position: "center",
                                icon: "info",
                                title: "Ruc no encontrado o numero equivocado",
                                showConfirmButton: false,
                                timer: 2000,
                            });
                    } else {
                        this.fillCrearInformeValorizacion.cRSocial =
                            response.data.razonSocial;
                        /*        (this.fillRegistrarCliente.cDireccion = response.data.direccion),
                            (this.estadobutton = false);
                          this.disabledbtnRuc = true; */
                    }
                });
        },

        setAddMObra() {
            var url = "/administracion/informeValorizacion/addInfoValorManObra";
            axios
                .post(url, {
                    cPersonal: this.fillCrearInformeValorizacion.cPersonal,
                    cDiasMObra: this.fillCrearInformeValorizacion.cDiasMObra,
                    cHorasMObra: this.fillCrearInformeValorizacion.cHorasMObra,
                    estado: "R",
                })
                .then((response) => {
                    this.listartempMobra = response.data.datos;
                    this.setcleanListMObra();
                    this.fillCrearInformeValorizacion.cDiasMObra = 0;
                    this.fillCrearInformeValorizacion.cHorasMObra = 0;
                });
        },

        setcleanListMObra() {
            (this.fillCrearInformeValorizacion.cPersonal = ""),
                (this.fillCrearInformeValorizacion.cDiasMObra = 0);
            this.fillCrearInformeValorizacion.cHorasMObra = 0;
        },

        setOtrosRequerimientos() {
            var url =
                "/administracion/informeValorizacion/addOtrosProyInfoValor";
            axios
                .post(url, {
                    cDescripcion:
                        this.fillCrearInformeValorizacion.cDescripcion,
                    cCantidadReq:
                        this.fillCrearInformeValorizacion.cCantidadReq,
                    estado: "R",
                    cCantAlq: this.fillCrearInformeValorizacion.cCantAlq,
                    nIdAlquiler: this.fillCrearInformeValorizacion.nIdAlquiler,
                    precioOtros: this.fillCrearInformeValorizacion.precioOtros
                    
                })
                .then((response) => {
                    if (
                        response.data.message ==
                        "El valor no puede ser cero ni vacio"
                    ) {
                        Swal.fire({
                            position: "center",
                            icon: response.data.icon,
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    } else {
                        this.listartempRequerimientos = response.data.datos;
                        this.setLimpiaRequerimientos();
                        this.fillCrearInformeValorizacion.cCantidadReq = 0;
                        this.setLimpiaOtrosRequerimientos();
                    }
                });
        },

        setLimpiaOtrosRequerimientos(){

            this.fillCrearInformeValorizacion.cDescripcion="",
            this.fillCrearInformeValorizacion.cCantidadReq="",
            this.fillCrearInformeValorizacion.cCantAlq=0,
           this.fillCrearInformeValorizacion.precioOtros=0
           this.fillCrearInformeValorizacion.nIdAlquiler =this.listTiempoAlquiler[0].id;
        },

        setLimpiaRequerimientos() {
            (this.fillCrearInformeValorizacion.cDescripcion = ""),
                (this.fillCrearInformeValorizacion.cCantidadReq = 0);
        },

        DeletListInfoValMateriales(item) {
            var url =
                "/administracion/informeValorizacion/reorderReqMateriales";
            axios
                .post(url, {
                    item: item,
                })
                .then((response) => {
                    this.listartempProduccion = response.data.datos;
                });
        },

        DeletListReqMaNObra(item) {
            var url = "/administracion/informeValorizacion/reorderReqManObra";
            axios
                .post(url, {
                    item: item,
                })
                .then((response) => {
                    this.listartempMobra = response.data.datos;
                });
        },

        DeletListOtrosReq(item) {
            var url = "/administracion/informeValorizacion/reorderOtrosReq";
            axios
                .post(url, {
                    item: item,
                })
                .then((response) => {
                    this.listartempRequerimientos = response.data.datos;
                });
        },

        getListarByProveedor() {
            var url = "/administracion/proveedor/getListarProveedorById";
            axios
                .get(url, {
                    params: {
                        nIdProveedor:
                            this.fillCrearInformeValorizacion.nIdProveedor,
                    },
                })
                .then((response) => {
                    this.fillCrearInformeValorizacion.cCodProduct =
                        response.data.nombre;
                });
        },

        getlistTipoCambio() {
            var url = "/administracion/ordenCompra/TipoCambio";
            axios.get(url).then((response) => {
                this.listTipoCambio = response.data;
                this.fillCrearInformeValorizacion.nIdTipoMoneda =
                    this.listTipoCambio[0].id;
            });
        },

        getListarCentroCostos() {
            var url = "/administracion/CentroCostos/list";
            axios.get(url).then((response) => {
                this.listCCostos = response.data;
            });
        },
        getListarproductosByName() {
            var url = "/administracion/detallecotizancion/listProdByName";
            axios
                .get(url, {
                    params: {
                        nIdmaterial:
                            this.fillCrearInformeValorizacion.nIdmaterial,
                    },
                })
                .then((response) => {
                    this.listProd = response.data;
                });
        },

        limpiarCriteriosBsq() {
            this.fillCrearInformeValorizacion.cCodProduct = "";
        },
        setRegistrarInfValorizacion() {
            if (this.validaInfValorizacion()) {
                this.modalShow = true;
                return;
            }
            this.setGrabarInfValorizacion();
        },

        setGrabarInfValorizacion() {
            var url = "/administracion/InformeValorizacion/create";
            axios
                .post(url, {
                    nidAlmacen: this.fillCrearInformeValorizacion.nidAlmacen,
                    cRuc: this.fillCrearInformeValorizacion.cRuc,
                    FInicio: this.fillCrearInformeValorizacion.FInicio,
                    FFinal: this.fillCrearInformeValorizacion.FFinal,
                    nIdUser: this.fillCrearInformeValorizacion.nIdUser,
                    Duracionfechas: this.fillCrearInformeValorizacion.cDuracion,
                    nIdUnidMed: this.fillCrearInformeValorizacion.nIdUnidMed,
                    cImporte: this.fillCrearInformeValorizacion.cImporte,
                    nIdCcostos: this.fillCrearInformeValorizacion.nIdCcostos,
                    nIdClient: this.fillCrearInformeValorizacion.nIdClient,
                    detservicio: this.fillCrearInformeValorizacion.detservicio,
                    cDuracion: this.fillCrearInformeValorizacion.cDuracion,
                    nIdOS: this.fillCrearInformeValorizacion.nIdOS,
                    cImporte: this.fillCrearInformeValorizacion.cImporte,
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
        validaInfValorizacion() {
            this.error = 0;
            this.mensajeError = [];

            if (!this.fillCrearInformeValorizacion.nIdCcostos) {
                this.mensajeError.push("El Centro de Costos es obligatorio");
            }

            if (!this.fillCrearInformeValorizacion.FInicio) {
                this.mensajeError.push("Fecha Inicio es campo obligatorio");
            }

            if (!this.fillCrearInformeValorizacion.FFinal) {
                this.mensajeError.push("Fecha Final es campo obligatorio");
            }

            if (!this.fillCrearInformeValorizacion.nIdClient) {
                this.mensajeError.push("Cliente Campo Obligatorio");
            }

            if (!this.fillCrearInformeValorizacion.cImporte) {
                this.mensajeError.push("Campo Referencia es Campo Obligatorio");
            }

            if (!this.fillCrearInformeValorizacion.detservicio) {
                this.mensajeError.push("Detalle Servicio Campo Obligatorio");
            }

            if (!this.fillCrearInformeValorizacion.nIdOS) {
                this.mensajeError.push("Campo O/S Campo Obligatorio");
            }

            if (this.mensajeError.length) {
                this.error = 1;
            }

            return this.error;
        },
        setAddReqMaterial() {
            var url = "/administracion/informeValorizacion/addReqMatInfoValor";

            axios
                .post(url, {
                    nIdmaterial: this.fillCrearInformeValorizacion.nIdmaterial,
                    cCantMaterial:
                        this.fillCrearInformeValorizacion.cCantMaterial,
                    nIdUnidMedMat:
                        this.fillCrearInformeValorizacion.nIdUnidMedMat,
                    estado: "R",
                })
                .then((response) => {
                    if (
                        response.data.message == "Ya fue agregado anteriormente"
                    ) {
                        Swal.fire({
                            position: "center",
                            icon: response.data.icon,
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    } else {
                        this.listartempProduccion = response.data.datos;
                        this.setLimpiaMaterial();
                        this.fillCrearInformeValorizacion.cCantMaterial = 0;
                    }

                    if (response.data.message == "El valor no puede ser cero") {
                        Swal.fire({
                            position: "center",
                            icon: response.data.icon,
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    } else {
                        this.listartempProduccion = response.data.datos;
                        this.setLimpiaMaterial();
                        this.fillCrearInformeValorizacion.cCantMaterial = 0;
                    }
                });
        },

        setLimpiaMaterial() {
            (this.fillCrearInformeValorizacion.nIdmaterial = ""),
                (this.fillCrearInformeValorizacion.cCantMaterial = 0);
        },

        setLimpiaCampos() {
            this.fillCrearInformeValorizacion.nIdmaterial = null;
            this.fillCrearInformeValorizacion.cCantidad = 0;
        },

        setResetCampos() {
            this.fillCrearInformeValorizacion.nIdmaterial = null;
            this.fillCrearInformeValorizacion.cCantidad = 0;

            this.fillCrearInformeValorizacion.cImporte = "";
            this.fillCrearInformeValorizacion.cDocumento = "";
        },

        setCleanMaterial() {
            var url = "/administracion/informeValorizacion/eliminarTemporder";
            axios.get(url, {}).then((response) => {
                this.listartempProduccion = response.data.datos;
                this.setLimpiaMaterial();
            });
        },

        setCleanManoObra() {
            var url = "/administracion/informeValorizacion/CleanProyectManObra";
            axios.get(url, {}).then((response) => {
                this.listartempMobra = response.data.datos;
                this.setcleanListMObra();
            });
        },

        setCleanRequerimientos() {
            var url =
                "/administracion/informeValorizacion/CleanOtrosProyInfoValor";
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

        eliminarTempitemOrders() {
            var url = "/administracion/ordenCompra/eliminarTemporder";
            axios.post(url).then((response) => {
                this.setListtemOrders();
            });
        },
        getListarUnidadMedida() {
            var url = "/administracion/KardexDetalle/listUnidMed";
            axios.get(url).then((response) => {
                this.listUnidMed = response.data;
                this.fillCrearInformeValorizacion.nIdUnidMed =
                    this.listUnidMed[7].id;
                this.fillCrearInformeValorizacion.nIdUnidMedMat =
                    this.listUnidMed[7].id;
            });
        },

        getListarTiempoAlquiler() {
            var url = " /administracion/TiempoAlquiler/list";
            axios.get(url).then((response) => {
                this.listTiempoAlquiler = response.data;
                this.fillCrearInformeValorizacion.nIdAlquiler =
                    this.listTiempoAlquiler[0].id;
                
            });
        },
    },

   



    computed: {
        calculoFechas() {
            if (
                this.fillCrearInformeValorizacion.FFinal != null &&
                this.fillCrearInformeValorizacion.FInicio != null
            ) {
                let valorfecha =
                    new Date(
                        this.fillCrearInformeValorizacion.FFinal
                    ).getTime() -
                    new Date(
                        this.fillCrearInformeValorizacion.FInicio
                    ).getTime();
                return String(valorfecha / 86400000 + 1).padStart(2, 0);
            }
        },
    },
};
</script>

<style></style>
