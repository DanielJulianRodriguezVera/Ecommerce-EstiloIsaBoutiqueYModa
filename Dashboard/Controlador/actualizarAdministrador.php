<?php
if(!empty($_POST["btnregistrar"])){
    if (!empty($_POST["correo_electronico"]) and !empty($_POST["contraseña"])){
        $id=$_POST["id"];
        $correo_electronico = $_POST["correo_electronico"];
        $contraseña = $_POST["contraseña"];

        $sql=$conexion->query("UPDATE administradores SET correo_electronico='$correo_electronico', contraseña='$contraseña' WHERE id_administrador=$id");

        if ($sql==1) {
            header("location: ../administradores.php");
            exit();
            
        } else {
            echo "<div class='alert alert-danger'>Error al modificar administrador</div>";
        }
        

    }else{
        echo "<div class='alert alert-warning'>Todos los campos son obligatorios</div>";
    }

}


