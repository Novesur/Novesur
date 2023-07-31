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
            <th style="background-color: #DCF7F6"><b>Fecha</b></th>
            <th style="background-color: #DCF7F6"><b>Vendedor</b></th>
            <th style="background-color: #DCF7F6"><b>Hora Salida</b></th>
            <th style="background-color: #DCF7F6"><b>Hora Entrada</b></th>
            <th style="background-color: #DCF7F6"><b>Motivo</b></th>
             <th style="background-color: #DCF7F6"><b>Observacion</b></th>
        </tr>
        </thead>
        <tbody>
    @foreach($dato as $data)
            <tr>
                <td style="background-color: #DCF7F6">{{ date('d-m-Y', strtotime($data->papeletasalida->fecha)) }}</td>
                <br>
                <td style="background-color: #DCF7F6">{{$data->papeletasalida->user->fullname}}</td>
                <td style="background-color: #DCF7F6">{{$data->papeletasalida->horasalida}}</td>
                <td style="background-color: #DCF7F6">{{$data->papeletasalida->horaretorno}}</td>
                <td style="background-color: #DCF7F6">{{$data->papeletasalida->motivopapeletasalida->nombre}}</td>
                <td style="background-color: #DCF7F6">{{$data->papeletasalida->observacion}}</td>
            </tr>

            <tr>
                <thead>

                    </thead>
                    <td style="background-color: #F6F8CE"><b>Cliente</b></td>

                <td style="background-color: #F6F8CE">{{$data->cliente->razonsocial}}</td>
                <td style="background-color: #BBF9DA"><b>Contacto</b></td>
                <td style="background-color: #BBF9DA">{{$data->contacto}}</td>
                <td style="background-color: #F3E9CC"><b>Fundamento</b></td>
                <td style="background-color: #F3E9CC">{{$data->papeletasalida->fundamento}}</td>



            </tr>

            @endforeach
        </tbody>
    </table>

</body>
</html>
