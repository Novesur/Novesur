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
            <th><b>F. Registro</b></th>
            <th><b>F. Vencimiento</b></th>
            <th><b>Obligación</b></th>
            <th><b>Entidad</b></th>
            <th><b>Importe</b></th>
            <th><b>Moneda</b></th>
            <th><b>Usuario</b></th>


        </tr>
        </thead>
        <tbody>
    @foreach($listAlertasByDate as $data)


            <tr>

                <td>{{$data->fRegistro}}</td>
                <td>{{$data->fVencimiento}}</td>
                <td>{{$data->obligacion}}</td>
                <td>{{$data->entidad}}</td>
                <td>{{$data->tipocambio->signo}} {{$data->importe}}</td>
                <td>{{$data->tipocambio->nombre}}</td>
                <td>{{$data->user->fullname}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
