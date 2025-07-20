<?php
include 'generalErrorController.php';
include '../model/especialista.php';
include '../model/notificacion.php';

$n_notificacion = new notificacion();
session_start();
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['id_usuarios'])){
	$id_usuarios =  $_POST['id_usuarios'];
}

if(isset($_POST['foto'])){
	$foto =  $_POST['foto'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $foto)) { die('error foto');}
}

if(isset($_POST['nombre_completo'])){
	$nombre_completo =  $_POST['nombre_completo'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nombre_completo)) { die('error nombre_completo');}
}

if(isset($_POST['telefono'])){
	$telefono =  $_POST['telefono'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $telefono)) { die('error telefono');}
}

if(isset($_POST['correo'])){
	$correo =  $_POST['correo'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $correo)) { die('error correo');}
}

if(isset($_POST['categories_selected'])){
	$categories_selected =  $_POST['categories_selected'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $categories_selected)) { die('error categories_selected');}
}

if(isset($_POST['anio_experiencia'])){
	$anio_experiencia =  $_POST['anio_experiencia'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $anio_experiencia)) { die('error anio_experiencia');}
}

if(isset($_POST['metodos_pago'])){
	$metodos_pago =  $_POST['metodos_pago'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $metodos_pago)) { die('error metodos_pago');}
}

if(isset($_POST['cartera'])){
	$cartera =  $_POST['cartera'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $cartera)) { die('error cartera');}
}

if(isset($_POST['antecedentes'])){
	$antecedentes =  $_POST['antecedentes'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $antecedentes)) { die('error antecedentes');}
}

if(isset($_POST['cedula_frontal'])){
	$cedula_frontal =  $_POST['cedula_frontal'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $cedula_frontal)) { die('error cedula_frontal');}
}

if(isset($_POST['cedula_trasera'])){
	$cedula_trasera =  $_POST['cedula_trasera'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $cedula_trasera)) { die('error cedula_trasera');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_especialista  = new especialista();
		$resultado = $n_especialista -> registrar_especialista($id_usuarios, $foto, $nombre_completo, $telefono, $correo, $categories_selected, $anio_experiencia, $metodos_pago, $cartera, $antecedentes, $cedula_frontal, $cedula_trasera);
$n_notificacion -> registrar_notificacion('Registro especialista', 'especialista '.$foto.' fue registrada', false, $_SESSION['id_usuario'], 'especialista', 'foto');
		echo 1;
	break;
	case 'buscar':
		$n_especialista  = new especialista();
		$resultado = $n_especialista  -> buscar_especialista();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_especialista'];
		?>
		<tr>
			<td><?= $key['id_especialista']; ?></td>
			<td><?= $key['foto']; ?></td>
			<td><?= $key['nombre_completo']; ?></td>
			<td><?= $key['telefono']; ?></td>
			<td><?= $key['correo']; ?></td>
			<td><?= $key['categories_selected']; ?></td>
			<td><?= $key['anio_experiencia']; ?></td>
			<td><?= $key['metodos_pago']; ?></td>
			<td><?= $key['cartera']; ?></td>
			<td><?= $key['antecedentes']; ?></td>
			<td><?= $key['cedula_frontal']; ?></td>
			<td><?= $key['cedula_trasera']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_especialista']."','".$key['foto']."','".$key['nombre_completo']."','".$key['telefono']."','".$key['correo']."','".$key['categories_selected']."','".$key['anio_experiencia']."','".$key['metodos_pago']."','".$key['cartera']."','".$key['antecedentes']."','".$key['cedula_frontal']."','".$key['cedula_trasera']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_especialista']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_especialista  = new especialista();
		$resultado = $n_especialista  -> cambiar_estado_especialista($id, $estado);
$n_notificacion -> registrar_notificacion('Cambio status especialista', 'especialista '.$id.' fue cambiado de status', false, $_SESSION['id_usuario'], 'especialista', $id);
		echo 1;
	break;
	case 'eliminar':
		$n_especialista  = new especialista();
		$resultado = $n_especialista  -> eliminar_especialista($id);
$n_notificacion -> registrar_notificacion('especialista eliminada', 'especialista '.$id.' fue eliminado', false, $_SESSION['id_usuario'], 'especialista', $id);
		echo 1;
	break;
	case 'buscar_select':
		$n_especialista  = new especialista();
		$resultado = $n_especialista  -> buscar_especialista();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_especialista  = new especialista();
		$resultado = $n_especialista  -> buscar_json_especialista($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_especialista  = new especialista();
		$resultado = $n_especialista  -> modificar_especialista($id,$id_usuarios,$foto,$nombre_completo,$telefono,$correo,$categories_selected,$anio_experiencia,$metodos_pago,$cartera,$antecedentes,$cedula_frontal,$cedula_trasera);
$n_notificacion -> registrar_notificacion('modificado especialista', 'especialista '.$foto.' fue modificado', false, $_SESSION['id_usuario'], 'especialista', $id);
		echo 1;
	break;
	case 'test':
		$n_especialista  = new especialista();
		$resultado = $n_especialista  -> test($id,$foto,$nombre_completo,$telefono,$correo,$categories_selected,$anio_experiencia,$metodos_pago,$cartera,$antecedentes,$cedula_frontal,$cedula_trasera,$estado);
	break;
	default:
	break;
}
