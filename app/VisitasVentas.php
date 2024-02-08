<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitasVentas extends Model
{
    use SoftDeletes;
    protected $table = 'visitas_ventas';

    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function estadoObra()
    {
        return $this->belongsTo(EstadoObra::class);
    }

    public function personal_contacto()
    {
        return $this->belongsTo(PersonalContacto::class);
    }

}
