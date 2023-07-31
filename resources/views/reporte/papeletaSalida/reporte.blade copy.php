<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="100%" border="0">
  <tr>

    <td width="18%" rowspan="2"><img src="{{$logo}}" width="285" height="81" alt="fghf" /></td>
    <td width="82%">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><b>PAPELETA DE AUTORIZACION DE SALIDA</b></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="30%"><b>NOMBRE Y APELLIDOS :</b></td>
    <td width="70%"> {{$Papeletasalida->user->firstname}} {{$Papeletasalida->user->secondname}} {{$Papeletasalida->user->lastname}}</td>

  </tr>
  <tr>
    <td><b>AREA DE TRABAJO :</b></td>
    <td> COMERCIAL</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td align="center"><b>FECHA :</b></td>
    <td align="center"> <b>HORA DE SALIDA :</b></td>
    <td align="center"> <b>HORA DE RETORNO :</b></td>
  </tr>
  <tr>
    <td align="center">{{date('d-m-Y', strtotime($Papeletasalida->fecha))}}</td>
    <td align="center">{{$Papeletasalida->horasalida}}</td>
    <td align="center"> {{$Papeletasalida->horaretorno}}</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="13%"><b>MOTIVO :</b></td>
    <td width="87%"> {{$Papeletasalida->motivopapeletasalida->nombre}}</td>
  </tr>
</table>

<table width="100%" border="1">
  <tr>
    <td bgcolor="#FFFFFF"><b>FUNDAMENTO :</b></td>
  </tr>
  <tr>
    <td>
        @php
            echo $Papeletasalida->fundamento
        @endphp</td></td>
  </tr>
</table>
<br />
<table width="100%" border="1">
  <tr>
    <td colspan="3"><b><b></B>CLIENTE</b></td>
  </tr>
  <tr>
      <td><center><b>RAZON SOCIAL</b></center></td>
      <td><center><b>DIRECCION</b></center></td>
      <td><center><b>CONTACTO</b></center></td>
    </tr>
    @if($clientpapeletasalida) @foreach ($clientpapeletasalida as $data)
  <tr>
    <td><center>{{$data->cliente->razonsocial}}</center></td>
    <td><center>{{$data->direccion}}</center></td>
    <td><center>{{$data->contacto}}</center></td>
  </tr>
         @endforeach @endif
</table>
<br>
<table width="100%" border="0">
  <tr>
    <td width="20%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
    <td width="21%">&nbsp;</td>
    <td width="34%">&nbsp;</td>
  </tr>
  <tr>
      <br>
    <td height="23">&nbsp;</td>
    <td><b>JEFE INMEDIATO</b></td>
    <td><b>SOLICITANTE</b></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>

</body>

</html>
