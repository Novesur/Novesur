<?php

namespace App\Imports;

use App\Asistencia;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class AsistenciaImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{

    public function model(array $row)
    {

       $fecha = date('Y-m-d', strtotime(substr($row['fechahora'], 0, 10)));
       $tiempo =  substr($row['fechahora'], 11, 19);

        $dato = Asistencia::where('fecha', $fecha )->where('tiempo', $tiempo)->count();

        if($dato == 0){
            if ( $fecha  !== '1970-01-01') {
                return new Asistencia([
                    'asistencia'   => $row['usuario'],
                    'fecha' =>   $fecha,
                    'tiempo' =>  $tiempo,
                    'asistencia_estado_id' =>  1,
                    'estado' =>  1
                ]);
            }
        }

    }
    public function batchSize(): int
    {
        return 100;
    }
    public function chunkSize(): int
    {
        return 100;
    }
}
