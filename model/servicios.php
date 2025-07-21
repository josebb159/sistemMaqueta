<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class servicios {
	public $conexion;
	private $categorias_subcategorias;
	private $detalle;
	private $foto;
	private $direccion;
	private $solicitado_para;
	private $oferta;
	private $metodo_pago;
	private $calificacion;
	private $estado_servicio;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_servicios($categorias_subcategorias, $detalle, $foto, $direccion, $solicitado_para, $oferta, $metodo_pago, $calificacion, $estado_servicio){
	$estado_defaul = 1;
	$sql = "INSERT INTO `servicios`(`estado`,`categorias_subcategorias`,`detalle`,`foto`,`direccion`,`solicitado_para`,`oferta`,`metodo_pago`,`calificacion`,`estado_servicio`) VALUES (:estado,:categorias_subcategorias,:detalle,:foto,:direccion,:solicitado_para,:oferta,:metodo_pago,:calificacion,:estado_servicio)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':categorias_subcategorias' => $categorias_subcategorias,':detalle' => $detalle,':foto' => $foto,':direccion' => $direccion,':solicitado_para' => $solicitado_para,':oferta' => $oferta,':metodo_pago' => $metodo_pago,':calificacion' => $calificacion,':estado_servicio' => $estado_servicio));
	return $this->conexion->lastInsertId();
	}
	public function buscar_servicios(){$sql = "SELECT  * FROM servicios ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_servicios($id, $estado){$sql = "UPDATE `servicios` SET `estado`=:estado WHERE id_servicios=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_servicios($id){$sql = "DELETE FROM `servicios`  WHERE id_servicios=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_servicios($id ,$categorias_subcategorias,$detalle,$foto,$direccion,$solicitado_para,$oferta,$metodo_pago,$calificacion,$estado_servicio){
	$sql = "UPDATE `servicios` SET `categorias_subcategorias`=:categorias_subcategorias, `detalle`=:detalle, `foto`=:foto, `direccion`=:direccion, `solicitado_para`=:solicitado_para, `oferta`=:oferta, `metodo_pago`=:metodo_pago, `calificacion`=:calificacion, `estado_servicio`=:estado_servicio  WHERE id_servicios=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id,':categorias_subcategorias' => $categorias_subcategorias,':detalle' => $detalle,':foto' => $foto,':direccion' => $direccion,':solicitado_para' => $solicitado_para,':oferta' => $oferta,':metodo_pago' => $metodo_pago,':calificacion' => $calificacion,':estado_servicio' => $estado_servicio));
	}
	public function buscar_json_servicios($id){$sql = "SELECT  * FROM rol where id=".$id."";
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