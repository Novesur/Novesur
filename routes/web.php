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

Route::get('/administracion/modelo/getListarModelos', 'Administracion\ModelotipoController@store');
Route::get('/administracion/modelo/listByIdModelo', 'Administracion\ModelotipoController@listByIdModelo');
Route::post('/administracion/modelo/setRegistrarModelo', 'Administracion\ModelotipoController@create');
Route::post('/administracion/modelo/setEditarModelo', 'Administracion\ModelotipoController@edit');

////////////Familia
Route::get('/administracion/familia/getListarFamilias', 'Administracion\FamiliaController@store');
Route::post('/administracion/familia/setRegistrarfamilias', 'Administracion\FamiliaController@create');
Route::get('/administracion/familia/listByIdFamilia', 'Administracion\FamiliaController@listByIdFamilia');
Route::post('/administracion/familia/setEditarfamilias', 'Administracion\FamiliaController@edit');
Route::post('/operacion/familia/export', 'Administracion\FamiliaController@export');
///////////////////////////////////////////////////////////////////////////////////////////////

/////////// Marcas
Route::get('/administracion/marcas/getListarMarcas', 'Administracion\MarcaController@store');
Route::post('/administracion/marcas/setRegistrarMarcas', 'Administracion\MarcaController@create');
Route::get('/administracion/marcas/listByIdMarcas', 'Administracion\MarcaController@listByIdMarcas');
Route::post('/administracion/marcas/setEditarMarca', 'Administracion\MarcaController@edit');
Route::post('/operacion/marcas/export', 'Administracion\MarcaController@export');
////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////// Material
Route::get('/administracion/material/getListarMaterial', 'Administracion\MaterialController@store');
Route::post('/administracion/material/setRegistrarMaterial', 'Administracion\MaterialController@create');
Route::get('/administracion/material/listByIdMaterial', 'Administracion\MaterialController@listByIdMaterial');
Route::post('/administracion/material/setEditarMaterial', 'Administracion\MaterialController@edit');
Route::post('/operacion/material/export', 'Administracion\MaterialController@export');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////// SubFamilia
Route::get('/administracion/subfamilia/getListarSubfamilia', 'Administracion\SubfamiliaController@store');
Route::post('/administracion/subfamilia/setRegistrarSubfamilia', 'Administracion\SubfamiliaController@create');
Route::get('/administracion/subfamilia/listByIdSubfamilia', 'Administracion\SubfamiliaController@listByIdSubfamilia');
Route::post('/administracion/subfamilia/setEditarSubfamilia', 'Administracion\SubfamiliaController@edit');
Route::get('/administracion/subfamilia/listSubFamiliabyFamilia', 'Administracion\SubfamiliaController@listSubFamiliabyFamilia');
Route::post('/operacion/subfamilia/export', 'Administracion\SubfamiliaController@export');

/////////// Modelo/Tipo
Route::get('/administracion/modelotipo/getListarModelotipo', 'Administracion\ModelotipoController@store');
Route::post('/administracion/modelotipo/setRegistrarModelotipo', 'Administracion\ModelotipoController@create');
Route::get('/administracion/modelotipo/listByIdModelotipo', 'Administracion\ModelotipoController@listByIdModelotipo');
Route::post('/administracion/modelotipo/setEditarModelotipo', 'Administracion\ModelotipoController@edit');
Route::post('/operacion/modelotipo/export', 'Administracion\ModelotipoController@export');

/////////// Estado del Producto
Route::get('/administracion/estadoprod/getListarEstadoprod', 'Administracion\EstadoProdController@index');

//////////  Producto
Route::get('/administracion/producto/getListarProducto', 'Administracion\ProductoController@index');
Route::post('/administracion/producto/setRegistrarProducto', 'Administracion\ProductoController@create');
Route::get('/administracion/producto/getListarProductoById', 'Administracion\ProductoController@ListarProductoById');
Route::get('/administracion/producto/ListarProductoByIdKardex', 'Administracion\ProductoController@ListarProductoByIdKardex');
Route::post('/administracion/producto/setEditarProductos', 'Administracion\ProductoController@edit');
Route::post('/operacion/producto/export', 'Administracion\ProductoController@export');
Route::get('/administracion/producto/BuscaCodigoProducto', 'Administracion\ProductoController@BuscaCodigoProducto');

////////  Proveedor
Route::get('/administracion/proveedor/getListarProveedor', 'Administracion\ProveedorController@index');
Route::post('/administracion/proveedor/setRegistrarProveedor', 'Administracion\ProveedorController@create');
Route::get('/administracion/proveedor/getListarProveedorById', 'Administracion\ProveedorController@ListarProveedorById');
Route::post('/administracion/proveedor/setEditarProveedor', 'Administracion\ProveedorController@edit');
Route::get('/administracion/KardexDetalle/listProveedor', 'Administracion\KardexDetalleController@listProveedor');
Route::get('/administracion/proveedor/ListarProveedorByRuc', 'Administracion\ProveedorController@ListarProveedorByRuc');
Route::get('/administracion/proveedor/ListProveedor', 'Administracion\ProveedorController@ListProveedor');
Route::post('/operacion/Proveedor/export', 'Administracion\ProveedorController@export');



/////  Kardex
Route::get('/administracion/kardex/getListarKardexByProduct', 'Administracion\KardexController@index');
Route::post('/administracion/kardex/setRegistrarKardex', 'Administracion\KardexController@create');
Route::get('/administracion/kardex/getListarKardex', 'Administracion\KardexController@store');
Route::post('/administracion/kardex/BuscaStockxProducto', 'Administracion\KardexController@BuscaStockxProducto');

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
Route::get('/administracion/usuario/getListarVendedores', 'Administracion\UsuarioController@getListarVendedores');
Route::get('/administracion/usuario/getListarGradoAcad', 'Administracion\UsuarioController@getListarGradoAcad');


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
Route::get('/administracion/almacen/AlmacenbyEstado', 'Administracion\AlmacenController@AlmacenbyEstado');
Route::get('/administracion/almacen/AlmacenLlegada', 'Administracion\AlmacenController@AlmacenLlegada');




//Ventas
Route::get('/administracion/ventas/getListarStockProds', 'Administracion\VentaController@store');

