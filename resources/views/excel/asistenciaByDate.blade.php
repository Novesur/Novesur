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
            <th><b>Hora</b></th>
            <th><b>Minutos Tardanza</b></th>
            <th><b>Personal</b></th>
            <th><b>DNI</b></th>
            <th><b>Zona</b></th>
            <th><b>Cargo</b></th>
            <th><b>Estado</b></th>

        </tr>
        </thead>
        <tbody>
    @foreach($asistenciaByDate as $data)


            <tr>
             
                <td>{{$data->fecha}}</td>
                <td>{{$data->tiempo}}</td>
                @php

                 $apertura = new DateTime('08:00:00'); 
                $cierre = new DateTime($data->tiempo);
                $tiempo = $apertura->diff($cierre);
                @endphp

                @if($apertura <= $cierre)
                <td>{{$tiempo->format('%H Horas y  %i Minutos')}}</td>
                @else
                <td>0</td>
                @endif
                <td>{{$data->personal}}</td>
                <td>{{$data->DNI}}</td>
                <td>{{$data->zonal}}</td>
                <td>{{$data->cargo}}</td>
                <td>{{$data->estado}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
