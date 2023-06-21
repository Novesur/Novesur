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
            <th>Nombre</th>
            <th>Ruc</th>
            <th>Dirección</th>
            <th>Teléfono</th>
        
        </tr>
        </thead>
        <tbody>
    @foreach($proveedor as $data)
            <tr>
                <td>{{$data->nombre}}</td>
                <td>{{$data->ruc}} </td>
                <td>{{$data->direccion}} </td>
                <td>{{$data->telefono}} </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
