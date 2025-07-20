<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class especialista {
	public $conexion;
	private $foto;
	private $nombre_completo;
	private $telefono;
	private $correo;
	private $categories_selected;
	private $anio_experiencia;
	private $metodos_pago;
	private $cartera;
	private $antecedentes;
	private $cedula_frontal;
	private $cedula_trasera;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_especialista($id_usuarios, $foto, $nombre_completo, $telefono, $correo, $categories_selected, $anio_experiencia, $metodos_pago, $cartera, $antecedentes, $cedula_frontal, $cedula_trasera){
	$estado_defaul = 1;
	$sql = "INSERT INTO `especialista`(`estado`,`foto`,`nombre_completo`,`telefono`,`correo`,`categories_selected`,`anio_experiencia`,`metodos_pago`,`cartera`,`antecedentes`,`cedula_frontal`,`cedula_trasera`,`id_usuarios`) VALUES (:estado,:foto,:nombre_completo,:telefono,:correo,:categories_selected,:anio_experiencia,:metodos_pago,:cartera,:antecedentes,:cedula_frontal,:cedula_trasera,:id_usuarios)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':foto' => $foto,':nombre_completo' => $nombre_completo,':telefono' => $telefono,':correo' => $correo,':categories_selected' => $categories_selected,':anio_experiencia' => $anio_experiencia,':metodos_pago' => $metodos_pago,':cartera' => $cartera,':antecedentes' => $antecedentes,':cedula_frontal' => $cedula_frontal,':cedula_trasera' => $cedula_trasera,':id_usuarios' => $id_usuarios));
	return $this->conexion->lastInsertId();
	}
	public function buscar_especialista(){$sql = "SELECT  * FROM especialista ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_especialista($id, $estado){$sql = "UPDATE `especialista` SET `estado`=:estado WHERE id_especialista=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_especialista($id){$sql = "DELETE FROM `especialista`  WHERE id_especialista=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_especialista($id ,$id_usuarios,$foto,$nombre_completo,$telefono,$correo,$categories_selected,$anio_experiencia,$metodos_pago,$cartera,$antecedentes,$cedula_frontal,$cedula_trasera){
	$sql = "UPDATE `especialista` SET `foto`=:foto, `nombre_completo`=:nombre_completo, `telefono`=:telefono, `correo`=:correo, `categories_selected`=:categories_selected, `anio_experiencia`=:anio_experiencia, `metodos_pago`=:metodos_pago, `cartera`=:cartera, `antecedentes`=:antecedentes, `cedula_frontal`=:cedula_frontal, `cedula_trasera`=:cedula_trasera ,`id_usuarios`=:id_usuarios WHERE id_especialista=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id,':foto' => $foto,':nombre_completo' => $nombre_completo,':telefono' => $telefono,':correo' => $correo,':categories_selected' => $categories_selected,':anio_experiencia' => $anio_experiencia,':metodos_pago' => $metodos_pago,':cartera' => $cartera,':antecedentes' => $antecedentes,':cedula_frontal' => $cedula_frontal,':cedula_trasera' => $cedula_trasera,':id_usuarios' => $id_usuarios));
	}
	public function buscar_json_especialista($id){$sql = "SELECT  * FROM rol where id=".$id."";
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