<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\ProveedorExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Proveedor;

class ProveedorController extends Controller
{

    public function index(Request $request)
    {

        if ($request->cNombre) {
            $dato = Proveedor::where('nombre', 'like', '%' . $request->cNombre . '%')->get();
            return $dato;
        }

        if ($request->cRuc) {
            $dato = Proveedor::where('ruc', '=', $request->cRuc)->get();
            return $dato;
        }

        if (empty($request->cRuc) && empty($request->cNombre)) {
            $dato = Proveedor::all();
            return $dato;
        }
    }

    public function create(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cons = Proveedor::where('ruc', '=', $request->cRuc)->exists();

        if ($cons) {
            return response()->json(['message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);
        }else{

            $proveedor = new Proveedor;
            //dd($request->all());
            $proveedor->nombre = mb_strtoupper($request->cNombre);
            $proveedor->ruc = $request->cRuc;
            $proveedor->direccion = mb_strtoupper($request->cDireccion);
            $proveedor->telefono = $request->cTelefono;
            $proveedor->email = $request->cEmail;
            $proveedor->contacto = mb_strtoupper($request->cContacto);
            $proveedor->nrocuenta1 = mb_strtoupper($request->cCuentaNro1);
            $proveedor->nrocuenta2 = mb_strtoupper($request->cCuentaNro2);
            $proveedor->nrocuenta3 = mb_strtoupper($request->cCuentaNro3);
            $proveedor->save();
            return response()->json(['message' => 'Nuevo Proveedor grabado', 'icon' => 'success'], 200);
        }




    }

    public function ListarProveedorById(Request $request)
    {
        $dato = Proveedor::where('id', '=', $request->nIdProveedor)->first();
        return $dato;
    }

    public function edit(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdProveedor = $request->nIdProveedor;
        $proveedor = Proveedor::where('id', $nIdProveedor)->first();
        if ($proveedor) {
            $proveedor->nombre = $request->cNombre;
            $proveedor->ruc = $request->cRuc;
            $proveedor->direccion = $request->cDireccion;
            $proveedor->telefono = $request->cTelefono;
            $proveedor->email = $request->cEmail;
            $proveedor->contacto = $request->cContacto;
            $proveedor->nrocuenta1 = mb_strtoupper($request->cCuentaNro1);
            $proveedor->nrocuenta2 = mb_strtoupper($request->cCuentaNro2);
            $proveedor->nrocuenta3 = mb_strtoupper($request->cCuentaNro3);
            $proveedor->save();
        }
    }

    public function ListarProveedorByRuc(Request $request)
    {

        if (!$request->cRuc) {
            $dato = Proveedor::all();

        }else{
            $dato = Proveedor::where('ruc', '=', $request->cRuc)->get();
        }



        return $dato;
    }

    public function ListProveedor(){
        $dato = Proveedor::orderBy('nombre','ASC')->get();
        return $dato;
    }

    public function export(Request $request)
    {

        $listProveedor = json_decode($request->params['listProveedor']);
        return (new ProveedorExport)->setGenerarExcel($listProveedor)->download('invoices.xlsx');
    }

}
