<?php
if (!empty($_POST["btnregistrar"])) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $id_proveedor = $_POST["id_proveedor"];
    $categoria = $_POST["categoria"];
    $tipo_prenda = $_POST["tipo_prenda"];
    $estado = $_POST["estado"];
    $imagen = $_POST["imagen"];

    if (!empty($nombre) && !empty($descripcion) && !empty($precio) && !empty($id_proveedor) && !empty($categoria) && !empty($tipo_prenda) && !empty($estado) && !empty($imagen)) {
        $sql = "UPDATE productos SET nombre_producto=?, descripcion=?, precio=?, id_proveedor=?, categoria=?, tipo_prenda=?, estado=?, imagen=? WHERE id_producto=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssdissssi", $nombre, $descripcion, $precio, $id_proveedor, $categoria, $tipo_prenda, $estado, $imagen, $id);

        if ($stmt->execute()) {
            $stmt->close();
            header("location: ../productos.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error al modificar producto</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Todos los campos son obligatorios</div>";
    }
}
?>
