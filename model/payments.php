<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class payments {
	public $conexion;
	private $nombre;
	private $descripcion;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_payments($nombre,$descripcion,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `payments`(`estado`,`nombre`,`descripcion`) VALUES (:estado,:nombre,:descripcion)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nombre' => $nombre,':descripcion' => $descripcion));
	return $this->conexion->lastInsertId();
	}
	public function buscar_payments(){$sql = "SELECT  * FROM payments ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_payments($id, $estado){$sql = "UPDATE `payments` SET `estado`=:estado WHERE id_payments=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_payments($id){$sql = "DELETE FROM `payments`  WHERE id_payments=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}

	public function modificar_payments($id ,$nombre,$descripcion){
	$sql = "UPDATE `payments` SET  `nombre`=:nombre,`descripcion`=:descripcion WHERE id_payments=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id,':nombre' => $nombre,':descripcion' => $descripcion));
	}
	public function buscar_json_payments($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function test() {
		// C�digo del m�todo aqu�
	}

}
?>