//Clientes
Route::post('/administracion/cliente/createClientes', 'Administracion\ClienteController@create');
Route::get('/administracion/cliente/store', 'Administracion\ClienteController@store');
Route::get('/administracion/cliente/listClientesById', 'Administracion\ClienteController@listClientesById');
Route::post('/administracion/cliente/EditClientes', 'Administracion\ClienteController@edit');
Route::get('/administracion/cliente/getListarCliente', 'Administracion\ClienteController@getListarCliente');
Route::get('/administracion/cliente/listGetClienteVendedor', 'Administracion\ClienteController@listGetClienteVendedor');
Route::get('/administracion/cliente/getListarAllCliente', 'Administracion\ClienteController@getListarAllCliente');
Route::post('/operacion/Cliente/export', 'Administracion\ClienteController@export');
Route::get('/administracion/cliente/listClientAll', 'Administracion\ClienteController@listClientAll');
Route::post('/administracion/cliente/consultaRuc', 'Administracion\ClienteController@consultaRuc');
Route::post('/administracion/cliente/consultaDNI', 'Administracion\ClienteController@consultaDNI');
Route::post('/administracion/cliente/UpdateClientVendedor', 'Administracion\ClienteController@UpdateClientVendedor');
Route::get('/administracion/cliente/listClientesByIdCoti', 'Administracion\ClienteController@listClientesByIdCoti');
Route::post('/administracion/cliente/listDataCliente', 'Administracion\ClienteController@listDataCliente');
Route::post('/administracion/cliente/BuscaRucBD', 'Administracion\ClienteController@BuscaRucBD');





//DetalleCotizacion
Route::get('/administracion/detallecotizancion/listProdByName', 'Administracion\DetalleCotizacionController@listProdByName');
Route::get('/administracion/detallecotizancion/listDetCotizacionBy', 'Administracion\DetalleCotizacionController@listDetCotizacionBy');
Route::post('/administracion/detallecotizancion/DatosItemDetalleCotixItem', 'Administracion\DetalleCotizacionController@DatosItemDetalleCotixItem');
Route::post('/administracion/detallecotizancion/EditDatosItem', 'Administracion\DetalleCotizacionController@EditDatosItem');
Route::get('/administracion/detallecotizancion/listDetCotibyId', 'Administracion\DetalleCotizacionController@listDetCotibyId');


/// Estado de Cotizacion
Route::get('/administracion/detallecotizancion/listEstadoCotizacion', 'Administracion\DetalleCotizacionController@listEstadoCotizacion');
Route::post('/administracion/cotizacion/editEstadoCotizacion', 'Administracion\CotizacionController@editEstadoCotizacion');


//Cotizacion
Route::post('/administracion/cotizacion/addTempCotizacion', 'Administracion\CotizacionController@addTempCotizacion');
Route::get('/administracion/cotizacion/ListCotizacionesby', 'Administracion\CotizacionController@ListCotizacionesby');
Route::get('/administracion/cotizacion/ListCotizacionbyId', 'Administracion\CotizacionController@ListCotizacionbyId');
Route::post('/administracion/cotizacion/addTempEditCotizacion', 'Administracion\CotizacionController@addTempEditCotizacion');
Route::post('/administracion/cotizacion/EditCotizacion', 'Administracion\CotizacionController@edit');
Route::post('/administracion/cotizacion/dellTempEditCotizacion', 'Administracion\CotizacionController@dellTempEditCotizacion');
Route::get('/administracion/cotizacion/listCotizacionList', 'Administracion\CotizacionController@listCotizacionList');
Route::get('/administracion/cotizacion/listCotizacionListByDate', 'Administracion\CotizacionController@listCotizacionListByDate');
Route::get('/administracion/cotizacion/listCotizacionListByClient', 'Administracion\CotizacionController@listCotizacionListByClient');
Route::get('/administracion/cotizacion/listCotizacionListByVendedor', 'Administracion\CotizacionController@listCotizacionListByVendedor');
Route::post('/administracion/cotizacion/CantidadDiasCotizacion', 'Administracion\CotizacionController@CantidadDiasCotizacion');
Route::post('/administracion/cotizacion/updateFechaCotizacion', 'Administracion\CotizacionController@updateFechaCotizacion');
Route::get('/administracion/cotizacion/SumaTotalCotizacion', 'Administracion\CotizacionController@SumaTotalCotizacion');
Route::get('/administracion/cotizacion/buscaEstado', 'Administracion\CotizacionController@buscaEstado');
Route::get('/administracion/cotizacion/ReporteVentasFechaEstado', 'Administracion\CotizacionController@ReporteVentasFechaEstado');
Route::get('/administracion/cotizacion/listDetalleProductosbyDate', 'Administracion\CotizacionController@listDetalleProductosbyDate');
Route::get('/administracion/cotizacion/listDetalleProductosListByVendedor', 'Administracion\CotizacionController@listDetalleProductosListByVendedor');
Route::post('/operacion/cotizacionProduct/getExcelListProductFecha', 'Administracion\CotizacionController@getExcelListProductFecha');
Route::get('/administracion/cotizacion/AnalisisCotizacionListByDate', 'Administracion\CotizacionController@AnalisisCotizacionListByDate');
Route::post('/operacion/cotizacionProduct/ExcelAnalisisCotizacionFecha', 'Administracion\CotizacionController@ExcelAnalisisCotizacionFecha');




/// Exportados en formato Excel
Route::post('/operacion/cotizacionProduct/exportProduct', 'Administracion\CotizacionController@exportProductCotizacion');
Route::post('/operacion/cotizacionProduct/getExcelCotizacionFecha', 'Administracion\CotizacionController@exportFechaCotizacion');
Route::post('/operacion/cotizacionProduct/exportVendedor', 'Administracion\CotizacionController@exportVendedor');
Route::post('/operacion/cotizacionProduct/exportReporteVentasFechaEstado', 'Administracion\CotizacionController@exportReporteVentasFechaEstado');
///////////////////////////////////////////////////




/// COTIZACION A PDF
Route::get('/administracion/cotizacion/CotizacionCabecera', 'Administracion\CotizacionController@CotizacionCabecera');
Route::post('/administracion/cotizacion/CotizacionPdf', 'Administracion\CotizacionController@CotizacionPdf');

//Tipo de pago
Route::get('/administracion/cotizacion/listTipoPago', 'Administracion\CotizacionController@listTipoPago');

//Listado de dias de Pago
Route::get('/administracion/pago/index', 'Administracion\PagoController@index');

//TempCotizacion
Route::get('/administracion/tempcotizacion/ListtempCotizacion', 'Administracion\CotizacionController@ListtempCotizacion');
Route::post('/administracion/tempcotizacion/eliminarTempitemCoti', 'Administracion\CotizacionController@eliminarTempitemCoti');
//Elimina por boton eliminar de listado de items
Route::post('/administracion/tempcotizacion/reorder', 'Administracion\CotizacionController@reorder');
Route::post('/administracion/tempcotizacion/grabaCotizacion', 'Administracion\CotizacionController@create');


