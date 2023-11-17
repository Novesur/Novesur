<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="/img/Logo Novesur.jpeg" alt="Inversiones Novesur" class="img-fluid elevation-5" />
            <span></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">{{ usuario.fullname }}</a>
                </div>
            </div>

            <div class="user-panel mt-3 pb-3f mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block" @click.prevent="logout">
                        <i class="fas fa-sign-out-alt"> </i> Cerrar Sesión
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <template v-if="listPermisos.includes('dashboard.index')">
                            <router-link class="nav-link active" :to="'/'">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </router-link>
                        </template>
                    </li>

                 

                    <li class="nav-item has-treeview">
                        <template v-if="listPermisos.includes('productos.index')">
                            <router-link class="nav-link" :to="'/productos'">
                                <i class="fas fa-box-open"></i>
                                <p>
                                    Productos
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </router-link>
                        </template>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('marca.index')">
                                    <router-link class="nav-link" :to="'/marca'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Marca</p>
                                    </router-link>
                                </template>
                            </li>
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('material.index')">
                                    <router-link class="nav-link" :to="'/material'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Material</p>
                                    </router-link>
                                </template>
                            </li>
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('familia.index')">
                                    <router-link class="nav-link" :to="'/familia'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Familia</p>
                                    </router-link>
                                </template>
                            </li>
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('subfamilia.index')">
                                    <router-link class="nav-link" :to="'/subfamilia'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Diametro/Longitud</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('modelotipo.index')">
                                    <router-link class="nav-link" :to="'/modelotipo'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Modelo/Tipo</p>
                                    </router-link>
                                </template>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-dolly-flatbed"></i>
                            <p>
                                Logistica
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('proveedor.index')">
                                    <router-link class="nav-link" :to="'/proveedor'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Proveedores</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('parte_salida.create')">
                                    <router-link class="nav-link" :to="'/parte_salida/create'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Orden de Salida</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('ordenCompras.list')">
                                    <router-link class="nav-link" :to="'/ordenCompra/list'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lista Orden de Compra</p>
                                    </router-link>
                                </template>
                            </li>
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('ordenCompras.reportPrecio')">
                                    <router-link class="nav-link" :to="'/ordenCompras/reportPrecio'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte Precios</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('ordenServicio.list')">
                                    <router-link class="nav-link" :to="'/ordenServicio/list'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lista Orden de Servicio</p>
                                    </router-link>
                                </template>
                            </li>


                            <li class="nav-item">
                                <template v-if="listPermisos.includes('parteingreso.list')"> 
                                    <router-link class="nav-link" :to="'/parteingreso/list'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lista Parte de Ingreso</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('parte_salida.list')">
                                    <router-link class="nav-link" :to="'/parte_salida/list'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lista Parte de Salida</p>
                                    </router-link>
                                </template>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-id-badge"></i>
                            <p>
                                Seguridad
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('usuario.index')">
                                    <router-link class="nav-link" :to="'/usuario'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Usuarios</p>
                                    </router-link>
                                </template>
                            </li>
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('roles.index')">
                                    <router-link class="nav-link" :to="'/roles'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Roles</p>
                                    </router-link>
                                </template>
                            </li>
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('permiso.index')">
                                    <router-link class="nav-link" :to="'/permiso'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Permiso</p>
                                    </router-link>
                                </template>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-cash-register"></i>
                            <p>
                                Ventas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('area.ventas')">
                                    <router-link class="nav-link" :to="'/ventas/reporteStock'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte de Stock</p>
                                    </router-link>
                                </template>
                            </li>
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('cliente.index')">
                                <router-link class="nav-link" :to="'/cliente/index'">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Clientes</p>
                                </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('cliente.list')">
                                    <router-link class="nav-link" :to="'/cliente/list'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Clientes</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('consulta.ventas')">
                                    <router-link class="nav-link" :to="'/cotizacion/list'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Cotizaciones</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('consulta.detalleproductos')">
                                    <router-link class="nav-link" :to="'/cotizacion/detalleProductos'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Detalle de Cotizaciones</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('cotizacion.analisis')">
                                    <router-link class="nav-link" :to="'/cotizacion/analisis'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cotizacion - Analisis</p>
                                    </router-link>
                                </template>
                            </li>


                            <li class="nav-item">
                                <template v-if="listPermisos.includes('listadoCotizaciones')">
                                    <router-link class="nav-link" :to="'/cotizacion/index'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Cotizaciones</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('ReporteCotizaciones')">
                                    <router-link class="nav-link" :to="'/cotizacion/reporteVentas'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte de Cotizaciones</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('ReporteNotaPedido')">
                                    <router-link class="nav-link" :to="'/notapedido/list'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte Nota de Pedido</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('guiaremision.index')">
                                    <router-link class="nav-link" :to="'/guiaremision/index'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Guia de Remisión</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('papeletaSalida.create')">
                                    <router-link class="nav-link" :to="'/papeletaSalida/create'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Papeleta de Salida</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('papeletaSalida.index')">
                                    <router-link class="nav-link" :to="'/papeletaSalida/index'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte de Papeleta de Salida</p>
                                    </router-link>
                                </template>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-cart-plus"></i>
                            <p>
                                Tienda
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('articulo.tienda')">
                                    <router-link class="nav-link" :to="'/articulo/index'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Articulo</p>
                                    </router-link>
                                </template>
                            </li>
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('tipo.tienda')">
                                    <router-link class="nav-link" :to="'/tipo/index'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tipo</p>
                                    </router-link>
                                </template>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-solid fa-utensils"></i>
                            <p>
                                Menu
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('plato.create')">
                                    <router-link class="nav-link" :to="'/plato/create'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear Plato</p>
                                    </router-link>
                                </template>
                            </li>

                               <li class="nav-item">
                                <template v-if="listPermisos.includes('pedidoCreate.create')">
                                    <router-link class="nav-link" :to="'/pedidoCreate/create'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear Plato Menu</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('menu.list')">
                                    <router-link class="nav-link" :to="'/menu/list'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pedido Menu</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('menu.detalle')">
                                    <router-link class="nav-link" :to="'/menu/detalle'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte de Detalle</p>
                                    </router-link>
                                </template>
                            </li>


                            <li class="nav-item">
                                <template v-if="listPermisos.includes('menu.reporteTotal')">
                                    <router-link class="nav-link" :to="'/menu/reporteTotal'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte de Totales</p>
                                    </router-link>
                                </template>
                            </li>


                            <li class="nav-item">
                                <template v-if="listPermisos.includes('menu.reporteFechas')">
                                    <router-link class="nav-link" :to="'/menu/list'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte por fechas</p>
                                    </router-link>
                                </template>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-file-signature"></i>
                            <p>
                                Producción
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <template >
                                  
                                     
                                        <li class="nav-item has-treeview">
                                            <a href="#" class="nav-link">
                    
                                                <i class="fas fa-solid fa-briefcase"></i>
                                                <p>
                                                    Requerimiento de Materiales
                                                    <i class="fas fa-angle-left right"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <template v-if="listPermisos.includes('requerimientoMateriales.create')">
                                                        <router-link class="nav-link" :to="'/requerimientoMateriales/create'">
                                                            <i class="far fa-circle nav-icon"></i>
                                                            <p>Crear</p>
                                                        </router-link>
                                                    </template>
                                                </li>
                    
                                                <li class="nav-item">
                                                    <template v-if="listPermisos.includes('requerimientoMateriales.reporte')">
                                                        <router-link class="nav-link" :to="'/requerimientoMateriales/list'">
                                                            <i class="far fa-circle nav-icon"></i>
                                                            <p>Reporte</p>
                                                        </router-link>
                                                    </template>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                    
                                </template>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                            
                            
                                    <i class="fas fa-solid fa-clipboard-list"></i>
                                    <p>
                                        Informe de Producción
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <template v-if="listPermisos.includes('informeProduccion.create')">
                                            <router-link class="nav-link" :to="'/informeProduccion/create'">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crear</p>
                                            </router-link>
                                        </template>
                                    </li>
                            
                                    <li class="nav-item">
                                        <template v-if="listPermisos.includes('informeProduccion.reporte')">
                                            <router-link class="nav-link" :to="'/informeProduccion/list'">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Reporte</p>
                                            </router-link>
                                        </template>
                                    </li>
                            
                                </ul>
                            </li>
                        </ul>
                    </li>




                          <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">


                            <i class="fas fa-solid fa-clipboard-list"></i>
                            <p>
                                Almacen
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                  

                            <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Parte de Ingreso
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                 <template v-if="listPermisos.includes('parteingreso.create2')">
                                   <router-link class="nav-link" :to="'/parteingreso/create2'">
                            
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Crear</p>
                                </router-link>
            
                                 </template>
                            </li>
                            
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('parteingreso.list')">
                                <router-link  class="nav-link" :to="'/parteingreso/list'">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consulta</p>
                                </router-link>
                                </template>
                            </li>
                        </ul>
                    </li>

                    
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Parte de Salida
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                 <template v-if="listPermisos.includes('parte_salida.create')">
                                   <router-link class="nav-link" :to="'/parte_salida/list'">
                            
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Crear</p>
                                </router-link>
            
                                 </template>
                            </li>
                            
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('parte_salida.list')"> 
                                <router-link  class="nav-link" :to="'/parte_salida/list'">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consulta</p>
                                </router-link>
                                </template>
                            </li>
                        </ul>
                    </li>

                        </ul>
                    </li>


                    
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">


                            <i class="fas fa-solid fa-clipboard-list"></i>
                            <p>
                                Proyectos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                  

                            <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Requerimiento de Materiales
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                 <template v-if="listPermisos.includes('proyectoMat.create')">
                                   <router-link class="nav-link" :to="'/proyecto_ReqMateriales/create'">
                            
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Crear</p>
                                </router-link>
            
                                 </template>
                            </li>
                            
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('proyectoMat.list')">
                                <router-link  class="nav-link" :to="'/proyecto_ReqMateriales/list'">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consulta</p>
                                </router-link>
                                </template>
                            </li>
                        </ul>
                    </li>

           

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Informe de Valorización
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                 <template v-if="listPermisos.includes('informe.valorizacion')">
                                   <router-link class="nav-link" :to="'/informeValorizacion/create'">
                            
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Crear</p>
                                </router-link>
            
                                 </template>
                            </li>
                            
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('informe.consulta')">
                                <router-link  class="nav-link" :to="'/informeValorizacion/list'">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consulta</p>
                                </router-link>
                                </template>
                            </li>
                        </ul>
                    </li>
                        </ul>
                    </li>


                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user-cog"></i>
                            <p>
                                Personal
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('personal.list')">
                                    <router-link class="nav-link" :to="'/personal/index'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Personal</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('personal.cargo')">
                                    <router-link class="nav-link" :to="'/cargo/index'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cargo</p>
                                    </router-link>
                                </template>
                            </li>


                               <li class="nav-item">
                                <template v-if="listPermisos.includes('asistenta.zonal')">
                                    <router-link class="nav-link" :to="'/pedidoCreate/create'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Asistencia</p>
                                    </router-link>
                                </template>
                            </li>

                    
