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
            <th><b>Nro</b></th>
            <th><b>Fecha</b></th>
            <th><b>Cliente</b></th>
            <th><b>Estado</b></th>
            <th><b>Vendedor</b></th>
            <th><b>Monto</b></th>


        </tr>
        </thead>
        <tbody>

      @foreach($listCotizacionByDate as $data)
            <tr>
                <td>

                   @php
                   echo sprintf('%03d', $data->id).'-'. substr($data->fecha,0,4);
                   @endphp


            </td>
                <td>{{date('d-m-Y', strtotime($data->fecha))}}</td>
                <td>{{$data->cliente->razonsocial}}</td>
                <td>{{$data->estadopedido->nombre}}</td>
                <td>{{$data->user->firstname}}</td>
                <td>{{$data->detalle_sum}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
