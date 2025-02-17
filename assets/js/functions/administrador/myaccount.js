$(document).ready(function() {
	obtenerDatosUsuario();
});

function actualizarUsuario() {
    var result = function_ajax({
        'op': 'actualizar',
        'id_usuario': $("#id_usuario").val(),
        'nombre': $("#nombre").val(),
        'email': $("#email").val(),
        'telefono': $("#telefono").val()
    }, '../controller/myaccountController.php').then(function(result) {
        if (result == "1") {
            alert_success('Información actualizada con éxito');
        }
    }).catch(function(error) {
        console.log('Error:', error);
    });
}

function cambiarContrasena() {
    var password = $("#password").val();
    var confirm_password = $("#confirm_password").val();
    if (password !== confirm_password) {
        alert_warning('Las contraseñas no coinciden');
        return;
    }

    var result = function_ajax({
        'op': 'cambiar_contrasena',
        'id_usuario': $("#id_usuario").val(),
        'password': password,
        'confirm_password': confirm_password,
    }, '../controller/myaccountController.php').then(function(result) {
        if (result == "1") {
            alert_success('Contraseña cambiada con éxito');
        }
    }).catch(function(error) {
        console.log('Error:', error);
    });
}

function cambiarImagen() {
    var formData = new FormData();
    formData.append('op', 'cambiar_imagen');
    formData.append('id_usuario', $("#id_usuario").val());
    formData.append('imagen_perfil', $("#imagen_perfil")[0].files[0]);

    $.ajax({
        type: 'POST',
        url: '../controller/myaccountController.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            // Analizar la respuesta JSON
            response = JSON.parse(response);

            if (response.error) {
                console.log('Error al cambiar la imagen:', response.error);
            } else {
                // Actualizar la imagen de perfil
                $("#profile-picture").attr("src", response.nueva_imagen);
                alert_success('Imagen de perfil actualizada con éxito');
            }
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
}


function alert_success(message) {
    Swal.fire({
        title: 'Listo!',
        text: message,
        icon: 'success',
        confirmButtonColor: '#0152c5'
    });
}

function alert_warning(message) {
    Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'warning',
        confirmButtonColor: '#0152c5'
    });
}

$("#form_editar").on('submit', function(evt) {
    evt.preventDefault();
    actualizarUsuario();
});

$("#form_cambiar_contrasena").on('submit', function(evt) {
    evt.preventDefault();
    cambiarContrasena();
});

$("#form_cambiar_imagen").on('submit', function(evt) {
    evt.preventDefault();
    cambiarImagen();
});

function function_ajax(data, url) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(response) {
                resolve(response);
            },
            error: function(error) {
                reject(error);
            }
        });
    });
}
function obtenerDatosUsuario() {
    var id_usuario = $("#id_usuario").val(); // Obtener el id_usuario desde el campo oculto
    
    // Realizar la llamada AJAX para obtener los datos del usuario
    $.ajax({
        type: 'POST',
        url: '../controller/myaccountController.php',
        data: {
            'op': 'obtener_datos_usuario',
            'id_usuario': id_usuario  // Pasar el id_usuario al controlador PHP
        },
        dataType: 'json', // Esperamos una respuesta en formato JSON
        success: function(response) {
            // Verificar si hay un error en la respuesta
            if (response.error) {
                console.log('Error al obtener los datos del usuario:', response.error);
            } else {
                // Establecer los valores en los campos del formulario
                $("#id_usuario").val(response.id);
                $("#nombre").val(response.nombre);
                $("#email").val(response.email);
                $("#telefono").val(response.telefono);
                // Actualizar la imagen de perfil
                if (response.img) {
                    $("#profile-picture").attr("src", "../assets/upload/usuario/"+response.img);
                }
            }
        },
        error: function(xhr, status, error) {
            console.log('Error al obtener los datos del usuario:', error);
        }
    });
}


