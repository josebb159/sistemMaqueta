<?php
ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include 'generalErrorController.php';
include '../model/myaccount.php';

session_start();
$myaccount = new myaccount();

if(isset($_POST['id_usuario'])){
    $id_usuario = $_POST['id_usuario'];
}

if(isset($_POST['nombre'])){
    $nombre = $_POST['nombre'];
}

if(isset($_POST['email'])){
    $email = $_POST['email'];
}

if(isset($_POST['telefono'])){
    $telefono = $_POST['telefono'];
}

if(isset($_POST['password'])){
    $password = $_POST['password'];
}

if(isset($_POST['confirm_password'])){
    $confirm_password = $_POST['confirm_password'];
}

if(isset($_FILES['imagen_perfil'])){
    $imagen_perfil = $_FILES['imagen_perfil'];
}

if(isset($_POST['op'])){
    $op = $_POST['op'];
}

switch ($op) {
    case 'actualizar':
        $resultado = $myaccount->actualizar_usuario($id_usuario, $nombre, $email, $telefono);
        echo $resultado;
        break;
    case 'cambiar_contrasena':
        if($password == $confirm_password){
            $resultado = $myaccount->cambiar_contrasena($id_usuario, $password);
            echo $resultado;
        } else {
            echo 'Las contraseñas no coinciden';
        }
        break;
    case 'cambiar_imagen':

        $nombreImagen = generarNombreAleatorio(20);
		$archivoImagen = $_FILES['imagen_perfil']['tmp_name'];
		$destinoImagen = '../assets/upload/usuario/' . $nombreImagen.".jpg";

		if (move_uploaded_file($archivoImagen, $destinoImagen)) {
			// La imagen se ha guardado correctamente
			// Puedes realizar otras operaciones aquí, como guardar los datos en una base de datos
			// o realizar alguna otra tarea adicional
            $resultado = $myaccount->actualizar_imagen($id_usuario,  $nombreImagen.".jpg");
            $_SESSION['img'] = $nombreImagen.".jpg";
            echo json_encode(['nueva_imagen' => $destinoImagen]);
			//echo json_encode(array('status' => 'success', 'message' => 'Imagen guardada correctamente', 'nombreImagen' => $nombreImagen.".jpg"));
			// Envía una respuesta a Ajax indicando que todo ha ido bien
		///	echo json_encode(array('status' => 'success', 'message' => 'Imagen guardada correctamente'));
		} else {
			// Ocurrió un error al guardar la imagen
			//echo json_encode(array('status' => 'error', 'message' => 'Error al guardar la imagen'));
		}
    break;        
        case 'obtener_datos_usuario':
            $id_usuario = $_POST['id_usuario'] ?? null;
            if ($id_usuario) {
                $usuario = $myaccount->obtener_datos_usuario($id_usuario);
                echo json_encode($usuario);
            } else {
                echo json_encode(array('error' => 'ID de usuario no encontrado en sesión'));
            }
            break;
            case 'obtener_datos_correo':
                $email = $_POST['email'] ?? null;
                if ($email) {
                    $usuario = $myaccount->obtener_datos_correo($email);
                    echo json_encode($usuario);
                } else {
                    echo json_encode(array('error' => 'Correo no encontrado'));
                }
                break;
    default:
        //$usuario = $myaccount->obtener_usuario($id_usuario);
        //echo json_encode($usuario);
        break;
}

function generarNombreAleatorio($longitud) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $nombreAleatorio = '';

    for ($i = 0; $i < $longitud; $i++) {
        $indice = rand(0, strlen($caracteres) - 1);
        $nombreAleatorio .= $caracteres[$indice];
    }

    return $nombreAleatorio;
}

?>