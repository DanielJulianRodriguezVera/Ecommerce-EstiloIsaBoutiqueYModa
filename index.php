<?php
require_once 'Models/Conexion.php'; 

require_once 'Controllers/Controlador.php';

$controlador = new Controlador();

if (isset($_GET["accion"])) {
    if ($_GET["accion"] == "about") {
        $controlador->verPagina('Views/html/About.php');
    } elseif ($_GET["accion"] == "contacto") {
        $controlador->verPagina('Views/html/Contacto.php');
    } elseif ($_GET["accion"] == "hombres") {
        $controlador->verPagina('Views/html/Hombres.php');
    } elseif ($_GET["accion"] == "mujeres") {
        $controlador->verPagina('Views/html/Mujeres.php');
    } elseif ($_GET["accion"] == "niños") {
        $controlador->verPagina('Views/html/Niños.php');
    } elseif ($_GET["accion"] == "sucursal") {
        $controlador->verPagina('Views/html/Sucursal.php');
    } else {
        $controlador->verPagina('Views/html/Home.php');
    }
} else {
    $controlador->verPagina('Views/html/Home.php', true);
}
?>
