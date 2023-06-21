<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordenservicio extends Model
{
    const ATENDIDO = 1;
    const ANULADO = 2;
    protected $table = 'ordenservicio';


    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estadoordencompra()
    {
        return $this->belongsTo(Estadoordercompra::class);
    }

    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }

    public function tipocambio()
    {
        return $this->belongsTo(Tipocambio::class);
    }
}
