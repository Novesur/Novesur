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
            <th>Codigo</th>
            <th>Cod. Requerimiento</th>
             <th>Fecha</th>
            <th>Cod. Producto</th>
            <th>Producto</th>
            <th>Cantidad</th>
        </tr>
        </thead>
        <tbody>
    @foreach($listOrdenProduc as $data)
            <tr>
                <td>{{$data->codigo}}</td>
                <td>{{$data->requerimiento_materiales->codigo}} </td>
                <td>{{date('d-m-Y', strtotime($data->fecha))}}</td>
                <td>{{$data->producto->codigo}}</td>
                <td> {{$data->producto->familia->nombre}},{{$data->producto->subfamilia->nombre}},  {{'MODELO :' .' '.$data->producto->modelotipo->nombre}}, {{'MARCA :' .' '.$data->producto->marca->nombre}}, {{'MATERIAL :' .' '.$data->producto->material->nombre}}, {{$data->producto->homologacion->nombre}}</td>
                <td>{{$data->cantidad}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
