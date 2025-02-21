<?php 
$rol = $_SESSION['rol'] ?? "";

$roles = [
    "administrador" => "view_controller_admin.php",
    "Usuario Nivel 1" => "view_controller_user_1.php",
];

if (isset($roles[$rol])) {
    include $roles[$rol];
}
?>