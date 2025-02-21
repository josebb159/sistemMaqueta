<?php
//session_start();
if(isset($conect)){

    if($conect==1){

    }else{
        include 'db.php';
        $conect =1;
    }
    
 
}else{
    include 'db.php';
    $conect =1;
}
class usuario {
    public $rol; 

    public function registrar_usuario($rol, $nombre, $apellido, $usuario, $contrasena, $sucursal) {
        $conexion = new Conexion();
        $estado_defaul = 1;
    
        // Verificar si el correo ya existe
        $sql_verificar = "SELECT COUNT(*) FROM `usuarios` WHERE `email` = :email";
        $stmt = $conexion->prepare($sql_verificar);
        $stmt->execute([':email' => $usuario]);
        $existe = $stmt->fetchColumn();
    
        if ($existe > 0) {
            return "existe"; // Retorna "existe" si el correo ya está registrado
        }
    
        // Encriptar la contraseña antes de guardarla
        $contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);
    
        // Insertar el nuevo usuario
        $sql = "INSERT INTO `usuarios`(`id_rol`, `nombre`, `email`, `contrasena`, `estado`, `id_sucursal`) 
                VALUES (:rol, :nombre, :email, :contrasena, :estado, :sucursal)";
        $reg = $conexion->prepare($sql);
    
        $reg->execute([
            ':rol' => $rol,
            ':nombre' => $nombre,
            ':email' => $usuario,
            ':contrasena' => $contrasena_hash,
            ':estado' => $estado_defaul,
            ':sucursal' => $sucursal
        ]);
    
        return $conexion->lastInsertId();
    }
    


    public function total_usuarios(){
   
        $conexion = new Conexion();
    
        $sql = "SELECT count(*) FROM usuarios where estado !=3 limit 1";
        $reg = $conexion->prepare($sql);
    
        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
    
            return $consulta;
    
        }else{
            return 0;
        }
    }

    public function buscar_usuarios(){
   
        $conexion = new Conexion();
    
        $sql = "SELECT usuarios.* FROM usuarios, rol WHERE rol.id=usuarios.id_rol and usuarios.estado !=3; ";
        $reg = $conexion->prepare($sql);
    
        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
    
            return $consulta;
    
        }else{
            return 0;
        }
    }

    public function buscar_usuarios_system(){
   
        $conexion = new Conexion();
    
        $sql = "SELECT usuarios.*, rol.descripcion as rol FROM usuarios, rol WHERE rol.id=usuarios.id_rol  and usuarios.estado !=3";
        $reg = $conexion->prepare($sql);
    
        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
    
            return $consulta;
    
        }else{
            return 0;
        }
    }

    public function buscar_usuarios_gerente($id_sucursal){
   
        $conexion = new Conexion();
    
        $sql = "SELECT usuarios.*, rol.descripcion as rol FROM usuarios, rol WHERE rol.id=usuarios.id_rol and rol.id !=2 and  rol.id !=1 and usuarios.id_sucursal = ".$id_sucursal;
        $reg = $conexion->prepare($sql);
    
        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
    
            return $consulta;
    
        }else{
            return 0;
        }
    }




    public function buscar_usuarios_afiliado(){
   
        $conexion = new Conexion();
    
        $sql = "SELECT afiliado.codigo, usuarios.email FROM usuarios, afiliado where usuarios.id=afiliado.id_usuarios and afiliado.estado !=3; ";
        $reg = $conexion->prepare($sql);
    
        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
    
            return $consulta;
    
        }else{
            return 0;
        }
    }


    public function get_rol(){
   
        $conexion = new Conexion();
    
        $sql = "SELECT * FROM `rol`";
        $reg = $conexion->prepare($sql);
    
        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
    
            return $consulta;
    
        }else{
            return 0;
        }
    }

    public function get_rol_gerente($ids){
   
        $conexion = new Conexion();
    
        $sql = "SELECT * FROM `rol` where id in (".$ids.")";
        $reg = $conexion->prepare($sql);
    
        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
    
            return $consulta;
    
        }else{
            return 0;
        }
    }
    
    
    
        public function buscar_contrasena($email){
   
        $conexion = new Conexion();
    
        $sql = "SELECT  usuarios.nombre, `contrasena` FROM usuarios, rol WHERE rol.id=usuarios.id_rol and usuarios.email='".$email."'; ";
        $reg = $conexion->prepare($sql);
    
        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
    
            return $consulta;
    
        }else{
            return 0;
        }
    }
    
    
    


    public function login($usuario, $contrasena) {
        $conexion = new Conexion();
    
        // Primer SQL para obtener el usuario
        $sql = "SELECT * FROM usuarios WHERE email = :email AND estado = 1";
        $reg = $conexion->prepare($sql);
        $reg->execute(array(':email' => $usuario));
        $usuario = $reg->fetch(PDO::FETCH_ASSOC);
        if ($usuario) {
            // Verificar la contraseña usando password_verify
            if (password_verify(trim($contrasena), $usuario['contrasena'])) {
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['id_usuario'] = $usuario['id'];
                $_SESSION['img'] = $usuario['img'];
                $_SESSION['id_rol'] = $usuario['id_rol'];

                $_SESSION['codigo'] = "system"; // Puedes personalizar esto si lo deseas
                $this->rol = $usuario['id_rol'];

                $this->update_last_login($usuario['id'], $_SERVER['REMOTE_ADDR']);

                return 1;
            }
        }
    
        return false;
    }

    public function login_app($usuario, $contrasena) {
        $conexion = new Conexion();
    
        // Primer SQL para obtener el usuario
        $sql = "SELECT * FROM usuarios WHERE id_rol = 5 AND email = :email AND estado = 1";
        $reg = $conexion->prepare($sql);
        $reg->execute(array(':email' => $usuario));
        $usuario = $reg->fetch(PDO::FETCH_ASSOC);
        if ($usuario) {
            // Verificar la contraseña usando password_verify
            if (password_verify(trim($contrasena), $usuario['contrasena'])) {
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['id_usuario'] = $usuario['id'];
                $_SESSION['img'] = $usuario['img'];
                $_SESSION['id_rol'] = $usuario['id_rol'];

                if($usuario['id_sucursal']!=""){
                    $_SESSION['id_sucursal'] = $usuario['id_sucursal'];
                }

                $_SESSION['codigo'] = "system"; // Puedes personalizar esto si lo deseas
                $this->rol = $usuario['id_rol'];

                $this->update_last_login($usuario['id'], $_SERVER['REMOTE_ADDR']);

                return 1;
            }
        }
    
        return false;
    }

    public function update_last_login($id, $ip){
   
        $conexion = new Conexion();
        $estado_defaul = 1;
    
        $sql = "UPDATE `usuarios` SET `ip`=:ip , `init_sesion`=now() WHERE id=:id";
        $reg = $conexion->prepare($sql);
    
        $reg->execute(array(':id' => $id, ':ip' => $ip));
    
    
    }
    
    


    public function obtener_rol(){


        $conexion = new Conexion();


        $sql = "SELECT  * FROM rol where id='".$this->rol."' ";
       
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
            foreach ($consulta as $key) {

                $_SESSION['rol'] =  $key['nombre'];
    
            }
            
    
        }
        
    }



    
