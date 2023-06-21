<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    public function rol(){
        return $this->belongsToMany(Rol::class,'permission_rol');
    }
}
