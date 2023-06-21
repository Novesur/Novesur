<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    protected $table = 'kardex';

    protected $fillable =[
        'producto_id',
        'stock',
        'costunit',
        'diferencia'

    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);

    }

}
