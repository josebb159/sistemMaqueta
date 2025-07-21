$(document).ready(function(){
	ver_registros();
});

function registrar(){
	var result = function_ajax({
		'op':'registrar',
		'categorias_subcategorias': $("#categorias_subcategoriasagg").val(),
		'detalle': $("#detalleagg").val(),
		'foto': $("#fotoagg").val(),
		'direccion': $("#direccionagg").val(),
		'solicitado_para': $("#solicitado_paraagg").val(),
		'oferta': $("#ofertaagg").val(),
		'metodo_pago': $("#metodo_pagoagg").val(),
		'calificacion': $("#calificacionagg").val(),
		'estado_servicio': $("#estado_servicioagg").val(),
		'estado':'1'
}	,'../controller/serviciosController.php').then(function(result){
	if(result=="1"){
		alert_success();
		ver_registros();
		$("#categorias_subcategoriasagg").val("");
		$("#detalleagg").val("");
		$("#fotoagg").val("");
		$("#direccionagg").val("");
		$("#solicitado_paraagg").val("");
		$("#ofertaagg").val("");
		$("#metodo_pagoagg").val("");
		$("#calificacionagg").val("");
		$("#estado_servicioagg").val("");
	}
	}).catch(function(error) {console.log('Error:', error);});
}

function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();
	var result = function_ajax({
		'op':'buscar'
}	,'../controller/serviciosController.php').then(function(result){
	$("#datos").html(result);
	$('#datatable-buttons').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]
	});
	}).catch(function(error) {console.log('Error:', error);});
}

function cambiar_estado(id, estado){
	if(estado==1){
		estado=0
	}else{
		estado=1
	}
	var result = function_ajax({
		'op':'cambiar_estado',
		'id': id,
		'estado':estado
}	,'../controller/serviciosController.php').then(function(result){
	if(result=="1"){
		alert_success_status();
	}
	}).catch(function(error) {console.log('Error:', error);});
}

function eliminar( id ){
	Swal.fire({
		title: "Estas seguro de eliminar este registro?",
		text: "seleccione las siguentes opciones para continuar!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#1cbb8c",
		cancelButtonColor: "#ff3d60",
		confirmButtonText: "Si, deseo eliminar",
		cancelButtonText: "Cancelar"
	}).then(function (result) {
		if (result.value) {
			var result = function_ajax({
				'op':'eliminar',
				'id': id
}			,'../controller/serviciosController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function cargar_datos(id_servicios,categorias_subcategorias,detalle,foto,direccion,solicitado_para,oferta,metodo_pago,calificacion,estado_servicio){
	$("#id").val(id_servicios);
	$("#categorias_subcategorias").val(categorias_subcategorias);
	$("#detalle").val(detalle);
	$("#foto").val(foto);
	$("#direccion").val(direccion);
	$("#solicitado_para").val(solicitado_para);
	$("#oferta").val(oferta);
	$("#metodo_pago").val(metodo_pago);
	$("#calificacion").val(calificacion);
	$("#estado_servicio").val(estado_servicio);
	$("#id_").val(id_);
}

function modificar(){
	var id =  $("#id").val();
	var categorias_subcategorias =  $("#categorias_subcategorias").val();
	var detalle =  $("#detalle").val();
	var foto =  $("#foto").val();
	var direccion =  $("#direccion").val();
	var solicitado_para =  $("#solicitado_para").val();
	var oferta =  $("#oferta").val();
	var metodo_pago =  $("#metodo_pago").val();
	var calificacion =  $("#calificacion").val();
	var estado_servicio =  $("#estado_servicio").val();
	Swal.fire({
		title: "Estas seguro de modificar este registro?",
		text: "seleccione las siguentes opciones para continuar!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#1cbb8c",
		cancelButtonColor: "#ff3d60",
		confirmButtonText: "Si, deseo modificar",
		cancelButtonText: "Cancelar"
	}).then(function (result) {
		if (result.value) {
			var result = function_ajax({
				'op':'modificar',
				'id': id,
				'categorias_subcategorias': categorias_subcategorias,
				'detalle': detalle,
				'foto': foto,
				'direccion': direccion,
				'solicitado_para': solicitado_para,
				'oferta': oferta,
				'metodo_pago': metodo_pago,
				'calificacion': calificacion,
				'estado_servicio': estado_servicio,
			},'../controller/serviciosController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Modificado!", "El registro fue modificado.", "success");
				$('#myModal').modal('hide');
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function alert_success(){
	Swal.fire({
		title: 'Listo, has agregado un registro!',
		text: 'Preciona el boton para aceptar!',
		icon: 'success',
		confirmButtonColor: '#0152c5'
	});
}

function alert_success_status(){
	Swal.fire({
		title: 'Listo, has cambiado el estado del registro!',
		text: 'Preciona el boton para aceptar!',
		icon: 'success',
		confirmButtonColor: '#0152c5'
	});
}

function alert_warning(){
	Swal.fire({
		title: 'Error al registrar!',
		text: 'Preciona el boton para aceptar!',
		icon: 'warning',
		confirmButtonColor: '#0152c5'
	});
}

$('#sa-warning').click(function () {
});

$("#form_1").on('submit', function(evt){
	evt.preventDefault();  
	registrar();
});

$("#form_2").on('submit', function(evt){
	evt.preventDefault();  
	modificar();
});

function function_ajax(data,url){
	return new Promise(function(resolve, reject) {
		$.post({
			type: 'POST',
			url: url,
			data: data,
			success: function(response){
				resolve(response);
			},
			error: function(error) {
				reject(error);
			}
		});
	});
}
