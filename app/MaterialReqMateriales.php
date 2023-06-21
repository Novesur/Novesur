<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialReqMateriales extends Model
{
    protected $table = 'material_reqmateriales';
    
   
    public $timestamps = false;
    use SoftDeletes;
    

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }
}
