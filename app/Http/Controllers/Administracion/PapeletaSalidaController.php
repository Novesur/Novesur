<?php

namespace App\Http\Controllers\Administracion;

use App\Cliente;
use App\ClientsPapeletaSalida;
use App\Detallepapeletasalida;
use App\Exports\PapeletaExport;
use App\Http\Controllers\Controller;
use App\Motivopapeletasalida;
use App\Papeletasalida;
use App\TempClientPapeletaSalida;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use PDF;

class PapeletaSalidaController extends Controller
{
    public function Motivo()
    {
        $motivo = Motivopapeletasalida::all();
        return $motivo;
    }

    public function create(Request $request)
    {
        $fecha = date("Y-m-d");

        $fechaValida = $fecha >= now()->toDateString();

        date_default_timezone_set('America/Lima');
        $now = Carbon::now();
        $tiempoMin = Carbon::createFromTime(8, 30);
        $tiempoMax = Carbon::createFromTime(20, 00);


        //Validamos que la Hora de ingreso de 8:30 am hasta las 8 PM
        if ($fechaValida && $now >= $tiempoMin   &&  $now  <= $tiempoMax) {

            $PapeletaSalida = new Papeletasalida;
            $PapeletaSalida->user_id = $request->nIdUser;
            $PapeletaSalida->fecha = Carbon::parse($request->cfecha)->format('Y-m-d');
            $PapeletaSalida->horasalida = substr($request->tHoraSalida, 0, 8);
            $PapeletaSalida->horaretorno = substr($request->tHoraRetorno, 0, 8);
            $PapeletaSalida->motivopapeletasalida_id = $request->nIdMotivo;
            $PapeletaSalida->estadopapeletasalida_id = '1';
            $PapeletaSalida->fundamento = nl2br(htmlentities(mb_strtoupper($request->cReferencia)));
            $PapeletaSalida->hora_emision = $request->hora;
            $PapeletaSalida->save();

            //Si motivo es compras /  Si motivo es Otros /  Si motivo es Personal
            if ($request->nIdMotivo == 1 || $request->nIdMotivo == 5 || $request->nIdMotivo == 4) {

                $clientsPapeletaSalida = new ClientsPapeletaSalida;
                $clientsPapeletaSalida->papeletasalida_id = $PapeletaSalida->id;
                $clientsPapeletaSalida->cliente_id = $request->rpapeleta;
                $clientsPapeletaSalida->contacto = '';
                $clientsPapeletaSalida->direccion = '';
                $clientsPapeletaSalida->save();
                return response()->json(['message' => 'Papeleta de Salida grabado', 'icon' => 'success'], 200);
            }


            //Si motivo es Despacho /  Si motivo es Ventas
            if ($request->nIdMotivo == 2 || $request->nIdMotivo == 3) {
                $clientPapeletaSalida = Session::get('clients');
                $allclients = $clientPapeletaSalida->map(function ($PS) use ($PapeletaSalida) {

                    return [
                        'papeletasalida_id' => $PapeletaSalida->id,
                        'cliente_id'      =>  $PS->id,
                        'contacto' => $PS->contacto,
                        'direccion'   => $PS->direccion,
                    ];
                });

                ClientsPapeletaSalida::insert($allclients->toArray());
                return response()->json(['message' => 'Papeleta de Salida grabado', 'icon' => 'success'], 200);
            }
        }
    }

    public function listPapeleByVendedor(Request $request)
    {

        $dFechainicio = date("Y-m-d", strtotime($request->dFechainicio));
        $dFechafin = date("Y-m-d", strtotime($request->dFechafin));


        if ($request->nIdMotivo == null && $request->dFechafin == null &&  $request->nIdVendedor == null && $request->dFechainicio == null) {
            $dato = Papeletasalida::with('user', 'estadoPapeletaSalida', 'motivopapeletasalida')->get();
            return $dato;

            /*   $dato =  ClientsPapeletaSalida::with('papeletasalida','cliente','papeletasalida.user','papeletasalida.estadoPapeletaSalida', 'papeletasalida.motivopapeletasalida')
            ->has('papeletasalida')->get(); */
            return $dato;
        }
        if ($request->nIdMotivo == null &&  $request->nIdVendedor == null) {
            $dato = Papeletasalida::with('user', 'estadoPapeletaSalida', 'motivopapeletasalida')->whereBetween('fecha', [$dFechainicio, $dFechafin])->get();
            return $dato;
        }
        if ($request->nIdMotivo == null) {
            $dato = Papeletasalida::with('user', 'estadoPapeletaSalida', 'motivopapeletasalida')->where('user_id', $request->nIdVendedor)->whereBetween('fecha', [$dFechainicio, $dFechafin])->get();
            return $dato;
        }

        if ($request->dFechainicio == null && $request->dFechafin == null) {
            $dato = Papeletasalida::with('user', 'estadoPapeletaSalida', 'motivopapeletasalida')->where('user_id', $request->nIdVendedor)->where('motivopapeletasalida_id', $request->nIdMotivo)->get();
            return $dato;
        }
    }

    public function listPapeleByCliente(Request $request)
    {
        $dato = ClientsPapeletaSalida::with('papeletasalida', 'papeletasalida.user')->where('cliente_id', $request->nIdClient)->get();
        return $dato;
    }

