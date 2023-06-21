<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';


    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }



}
