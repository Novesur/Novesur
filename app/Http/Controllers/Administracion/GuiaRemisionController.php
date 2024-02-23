<?php

namespace App\Http\Controllers\Administracion;

use App\Almacen;
use App\Cliente;
use App\Countable;
use App\DetalleguiaRemision;
use App\GuiaRemision;
use App\Http\Controllers\Controller;
use App\ModalidadTransporte;
use App\Producto;
use App\TempGuiaRemision;
use App\TipoTraslado;
use App\UnidMedida;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class GuiaRemisionController extends Controller
{

    public function create(Request $request)
    {

        $contador = Countable::all();
        $infoClient = Cliente::where('ruc', $request->nIdRuc)->first();




        //Si es externo 
        if ($request->nIdTipoTraslado == 1) {
            $countGuia = $contador[0]->countGuiaExterna;
            
            //$countGuiaExterna = GuiaRemision::where('tipo_traslado_id', 1)->count();
            $infoUser = User::where('id', $request->nIdUser)->first();
            $infoAlmacen = Almacen::where('id', $infoUser->almacen_id)->first();
            
            if ($countGuia === 1) {
                $codigo = 'T001-0000001';
            } else {
                $codigo = 'T0' . $infoAlmacen->codigo . '-' . sprintf('%07d', $countGuia + 1);
            }


            if ($request->session()->has('products')) {
                $GuiaRemision = new GuiaRemision();
                $GuiaRemision->codigo =  $codigo;
                $GuiaRemision->fechainicio =  $request->cFechaTraslado;
                $GuiaRemision->tipo_traslado_id =  $request->nIdTipoTraslado;
                $GuiaRemision->puntopartida_id =  $request->nIdPartida;
                $GuiaRemision->puntollegada_id =  $request->nIdLlegada;
                $GuiaRemision->cliente_id =  $infoClient->id;
                $GuiaRemision->placaconductor =  $request->cPlacaVehiculo;
                $GuiaRemision->motivotraslado_id =  $request->nIdMotivo;
                $GuiaRemision->modalidadtransporte_id =  $request->nIdModTransporte;
                $GuiaRemision->dniconductor =  $request->cDniConductor;
                $GuiaRemision->pesototal =  $request->cPesoTotal;
                $GuiaRemision->observaciones =  $request->cObservacion;
                $GuiaRemision->estadopedido_id =  4;
                $GuiaRemision->user_id =  $request->nIdUser;
                $GuiaRemision->save();

                $detGuiaRemision = Session::get('products');
                $allProducts = $detGuiaRemision->map(function ($product) use ($GuiaRemision) {
                    return [
                        'guiaremision_id' => $GuiaRemision->id,
                        'producto_id'      => $product->cantidad,
                        'cantidad' => $product->unidmedida_id,
                        'peso'   => $product->producto_id,
                        'estadoprod_id'         => 1,
                    ];
                });
                DetalleguiaRemision::insert($allProducts->toArray());
                DB::commit();
                Session::put('products', collect([]));
                Countable::where('id', 1)->update(['countGuiaExterna' => $countGuia + 1]);
            }
        }

        //Si es interno 
        if ($request->nIdTipoTraslado == 2) {

            //$countGuiaInterno = GuiaRemision::where('tipo_traslado_id', 2)->count();
            $countGuia = $contador[0]->countGuiaInterna;
            $infoUser = User::where('id', $request->nIdUser)->first();
            $infoAlmacen = Almacen::where('id', $infoUser->almacen_id)->first();
            if ($countGuia === 1) {
                $codigo = '001-0000001';
            } else {
                $codigo = '0' . $infoAlmacen->codigo . '-' . sprintf('%07d', $countGuia  + 1);
            }

            if ($request->session()->has('products')) {
                $GuiaRemision = new GuiaRemision();
                $GuiaRemision->codigo =  $codigo;
                $GuiaRemision->fechainicio =  $request->cFechaTraslado;
                $GuiaRemision->tipo_traslado_id =  $request->nIdTipoTraslado;
                $GuiaRemision->puntopartida_id =  $request->nIdPartida;
                $GuiaRemision->puntollegada_id =  $request->nIdLlegada;
                $GuiaRemision->cliente_id =  $infoClient->id;
                $GuiaRemision->placaconductor =  $request->cPlacaVehiculo;
                $GuiaRemision->motivotraslado_id =  $request->nIdMotivo;
                $GuiaRemision->modalidadtransporte_id =  $request->nIdModTransporte;
                $GuiaRemision->dniconductor =  $request->cDniConductor;
                $GuiaRemision->pesototal =  $request->cPesoTotal;
                $GuiaRemision->observaciones =  $request->cObservacion;
                $GuiaRemision->estadopedido_id =  4;
                $GuiaRemision->user_id =  $request->nIdUser;
                $GuiaRemision->save();

                $detGuiaRemision = Session::get('products');
                $allProducts = $detGuiaRemision->map(function ($product) use ($GuiaRemision) {
                    return [
                        'guiaremision_id' => $GuiaRemision->id,
                        'producto_id'      => $product->cantidad,
                        'cantidad' => $product->unidmedida_id,
                        'peso'   => $product->producto_id,
                        'estadoprod_id'         => 1,
                    ];
                });
                DetalleguiaRemision::insert($allProducts->toArray());
                DB::commit();
                Session::put('products', collect([]));
                Countable::where('id', 1)->update(['countGuiaInterna' => $countGuia + 1]);
            }
        }

        return response()->json(['message' => 'Guia de Remision pendiente agregada', 'icon' => 'success'], 200);
    }

    public function addProduct(Request $request)
    {


        $product = Producto::where(['id' => $request->nIdprod])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $products = Session::get('products');
        $products = ($products != null) ? collect($products) : collect([]);

        $articulo = $product;
        $unidmed = UnidMedida::where(['id' => $request->nIdUnidMed])->first();
        $TempGuiaRemision = new TempGuiaRemision();

        $TempGuiaRemision->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed, 'unidmedNombre' => $unidmed->nombre, 'peso' => $request->cPeso, 'codigo' => $product->codigo, 'producto_id' => $request->nIdprod, 'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre,  'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre]);
        $products->push($TempGuiaRemision);
        Session::put('products', $products);
    }

    public  function ListtempGuiaRemision()
    {
        $dato = session()->get('products') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function eliminarTemporder()
    {
        Session::put('products', null);
        $dato = session()->get('products') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function tipotraslado()
    {
        $dato = TipoTraslado::all();
        return $dato;
    }

    public function ListModTransporte()
    {
        $dato = ModalidadTransporte::all();
        return $dato;
    }
}
