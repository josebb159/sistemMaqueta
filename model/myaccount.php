<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class myaccount {
    public $conexion;

    public function __construct(){
        $this->conexion = new Conexion();
    }

    public function actualizar_usuario($id_usuario, $nombre, $email, $telefono){
        $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, telefono = :telefono, fecha_actualizacion = current_timestamp WHERE id = :id_usuario";
        $reg = $this->conexion->prepare($sql);
        $reg->execute(array(':nombre' => $nombre, ':email' => $email, ':telefono' => $telefono, ':id_usuario' => $id_usuario));
        return 1;
    }

    public function cambiar_contrasena($id_usuario, $contrasena){
        $sql = "UPDATE usuarios SET contrasena = :contrasena, fecha_actualizacion = current_timestamp WHERE id = :id_usuario";
        $reg = $this->conexion->prepare($sql);
        $reg->execute(array(':contrasena' => password_hash($contrasena, PASSWORD_BCRYPT), ':id_usuario' => $id_usuario));
        return 1;
    }

    public function actualizar_imagen($id_usuario, $img){
        $sql = "UPDATE usuarios SET img = :img, fecha_actualizacion = current_timestamp WHERE id = :id_usuario";
        $reg = $this->conexion->prepare($sql);
        $reg->execute(array(':img' => $img, ':id_usuario' => $id_usuario));
        return 1;
    }

    public function obtener_datos_usuario($id_usuario){
        $sql = "SELECT * FROM usuarios WHERE id = :id_usuario";
        $reg = $this->conexion->prepare($sql);
        $reg->execute(array(':id_usuario' => $id_usuario));
        return $reg->fetch(PDO::FETCH_ASSOC);
    }
    public function obtener_datos_correo($email){
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $reg = $this->conexion->prepare($sql);
        $reg->execute(array(':email' => $email));
        return $reg->fetch(PDO::FETCH_ASSOC);
    }
}
?>
