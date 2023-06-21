<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';


    protected $fillable =[
        'familia_id',
        'marca_id',
        'materia_id',
        'estado_id',

    ];

    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
    public function modelotipo()
    {
        return $this->belongsTo(Modelotipo::class);
    }
    public function subfamilia()
    {
        return $this->belongsTo(Subfamilia::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoProducto::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kardex()
    {
        return $this->hasOne(kardex::class);
    }

    public function homologacion(){
        return $this->belongsTo(Homologacion::class);
    }
}