//Homologacion
Route::get('/administracion/tempcotizacion/getListarHomologacion', 'Administracion\HomologadoController@index');

/// Tipo de Articulo
Route::post('/administracion/tipo/store', 'Administracion\TipoController@Store');
Route::get('/administracion/tipo/index', 'Administracion\TipoController@index');
Route::post('/administracion/tipo/edit', 'Administracion\TipoController@edit');
Route::get('/administracion/tipo/create', 'Administracion\TipoController@create');

/// Categoria de Articulos
Route::get('/administracion/catart/index', 'Administracion\CatArticuloController@index');


///  Articulo de Tienda
Route::get('/administracion/articulo/index', 'Administracion\ArticuloController@index');
Route::post('/administracion/setRegistrarArchivo', 'Administracion\FilesController@setRegistrarArchivo');
Route::post('/administracion/articulo/store', 'Administracion\ArticuloController@store');
Route::get('/administracion/articulo/listArticulosById', 'Administracion\ArticuloController@listArticulosById');

/// Parte de Ingreso

Route::post('/administracion/parteIngreso/CambiarEstadoDetalleOC', 'Administracion\ParteIngresoController@CambiarEstadoDetalleOC');
Route::post('/administracion/parte_ingreso/setGrabarPIngreso', 'Administracion\ParteIngresoController@setGrabaPIngreso');
Route::get('/administracion/parte_ingreso/ListParteIngreso', 'Administracion\ParteIngresoController@ListParteIngreso');
Route::post('/administracion/parte_ingreso/ProveedorFechaPdf', 'Administracion\ParteIngresoController@ProveedorFechaPdf');
Route::get('/administracion/parte_ingreso/ListParteIngresoxNroOrden', 'Administracion\ParteIngresoController@ListParteIngresoxNroOrden');
Route::post('/administracion/parte_ingreso/ProveedorOrdenCompraPdf', 'Administracion\ParteIngresoController@ProveedorOrdenCompraPdf');
Route::get('/administracion/parte_ingreso/ListParteIngresoxProduct', 'Administracion\ParteIngresoController@ListParteIngresoxProduct');






//Parte ingresoSalida
Route::post('/administracion/parteingSalida/create', 'Administracion\ParteInSaliController@create');
Route::post('/administracion/parteingSalida/saveParteIngresoOC', 'Administracion\ParteInSaliController@saveParteIngresoOC');
Route::post('/administracion/parteingSalida/saveParteSalida', 'Administracion\ParteInSaliController@saveParteSalida');
Route::get('/administracion/parteingSalida/listStockByproduct', 'Administracion\ParteInSaliController@listStockByproduct');
Route::post('/administracion/parteingSalida/StockProductByAlmacen', 'Administracion\ParteInSaliController@StockProductByAlmacen');
Route::post('/administracion/parteingSalida/ListarDatosOrdenCompra', 'Administracion\ParteInSaliController@ListarDatosOrdenCompra');
Route::post('/administracion/parteingSalida/ListarDatosOrdenServicio', 'Administracion\ParteInSaliController@ListarDatosOrdenServicio');
Route::post('/administracion/parteingSalida/saveParteIngresoOS', 'Administracion\ParteInSaliController@saveParteIngresoOS');

/// Garantia
Route::get('/administracion/garantia/index', 'Administracion\GarantiaController@index');

/// Orden de Compra
Route::post('/administracion/ordenCompra/addOrden', 'Administracion\OrdencompraController@addOrden');
Route::get('/administracion/ordenCompra/ListtempOrden', 'Administracion\OrdencompraController@ListtempOrden');
Route::post('/administracion/ordenCompra/eliminarTemporder', 'Administracion\OrdencompraController@eliminarTemporder');
Route::post('/administracion/ordenCompra/setGrabarOrderCompra', 'Administracion\OrdencompraController@create');
Route::get('/administracion/ordenCompra/ListtempOrden', 'Administracion\OrdencompraController@ListtempOrden');
Route::get('/administracion/ordenCompra/ListXProduct', 'Administracion\OrdencompraController@ListXProduct');
Route::get('/administracion/ordenCompra/ListXProveedor', 'Administracion\OrdencompraController@ListXProveedor');
Route::post('/administracion/ordenCompra/setGenerarOrderPedidoPdf', 'Administracion\OrdencompraController@setGenerarOrderPedidoPdf');
Route::post('/administracion/ordenCompra/ListarDatosOrdenCompraXId', 'Administracion\OrdencompraController@ListarDatosOrdenCompraXId');
Route::post('/administracion/ordenCompra/setDarBajaOrderCompra', 'Administracion\OrdencompraController@setDarBajaOrderCompra');
Route::post('/administracion/ordenCompra/CargaDatosOrdenCompra', 'Administracion\OrdencompraController@CargaDatosOrdenCompra');
Route::get('/administracion/ordenCompra/ListPrecioOrdCompra', 'Administracion\OrdencompraController@ListPrecioOrdCompra');
Route::get('/administracion/ordenCompra/ListarPrecioxProveedorOC', 'Administracion\OrdencompraController@ListarPrecioxProveedorOC');
Route::post('/operacion/ordenCompra/exportPrecioOcExcelxProduct', 'Administracion\OrdencompraController@exportPrecioOcExcelxProduct');
Route::post('/operacion/ordenCompra/exportPrecioOcExcelxProveedor', 'Administracion\OrdencompraController@exportPrecioOcExcelxProveedor');
Route::post('/administracion/ordenCompra/setApruebaOrdenCompra', 'Administracion\OrdencompraController@setApruebaOrdenCompra');





/// Detalle de Orden de Compra
Route::get('/administracion/DetalleordenCompra/view', 'Administracion\DetalleOrdenCompraController@view');
Route::get('/administracion/DetalleordenCompra/viewModal', 'Administracion\DetalleOrdenCompraController@viewModal');
Route::post('/administracion/DetalleordenCompra/CambiarEstadoDetalleOC', 'Administracion\DetalleOrdenCompraController@CambiarEstadoDetalleOC');
Route::post('/administracion/DetalleordenCompra/setMandarValorDetalleParteIngresoXId', 'Administracion\DetalleOrdenCompraController@setMandarValorDetalleParteIngresoXId');
Route::post('/administracion/DetalleordenCompra/setAddCantidadParteIngre', 'Administracion\DetalleOrdenCompraController@setAddCantidadParteIngre');
Route::post('/administracion/DetalleordenCompra/addOrdenEdit', 'Administracion\DetalleOrdenCompraController@addOrdenEdit');
Route::post('/administracion/DetalleordenCompra/DeleteItemDetalleOrdenCompra', 'Administracion\DetalleOrdenCompraController@DeleteItemDetalleOrdenCompra');
Route::post('/administracion/DetalleordenCompra/CargaDetalleOrdenCompraEdit', 'Administracion\DetalleOrdenCompraController@CargaDetalleOrdenCompraEdit');
Route::post('/administracion/DetalleordenCompra/ModalSaveItemsDetalleOC', 'Administracion\DetalleOrdenCompraController@ModalSaveItemsDetalleOC');
Route::post('/administracion/DetalleordenCompra/editCantComplete', 'Administracion\DetalleOrdenCompraController@editCantComplete');



