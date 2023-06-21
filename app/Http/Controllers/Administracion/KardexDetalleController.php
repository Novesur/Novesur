<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kardex;
use App\DetalleKardex;
use App\Motivo;
use App\Movimiento;
use App\Proveedor;
use App\UnidMedida;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class KardexDetalleController extends Controller
{

    public function create(Request $request)


    {
        $kardex = Kardex::where('id', '=', $request->nidKardex)->first();
        $DetalleKardexcount = DetalleKardex::where('kardex_id', '=', $request->nidKardex)->get()->count();

        $sumsali = DetalleKardex::where('movimiento_id', '=', '2')
            ->where('kardex_id', '=', $request->nidKardex)->sum('cantidad');

        $sumIngr = DetalleKardex::where('movimiento_id', '=', '1')
            ->where('kardex_id', '=', $request->nidKardex)->sum('cantidad');


        $stockTotal = ($sumIngr - $sumsali);

        $DetalleKardex = new DetalleKardex;

        $date = Carbon::now();
        $date = Carbon::parse($request->cFecha)->format('Y-m-d');



        if ($request->nIdMovimiento == 1) {

            $DetalleKardex->kardex_id =  $request->nidKardex;
            $DetalleKardex->fecha =  $date;
            $DetalleKardex->FactNo =  mb_strtoupper($request->cFacturaNro);
            $DetalleKardex->GuiaNo =  mb_strtoupper($request->cNroGuia);
            if($request->nIdMotivo == 4){
                $datprov = '19';
                $datclient= '1';
            }else{
                $datprov =  $request->nIdProveedor;
                $datclient =  $request->nICliente;
            }

            $DetalleKardex->proveedor_id = $datprov;
            $DetalleKardex->motivo_id = $request->nIdMotivo;
            $DetalleKardex->unidmedida_id = $request->nIdUnidMed;
            $DetalleKardex->cantidad = $request->cCantidad;
            $DetalleKardex->costunit = $request->cCostUnit;
            $DetalleKardex->movimiento_id = $request->nIdMovimiento;
            $DetalleKardex->user_id = $request->nIdUser;
            $DetalleKardex->cliente_id =  $datclient;
            $DetalleKardex->save();

            if ($DetalleKardexcount == 0) {
                $kardex->producto_id  =  $request->nIdProduct;
                $kardex->stock  =  $request->cCantidad;
                $kardex->costunit = $request->cCostUnit;
                $kardex->diferencia = NULL;

                $kardex->save();
            } else {
                $kardex->producto_id  =  $request->nIdProduct;
                $kardex->stock  =   $stockTotal + $request->cCantidad;
                $kardex->costunit = $DetalleKardex->costunit;
                $kardex->diferencia = NULL;
                $kardex->save();
            };
            return response()->json(['message' => 'Registro exitoso', 'icon' => 'success', 'stock' =>  $kardex->stock], 200);
        };

        if ($request->nIdMovimiento == 2) {

            if ($stockTotal <  $request->cCantidad) {
                return response()->json(['message' => 'El stock actual es' . $stockTotal, 'icon' => 'error'], 200);
            } else {
                $DetalleKardex = new DetalleKardex;
                $DetalleKardex->kardex_id =  $request->nidKardex;
                $DetalleKardex->fecha =  $date;
                $DetalleKardex->FactNo =  mb_strtoupper($request->cFacturaNro);
                $DetalleKardex->GuiaNo =  mb_strtoupper($request->cNroGuia);

                if($request->nIdMotivo == 4){
                    $datprov = '19';
                    $datclient= '1';
                }else{
                    $datprov = $request->nIdProveedor;
                    $datclient =  $request->nICliente;
                }
                $DetalleKardex->proveedor_id = $datprov;
                $DetalleKardex->motivo_id = $request->nIdMotivo;
                $DetalleKardex->unidmedida_id = $request->nIdUnidMed;
                $DetalleKardex->cantidad = $request->cCantidad;
                $DetalleKardex->costunit = $request->cCostUnit;
                $DetalleKardex->movimiento_id = $request->nIdMovimiento;
                $DetalleKardex->user_id = $request->nIdUser;
                $DetalleKardex->cliente_id =  $datclient;
                $DetalleKardex->save();

                if ($DetalleKardexcount == 0) {
                    $kardex->producto_id  =  $request->nIdProduct;
                    $kardex->stock  =  $request->cCantidad;
                    $kardex->costunit = $request->cCostUnit;
                    $kardex->diferencia = NULL;

                    $kardex->save();
                } else {
                    $kardex->producto_id  =  $request->nIdProduct;
                    $kardex->stock  =   $stockTotal - $request->cCantidad;
                    $kardex->costunit = $kardex->costunit;
                    $kardex->diferencia = NULL;
                    $kardex->save();
                };
                return response()->json(['message' => 'Registro exitoso', 'icon' => 'success', 'stock' =>  $kardex->stock], 200);
            }
        }
    }

    public function listKardexById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nidKardex = $request->nidKardex;
        $nidKardex = ($nidKardex == NULL) ? ($nidKardex = '') : $nidKardex;
        $dato = Kardex::with(['producto', 'producto.marca', 'producto.familia', 'producto.subfamilia', 'producto.modelotipo', 'producto.material'])
            ->where('id', $request->nidKardex)->first();
        return $dato;
    }

    public function listMotivo(Request $request)
    {

        $dato = Motivo::where('movimiento_id' , $request->idMovimiento)->get();
        return $dato;
    }
    public function listMovimiento()
    {
        $dato = Movimiento::all();
        return $dato;
    }

    public function listProveedor()
    {
        $dato = Proveedor::all();
        return $dato;
    }

    public function listUnidMed()
    {
        $dato = UnidMedida::all();
        return $dato;
    }



    public function KardexReporteData(Request $request)
    {


        if (!$request->ajax()) return redirect('/');

        $nIdKardex = $request->nidKardex;
        $nIdKardex = ($nIdKardex == NULL) ? ($nIdKardex = '') : $nIdKardex;
        $rpta = DB::select(
            'call sp_Reporte_MovimientoxProducto (?)',
            [
                $nIdKardex
            ]
        );

        $this->arraySaldoCantidad = [];
        $this->arraySaldoTotal = [];
        $this->arrayCuTotal = [];



        collect($rpta)->each(function ($item, $index) {
            if ($index == 0) {
                $this->arraySaldoCantidad[$index] = $item->cantidading;
                $this->arraySaldoTotal[$index] = floatval($item->costo_total_ingreso);
                $this->arrayCuTotal[$index] = round($this->arraySaldoTotal[$index] / $this->arraySaldoCantidad[$index], 2);
            } else {
                $this->arraySaldoCantidad[$index] = $this->arraySaldoCantidad[$index - 1] + $item->cantidading - $item->cantidadsali;
                $this->arraySaldoTotal[$index] =  $this->arraySaldoTotal[$index - 1] +  floatval($item->costo_total_ingreso) - $item->costo_total_salida;
                $this->arrayCuTotal[$index] = round($this->arraySaldoTotal[$index] / $this->arraySaldoCantidad[$index], 2);
            }
        });

        $result = collect($rpta)
            ->map(function ($item, $index) {
                $item->saldo_cantidad = $this->arraySaldoCantidad[$index];
                $item->saldo_total = $this->arraySaldoTotal[$index];
                $item->promedio = round($this->arraySaldoTotal[$index] / $this->arraySaldoCantidad[$index], 2);
                $item->arrayCuTotal = $this->arrayCuTotal[$index];
                return $item;
            })
            ->map(function ($item, $index) {
                $item->stock_cantidad = collect($this->arraySaldoCantidad)->last();
                $item->saldo_cantidadlast = collect($this->arrayCuTotal)->last();
                return $item;
            });


        return $result;
    }

    public function getListarXKardex(Request $request)
    {
        $dato = DetalleKardex::with('proveedor', 'motivo', 'unidmedida', 'movimiento','cliente')->where('kardex_id', '=', $request->nidKardex)->get();
        return $dato;
    }

    public function getListarEditXKardex(Request $request)
    {
        $dato = DetalleKardex::with('proveedor', 'motivo', 'unidmedida', 'movimiento')->where('id', '=', $request->nidDetKardex)->get();
        return $dato;
    }


    public function edit(Request $request)
    {
        $nidDetKardex = $request->nidDetKardex;
        $detalleKardex = DetalleKardex::where('id', $nidDetKardex)->first();
        if ($detalleKardex) {
            $detalleKardex->fecha =  $detalleKardex->fecha;
            $detalleKardex->FactNo =  mb_strtoupper($request->cFacturaNro);
            $detalleKardex->GuiaNo =  mb_strtoupper($request->cNroGuia);

            if($request->nIdMotivo == 4){
                $datprov = '19';
                $datclient= '1';
            }else{
                $datprov = $request->nIdProveedor;
                $datclient =  $request->nICliente;
            }
            $detalleKardex->proveedor_id =  $datprov;
            $detalleKardex->motivo_id = $request->nIdMotivo;
            $detalleKardex->unidmedida_id = $request->nIdUnidMed;
            $detalleKardex->cantidad = $request->cCantidad;
            $detalleKardex->costunit = $request->cCostUnit;
            $detalleKardex->movimiento_id = $request->nIdMovimiento;
            $detalleKardex->user_id =   $detalleKardex->user_id;

            $detalleKardex->cliente_id =  $datclient;
            $detalleKardex->save();
        }

    }
}
