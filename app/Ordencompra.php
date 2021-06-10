<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordencompra extends Model
{
    const ATENDIDO = 1;
    const PENDIENTE = 2;
    protected $table = 'ordencompras';
}
