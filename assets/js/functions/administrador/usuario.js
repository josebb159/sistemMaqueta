$(document).ready(function(){
	ver_registros();
	cargar_roles();
	cargar_sucursales();
});

document.getElementById('telefono').addEventListener('input', function (e) {
	let value = e.target.value.replace(/\D/g, ''); // Elimina cualquier carácter que no sea número

	// Formatea la entrada en el formato 000-0000-000
	if (value.length > 3) {
		value = value.slice(0, 3) + '-' + value.slice(3);
	}
	if (value.length > 8) {
		value = value.slice(0, 8) + '-' + value.slice(8);
	}

	e.target.value = value.slice(0, 12); // Limita el input al formato 000-0000-000
});




function registrar(){





	var result = function_ajax({
		'op':'registrar',
		'nombre': $("#nombreagg").val(),
		'usuario': $("#usuarioagg").val(),
		'contrasena': $("#contrasenaagg").val(),
		'rol': $("#rols").val(),
		'sucursal': $("#sucursal").val(),
		'estado':'1'
}	,'../controller/usuarioController.php').then(function(result){

	if (result === "El correo ya está registrado") {
		alert_warning_user_duplicate();
		return;
	}
	if (result !="1") {
		alert_warning();	
		return;
	}
			ver_registros();
			alert_success();
			$("#nombreagg").val("");
			$("#apellidoagg").val("");
			$("#usuarioagg").val("");
			$("#contrasenaagg").val("");
			$("#sucursal").val("");

	}).catch(function(error) {console.log('Error:', error);});

}

function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();

	var result = function_ajax({
		'op':'buscar_system'
}	,'../controller/usuarioController.php').then(function(result){

	$("#datos").html(result);
	$('#datatable-buttons').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]
	});
	}).catch(function(error) {console.log('Error:', error);});



}


function isUserSucursal(id){
	
		if(id==	2){
			$("#sucursales").show();
			$("#sucursal").prop('required', true);
		}else if(id==3){
			$("#sucursales").show();
			$("#sucursal").prop('required', true);
		}else if(id==4){
			$("#sucursales").show();
			$("#sucursal").prop('required', true);
		}else{
			$("#sucursales").hide();
			$("#sucursal").prop('required', false);
			$("#sucursal").val("");
		}
}

function cargar_roles(){

	var result = function_ajax({
		'op':'get_rol'
}	,'../controller/usuarioController.php').then(function(result){

	$("#rols").html(result);

	}).catch(function(error) {console.log('Error:', error);});



}

function cargar_sucursales(){

	var result = function_ajax({
		'op':'buscar_select_sucursal'
}	,'../controller/usuarioController.php').then(function(result){

	$("#sucursal").html(result);

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
}	,'../controller/usuarioController.php');
	
		alert_success();
	
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
}			,'../controller/usuarioController.php');
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
		}
	});
}

function cargar_datos(id, telefono,nombre){
	$("#id").val(id);
	$("#nombre").val(nombre);
	$("#telefono").val(telefono);

}

function modificar(){
	var id =  $("#id").val();
	var nombre =  $("#nombre").val();
	var telefono =  $("#telefono").val();
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
				'nombre': nombre,
				'telefono': telefono,
			},'../controller/usuarioController.php');
			
				ver_registros();
				Swal.fire("Modificado!", "El registro fue modificado.", "success");
				$('#myModal').modal('hide');
			
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

function alert_warning(){
	Swal.fire({
		title: 'Error al registrar el usuario!',
		text: 'Preciona el boton para aceptar!',
		icon: 'warning',
		confirmButtonColor: '#0152c5'
	});
}

function alert_warning_user_duplicate(){
	Swal.fire({
		title: 'Ya existe un usuaro con este correo',
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

