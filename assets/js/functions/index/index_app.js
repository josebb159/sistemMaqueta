function login(){
   var usuario = $("#usuario").val();
   var contrasena = $("#contrasena").val();
 
  
   $.post({
        type: 'POST',
        url: 'controller/usuarioController.php',
        data: {'op':'login_app',
                'usuario': usuario,
                 'contrasena': contrasena},
        success: function(response){
          
            if(response=="1"){
                window.location.href = "app/home.php"; 
            }else{
                alert("usuario incorrecto");
            }
   
           
        }
        });

    
}