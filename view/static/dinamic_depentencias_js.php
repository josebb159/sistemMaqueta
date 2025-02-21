<?php 
$rol = $_SESSION['rol'] ?? "";

$dependencias = [
    "administrador" => "dependencias_js_admin.php",
];

if (isset($dependencias[$rol])) {
    include $dependencias[$rol];
}
?>
