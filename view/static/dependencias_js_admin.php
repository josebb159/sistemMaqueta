<?php

if(isset($_GET['view'])){
	
	if($_GET['view']=="usuarios"){
		echo "<script src='../assets/js/functions/administrador/usuario.js'></script>";
	}
	
	if($_GET['view']=="configuracion"){
		echo "<script src='../assets/js/functions/administrador/configuracion.js'></script>";
	}

	if($_GET['view']=="logs"){
		echo "<script src='../assets/js/functions/administrador/logs.js'></script>";
	}
	if($_GET['view']=="notificaciones"){
		echo "<script src='../assets/js/functions/administrador/notificaciones.js'></script>";
	}
	if($_GET['view']=="myaccount"){
		echo "<script src='../assets/js/functions/administrador/myaccount.js'></script>";
	}
	
/*construir*/
    
    
}else{
    echo "<script src='../assets/js/functions/administrador/dashboard.js'></script>";
}
    


?>