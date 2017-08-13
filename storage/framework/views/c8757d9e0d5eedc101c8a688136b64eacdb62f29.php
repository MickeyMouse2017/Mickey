<?php
date_default_timezone_set('America/Bogota');
use Carbon\Carbon;
header('Content-Type: text/html; charset=UTF-8'); 
?>
<?php if($Listar_Turnos->total()==0): ?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<img src="global/images/No_Found_Turnos.png" alt="logo" class="img-thumbnail img-responsive" >	
</div>
<?php else: ?>   
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">			
	<div class="row">                 
		<div class="col-lg-12">			
			<div class="table-responsive">
				<div class="panel panel-default">				
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-user-circle-o"></i> Listado de Turnos Registrados
							<div class="pull-right">
								<button type="button" class="btn btn-success NuevoTurno">
									<strong>
										<span class= "fa fa-file">
											<font size ="2", color ="#FFF" face="Corbel">
												Nuevo Turno
											</font>
										</span>												
									</strong>
								</button>
							</div>
						</h3>

					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>	
										<th><i class="fa fa-user-o" aria-hidden="true"></i> Nombre Turno</th>	
										<th><i class="fa fa-user-circle" aria-hidden="true"></i> Hora Inicio</th>										
										<th><i class="fa fa-envelope-o" aria-hidden="true"></i> Hora Fin </th>	
										<th><i class="fa fa-check-square" aria-hidden="true"></i> Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($Listar_Turnos as $value): ?>	
									<tr>
										<td>									
											<?php echo e(ucfirst($value->nombre_turno)); ?>																						
										</td>	
										<td>
											<center>
												<span class="badge btn-md btn-success" style="height: 25px;background-color: #0b62a0; color: #FFF">
													<b>
														<strong>
															<font size ="4">
																<?php echo e(Carbon::parse($value->hora_inicio)->format('g:i A')); ?> 
															</font>
														</strong>
													</b>
												</span>	
											</center>					
										</td>
										<td>
											<center>
												<span class="badge btn-md btn-success" style="height: 25px;background-color: #0b62a0; color: #FFF">
													<b>
														<strong>
															<font size ="4">
																<?php echo e(Carbon::parse($value->hora_fin)->format('g:i A')); ?>

															</font>
														</strong>
													</b>
												</span>	
											</center>					
										</td>
										<td>
											<center>
												<button type="button" class="btn btn-info EditarTurno">
													<strong>
														<span class= "fa fa-pencil">
															<font size ="4", color ="#FFF" face="Corbel">
																Editar
															</font>
														</span>												
													</strong>
												</button>
											</center>
										</td>										
									</tr>
									<?php endforeach; ?>													
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<center><?php echo e($Listar_Turnos->links()); ?></center>	
			</div>
			<div class="panel-footer">Total Registros: <?php echo e($Listar_Turnos->total()); ?></div>
		</div>
	</div>
	<?php endif; ?>