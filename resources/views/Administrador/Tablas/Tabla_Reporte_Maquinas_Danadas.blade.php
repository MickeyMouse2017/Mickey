 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="utf-8">
 	<title>REPORTE MAQUINA - PDF</title>
 	<link rel="stylesheet" href="global/PluginReportes/bootstrap.min.css" media="all" />
 	<link rel="stylesheet" href="global/PluginReportes/font-awesome.min.css" media="all" />
 	<link rel="shortcut icon" href="global/images/LogoEmpresa.ico"/>
 </head>
 <body>
 	<header class="clearfix">
 		<div id="logo">
 			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 				<center><img src="global/slider/FotosSucroal/Nuevas/1.jpeg" alt="logo" class="img-responsive" height="300" width="400"></center>
 				<br>	
 				<br> 
 				<br> 											 
 			</div>
 		</div>
 	</header>
 	<br>
 	<br>	
 	<br>
 	<br>
 	<br>	
 	<br>
 	<br>
 	<br>	
 	<br> 
 	<br> 	 				
 	<div class="panel panel-success">
 		<div class="panel-heading">
 			<h4><strong> Máquina: {{$NombreEquipo}}</strong></h4>
 		</div>
 		<div class="modal-body">
 			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5"> 				
 				<table>									
 					<tbody>
 						@foreach($Notificacion as $Maquina)	
 						<tr>
 							<td>
 								@if($Maquina->imagen_foto==null)						
 								<img src="global/images/error.png" width="200" height="200" border="2"/>
 								@elseif(File::exists($Maquina->imagen_foto))
 								<img src="{{$Maquina->imagen_foto}}" width="200" height="200" border="2"/>
 								@else
 								<img src="global/images/error.png" 	width="200" height="200" border="2"/>
 								@endif
 							</td>
 							<td>
 								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-md-offset-8">
 									<div class="panel panel-info">
 										<div class="panel-heading">	
 											<div class="form-group">
 												<strong>
 													<font size ="4", color="#0dc620" face="Tahoma">
 														Titulo Mensaje o Parametro:
 													</font>
 												</strong>
 												<div class="col-sm-9">
 													<font size ="4", color="#0b4f4b" face="Tahoma">
 														<label>{{$Maquina->titulo_mensaje}}</label>	
 													</font>
 												</div>
 											</div>
 											<div class="form-group">
 												<strong>
 													<font size ="4", color="#0dc620" face="Tahoma">
 														Mensaje:
 													</font>
 												</strong>
 												<div class="col-sm-9">
 													<font size ="4", color="#0b4f4b" face="Tahoma">
 														<label>{{$Maquina->mensaje}}</label>
 													</font>											
 												</div>
 											</div> 
 											<div class="form-group">
 												<strong>
 													<font size ="4", color="#0dc620" face="Tahoma">
 														Usuario:
 													</font>
 												</strong>
 												<div class="col-sm-9">
 													<font size ="4", color="#0b4f4b" face="Tahoma">
 														<label>{{ucfirst($Maquina->Nombre_Usuario->nombre_usuario)}} {{ucfirst($Maquina->Nombre_Usuario->apellido)}}</label>
 													</font>											
 												</div>
 											</div>
 											<div class="form-group">
 												<strong>
 													<font size ="4", color="#0dc620" face="Tahoma">
 														Fecha y hora:
 													</font>
 												</strong>
 												<div class="col-sm-9">
 													<font size ="4", color="#0b4f4b" face="Tahoma">
 														<label>											
 															El dia <strong>{{Carbon::parse($Maquina->	fecha_notificacion)->toDateString()}}</strong>
 															a las <strong>{{Carbon::parse($Maquina->hora_notificacion)->format('g:i A')}}</strong>
 														</label>
 													</font>											
 												</div> 												
 											</div>
 										</div>
 									</div>
 								</div>
 							</td> 							
 						</tr>
 						<tr>
 							<td>
 								<br>
 								<br>
 								<br>
 								<br>
 								<br>
 								<br>
 								<br>								
 							</td>
 						</tr>

 						@endforeach							
 					</tbody>	
 				</table>				
 			</div> 			
 		</div>
 	</div>
 </body>
 </html>












 <script src="global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
 <script src="global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>