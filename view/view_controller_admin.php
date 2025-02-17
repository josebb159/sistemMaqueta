<?php 
if(isset($_GET['view'])){

    if($_GET['view']=="usuarios"){
	
        include 'dinamic/administrador/usuario.php';
	
    }

	elseif($_GET['view']=="talla"){
		include 'dinamic/administrador/talla.php';
	}
	elseif($_GET['view']=="configuracion"){
		include 'dinamic/administrador/configuracion.php';
	}elseif($_GET['view']=="atributos"){
		include 'dinamic/administrador/atributos.php';
	}elseif($_GET['view']=="tipo_atributo"){
		include 'dinamic/administrador/tipo_atributo.php';
	}
	elseif($_GET['view']=="inventario"){
		include 'dinamic/administrador/inventario.php';
	}
	elseif($_GET['view']=="producto"){
		include 'dinamic/administrador/producto.php';
	}
	elseif($_GET['view']=="transacciones"){
		include 'dinamic/administrador/transacciones.php';
	}
	elseif($_GET['view']=="proveedor"){
		include 'dinamic/administrador/proveedor.php';
	}
	elseif($_GET['view']=="estados_inventario"){
		include 'dinamic/administrador/estados_inventario.php';
	}
	elseif($_GET['view']=="sucursal"){
		include 'dinamic/administrador/sucursal.php';
	}
	elseif($_GET['view']=="categoria"){
		include 'dinamic/administrador/categoria.php';
	}
	elseif($_GET['view']=="logs"){
		include 'dinamic/administrador/logs.php';
	}
	elseif($_GET['view']=="notificaciones"){
		include 'dinamic/administrador/notificaciones.php';
	}
	elseif($_GET['view']=="myaccount"){
		include 'dinamic/administrador/myaccount.php';
	}
	elseif($_GET['view']=="salida_producto"){
		include 'dinamic/administrador/salida_producto.php';
	}
	elseif($_GET['view']=="transporte"){
		include 'dinamic/administrador/transporte.php';
	}
	elseif($_GET['view']=="envio"){
		include 'dinamic/administrador/envio.php';
	}
	elseif($_GET['view']=="embalaje"){
		include 'dinamic/administrador/embalaje.php';
	}
	elseif($_GET['view']=="espera_bodega"){
		include 'dinamic/administrador/espera_bodega.php';
	}
	elseif($_GET['view']=="venta"){
		include 'dinamic/administrador/venta.php';
	}
	elseif($_GET['view']=="maquina"){
		include 'dinamic/administrador/maquina.php';
	}
	elseif($_GET['view']=="entrega"){
		include 'dinamic/administrador/entrega.php';
	}
	elseif($_GET['view']=="productos_en_maquina"){
		include 'dinamic/administrador/productos_en_maquina.php';
	}
/*construir*/

    elseif($_GET['view']=="logout"){
        include 'logout.php';
    }
    

}else{
    include 'dinamic/administrador/index.php';
}
    
    



?>
