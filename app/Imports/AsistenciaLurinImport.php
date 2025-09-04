<?php

namespace App\Imports;

use App\Asistencia;
use App\Personal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class AsistenciaLurinImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
     public function model(array $row)
    {
        /*   $fecha = trim(date('Y-m-d', strtotime(substr($row['fechahora'], 0, 10))));
        $tiempo =  trim(substr($row['fechahora'],11, 20)) ;
        $dato = Asistencia::where('fecha', $fecha )->where('tiempo', $tiempo)->count(); */
        $fecha  = $row['fecha'];
        $hora = $row['entrada'];
        $horavacia =  is_null($hora);

        $dato = Asistencia::where('fecha', $fecha )->where('tiempo', $hora)->count();

           $personal= Personal::where('codigo',$row['id'])->where('sede_id',2)->first();

        if($dato == 0 && !$horavacia){
            if ( $fecha  !== '1970-01-01'  ) {
                return new Asistencia([
                    'asistencia'   => $row['id'],
                    'fecha' =>   $fecha,
                    'tiempo' =>  $hora,
                    'asistencia_estado_id' =>  1,
                    'estado' =>  1,
                    'sede_id' =>  2,
                    'personal_id' => $personal->id,

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
