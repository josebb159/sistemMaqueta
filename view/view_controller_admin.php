<?php
$views = [
    "usuarios" => "usuario.php",
    "configuracion" => "configuracion.php",
    "logs" => "logs.php",
    "notificaciones" => "notificaciones.php",
    "myaccount" => "myaccount.php",
    "logout" => "../logout.php", 
	/*construir*/
];

$view = $_GET['view'] ?? 'index';

if (isset($views[$view])) {
    include "dinamic/administrador/{$views[$view]}";
} else {
    include 'dinamic/administrador/index.php';
}
?>