/// Tipo de Cambio
Route::get('/administracion/ordenCompra/TipoCambio', 'Administracion\OrdencompraController@TipoCambio');

////  Parte de Salida
Route::post('/administracion/parte_salida/GrabarPSalida', 'Administracion\ParteSalidaController@GrabarPSalida');
Route::post('/administracion/parte_salida/addTempPSalida', 'Administracion\ParteSalidaController@AddTempParteSalida');
Route::post('/administracion/parte_salida/reorder', 'Administracion\ParteSalidaController@reorder');
Route::get('/administracion/parte_salida/ListtempParteSalida', 'Administracion\ParteSalidaController@ListtempParteSalida');
Route::post('/administracion/parte_salida/eliminarTempitemPSalida', 'Administracion\ParteSalidaController@eliminarTempitemPSalida');
Route::get('/administracion/parte_salida/getListarPartesalidaFecha', 'Administracion\ParteSalidaController@getListarPartesalidaFecha');
Route::get('/administracion/parte_salida/getListarPartesalidaCliente', 'Administracion\ParteSalidaController@getListarPartesalidaCliente');
Route::post('/administracion/parte_salida/reporteParteSalidaPdf', 'Administracion\ParteSalidaController@reporteParteSalidaPdf');



////  Papeleta de Salida
Route::get('/administracion/PapeletaSalida/Motivo', 'Administracion\PapeletaSalidaController@Motivo');
Route::post('/administracion/papeletasalida/create', 'Administracion\PapeletaSalidaController@create');
Route::get('/administracion/papeletasalida/listPapeleByVendedor', 'Administracion\PapeletaSalidaController@listPapeleByVendedor');
Route::get('/administracion/papeletasalida/ListMotivos', 'Administracion\PapeletaSalidaController@ListMotivos');
Route::get('/administracion/papeletaSalida/ListPapeletaSalidabyId', 'Administracion\PapeletaSalidaController@ListPapeletaSalidabyId');
Route::post('/administracion/papeletasalida/PapeletasalidaPdf', 'Administracion\PapeletaSalidaController@PapeletasalidaPdf');
Route::post('/administracion/papeletasalida/setDarBajaPapeletaSalida', 'Administracion\PapeletaSalidaController@setDarBajaPapeletaSalida');
Route::post('/administracion/papeletasalida/setAprobarPapeletaSalida', 'Administracion\PapeletaSalidaController@setAprobarPapeletaSalida');
Route::get('/administracion/papeletasalida/listPapeleByCliente', 'Administracion\PapeletaSalidaController@listPapeleByCliente');
Route::get('/administracion/papeletasalida/getListarCliente', 'Administracion\PapeletaSalidaController@getListarCliente');
Route::post('/administracion/papeletasalida/AddTempClient', 'Administracion\PapeletaSalidaController@AddTempClient');
Route::post('/administracion/papeletasalida/CleanTempClient', 'Administracion\PapeletaSalidaController@CleanTempClient');
Route::post('/administracion/papeletasalida/EliminarClientTemp', 'Administracion\PapeletaSalidaController@EliminarClientTemp');
Route::post('/administracion/papeletasalida/ObservacionUpdate', 'Administracion\PapeletaSalidaController@ObservacionUpdate');
Route::post('/administracion/papeletasalida/getlistClientxIndex', 'Administracion\PapeletaSalidaController@getlistClientxIndex');


//REPORTE EXCEL
Route::post('/operacion/papeletaSalida/export', 'Administracion\PapeletaSalidaController@export');



///// Cliente Papeleta Salida

Route::get('/administracion/ClientePapeletaSalida/BuscaClientePapeletaS', 'Administracion\ClientePapeletaSalidaController@BuscaClientePapeletaS');


/// Orden de Servicio

Route::post('/administracion/OrdenServicio/create', 'Administracion\OrdenServicioController@create');
Route::get('/administracion/ordenServicio/ListXProveedor', 'Administracion\OrdenServicioController@ListXProveedor');
Route::post('/administracion/ordenServicio/setGenerarOrderPedidoPdf', 'Administracion\OrdenServicioController@setGenerarOrderPedidoPdf');
Route::post('/administracion/ordenServicio/setDarBajaOrderServicio', 'Administracion\OrdenServicioController@setDarBajaOrderServicio');
Route::post('/administracion/ordenServicio/CargaDatosOrdenServicio', 'Administracion\OrdenServicioController@CargaDatosOrdenServicio');
Route::get('/administracion/ordenServicio/ListXProduct', 'Administracion\OrdenServicioController@ListXProduct');


//Detalle Orden de Servicio

Route::get('/administracion/DetalleOrdenservicio/view', 'Administracion\DetalleOrdenServicioController@view');
Route::post('/administracion/DetalleOrdenservicio/addOrdenEdit', 'Administracion\DetalleOrdenServicioController@addOrdenEdit');
Route::post('/administracion/DetalleOrdenservicio/CargaDetalleOrdenServicioEdit', 'Administracion\DetalleOrdenServicioController@CargaDetalleOrdenServicioEdit');
Route::post('/administracion/DetalleOrdenservicio/ModalSaveItemsDetalleOS', 'Administracion\DetalleOrdenServicioController@ModalSaveItemsDetalleOS');
Route::post('/administracion/DetalleOrdenservicio/DeleteItemDetalleOrdenServicio', 'Administracion\DetalleOrdenServicioController@DeleteItemDetalleOrdenServicio');
Route::get('/administracion/DetalleOrdenservicio/viewDetalleOrdenServicio', 'Administracion\DetalleOrdenServicioController@viewDetalleOrdenServicio');
Route::post('/administracion/DetalleOrdenservicio/setMandarValorDetalleParteSalidaXId', 'Administracion\DetalleOrdenServicioController@setMandarValorDetalleParteSalidaXId');
Route::post('/administracion/DetalleOrdenservicio/setAddCantidadParteSali', 'Administracion\DetalleOrdenServicioController@setAddCantidadParteSali');





