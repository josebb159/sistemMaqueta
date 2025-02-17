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