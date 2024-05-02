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
            <th><b>14</b></th>
            <th><b>15</b></th>
            <th><b>16</b></th>
            <th><b>17</b></th>
            <th><b>18</b></th>
            <th><b>19</b></th>
            <th><b>20</b></th>
            <th><b>21</b></th>
            <th><b>22</b></th>
            <th><b>23</b></th>
            <th><b>24</b></th>
            <th><b>25</b></th>
            <th><b>26</b></th>
            <th><b>27</b></th>
            <th><b>28</b></th>
            <th><b>29</b></th>
            <th><b>30</b></th>
            <th><b>Total Asistencia</b></th>



        </tr>
        </thead>
        <tbody>
    @foreach($listAsistenciaByDay1431 as $data)


            <tr>

                <td>{{$data->DNI}}</td>
                <td>{{$data->personal}}</td>
                <td>{{$data->dia14}}</td>
                <td>{{$data->dia15}}</td>
                <td>{{$data->dia16}}</td>
                <td>{{$data->dia17}}</td>
                <td>{{$data->dia18}}</td>
                <td>{{$data->dia19}}</td>
                <td>{{$data->dia20}}</td>
                <td>{{$data->dia21}}</td>
                <td>{{$data->dia22}}</td>
                <td>{{$data->dia23}}</td>
                <td>{{$data->dia24}}</td>
                <td>{{$data->dia25}}</td>
                <td>{{$data->dia26}}</td>
                <td>{{$data->dia27}}</td>
                <td>{{$data->dia28}}</td>
                <td>{{$data->dia29}}</td>
                <td>{{$data->dia30}}</td>
                <td>{{$data->total_asistencias}}</td>


            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
