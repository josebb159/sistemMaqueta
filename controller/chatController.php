<?php
include 'generalErrorController.php';
include '../model/chat.php';
include '../model/notificacion.php';

$n_notificacion = new notificacion();
session_start();
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['chat'])){
	$chat =  $_POST['chat'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $chat)) { die('error chat');}
}

if(isset($_POST['usuario'])){
	$usuario =  $_POST['usuario'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $usuario)) { die('error usuario');}
}

if(isset($_POST['especialista'])){
	$especialista =  $_POST['especialista'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $especialista)) { die('error especialista');}
}

if(isset($_POST['estado_visto'])){
	$estado_visto =  $_POST['estado_visto'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $estado_visto)) { die('error estado_visto');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_chat  = new chat();
		$resultado = $n_chat -> registrar_chat($chat, $usuario, $especialista, $estado_visto);
$n_notificacion -> registrar_notificacion('Registro chat', 'chat '.$chat.' fue registrada', false, $_SESSION['id_usuario'], 'chat', 'chat');
		echo 1;
	break;
	case 'buscar':
		$n_chat  = new chat();
		$resultado = $n_chat  -> buscar_chat();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_chat'];
		?>
		<tr>
			<td><?= $key['id_chat']; ?></td>
			<td><?= $key['chat']; ?></td>
			<td><?= $key['usuario']; ?></td>
			<td><?= $key['especialista']; ?></td>
			<td><?= $key['estado_visto']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_chat']."','".$key['chat']."','".$key['usuario']."','".$key['especialista']."','".$key['estado_visto']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_chat']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_chat  = new chat();
		$resultado = $n_chat  -> cambiar_estado_chat($id, $estado);
$n_notificacion -> registrar_notificacion('Cambio status chat', 'chat '.$id.' fue cambiado de status', false, $_SESSION['id_usuario'], 'chat', $id);
		echo 1;
	break;
	case 'eliminar':
		$n_chat  = new chat();
		$resultado = $n_chat  -> eliminar_chat($id);
$n_notificacion -> registrar_notificacion('chat eliminada', 'chat '.$id.' fue eliminado', false, $_SESSION['id_usuario'], 'chat', $id);
		echo 1;
	break;
	case 'buscar_select':
		$n_chat  = new chat();
		$resultado = $n_chat  -> buscar_chat();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_chat  = new chat();
		$resultado = $n_chat  -> buscar_json_chat($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_chat  = new chat();
		$resultado = $n_chat  -> modificar_chat($id,$chat,$usuario,$especialista,$estado_visto);
$n_notificacion -> registrar_notificacion('modificado chat', 'chat '.$chat.' fue modificado', false, $_SESSION['id_usuario'], 'chat', $id);
		echo 1;
	break;
	case 'test':
		$n_chat  = new chat();
		$resultado = $n_chat  -> test($id,$chat,$usuario,$especialista,$estado_visto,$estado);
	break;
	default:
	break;
}
