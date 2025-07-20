<?php
$views = [
    "usuarios" => "usuario.php",
    "configuracion" => "configuracion.php",
    "logs" => "logs.php",
    "notificaciones" => "notificaciones.php",
    "myaccount" => "myaccount.php",
    "logout" => "logout.php", 
	"payments" => "payments.php",
	"categories" => "categories.php",
	"subcategories" => "subcategories.php",
/*construir*/
];

$view = $_GET['view'] ?? 'index';

if (isset($views[$view])) {
    if ($view == "logout") {
        include $views[$view];
    }
    include "dinamic/administrador/{$views[$view]}";
} else {
    include 'dinamic/administrador/index.php';
}
?>

