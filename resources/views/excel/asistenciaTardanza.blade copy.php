<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Documento sin título</title>
</head>

<body>
  <table width="100%" border="1">
    <tr>
      <td align="center"><strong>DNI</strong></td>
      <td align="center"><strong>PERSONAL</strong></td>
      <td align="center"><strong>FECHA</strong></td>
      <td align="center"><strong>HORA</strong></td>
    </tr>
    @foreach($listAsistenciaTardanza as $data)
    <tr>
      <td rowspan="{{count($data->asistencias)+1}}">{{$data->DNI}}</td>
      <td rowspan="{{count($data->asistencias)+1}}"> {{$data->ApPaterno}} {{$data->ApMaterno}} {{$data->nombres}}</td>

    </tr>
    @foreach($data->asistencias as $dataAsitCampo)
    <tr>
      <td>
        {{$dataAsitCampo->fecha}}
      </td>
      <td>
        {{$dataAsitCampo->tiempo}}
      </td>
    </tr>
    
    
    
    
    
    @endforeach
    <tr>
      <td colspan="2">
      {{$data->ApPaterno}} {{$data->ApMaterno}} {{$data->nombres }} &nbsp; <b> Resultado</b>
      </td>

    </tr>
    @endforeach
    <tr>
    </tr>
  

  </table>
</body>

</html>