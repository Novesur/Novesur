<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Articulo;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->cNombre == null && $request->nidTipo == null && $request->nidcatArt == null) {

            $dato = Articulo::with('tipo', 'catarticulo', 'file')->get();
        } else {
            $dato = Articulo::with('tipo', 'catarticulo', 'file')
                ->orWhere('nombre', $request->cNombre)
                ->orWhere('tipo_id', $request->nidTipo)
                ->orWhere('catarticulo_id', $request->nidcatArt)->get();
        }
        return $dato;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $oFotografia    =   $request->nidfile;
        $oFotografia    =   ($oFotografia   ==  NULL) ? ($oFotografia   =   NULL) :   $oFotografia;

        $articulo = new Articulo();
        $articulo->nombre = mb_strtoupper($request->cNombre);
        $articulo->tipo_id = $request->nidTipo;
        $articulo->file_id = $oFotografia;
        $articulo->catarticulo_id = $request->nidcatArt;
        $articulo->descripcion = mb_strtoupper($request->cDescripcion);
        $articulo->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listArticulosById(Request $request)
    {
        $dato = Articulo::with('tipo', 'catarticulo', 'file')->where('id',$request->nIDArticulo)->first();
        return $dato;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
