<?php
if(!empty($_POST["btnregistrar"])){
    if (!empty($_POST["telefono_proveedor"]) and !empty($_POST["direccion"])){
        $id=$_POST["id"];
        $telefono=$_POST["telefono_proveedor"];
        $direccion=$_POST["direccion"];

        $sql=$conexion->query("UPDATE productos SET  telefono_proveedor='$telefono', direccion='$direccion' WHERE id_proveedor=$id");

        if ($sql==1) {
            header("location: ../proveedores.php");
            exit();
            
        } else {
            echo "<div class='alert alert-danger'>Error al modificar proveedor</div>";
        }
            

    }else{
        echo "<div class='alert alert-warning'>Todos los campos son obligatorios</div>";
    }

}


