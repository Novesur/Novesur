<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User  extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $fillable = ['firstanme', 'secondname', 'lastname', 'username', 'email', 'roles_id', 'almacen_id', 'password','gradousers_id','asistencia','zonal_id','dni'];
    use SoftDeletes;
    protected $table = 'users';
    protected $dates = ['deleted_at']; //Registramos la nueva columna


    public function roles()
    {
        return $this->belongsTo(Rol::class);
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }

    public function rolespermission()
    {
        return $this->belongsToMany(Rol::class, 'permission_user');
    }

    protected $appends = ['fullname'];

    public function getFullNameAttribute()
    {
        return "{$this->firstname}  {$this->secondname}  {$this->lastname} ";
    }
    public function gradousers()
    {
        return $this->belongsTo(Gradouser::class);
    }

    public function zonal()
    {
        return $this->belongsTo(Zonal::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
