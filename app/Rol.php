<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';

    public function permission(){
        return $this->belongsToMany(Permission::class,'permission_rol');
    }


}
