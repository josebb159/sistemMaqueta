<!--- Sidemenu -->
<?php 

if(isset($_GET['view'])){
   $valor = $_GET['view'];

}else{
    $valor ="dashboard";
}



?>



<div id="sidebar-menu">
                    <!-- Left Menu Start -->
   <ul class="metismenu list-unstyled" id="side-menu">
   <li class="menu-title">Menu</li>
  
 
	<li>
		 <a href="home.php?view=monedero" class=" waves-effect <?php if($valor=="monedero"){ echo "active mm-active"; } ?>">
			<i class="mdi mdi-wallet"></i>
			<span>Monedero</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=transaccionesretiro" class=" waves-effect <?php if($valor=="transaccionesretiro"){ echo "active mm-active"; } ?>">
			<i class="mdi mdi-swap-horizontal"></i>
			<span>Transacciones Retiro</span>
		</a>
	</li>
	
<!--construir-->

                    </ul>
                </div>		
        
        