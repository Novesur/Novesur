<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const ATENDIDO = 1;
    const PENDIENTE = 2;
}
