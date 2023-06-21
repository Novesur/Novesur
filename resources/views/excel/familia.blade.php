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
            <th>Nombre</th>
           {{--   <th>Modelo/Tipo</th>
            <th>Marca</th>
            <th>Material</th>
            <th>Diametro/Longitud</th>
            <th>Homologacion</th>  --}}
        </tr>
        </thead>
        <tbody>
    @foreach($familia as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->nombre}} </td>
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
