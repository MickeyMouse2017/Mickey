<?php $__env->startSection('title'); ?>
Menú Principal
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo e(URL::route('Index')); ?>">Inicio</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Panel de Inicio</a>			
		</li>
	</ul>	
</div>
<br>
<br>
<br>
<div class="panel panel-primary">
	<div class="panel-heading" align="left">
		<h3 class="panel-title">
			Bienvenido a <strong>TpmMovil APP</strong>			
		</h3>
	</div>
	<div class="panel-body">		
		<div class="col-lg-6">
			<label id="TipoMensaje" style="display: block; text-align: center;"></label>	
			<select  class="form-control selectpicker id_ruta_seleccionada" data-live-search="true" id="id_ruta_seleccionada"  name="id_ruta_seleccionada" onchange="Cargar_Formulario_Combobox();" >
				<option></option>
			</select>
		</div>
	</div>
</div>
<div class="panel panel-danger" style="display: none;" id="estilo_mensaje_registro">
	<div class="panel-heading" id="id_validacion_registro" style="display:none">
	</div>
</div>
<div class="row">
	<div class="col-md-12">		
		<div class="panel panel-default EstiloMensajeSinInactividad pulsate-regular
		pulsate-regular" id="pulsate-regular" style="display: none;text-align: right;">
		<div class="panel-heading MensajeSinInactividad" style="display: none;" >
		</div>
	</div>	
	<!-- Begin: life time stats -->
	<div class="portlet light" id="diseno_tabla" style="display: none;" >
		<div class="portlet-title">			
			<div class="caption">
				<i class="fa fa-plus-circle font-green-sharp"></i>
				<span class="caption-subject font-green-sharp bold uppercase">
					REGISTRO DE RUTAS </span>
					<span class="caption-helper"></span>
				</div>				
			</div>
			<div class="portlet-body">
				<div class="tabbable">
					<ul class="nav nav-tabs nav-tabs-lg">
						<!-- <li class="active"> -->
						<a href="#pestaña_registro" data-toggle="tab">
						</a>
						<!-- </li> -->
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="pestaña_registro">
						</div>
						<div class="tab-pane" id="pestaña_detalle">
						</div>
						<div class="tab-pane" id="pestaña_consolidado">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Confirmar -->