///Menus
Route::get('/administracion/Menu/listTipoPlatoCrear', 'Administracion\MenuController@listTipoPlatoCrear');
Route::post('/administracion/Menu/setCrearMenu', 'Administracion\MenuController@create');
Route::get('/administracion/Menu/ListTipoMenuCrear', 'Administracion\MenuController@ListTipoMenuCrear');
Route::get('/administracion/Menu/ListMenuEntrada', 'Administracion\MenuController@ListMenuEntrada');
Route::get('/administracion/Menu/ListMenuSegundo', 'Administracion\MenuController@ListMenuSegundo');
Route::get('/administracion/Menu/ListMenuExtra', 'Administracion\MenuController@ListMenuExtra');
Route::post('/administracion/Menu/createMenu', 'Administracion\MenuController@createMenu');
Route::get('/administracion/Menu/ListMenuExtra', 'Administracion\MenuController@ListMenuExtra');
Route::get('/administracion/Menu/ListMenubyDate', 'Administracion\MenuController@ListMenubyDate');
Route::post('/administracion/menu/setAnularMenu', 'Administracion\MenuController@setAnularMenu');
Route::get('/administracion/Menu/ListMenuDetallebyDate', 'Administracion\MenuController@ListMenuDetallebyDate');
Route::post('/operacion/Menu/export', 'Administracion\MenuController@export');
Route::get('/administracion/Menu/ListMenuTotal', 'Administracion\MenuController@ListMenuTotal');
Route::post('/operacion/Menu/exportTotal', 'Administracion\MenuController@exportTotal');







/// Platos Menu
Route::post('/administracion/Plato/CrearPlatoEntrada', 'Administracion\PlatoController@CrearPlatoEntrada');
Route::post('/administracion/Plato/CrearPlatoSegundo', 'Administracion\PlatoController@CrearPlatoSegundo');
Route::post('/administracion/Plato/CrearPlatoExtra', 'Administracion\PlatoController@CrearPlatoExtra');
Route::get('/administracion/Plato/getListarPEntrada', 'Administracion\PlatoController@getListarPEntrada');
Route::post('/administracion/Plato/CreateDetallePlato', 'Administracion\PlatoController@CreateDetallePlato');
Route::post('/administracion/Plato/CrearPlatoSegundo', 'Administracion\PlatoController@CrearPlatoSegundo');
Route::get('/administracion/Plato/getListarPSegundo', 'Administracion\PlatoController@getListarPSegundo');
Route::get('/administracion/Plato/getListarPExtra', 'Administracion\PlatoController@getListarPExtra');
Route::get('/administracion/plato/listEntrada', 'Administracion\PlatoController@listEntrada');
Route::get('/administracion/plato/listSegundo', 'Administracion\PlatoController@listSegundo');
Route::get('/administracion/plato/listExtra', 'Administracion\PlatoController@listExtra');
Route::post('/administracion/Plato/getDataPlato', 'Administracion\PlatoController@getDataPlato');
Route::post('/administracion/Plato/EditPlatoEntrada', 'Administracion\PlatoController@EditPlatoEntrada');
Route::post('/administracion/Plato/DeletePlatoEntrada', 'Administracion\PlatoController@DeletePlatoEntrada');
Route::post('/administracion/Plato/EditPlatoSegundo', 'Administracion\PlatoController@EditPlatoSegundo');
Route::post('/administracion/Plato/DeletePlatoSegundo', 'Administracion\PlatoController@DeletePlatoSegundo');
Route::post('/administracion/Plato/EditExtra', 'Administracion\PlatoController@EditExtra');
Route::post('/administracion/Plato/DeletePlatoExtra', 'Administracion\PlatoController@DeletePlatoExtra');
Route::post('/administracion/Plato/CrearPlatoDieta', 'Administracion\PlatoController@CrearPlatoDieta');
Route::get('/administracion/Plato/getListarPDieta', 'Administracion\PlatoController@getListarPDieta');
Route::post('/administracion/Plato/EditDieta', 'Administracion\PlatoController@EditDieta');
Route::post('/administracion/Plato/DeletePlatoDieta', 'Administracion\PlatoController@DeletePlatoDieta');
Route::get('/administracion/plato/listDieta', 'Administracion\PlatoController@listDieta');




//// Pedido Entrada
Route::post('/administracion/PedidoEntrada/create', 'Administracion\PedidoEntradaController@create');
Route::get('/administracion/PedidoEntrada/list', 'Administracion\PedidoEntradaController@list');
Route::get('/administracion/PedidoEntrada/listNow', 'Administracion\PedidoEntradaController@listNow');
Route::post('/administracion/PedidoEntrada/delete', 'Administracion\PedidoEntradaController@delete');




/// Pedido Segundo
Route::post('/administracion/PedidoSegundo/create', 'Administracion\PedidoSegundoController@create');
Route::get('/administracion/PedidoSegundo/list', 'Administracion\PedidoSegundoController@list');
Route::get('/administracion/PedidoSegundo/listNow', 'Administracion\PedidoSegundoController@listNow');
Route::post('/administracion/PedidoSegundo/delete', 'Administracion\PedidoSegundoController@delete');


/// Pedido Extra
Route::post('/administracion/PedidoExtra/create', 'Administracion\PedidoExtraController@create');
Route::get('/administracion/PedidoExtra/list', 'Administracion\PedidoExtraController@list');
Route::get('/administracion/PedidoExtra/listNow', 'Administracion\PedidoExtraController@listNow');
Route::post('/administracion/PedidoExtra/delete', 'Administracion\PedidoExtraController@delete');

/// Pedido Dieta
Route::post('/administracion/PedidoDieta/create', 'Administracion\PedidoDietaController@create');
Route::get('/administracion/PedidoDieta/list', 'Administracion\PedidoDietaController@list');
Route::post('/administracion/PedidoDieta/delete', 'Administracion\PedidoDietaController@delete');
Route::get('/administracion/PedidoDieta/listNow', 'Administracion\PedidoDietaController@listNow');

