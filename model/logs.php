<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class logs {
	public $conexion;
	private $id;
	private $query;
	private $user;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_logs($id='204',$id,$query,$user,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `logs`(`estado`,`id`,`query`,`user`) VALUES (:estado,:id,:query,:user)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':id' => $id,':query' => $query,':user' => $user));
	return 1;
	}
	public function buscar_logs(){$sql = "SELECT  * FROM logs ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_logs($id, $estado){$sql = "UPDATE `logs` SET `estado`=:estado WHERE id_logs=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_logs($id){$sql = "DELETE FROM `logs`  WHERE id_logs=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_logs($id ,$id,$query,$user){
	$sql = "UPDATE `logs` SET  ,`id`=:id,`query`=:query,`user`=:user WHERE id_logs=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id,':id' => $id,':query' => $query,':user' => $user));
	}
	public function buscar_json_logs($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function logs_mysql() {
		// Código del método aquí
	}

}
?>