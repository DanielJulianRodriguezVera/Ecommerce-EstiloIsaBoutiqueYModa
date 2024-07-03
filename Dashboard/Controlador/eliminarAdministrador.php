<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql=$conexion->query("DELETE FROM administradores WHERE id_administrador=$id");
    if ($sql==1) {
       echo '<div class="alert alert-success">Administrador Eliminado</div>';
    } else {
        echo '<div class="alert alert-danger">Error al eliminar Administrador</div>';
    }
}
?>