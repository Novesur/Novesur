<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlatoEntrada extends Model
{
    use SoftDeletes;
    protected $table = 'plato_entrada';
}
