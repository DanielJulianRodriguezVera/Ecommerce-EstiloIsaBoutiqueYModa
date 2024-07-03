<?php
if (!empty($_POST["btncrearprov"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["telefono"]) && !empty($_POST["direccion"])) {
        
        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $direccion = $_POST["direccion"];

        $sql = $conexion->query("INSERT INTO proveedores (nombre_proveedor, telefono_proveedor, direccion) VALUES ('$nombre', '$telefono', '$direccion')");

        if ($sql == 1) {
            echo '<div class="alert alert-success">Proveedor Creado Correctamente</div>';
        } else {
            echo '<div class="alert alert-danger">Error al Crear Proveedor</div>';
        }

    }else{
        echo '<div class="alert alert-warning">Alguno de los campos esta vacio</div>';
    }
}


?>