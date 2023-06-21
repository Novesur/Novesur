<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsPapeletaSalida extends Model
{
    protected $table = 'clients_papeleta_salida';

    public function papeletasalida()
    {
        return $this->belongsTo(Papeletasalida::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
