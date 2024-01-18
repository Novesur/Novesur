<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th>O/C</th>
            <th>FECHA</th>
            <th>COD PROD</th>
            <th>PRODUCTO</th>
            <th>TIPO DE CAMBIO</th>
            <th>CANTIDAD</th>
            <th>PRECIO</th>
            <th>TOTAL</th>
        </tr>
        </thead>
        <tbody>
    @foreach($listOrdCompraxProveedor as $data)
            <tr>
                <td>{{$data->codigo}}</td>
                <td>{{date('d-m-Y', strtotime($data->Femision))}}</td>
                <td>{{$data->detalle[0]->producto->codigo}}  </td>
                <td> {{$data->detalle[0]->producto->familia->nombre}},{{$data->detalle[0]->producto->subfamilia->nombre}},  {{'MODELO :' .' '.$data->detalle[0]->producto->modelotipo->nombre}}, {{'MARCA :' .' '.$data->detalle[0]->producto->marca->nombre}}, {{'MATERIAL :' .' '.$data->detalle[0]->producto->material->nombre}}, {{$data->detalle[0]->producto->homologacion->nombre}}</td>
                <td>{{$data->tipocambio->nombre}}</td>
                <td>{{$data->detalle[0]->cantidad}}</td>
                <td>{{$data->detalle[0]->punit}}</td>
                <td>{{$data->detalle[0]->cantidad * $data->detalle[0]->punit }}</td>
     
            </tr>
            @endforeach
            <tr>
  
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

    
    @php
    $tot = 0;
    @endphp
    @foreach ($listOrdCompraxProveedor as $dato) 

    @php  $valor =  $dato->detalle[0]->cantidad * $dato->detalle[0]->punit  @endphp 
    @php  $tot =  $valor + $tot @endphp 

    @endforeach
  
    <td>TOTALES</td>
    <td>{{$tot}} </td>
    </tr>
        </tbody>
    </table>

</body>
</html>
