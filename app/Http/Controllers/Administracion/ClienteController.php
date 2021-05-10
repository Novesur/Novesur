<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cliente;
use App\Cotizacion;

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

        $cons = Cliente::where('ruc', '=', $request->cRuc)->exists();

        if ($cons) {
            return response()->json(['message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);
        }else{

            $cliente = new Cliente;
            $cliente->razonsocial = mb_strtoupper($request->cRSocial);
            $cliente->direccion = mb_strtoupper($request->cDireccion);
            $cliente->ruc = $request->cRuc;
            $cliente->atencion = mb_strtoupper($request->cAtencion);
            $cliente->telefono = $request->cTelefono;
            $cliente->celular = $request->cCelular;
            $cliente->email = $request->cEmail;
            $cliente->usuario_id = $request->nIdUser;
            $cliente->save();
            return response()->json(['message' => 'Nuevo Cliente agregado', 'icon' => 'success'], 200);

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cNombre = $request->cNombre;
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $dato = Cliente::where('razonsocial', 'like', '%' . $cNombre . '%')
        ->where('usuario_id', $request->nIdUser)
        ->orWhere('ruc',$request->cRuc)->get();
        return $dato;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listPermisosById(Request $request)
    {

        $dato = Cliente::where('id', $request->nIdCliente  )
        ->orWhere('ruc',$request->cRuc)->first();
        return $dato;
    }

    public function listGetClienteVendedor(Request $request)
    {

      $dato = Cotizacion::with('cliente','user')->where('id',$request->nIdCotizacion)->first();
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
        $cliente = Cliente::where('id', $request->nIdCliente)->first();
        if ($cliente) {
            $cliente->razonsocial = mb_strtoupper($request->cRSocial);
            $cliente->direccion = mb_strtoupper($request->cDireccion);
            $cliente->ruc = $request->cRuc;
            $cliente->atencion = mb_strtoupper($request->cAtencion);
            $cliente->telefono = $request->cTelefono;
            $cliente->celular = $request->cCelular;
            $cliente->email = $request->cEmail;
            $cliente->usuario_id = $cliente->usuario_id;
            $cliente->save();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getListarCliente(Request $request)
    {
        $dato = Cliente::where('usuario_id', $request->nIdVendedor)->get();
        return $dato;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
