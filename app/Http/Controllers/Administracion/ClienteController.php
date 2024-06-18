<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cliente;
use App\Cotizacion;
use App\User;
use App\Exports\ClientExport;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if (strlen($request->cRuc) == 11 || strlen($request->cRuc) == 8) {

            $cons = Cliente::where('ruc', '=', $request->cRuc)->exists();

            if ($cons) {
                return response()->json(['message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);
            } else {

                $cliente = new Cliente;
                $cliente->razonsocial = mb_strtoupper($request->cRSocial);
                $cliente->direccion = mb_strtoupper($request->cDireccion);
                $cliente->ruc = $request->cRuc;
                $cliente->atencion = mb_strtoupper($request->cAtencion);
                $cliente->telefono = $request->cTelefono;
                $cliente->celular = $request->cCelular;
                $cliente->email = $request->cEmail;
                $cliente->usuario_id = $request->nIdUser;
                $cliente->tipoPrecio = $request->ctipoPrecio;
                $cliente->save();
                return response()->json(['message' => 'Nuevo Cliente agregado', 'icon' => 'success'], 200);
            }
        } else {
            return response()->json(['message' => 'Numeros de caracteres en el ruc incorrectos', 'icon' => 'error'], 200);
        }
    }

    public function store(Request $request)
    {


        $roluser = User::where('id', $request->nIdUser)->first();


        if ($roluser->roles_id === 1 || $roluser->roles_id === 4 ||  $roluser->roles_id === 9 ||  $roluser->roles_id == 5) {
            if ($request->cNombre == null and $request->cRuc == null and $request->nIdVendedor == null) {
                $dato = Cliente::with('user')->get();
                return $dato;
            }
            if ($request->cNombre == null) {
                $dato = Cliente::with('user')->where('ruc', $request->cRuc)->get();
            }
            if ($request->cRuc == null) {
                $dato = Cliente::with('user')->where('razonsocial', 'like', '%' . $request->cNombre . '%')->get();
            }

            if ($request->cNombre == null && $request->cRuc == null) {
                $dato = Cliente::with('user')->where('usuario_id',  $request->nIdVendedor)->get();
            }
        } else {

            if ($request->cNombre == null and $request->cRuc == null  && $request->nIdVendedor == null) {
                $dato = Cliente::with('user')->where('usuario_id', $request->nIdUser)->get();
            }
            if ($request->cNombre == null) {
                $dato = Cliente::with('user')->where('ruc', $request->cRuc)->where('usuario_id', $request->nIdUser)->get();
            }
            if ($request->cRuc == null) {
                $dato = Cliente::with('user')->where('razonsocial', 'like', '%' . $request->cNombre . '%')->where('usuario_id', $request->nIdUser)->get();
            }
        }

        return $dato;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listClientesById(Request $request)
    {

        $dato = Cliente::with('user')->where('id', $request->nIdCliente)
            ->orWhere('ruc', $request->cRuc)->first();
        return $dato;
    }

    public function listGetClienteVendedor(Request $request)
    {

        $dato = Cotizacion::with('cliente', 'user')->where('codigo', $request->ncodCotizacion)->first();
        return $dato;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)

    {


        if (strlen($request->cRuc) == 11 || strlen($request->cRuc) == 8) {
            $cliente = Cliente::where('id', $request->nIdCliente)->first();
            if ($cliente) {
                $cliente->razonsocial = mb_strtoupper($request->cRSocial);
                $cliente->direccion = mb_strtoupper($request->cDireccion);
                $cliente->ruc = $request->cRuc;
                $cliente->atencion = mb_strtoupper($request->cAtencion);
                $cliente->telefono = $request->cTelefono;
                $cliente->celular = $request->cCelular;
                //$cliente->email = $request->cEmail;
                $cliente->email = $cliente->email;
                $cliente->usuario_id = $cliente->usuario_id;
                $cliente->tipoPrecio = $request->ctipoPrecio;
                $cliente->save();
                return response()->json(['message' => 'Se edito correctamente', 'icon' => 'success'], 200);
            }
        } else {
            return response()->json(['message' => 'Numeros de caracteres en el ruc incorrectos', 'icon' => 'error'], 200);
        }
    }

    public function getListarCliente(Request $request)
    {
        $dato = Cliente::where('usuario_id', $request->nIdVendedor)->get();
        return $dato;
    }

    public function getListarAllCliente()
    {
        $dato = Cliente::all();
        return $dato;
    }

    public function export(Request $request)
    {
        // dd($request->params['listProductos']);
        $listCliente = json_decode($request->params['listCliente']);
        return (new ClientExport)->setGenerarExcel($listCliente)->download('invoices.xlsx');
    }

    public function listClientAll(Request $request)
    {

        if ($request->cNombre == null) {

            if (strlen($request->cRuc) == 11 || strlen($request->cRuc) == 8) {
                $dato = Cliente::with('user')->where('ruc', $request->cRuc)->get();
            } else {
                return response()->json(['message' => 'Numeros de caracteres en el ruc incorrectos', 'icon' => 'error'], 200);
            }
        }

        if ($request->cRuc == null) {
            $dato = Cliente::with('user')->where('razonsocial', 'like', '%' . $request->cNombre . '%')->get();
        }

        return $dato;
    }

    public function consultaRuc(Request $request)
    {
        /*    $api1 = 'https://dniruc.apisperu.com/api/v1/ruc/';
        $api2 = $request->cRuc;
        $api3 = '?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvcmdlYW50b25pbzE2QGdtYWlsLmNvbSJ9.kbXXdK2xjatEd8UbHTNfnTc1-XiYqzxghdlH4HiSjGk';
        $ruta = $api1.$api2.$api3;
        $Ruc = Http::get($ruta) ;
        $dato  = $Ruc->json();
        return $dato; */

       // https://api.apis.net.pe/v2/sunat/ruc/full?numero=20601030013&token=apis-token-8934.8jfJDAUvY-rcpH-ohHBWb3BXkI91cFFB
        $Ruc = $request->cRuc;
        $token = 'apis-token-8934.8jfJDAUvY-rcpH-ohHBWb3BXkI91cFFB';

        $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);

        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Referer' => 'https://apis.net.pe/api-consulta-ruc',
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $Ruc]
        ];
        $res = $client->request('GET', '/v2/sunat/ruc', $parameters);
        $dato = json_decode($res->getBody()->getContents(), true);
        return $dato;
    }

    public function consultaDNI(Request $request)
    {
       // https://api.apis.net.pe/v2/reniec/dni?numero=46027897&token=apis-token-8934.8jfJDAUvY-rcpH-ohHBWb3BXkI91cFFB

        $api1 = 'https://api.apis.net.pe/v2/reniec/dni?numero=';
        $api2 = $request->cRuc.'&';
        $api3 = 'token=apis-token-8934.8jfJDAUvY-rcpH-ohHBWb3BXkI91cFFB';
        $ruta = $api1.$api2.$api3;
        $Ruc = Http::get($ruta) ;
        $dato  = $Ruc->json();
       return $dato;


    }

    public function UpdateClientVendedor(Request $request)
    {
        $cliente = Cliente::find($request->idClient);
        if ($cliente) {
            $cliente->usuario_id = $request->nIdVendedorfuture;
            $cliente->save();
            return response()->json(['message' => 'Cliente con usuario Actualizado', 'icon' => 'success'], 200);
        }
    }

    public function listClientesByIdCoti(Request $request)
    {

        $dato = Cotizacion::with('cliente', 'user')->where('id', $request->nIdCotizacion)->first();
        return $dato;
    }

    public function listDataCliente(Request $request)
    {
        $dato = Cliente::with('user')->where('id', $request->nIdCliente)->first();
        return $dato;
    }

    public function BuscaRucBD(Request $request)
    {

        $dato = Cliente::where('ruc', $request->nIdRuc)->first();
        return $dato;
    }
}
