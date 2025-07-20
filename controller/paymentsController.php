<?php
include 'generalErrorController.php';
include '../model/payments.php';
include '../model/notificacion.php';

$n_notificacion = new notificacion();
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['nombre'])){
	$nombre =  $_POST['nombre'];
}

if(isset($_POST['descripcion'])){
	$descripcion =  $_POST['descripcion'];
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}
		session_start();
switch ($op) {
	case 'registrar':

		$n_payments  = new payments();
		$resultado = $n_payments  -> registrar_payments($nombre,$descripcion,'');
$n_notificacion -> registrar_notificacion('Registro payments', 'payments '.$nombre.' fue registrada', false, $_SESSION['id_usuario'], 'payments', $resultado);
		echo 1;
	break;
	case 'buscar':
		$n_payments  = new payments();
		$resultado = $n_payments  -> buscar_payments();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_payments'];
		?>
		<tr>
			<td><?= $key['id_payments']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['descripcion']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_payments']."','".$key['nombre']."','".$key['descripcion']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_payments']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_payments  = new payments();
		$resultado = $n_payments  -> cambiar_estado_payments($id, $estado);
$n_notificacion -> registrar_notificacion('Cambio status payments', 'payments '.$id.' fue cambiado de status', false, $_SESSION['id_usuario'], 'payments', $id);
		echo 1;
	break;
	case 'eliminar':
		$n_payments  = new payments();
		$resultado = $n_payments  -> eliminar_payments($id);
$n_notificacion -> registrar_notificacion('payments eliminada', 'payments '.$id.' fue eliminado', false, $_SESSION['id_usuario'], 'payments', $id);
		echo 1;
	break;
	case 'buscar_select':
		$n_payments  = new payments();
		$resultado = $n_payments  -> buscar_payments();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_payments  = new payments();
		$resultado = $n_payments  -> buscar_json_payments($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_payments  = new payments();
		$resultado = $n_payments  -> modificar_payments($id,$nombre,$descripcion);
$n_notificacion -> registrar_notificacion('modificado payments', 'payments '.$nombre.' fue modificado', false, $_SESSION['id_usuario'], 'payments', $id);
		echo 1;
	break;
	case 'test':
		$n_payments  = new payments();
		$resultado = $n_payments  -> test($id,$nombre,$descripcion,$estado);
	break;
	default:
	break;
}
