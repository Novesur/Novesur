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
            <th><b>Fecha</b></th>
            <th><b>Cotizacion</b></th>
            <th><b>Cod Producto</b></th>
            <th><b>Cantidad</b></th>
             <th><b>Producto</b></th>
            <th><b>Vendedor</b></th>
        </tr>
        </thead>
        <tbody>

       @foreach($listAnalisisDetProductByDate as $data)
            <tr>
           
                <td>{{date('d-m-Y', strtotime($data->cotizacion->fecha))}}</td>
                <td>{{$data->producto->codigo}}</td>
                <td>{{$data->cantidad}}</td>
                <td>{{$data->producto->familia->nombre}} , 
                    {{$data->producto->subfamilia->nombre}}
                     ,MODELO {{$data->producto->modelotipo->nombre}}
                     ,MARCA {{$data->producto->marca->nombre}}
                     ,MATERIAL {{$data->producto->material->nombre}}
                     {{$data->producto->homologacion->nombre}}
                    </td>
                <td>{{$data->cotizacion->user->fullname}}</td>


            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
