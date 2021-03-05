<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/administracion/modelo/getListarModelos', 'Administracion\ModeloProductController@store');
Route::get('/administracion/modelo/listByIdModelo', 'Administracion\ModeloProductController@listByIdModelo');
Route::post('/administracion/modelo/setRegistrarModelo', 'Administracion\ModeloProductController@create');
Route::post('/administracion/modelo/setEditarModelo', 'Administracion\ModeloProductController@edit');

////////////Familia
Route::get('/administracion/familia/getListarFamilias', 'Administracion\FamiliaController@store');
Route::post('/administracion/familia/setRegistrarfamilias', 'Administracion\FamiliaController@create');
Route::get('/administracion/familia/listByIdFamilia', 'Administracion\FamiliaController@listByIdFamilia');
Route::post('/administracion/familia/setEditarfamilias', 'Administracion\FamiliaController@edit');
///////////////////////////////////////////////////////////////////////////////////////////////

/////////// Marcas
Route::get('/administracion/marcas/getListarMarcas', 'Administracion\MarcaController@store');
Route::post('/administracion/marcas/setRegistrarMarcas', 'Administracion\MarcaController@create');
Route::get('/administracion/marcas/listByIdMarcas', 'Administracion\MarcaController@listByIdMarcas');
Route::post('/administracion/marcas/setEditarMarca', 'Administracion\MarcaController@edit');
////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////// Material
Route::get('/administracion/material/getListarMaterial', 'Administracion\MaterialController@store');
Route::post('/administracion/material/setRegistrarMaterial', 'Administracion\MaterialController@create');
Route::get('/administracion/material/listByIdMaterial', 'Administracion\MaterialController@listByIdMaterial');
Route::post('/administracion/material/setEditarMaterial', 'Administracion\MaterialController@edit');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////// SubFamilia
Route::get('/administracion/subfamilia/getListarSubfamilia', 'Administracion\SubfamiliaController@store');
Route::post('/administracion/subfamilia/setRegistrarSubfamilia', 'Administracion\SubfamiliaController@create');
Route::get('/administracion/subfamilia/listByIdSubfamilia', 'Administracion\SubfamiliaController@listByIdSubfamilia');
Route::post('/administracion/subfamilia/setEditarSubfamilia', 'Administracion\SubfamiliaController@edit');
Route::get('/administracion/subfamilia/listSubFamiliabyFamilia', 'Administracion\SubfamiliaController@listSubFamiliabyFamilia');

/////////// Modelo/Tipo
Route::get('/administracion/modelotipo/getListarModelotipo', 'Administracion\ModelotipoController@store');
Route::post('/administracion/modelotipo/setRegistrarModelotipo', 'Administracion\ModelotipoController@create');
Route::get('/administracion/modelotipo/listByIdModelotipo', 'Administracion\ModelotipoController@listByIdModelotipo');
Route::post('/administracion/modelotipo/setEditarModelotipo', 'Administracion\ModelotipoController@edit');

/////////// Estado del Producto
Route::get('/administracion/estadoprod/getListarEstadoprod', 'Administracion\EstadoProdController@index');

//////////  Producto
Route::get('/administracion/producto/getListarProducto', 'Administracion\ProductoController@index');
Route::post('/administracion/producto/setRegistrarProducto', 'Administracion\ProductoController@create');
Route::get('/administracion/producto/getListarProductoById', 'Administracion\ProductoController@ListarProductoById');
Route::get('/administracion/producto/ListarProductoByIdKardex', 'Administracion\ProductoController@ListarProductoByIdKardex');
Route::post('/administracion/producto/setEditarProductos', 'Administracion\ProductoController@edit');


////////  Proveedor
Route::get('/administracion/proveedor/getListarProveedor', 'Administracion\ProveedorController@index');
Route::post('/administracion/proveedor/setRegistrarProveedor', 'Administracion\ProveedorController@create');
Route::get('/administracion/proveedor/getListarProveedorById', 'Administracion\ProveedorController@ListarProveedorById');
Route::post('/administracion/proveedor/setEditarProveedor', 'Administracion\ProveedorController@edit');
Route::get('/administracion/KardexDetalle/listProveedor', 'Administracion\KardexDetalleController@listProveedor');
Route::get('/administracion/proveedor/ListarProveedorByRuc', 'Administracion\ProveedorController@ListarProveedorByRuc');

/////  Kardex
Route::get('/administracion/kardex/getListarKardexByProduct', 'Administracion\KardexController@index');
Route::post('/administracion/kardex/setRegistrarKardex', 'Administracion\KardexController@create');
Route::get('/administracion/kardex/getListarKardex', 'Administracion\KardexController@store');

////// DetalleKardex
Route::get('/administracion/KardexDetalle/listKardexById', 'Administracion\KardexDetalleController@listKardexById');
Route::post('/administracion/KardexDetalle/setRegistrarDetalleKardex', 'Administracion\KardexDetalleController@create');
Route::post('/administracion/KardexDetalle/KardexReporteData', 'Administracion\KardexDetalleController@KardexReporteData');
Route::get('/administracion/KardexDetalle/getListarXKardex', 'Administracion\KardexDetalleController@getListarXKardex');
Route::get('/administracion/KardexDetalle/getListarEditXKardex', 'Administracion\KardexDetalleController@getListarEditXKardex');
Route::post('/administracion/KardexDetalle/setEditarDetalleKardex', 'Administracion\KardexDetalleController@edit');



