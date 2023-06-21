<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Lista Parte de Ingreso</title>
</head>

<body>
<table width="101%" border="0">
  <tr>
    <td width="40%"><img src="{{$logo}}" width="300" height="92" alt="logo" /></td>
    <td width="60%" align="center"><strong>Nro : {{$PartI->codigo}}</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="20%"><strong>Proveedor : </strong></td>
    <td width="47%">{{$PartI->proveedor->nombre}}</td>
    <td width="20%"><strong>O. de Compra :</strong></td>
    <td width="16%">{{$PartI->ordencompras->codigo}}</td>
  </tr>
  <tr>
    <td><strong>Documento : </strong></td>
    <td colspan="3">{{'F'.$PartI->Nrofactura .' / '. 'GR-'.$PartI->Nroguia }}</td>
  </tr>
  <tr>
    <td><strong>Fecha  : </strong></td>
    <td colspan="3">{{$PartI->Fecha}}</td>
  </tr>
</table>
<br />
<table width="100%" border="1">
  <tr>
    <td width="17%" align="center" style="font-size: 14px"><strong>CODIGO</strong></td>
    <td width="9%" align="center" style="font-size: 14px"><strong>CANT</strong></td>
    <td width="15%" align="center" style="font-size: 14px"><strong>UNID. MED</strong></td>
    <td width="59%" align="center" style="font-size: 14px"><strong>DESCRIPCION</strong></td>
  </tr>

  @if($detPartI) @foreach ($detPartI as $data)
  <tr>
    <td style="font-size: 12px; text-align: center;">{{$data->producto->codigo}}</td>
    <td style="font-size: 12px ; text-align: center;">{{$data->cantidad}} </td>
    <td style="font-size: 12px; text-align: center;">{{$data->unidmedida->nombre}}</td>
    <td style="font-size: 12px; text-align: center;">{{$data->producto->familia->nombre .' '. $data->producto->subfamilia->nombre .', MODELO '. $data->producto->modelotipo->nombre .', MATERIAL '. $data->producto->material->nombre .', MARCA '. $data->producto->marca->nombre.', - '. $data->producto->homologacion->nombre}}</td>
  </tr>
  @endforeach
  @endif
</table>
<br />
<table width="100%" border="0">
  <tr>
    <td width="20%"><strong>Observaciones :</strong></td>
    <td width="80%">{{$PartI->observacion}}</td>
  </tr>
</table>
<br />
<br />
<table width="100%" border="0">
  <tr>
    <td width="24%">&nbsp;</td>
    <td width="36%">&nbsp;</td>
    <td width="40%">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">V° B° Almacen </td>
    <td align="center"> V° B° Contabilidad</td>
    <td align="center">V° B° Administración</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
