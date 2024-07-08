<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObservacionPapeleta extends Model
{
    use SoftDeletes;
    protected $table = 'observacion_papeleta';
    protected $fillable =[
        'user_id',
        'fecha',
        'horasalida',
        'horaretorno',
        'motivopapeletasalida_id',
        'estadopapeletasalida_id',
        'fundamento',
        'observacion',
        'hora_emision',
        'observacion_papeleta_id'
    ];

    public function papeleta_salida()
    {
        return $this->belongsTo(Papeletasalida::class);
    }
}
