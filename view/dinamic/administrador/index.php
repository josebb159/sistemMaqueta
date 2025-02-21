<?php

include '../model/usuario.php';

$usuario = new usuario();

?>
<!-- jquery.vectormap css -->
<link href="../assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
    type="text/css" />

<!-- DataTables -->
<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Panel Administrativo</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo NAME_CLIENT; ?></a></li>
                            <li class="breadcrumb-item active">Panel Administrativo</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-8">
            <div class="row">
    <div class="col-md-4">
        <div class="card card-afiliado">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-1 overflow-hidden">
                        <p class="font-size-14 mb-2">Total de Productos</p>
                        <h4 class="mb-0" id="comercios" style="color: white">0</h4>
                    </div>
                    <div class="ms-auto">
                        <i class="ri-store-2-line font-size-24"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-venta">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-1 overflow-hidden">
                        <p class="font-size-14 mb-2">Total Productos en Transito</p>
                        <h4 class="mb-0" id="ventas" style="color: white"> 0</h4>
                    </div>
                    <div class="ms-auto">
                        <i class="ri-truck-line font-size-24"></i> <!-- Ejemplo de icono de camión -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-transaccion">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-1 overflow-hidden">
                        <p class="font-size-14 mb-2">Total Productos Entregados</p>
                        <h4 class="mb-0" id="domiciliario" style="color: white">0</h4>
                    </div>
                    <div class="ms-auto">
                        <i class="ri-inbox-archive-line font-size-24"></i> <!-- Ejemplo de icono de paquete -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                <!-- end row -->

                <div class="card">
                    <div class="card-body">
                        <div class="float-end d-none d-md-inline-block">
                        
                        </div>
                        <h4 class="card-title mb-4">Análisis de Ingresos</h4>
                        <div>
                            <div id="line-column-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>

                    <div class="card-body border-top text-center">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="d-inline-flex">
                                    <h5 class="me-2">$<?php echo  0; ?></h5>
                                    <div class="text-success">
                                    </div>
                                </div>
                                <p class="text-muted text-truncate mb-0">Este Mes</p>
                            </div>

                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <p class="mb-2 text-muted text-truncate"><i
                                            class="mdi mdi-circle text-primary font-size-10 me-1"></i> Este Año:</p>
                                    <div class="d-inline-flex">
                                        <h5 class="mb-0 me-2">$ <?php echo 0; ?></h5>
                                        <div class="text-success">
                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <p class="mb-2 text-muted text-truncate"><i
                                            class="mdi mdi-circle text-success font-size-10 me-1"></i> Año Anterior:
                                    </p>
                                    <div class="d-inline-flex">
                                        <h5 class="mb-0">$ <?php echo  0; ?></h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            
                        </div>
                        <h4 class="card-title mb-4">Análisis de Ventas</h4>

                        <div id="donut-chart" class="apex-charts"></div>

                        <div class="row">
                            <!--
                            <?php  if ($producto_mas_vendido != null){ foreach ($producto_mas_vendido as $producto){ ?>

                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <p class="mb-2 text-truncate"><i
                                            class="mdi mdi-circle text-primary font-size-10 me-1"></i> <?php echo $producto['nombre']; ?></p>
                                    <h5><?php echo $producto['porcentaje']; ?> %</h5>
                                </div>
                            </div>
                            <?php }}else{ echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No hay productos vendidos";} ?>
                         -->
                            
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                         
                        </div>

                        <h4 class="card-title mb-4">Informes de Ingresos</h4>
                        <div class="text-center">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <div class="mb-3">
                                            <div id="radialchart-1" class="apex-charts"></div>
                                        </div>

                                        <p class="text-muted text-truncate mb-2">Ingresos Semanales</p>
                                        <h5 class="mb-0">$<?php echo $ingreso_semanal ?: 0; ?></h5>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mt-5 mt-sm-0">
                                        <div class="mb-3">
                                            <div id="radialchart-2" class="apex-charts"></div>
                                        </div>

                                        <p class="text-muted text-truncate mb-2">Ingresos Mensuales</p>
                                        <h5 class="mb-0">$ <?php echo $ingreso_mes ?: 0; ?></h5>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                                
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                         
                          
                        </div>

                        <h4 class="card-title mb-4">Fuente de Actividad Reciente</h4>

                        <div data-simplebar style="max-height: 330px;">
                            <ul class="list-unstyled activity-wid">
                                <?php if ($actividades != null){ foreach ($actividades as $actividad){ ?>
                                <li class="activity-list">
                                    <div class="activity-icon avatar-xs">
                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                            <i class="ri-user-2-fill"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <div>
                                            <h5 class="font-size-13"><?php echo $actividad['fecha_registro']; ?> </h5> - 
                                            <h7 class="font-size-13"><?php echo $actividad['nombre']; ?> </h7>
                                        </div>

                                        <div>
                                            <p class="text-muted mb-0"><?php echo $actividad['descripcion']; ?></p>
                                        </div>
                                    </div>
                                </li>
                                <?php }} else{ echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No hay actividades";} ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            
                        </div>

                        <h4 class="card-title mb-4">Ingresos por Ubicaciones</h4>

                        <div id="usa-vectormap" style="height: 196px"></div>

                        <div class="row justify-content-center">
                            <div class="col-xl-5 col-md-6">
                                <div class="mt-2">
                                    <div class="clearfix py-2">
                                        <h5 class="float-end font-size-16 m-0">$ 2542</h5>
                                        <p class="text-muted mb-0 text-truncate">Cucuta :</p>

                                    </div>
                                    <div class="clearfix py-2">
                                        <h5 class="float-end font-size-16 m-0">$ 2245</h5>
                                        <p class="text-muted mb-0 text-truncate">Cucuta :</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 offset-xl-1 col-md-6">
                                <div class="mt-2">
                                    <div class="clearfix py-2">
                                        <h5 class="float-end font-size-16 m-0">$ 2156</h5>
                                        <p class="text-muted mb-0 text-truncate">Chitaga :</p>

                                    </div>
                                    <div class="clearfix py-2">
                                        <h5 class="float-end font-size-16 m-0">$ 1845</h5>
                                        <p class="text-muted mb-0 text-truncate">Chitaga :</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="#" class="btn btn-primary btn-sm">Aprende Más</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
           
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>

                        <h4 class="card-title mb-4">Últimas Transacciones</h4>

                        <div class="table-responsive">
                            <table class="table table-centered datatable dt-responsive nowrap" data-bs-page-length="5"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>FECHA</th>
                                        <th>PRODUCTO</th>
                                        <th>ESTADO</th>
                                        <th>CANTIDAD</th>
                                       
                                    </tr>
                                </thead>
                                <tbody id="datos">
                                    <?php if ($transacciones != null){ foreach ($transacciones as $transaccion){ 
                                     $transaccion['estado'] =$estados_t[$transaccion['tipo_transaccion']];
                                        ?>
                                    <tr>
                                        <td><?php echo $transaccion['id_transacciones']; ?></td>
                                        <td><?php echo $transaccion['fecha_registro']; ?></td>
                                        <td><?php echo $transaccion['producto']; ?></td>
                                        <td><span class="badge bg-success"><?php echo $transaccion['estado']; ?></span></td>
                                        <td><?php echo $transaccion['valor']; ?></td>
                                       
                                    </tr>
                                    <?php }} else{ echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No hay transacciones";} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>

</div>
<!-- End Page-content -->

<!-- apexcharts -->
<script src="../assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- jquery.vectormap map -->
<script src="../assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

<!-- Required datatable js -->
<script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="../assets/js/pages/dashboard.init.js"></script>