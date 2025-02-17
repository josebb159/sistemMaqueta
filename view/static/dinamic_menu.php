<?php 
if(isset($_SESSION['rol'])){
    $rol = $_SESSION['rol'];
}else{
    $rol = "";
}

if($rol=="Usuario Nivel 1"){

    include 'menu_usuario1.php';

}elseif($rol=="operario_almace"){
    
    include 'menu_operario_almace.php';

}elseif($rol=="coordinador_log"){

    include 'menu_coordinador_log.php';

}elseif($rol=="gerente_almacen"){

    include 'menu_gerente_almacen.php';

}elseif($rol=="administrador"){
    include 'menu.php';
}else{}





?>