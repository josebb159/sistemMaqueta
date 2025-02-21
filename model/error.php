<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class error_log {
	public $conexion;
	private $dato;
	private $descripcion;
	private $campo;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_error($error) {
		$sql = "INSERT INTO `error_log` (`mensaje`, `archivo`, `linea`, `traza`) 
				VALUES (:mensaje, :archivo, :linea, :traza)";
		
		$reg = $this->conexion->prepare($sql);
		
		$reg->execute([
			':mensaje' => $error['mensaje'],
			':archivo' => $error['archivo'],
			':linea'   => $error['linea'],
			':traza'   => $error['traza']
		]);
		
		return 1;
	}
	


}
?>