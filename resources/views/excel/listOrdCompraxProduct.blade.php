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
          <th>PROVEEDOR</th>
          <th>COD PRODUCT</th>
          <th>PRODUCTO</th>
          <th>CANTIDAD</th>
            <th>PRECIO</th>
            <th>TOTAL</th>
        </tr>
        </thead>
        <tbody>
    @foreach($listOrdenPedidoXProduct as $data)
            <tr>
                @if ($data->ordencompras)
                <td>{{$data->ordencompras->codigo}}</td>
                <td>{{date('d-m-Y', strtotime($data->ordencompras->Femision))}}</td>
                <td>{{$data->ordencompras->proveedor->nombre}}</td>
                @else 
                <td></td>
                <td></td>
                <td></td>
                @endif
                <td>{{$data->producto->codigo}}</td>
                <td>{{$data->producto->familia->nombre}} , 
                    {{$data->producto->subfamilia->nombre}}
                     ,MODELO {{$data->producto->modelotipo->nombre}}
                     ,MARCA {{$data->producto->marca->nombre}}
                     ,MATERIAL {{$data->producto->material->nombre}}
                     {{$data->producto->homologacion->nombre}}
                    </td>
                <td>{{$data->cantidad}}</td>
                <td>{{round($data->punit,4)}}</td>
                <td>{{round($data->cantidad * $data->punit,4) }}</td>


     
            </tr>
            @endforeach
            <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

    
    @php
    $tot = 0;
    @endphp
    @foreach ($listOrdenPedidoXProduct as $dato) 

    @php  $valor =  $dato->cantidad * $dato->punit @endphp 
    @php  $tot =  $valor + $tot @endphp 

    @endforeach
  
    <td>TOTALES</td>
    <td>{{round($tot,4)}} </td>
    </tr>
        </tbody>
    </table>
    

</body>
</html>
