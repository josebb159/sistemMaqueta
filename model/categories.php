<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class categories {
	public $conexion;
	private $nombre;
	private $description;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_categories($nombre, $description){
	$estado_defaul = 1;
	$sql = "INSERT INTO `categories`(`estado`,`nombre`,`description`) VALUES (:estado,:nombre,:description)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nombre' => $nombre,':description' => $description));
	return $this->conexion->lastInsertId();
	}
	public function buscar_categories(){$sql = "SELECT  * FROM categories ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_categories($id, $estado){$sql = "UPDATE `categories` SET `estado`=:estado WHERE id_categories=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_categories($id){$sql = "DELETE FROM `categories`  WHERE id_categories=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_categories($id ,$nombre,$description){
	$sql = "UPDATE `categories` SET `nombre`=:nombre, `description`=:description  WHERE id_categories=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id,':nombre' => $nombre,':description' => $description));
	}
	public function buscar_json_categories($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function test() {
		// Código del método aquí
	}

}
?>