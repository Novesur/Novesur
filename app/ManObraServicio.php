<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManObraServicio extends Model
{
    protected $table = 'manobra_servicio';
    public $timestamps = false;
    use SoftDeletes;
}
