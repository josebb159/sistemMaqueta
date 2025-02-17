<?php 
if(isset($_SESSION['rol'])){
    $rol = $_SESSION['rol'];
}else{
    $rol = "";
}



if($rol=="administrador"){

    include 'dependencias_js_admin.php';

}if($rol=="gerente_almacen"){

    include 'dependencias_js_gerente_almacen.php';

}if($rol=="subadm2"){

    include 'dependencias_js_admin.php';

}elseif($rol=="afiliado"){
    include 'dependencias_js_afiliado.php';
}elseif($rol=="Usuario Nivel 2"){
    include 'dependencias_js_usuario2.php';
}elseif($rol=="Usuario Nivel 3"){
    include 'dependencias_js_usuario3.php';
}elseif($rol=="Usuario Nivel 4"){
    include 'dependencias_js_usuario4.php';
}
else{}


 
?>