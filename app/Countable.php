<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countable extends Model
{
    protected $table = 'countable';
    public $timestamps = false;
}
