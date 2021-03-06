@extends('layouts.master')
@section('title')
Notificaciones
@stop
@section('content')
<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="#">Inicio</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<i class="fa fa-bell" aria-hidden="true"></i>
			<a href="{{URL::route('Notificaciones')}}">Notificaciones</a>
		</li>
		<li>			
			<i class="fa fa-search" aria-hidden="true"></i>
			<a href="#" class="NotificacionesAnteriores">Notificaciones Anteriores</a>
		</li>
	</ul>
</div>
<div id="Tabla_Notificaciones">	
</div>

<script type="text/javascript">
	Cargar_Notificaciones_Tabla();
	function Cargar_Notificaciones_Tabla(){
		$.ajax({
			type:'get',
			url:'{{ url('Tabla_Notificaciones')}}',
			success: function(data){ 
				$('#Tabla_Notificaciones').empty().html(data);

			}         
		});

		$(document).on("click",".pagination li a",function(e) {
			e.preventDefault();   
			var url = $(this).attr("href");
			$.ajax({
				type:'get',
				url:url,      
				success: function(data){
					$('#Tabla_Notificaciones').empty().html(data);
					subir();
				}
			});
		});       
	}	

	$('.NotificacionesAnteriores').click(function(){
		$.ajax({
			type:'get',
			url:'{{ url('Tabla_Notificaciones_Anteriores')}}',
			success: function(data){ 
				$('#Tabla_Notificaciones').empty().html(data);

			}         
		})
	});

</script>

@stop