<!-- 
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('menu.detalle')">
                                    <router-link class="nav-link" :to="'/menu/detalle'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte de Detalle</p>
                                    </router-link>
                                </template>
                            </li>


                            <li class="nav-item">
                                <template v-if="listPermisos.includes('menu.reporteTotal')">
                                    <router-link class="nav-link" :to="'/menu/reporteTotal'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte de Totales</p>
                                    </router-link>
                                </template>
                            </li>


                            <li class="nav-item">
                                <template v-if="listPermisos.includes('menu.reporteFechas')">
                                    <router-link class="nav-link" :to="'/menu/list'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte por fechas</p>
                                    </router-link>
                                </template>
                            </li>
 -->
                        </ul>
                    </li>


                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user-clock"></i>
                            <p>
                                Asistencia
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <template v-if="listPermisos.includes('asistencia.import')">
                                    <router-link class="nav-link" :to="'/asistencia/import'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Importar Asistencias</p>
                                    </router-link>
                                </template>
                            </li>

                            <li class="nav-item">
                                <template v-if="listPermisos.includes('asistencia.import')">
                                    <router-link class="nav-link" :to="'/asistencia/reporte'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte Asistencias</p>
                                    </router-link>
                                </template>
                            </li>

                 


                  <!--          <li class="nav-item">
                                <template v-if="listPermisos.includes('asistencia.personal')">
                                    <router-link class="nav-link" :to="'/asistencia/personal'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Personal</p>
                                    </router-link>
                                </template>
                            </li> -->


                           <!--   <li class="nav-item">
                                <template v-if="listPermisos.includes('menu.reporteFechas')">
                                    <router-link class="nav-link" :to="'/menu/list'">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte por fechas</p>
                                    </router-link>
                                </template>
                            </li>
 -->
                        </ul>
                    </li>


                    



                    <li class="nav-header">ALMACEN</li>
                    <li class="nav-item">
                        <a href="https://adminlte.io/docs/3.0" class="nav-link">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Documentation</p>
                        </a>
                    </li>
                    <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Level 1</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Level 1
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Level 2</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Level 2
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Level 3</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Level 3</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Level 3</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Level 2</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Level 1</p>
                        </a>
                    </li>
                    <li class="nav-header">LABELS</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p class="text">Important</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p>Warning</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Informational</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
export default {
    props: ["ruta", "usuario", "listPermisos"],

    methods: {
        logout() {
            var url = "/authenticate/logout";
            axios.post(url).then((response) => {
                if (response.data.code == 204) {
                    this.$router.push({ name: "login" });
                    location.reload();
                    sessionStorage.clear();
                    storage.clear();
                }
            });
        },
    },
};
</script>

<style>
</style>
