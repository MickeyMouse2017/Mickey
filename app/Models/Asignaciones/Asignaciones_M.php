<?php

namespace MickeyMouse2017\Models\Asignaciones;

use Illuminate\Database\Eloquent\Model;
use MickeyMouse2017\Models\Turnos\Turnos_M;
use MickeyMouse2017\Models\Formulario\Encabezado_Formulario;
use MickeyMouse2017\Models\Usuarios\Usuario;
use MickeyMouse2017\Models\Equipos\Equipo;

class Asignaciones_M extends Model{

	protected $table = 'asignaciones';
	public $timestamps = false;	

	public function Nombre_Turno()	{		
		return $this->belongsto(Turnos_M::class,'fk_turno');
	}	

	public function Nombre_Formulario()	{		
		return $this->belongsto(Encabezado_Formulario::class,'fk_formulario');
	}

	public function Nombre_Usuario()	{		
		return $this->belongsto(Usuario::class,'fk_usuarios');
	}

	public function Nombre_Equipo()	{		
		return $this->belongsto(Equipo::class,'fk_maquina');
	}

}
