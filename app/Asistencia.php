<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $guarded = [];  
    protected $fillable = ['asistencia','fecha','tiempo'];
    protected $table = 'asistencia';
    public $timestamps = false;
}
