<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\ProveedorExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Proveedor;
use App\TipoCompra;

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
            $dato = Proveedor::where('tipo_ordencompra_id', $request->nIdtipoCompra)->get();
            return $dato;
        }

        if (empty($request->cRuc) && empty($request->cNombre) && $request->nIdtipoCompra) {
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
            if($request->nIdtipoCompra == 1){
                $proveedor->nombre = mb_strtoupper($request->cNombreNacional);
                $proveedor->ruc = $request->cRuc;
            }else{
                $proveedor->nombre = mb_strtoupper($request->cNombreImportado);
                $proveedor->ruc = $request->cCodigo;
            }
            $proveedor->direccion = mb_strtoupper($request->cDireccion);
            $proveedor->telefono = $request->cTelefono;
            $proveedor->email = $request->cEmail;
            $proveedor->contacto = mb_strtoupper($request->cContacto);
            $proveedor->nrocuenta1 = mb_strtoupper($request->cCuentaNro1);
            $proveedor->nrocuenta2 = mb_strtoupper($request->cCuentaNro2);
            $proveedor->nrocuenta3 = mb_strtoupper($request->cCuentaNro3);
            $proveedor->tipo_ordencompra_id = $request->nIdtipoCompra;
            $proveedor->swift = $request->swift;
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
            if($request->nIdtipoCompra == 1){
                $proveedor->ruc = $request->cRuc;

            }else{
                $proveedor->ruc = $request->cCodigo;
            }

            $proveedor->direccion = $request->cDireccion;
            $proveedor->telefono = $request->cTelefono;
            $proveedor->email = $request->cEmail;
            $proveedor->contacto = $request->cContacto;
            $proveedor->nrocuenta1 = mb_strtoupper($request->cCuentaNro1);
            $proveedor->nrocuenta2 = mb_strtoupper($request->cCuentaNro2);
            $proveedor->nrocuenta3 = mb_strtoupper($request->cCuentaNro3);
            $proveedor->tipo_ordencompra_id = $request->nIdtipoCompra;
            $proveedor->swift = $request->swift;
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

    public function ListTipoCompra(){
        $dato=TipoCompra::all();
        return $dato;
    }

}
