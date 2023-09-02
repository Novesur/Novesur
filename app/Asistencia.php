<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $guarded = [];  
    protected $fillable = ['asistencia','fecha','tiempo','asistencia_estado_id','estado'];
    protected $table = 'asistencia';
    public $timestamps = false;
}
