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
             <th><b>Vendedor</b></th>
            <th><b>Estado</b></th>
        </tr>
        </thead>
        <tbody>

       @foreach($ReporteVentasFechaEstado as $data)
            <tr>
                <td>

                   @php
                   echo sprintf('%03d', $data->id).'-'. substr($data->fecha,0,4);
                   @endphp


            </td>
                <td>{{$data->fecha}}</td>

                <td>{{$data->clienteNombre}}</td>
                 <td>{{$data->vendedor}}</td>
                <td>{{$data->estadopedido}}</td>


            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
