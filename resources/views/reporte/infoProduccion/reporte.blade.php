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
    <td align="center"><strong>INFORME DE PRODUCCION Nr° {{$InfoProduccion->codigo}}</strong></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="25%" style="font-size: 14px"><strong>MES/AÑO/FECHA :</strong></td>
    <td colspan="3" style="font-size: 12px">  {{date('d-m-Y', strtotime($InfoProduccion->fecha))}}</td>
  </tr>
  <tr>
    <td style="font-size: 14px"><strong>COD.REQUERIMIENTO :</strong></td>
    <td colspan="3" style="font-size: 12px">{{$InfoProduccion->requerimiento_materiales->codigo}}</td>
  </tr>
  <tr>
    <td style="font-size: 14px"><strong>COD. PRODUCTO :</strong></td>
    <td colspan="3" style="font-size: 12px">{{$InfoProduccion->producto->codigo}}</td>
  </tr>
  <tr>
    <td style="font-size: 14px"><strong>PRODUCTO :</strong></td>
    <td colspan="3" style="font-size: 12px">{{$InfoProduccion->producto->familia->nombre .' '. $InfoProduccion->producto->subfamilia->nombre .', MODELO '. $InfoProduccion->producto->modelotipo->nombre .', MATERIAL '. $InfoProduccion->producto->material->nombre .', MARCA '. $InfoProduccion->producto->marca->nombre.', - '. $InfoProduccion->producto->homologacion->nombre}}</td>
  </tr>
  <tr>
    <td style="font-size: 14px"><strong>CANTIDAD :</strong></td>
    <td colspan="3" style="font-size: 12px">{{$InfoProduccion->cantidad}}</td>
  </tr>

  <tr>
    <td style="font-size: 14px"><strong>UNID. DE MEDIDA :</strong></td>
    <td colspan="3" style="font-size: 12px">{{$InfoProduccion->unidmedida->nombre}}</td>
  </tr>

  @if ($InfoProduccion->cliente->razonsocial == 'NINGUNO')
  <tr>
    <td style="font-size: 14px"><strong>ALMACEN:</strong></td>
    <td colspan="3" style="font-size: 12px">{{$InfoProduccion->almacen->nombre}}</td>
  </tr>
  @else
  <tr>
    <td style="font-size: 14px"><strong>CLIENTE-REF :</strong></td>
    <td colspan="3" style="font-size: 12px">{{$InfoProduccion->cliente->razonsocial}}</td>
  </tr>
  @endif
  <tr>
    <td style="font-size: 14px"><strong>REFERENCIA:</strong></td>
    <td colspan="3" style="font-size: 12px">{{$InfoProduccion->referencia}}</td>
  </tr>


</table>
<table width="100%" border="1">
    <tr>
      <td colspan="4" align="center" bgcolor="#33CCFF" style="font-size: 14px"><strong></strong><strong>REQUERIMIENTO MATERIALES</strong></td>
    </tr>
  <tr>
    <td width="16%" align="center" bgcolor="#CCCCCC" style="font-size: 14px"><strong>ITEM</strong></td>
    <td width="58%" align="center" bgcolor="#CCCCCC" style="font-size: 14px"><strong>DESCRIPCION</strong></td>
    <td width="12%" align="center" bgcolor="#CCCCCC" style="font-size: 14px"><strong>U.M</strong></td>
    <td width="14%" align="center" bgcolor="#CCCCCC" style="font-size: 14px"><strong>CANTIDAD</strong></td>
  </tr>
  @if($InfoProduccionMaterial) @foreach ($InfoProduccionMaterial as $data)
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
  @if($InfoProduccionManoObra) @foreach ($InfoProduccionManoObra as $datamaterial)
  <tr>
    <td align="center" style="font-size: 12px">{{$datamaterial->personal}}</td>
    <td align="center" style="font-size: 12px">{{$datamaterial->horas}}</td>
    <td align="center" style="font-size: 12px">{{$datamaterial->dias}}</td>  
  </tr>
  @endforeach @endif
</table>
<table width="100%" border="1">
    <tr>
      <td width="51%" align="center" bgcolor="#33CCFF" style="font-size: 14px"><strong>OTROS REQUERIMIENTOS</strong></td>
      <td width="49%" align="center" bgcolor="#33CCFF" style="font-size: 14px"><strong>DESCRIPCION</strong></td>
    </tr>
    @if($InfoProduccionOtrosRequerimientos) @foreach ($InfoProduccionOtrosRequerimientos as $dataRque)
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
    <td align="center" style="font-size: 12px"><strong>V-B RESPONSABLE PRODUCCION</strong></td>
  </tr>
</table>
<p>&nbsp;</p>
<p><br />
</p>
</body>
</html>
