import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);
function verificarAcceso(to, from, next) {
    let AutUser = JSON.parse(sessionStorage.getItem("AutUser"));
    if (AutUser) {
        let listRolPermisosbyUsuario = JSON.parse(
            sessionStorage.getItem("listRolPermisosByUsuario")
        );
        if (listRolPermisosbyUsuario.includes(to.name)) {
            next();
        } else {
            let listRolPermisosByUsuarioFilter = [];
            listRolPermisosbyUsuario.map(function (x) {
                if (x.includes("index")) {
                    listRolPermisosByUsuarioFilter.push(x);
                }
            });
            if (to.name == "dashboard.index") {
                next({ name: listRolPermisosByUsuarioFilter[0] });
            } else {
                next(from.path);
            }
        }
    } else {
        next("/login");
    }
}

export default new Router({
    routes: [
        /// Login
        {
            path: "/login",
            name: "login",
            component: require("./components/modulos/authenticate/login")
                .default,
        },

        {
            path: "/",
            name: "dashboard.index",
            component: require("./components/modulos/dashboard/index").default,
        },

        //Productos
        {
            path: "/productos",
            name: "productos.index",
            component: require("./components/modulos/productos/index").default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/productos/crear",
            name: "productos.crear",
            component: require("./components/modulos/productos/create").default,
        },

        {
            path: "/productos/editar/:id",
            name: "productos.editar",
            component: require("./components/modulos/productos/edit").default,
            props: true,
        },
        // -------------Fin de Productos ---------------------------------------------------------

        //Marca
        {
            path: "/marca",
            name: "marca.index",
            component: require("./components/modulos/marca/index").default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/marca/crear",
            name: "marca.crear",
            component: require("./components/modulos/marca/create").default,
        },
        {
            path: "/marca/editar/:id",
            name: "marca.editar",
            component: require("./components/modulos/marca/edit").default,
            props: true,
        },
        // -------------Fin de Marca ---------------------------------------------------------

        // Material
        {
            path: "/material",
            name: "material.index",
            component: require("./components/modulos/material/index").default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/material/crear",
            name: "material.crear",
            component: require("./components/modulos/material/create").default,
        },
        {
            path: "/material/editar/:id",
            name: "material.editar",
            component: require("./components/modulos/material/edit").default,
            props: true,
        },
        // -------------Fin de Material ---------------------------------------------------------

        // Familia
        {
            path: "/familia",
            name: "familia.index",
            component: require("./components/modulos/familia/index").default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },
        {
            path: "/familia/crear",
            component: require("./components/modulos/familia/create").default,
        },
        {
            path: "/familia/editar/:id",
            name: "familia.editar",
            component: require("./components/modulos/familia/edit").default,
            props: true,
        },

        // Subfamilia
        {
            path: "/subfamilia",
            name: "subfamilia.index",
            component: require("./components/modulos/subfamilia/index").default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/subfamilia/crear",
            name: "subfamilia.crear",
            component: require("./components/modulos/subfamilia/create")
                .default,
        },

        {
            path: "/subfamilia/editar/:id",
            name: "subfamilia.editar",
            component: require("./components/modulos/subfamilia/edit").default,
            props: true,
        },

        //modelotipo
        {
            path: "/modelotipo",
            name: "modelotipo.index",
            component: require("./components/modulos/modelotipo/index").default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/modelotipo/crear",
            name: "modelotipo.crear",
            component: require("./components/modulos/modelotipo/create")
                .default,
        },
        {
            path: "/modelotipo/editar/:id",
            name: "modelotipo.editar",
            component: require("./components/modulos/modelotipo/edit").default,
            props: true,
        },

        //Provedores
        {
            path: "/proveedor",
            name: "proveedor.index",
            component: require("./components/modulos/proveedor/index").default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/proveedor/crear",
            name: "proveedor.crear",
            component: require("./components/modulos/proveedor/create").default,
        },
        {
            path: "/proveedor/editar/:id",
            name: "proveedor.editar",
            component: require("./components/modulos/proveedor/edit").default,
            props: true,
        },

        //Kardex

        {
            path: "kardex/detalle/:id",
            name: "kardex.detalle",
            component: require("./components/modulos/kardex/detalle").default,
            props: true,
        },

        {
            path: "/kardex/index/:id",
            name: "kardex.index",
            component: require("./components/modulos/kardex/index").default,
            props: true,
        },

        {
            path: "/reporte/movimientoXProducto/:id",
            name: "reporte.movimientoXProducto",
            component: require("./components/reporte/movimientoXProducto")
                .default,
            props: true,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/kardex/list/:id",
            name: "kardex.list",
            component: require("./components/modulos/kardex/list").default,
            props: true,
        },

        //Usuarios
        {
            path: "/usuario",
            name: "usuario.index",
            component: require("./components/modulos/usuario/index").default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/usuario/crear",
            name: "usuario.crear",
            component: require("./components/modulos/usuario/create").default,
        },
        {
            path: "/usuario/editar/:id",
            name: "usuario.editar",
            component: require("./components/modulos/usuario/edit").default,
            props: true,
        },
        {
            path: "/usuario/permission",
            name: "usuario.permission",
            component: require("./components/modulos/usuario/permission")
                .default,
        },

        {
            path: "/usuario/permiso/:id",
            name: "usuario.permiso",
            component: require("./components/modulos/usuario/permission")
                .default,
            props: true,
        },

        //Roles
        {
            path: "/roles",
            name: "roles.index",
            component: require("./components/modulos/rol/index").default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/roles/crear",
            name: "roles.crear",
            component: require("./components/modulos/rol/create").default,
        },

        {
            path: "/rol/editar/:id",
            name: "rol.editar",
            component: require("./components/modulos/rol/edit").default,
            props: true,
        },

        ///  Permiso
        {
            path: "/permiso",
            name: "permiso.index",
            component: require("./components/modulos/permiso/index").default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/permiso/crear",
            component: require("./components/modulos/permiso/create").default,
        },
        {
            path: "/rol/permiso/:id",
            name: "rol.permiso",
            component: require("./components/modulos/permiso/edit").default,
            props: true,
        },

        // DetalleKardex

        {
            path: "/detallekardex/edit/:id",
            name: "detallekardex.edit",
            component: require("./components/modulos/kardex/editDetalle")
                .default,
            props: true,
        },

        // Ventas

        {
            path: "/ventas/reporteStock",
            name: "ventas.reporteStock",
            component: require("./components/modulos/ventas/reportStockProduct")
                .default,
        },

        //  Vendedor
        {
            path: "/cliente/index",
            name: "cliente.index",
            component: require("./components/modulos/cliente/index").default,
        },

        {
            path: "/cliente/create",
            name: "cliente.create",
            component: require("./components/modulos/cliente/create").default,
        },

        {
            path: "/cliente/editar/:id",
            name: "cliente.editar",
            component: require("./components/modulos/cliente/edit").default,
            props: true,
        },

        {
            path: "/cliente/list",
            name: "cliente.list",
            component: require("./components/modulos/cliente/list").default,
        },

        /// COTIZACION

        {
            path: "/cotizacion/create/:id",
            name: "cotizacion.create",
            component: require("./components/modulos/cotizacion/create")
                .default,
            props: true,
        },

        {
            path: "/cotizacion/index",
            name: "cotizacion.index",
            component: require("./components/modulos/cotizacion/index").default,
        },

        {
            path: "/cotizacion/reporteVentas",
            name: "cotizacion.reporteVentas",
            component: require("./components/modulos/cotizacion/reporteVentas")
                .default,
        },

        {
            path: "/cotizacion/editar/:id",
            name: "cotizacion.editar",
            component: require("./components/modulos/cotizacion/edit").default,
            props: true,
        },

        {
            path: "/cotizacion/list",
            name: "cotizacion.list",
            component: require("./components/modulos/cotizacion/list").default,
        },

        {
            path: "/cotizacion/detalleProductos",
            name: "cotizacion.detalleProductos",
            component:
                require("./components/modulos/cotizacion/detalleProductos")
                    .default,
        },

        {
            path: "/cotizacion/analisis",
            name: "cotizacion.analisis",
            component: require("./components/modulos/cotizacion/analisis")
                .default,
        },

        /// REPORTE DE COTIZACION EN PDF

        {
            path: "/cotizacion/reportCotizacionPdf/:id",
            name: "cotizacion.reportCotizacionPdf",
            component:
                require("./components/modulos/cotizacion/reportCotizacionPdf")
                    .default,
            props: true,
        },

        ///  TIENDA

        /// TIPO DE PRODUCTO EN LA TIENDA

        {
            path: "/tipo/create",
            name: "tipo.create",
            component: require("./components/tienda/tipo/create").default,
        },

        {
            path: "/tipo/index",
            name: "tipo.index",
            component: require("./components/tienda/tipo/index").default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/tipo/edit/:id",
            name: "tipo.edit",
            component: require("./components/tienda/tipo/edit").default,
            props: true,
        },

        ///  ARTICULO

        {
            path: "/articulo/index",
            name: "articulo.index",
            component: require("./components/tienda/articulo/index").default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/articulo/create",
            name: "articulo.create",
            component: require("./components/tienda/articulo/create").default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/articulo/editar/:id",
            name: "articulo.editar",
            component: require("./components/tienda/articulo/edit").default,
            props: true,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        // PARTE DE INGRESO
        {
            path: "/parteingreso/create/:id",
            name: "parteingreso.create",
            component: require("./components/modulos/parte_ingreso/create")
                .default,
            props: true,
        },

        {
            path: "/parteingreso/create2",
            name: "parteingreso.create2",
            component: require("./components/modulos/parte_ingreso/create2")
                .default,
            beforeEnter: (to, from, next) => {
                verificarAcceso(to, from, next);
            },
        },

        {
            path: "/parteingreso/list",
            name: "parteingreso.list",
            component: require("./components/modulos/parte_ingreso/list")
                .default,
        },

        // PARTE DE COMPRA

        {
            path: "/ordenCompra/list",
            name: "ordenCompra.list",
            component: require("./components/modulos/ordenCompra/list").default,
        },

        {
            path: "/ordenCompra/create/:id",
            name: "ordenCompra.create",
            component: require("./components/modulos/ordenCompra/create")
                .default,
            props: true,
        },

        {
            path: "/ordenCompra/edit/:id",
            name: "ordenCompra.edit",
            component: require("./components/modulos/ordenCompra/edit").default,
            props: true,
        },

        {
            path: "/ordenCompras/reportPrecio",
            name: "ordenCompras.reportPrecio",
            component: require("./components/modulos/ordenCompra/reportPrecio")
                .default,
        },

        // PARTE DE SALIDA

        {
            path: "/parte_salida/create",
            name: "parte_salida.create",
            component: require("./components/modulos/parte_salida/create")
                .default,
        },

        {
            path: "/parte_salida/list",
            name: "/parte_salida/list",
            component: require("./components/modulos/parte_salida/list")
                .default,
        },

        { path: "*", component: require("./components/plantilla/404").default },

        ///  GUIA DE REMISION

        {
            path: "/guiaremision/index",
            name: "/guiaremision.index",
            component: require("./components/modulos/guiaremision/index")
                .default,
        },

        {
            path: "/guiaremision/create/:id",
            name: "guiaremision.create",
            component: require("./components/modulos/guiaremision/create")
                .default,
            props: true,
        },

        ///     PAPELETA DE SALIDA

        {
            path: "/papeletaSalida/create",
            name: "papeletaSalida.create",
            component: require("./components/modulos/papeletaSalida/create")
                .default,
        },

        {
            path: "/papeletaSalida/index",
            name: "/papeletaSalida.index",
            component: require("./components/modulos/papeletaSalida/index")
                .default,
        },

        ////   BIENES DE SERVICIO

        {
            path: "/ordenServicio/create/:id",
            name: "ordenServicio.create",
            component: require("./components/modulos/ordenServicio/create")
                .default,
            props: true,
        },

        {
            path: "/ordenServicio/list",
            name: "ordenServicio.list",
            component: require("./components/modulos/ordenServicio/list")
                .default,
        },

        {
            path: "/ordenServicio/edit/:id",
            name: "ordenServicio.edit",
            component: require("./components/modulos/ordenServicio/edit")
                .default,
            props: true,
        },

        /// Menus ///////////

        {
            path: "/plato/create",
            name: "plato.create",
            component: require("./components/modulos/menu/plato").default,
        },

        {
            path: "/pedidoCreate/create",
            name: "pedidoCreate.create",
            component: require("./components/modulos/menu/pedidoCreate")
                .default,
        },

        {
            path: "/menu/list",
            name: "menu.list",
            component: require("./components/modulos/menu/list").default,
        },

        {
            path: "/menu/detalle",
            name: "menu.detalle",
            component: require("./components/modulos/menu/detalle").default,
        },

        {
            path: "/menu/reporteTotal",
            name: "menu.reporteTotal",
            component: require("./components/modulos/menu/reporteTotal")
                .default,
        },

        //// ORDEN  DE PRODUCCION  /////////

        {
            path: "/requerimientoMateriales/create",
            name: "requerimientoMateriales.create",
            component:
                require("./components/modulos/requerimientoMateriales/create")
                    .default,
        },

        {
            path: "/requerimientoMateriales/list",
            name: "requerimientoMateriales.list",
            component:
                require("./components/modulos/requerimientoMateriales/list")
                    .default,
        },

        //// INFORME DE PRODUCCION  ////
        {
            path: "/informeProduccion/create",
            name: "informeProduccion.create",
            component: require("./components/modulos/informeProduccion/create")
                .default,
        },

        {
            path: "/informeProduccion/list",
            name: "informeProduccion.list",
            component: require("./components/modulos/informeProduccion/list")
                .default,
        },

        ////NOTA DE PEDIDO /////
        {
            path: "/notapedido/create/:id",
            name: "notapedido.create",
            component: require("./components/modulos/notaPedido/create")
                .default,
            props: true,
        },

        {
            path: "/notapedido/list",
            name: "notapedido.list",
            component: require("./components/modulos/notapedido/list").default,
        },

        ///PROYECTOS  ///////
        {
            path: "/proyecto_ReqMateriales/create",
            name: "proyecto_ReqMateriales.create",
            component:
                require("./components/modulos/proyecto_ReqMateriales/create")
                    .default,
        },

        {
            path: "/proyecto_ReqMateriales/list",
            name: "proyecto_ReqMateriales.list",
            component:
                require("./components/modulos/proyecto_ReqMateriales/list")
                    .default,
        },

        //INFORME VALORIZACION
        {
            path: "/informeValorizacion/create",
            name: "informeValorizacion.create",
            component:
                require("./components/modulos/informeValorizacion/create")
                    .default,
        },

        {
            path: "/informeValorizacion/list",
            name: "informeValorizacion.list",
            component: require("./components/modulos/informeValorizacion/list")
                .default,
        },

        /*  PERSONAL   */

        {
            path: "/personal/create",
            name: "personal.create",
            component: require("./components/modulos/personal/create").default,
        },

        {
            path: "/personal/index",
            name: "personal.index",
            component: require("./components/modulos/personal/index").default,
        },

        {
            path: "/personal/edit/:id", 
            name: "personal.edit",
            component: require("./components/modulos/personal/edit")
                .default,
            props: true,
        },

        /* CARGO */
        {
            path: "/cargo/index",
            name: "cargo.index",
            component: require("./components/modulos/cargo/index").default,
        },

        {
            path: "/cargo/create",
            name: "cargo.create",
            component: require("./components/modulos/cargo/create").default,
        },

        {
            path: "/cargo/edit/:id",
            name: "cargo.edit",
            component: require("./components/modulos/cargo/edit").default,
            props: true,
        },

        /* ASISTENCIA */
        {
            path: "/asistencia/import",
            name: "asistencia.import",
            component: require("./components/modulos/asistencia/import").default,
        },

   

    ],

    mode: "history",
    linkActiveClass: "active",
});
