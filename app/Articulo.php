<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulo';

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }
    public function catarticulo()
    {
        return $this->belongsTo(CatArticulo::class);
    }
    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
