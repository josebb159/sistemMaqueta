<?php 
if(isset($_SESSION['rol'])){
    $rol = $_SESSION['rol'];
}else{
    $rol = "";
}


if($rol=="Usuario Nivel 1"){

    include 'view_controller_user_1.php';

}elseif($rol=="Usuario Nivel 2"){
    
    include 'view_controller_user_2.php';

    }elseif($rol=="Usuario Nivel 3"){

    include 'view_controller_user_3.php';

}elseif($rol=="operario_almace"){

    include 'view_controller_operario_almace.php';

}elseif($rol=="coordinador_log"){

    include 'view_controller_coordinador_log.php';

}
elseif($rol=="gerente_almacen"){

    include 'view_controller_gerente_almacen.php';

}
elseif($rol=="administrador"){
    include 'view_controller_admin.php';

}else{}


 
?>