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
            <a href="home.php?" class="waves-effect <?php if($valor == 'dashboard') echo 'active mm-active'; ?>">
                <i class="mdi mdi-view-dashboard"></i>
                <span>Panel Administrativo</span>
            </a>
        </li>

        <li>
            <a href="home.php?view=usuarios" class="waves-effect <?php if($valor == 'usuarios') echo 'active mm-active'; ?>">
                <i class="mdi mdi-account-multiple"></i>
                <span>Usuarios</span>
            </a>
        </li>

        <li>
            <a href="home.php?view=configuracion" class="waves-effect <?php if($valor == 'configuracion') echo 'active mm-active'; ?>">
                <i class="mdi mdi-cog"></i>
                <span>Configuración</span>
            </a>
        </li>

        <li>
            <a href="home.php?view=notificaciones" class="waves-effect <?php if($valor == 'notificaciones') echo 'active mm-active'; ?>">
                <i class="mdi mdi-bell-ring"></i>
                <span>Notificaciones</span>
            </a>
        </li>

        <li>
            <a href="home.php?view=payments" class="waves-effect <?php if($valor == 'payments') echo 'active mm-active'; ?>">
                <i class="mdi mdi-credit-card-outline"></i>
                <span>Métodos de pago</span>
            </a>
        </li>

        <li>
            <a href="home.php?view=categories" class="waves-effect <?php if($valor == 'categories') echo 'active mm-active'; ?>">
                <i class="mdi mdi-shape-outline"></i>
                <span>Categorías</span>
            </a>
        </li>

        <li>
            <a href="home.php?view=subcategories" class="waves-effect <?php if($valor == 'subcategories') echo 'active mm-active'; ?>">
                <i class="mdi mdi-shape-plus-outline"></i>
                <span>Sub-categorías</span>
            </a>
        </li>

        <li>
            <a href="home.php?view=especialista" class="waves-effect <?php if($valor == 'especialista') echo 'active mm-active'; ?>">
                <i class="mdi mdi-account-tie-outline"></i>
                <span>Especialista</span>
            </a>
        </li>

        <li style="display: none;">
            <a href="home.php?view=logs" class="waves-effect <?php if($valor == 'logs') echo 'active mm-active'; ?>">
                <i class="mdi mdi-book-open-variant"></i>
                <span>Logs</span>
            </a>
        </li>
    </ul>
</div>
