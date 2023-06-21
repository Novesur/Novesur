<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<tr>
 <td>
    <center><h3>Producto :    {{$producto->familia->nombre}} , {{$producto->subfamilia->nombre}},  {{'MODELO :' .' '.$producto->modelotipo->nombre}}, {{'MARCA :' .' '.$producto->marca->nombre}}, {{'MATERIAL :' .' '.$producto->material->nombre}}, {{$producto->homologacion->nombre}}
    </h3></center>
 </td>

</tr>

    <table>
        <thead>
        <tr>
            <th><b>Nro</b></th>
            <th><b>Fecha</b></th>
            <th><b>RUC</b></th>
            <th><b>Cliente</b></th>
            <th><b>Estado</b></th>
            <th><b>Vendedor</b></th>


        </tr>
        </thead>
        <tbody>
{{--  @php
$i = 0;
@endphp  --}}
      @foreach($listCotizacion as $data)
            <tr>
                <td>
                {{$data->cotizacion->codigo}}
               <!--     {{--  {{$i = $i +1}}  --}}
                   @php
                   echo sprintf('%03d', $data->cotizacion->id).'-'. substr($data->cotizacion->fecha,0,4);
                   @endphp -->
            </td>
                <td>{{date('d-m-Y', strtotime($data->cotizacion->fecha))}}</td>
                <td>{{$data->cotizacion->cliente->ruc}}</td>
                <td>{{$data->cotizacion->cliente->razonsocial}}</td>
                <td>{{$data->cotizacion->estadopedido->nombre}}</td>
                <td>{{$data->cotizacion->user->firstname}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
