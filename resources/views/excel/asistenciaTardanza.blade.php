<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Documento sin título</title>
</head>

<body>
    @php
        $dias = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo',
        ];

        $meses = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre',
        ];

        $fechaEjemplo = $listAsistenciaTardanza[0]->asistencias[0]->fecha ?? null;
        $mes = $fechaEjemplo ? $meses[date('F', strtotime($fechaEjemplo))] : '';
        $anio = $fechaEjemplo ? date('Y', strtotime($fechaEjemplo)) : '';

    @endphp

    <table width="100%" border="0">
        <tr>
            <td align="center"><strong>REPORTE HUELLERO - {{ strtoupper($mes) }} {{ $anio }}</strong></td>
        </tr>
        @foreach ($listAsistenciaTardanza as $grupos)
            <tr>
                <td><strong> {{ $grupos[0]->personal->ApPaterno }} {{ $grupos[0]->personal->ApMaterno }}
                        {{ $grupos[0]->personal->nombres }}</strong></td>
            </tr>
            <br />

    </table>
    <table width="100%" border="1">
        <tr>
            <td align="center"><strong>DIA</strong></td>
            <td align="center"><strong>FECHA</strong></td>
            <td align="center"><strong>HORA INGRESO</strong></td>
            <td align="center"><strong>SEDE</strong></td>
            <td align="center"><strong>OBSERVACIONES</strong></td>
        </tr>
        @foreach ($grupos as $asistencia)
            <tr>
                <td>{{ $dias[date('l', strtotime($asistencia->fecha))] }}</td>
                <td>{{ $asistencia->fecha }}</td>
                <td>{{ $asistencia->tiempo }}</td>
                <td>{{ isset($asistencia->personal->sede) ? $asistencia->personal->sede->nombre : '' }}</td>
                <td>NINGUNO</td>
            </tr>
        @endforeach
        @endforeach
    </table>

</body>

</html>
