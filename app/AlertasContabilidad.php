<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlertasContabilidad extends Model
{
    use SoftDeletes;
    protected $table = 'alertas_contabilidad';

    public function tipocambio()
    {
        return $this->belongsTo(Tipocambio::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
