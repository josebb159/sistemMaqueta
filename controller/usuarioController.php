<?php
ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/usuario.php';
include '../model/notificacion.php';


if (isset($_POST['id'])) {
   $id =  $_POST['id'];
}

if (isset($_POST['rol'])) {
   $rol =  $_POST['rol'];
}

if (isset($_POST['nombre'])) {
   $nombre =  $_POST['nombre'];
}

if (isset($_POST['apellido'])) {
   $apellido =  $_POST['apellido'];
}



if (isset($_POST['usuario'])) {
   $usuario =  $_POST['usuario'];
}

if (isset($_POST['contrasena'])) {
   $contrasena =  $_POST['contrasena'];
}

if (isset($_POST['estado'])) {
   $estado =  $_POST['estado'];
}

if (isset($_POST['rol'])) {
   $rol =  $_POST['rol'];
}

if (isset($_POST['telefono'])) {
   $telefono =  $_POST['telefono'];
}


if(isset($_POST['sucursal'])){
   $sucursal =  $_POST['sucursal'];
}


 if(isset($_POST['op'])){
    $op =  $_POST['op'];
 }



switch ($op) {
   case 'login':
      $n_usuario  = new usuario();


      $resultado = $n_usuario->login($usuario, $contrasena);
      if ($resultado == TRUE) {
         $n_usuario->obtener_rol();
      }

      echo $resultado;

        
   break;
   case 'login_app':
      $n_usuario  = new usuario();


      $resultado = $n_usuario->login_app($usuario, $contrasena);
      if ($resultado == TRUE) {
         $n_usuario->obtener_rol();
      }

      echo $resultado;

        
   break;
   case 'registrar':
      $n_usuario  = new usuario();
      $n_notificacion = new notificacion();
  
      if (!$sucursal) {
          $sucursal = "";
      }
  
      $resultado = $n_usuario->registrar_usuario($rol, $nombre, "", $usuario, $contrasena, $sucursal);
  
      if ($resultado === "existe") {
          echo "El correo ya está registrado";
      } else {
          $n_notificacion->registrar_notificacion("Registro nuevo usuario", "El usuario " . $nombre . " fue registrado", false, $_SESSION['id_usuario'], "usuarios", $resultado);
          echo 1;
      }
      break;
     
         default:
         case 'buscar':

      $n_usuario  = new usuario();
      $resultado = $n_usuario->buscar_usuarios();


      foreach ($resultado as $key) {
         if ($key['estado'] == "1") {
            $st = " checked";
         } else {
            $st = "";
         }

?>
         <tr>
            <td><?php echo $key['id']; ?></td>
            <td><?php echo $key['nombre']; ?></td>

            <td><?php echo $key['email']; ?></td>
            
            <td><?php echo $key['fecha_registro']; ?></td>
            <td>
               <?php include '../view/static/bt_estado.php';  ?>
            </td>
            <td>
               <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Acciones
                     <i class="mdi mdi-chevron-down"></i>
                  </button>

               </div>
            </td>

         </tr>


      <?php




      }

   break;
   case 'buscar_system':

      $n_usuario  = new usuario();
      $resultado = $n_usuario->buscar_usuarios_system();


      foreach ($resultado as $key) {
         if ($key['estado'] == "1") {
            $st = " checked";
         } else {
            $st = "";
         }

      ?>
         <tr>
            <td><?php echo $key['id']; ?></td>
            <td><?php echo $key['nombre']; ?></td>
            <td><?php echo $key['rol']; ?></td>

            <td><?php echo $key['email']; ?></td>
            
            <td><?php echo $key['fecha_registro']; ?></td>
            <td>
               <?php include '../view/static/bt_estado.php';  ?>
            </td>
            <td>
            <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Acciones
                     <i class="mdi mdi-chevron-down"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
                     <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos('<?php echo $key['id']; ?>', '<?php echo $key['telefono']; ?>' , '<?php echo $key['nombre']; ?>')">Modificar</a>
                     <a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id']; ?>)">Eliminar</a>
                  </div>
               </div>
            </td>

         </tr>


      <?php




      }

      break;
     case 'buscar_usuarios_gerente':

         $n_usuario  = new usuario();
         $sucursal  = $_SESSION['id_sucursal'];
         $resultado = $n_usuario->buscar_usuarios_gerente($sucursal);
   
         if($resultado==0){
            die();
         }
   
         foreach ($resultado as $key) {
            if ($key['estado'] == "1") {
               $st = " checked";
            } else {
               $st = "";
            }
   
         ?>
            <tr>
               <td><?php echo $key['id']; ?></td>
               <td><?php echo $key['nombre']; ?></td>
               <td><?php echo $key['rol']; ?></td>
   
               <td><?php echo $key['email']; ?></td>
               
               <td><?php echo $key['fecha_registro']; ?></td>
               <td>
                  <?php include '../view/static/bt_estado.php';  ?>
               </td>
               <td>
               <div class="dropdown">
                     <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acciones
                        <i class="mdi mdi-chevron-down"></i>
                     </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos('<?php echo $key['id']; ?>', '<?php echo $key['nombre']; ?>' , '<?php echo $key['contrasena']; ?>')">Modificar</a>
                        <a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id']; ?>)">Eliminar</a>
                     </div>
                  </div>
               </td>
   
            </tr>
   
   
         <?php
   
   
   
   
         }
   
         break;
   case 'buscar_select':

      $n_usuario  = new usuario();
      $resultado = $n_usuario->buscar_usuarios_afiliado();


      foreach ($resultado as $key) {

      ?>
         <option value="<?php echo $key['codigo']; ?>"><?php echo $key['email']; ?></option>
      <?php

           }
               
          break; 
          case 'buscar_select_sucursal':

            $n_usuario  = new sucursal();
            $resultado = $n_usuario -> buscar_sucursal();
        
            ?>
             <option value="">Seleccione</option>
             <?php

            foreach ($resultado as $key) {

               ?>
               <option value="<?php echo $key['id_sucursal']; ?>"><?php echo $key['nombre']; ?></option>
               <?php

           }
               
          break; 
          case 'buscar_select_sucursal_id':

            $n_usuario  = new sucursal();
            $resultado = $n_usuario -> buscar_sucursal_id($sucursal);
        
            foreach ($resultado as $key) {

               ?>
               <option value="<?php echo $key['id_sucursal']; ?>"><?php echo $key['nombre']; ?></option>
               <?php

           }
               
          break; 
          case 'get_rol':

      $n_usuario  = new usuario();
      $resultado = $n_usuario->get_rol();


      foreach ($resultado as $key) {

      ?>
         <option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>
<?php

      }

      break;
      case 'get_rol_gerente':

         $n_usuario  = new usuario();
         $resultado = $n_usuario->get_rol_gerente("3,4");
   
   
         foreach ($resultado as $key) {
   
         ?>
            <option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>
   <?php
   
         }
   
         break;
   

   case 'cambiar_estado':

      $n_usuario  = new usuario();
      $n_notificacion = new notificacion();
      $resultado = $n_usuario->cambiar_estado_usuario($id, $estado);
      if($estado==1){
			$estado = "activado";
		}else{
			$estado = "desactivado";
		}
		$n_notificacion -> registrar_notificacion("Cambio de estado del usuario", "El usuario con el id ".$id." esta ". $estado, false, $_SESSION['id_usuario'], "usuario", $id);
      echo 1;

      break;
   case 'eliminar':


      $n_usuario  = new usuario();
      $n_notificacion = new notificacion();
      $resultado = $n_usuario->eliminar_usuario($id);
      $n_notificacion ->registrar_notificacion("Usuario eliminado", "El usuario con el id ".$id." fue eliminado", false, $_SESSION['id_usuario'], "usuario", $id);
      echo 1;

      break;
   case 'buscar_modificar':

      $n_usuario  = new usuario();
      $resultado = $n_usuario->buscar_usuario_json($id);
      echo $resultado;

      break;
   case 'modificar':

      $n_usuario  = new usuario();
      $n_notificacion = new notificacion();
      $resultado = $n_usuario->modificar_usuario($id, $nombre, $telefono);
      $n_notificacion -> registrar_notificacion("Usuario modificado", "El usuario con el id ".$id." fue modificado", false, $_SESSION['id_usuario'], "usuario", $id);
      echo $resultado;

      break;
}


?>