public function cambiar_estado_usuario($id, $estado){
   
    $conexion = new Conexion();
    $estado_defaul = 1;

    $sql = "UPDATE `usuarios` SET `estado`=:estado WHERE id=:id";
    $reg = $conexion->prepare($sql);

    $reg->execute(array(':id' => $id, ':estado' => $estado));


}

public function eliminar_usuario($id){
   
    $conexion = new Conexion();
    $estado_defaul = 1;

    $sql = "UPDATE `usuarios` SET `estado`=3  WHERE id=:id";
    $reg = $conexion->prepare($sql);

    $reg->execute(array(':id' => $id));


}

public function modificar_usuario($id,$nombre,$telefono ){
   
    $conexion = new Conexion();
  

    $sql = "UPDATE `usuarios` SET `nombre`=:nombre, `telefono`=:telefono  WHERE id=:id";
    $reg = $conexion->prepare($sql);

    $reg->execute(array(':id' => $id ,':nombre' => $nombre, ':telefono' => $telefono));

    return 1;
}

 

public function buscar_usuario_json($id){
   
    $conexion = new Conexion();

    $sql = "SELECT  * FROM usuarios where id=".$id."";
    $reg = $conexion->prepare($sql);

    $reg->execute();

    $results = $reg->fetchAll(PDO::FETCH_ASSOC);
    return $json = json_encode($results);

}

public function total_afiliados(){

    $conexion = new Conexion();

    $sql = "SELECT  count(id) as total FROM usuarios";
    $reg = $conexion->prepare($sql);


    $reg->execute();
    $consulta =$reg->fetchAll();
    $total = 0;
    if ($consulta) {
            foreach ($consulta as $key) {

                $total=  $key['total'];
    
            }
            
    
        }
        return $total;
}




}


?>