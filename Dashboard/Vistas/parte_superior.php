<?php
session_start();

if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}

$nombreUsuario = htmlspecialchars($_SESSION['nombre_usuario']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard-Estilo Isa Boutique Moda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .sidebar-brand {
            text-align: center;
        }

        .sidebar-brand-icon img {
            width: 50px;
            height: 50px;
            transform: rotate(15deg);
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(to right, #28a745, #218838);">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="/PlantillasProyecto/Dashboard/img/imagendashboard.png" alt="Logo" style="width: 50px; height: 50px; transform: rotate(15deg);">
                </div>
                <div class="sidebar-brand-text mx-3" style="text-align: center; ">Estilo Isa Boutique Moda</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                CRUDS
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>CRUDS</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="productos.php"><i class="bi bi-backpack3-fill">Productos</i></a>
                        <a class="collapse-item" href="administradores.php"><i class="bi bi-person-fill-gear">Administradores</i></a>
                        <a class="collapse-item" href="proveedores.php"><i class="bi bi-person-fill-exclamation">Proveedores</i></a>
                    </div>
                </div>
            </li>
            <div class="sidebar-heading">
                MANUALES
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseManuales" aria-expanded="true" aria-controls="collapseManuales">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>QR MANUALES</span>
                </a>
                <div id="collapseManuales" class="collapse" aria-labelledby="headingManuales" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/PlantillasProyecto/Dashboard/manuales/ManualUsuario.pdf"><i class="bi bi-file-pdf"></i>Manual Usuario</a>
                        <a class="collapse-item" href="/PlantillasProyecto/Dashboard/manuales/ManuaInstalacion.pdf"><i class="bi bi-file-pdf"></i>Manual Instalacion</a>
                        <a class="collapse-item" href="/PlantillasProyecto/Dashboard/manuales/ManualTecnico.pdf"><i class="bi bi-file-pdf"></i>Manual Tecnico</a>
                    </div>
                </div>
                <hr class="sidebar-divider d-none d-md-block">

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">

                    </form>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nombreUsuario; ?></span>
                                <img class="img-profile rounded-circle" src="/PlantillasProyecto/Dashboard/img/imagenAdministrador.png">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
