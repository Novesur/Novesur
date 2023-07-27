<?php

namespace App\Imports;

use App\Asistencia;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class AsistenciaImport implements ToModel, WithHeadingRow,WithBatchInserts,WithChunkReading
{
 
    public function model(array $row)
    {
        return new Asistencia([
            'asistencia'     => $row['asistencia'],
            'fecha_hora'    => $row['fecha_hora'], 
        ]);
    }
    public function batchSize(): int
    {
        return 50;
    }
    public function chunkSize(): int
    {
        return 50;
    }
}
