<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Menu extends Model
{
    use SoftDeletes;
    protected $table = 'menu';

    protected $fillable =[
        'user_id',
        'fecha',
        'hora',
        'tipomenu_id',
        'observacion',
    ];

    public function tipomenu()
    {
        return $this->belongsTo(TipoMenu::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