    public function ListMotivos()
    {
        $dato = Motivopapeletasalida::all();
        return $dato;
    }

    public function ListPapeletaSalidabyId(Request $request)
    {

        $dato = Papeletasalida::where('id', $request->item)->first();
        return $dato;
    }

    public function PapeletasalidaPdf(Request $request)
    {
        $idPapeletaS = $request->get("params")['item'];
        $Papeletasalida = Papeletasalida::with('user', 'motivopapeletasalida', 'estadoPapeletaSalida')->where('id', $idPapeletaS)->first();
        $clientpapeletasalida = ClientsPapeletaSalida::with('cliente', 'papeletasalida')->where('papeletasalida_id', $idPapeletaS)->get();
        $logo = asset('img/logo.gif');
        $productos01 = asset('img/banner01.png');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.papeletaSalida.reporte', [
            'logo' => $logo,
            'productos01' => $productos01,
            'Papeletasalida' => $Papeletasalida,
            'clientpapeletasalida' => $clientpapeletasalida,
        ]);
        return $pdf->download('invoice.pdf');
    }

    public function setDarBajaPapeletaSalida(Request $request)
    {

        $papeletaS = Papeletasalida::find($request->item);
        $papeletaS->delete();
    }

    public function setAprobarPapeletaSalida(Request $request)
    {
        Papeletasalida::where('id', $request->item)->update(['estadopapeletasalida_id' => '2']);
    }

    public function getListarCliente(Request $request)
    {
        $dato = Cliente::where('usuario_id', $request->nIdVendedor)->orWhere('usuario_id', 1)->get();
        return $dato;
    }

    public function AddTempClient(Request $request)
    {

        $client = Cliente::where(['ruc' => $request->nIdRuc])->first();
        $clients = Session::get('clients');
        $clients = ($clients != null) ? collect($clients) : collect([]);
        $TempClientPapeletaSalida = new TempClientPapeletaSalida();
        $TempClientPapeletaSalida->fill(['direccion' => $request->cDireccion,  'id' => $client->id, 'razonsocial' => $client->razonsocial, 'contacto' => $request->cContacto]);
        $clients->push($TempClientPapeletaSalida);
        Session::put('clients', $clients);
        return response()->json(['datos' => $clients, 'message' => NULL]);
    }

    public function CleanTempClient()
    {
        Session::put('clients', null);
        $dato = session()->get('clients') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function EliminarClientTemp(Request $request)
    {
        $id = (int)trim($request->id);
        $items = session()->get('clients') ?? collect([]);
        $exits = $items->firstWhere("id", $id);
        if (!empty($exits)) :
            $items =  $items->whereNotIn("id", [$id]);
            session()->put('clients', $items);
            return response()->json(['datos' => $items]);
        endif;
        return response()->json(['message' => 'El item no existe'], 422);
    }

    public function export(Request $request)
    {
        $fecha1 =  date("Y-m-d", strtotime($request->dFechainicio));
        $fecha2 =  date("Y-m-d", strtotime($request->dFechafin));

        /*  $fecha1 = $request->dFechainicio;
        $fecha2 = $request->dFechafin; */
        $vendedor = $request->nIdVendedor;

        /*         $papeletasalida = Papeletasalida::with('user','motivopapeletasalida')->whereBetween('fecha', [$fecha1 , $fecha2] )->where('estadopapeletasalida_id',3)->get();
        */

        if ($request->nIdMotivo == Null && $request->nIdVendedor == Null) {
            $dato = ClientsPapeletaSalida::with('papeletasalida', 'cliente', 'papeletasalida.user', 'papeletasalida.motivopapeletasalida')
                ->whereHas('papeletasalida', function (Builder $query) use ($fecha1, $fecha2) {
                    $query->whereBetween('fecha', [$fecha1, $fecha2])->where('estadopapeletasalida_id', 2);
                })->get();


            return (new PapeletaExport)->setGenerarExcel($dato)->download('invoices.xlsx');
        }

        if ($request->nIdMotivo == Null) {
            $dato = ClientsPapeletaSalida::with('papeletasalida', 'cliente', 'papeletasalida.user', 'papeletasalida.motivopapeletasalida')
                ->whereHas('papeletasalida', function (Builder $query) use ($fecha1, $fecha2, $vendedor) {
                    $query->whereBetween('fecha', [$fecha1, $fecha2])->where('estadopapeletasalida_id', 3)->where('user_id', $vendedor);
                })->get();
            return (new PapeletaExport)->setGenerarExcel($dato)->download('invoices.xlsx');
        }
    }

    public function ObservacionUpdate(Request $request)
    {

        if ($request->valormotivo != null) {
            $papeletasalida = Papeletasalida::find($request->idpapeleta);
            if ($papeletasalida) {
                $papeletasalida->observacion = mb_strtoupper($request->valormotivo);
                $papeletasalida->save();
            }
        }
    }

    public function getlistClientxIndex(Request $request)
    {
        $dato = ClientsPapeletaSalida::with('cliente')->where('papeletasalida_id', $request->papeletaId)->get();
        return $dato;
    }
}
