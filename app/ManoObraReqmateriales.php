<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManoObraReqmateriales extends Model
{
    protected $table = 'manobra_reqmateriales';
    public $timestamps = false;
    use SoftDeletes;



}
