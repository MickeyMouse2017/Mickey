<?php $__env->startSection('title'); ?>
Turnos
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<!-- <link rel="stylesheet" type="text/css" href="global/plugins/TimePicker/assets/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="global/plugins/TimePicker/assets/css/bootstrap.min.css"> -->

<link rel="stylesheet" type="text/css" href="global/plugins/TimePicker/dist/bootstrap-clockpicker.min.css">
<link rel="stylesheet" type="text/css" href="global/plugins/TimePicker/assets/css/github.min.css">

<style type="text/css">
	.clockpicker-popover {
		z-index: 999999 !important;
	}
</style>

<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<ul class="page-breadcrumb">
		<li>			
			<a href="<?php echo e(URL::route('Index')); ?>">Inicio</a>
			<i class="fa fa-angle-right"></i>
		</li>		
	</ul>
</div>


<div id="TablaTurnos"></div>

<!-- Modal Nuevo Turno -->
<div class="modal fade" id="ModalRegistrarNuevoTurno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title" style="color: #5bc0de"><i class="fa fa-file fa-3x" aria-hidden="true" style="color: #5bc0de"></i> Registrar Nuevo Turno</h4>
			</div>
			<div class="modal-body">

				<input type="text" name="NombreTurnoNuevo" id="NombreTurnoNuevo" class="form-control" placeholder="Ingrese el nombre del turno" style="text-align:center;border-radius: 4px; background: #ffffff; border: 3px solid #555; font-size:20px;height: 50px;">

				<!-- <div class="form-group"> -->
				<h4>Hora Inicial</h4>
				<div class="input-group clockpicker">
					<input type="text" class="form-control" value="<?php echo e(Carbon::now()->format('g:i A')); ?>" id="HoraInicialRegistrar" name="HoraInicialRegistrar">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-time"></span>
					</span>
				</div>					
				<!-- </div> -->
				<div class="form-group">
					<h4>Hora Final</h4>
					<div class="input-group clockpicker">
						<input type="text" class="form-control" value="<?php echo e(Carbon::now()->format('g:i A')); ?>" id="HoraFinalRegistrar" name="HoraFinalRegistrar">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-time"></span>
						</span>
					</div>					
				</div>
				<div class="modal-footer">				
					<button type="button" class="btn btn-primary RegistrarNuevoTurno">Guardar</button>
					<button type="button" class="btn btn-default CerrarFormularioRegistro" data-dismiss="modal">Cancelar</button>			
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		Listar_Tabla();

		function Listar_Tabla(){	

			$.ajax({
				type:'get',
				url:'Cargar_Tabla_Turnos',			
				success: function(respuesta){
					$('#TablaTurnos').empty().html(respuesta);				
				}
			});
		}

		$('body').delegate('.NuevoTurno','click',function(){

			$('#ModalRegistrarNuevoTurno').modal('show');
			$.getScript('global/plugins/TimePicker/dist/bootstrap-clockpicker.min.js', function( data, textStatus, jqxhr ) {
				$.getScript('global/plugins/TimePicker/assets/js/bootstrap.min.js', function( data, textStatus, jqxhr ) {
				});	
				var input = $('.clockpicker').clockpicker({
					placement: 'bottom',
					align: 'left',
					autoclose: true,
					'default': 'now'
				});

			});			
		});

		$('.CerrarFormularioRegistro').click(function(){
			$.getScript('global/plugins/bootstrap/js/bootstrap.min.js', function( data, textStatus, jqxhr ) {
			});
		});


		$('.RegistrarNuevoTurno').click(function(){
			var HoraInicialRegistrar=$('#HoraInicialRegistrar').val();
			console.log(HoraInicialRegistrar);
			var HoraFinalRegistrar=$('#HoraFinalRegistrar').val();
			console.log(HoraFinalRegistrar);
		});



// 		var input = $('#input-a');
// 		input.clockpicker({
// 			autoclose: true
// 		});

// // Manual operations
// $('#button-a').click(function(e){
//     // Have to stop propagation here
//     e.stopPropagation();
//     input.clockpicker('show')
//     .clockpicker('toggleView', 'minutes');
// });
// $('#button-b').click(function(e){
//     // Have to stop propagation here
//     e.stopPropagation();
//     input.clockpicker('show')
//     .clockpicker('toggleView', 'hours');
// });


</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>