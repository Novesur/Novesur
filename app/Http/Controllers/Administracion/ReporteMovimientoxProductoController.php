<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteMovimientoxProductoController extends Controller
{
    public function MovimientoxPedido(Request $request){

        if (!$request->ajax()) return redirect('/');
        $nIdKardex = $request->nIdKardex;
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


        collect($rpta)->each(function($item, $index){
           if ($index == 0){
            $this->arraySaldoCantidad[$index] = $item->cantidading;
            $this->arraySaldoTotal[$index] = floatval($item->costo_total_ingreso);
            $this->arrayCuTotal[$index] = round ($this->arraySaldoTotal[$index] /$this->arraySaldoCantidad[$index],2);
           //$this->arrayCuTotal[$index] = 20;
           } else {
            $this->arraySaldoCantidad[$index] = $this->arraySaldoCantidad[$index - 1] + $item->cantidading - $item->cantidadsali;
            $this->arraySaldoTotal[$index] =  $this->arraySaldoTotal[$index-1]+  floatval($item->costo_total_ingreso)- $item->costo_total_salida;
            $this->arrayCuTotal[$index] = round ( $this->arraySaldoTotal[$index] /$this->arraySaldoCantidad[$index],2);

        }
        });

        $result = collect($rpta)
                    ->map(function($item, $index){
                        $item->saldo_cantidad = $this->arraySaldoCantidad[$index];
                        $item->saldo_total =round ( $this->arraySaldoTotal[$index],2);
                        $item->promedio = round ($this->arraySaldoTotal[$index] / $this->arraySaldoCantidad[$index], 2);
                        //$item->promedio = 20;
                        $item->arrayCuTotal = $this->arrayCuTotal[$index] ;
                        return $item;
                    })
                    ->map(function($item, $index){
                        $item->stock_cantidad = collect($this->arraySaldoCantidad)->last();
                        return $item;
                    });

        return $result;
    }
}
