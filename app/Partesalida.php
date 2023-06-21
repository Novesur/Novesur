<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partesalida extends Model
{
    protected $table = 'partesalida';

    protected $fillable =[
        'codigo',
        'cliente_id',
        'Nrofactura',
        'Nroguia',
        'motivo_id',
        'Fecha',
        'observacion',
        'user_id',
        'estadoparte_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function motivo()
    {
        return $this->belongsTo(Motivo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