/// Informe de Produccion
Route::post('/administracion/InformeProduccion/CargaInfoProduccion', 'Administracion\InformeProduccionController@CargaInfoProduccion');
Route::get('/administracion/InformeProduccion/getListReqMatReqMat', 'Administracion\InformeProduccionController@getListReqMatReqMat');
Route::get('/administracion/InformeProduccion/getListReqManoObraReqMat', 'Administracion\InformeProduccionController@getListReqManoObraReqMat');
Route::get('/administracion/InformeProduccion/getOtrosRequerimientosReqMateriales', 'Administracion\InformeProduccionController@getOtrosRequerimientosReqMateriales');
Route::get('/administracion/InformeProduccion/list', 'Administracion\InformeProduccionController@list');
Route::post('/administracion/InformeProduccion/saveReqMateriales', 'Administracion\InformeProduccionController@saveReqMateriales');
Route::post('/administracion/InformeProduccion/saveOtrosRequerimientos', 'Administracion\InformeProduccionController@saveOtrosRequerimientos');
Route::post('/administracion/InformeProduccion/saveMObra', 'Administracion\InformeProduccionController@saveMObra');
Route::post('/administracion/InformeProduccion/DeleteOtrosReque', 'Administracion\InformeProduccionController@DeleteOtrosReque');
Route::post('/administracion/InformeProduccion/DeleteManodeObra', 'Administracion\InformeProduccionController@DeleteManodeObra');
Route::post('/administracion/InformeProduccion/DeleteReqMateriales', 'Administracion\InformeProduccionController@DeleteReqMateriales');
Route::post('/administracion/InformeProduccion/setGenerarInfoProduccionPdf', 'Administracion\InformeProduccionController@setGenerarInfoProduccionPdf');
Route::post('/administracion/InformeProduccion/EditReqMateriales', 'Administracion\InformeProduccionController@EditReqMateriales');
Route::post('/administracion/InformeProduccion/addMaterialReqMateriales', 'Administracion\InformeProduccionController@addMaterialReqMateriales');
Route::post('/administracion/InformeProduccion/addMObra', 'Administracion\InformeProduccionController@addMObra');
Route::post('/administracion/InformeProduccion/addOtrosRequerimientos', 'Administracion\InformeProduccionController@addOtrosRequerimientos');
Route::post('/administracion/InformeProduccion/create', 'Administracion\InformeProduccionController@create');
Route::get('/administracion/InformeProduccion/mostrarInfoProd', 'Administracion\InformeProduccionController@mostrarInfoProd');
Route::post('/administracion/InformeProduccion/editPrecioMatOdrProd', 'Administracion\InformeProduccionController@editPrecioMatOdrProd');
Route::get('/administracion/InformeProduccion/mostrarInfoManObra', 'Administracion\InformeProduccionController@mostrarInfoManObra');
Route::post('/administracion/InformeProduccion/editPrecioHoraOdrProd', 'Administracion\InformeProduccionController@editPrecioHoraOdrProd');
Route::post('/administracion/InformeProduccion/editPrecioDiaOdrProd', 'Administracion\InformeProduccionController@editPrecioDiaOdrProd');
Route::get('/administracion/InformeProduccion/mostrarInfOtrosReq', 'Administracion\InformeProduccionController@mostrarInfOtrosReq');
Route::post('/administracion/InformeProduccion/editPrecioOtrosReq', 'Administracion\InformeProduccionController@editPrecioOtrosReq');
Route::post('/operacion/InformeProduccion/export', 'Administracion\InformeProduccionController@export');
Route::post('/administracion/InformeProduccion/ExcelListOrdProd', 'Administracion\InformeProduccionController@ExcelListOrdProd');



//// Requerimientos de Materiales

Route::post('/administracion/RequerimientoMateriales/create', 'Administracion\RequerimientoMaterialesController@create');
Route::post('/administracion/RequerimientoMateriales/addOrden', 'Administracion\RequerimientoMaterialesController@addOrden');
Route::get('/administracion/RequerimientoMateriales/eliminarTemporder', 'Administracion\RequerimientoMaterialesController@eliminarTemporder');
Route::post('/administracion/RequerimientoMateriales/addMObra', 'Administracion\RequerimientoMaterialesController@addMObra');
Route::get('/administracion/RequerimientoMateriales/CleanMaterialReqMObra', 'Administracion\RequerimientoMaterialesController@CleanMaterialReqMObra');
Route::post('/administracion/RequerimientoMateriales/addRequerimientos', 'Administracion\RequerimientoMaterialesController@addRequerimientos');
Route::get('/administracion/RequerimientoMateriales/cleanRequerimientos', 'Administracion\RequerimientoMaterialesController@cleanRequerimientos');
Route::get('/administracion/RequerimientoMateriales/list', 'Administracion\RequerimientoMaterialesController@list');
Route::post('/administracion/RequerimientoMateriales/setGenerarOrderPrduccionPdf', 'Administracion\RequerimientoMaterialesController@setGenerarOrderPrduccionPdf');
Route::post('/administracion/RequerimientoMateriales/reorderReqMateriales', 'Administracion\RequerimientoMaterialesController@reorderReqMateriales');
Route::post('/administracion/RequerimientoMateriales/reorderReqManObra', 'Administracion\RequerimientoMaterialesController@reorderReqManObra');
Route::post('/administracion/RequerimientoMateriales/reorderOtrosReq', 'Administracion\RequerimientoMaterialesController@reorderOtrosReq');
Route::post('/administracion/RequerimientoMateriales/getDataReqMateriales', 'Administracion\RequerimientoMaterialesController@getDataReqMateriales');
Route::post('administracion/RequerimientoMateriales/EditModalReqMateriales', 'Administracion\RequerimientoMaterialesController@EditModalReqMateriales');
Route::post('administracion/RequerimientoMateriales/getDataReqManoObra', 'Administracion\RequerimientoMaterialesController@getDataReqManoObra');
Route::post('administracion/RequerimientoMateriales/EditModalManoObra', 'Administracion\RequerimientoMaterialesController@EditModalManoObra');
Route::post('administracion/RequerimientoMateriales/getDataOtrosReq', 'Administracion\RequerimientoMaterialesController@getDataOtrosReq');
Route::post('administracion/RequerimientoMateriales/EditModalOtrosReq', 'Administracion\RequerimientoMaterialesController@EditModalOtrosReq');



///// Nota de Pedido /////
Route::post('/administracion/NotaPedido/delete', 'Administracion\NotaPedidoController@delete');
Route::post('/administracion/NotaPedido/create', 'Administracion\NotaPedidoController@create');
Route::get('/administracion/NotaPedido/list', 'Administracion\NotaPedidoController@list');
Route::post('/administracion/NotaPedido/NotaPedidoPdf', 'Administracion\NotaPedidoController@NotaPedidoPdf');
Route::get('/administracion/NotaPedido/listNotaPedidoBy', 'Administracion\NotaPedidoController@listNotaPedidoBy');
Route::post('/administracion/NotaPedido/editcantDetNotaPedido', 'Administracion\NotaPedidoController@editcantDetNotaPedido');

