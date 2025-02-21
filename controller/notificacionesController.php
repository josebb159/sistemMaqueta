<?php
ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include 'generalErrorController.php';
include '../model/notificacion.php';


if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {

	case 'buscar':
		$n_notificaciones  = new notificacion();
		$resultado = $n_notificaciones  -> buscar_notificaciones_general();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
		?>
		<tr>
			<td><?= $key['id']; ?></td>
			<td><?= $key['descripcion']; ?></td>
			<td><?= $key['usuario']; ?></td>
			<td><?= $key['fecha_registro']; ?></td>
			<td><?= $key['tabla']; ?></td>
		</tr>
		<?php
		}
	break;
	
	default:
	break;
}