///// Movimiento
Route::get('/administracion/KardexDetalle/listMovimiento', 'Administracion\KardexDetalleController@listMovimiento');

/////  Motivo
Route::get('/administracion/KardexDetalle/listMotivo', 'Administracion\KardexDetalleController@listMotivo');

/////  Unidad de Medida
Route::get('/administracion/KardexDetalle/listUnidMed', 'Administracion\KardexDetalleController@listUnidMed');

//// Usuario
Route::get('/administracion/usuario/listUsuario', 'Administracion\UsuarioController@index');
Route::post('/administracion/usuario/setRegistrarUsuario', 'Administracion\UsuarioController@create');
Route::get('/administracion/usuario/listUsuarioById', 'Administracion\UsuarioController@listUsuarioById');
Route::post('/administracion/usuario/setEditarUsuario', 'Administracion\UsuarioController@edit');
Route::post('/administracion/usuario/setDesactivarUsuario', 'Administracion\UsuarioController@destroy');
Route::get('/administracion/usuario/getRolByUsuario', 'Administracion\UsuarioController@getRolByUsuario');
Route::get('/administracion/usuario/getListarPermisosByRol', 'Administracion\UsuarioController@ListarPermisosByRol');
Route::get('/administracion/usuario/getListarRolPermisosByUsuario', 'Administracion\UsuarioController@ListarRolPermisosByUsuario');
Route::get('/administracion/usuario/getListarUsusarios', 'Administracion\UsuarioController@getListarUsusarios');
Route::get('/administracion/usuario/getListarUsusariosbyId', 'Administracion\UsuarioController@getListarUsusariosbyId');




/// Roles
Route::get('/administracion/rol/listRoles', 'Administracion\RolController@index');
Route::get('/administracion/rol/listRolByUSer', 'Administracion\RolController@listRolByUSer');
Route::get('/administracion/rol/getListarPermisosByRol', 'Administracion\RolController@getListarPermisosByRol');
Route::post('/administracion/rol/setRegistrarRolPermiso', 'Administracion\RolController@create');
Route::post('/administracion/rol/setEditarRolPermiso', 'Administracion\RolController@edit');

//// Permisos
Route::get('/administracion/permiso/listPermisos', 'Administracion\PermisoController@index');
Route::get('/administracion/permiso/listPermisosById', 'Administracion\PermisoController@listPermisosById');
Route::post('/administracion/permiso/setRegistrarPermiso', 'Administracion\PermisoController@create');
Route::post('/administracion/permiso/setEditarPermiso', 'Administracion\PermisoController@edit');
Route::get('/administracion/permiso/listUsuarioById', 'Administracion\PermisoController@listUsuarioById');
Route::post('/administracion/permiso/RegistrarPermisosByUsuario', 'Administracion\PermisoController@RegistrarPermisosByUsuario');

//// Login
Route::post('/authenticate/login', 'Auth\LoginController@create');
Route::post('/authenticate/logout', 'Auth\LoginController@logout');

/////  Reportes
Route::post('/administracion/reportes/movimientoxProducto', 'Administracion\ReporteMovimientoxProductoController@MovimientoxPedido');

///  Almacen
Route::get('/administracion/almacen/listAlmacen', 'Administracion\AlmacenController@index');

//Ventas
Route::get('/administracion/ventas/getListarStockProds', 'Administracion\VentaController@store');

//Clientes
Route::post('/administracion/cliente/createClientes', 'Administracion\ClienteController@create');
Route::get('/administracion/cliente/store', 'Administracion\ClienteController@store');
Route::get('/administracion/cliente/listClientesById', 'Administracion\ClienteController@listPermisosById');
Route::post('/administracion/cliente/EditClientes', 'Administracion\ClienteController@edit');
Route::get('/administracion/cliente/getListarCliente', 'Administracion\ClienteController@getListarCliente');

//DetalleCotizacion
Route::get('/administracion/detallecotizancion/listProdByName', 'Administracion\DetalleCotizacionController@listProdByName');

//Cotizacion
Route::post('/administracion/cotizacion/addTempCotizacion', 'Administracion\CotizacionController@addTempCotizacion');

//Tipo de pago
Route::get('/administracion/cotizacion/listTipoPago', 'Administracion\CotizacionController@listTipoPago');

//TempCotizacion
Route::get('/administracion/tempcotizacion/ListtempCotizacion', 'Administracion\CotizacionController@ListtempCotizacion');
Route::post('/administracion/tempcotizacion/eliminarTempitemCoti', 'Administracion\CotizacionController@eliminarTempitemCoti');
//Elimina por boton eliminar de listado de items
Route::post('/administracion/tempcotizacion/reorder', 'Administracion\CotizacionController@reorder');
Route::post('/administracion/tempcotizacion/grabaCotizacion', 'Administracion\CotizacionController@create');


//Homologacion
Route::get('/administracion/tempcotizacion/getListarHomologacion', 'Administracion\HomologadoController@index');











Route::get('/{optional?}', function () {
    return view('welcome');
})->name('basepath')
    ->where('optional', '.*');
