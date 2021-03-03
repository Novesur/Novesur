import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)
function verificarAcceso(to, from, next){
    let AutUser =  JSON.parse(sessionStorage.getItem('AutUser'));
    if(AutUser){
            let listRolPermisosbyUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'))
        if(listRolPermisosbyUsuario.includes(to.name)){
            next();
        }else{
            let listRolPermisosByUsuarioFilter=[];
            listRolPermisosbyUsuario.map(function(x){
                if(x.includes('index')){
                    listRolPermisosByUsuarioFilter.push(x);

                }
            })
            if(to.name == 'dashboard.index'){
                next({name:listRolPermisosByUsuarioFilter[0]});
            }else{
                next(from.path);
            }

        }
    }else{
       next('/login')
    }

}

export default new Router({
    routes: [

        /// Login
        { path: '/login',
         name: 'login',
         component: require('./components/modulos/authenticate/login').default },



        {
            path: '/',
            name: 'dashboard.index',
            component: require('./components/modulos/dashboard/index').default
        },

        //Productos
        {
            path: '/productos',
            name: 'productos.index',
            component: require('./components/modulos/productos/index').default,
            beforeEnter:(to, from, next)=>{
                verificarAcceso(to, from, next);
            }

        },

        {
            path: '/productos/crear',
            name: 'productos.crear',
            component: require('./components/modulos/productos/create').default
        },

        {
            path: '/productos/editar/:id',
            name: 'productos.editar',
            component: require('./components/modulos/productos/edit').default,
            props: true
        },
        // -------------Fin de Productos ---------------------------------------------------------


        //Marca
        {
            path: '/marca',
            name: 'marca.index',
            component: require('./components/modulos/marca/index').default,
            beforeEnter:(to, from, next)=>{
                verificarAcceso(to, from, next);
            }
        },

        {
            path: '/marca/crear',
            name: 'marca.crear',
            component: require('./components/modulos/marca/create').default
        },
        {
            path: '/marca/editar/:id',
            name: 'marca.editar',
            component: require('./components/modulos/marca/edit').default,
            props: true
        },
        // -------------Fin de Marca ---------------------------------------------------------


        // Material
        {
            path: '/material',
            name: 'material.index',
            component: require('./components/modulos/material/index').default,
            beforeEnter:(to, from, next)=>{
                verificarAcceso(to, from, next);
            }
        },

        {
            path: '/material/crear',
            name: 'material.crear',
            component: require('./components/modulos/material/create').default
        },
        {
            path: '/material/editar/:id',
            name: 'material.editar',
            component: require('./components/modulos/material/edit').default,
            props: true
        },
        // -------------Fin de Material ---------------------------------------------------------

        // Familia
        {
            path: '/familia',
            name: 'familia.index',
            component: require('./components/modulos/familia/index').default,
            beforeEnter:(to, from, next)=>{
                verificarAcceso(to, from, next);
            }
        },
        { path: '/familia/crear', component: require('./components/modulos/familia/create').default },
        {
            path: '/familia/editar/:id',
            name: 'familia.editar',
            component: require('./components/modulos/familia/edit').default,
            props: true
        },

        // Subfamilia
        {
            path: '/subfamilia',
            name: 'subfamilia.index',
            component: require('./components/modulos/subfamilia/index').default,
            beforeEnter:(to, from, next)=>{
                verificarAcceso(to, from, next);
            }
        },

        {
            path: '/subfamilia/crear',
            name: 'subfamilia.crear',
            component: require('./components/modulos/subfamilia/create').default
        },

        {
            path: '/subfamilia/editar/:id',
            name: 'subfamilia.editar',
            component: require('./components/modulos/subfamilia/edit').default,
            props: true
        },

        //modelotipo
        {
            path: '/modelotipo',
            name: 'modelotipo.index',
            component: require('./components/modulos/modelotipo/index').default,
            beforeEnter:(to, from, next)=>{
                verificarAcceso(to, from, next);
            }
        },

        {
            path: '/modelotipo/crear',
            name: 'modelotipo.crear',
            component: require('./components/modulos/modelotipo/create').default
        },
        {
            path: '/modelotipo/editar/:id',
            name: 'modelotipo.editar',
            component: require('./components/modulos/modelotipo/edit').default,
            props: true
        },

        //Provedores
        {
            path: '/proveedor',
            name: 'proveedor.index',
            component: require('./components/modulos/proveedor/index').default,
            beforeEnter:(to, from, next)=>{
                verificarAcceso(to, from, next);
            }
        },

        {
            path: '/proveedor/crear',
            name: 'proveedor.crear',
            component: require('./components/modulos/proveedor/create').default
        },
        {
            path: '/proveedor/editar/:id',
            name: 'proveedor.editar',
            component: require('./components/modulos/proveedor/edit').default,
            props: true
        },

        //Kardex

        {
            path: 'kardex/detalle/:id',
            name: 'kardex.detalle',
            component: require('./components/modulos/kardex/detalle').default,
            props: true
        },

        {
            path: '/kardex/index/:id',
            name: 'kardex.index',
            component: require('./components/modulos/kardex/index').default,
            props: true
        },

        {
            path: '/reporte/movimientoXProducto/:id',
            name: 'reporte.movimientoXProducto',
            component: require('./components/reporte/movimientoXProducto').default,
            props: true
        },

        {
            path: '/kardex/list/:id',
            name: 'kardex.list',
            component: require('./components/modulos/kardex/list').default,
            props: true
        },

        //Usuarios
        {
            path: '/usuario',
            name: 'usuario.index',
            component: require('./components/modulos/usuario/index').default,
            beforeEnter:(to, from, next)=>{
                verificarAcceso(to, from, next);
            }
        },

        {
            path: '/usuario/crear',
            name: 'usuario.crear',
            component: require('./components/modulos/usuario/create').default
        },
        {
            path: '/usuario/editar/:id',
            name: 'usuario.editar',
            component: require('./components/modulos/usuario/edit').default,
            props: true
        },
        {
            path: '/usuario/permission',
            name: 'usuario.permission',
            component: require('./components/modulos/usuario/permission').default
        },

        {
            path: '/usuario/permiso/:id',
            name: 'usuario.permiso',
            component: require('./components/modulos/usuario/permission').default,
            props: true
        },

        //Roles
        {
            path: '/roles',
            name: 'roles.index',
            component: require('./components/modulos/rol/index').default,
            beforeEnter:(to, from, next)=>{
                verificarAcceso(to, from, next);
            }
        },

        {
            path: '/roles/crear',
            name: 'roles.crear',
            component: require('./components/modulos/rol/create').default
        },

        {
            path: '/rol/editar/:id',
            name: 'rol.editar',
            component: require('./components/modulos/rol/edit').default,
            props: true
        },

        ///  Permiso
        {
            path: '/permiso',
            name: 'permiso.index',
            component: require('./components/modulos/permiso/index').default,
            beforeEnter:(to, from, next)=>{
                verificarAcceso(to, from, next);
            }
        },


        { path: '/permiso/crear', component: require('./components/modulos/permiso/create').default },
        {
            path: '/rol/permiso/:id',
            name: 'rol.permiso',
            component: require('./components/modulos/permiso/edit').default,
            props: true
        },

        {path:'*',
        component: require('./components/plantilla/404').default,
        },

        // DetalleKardex

        {
            path: '/detallekardex/edit/:id',
            name: 'detallekardex.edit',
            component: require('./components/modulos/kardex/editDetalle').default,
            props: true
        },

        // Ventas

        {
            path: '/ventas/reporteStock',
            name: 'ventas.reporteStock',
            component: require('./components/modulos/ventas/reportStockProduct').default
        },

        //  Vendedor
            {
                path: '/cliente/index',
                name: 'cliente.index',
                component: require('./components/modulos/cliente/index').default
            },

            {
                path: '/cliente/create',
                name: 'cliente.create',
                component: require('./components/modulos/cliente/create').default
            },

            {
                path: '/cliente/editar/:id',
                name: 'cliente.editar',
                component: require('./components/modulos/cliente/edit').default,
                props: true
            },

            {
                path: '/cotizacion/create/:id',
                name: 'cotizacion.create',
                component: require('./components/modulos/cotizacion/create').default,
                props: true
            },

            {
                path: '/cotizacion/index',
                name: 'cotizacion.index',
                component: require('./components/modulos/cotizacion/index').default
            },



    ],

    mode: 'history',
    linkActiveClass: 'active'


})
