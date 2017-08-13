<?php

namespace MickeyMouse2017\Models\Formulario;

use Illuminate\Database\Eloquent\Model;
use MickeyMouse2017\Models\Usuarios\Usuario;
use MickeyMouse2017\Models\Equipos\Equipo;

class Encabezado_Formulario extends Model{

	protected $table = 'encabezado_formulario';
	public $timestamps = false;	


	public function Nombre_Equipo()	{		
		return $this->belongsto(Equipo::class,'fk_equipos');
	}


}
