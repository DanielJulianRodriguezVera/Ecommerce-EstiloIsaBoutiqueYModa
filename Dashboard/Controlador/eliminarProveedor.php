<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql=$conexion->query("DELETE FROM proveedores WHERE id_proveedor=$id");
    if ($sql==1) {
       echo '<div class="alert alert-success">Proveedor Eliminado</div>';
    } else {
        echo '<div class="alert alert-danger">Error al eliminar Proveedor/div>';
    }
}
?>