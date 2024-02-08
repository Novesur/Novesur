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
            <th>Distrito</th>
            <th>Cliente</th>
            <th>Proyecto</th>
            <th>Dirección</th>
            <th>Estado Obra</th>
            <th>Personal Contacto</th>
            <th>Contacto</th>  
            <th>Observación</th>  
        </tr>
        </thead>
        <tbody>
    @foreach($listSubfamilia as $data)
            <tr>
                <td>{{date('d-m-Y', strtotime($data->fecha))}}</td>
                <td>{{$data->distrito->nombre}} </td>
                <td>{{$data->cliente->razonsocial}}</td>
                <td>{{$data->proyecto}}</td>
                <td>{{$data->direccion}}</td>
                <td>{{$data->estado_obra->nombre}}</td>
                <td>{{$data->personal_contacto->nombre}}</td>
                <td>{{$data->nombre}}</td>
                <td>{{$data->observacion}}</td>  



            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
