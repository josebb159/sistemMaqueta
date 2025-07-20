<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class chat {
	public $conexion;
	private $chat;
	private $usuario;
	private $especialista;
	private $estado_visto;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_chat($chat, $usuario, $especialista, $estado_visto){
	$estado_defaul = 1;
	$sql = "INSERT INTO `chat`(`estado`,`chat`,`usuario`,`especialista`,`estado_visto`) VALUES (:estado,:chat,:usuario,:especialista,:estado_visto)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':chat' => $chat,':usuario' => $usuario,':especialista' => $especialista,':estado_visto' => $estado_visto));
	return $this->conexion->lastInsertId();
	}
	public function buscar_chat(){$sql = "SELECT  * FROM chat ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_chat($id, $estado){$sql = "UPDATE `chat` SET `estado`=:estado WHERE id_chat=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_chat($id){$sql = "DELETE FROM `chat`  WHERE id_chat=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_chat($id ,$chat,$usuario,$especialista,$estado_visto){
	$sql = "UPDATE `chat` SET `chat`=:chat, `usuario`=:usuario, `especialista`=:especialista, `estado_visto`=:estado_visto  WHERE id_chat=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id,':chat' => $chat,':usuario' => $usuario,':especialista' => $especialista,':estado_visto' => $estado_visto));
	}
	public function buscar_json_chat($id){$sql = "SELECT  * FROM rol where id=".$id."";
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