/* Proyecto */
Route::post('/administracion/proyecto_ReqMateriales/create', 'Administracion\ProyectoReqMaterialesController@create');
Route::get('/administracion/proyecto_ReqMateriales/list', 'Administracion\ProyectoReqMaterialesController@list');
Route::post('/operacion/proyecto_ReqMateriales/export', 'Administracion\ProyectoReqMaterialesController@export');
Route::post('/administracion/proyecto_ReqMateriales/listbyId', 'Administracion\ProyectoReqMaterialesController@listbyId');
Route::post('/administracion/proyecto_ReqMateriales/setGenerarPReqMaterialesPdf', 'Administracion\ProyectoReqMaterialesController@setGenerarPReqMaterialesPdf');
Route::get('/administracion/proyecto_ReqMateriales/mostrarInfoReqMateriales', 'Administracion\ProyectoReqMaterialesController@mostrarInfoReqMateriales');

/* Proyecto Materiales */
Route::post('/administracion/ProyectoMateriales/addOrden', 'Administracion\ProyectoMaterialesController@addOrden');
Route::get('/administracion/ProyectoMateriales/eliminarTemporder', 'Administracion\ProyectoMaterialesController@eliminarTemporder');
Route::post('/administracion/ProyectoMateriales/reorderReqMateriales', 'Administracion\ProyectoMaterialesController@reorderReqMateriales');
Route::get('/administracion/ProyectoMateriales/listproyMateriales', 'Administracion\ProyectoMaterialesController@listproyMateriales');
Route::post('/administracion/ProyectoMateriales/addReqMatProyReq', 'Administracion\ProyectoMaterialesController@addReqMatProyReq');
Route::post('/administracion/ProyectoMateriales/SaveMatReqMatProy', 'Administracion\ProyectoMaterialesController@SaveMatReqMatProy');
Route::post('/administracion/ProyectoMateriales/getDataModalReqMateriales', 'Administracion\ProyectoMaterialesController@getDataModalReqMateriales');
Route::post('/administracion/ProyectoMateriales/EditModalReqMateriales', 'Administracion\ProyectoMaterialesController@EditModalReqMateriales');



/* Proyecto Mano de Obra */
Route::post('/administracion/ProyectoManoObra/addProyManObra', 'Administracion\ProyectoManoObraController@addProyManObra');
Route::get('/administracion/ProyectoManoObra/CleanProyectManObra', 'Administracion\ProyectoManoObraController@CleanProyectManObra');
Route::post('/administracion/ProyectoManoObra/reorderProyectManObra', 'Administracion\ProyectoManoObraController@reorderProyectManObra');
 Route::get('/administracion/ProyectoManoObra/listproyManoObra', 'Administracion\ProyectoManoObraController@listproyManoObra');
 Route::get('/administracion/ProyectoManoObra/CleanProyectManObra', 'Administracion\ProyectoManoObraController@CleanProyectManObra');
 Route::post('/administracion/ProyectoManoObra/addReqMatProyManObra', 'Administracion\ProyectoManoObraController@addReqMatProyManObra');



/* Otros Requerimientos*/
Route::post('/administracion/ProyectOtrosReq/addOtrosReqMateriales', 'Administracion\ProyectOtrosReqController@addOtrosReqMateriales');
Route::post('/administracion/ProyectOtrosReq/reorderOtrosReq', 'Administracion\ProyectOtrosReqController@reorderOtrosReq');
Route::post('/administracion/ProyectOtrosReq/addOtrosProyReqMateriales', 'Administracion\ProyectOtrosReqController@addOtrosProyReqMateriales');
Route::get('/administracion/ProyectOtrosReq/CleanOtrosProyReqMateriales', 'Administracion\ProyectOtrosReqController@CleanOtrosProyReqMateriales');
Route::get('/administracion/ProyectOtrosReq/listproyOtrosReq', 'Administracion\ProyectOtrosReqController@listproyOtrosReq');
Route::post('/administracion/ProyectOtrosReq/addReqMatProyOtrosReq', 'Administracion\ProyectOtrosReqController@addReqMatProyOtrosReq');


/* Informe Valorizacion */
Route::post('/administracion/InformeValorizacion/create', 'Administracion\InformeValorizacionController@create');
Route::get('/administracion/InformeValorizacion/index', 'Administracion\InformeValorizacionController@index');
Route::post('/operacion/InformeValorizacion/export', 'Administracion\InformeValorizacionController@export');
Route::post('/administracion/InformeValorizacion/setGenerarInfoValorizacionPdf', 'Administracion\InformeValorizacionController@setGenerarInfoValorizacionPdf');
Route::post('/administracion/InformeValorizacion/ExcelDetalladoInfoValor', 'Administracion\InformeValorizacionController@ExcelDetalladoInfoValor');

Route::get('/administracion/informeValorizacion/mostrarInfoReqMateriales', 'Administracion\InformeValorizacionController@mostrarInfoReqMateriales');
Route::get('/administracion/informeValorizacion/mostrarInfoManObra', 'Administracion\InformeValorizacionController@mostrarInfoManObra');
Route::get('/administracion/informeValorizacion/mostrarInfOtrosReq', 'Administracion\InformeValorizacionController@mostrarInfOtrosReq');
Route::post('/administracion/InformeValorizacion/editPrecioMatInfoValor', 'Administracion\InformeValorizacionController@editPrecioMatInfoValor');
Route::get('/administracion/informeValorizacion/listUnidAlquiler', 'Administracion\InformeValorizacionController@listUnidAlquiler');
Route::post('/administracion/InformeValorizacion/getAlquiler', 'Administracion\InformeValorizacionController@getAlquiler');
Route::post('/administracion/InformeValorizacion/EditOtrosReqAlquiler', 'Administracion\InformeValorizacionController@EditOtrosReqAlquiler');
Route::post('/administracion/InformeValorizacion/editPrecioOtrosReq', 'Administracion\InformeValorizacionController@editPrecioOtrosReq');


/* Proyecto Materiales  Informe Valorizacion*/
//Route::post('/administracion/informeValorizacion/addReqMatInfoValor', 'Administracion\InformeValorizacionMaterialesController@addReqMatInfoValor');
Route::get('/administracion/informeValorizacion/eliminarTemporder', 'Administracion\InformeValorizacionMaterialesController@eliminarTemporder');
Route::post('/administracion/informeValorizacion/reorderReqMateriales', 'Administracion\InformeValorizacionMaterialesController@reorderReqMateriales');
//Route::get('/administracion/informeValorizacion/listInfoValorMateriales', 'Administracion\InformeValorizacionMaterialesController@listInfoValorMateriales');
Route::get('/administracion/informeValorizacion/ListValorMaterialesxInfoValor', 'Administracion\InformeValorizacionMaterialesController@ListValorMaterialesxInfoValor');



