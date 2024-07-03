<?php
if (!empty($_POST["btncrearprov"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["correo_electronico"]) && !empty($_POST["contraseña"])) {
        
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo_electronico = $_POST["correo_electronico"];
        $contraseña = $_POST["contraseña"];

        $check_query = "SELECT correo_electronico FROM administradores WHERE correo_electronico = '$correo_electronico'";
        $result = $conexion->query($check_query);

        if ($result->num_rows > 0) {
            echo '<div class="alert alert-danger">El correo electrónico ya está registrado.</div>';
        } else {
            $insert_query = "INSERT INTO administradores (nombre, apellido, correo_electronico, contraseña) VALUES ('$nombre', '$apellido', '$correo_electronico', '$contraseña')";
            $sql = $conexion->query($insert_query);

            if ($sql === TRUE) {
                echo '<div class="alert alert-success">Administrador creado correctamente.</div>';
            } else {
                echo '<div class="alert alert-danger">Error al crear administrador.</div>';
            }
        }

    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío.</div>';
    }
}
?>
