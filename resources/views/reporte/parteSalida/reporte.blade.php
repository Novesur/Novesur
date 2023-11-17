<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="100%" border="0">
  <tr>
  <td width="27%"><img src="{{$logo}}" width="300" height="94" alt="ss" /><br /></td>
    <td width="38%" align="center"><strong>PARTE DE SALIDA - ALMACEN</strong></td>
    <td width="35%" align="center">Nro {{$parteSalida->codigo}}</td>
  </tr>
</table>
<br />


<table width="100%" border="0">
  <tr>
    <td colspan="2">&nbsp;</td>
    <td width="23%" align="center"><strong>FECHA :</strong></td>
    <td width="25%" align="center">{{$parteSalida->Fecha}}</td>
  </tr>
  <tr>
    <td width="19%"><strong>CLIENTE :</strong></td>
    <td width="33%">{{$parteSalida->cliente->razonsocial}}</td>
    <td align="center"><strong>G/REMISION Nº</strong></td>
    <td align="center">{{$parteSalida->Nroguia}}</td>
  </tr>
  <tr>
    <td><strong>VENDEDOR</strong></td>
    <td colspan="3">{{$parteSalida->user->secondname}} {{$parteSalida->user->lastname}} {{$parteSalida->user->firstname}}</td>
  </tr>
  <tr>
    <td><strong>TIPO MOVIENTO :</strong></td>
    <td colspan="3"> SALIDA</td>
  </tr>
</table>


<br />




<table width="100%" border="1">
  <tr>
    <td align="center"><strong>CODIGO</strong></td>
    <td align="center"><strong>CANTIDAD</strong></td>
    <td align="center"><strong>UNIDAD DE MEDIDA</strong></td>
    <td align="center"><strong>DESCRIPCION</strong></td>
  </tr>
  @if($detalleParteSalida) @foreach ($detalleParteSalida as $data)
  <tr>
    <td align="center">{{$data->producto->codigo}}</td>
    <td align="center">{{$data->cantidad}}</td>
    <td align="center">{{$data->unidmedida->nombre}}</td>
    <td align="center">{{$data->producto->familia->nombre .' '. $data->producto->subfamilia->nombre .', MODELO '. $data->producto->modelotipo->nombre .', MATERIAL '. $data->producto->material->nombre .', MARCA '. $data->producto->marca->nombre.', - '. $data->producto->homologacion->nombre}}</td>
  </tr>
  @endforeach
  @endif
</table>
<p><br />
</p>
<table width="100%" border="0">
  <tr>
    <td width="22%" align="center"><strong>OBSERVACIONES  :</strong></td>
    <td colspan="3">{{$parteSalida->observacion}}</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="67%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="6%">&nbsp;</td>
  </tr>
</table>
<br />
<br />
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><strong>VºBº Almacen</strong></td>
    <td align="center"><strong>V°B° Asesor Ventas</strong></td>
    <td align="center"><strong>Recibi Conforme</strong></td>
  </tr>
</table>
</body>
</html>
