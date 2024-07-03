<?php
if (!empty($_POST["btnCrearProducto"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"]) && !empty($_POST["id_proveedor"]) && !empty($_POST["categoria"]) && !empty($_POST["tipo_prenda"]) && !empty($_POST["estado"]) && !empty($_POST["imagen"])) {

        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $id_proveedor = $_POST["id_proveedor"];
        $categoria = $_POST["categoria"];
        $tipo_prenda = $_POST["tipo_prenda"];
        $estado = $_POST["estado"];
        $imagen = $_POST["imagen"];

        $sql = $conexion->query("INSERT INTO productos (nombre_producto, descripcion, precio, id_proveedor, categoria, tipo_prenda, estado, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$id_proveedor', '$categoria', '$tipo_prenda', '$estado', '$imagen')");

        if ($sql == 1) {
            echo '<div class="alert alert-success">Producto Creado Correctamente</div>';
        } else {
            echo '<div class="alert alert-danger">Error al Crear Producto</div>';
        }

    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío</div>';
    }
}
?>
