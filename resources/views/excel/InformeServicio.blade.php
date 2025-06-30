<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe de Valorizacion</title>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th bgcolor= "#99CCFF" align="center"><strong>Fecha</strong></th>
            <th bgcolor= "#99CCFF" align="center"><strong>Codigo</strong></th>
            <th bgcolor= "#99CCFF" align="center"><strong>Cliente</strong></th>
            <th bgcolor= "#99CCFF" align="center"><strong>Detalle Servicio</strong></th>
            <th bgcolor= "#99CCFF" align="center"><strong>F.Inicio</strong></th>
            <th bgcolor= "#99CCFF" align="center"><strong>F.Fin</strong></th>
            <th bgcolor= "#99CCFF" align="center"><strong>Servicio Nro</strong></th>

        </tr>
        </thead>
        <tbody>
    @foreach($listPInfoServicio as $data)
            <tr>
                <td>{{$data->fecha}}</td>
                <td>{{$data->codigo}} </td>
                <td>{{$data->cliente}}</td>
                  <td>{{$data->detservicio}}</td>
                <td>{{$data->fechainicio}}</td>
                <td>{{$data->fechafinal}}</td>
                <td>{{$data->ord_servicio}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
