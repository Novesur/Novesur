<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlatoExtra extends Model
{
    use SoftDeletes;
    protected $table = 'plato_extra';
}
