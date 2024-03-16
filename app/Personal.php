<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal extends Model
{
    protected $table = 'personal';
    use SoftDeletes;

    public function cargo()
    {
        return $this->belongsTo(Cargo::class,"cargo_personal_id");
    }

    public function zonal()
    {
        return $this->belongsTo(Zonal::class); 
    }

    public function asistencias(){
        return $this->hasMany(Asistencia::class ,'asistencia','codigo');
    }


}
