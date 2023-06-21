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
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Entrada</th>
            <th>Observación Entrada</th>
            <th>Segundo</th>
            <th>Observación Segundo</th>
         <!--    <th>Extra</th>
            <th>Observación_Extra</th> -->
            <th>Dieta</th>
            <th>Observación Dieta</th>
            <th>Tipo de Menu</th>
        </tr>
        </thead>
        <tbody>
    @foreach($DetalleMenu as $data)

            <tr>
                <td>{{ date('d-m-Y', strtotime($data->menu->fecha)) }}</td>
              
              @if (is_null($data->menu->user))
                <td> <strong> USUARIO DADO DE BAJA </strong><td>
                    @else 
                    <td>{{strtoupper($data->menu->user->secondname)}} {{strtoupper($data->menu->user->lastname)}}   {{strtoupper($data->menu->user->firstname)}}</td>
                 @endif 
                 <td>{{$data->plato_entrada->nombre}} </td>
                <td>{{$data->observacionEntrada}} </td>
                <td>{{$data->plato_segundo->nombre}} </td>
                <td>{{$data->observacionSegundo}} </td>
           <!--      <td>{{$data->plato_extra->nombre}} </td>
                <td>{{$data->observacionExtra}} </td> -->
                <td>{{$data->plato_dieta->nombre}} </td>
                <td>{{$data->observacionDieta}} </td>
                <td>{{$data->menu->tipomenu->nombre}} </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
