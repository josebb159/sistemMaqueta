$(document).ready(function(){
	ver_registros();
});

function registrar(){
	var result = function_ajax({
		'op':'registrar',
		'id_usuarios': $("#id_usuariosagg").val(),
		'foto': $("#fotoagg").val(),
		'nombre_completo': $("#nombre_completoagg").val(),
		'telefono': $("#telefonoagg").val(),
		'correo': $("#correoagg").val(),
		'categories_selected': $("#categories_selectedagg").val(),
		'anio_experiencia': $("#anio_experienciaagg").val(),
		'metodos_pago': $("#metodos_pagoagg").val(),
		'cartera': $("#carteraagg").val(),
		'antecedentes': $("#antecedentesagg").val(),
		'cedula_frontal': $("#cedula_frontalagg").val(),
		'cedula_trasera': $("#cedula_traseraagg").val(),
		'estado':'1'
}	,'../controller/especialistaController.php').then(function(result){
	if(result=="1"){
		alert_success();
		ver_registros();
		$("#fotoagg").val("");
		$("#nombre_completoagg").val("");
		$("#telefonoagg").val("");
		$("#correoagg").val("");
		$("#categories_selectedagg").val("");
		$("#anio_experienciaagg").val("");
		$("#metodos_pagoagg").val("");
		$("#carteraagg").val("");
		$("#antecedentesagg").val("");
		$("#cedula_frontalagg").val("");
		$("#cedula_traseraagg").val("");
		$("#id_usuariosagg").val("");
	}
	}).catch(function(error) {console.log('Error:', error);});
}

function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();
	var result = function_ajax({
		'op':'buscar'
}	,'../controller/especialistaController.php').then(function(result){
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
}	,'../controller/especialistaController.php').then(function(result){
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
}			,'../controller/especialistaController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function cargar_datos(id_especialista,id_usuarios,foto,nombre_completo,telefono,correo,categories_selected,anio_experiencia,metodos_pago,cartera,antecedentes,cedula_frontal,cedula_trasera){
	$("#id").val(id_especialista);
	$("#foto").val(foto);
	$("#nombre_completo").val(nombre_completo);
	$("#telefono").val(telefono);
	$("#correo").val(correo);
	$("#categories_selected").val(categories_selected);
	$("#anio_experiencia").val(anio_experiencia);
	$("#metodos_pago").val(metodos_pago);
	$("#cartera").val(cartera);
	$("#antecedentes").val(antecedentes);
	$("#cedula_frontal").val(cedula_frontal);
	$("#cedula_trasera").val(cedula_trasera);
	$("#id_usuarios").val(id_usuarios);
}

function modificar(){
	var id =  $("#id").val();
	var usuarios =  $("#id_usuarios").val();
	var foto =  $("#foto").val();
	var nombre_completo =  $("#nombre_completo").val();
	var telefono =  $("#telefono").val();
	var correo =  $("#correo").val();
	var categories_selected =  $("#categories_selected").val();
	var anio_experiencia =  $("#anio_experiencia").val();
	var metodos_pago =  $("#metodos_pago").val();
	var cartera =  $("#cartera").val();
	var antecedentes =  $("#antecedentes").val();
	var cedula_frontal =  $("#cedula_frontal").val();
	var cedula_trasera =  $("#cedula_trasera").val();
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
				'usuarios': id_usuarios,
				'foto': foto,
				'nombre_completo': nombre_completo,
				'telefono': telefono,
				'correo': correo,
				'categories_selected': categories_selected,
				'anio_experiencia': anio_experiencia,
				'metodos_pago': metodos_pago,
				'cartera': cartera,
				'antecedentes': antecedentes,
				'cedula_frontal': cedula_frontal,
				'cedula_trasera': cedula_trasera,
			},'../controller/especialistaController.php').then(function(result){
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
