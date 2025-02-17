<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class configuracion {
	public $conexion;
	private $dato;
	private $descripcion;
	private $campo;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_configuracion($id='204',$dato,$descripcion,$campo,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `configuracion`(`estado`,`dato`,`descripcion`,`campo`) VALUES (:estado,:dato,:descripcion,:campo)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':dato' => $dato,':descripcion' => $descripcion,':campo' => $campo));
	return 1;
	}
	public function buscar_configuracion(){$sql = "SELECT  * FROM configuracion ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }

	public function buscar_configuracion_by_descripcion($descripcion){$sql = "SELECT  * FROM configuracion where descripcion='".$descripcion."'";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta[0]['dato'];
		}else{
			return 0;
		} }
	
	public function get_config(){$sql = "SELECT  * FROM configuracion ";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
	} }
	public function exist_config($descripcion){$sql = "SELECT  * FROM configuracion where descripcion='".$descripcion."'";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return 1;
		}else{
			return 0;
		} 
	}
	public function cambiar_estado_configuracion($id, $estado){$sql = "UPDATE `configuracion` SET `estado`=:estado WHERE id_configuracion=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_configuracion($id){$sql = "DELETE FROM `configuracion`  WHERE id_configuracion=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_configuracion($id ,$dato,$descripcion,$campo){
	$sql = "UPDATE `configuracion` SET  `dato`=:dato,`descripcion`=:descripcion,`campo`=:campo WHERE descripcion=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id,':dato' => $dato,':descripcion' => $descripcion,':campo' => $campo));
	}
	public function buscar_json_configuracion($id){$sql = "SELECT  * FROM configuracion where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function buscar_json_configuracion_general(){$sql = "SELECT  * FROM configuracion";
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