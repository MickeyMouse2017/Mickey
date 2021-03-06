@if($ultimo_registroo!=0)

<script>
	ConteoRegresivo();
	function  ConteoRegresivo(){
		var countDownDate = new Date("{{$TurnoFinal}}").getTime();
		var x = setInterval(function() {
			var now = new Date().getTime();  
			var distance = countDownDate - now; 
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000); 

			$("#HoraFinalTurno").css("fontSize", 20);						
			$("#HoraFinalTurno").css("font-weight","Bold");		
			$('#HoraFinalTurno').text(+hours+':'+minutes+':'+seconds);
			// console.log('DISTANCIA: '+distance+' TURNO FINAL: '+"{{$TurnoFinal}}");
			if (distance < 0) {
				// console.log('ENTRO');
				clearInterval(x);  	
				$('#HoraFinalTurno').text('0:'+'0:'+'0');
				setTimeout('document.location.href = "{{ route('Index')}}"',1);
			}
		}, 1000);
	}
</script>

<form class="form-horizontal" enctype="multipart/form-data" id="id_formulario_consolidado" role="form" method="POST" action="">	
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- Para que no guarde en cache -->
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-cache">

	<div class="portlet box purple">
		<div class="portlet-title">
			<div class="caption"><h4>HOJA RUTA</h4></div>
			<div class="btn-group pull-right">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background: #007835;">
					<h4><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i> El turno se cerrara  en: <label id="HoraFinalTurno" name="HoraFinalTurno"></label></h4> 
				</div>
			</div>
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token()}}"> 
		<input type="hidden" name="id_asignacion"  id="id_asignacion" class="form-control" value="{{$id_asignacion}}">
		<input type="hidden" name="id_formulario"  id="id_formulario" class="form-control" value="{{$Num_formulario}}">
		<input type="hidden" name="fk_usuario"  id="fk_usuario" class="form-control" value="{{$id_usuario}}">
		<input type="hidden" name="turno_actual" id="turno_actual" value="{{$turno_actual}}">
		<input type="hidden" name="fk_formulario" id="fk_formulario" value="{{$fk_formulario}}">
		<input type="hidden" name="id_version_formulario" id="id_version_formulario" value="{{$id_version_formulario}}">
		<input type="hidden" name="estado_registro" id="estado_registro" value="{{$estado_registro}}">
		<div class="portlet-body">
			<div class="panel panel-success">
				<div class="panel-heading">					
				</div>
				<div class="panel-body">					
					<div class="col-sm-2">
						<i class="fa fa-calendar" aria-hidden="true"></i>
						<label>Fecha Turno:</label>
					</div>
					<div class="col-sm-4">
						<input type="text" name="fecha_turno" id="fecha_turno" class="form-control" value="{{$Fecha_Actual}}" readonly >
					</div>				
					<div class="col-sm-2">
						<i class="fa fa-book" aria-hidden="true"></i>
						<label>Formulario:</label>
					</div>
					<div class="col-sm-4">
						<input type="text" name="" class="form-control" value="{{$Nombre_Formulario}}" readonly>
					</div>
					<br>
					<br>
					<br>					
					<div class="col-sm-2">
						<i class="fa fa-user" aria-hidden="true"></i>
						<label>Nombre Equipo:</label>
					</div>
					<div class="col-sm-4">
						<input type="text" name="" class="form-control" value="{{strtoupper($NombreEquipo)}}" readonly>
					</div>				
					<div class="col-sm-2">
						<i class="fa fa-clock-o" aria-hidden="true"></i>
						<label>Turno:</label>
					</div>
					<div class="col-sm-4">
						<input type="text" name="" class="form-control" value="{{strtoupper($Nombre_Turno)}}" readonly>
					</div>
					<input type="hidden" name="fk_equipos" id="fk_equipos" class="form-control" value="{{$fk_equipos}}">
				</div>
			</div>

			<div class="table-scrollable">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th scope="col" style="width:300px !important; background: #16d6fc">
								<i class="fa fa-cogs" aria-hidden="true"></i>
								Parametros
							</th>
							<th scope="col" style="width:100px !important; background: #16d6fc">
								<i class="fa fa-sitemap" aria-hidden="true"></i>
								Unidad
							</th>
							<th scope="col" style="width:100px !important; background: #16d6fc">
								<i class="fa fa-table" aria-hidden="true"></i>
								Valor Minimo
							</th>
							<th scope="col" style="width:100px !important; background: #16d6fc">
								<i class="fa fa-table" aria-hidden="true"></i>
								Valor Ideal
							</th>							
							<th scope="col" style="width:100px !important; background: #16d6fc">
								<i class="fa fa-table" aria-hidden="true"></i>
								Valor Máximo
							</th>
							<th scope="col" style="width:250px !important; background: #16d6fc">
								<i class="fa fa-keyboard-o" aria-hidden="true"></i>
								Valor a ingresar
							</th>
						</tr>
					</thead>
					<tbody>
						<input type="hidden" value="{{$numero = 1}}">
						<input type="hidden" value="{{$numero2 = 1}}">
						<input type="hidden" value="{{$numero3 = 1}}">
						<input type="hidden" value="{{$numero6 = 1}}">
						@foreach ($Detalle_Formulario as $key => $value)
						<tr>
							<td>
								<strong>
									<font size ="3", color ="#243c98" face="Lucida Sans">{{$parametros_control=strtoupper($value->NombreParametro->nombre_parametro)}}
									</font>
								</strong>
							</td>
							<td>
								<strong>
									<font size ="3", color ="#243c98" face="Lucida Sans">
										{{$parametros_control=strtoupper($value->NombreUnidad->nombre_unidad)}}
									</font>
								</strong>
							</td>
							<td>
								<strong>
									<font size ="3", color ="#8e2a2a" face="Lucida Sans">
										{{$parametros_control=$value->valor_minimo}}
									</font>
								</strong>
							</td>
							<td>
								<strong>
									<font size ="3", color ="#8e2a2a" face="Lucida Sans">
										{{$parametros_control=$value->valor_ideal}}	
									</font>	
								</strong>						
							</td>
							<td>
								<strong>
									<font size ="3", color ="#8e2a2a" face="Lucida Sans">
										{{$parametros_control=$value->valor_maximo}}
									</font>
								</strong>
							</td>
							<td>
								<div class="panel panel-danger" style="display:none" id="mensaje_{{$numero2++}}">
									<div class="panel-heading" id="valida_{{$numero3++}}" style="display:none">
									</div>
								</div>
								<input type="number" name="variable_{{$numero++}}" id="variable_{{$numero6++}}" class="form-control">
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<button type="button" class="btn btn-circle blue BtnRegistrar">
				<strong> <font size ="2", color ="#f9f9f9"> <span class= "fa fa-floppy-o"></span></font></strong>
				<strong> <font size ="2", color ="#f9f9f9" face="Lucida Sans"><span>Guardar</span></font></strong>
			</button>
		</div>
	</div>		
</form>


@else
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<img src="global/images/No_Found_Formulario.png" alt="logo" class="img-thumbnail img-responsive" >	
</div>
@endif

