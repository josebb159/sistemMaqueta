<?php

if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
$conexion = new Conexion();
class notificacion {
	public $conexion;
	private $valor;
	private $descripcion;



	public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }


	public function registrar_notificacion($nombre, $descripcion, $visto = false, $usuario, $tabla, $id_tabla) {
        $sql = "INSERT INTO `notificacion`(`nombre`, `descripcion`, `fecha_registro`, `visto`, `usuario`, `tabla`, `id_tabla`) 
                VALUES (:nombre, :descripcion, NOW(), :visto, :usuario, :tabla, :id_tabla)";
        $reg = $this->conexion->prepare($sql);
        $reg->execute([
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':visto' =>  0,
			':usuario' => $usuario,
			':tabla' => $tabla,
			':id_tabla' => $id_tabla
        ]);
        return 1;
    }
	public function buscar_notificaciones(){$sql = "SELECT  * FROM notificacion ORDER BY id DESC limit 10";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }


	public function buscar_notificaciones_general(){$sql = "SELECT  notificacion.*, usuarios.nombre as usuario FROM notificacion join usuarios on usuarios.id = notificacion.usuario ORDER BY notificacion.id DESC;";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
		} }


	public function marcar_todas_vistas() {
		$sql = "UPDATE `notificaciones` SET `visto` = 1 WHERE `visto` = 0";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		return $reg->rowCount(); // Devuelve el número de filas afectadas
	}

}
?>