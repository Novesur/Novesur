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
            <th bgcolor= "#99CCFF" align="center"><strong>Codigo</strong></th>
            <th bgcolor= "#99CCFF" align="center"><strong>Nombre</strong></th>
            <th bgcolor= "#99CCFF" align="center"><strong>Precio</strong></th>
            <th bgcolor= "#99CCFF" align="center"><strong>Prec. Dist</strong></th>
           {{--   <th>Modelo/Tipo</th>
            <th>Marca</th>
            <th>Material</th> 
            <th>Diametro/Longitud</th>
            <th>Homologacion</th>  --}}
        </tr>
        </thead>
        <tbody>
    @foreach($productos as $data)
            <tr>
                <td>{{$data->codigo}}</td>
                <td>{{$data->familia->nombre}} , {{$data->subfamilia->nombre}},  {{'MODELO :' .' '.$data->modelotipo->nombre}}, {{'MARCA :' .' '.$data->marca->nombre}}, {{'MATERIAL :' .' '.$data->material->nombre}}, {{$data->homologacion->nombre}} </td>
                <td>{{$data->precioSugerido}}</td>
                <td>{{$data->precioDistribuidor}}</td>
                {{--      <td>{{$data->familia->nombre}}</td>
                <td>{{$data->modelotipo->nombre}}</td>
                <td>{{$data->marca->nombre}}</td>
                <td>{{$data->material->nombre}}</td>
                <td>{{$data->subfamilia->nombre}}</td>
                <td>{{$data->homologacion->nombre}}</td>  --}}


            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
