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
        <li class="menu-title">Menú</li>

        <li>
            <a href="home.php?" class="waves-effect <?php if($valor == "dashboard") { echo "active mm-active"; } ?>">
                <i class="mdi mdi-table-large"></i>
                <span>Panel Administrativo</span>
            </a>
        </li>

        <li>
            <a href="home.php?view=usuarios" class="waves-effect <?php if($valor == "usuarios") { echo "active mm-active"; } ?>">
                <i class="mdi mdi-account"></i>
                <span>Usuarios</span>
            </a>
        </li>
        <li>
            <a href="home.php?view=configuracion" class="waves-effect <?php if($valor == "configuracion") { echo "active mm-active"; } ?>">
                <i class="fas fa-fw fa-cog"></i>
                <span>Configuración</span>
            </a>
        </li>

        
        <!-- Dropdown for Producto -->
   

 
        <li style="display: none;">
            <a href="home.php?view=logs" class="waves-effect <?php if($valor == 'logs') { echo 'active mm-active'; } ?>">
                <i class="fas fa-fw fa-book"></i>
                <span>Logs</span>
            </a>
        </li>
        <li>
            <a href="home.php?view=notificaciones" class="waves-effect <?php if($valor == 'notificaciones') { echo 'active mm-active'; } ?>">
                <i class="fas fa-fw fa-bell"></i>
                <span>Notificaciones</span>
            </a>
        </li>
       
	<li>
		 <a href="home.php?view=payments" class=" waves-effect <?php if($valor=="payments"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>payments</span>
		</a>
	</li>
<!--construir-->
	<li>
    </ul>
</div>