<?php

namespace MickeyMouse2017;

use Illuminate\Foundation\Auth\User as Authenticatable;
use MickeyMouse2017\Models\Roles\Roles;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public function Nombre_Rol()    {       
        return $this->belongsto(Roles::class,'fk_rol');
    }
    
}
