<?php
$scripts = [
    "usuarios" => "usuario.js",
    "configuracion" => "configuracion.js",
    "logs" => "logs.js",
    "notificaciones" => "notificaciones.js",
    "myaccount" => "myaccount.js",
	"payments" => "payments.js",
	"categories" => "categories.js",
	"subcategories" => "subcategories.js",
/*construir*/
];

// Obtener la vista desde GET o establecer un valor por defecto
$view = $_GET['view'] ?? "dashboard";

// Verificar si la vista tiene un script asociado y cargarlo
if (isset($scripts[$view])) {
    echo "<script src='../assets/js/functions/administrador/{$scripts[$view]}'></script>";
} else {
    echo "<script src='../assets/js/functions/administrador/dashboard.js'></script>";
}
?>


