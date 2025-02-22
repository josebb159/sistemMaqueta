
function login(){
   var usuario = $("#usuario").val();
   var contrasena = $("#contrasena").val();
 
  
   $.post({
        type: 'POST',
        url: 'controller/usuarioController.php',
        data: {'op':'login',
                'usuario': usuario,
                 'contrasena': contrasena},
        success: function(response){
            
     
          
            if(response=="1"){
                window.location.href = "view/home.php"; 
            }else{
                alert("usuario incorrecto");
            }
   
           
        }
        });

    
}


function resetear_contrasenia() {
    var password = $("#password").val();
    var password_confirm = $("#password_confirm").val();
    var id = $("#id").val();

    // Validar que ambos campos no estén vacíos
    if (password === "" || password_confirm === "") {
        alert("Por favor, completa ambos campos.");
        return;
    }

    // Verificar que las contraseñas coincidan
    if (password !== password_confirm) {
        alert("Las contraseñas no coinciden.");
        return;
    }

    // Enviar datos al servidor
    $.post("controller/usuarioController.php", {
        'op': 'password_reset',
        'contrasena': password,
        'id' : id
    }, function(response) {
        if (response == "1") {
            alert("Contraseña actualizada.");
            window.location.href = "index.php";
        } else {
            alert("Error al actualizar la contraseña.");
        }
    }).fail(function() {
        alert("Hubo un problema con la solicitud.");
    });
}
