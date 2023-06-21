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


</tr>

    <table>
        <thead>
        <tr>
            <th><b>Nro</b></th>
            <th><b>Fecha</b></th>
            <th><b>Cliente</b></th>
            <th><b>CodProd</b></th>
            <th><b>Producto</b></th>
            <th><b>Cantidad</b></th>
            <th><b>P.U</b></th>
            <th><b>Total</b></th>
            <th><b>Vendedor</b></th>


        </tr>
        </thead>
        <tbody>
{{--  @php
$i = 0;
@endphp  --}}
      @foreach($listDetProductByDate as $data)
            <tr>
                
                <td>{{$data->codigo}}</td>
                <td>{{date('d-m-Y', strtotime($data->fecha))}}</td>
                <td>{{$data->razonsocial}}</td>
             
                <td>{{$data->codprod}}</td>
                <td>{{$data->familia}} , 
                    {{$data->subfamilia}}
                     ,MODELO {{$data->modelotipo}}
                     ,MARCA {{$data->marca}}
                     ,MATERIAL {{$data->material}}
                     {{$data->homologacion}}
                    </td>
                  
                    <td>{{$data->cantidad}}</td>
                    <td>{{$data->punit}}</td>
                    <td>{{$data->cantidad * $data->punit}}</td>
                    <td>{{$data->usuario}}</td> 
             
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
