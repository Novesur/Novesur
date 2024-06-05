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

            <th><b>DNI</b></th>
            <th><b> PERSONAL</b></th>
            <th><b>01</b></th>
            <th><b>02</b></th>
            <th><b>03</b></th>
            <th><b>04</b></th>
            <th><b>05</b></th>
            <th><b>06</b></th>
            <th><b>07</b></th>
            <th><b>08</b></th>
            <th><b>09</b></th>
            <th><b>10</b></th>
            <th><b>11</b></th>
            <th><b>12</b></th>
            <th><b>13</b></th>
          
            <th><b>Total Asistencia</b></th>



        </tr>
        </thead>
        <tbody>
    @foreach($listAsistenciaByDay0113 as $data)


            <tr>

                <td>{{$data->DNI}}</td>
                <td>{{$data->personal}}</td>
                <td>{{$data->dia01}}</td>
                <td>{{$data->dia02}}</td>
                <td>{{$data->dia03}}</td>
                <td>{{$data->dia04}}</td>
                <td>{{$data->dia05}}</td>
                <td>{{$data->dia06}}</td>
                <td>{{$data->dia07}}</td>
                <td>{{$data->dia08}}</td>
                <td>{{$data->dia09}}</td>
                <td>{{$data->dia10}}</td>
                <td>{{$data->dia11}}</td>
                <td>{{$data->dia12}}</td>
                <td>{{$data->dia13}}</td>
         
                <td>{{$data->total_asistencias}}</td> 


            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
