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
            <th><b>Vendedor</b></th>
            <th><b>Razon Social</b></th>
            <th><b>Ruc</b></th>
            <th><b>Atencion</b></th>
            <th><b>Telefono</b></th>
            <th><b>Celular</b></th>
            <th><b>email</b></th>
            <th><b>Tipo Precio</b></th>

        </tr>
        </thead>
        <tbody>
    @foreach($cliente as $data)


            <tr>
                @if($data->user == null)
                <td>Dado de Baja</td>
                @else
                <td>{{$data->user->fullname}}</td>
                @endif
                <td>{{$data->razonsocial}}</td>
                <td>{{$data->ruc}}</td>
                <td>{{$data->atencion}}</td>
                <td>{{$data->telefono}}</td>
                <td>{{$data->celular}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->tipoPrecio}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
