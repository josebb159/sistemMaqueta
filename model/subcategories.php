<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class subcategories {
	public $conexion;
	private $nombre;
	private $description;
	private $valor_min;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_subcategories($id_categories, $nombre, $description, $valor_min){
	$estado_defaul = 1;
	$sql = "INSERT INTO `subcategories`(`estado`,`nombre`,`description`,`valor_min`,`id_categories`) VALUES (:estado,:nombre,:description,:valor_min,:id_categories)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nombre' => $nombre,':description' => $description,':valor_min' => $valor_min,':id_categories' => $id_categories));
	return $this->conexion->lastInsertId();
	}
	public function buscar_subcategories(){$sql = "SELECT  * FROM subcategories ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }

	public function buscar_subcategories_id($id){$sql = "SELECT  * FROM subcategories where id_subcategories=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_subcategories($id, $estado){$sql = "UPDATE `subcategories` SET `estado`=:estado WHERE id_subcategories=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_subcategories($id){$sql = "DELETE FROM `subcategories`  WHERE id_subcategories=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_subcategories($id ,$id_categories,$nombre,$description,$valor_min){
	$sql = "UPDATE `subcategories` SET `nombre`=:nombre, `description`=:description, `valor_min`=:valor_min ,`id_categories`=:id_categories WHERE id_subcategories=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id,':nombre' => $nombre,':description' => $description,':valor_min' => $valor_min,':id_categories' => $id_categories));
	}
	public function buscar_json_subcategories($id){$sql = "SELECT  * FROM rol where id=".$id."";
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