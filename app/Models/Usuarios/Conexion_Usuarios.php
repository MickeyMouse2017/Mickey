<?php

namespace MickeyMouse2017\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;
use MickeyMouse2017\Models\Usuarios\Usuario;

class Conexion_Usuarios extends Model
{
	protected $table = 'conexiones_usuarios';
	public $timestamps = false;	


	
	public function CodigoUsuario()	{		
		return $this->belongsto(Usuario::class,'fk_usuario');
	}
	
}
