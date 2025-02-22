<?php
ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include 'generalErrorController.php';
include '../model/configuracion.php';
include '../model/notificacion.php';

session_start();

if(isset($_POST['id'])){
	$id =  $_POST['id'];
}


if(isset($_POST['descripcion'])){
	$descripcion[] =  $_POST['descripcion'];

}

if(isset($_POST['campo'])){
	$campo[] =  $_POST['campo'];
}


if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'update_imagen':


		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
			$targetDir = "../assets/images/";
			$targetFile1 = $targetDir . "logo4.png"; // Guardar como logo4.png
			$targetFile2 = $targetDir . "logo.png";  // Guardar como logo.png
		
			// Obtener la información del archivo subido
			$fileTmpPath = $_FILES['file']['tmp_name'];
			$fileType = $_FILES['file']['type'];
		
			// Crear una imagen en memoria desde el archivo (soporte para JPG, PNG)
			switch ($fileType) {
				case 'image/jpeg':
					$image = imagecreatefromjpeg($fileTmpPath);
					break;
				case 'image/png':
					$image = imagecreatefrompng($fileTmpPath);
					break;
				case 'image/gif':
					$image = imagecreatefromgif($fileTmpPath);
					break;
				default:
					echo json_encode(["error" => "Formato no permitido"]);
					exit;
			}
		
			if (!$image) {
				echo json_encode(["error" => "No se pudo procesar la imagen"]);
				exit;
			}
		
			// Guardar la imagen en formato PNG
			imagepng($image, $targetFile1, 9); // Se guarda en calidad máxima (9)
			copy($targetFile1, $targetFile2);   // Se copia la misma imagen a logo.png
		
			// Liberar memoria
			imagedestroy($image);
		
			echo json_encode(["success" => "Imagen guardada correctamente como PNG"]);
		} else {
			echo json_encode(["error" => "No se recibió ninguna imagen"]);
		}	

	break;
	case 'registrar':
		$n_configuracion  = new configuracion();
		$n_notificacion = new notificacion();
		foreach ($_POST['dato'] as $key => $value) {
			$descripcion = $_POST['descripcion'][$key];
			$campo = $_POST['campo'][$key];
			$exist = $n_configuracion  -> exist_config($descripcion);
			if($exist==1){
				$resultado = $n_configuracion  -> modificar_configuracion($descripcion,$value,$descripcion,$campo);
			}else{
				$resultado = $n_configuracion  -> registrar_configuracion($value ,$descripcion,$campo);
			}
		}

		$n_notificacion -> registrar_notificacion("Configuración cambiada", "Fue cambiada la configuracion del sistema", false, $_SESSION['id_usuario'], "configuracion",1);

		//echo $resultado;
	break;
	case 'buscar':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> buscar_configuracion();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_configuracion'];
		?>
		<tr>
			<td><?= $key['id_configuracion']; ?></td>
			<td><?= $key['dato']; ?></td>
			<td><?= $key['descripcion']; ?></td>
			<td><?= $key['campo']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
						<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos('<?php echo $key['id_configuracion']; ?>', '<?php echo $key['dato']; ?>', '<?php echo $key['descripcion']; ?>', '<?php echo $key['campo']; ?>')">Modificar</a>
						<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_configuracion']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_configuracion  = new configuracion();
		$n_notificacion = new notificacion();
		$resultado = $n_configuracion  -> cambiar_estado_configuracion($id, $estado);
		if($estado==1){
			$estado = "activado";
		}else{
			$estado = "desactivado";
		}
		$n_notificacion -> registrar_notificacion("Cambio de estado de configuracion", "La configuracion con el id ".$id." esta ". $estado, false, $_SESSION['id_usuario'], "configuracion", $id);
		if($resultado==0){
			exit();
		}
		echo 1;
	break;
	case 'eliminar':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> eliminar_configuracion($id);
		$n_notificacion = new notificacion();
		$n_notificacion -> registrar_notificacion("Configuración eliminada", "La configuracion con el id ".$id." fue eliminada", false, $_SESSION['id_usuario'], "configuracion", $id);
		echo 1;
	break;
	case 'buscar_select':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> buscar_configuracion();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> buscar_json_configuracion($id);
		echo $resultado;
	break;
	case 'buscar_json_general':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> buscar_json_configuracion_general();
		echo $resultado;
	break;
	case 'modificar':
		$n_configuracion  = new configuracion();
		$n_notificacion = new notificacion();
		$resultado = $n_configuracion  -> modificar_configuracion($id,$dato,$descripcion,$campo);
		$n_notificacion -> registrar_notificacion("Configuración modificada", "La configuracion con el id".$id." fue modificada", false, $_SESSION['id_usuario'], "configuracion", $id);
		echo 1;
	break;
	case 'test':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> test($id,$dato,$descripcion,$campo,$estado);
	break;
	default:
	break;
}