<div class="modal fade" id="ModalRegistrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<font size ="4", color ="#243c98" face="Lucida Sans">
						Esperando Confirmación...
					</font>
				</h4>
			</div>
			<div class="modal-body">
				<font size ="4", color ="#8e2a2a" face="Lucida Sans">
					¿ Esta seguro de guardar la información ingresada ?
				</font>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary BtnRegistrarDatos">SI</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	
	CargarDatosCombobox();
	// Tiempo_Inactividad=setTimeout('$("#id_ruta_seleccionada").val("").selectpicker("refresh")',500);


	function CargarDatosCombobox(){
		$el =$('#id_ruta_seleccionada');
		$.ajax({
			type:'get',
			url:'<?php echo e(url('Consultar_Rutas_Empleado')); ?>',
			success: function(data){
				$('#TipoMensaje').html('<center>HOLA, '+'<?php echo e(Auth::user()->nombre_usuario); ?> <?php echo e(Auth::user()->apellido); ?>, '+data.MensajeVista+'</center>');
				$("#TipoMensaje").css("fontSize" ,15);						
				$("#TipoMensaje").css("font-weight","Bold"); 

				var option = $('<option />');
				$.each(data.DatosTurno, function(key,value) {
					$el.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options = $('.id_ruta_seleccionada option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});
			}
		});		
	}

	function Cargar_Formulario_Combobox(){
		var id_formulario_turno= document.getElementById("id_ruta_seleccionada").value;	
		if(id_formulario_turno!=0){
			Cargar_Formulario();
			$('#diseno_tabla').show();
		}else{
			$('#diseno_tabla').hide();
		}

	}

	// function Cargar_Formulario(){
	// 	var id_formulario_turno= document.getElementById("id_ruta_seleccionada").value;	

	// 	$.ajax({
	// 		type:'get',
	// 		url:'<?php echo e(url('Consultar_Turno')); ?>',
	// 		data: {
	// 			'id_formulario_turno': id_formulario_turno
	// 		},
	// 		success: function(data){
	// 			$('#pestaña_registro').empty().html(data);
	// 		}
	// 	});
	// }



	function Cargar_Formulario(){
		var id_formulario_turno= document.getElementById("id_ruta_seleccionada").value;	

		$.ajax({
			type:'get',
			url:'<?php echo e(url('Cargar_Formulario')); ?>',
			data: {
				'id_formulario_turno': id_formulario_turno
			},
			success: function(data){
				$('#pestaña_registro').empty().html(data);
			}
		});
	}

	function Validar_Vacios(){
		var variable_1=$('#variable_1').val();
		var variable_2=$('#variable_2').val();
		var variable_3=$('#variable_3').val();
		var variable_4=$('#variable_4').val();
		var variable_5=$('#variable_5').val();
		var variable_6=$('#variable_6').val();
		var variable_7=$('#variable_7').val();
		var variable_8=$('#variable_8').val();
		var variable_9=$('#variable_9').val();
		var variable_10=$('#variable_10').val();
		var variable_11=$('#variable_11').val();
		var variable_12=$('#variable_12').val();
		var variable_13=$('#variable_13').val();
		var variable_14=$('#variable_14').val();
		var variable_15=$('#variable_15').val();
		var variable_16=$('#variable_16').val();
		var variable_17=$('#variable_17').val();
		var variable_18=$('#variable_18').val();
		var variable_19=$('#variable_19').val();
		var variable_20=$('#variable_20').val();
		var variable_21=$('#variable_21').val();
		var variable_22=$('#variable_22').val();
		var variable_23=$('#variable_23').val();
		var variable_24=$('#variable_24').val();
		var variable_25=$('#variable_25').val();
		var variable_26=$('#variable_26').val();
		var variable_27=$('#variable_27').val();
		var variable_28=$('#variable_28').val();
		var variable_29=$('#variable_29').val();
		var variable_30=$('#variable_30').val();
		var variable_31=$('#variable_31').val();
		var variable_32=$('#variable_32').val();
		var variable_33=$('#variable_33').val();
		var variable_34=$('#variable_34').val();
		var variable_35=$('#variable_35').val();
		var variable_36=$('#variable_36').val();
		var variable_37=$('#variable_37').val();
		var variable_38=$('#variable_38').val();
		var variable_39=$('#variable_39').val();
		var variable_40=$('#variable_40').val();
		

		if(variable_1==""){
			$('#valida_1').html('');
			$("#valida_1").css("fontSize", 15);						
			$("#valida_1").css("font-weight","Bold"); 	
			$("#mensaje_1").attr("class", "panel panel-danger");
			$('#mensaje_1').show();			
			$('#valida_1').html('Este campo no puede estar vacio.');
			$('#valida_1').show();	
			$('#variable_1').val('');		
			document.getElementById("variable_1").focus();
			return true;
		}else if(variable_2==""){
			$('#mensaje_1').hide();									
			$('#valida_2').html('');
			$("#valida_2").css("fontSize", 15);						
			$("#valida_2").css("font-weight","Bold"); 	
			$("#mensaje_2").attr("class", "panel panel-danger");
			$('#mensaje_2').show();			
			$('#valida_2').html('Este campo no puede estar vacio.');
			$('#valida_2').show();	
			$('#variable_2').val('');		
			document.getElementById("variable_2").focus();
			return true;
		}else if(variable_3==""){
			$('#mensaje_2').hide();									
			$('#valida_3').html('');
			$("#valida_3").css("fontSize", 15);						
			$("#valida_3").css("font-weight","Bold"); 	
			$("#mensaje_3").attr("class", "panel panel-danger");
			$('#mensaje_3').show();			
			$('#valida_3').html('Este campo no puede estar vacio.');
			$('#valida_3').show();	
			$('#variable_3').val('');		
			document.getElementById("variable_3").focus();
			return true;
		}else if(variable_4==""){
			$('#mensaje_3').hide();									
			$('#valida_4').html('');
			$("#valida_4").css("fontSize", 15);						
			$("#valida_4").css("font-weight","Bold"); 	
			$("#mensaje_4").attr("class", "panel panel-danger");
			$('#mensaje_4').show();			
			$('#valida_4').html('Este campo no puede estar vacio.');
			$('#valida_4').show();	
			$('#variable_4').val('');		
			document.getElementById("variable_4").focus();
			return true;
		}else if(variable_5==""){
			$('#mensaje_4').hide();									
			$('#valida_5').html('');
			$("#valida_5").css("fontSize", 15);						
			$("#valida_5").css("font-weight","Bold"); 	
			$("#mensaje_5").attr("class", "panel panel-danger");
			$('#mensaje_5').show();			
			$('#valida_5').html('Este campo no puede estar vacio.');
			$('#valida_5').show();	
			$('#variable_5').val('');		
			document.getElementById("variable_5").focus();
			return true;
		}else if(variable_6==""){
			$('#mensaje_5').hide();									
			$('#valida_6').html('');
			$("#valida_6").css("fontSize", 15);						
			$("#valida_6").css("font-weight","Bold"); 	
			$("#mensaje_6").attr("class", "panel panel-danger");
			$('#mensaje_6').show();			
			$('#valida_6').html('Este campo no puede estar vacio.');
			$('#valida_6').show();	
			$('#variable_6').val('');		
			document.getElementById("variable_6").focus();
			return true;
		}else if(variable_7==""){
			$('#mensaje_6').hide();									
			$('#valida_7').html('');
			$("#valida_7").css("fontSize", 15);						
			$("#valida_7").css("font-weight","Bold"); 	
			$("#mensaje_7").attr("class", "panel panel-danger");
			$('#mensaje_7').show();			
			$('#valida_7').html('Este campo no puede estar vacio.');
			$('#valida_7').show();	
			$('#variable_7').val('');		
			document.getElementById("variable_7").focus();
			return true;
		}else if(variable_8==""){
			$('#mensaje_7').hide();									
			$('#valida_8').html('');
			$("#valida_8").css("fontSize", 15);						
			$("#valida_8").css("font-weight","Bold"); 	
			$("#mensaje_8").attr("class", "panel panel-danger");
			$('#mensaje_8').show();			
			$('#valida_8').html('Este campo no puede estar vacio.');
			$('#valida_8').show();	
			$('#variable_8').val('');		
			document.getElementById("variable_8").focus();
			return true;	
		}else if(variable_9==""){
			$('#mensaje_8').hide();									
			$('#valida_9').html('');
			$("#valida_9").css("fontSize", 15);						
			$("#valida_9").css("font-weight","Bold"); 	
			$("#mensaje_9").attr("class", "panel panel-danger");
			$('#mensaje_9').show();			
			$('#valida_9').html('Este campo no puede estar vacio.');
			$('#valida_9').show();	
			$('#variable_9').val('');		
			document.getElementById("variable_9").focus();
			return true;
		}else if(variable_10==""){
			$('#mensaje_9').hide();									
			$('#valida_10').html('');
			$("#valida_10").css("fontSize", 15);						
			$("#valida_10").css("font-weight","Bold"); 	
			$("#mensaje_10").attr("class", "panel panel-danger");
			$('#mensaje_10').show();			
			$('#valida_10').html('Este campo no puede estar vacio.');
			$('#valida_10').show();	
			$('#variable_10').val('');		
			document.getElementById("variable_10").focus();
			return true;
		}else if(variable_11==""){
			$('#mensaje_10').hide();									
			$('#valida_11').html('');
			$("#valida_11").css("fontSize", 15);						
			$("#valida_11").css("font-weight","Bold"); 	
			$("#mensaje_11").attr("class", "panel panel-danger");
			$('#mensaje_11').show();			
			$('#valida_11').html('Este campo no puede estar vacio.');
			$('#valida_11').show();	
			$('#variable_11').val('');		
			document.getElementById("variable_11").focus();
			return true;
		}else if(variable_12==""){
			$('#mensaje_11').hide();									
			$('#valida_12').html('');
			$("#valida_12").css("fontSize", 15);						
			$("#valida_12").css("font-weight","Bold"); 	
			$("#mensaje_12").attr("class", "panel panel-danger");
			$('#mensaje_12').show();			
			$('#valida_12').html('Este campo no puede estar vacio.');
			$('#valida_12').show();	
			$('#variable_12').val('');		
			document.getElementById("variable_12").focus();
			return true;
		}else if(variable_13==""){
			$('#mensaje_12').hide();									
			$('#valida_13').html('');
			$("#valida_13").css("fontSize", 15);						
			$("#valida_13").css("font-weight","Bold"); 	
			$("#mensaje_13").attr("class", "panel panel-danger");
			$('#mensaje_13').show();			
			$('#valida_13').html('Este campo no puede estar vacio.');
			$('#valida_13').show();	
			$('#variable_13').val('');		
			document.getElementById("variable_13").focus();
			return true;
		}else if(variable_14==""){
			$('#mensaje_13').hide();									
			$('#valida_14').html('');
			$("#valida_14").css("fontSize", 15);						
			$("#valida_14").css("font-weight","Bold"); 	
			$("#mensaje_14").attr("class", "panel panel-danger");
			$('#mensaje_14').show();			
			$('#valida_14').html('Este campo no puede estar vacio.');
			$('#valida_14').show();	
			$('#variable_14').val('');		
			document.getElementById("variable_14").focus();
			return true;
		}else if(variable_15==""){
			$('#mensaje_14').hide();									
			$('#valida_15').html('');
			$("#valida_15").css("fontSize", 15);						
			$("#valida_15").css("font-weight","Bold"); 	
			$("#mensaje_15").attr("class", "panel panel-danger");
			$('#mensaje_15').show();			
			$('#valida_15').html('Este campo no puede estar vacio.');
			$('#valida_15').show();	
			$('#variable_15').val('');		
			document.getElementById("variable_15").focus();
			return true;
		}else if(variable_16==""){
			$('#mensaje_15').hide();									
			$('#valida_16').html('');
			$("#valida_16").css("fontSize", 15);						
			$("#valida_16").css("font-weight","Bold"); 	
			$("#mensaje_16").attr("class", "panel panel-danger");
			$('#mensaje_16').show();			
			$('#valida_16').html('Este campo no puede estar vacio.');
			$('#valida_16').show();	
			$('#variable_16').val('');		
			document.getElementById("variable_16").focus();
			return true;
		}else if(variable_17==""){
			$('#mensaje_16').hide();									
			$('#valida_17').html('');
			$("#valida_17").css("fontSize", 15);						
			$("#valida_17").css("font-weight","Bold"); 	
			$("#mensaje_17").attr("class", "panel panel-danger");
			$('#mensaje_17').show();			
			$('#valida_17').html('Este campo no puede estar vacio.');
			$('#valida_17').show();	
			$('#variable_17').val('');		
			document.getElementById("variable_17").focus();
			return true;
		}else if(variable_18==""){
			$('#mensaje_17').hide();									
			$('#valida_18').html('');
			$("#valida_18").css("fontSize", 15);						
			$("#valida_18").css("font-weight","Bold"); 	
			$("#mensaje_18").attr("class", "panel panel-danger");
			$('#mensaje_18').show();			
			$('#valida_18').html('Este campo no puede estar vacio.');
			$('#valida_18').show();	
			$('#variable_18').val('');		
			document.getElementById("variable_18").focus();
			return true;
		}else if(variable_19==""){
			$('#mensaje_18').hide();									
			$('#valida_19').html('');
			$("#valida_19").css("fontSize", 15);						
			$("#valida_19").css("font-weight","Bold"); 	
			$("#mensaje_19").attr("class", "panel panel-danger");
			$('#mensaje_19').show();			
			$('#valida_19').html('Este campo no puede estar vacio.');
			$('#valida_19').show();	
			$('#variable_19').val('');		
			document.getElementById("variable_19").focus();
			return true;
		}else if(variable_20==""){
			$('#mensaje_19').hide();									
			$('#valida_20').html('');
			$("#valida_20").css("fontSize", 15);						
			$("#valida_20").css("font-weight","Bold"); 	
			$("#mensaje_20").attr("class", "panel panel-danger");
			$('#mensaje_20').show();			
			$('#valida_20').html('Este campo no puede estar vacio.');
			$('#valida_20').show();	
			$('#variable_20').val('');		
			document.getElementById("variable_20").focus();
			return true;
		}else if(variable_21==""){
			$('#mensaje_20').hide();									
			$('#valida_21').html('');
			$("#valida_21").css("fontSize", 15);						
			$("#valida_21").css("font-weight","Bold"); 	
			$("#mensaje_21").attr("class", "panel panel-danger");
			$('#mensaje_21').show();			
			$('#valida_21').html('Este campo no puede estar vacio.');
			$('#valida_21').show();	
			$('#variable_21').val('');		
			document.getElementById("variable_21").focus();
			return true;
		}else if(variable_22==""){
			$('#mensaje_21').hide();									
			$('#valida_22').html('');
			$("#valida_22").css("fontSize", 15);						
			$("#valida_22").css("font-weight","Bold"); 	
			$("#mensaje_22").attr("class", "panel panel-danger");
			$('#mensaje_22').show();			
			$('#valida_22').html('Este campo no puede estar vacio.');
			$('#valida_22').show();	
			$('#variable_22').val('');		
			document.getElementById("variable_22").focus();
			return true;
		}else if(variable_23==""){
			$('#mensaje_22').hide();									
			$('#valida_23').html('');
			$("#valida_23").css("fontSize", 15);						
			$("#valida_23").css("font-weight","Bold"); 	
			$("#mensaje_23").attr("class", "panel panel-danger");
			$('#mensaje_23').show();			
			$('#valida_23').html('Este campo no puede estar vacio.');
			$('#valida_23').show();	
			$('#variable_23').val('');		
			document.getElementById("variable_23").focus();
			return true;
		}else if(variable_24==""){
			$('#mensaje_23').hide();									
			$('#valida_24').html('');
			$("#valida_24").css("fontSize", 15);						
			$("#valida_24").css("font-weight","Bold"); 	
			$("#mensaje_24").attr("class", "panel panel-danger");
			$('#mensaje_24').show();			
			$('#valida_24').html('Este campo no puede estar vacio.');
			$('#valida_24').show();	
			$('#variable_24').val('');		
			document.getElementById("variable_24").focus();
			return true;
		}else if(variable_25==""){
			$('#mensaje_24').hide();									
			$('#valida_25').html('');
			$("#valida_25").css("fontSize", 15);						
			$("#valida_25").css("font-weight","Bold"); 	
			$("#mensaje_25").attr("class", "panel panel-danger");
			$('#mensaje_25').show();			
			$('#valida_25').html('Este campo no puede estar vacio.');
			$('#valida_25').show();	
			$('#variable_25').val('');		
			document.getElementById("variable_25").focus();
			return true;
		}else if(variable_26==""){
			$('#mensaje_25').hide();									
			$('#valida_26').html('');
			$("#valida_26").css("fontSize", 15);						
			$("#valida_26").css("font-weight","Bold"); 	
			$("#mensaje_26").attr("class", "panel panel-danger");
			$('#mensaje_26').show();			
			$('#valida_26').html('Este campo no puede estar vacio.');
			$('#valida_26').show();	
			$('#variable_26').val('');		
			document.getElementById("variable_26").focus();
			return true;
		}else if(variable_27==""){
			$('#mensaje_26').hide();									
			$('#valida_27').html('');
			$("#valida_27").css("fontSize", 15);						
			$("#valida_27").css("font-weight","Bold"); 	
			$("#mensaje_27").attr("class", "panel panel-danger");
			$('#mensaje_27').show();			
			$('#valida_27').html('Este campo no puede estar vacio.');
			$('#valida_27').show();	
			$('#variable_27').val('');		
			document.getElementById("variable_27").focus();
			return true;
		}else if(variable_28==""){
			$('#mensaje_27').hide();									
			$('#valida_28').html('');
			$("#valida_28").css("fontSize", 15);						
			$("#valida_28").css("font-weight","Bold"); 	
			$("#mensaje_28").attr("class", "panel panel-danger");
			$('#mensaje_28').show();			
			$('#valida_28').html('Este campo no puede estar vacio.');
			$('#valida_28').show();	
			$('#variable_28').val('');		
			document.getElementById("variable_28").focus();
			return true;
		}else if(variable_29==""){
			$('#mensaje_28').hide();									
			$('#valida_29').html('');
			$("#valida_29").css("fontSize", 15);						
			$("#valida_29").css("font-weight","Bold"); 	
			$("#mensaje_29").attr("class", "panel panel-danger");
			$('#mensaje_29').show();			
			$('#valida_29').html('Este campo no puede estar vacio.');
			$('#valida_29').show();	
			$('#variable_29').val('');		
			document.getElementById("variable_29").focus();
			return true;
		}else if(variable_30==""){
			$('#mensaje_29').hide();									
			$('#valida_30').html('');
			$("#valida_30").css("fontSize", 15);						
			$("#valida_30").css("font-weight","Bold"); 	
			$("#mensaje_30").attr("class", "panel panel-danger");
			$('#mensaje_30').show();			
			$('#valida_30').html('Este campo no puede estar vacio.');
			$('#valida_30').show();	
			$('#variable_30').val('');		
			document.getElementById("variable_30").focus();
			return true;
		}else if(variable_31==""){
			$('#mensaje_30').hide();									
			$('#valida_31').html('');
			$("#valida_31").css("fontSize", 15);						
			$("#valida_31").css("font-weight","Bold"); 	
			$("#mensaje_31").attr("class", "panel panel-danger");
			$('#mensaje_31').show();			
			$('#valida_31').html('Este campo no puede estar vacio.');
			$('#valida_31').show();	
			$('#variable_31').val('');		
			document.getElementById("variable_31").focus();
			return true;
		}else if(variable_32==""){
			$('#mensaje_31').hide();									
			$('#valida_32').html('');
			$("#valida_32").css("fontSize", 15);						
			$("#valida_32").css("font-weight","Bold"); 	
			$("#mensaje_32").attr("class", "panel panel-danger");
			$('#mensaje_32').show();			
			$('#valida_32').html('Este campo no puede estar vacio.');
			$('#valida_32').show();	
			$('#variable_32').val('');		
			document.getElementById("variable_32").focus();
			return true;
		}else if(variable_33==""){
			$('#mensaje_32').hide();									
			$('#valida_33').html('');
			$("#valida_33").css("fontSize", 15);						
			$("#valida_33").css("font-weight","Bold"); 	
			$("#mensaje_33").attr("class", "panel panel-danger");
			$('#mensaje_33').show();			
			$('#valida_33').html('Este campo no puede estar vacio.');
			$('#valida_33').show();	
			$('#variable_33').val('');		
			document.getElementById("variable_33").focus();
			return true;
		}else if(variable_34==""){
			$('#mensaje_33').hide();									
			$('#valida_34').html('');
			$("#valida_34").css("fontSize", 15);						
			$("#valida_34").css("font-weight","Bold"); 	
			$("#mensaje_34").attr("class", "panel panel-danger");
			$('#mensaje_34').show();			
			$('#valida_34').html('Este campo no puede estar vacio.');
			$('#valida_34').show();	
			$('#variable_34').val('');		
			document.getElementById("variable_34").focus();
			return true;
		}else if(variable_35==""){
			$('#mensaje_34').hide();									
			$('#valida_35').html('');
			$("#valida_35").css("fontSize", 15);						
			$("#valida_35").css("font-weight","Bold"); 	
			$("#mensaje_35").attr("class", "panel panel-danger");
			$('#mensaje_35').show();			
			$('#valida_35').html('Este campo no puede estar vacio.');
			$('#valida_35').show();	
			$('#variable_35').val('');		
			document.getElementById("variable_35").focus();
			return true;
		}else if(variable_36==""){
			$('#mensaje_35').hide();									
			$('#valida_36').html('');
			$("#valida_36").css("fontSize", 15);						
			$("#valida_36").css("font-weight","Bold"); 	
			$("#mensaje_36").attr("class", "panel panel-danger");
			$('#mensaje_36').show();			
			$('#valida_36').html('Este campo no puede estar vacio.');
			$('#valida_36').show();	
			$('#variable_36').val('');		
			document.getElementById("variable_36").focus();
			return true;
		}else if(variable_37==""){
			$('#mensaje_36').hide();									
			$('#valida_37').html('');
			$("#valida_37").css("fontSize", 15);						
			$("#valida_37").css("font-weight","Bold"); 	
			$("#mensaje_37").attr("class", "panel panel-danger");
			$('#mensaje_37').show();			
			$('#valida_37').html('Este campo no puede estar vacio.');
			$('#valida_37').show();	
			$('#variable_37').val('');		
			document.getElementById("variable_37").focus();
			return true;
		}else if(variable_38==""){
			$('#mensaje_37').hide();									
			$('#valida_38').html('');
			$("#valida_38").css("fontSize", 15);						
			$("#valida_38").css("font-weight","Bold"); 	
			$("#mensaje_38").attr("class", "panel panel-danger");
			$('#mensaje_38').show();			
			$('#valida_38').html('Este campo no puede estar vacio.');
			$('#valida_38').show();	
			$('#variable_38').val('');		
			document.getElementById("variable_38").focus();
			return true;
		}else if(variable_39==""){
			$('#mensaje_38').hide();									
			$('#valida_39').html('');
			$("#valida_39").css("fontSize", 15);						
			$("#valida_39").css("font-weight","Bold"); 	
			$("#mensaje_39").attr("class", "panel panel-danger");
			$('#mensaje_39').show();			
			$('#valida_39').html('Este campo no puede estar vacio.');
			$('#valida_39').show();	
			$('#variable_39').val('');		
			document.getElementById("variable_39").focus();
			return true;
		}else if(variable_40==""){
			$('#mensaje_39').hide();									
			$('#valida_40').html('');
			$("#valida_40").css("fontSize", 15);						
			$("#valida_40").css("font-weight","Bold"); 	
			$("#mensaje_40").attr("class", "panel panel-danger");
			$('#mensaje_40').show();			
			$('#valida_40').html('Este campo no puede estar vacio.');
			$('#valida_40').show();	
			$('#variable_40').val('');		
			document.getElementById("variable_40").focus();
			return true;
		}else{
			$('#mensaje_1').hide();
			$('#mensaje_2').hide();
			$('#mensaje_3').hide();
			$('#mensaje_4').hide();
			$('#mensaje_5').hide();
			$('#mensaje_6').hide();
			$('#mensaje_7').hide();
			$('#mensaje_8').hide();
			$('#mensaje_9').hide();
			$('#mensaje_10').hide();
			$('#mensaje_11').hide();
			$('#mensaje_12').hide();
			$('#mensaje_13').hide();
			$('#mensaje_14').hide();
			$('#mensaje_15').hide();
			$('#mensaje_16').hide();
			$('#mensaje_17').hide();
			$('#mensaje_18').hide();
			$('#mensaje_19').hide();
			$('#mensaje_20').hide();
			$('#mensaje_21').hide();
			$('#mensaje_22').hide();
			$('#mensaje_23').hide();
			$('#mensaje_24').hide();
			$('#mensaje_25').hide();
			$('#mensaje_26').hide();
			$('#mensaje_27').hide();
			$('#mensaje_28').hide();
			$('#mensaje_29').hide();
			$('#mensaje_30').hide();
			$('#mensaje_31').hide();
			$('#mensaje_32').hide();
			$('#mensaje_33').hide();
			$('#mensaje_34').hide();
			$('#mensaje_35').hide();
			$('#mensaje_36').hide();
			$('#mensaje_37').hide();
			$('#mensaje_38').hide();
			$('#mensaje_39').hide();
			$('#mensaje_40').hide();
			return false;
		}
	}


	$('body').delegate('.BtnRegistrar','click',function(){								
		if(Validar_Vacios()!==true){
			$('#ModalRegistrar').modal('show');
			$('.BtnRegistrarDatos').click(function(){
				$.ajax({
					url:'Registrar_Consolidado',
					data:new FormData($("#id_formulario_consolidado")[0]),
					dataType:'json',
					async:false,
					type:'post',
					processData: false,
					contentType: false,
					success:function(respuesta){											
						if(respuesta==0){
							$('#ModalRegistrar').modal('hide');
							$("#estilo_mensaje_registro").attr("class", "panel panel-success");
							$('#id_validacion_registro').html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> La ruta se registró con éxito!!');
							$("#id_validacion_registro").css("fontSize", 20);					
							$("#id_validacion_registro").css("font-weight","Bold"); 		
							$('#estilo_mensaje_registro').show();
							$('#id_validacion_registro').show();
							$("#estilo_mensaje_registro").fadeTo(4500, 500).slideUp(500, function(){
								$("#estilo_mensaje_registro").hide();												
							});	
							$('#diseno_tabla').hide();
							$("#id_ruta_seleccionada").val("").selectpicker("refresh");
						}			
					}
				});
			});
		}
	});	
</script>	

<script src="global/scripts/Pulso.js"></script>
<script type="text/javascript">
	$("#pulsate-regular").pulsate({color:"#ee000c"});						
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>