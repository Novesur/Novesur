<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td>  <img src="{{$logo}}" alt="" alt="" style=" width: 200px; height: 70px; padding-left: 25px"/></td>

  </tr>
  <tr>
    <td align="center" style="font-size: 14px"><strong>REQUERIMIENTOS MATERIALES Nr° {{$RequerimientosMateriales->codigo}}</strong></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="25%" style="font-size: 14px"><strong>MES/AÑO/FECHA :</strong></td>
    <td colspan="3" style="font-size: 12px">  {{date('d-m-Y', strtotime($RequerimientosMateriales->fecha))}}</td>
  </tr>

  <tr>
    <td><strong style="font-size: 14px">CODIGO PRODUCTO :</strong></td>
    <td colspan="3" style="font-size: 12px">{{$RequerimientosMateriales->producto->codigo}}</td>
  </tr>
  <tr>
    <td><strong style="font-size: 14px">PRODUCTO :</strong></td>
    <td colspan="3" style="font-size: 12px">{{$RequerimientosMateriales->producto->familia->nombre .' '. $RequerimientosMateriales->producto->subfamilia->nombre .', MODELO '. $RequerimientosMateriales->producto->modelotipo->nombre .', MATERIAL '. $RequerimientosMateriales->producto->material->nombre .', MARCA '. $RequerimientosMateriales->producto->marca->nombre.', - '. $RequerimientosMateriales->producto->homologacion->nombre}}</td>
  </tr>
  <tr>
    <td><strong style="font-size: 14px">CANTIDAD :</strong></td>
    <td colspan="3" style="font-size: 12px">{{$RequerimientosMateriales->cantidad}}</td>
  </tr style="font-size: 12px">
  @if ($RequerimientosMateriales->cliente->razonsocial == 'NINGUNO')
  <tr>
    <td><strong style="font-size: 14px">ALMACEN:</strong></td>
    <td colspan="3"style="font-size: 12px">{{$RequerimientosMateriales->almacen->nombre}}</td>
  </tr>
  @else
  <tr>
    <td><strong style="font-size: 14px">CLIENTE-REF :</strong></td>
    <td colspan="3" style="font-size: 12px">{{$RequerimientosMateriales->cliente->razonsocial}}</td>
  </tr>
  @endif

  <tr>
    <td><strong style="font-size: 14px">FECHA INICIO :</strong></td>
    <td width="31%" style="font-size: 12px">{{date('d-m-Y', strtotime($RequerimientosMateriales->fechainicio))}}</td>
    <td width="23%" style="font-size: 12px"><strong>FECHA FINAL :</strong></td>
    <td width="30%" style="font-size: 12px"> {{date('d-m-Y', strtotime($RequerimientosMateriales->fechafinal))}}</td>
  </tr>
  <tr>
    <td><strong style="font-size: 14px">DURACION :</strong></td>
    <td colspan="3" style="font-size: 12px">{{$RequerimientosMateriales->duracion}}</td>
  </tr>
  <tr>
    <td><strong style="font-size: 14px">REFERENCIA :</strong></td>
    <td colspan="3" style="font-size: 12px">{{$RequerimientosMateriales->referencia}}</td>
  </tr>
  <tr>
    <td><strong style="font-size: 14px">ZONA DE PRODUCCION :</strong></td>
    <td colspan="3" style="font-size: 12px">{{mb_strtoupper($RequerimientosMateriales->zona_produccion->nombre)}}</td>
  </tr>
</table>
<table width="100%" border="1">
    <tr>
      <td colspan="4" align="center" bgcolor="#33CCFF"><strong></strong><strong>REQUERIMIENTO MATERIALES</strong></td>
    </tr>
  <tr>
    <td width="16%" align="center" bgcolor="#CCCCCC" style="font-size: 14px"><strong>ITEM</strong></td>
    <td width="58%" align="center" bgcolor="#CCCCCC" style="font-size: 14px"><strong>DESCRIPCION</strong></td>
    <td width="12%" align="center" bgcolor="#CCCCCC" style="font-size: 14px"><strong>U.M</strong></td>
    <td width="14%" align="center" bgcolor="#CCCCCC" style="font-size: 14px"><strong>CANTIDAD</strong></td>
  </tr>
  @if($MaterialReqMateriales) @foreach ($MaterialReqMateriales as $data)
  <tr>
    <td align="center" style="font-size: 12px">{{$data->producto->codigo}}</td>
    <td align="center" style="font-size: 12px">{{$data->producto->familia->nombre .', MARCA '. $data->producto->marca->nombre .' '. $data->producto->subfamilia->nombre .', MODELO/TIPO '. $data->producto->modelotipo->nombre .', MATERIAL '. $data->producto->material->nombre.' '. $data->producto->homologacion->nombre }}</td>
    <td align="center" style="font-size: 12px">{{$data->unidmedida->nombre }}</td>
    <td align="center" style="font-size: 12px">{{$data->cantidad}}</td>
  </tr>
  @endforeach @endif
</table>
<table width="100%" border="1">
  <tr>
    <td width="74%" align="center" bgcolor="#33CCFF" style="font-size: 14px"><strong>REQUERIMIENTO MANO DE OBRA (DIAS, HORAS, HOMBRE)</strong></td>
    <td width="12%" align="center" bgcolor="#33CCFF" style="font-size: 14px"><strong>HORAS</strong></td>
    <td width="14%" align="center" bgcolor="#33CCFF" style="font-size: 14px"><strong>DIAS</strong></td>
  </tr>
  @if($ManoObraReqmateriales) @foreach ($ManoObraReqmateriales as $datamaterial)
  <tr>
    <td align="center" style="font-size: 12px">{{$datamaterial->personal}}</td>
    <td align="center" style="font-size: 12px">{{$datamaterial->horas}}</td>
    <td align="center" style="font-size: 12px">{{$datamaterial->dias}}</td>
  </tr>
  @endforeach @endif
</table>
<table width="100%" border="1">
    <tr>
      <td width="51%" align="center" bgcolor="#33CCFF" style="font-size: 12px"><strong>OTROS REQUERIMIENTOS</strong></td>
      <td width="49%" align="center" bgcolor="#33CCFF" style="font-size: 12px"><strong>DESCRIPCION</strong></td>
    </tr>
    @if($OtrosRequerimientosReqMateriales) @foreach ($OtrosRequerimientosReqMateriales as $dataRque)
    <tr>
      <td align="center" style="font-size: 12px">{{$dataRque->descripcion}}</td>
      <td align="center" style="font-size: 12px">{{$dataRque->cantidad}}</td>
    </tr>
    @endforeach @endif
  </table>
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" style="font-size: 14px"><strong>V-B RESPONSABLE PRODUCCION</strong></td>
  </tr>
</table>
<p>&nbsp;</p>
<p><br />
</p>
</body>
</html>
