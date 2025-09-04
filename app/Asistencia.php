<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $guarded = [];
    protected $fillable = ['asistencia','fecha','tiempo','asistencia_estado_id','estado','sede_id','personal_id'];
    protected $table = 'asistencia';
    public $timestamps = false;


    public function personal(){
        return $this->belongsTo(Personal::class ,'asistencia','codigo')->with(["sede"]);
    }
}
