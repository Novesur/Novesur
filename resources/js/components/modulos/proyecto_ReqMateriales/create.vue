<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">
                            Requerimientos de Materiales - Proyectos
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
                                                                fillCrearReqMaterialesProy.nIdCcostos
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
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-3 col-form-label"
                                                        >Cliente</label
                                                    >
                                                    <div class="col-md-6">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillCrearReqMaterialesProy.nIdClient
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
                                                        >RUC
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                fillCrearReqMaterialesProy.cRuc
                                                            "
                                                            :maxlength="11"
                                                        />
                                                    </div>
                                                    <div class="text-center">
                                                        <span
                                                            style="
                                                                color: red;
                                                                text-align: end;
                                                            "
                                                            >{{
                                                                this
                                                                    .fillCrearReqMaterialesProy
                                                                    .cRuc
                                                                    .length +
                                                                " " +
                                                                "Caracteres"
                                                            }}</span
                                                        >
                                                    </div>
                                                    <div class="col">
                                                        <span>
                                                            <button
                                                                class="btn btn-success btn-sm"
                                                                @click.prevent="
                                                                    consultaRuc
                                                                "
                                                            >
                                                                <span
                                                                    ><i
                                                                        class="fas fa-search"
                                                                    ></i>
                                                                    Consultar
                                                                    Ruc</span
                                                                >
                                                            </button></span
                                                        >
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
                                                            fillCrearReqMaterialesProy.detservicio
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
                                                                fillCrearReqMaterialesProy.FInicio
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
                                                                    fillCrearReqMaterialesProy.FFinal
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
                                                                fillCrearReqMaterialesProy.cDuracion
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
                                                                fillCrearReqMaterialesProy.nIdOS
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
                                                                            fillCrearReqMaterialesProy.nIdmaterial
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
                                                                            fillCrearReqMaterialesProy.cCantMaterial
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
                                                                                fillCrearReqMaterialesProy.nIdUnidMedMat
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
                                            @click.prevent="
                                                setRegistrarReqMaterialesList
                                            "
                                        >
                                            Agregar
                                        </button>
                                        <button
                                            class="btn btn-flat btn-default btnWidth"
                                            @click.prevent="setCleanReqMateriales"
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
                                                            DeletListReqMateriales(
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
                      @click.prevent="setGrabarReqMateriales"
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
                                        <el-select
                                            v-model="fillCrearReqMaterialesProy.nIdPersonal"
                                            placeholder="Seleccione un Personal"
                                            clearable
                                            filterable
                                            :style="{ width: '350px' }"
                                            
                                        >
                                            <el-option
                                                v-for="item in listPersonal"
                                                :key="item.id"
                                                :label="item.nombres +' '+ item.ApPaterno+' '+ item.ApMaterno"
                                                :value="item.id"
                                            >
                                            </el-option>
                                        </el-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-md-2 col-form-label"
                                    ></label>
                                    <div class="col-md-6">
                                        <el-radio
                                            v-model="
                                                fillCrearReqMaterialesProy.radTipoTiempo
                                            "
                                            @change="onChange($event)"
                                            label="1"
                                            checked
                                            >POR DIAS
                                        </el-radio>
                                        <el-radio
                                            v-model="
                                                fillCrearReqMaterialesProy.radTipoTiempo
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
                                                fillCrearReqMaterialesProy.cDiasMObra
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
                                                fillCrearReqMaterialesProy.cHorasMObra
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
                                    <td v-text="item.personal_nombres +' '+ item.personal_paterno +' '+ item.personal_materno"></td>
                                    <td v-text="item.dias"></td>
                                    <td v-text="item.horas"></td>
                                    <td>
                                        <button
                                            class="btn btn-danger btn-sm"
                                            @click.prevent="
                                                DeletListReqMaNObra(
                                                    item.id_personal
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
                                                fillCrearReqMaterialesProy.cDescripcion
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
                                                fillCrearReqMaterialesProy.cCantidadReq
                                            "
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label"
                                        >Unid. Medida</label
                                    >
                                    <div class="col-md-2">
                                        <el-select
                                            v-model="
                                                fillCrearReqMaterialesProy.nIdUnidMedOtroReq
                                            "
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
                                @click.prevent="setCleanOtrosReq"
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
                                    <th>Alquiler</th>
                                    <th>Cantidad</th>
                                    <th>Unid.Medida</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(
                                        item, index
                                    ) in listartempOtrosRequerimientos"
                                    :key="index"
                                >
                                    <td v-text="item.descripcion"></td>
                                    <td v-text="item.NomAlquiler"></td>
                                    <td v-text="item.cantidad"></td>
                                    <td v-text="item.NomUnidmed"></td>
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
                                @click.prevent="setRegistrarReqMateriales"
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
            fillCrearReqMaterialesProy: {
                nIdProveedor: this.$attrs.id,
                nIdCcostos: "",

                nIdClient: "",
                FInicio: "",
                FFinal: "",
                cDuracion: "",
                nIdDetServ: "",
                nIdOS: "",
                cUnidMed: "",
                nIdUnidMedOtroReq: "",
                nIdPersonal:"",

                cRuc: "",

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
            listPersonal:[],
            listUnidMed: [],
            listProd: [],
            listCCostos: [],
            listartempProduccion: [],
            listartempMobra: [],
            listartempRequerimientos: [],
            listartempOtrosRequerimientos: [],
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
        this.getListPersonal();
    },

    methods: {
        calculoFecha() {
            if (
                this.fillCrearReqMaterialesProy.FFinal != null &&
                this.fillCrearReqMaterialesProy.FInicio != null
            ) {
                let valorfecha =
                    new Date(this.fillCrearReqMaterialesProy.FFinal).getTime() -
                    new Date(this.fillCrearReqMaterialesProy.FInicio).getTime();
                this.fillCrearReqMaterialesProy.cDuracion = String(
                    valorfecha / 86400000 + 1
                ).padStart(2, 0);
            }
        },
        onChange(e) {
            if (e == 1) {
                this.fillCrearReqMaterialesProy.cHorasMObra = 0;
                this.validateHoras = true;
                this.validatedDias = false;
            }
            if (e == 2) {
                this.fillCrearReqMaterialesProy.cDiasMObra = 0;
                this.validateHoras = false;
                this.validatedDias = true;
            }
        },

        onChangeClient(e) {
            if (e == 1) {
                this.fillCrearReqMaterialesProy.cRuc = "";
            }
            if (e == 2) {
                this.fillCrearReqMaterialesProy.nidAlmacen = "";
                this.fillCrearReqMaterialesProy.cRSocial = "";
            }
        },
        defaultDiaHora() {
            this.fillCrearReqMaterialesProy.cCantidadReq = 0;
            this.fillCrearReqMaterialesProy.cDiasMObra = 0;
            this.fillCrearReqMaterialesProy.cHorasMObra = 0;
        },

        consultaRuc() {
            var url = "/administracion/cliente/consultaRuc";
            axios
                .post(url, {
                    cRuc: this.fillCrearReqMaterialesProy.cRuc,
                })
                .then((response) => {
                    if (response.data.success == false) {
                        (this.fillCrearReqMaterialesProy.cRSocial = ""),
                            Swal.fire({
                                position: "center",
                                icon: "info",
                                title: "Ruc no encontrado o numero equivocado",
                                showConfirmButton: false,
                                timer: 2000,
                            });
                    } else {
                        this.fillCrearReqMaterialesProy.nIdClient =
                            response.data.razonSocial;
                        /*        (this.fillRegistrarCliente.cDireccion = response.data.direccion),
                          (this.estadobutton = false);
                        this.disabledbtnRuc = true; */
                    }
                });
        },

        setAddMObra() {
            var url = "/administracion/ProyectoManoObra/addProyManObra";
            axios
                .post(url, {
                    nIdPersonal: this.fillCrearReqMaterialesProy.nIdPersonal,
                    cDiasMObra: this.fillCrearReqMaterialesProy.cDiasMObra,
                    cHorasMObra: this.fillCrearReqMaterialesProy.cHorasMObra,
                    estado: "R",
                })
                .then((response) => {
                    this.listartempMobra = response.data.datos;
                    this.setcleanListMObra();
                    this.fillCrearReqMaterialesProy.cDiasMObra = 0;
                    this.fillCrearReqMaterialesProy.cHorasMObra = 0;
                });
        },

        getListPersonal() {
            var url = "/administracion/personal/list";
            axios.get(url).then((response) => {
                this.listPersonal = response.data;
            });
        },

        setcleanListMObra() {
            (this.fillCrearReqMaterialesProy.cPersonal = ""),
                (this.fillCrearReqMaterialesProy.cDiasMObra = 0);
            this.fillCrearReqMaterialesProy.cHorasMObra = 0;
        },

        setOtrosRequerimientos() {
            var url =
                "/administracion/ProyectOtrosReq/addOtrosProyReqMateriales"; 
            axios
                .post(url, {
                    cDescripcion: this.fillCrearReqMaterialesProy.cDescripcion,
                    cCantidadReq: this.fillCrearReqMaterialesProy.cCantidadReq,
                    nIdUnidMedOtroReq: this.fillCrearReqMaterialesProy.nIdUnidMedOtroReq,
                    estado: "R",

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
                        this.listartempOtrosRequerimientos =
                            response.data.datos;
                        this.setLimpiaRequerimientos();
                        this.fillCrearReqMaterialesProy.cCantidadReq = 0;
                    }
                });
        },

        setLimpiaRequerimientos() {
            (this.fillCrearReqMaterialesProy.cDescripcion = ""),
                (this.fillCrearReqMaterialesProy.cCantidadReq = 0);
        },

        DeletListReqMateriales(item) {
            var url = "/administracion/ProyectoMateriales/reorderReqMateriales";
            axios
                .post(url, {
                    item: item,
                })
                .then((response) => {
                    this.listartempProduccion = response.data.datos;
                });
        },

        DeletListReqMaNObra(item) {
            var url =
                "/administracion/ProyectoManoObra/reorderProyectManObra";
            axios
                .post(url, {
                    item: item,
                })
                .then((response) => {
                    this.listartempMobra = response.data.datos;
                });
        },

        DeletListOtrosReq(item) {
            var url = "/administracion/ProyectOtrosReq/reorderOtrosReq";
            axios
                .post(url, {
                    item: item,
                })
                .then((response) => {
                    this.listartempOtrosRequerimientos = response.data.datos;
                });
        },

        getListarByProveedor() {
            var url = "/administracion/proveedor/getListarProveedorById";
            axios
                .get(url, {
                    params: {
                        nIdProveedor:
                            this.fillCrearReqMaterialesProy.nIdProveedor,
                    },
                })
                .then((response) => {
                    this.fillCrearReqMaterialesProy.cCodProduct =
                        response.data.nombre;
                });
        },

        getlistTipoCambio() {
            var url = "/administracion/ordenCompra/TipoCambio";
            axios.get(url).then((response) => {
                this.listTipoCambio = response.data;
                this.fillCrearReqMaterialesProy.nIdTipoMoneda =
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
                            this.fillCrearReqMaterialesProy.nIdmaterial,
                    },
                })
                .then((response) => {
                    this.listProd = response.data;
                });
        },

        limpiarCriteriosBsq() {
            this.fillCrearReqMaterialesProy.cCodProduct = "";
        },
        setRegistrarReqMateriales() {
            if (this.validaOrdenProduccion()) {
                this.modalShow = true;
                return;
            }
            this.setGrabarReqMateriales();
        },

        setGrabarReqMateriales() {
            var url = "/administracion/proyecto_ReqMateriales/create";
            axios
                .post(url, {
                    nidAlmacen: this.fillCrearReqMaterialesProy.nidAlmacen,
                    cRuc: this.fillCrearReqMaterialesProy.cRuc,
                    FInicio: this.fillCrearReqMaterialesProy.FInicio,
                    FFinal: this.fillCrearReqMaterialesProy.FFinal,
                    nIdUser: this.fillCrearReqMaterialesProy.nIdUser,
                    Duracionfechas: this.fillCrearReqMaterialesProy.cDuracion,
                    nIdUnidMed: this.fillCrearReqMaterialesProy.nIdUnidMed,
                    nIdCcostos: this.fillCrearReqMaterialesProy.nIdCcostos,
                    nIdClient: this.fillCrearReqMaterialesProy.nIdClient,
                    detservicio: this.fillCrearReqMaterialesProy.detservicio,
                    cDuracion: this.fillCrearReqMaterialesProy.cDuracion,
                    nIdOS: this.fillCrearReqMaterialesProy.nIdOS,
                })
                .then((response) => {
                    Swal.fire({
                        position: "center",
                        icon: response.data.icon,
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    this.setCleanReqMateriales();
                    this.setCleanManoObra();
                    this.setCleanRequerimientos();
                    this.setCleanOtrosReq();
                });
        },
        abrirModal() {
            this.modalShow = !this.modalShow;
        },
        validaOrdenProduccion() {
            this.error = 0;
            this.mensajeError = [];

            if (!this.fillCrearReqMaterialesProy.nIdCcostos) {
                this.mensajeError.push("El Centro de Costos es obligatorio");
            }

            if (!this.fillCrearReqMaterialesProy.FInicio) {
                this.mensajeError.push("Fecha Inicio es campo obligatorio");
            }

            if (!this.fillCrearReqMaterialesProy.FFinal) {
                this.mensajeError.push("Fecha Final es campo obligatorio");
            }

            if (!this.fillCrearReqMaterialesProy.nIdClient) {
                this.mensajeError.push("Cliente Campo Obligatorio");
            }

            if (!this.fillCrearReqMaterialesProy.detservicio) {
                this.mensajeError.push("Detalle Servicio Campo Obligatorio");
            }

            if (!this.fillCrearReqMaterialesProy.nIdOS) {
                this.mensajeError.push("Campo O/S  Obligatorio");
            }

            if (this.mensajeError.length) {
                this.error = 1;
            }

            return this.error;
        },

        setRegistrarReqMaterialesList() {
            if (this.setvalidarReqMateriales()) {
                this.modalShow = true;
                return;
            }
            this.setAddReqMaterial();
        },

        setvalidarReqMateriales() {
            this.error = 0;
            this.mensajeError = [];

            if (!this.fillCrearReqMaterialesProy.nIdmaterial) {
                this.mensajeError.push(
                    "Campo Material de requerimientos Obligatorio"
                );
            }

            if (!this.fillCrearReqMaterialesProy.cCantMaterial) {
                this.mensajeError.push(
                    "Campo Cantidad de requerimientos Obligatorio"
                );
            }

            if (this.mensajeError.length) {
                this.error = 1;
            }

            return this.error;
        },
        setAddReqMaterial() { 
            var url = "/administracion/ProyectoMateriales/addOrden";

            axios
                .post(url, {
                    nIdmaterial: this.fillCrearReqMaterialesProy.nIdmaterial,
                    cCantMaterial:
                        this.fillCrearReqMaterialesProy.cCantMaterial,
                    nIdUnidMedMat:
                        this.fillCrearReqMaterialesProy.nIdUnidMedMat,
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
                        this.fillCrearReqMaterialesProy.cCantMaterial = 0;
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
                        this.fillCrearReqMaterialesProy.cCantMaterial = 0;
                    }
                });
        },

        setLimpiaMaterial() {
            (this.fillCrearReqMaterialesProy.nIdmaterial = ""),
                (this.fillCrearReqMaterialesProy.cCantMaterial = 0);
        },

        setLimpiaCampos() {
            this.fillCrearReqMaterialesProy.nIdmaterial = null;
            this.fillCrearReqMaterialesProy.cCantidad = 0;
        },

        setResetCampos() {
            this.fillCrearReqMaterialesProy.nIdmaterial = null;
            this.fillCrearReqMaterialesProy.cCantidad = 0;
            this.fillCrearReqMaterialesProy.cDocumento = "";
        },

        setCleanReqMateriales() {
            var url = "/administracion/ProyectoMateriales/eliminarTemporder";
            axios.get(url, {}).then((response) => {
                this.listartempProduccion = response.data.datos;
                this.setLimpiaMaterial();
            });
        },

        setCleanManoObra() {
            var url = "/administracion/ProyectoManoObra/CleanProyectManObra";
            axios.get(url, {}).then((response) => {
                this.listartempMobra = response.data.datos;
                this.setcleanListMObra();
            });
        },

        setCleanOtrosReq() {
            var url =
                "/administracion/ProyectOtrosReq/CleanOtrosProyReqMateriales";
            axios.get(url, {}).then((response) => {
                this.listartempOtrosRequerimientos = response.data.datos;
                this.setcleanListMObra();
            });
        },

        setCleanRequerimientos() {
   
            this.fillCrearReqMaterialesProy.nIdCcostos='';
            this.fillCrearReqMaterialesProy.nIdClient='';
            this.fillCrearReqMaterialesProy.cRuc='';
            this.fillCrearReqMaterialesProy.detservicio='';
            this.fillCrearReqMaterialesProy.FInicio='';
            this.fillCrearReqMaterialesProy.FFinal='';
            this.fillCrearReqMaterialesProy.cDuracion='';
            this.fillCrearReqMaterialesProy.nIdOS=''
            
            
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
                this.fillCrearReqMaterialesProy.nIdUnidMed =
                    this.listUnidMed[7].id;
                this.fillCrearReqMaterialesProy.nIdUnidMedMat =
                    this.listUnidMed[7].id;
            });
        },
    },
    computed: {
        calculoFechas() {
            if (
                this.fillCrearReqMaterialesProy.FFinal != null &&
                this.fillCrearReqMaterialesProy.FInicio != null
            ) {
                let valorfecha =
                    new Date(this.fillCrearReqMaterialesProy.FFinal).getTime() -
                    new Date(this.fillCrearReqMaterialesProy.FInicio).getTime();
                return String(valorfecha / 86400000 + 1).padStart(2, 0);
            }
        },
    },
};
</script>

<style></style>
