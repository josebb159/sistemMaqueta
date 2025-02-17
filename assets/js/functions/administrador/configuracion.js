$(document).ready(function(){
	ver_registros();


	$("#color").spectrum({
        showPaletteOnly: true,
        togglePaletteOnly: true,

        color: '#556ee6',
        palette: [
            ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
            ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
            ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
            ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
            ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
            ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
            ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
            ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
        ]
    });



});

function color(color){
	$("#color").spectrum({
        showPaletteOnly: true,
        togglePaletteOnly: true,

        color: color,
        palette: [
            ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
            ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
            ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
            ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
            ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
            ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
            ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
            ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
        ]
    });
}

function registrar(){
	var datos = [
		$("#nombre").val(),
		$("#color").val()
	];

	var descripcion = [
		"nombre",
		"color"
	]

	var campo = [
		"text",
		"text"
	]

	var result = function_ajax({
		'op':'registrar',
		'dato': datos,
		'descripcion': descripcion,
		'campo' : campo
}	,'../controller/configuracionController.php').then(function(result){
	alert_success();
	}).catch(function(error) {console.log('Error:', error);});
}


function registrar2(){
	var datos = [
		$("#select_ia").val(),
		$("#token_access").val()
	];

	var descripcion = [
		"select_ia",
		"token_access"
	]

	var campo = [
		"select",
		"text"
	]

	var result = function_ajax({
		'op':'registrar',
		'dato': datos,
		'descripcion': descripcion,
		'campo' : campo
}	,'../controller/configuracionController.php').then(function(result){
	alert_success();
	}).catch(function(error) {console.log('Error:', error);});
}


function registrar3(){
	var datos = [
		$("#correo").val(),
		$("#contrasena").val(),
		$("#smtp").val(),
		$("#port").val()
	];

	var descripcion = [
		"correo",
		"contrasena",
		"smtp",
		"port"
	]

	var campo = [
		"text",
		"text",
		"text",
		"text"
	]

	var result = function_ajax({
		'op':'registrar',
		'dato': datos,
		'descripcion': descripcion,
		'campo' : campo
}	,'../controller/configuracionController.php').then(function(result){
	alert_success();
	}).catch(function(error) {console.log('Error:', error);});
}


function test(){
	
	var correo = 	$("#correo").val();
	var contrasena =	$("#contrasena").val();
	var smtp =	$("#smtp").val();
	var port =	$("#port").val();
	


	var result = function_ajax({
		'correo': correo,
		'contrasena': contrasena,
		'smtp': smtp,
		'port': port
		
}	,'../controller/test_email.php').then(function(result){
	if(result=="1"){
		alert_success_email();
	}else{
		alert_warning_email();
	}
	
	}).catch(function(error) {console.log('Error:', error);});
}

function registrar4(){
	var datos = [
		$("#stock_naranja").val(),
		$("#stock_rojo").val()

	];

	var descripcion = [
		"stock_naranja",
		"stock_rojo",
	]

	var campo = [
		"number",
		"number",
	]

	var result = function_ajax({
		'op':'registrar',
		'dato': datos,
		'descripcion': descripcion,
		'campo' : campo
}	,'../controller/configuracionController.php').then(function(result){
	alert_success();
	}).catch(function(error) {console.log('Error:', error);});
}





function registrar5(){
	var datos = [
		$("#correo_entrega").val(),
		$("#correo_venta").val()

	];

	var descripcion = [
		"correo_entrega",
		"correo_venta",
	]

	var campo = [
		"email",
		"email",
	]

	var result = function_ajax({
		'op':'registrar',
		'dato': datos,
		'descripcion': descripcion,
		'campo' : campo
}	,'../controller/configuracionController.php').then(function(result){
	alert_success();
	}).catch(function(error) {console.log('Error:', error);});
}


function ver_registros(){

	var result = function_ajax({
		'op':'buscar_json_general'
}	,'../controller/configuracionController.php').then(function(result){
	$("#datos").html(result);
	let data = JSON.parse(result);
	data.forEach(item => {
		let dato = item.dato;
		let descripcion = item.descripcion;
	
		if(descripcion=="color"){
			color(dato);
		}
		$("#"+descripcion).val(dato);
	});
	
	}).catch(function(error) {console.log('Error:', error);});
}


function alert_success(){
	Swal.fire({
		title: 'Listo, han guardado los cambios!',
		text: 'Preciona el boton para aceptar!',
		icon: 'success',
		confirmButtonColor: '#0152c5'
	});
}

function alert_success_email(){
	Swal.fire({
		title: 'Correo enviado!',
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

function alert_warning_email(){
	Swal.fire({
		title: 'Error al enviar email!',
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
