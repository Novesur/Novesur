<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Papeletasalida extends Model
{
    use SoftDeletes;
    protected $table = 'papeletasalida';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function motivopapeletasalida()
    {
        return $this->belongsTo(Motivopapeletasalida::class);
    }

    public function estadopapeletasalida()
    {
        return $this->belongsTo(EstadoPapeletaSalida::class);
    }




}