/* Mano de Obra Informe Valorizacion */
//Route::post('/administracion/informeValorizacion/addInfoValorManObra', 'Administracion\InformeValorizacionManoObraController@addInfoValorManObra');
Route::get('/administracion/informeValorizacion/CleanProyectManObra', 'Administracion\InformeValorizacionManoObraController@CleanProyectManObra');
Route::post('/administracion/informeValorizacion/reorderReqManObra', 'Administracion\InformeValorizacionManoObraController@reorderReqManObra');
//Route::get('/administracion/informeValorizacion/listInfoValorManoObra', 'Administracion\InformeValorizacionManoObraController@listInfoValorManoObra');
Route::get('/administracion/informeValorizacion/ListValorMaNObraxInfoValor', 'Administracion\InformeValorizacionManoObraController@ListValorMaNObraxInfoValor');
Route::get('/administracion/informeValorizacion/ListValorMaNObraxId', 'Administracion\InformeValorizacionManoObraController@ListValorMaNObraxId');
Route::post('/administracion/informeValorizacion/EditOtrosReqPersonal', 'Administracion\InformeValorizacionManoObraController@EditOtrosReqPersonal');




/* Otros Requerimientos Informe Valorizacion */
//Route::post('/administracion/informeValorizacion/addOtrosProyInfoValor', 'Administracion\InformeValorizacionOtrosReqController@addOtrosProyInfoValor');
Route::get('/administracion/informeValorizacion/CleanOtrosProyInfoValor', 'Administracion\InformeValorizacionOtrosReqController@CleanOtrosProyInfoValor');
Route::post('/administracion/informeValorizacion/reorderOtrosReq', 'Administracion\InformeValorizacionOtrosReqController@reorderOtrosReq');
//Route::get('/administracion/informeValorizacion/listInfoValorOtrosReq', 'Administracion\InformeValorizacionOtrosReqController@listInfoValorOtrosReq');
Route::get('/administracion/informeValorizacion/ListValorOtrosReqxInfoValor', 'Administracion\InformeValorizacionOtrosReqController@ListValorOtrosReqxInfoValor');



/* Centro de Costos */
Route::post('/administracion/CentroCostos/search', 'Administracion\CentroCostosController@search');
Route::get('/administracion/CentroCostos/list', 'Administracion\CentroCostosController@list');

/* Asistencia */
Route::post('/administracion/Personal/create', 'Administracion\PersonalController@create');

/* Zonal */
Route::get('/administracion/zonal/list', 'Administracion\ZonalController@list');

/* Tiempo Alquiler */
Route::get('/administracion/TiempoAlquiler/list', 'Administracion\TiempoAlquilerController@list');

/* Personal */
Route::post('/administracion/personal/create', 'Administracion\PersonalController@create');
Route::post('/administracion/personal/delete', 'Administracion\PersonalController@delete');
Route::get('/administracion/personal/index', 'Administracion\PersonalController@index');
Route::get('/administracion/personal/list', 'Administracion\PersonalController@list');
Route::get('/administracion/personal/DatoPersonalById', 'Administracion\PersonalController@DatoPersonalById');
Route::post('/administracion/personal/edit', 'Administracion\PersonalController@edit');
Route::get('/administracion/personal/personalAsistencia', 'Administracion\PersonalController@personalAsistencia');



/* Cargo */
Route::post('/administracion/cargo/create', 'Administracion\CargoController@create');
Route::get('/administracion/cargo/index', 'Administracion\CargoController@index');
Route::get('/administracion/cargo/listByIdCargos', 'Administracion\CargoController@listByIdCargos');
Route::post('/administracion/cargo/edit', 'Administracion\CargoController@edit');
Route::get('/administracion/cargo/list', 'Administracion\CargoController@list');


/* Asistencia */
Route::post('/administracion/asistencia/import', 'Administracion\AsistenciaController@import');
Route::get('/administracion/asistencia/listAsistByDate', 'Administracion\AsistenciaController@listAsistByDate');
Route::get('/administracion/asistencia/listByDatePersonal', 'Administracion\AsistenciaController@listByDatePersonal');
Route::post('/operacion/Asistencia/reporteByDateAsistExcel', 'Administracion\AsistenciaController@reporteByDateAsistExcel');
Route::get('/administracion/asistencia/listAsistByDate0113', 'Administracion\AsistenciaController@listAsistByDate0113');
Route::post('/operacion/asistencia/reporteByDateAsistExcel0113', 'Administracion\AsistenciaController@reporteByDateAsistExcel0113');



/* Distrito */
Route::get('/administracion/distrito/index', 'Administracion\DistritoController@index');
/* Estado de la Obra */
Route::get('/administracion/EstadoObra/list', 'Administracion\EstadoObraController@list');
/* Visita de Obra */
Route::post('/administracion/visita/create', 'Administracion\VisitaController@create');
Route::get('/administracion/visita/list', 'Administracion\VisitaController@list');
Route::post('/operacion/visita/export', 'Administracion\VisitaController@export');



/* Personal Contacto */
Route::get('/administracion/personalContacto/list', 'Administracion\PersonalContactoController@list');


/* Guia de Remision  */







/* Movimiento de Almacen */
Route::get('/administracion/MovimientoAlmacen/tipotraslado', 'Administracion\MovimientoAlmacenController@tipoTraslado');
Route::get('/administracion/MovimientoAlmacen/ListModTransporte', 'Administracion\MovimientoAlmacenController@ListModTransporte');
Route::post('/operacion/MovimientoAlmacen/create', 'Administracion\MovimientoAlmacenController@create');
Route::post('/administracion/MovimientoAlmacen/addProduct', 'Administracion\MovimientoAlmacenController@addProduct');
Route::get('/administracion/MovimientoAlmacen/ListtempGuiaRemision', 'Administracion\MovimientoAlmacenController@ListtempGuiaRemision');
Route::post('/administracion/MovimientoAlmacen/eliminarTemporder', 'Administracion\MovimientoAlmacenController@eliminarTemporder');
Route::get('/administracion/MovimientoAlmacen/list', 'Administracion\MovimientoAlmacenController@list');
Route::get('/administracion/MovimientoAlmacen/getListDetMovAlmacen', 'Administracion\MovimientoAlmacenController@getListDetMovAlmacen');
Route::post('/administracion/MovimientoAlmacen/procesar', 'Administracion\MovimientoAlmacenController@procesar');
Route::post('/administracion/MovimientoAlmacen/MovimientoAlmacenPdf', 'Administracion\MovimientoAlmacenController@MovimientoAlmacenPdf');










Route::get('/{optional?}', function () {
    return view('welcome');
})->name('basepath')
    ->where('optional', '.*');
