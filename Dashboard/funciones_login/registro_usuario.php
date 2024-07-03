<?php
include '../../Models/Conexion.php';

$nombre_usuario = $_POST['nombre_usuario'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo_usuario'];
$contraseña = $_POST['contrasena_usuario'];
$genero = $_POST['genero'];

$query = "INSERT INTO usuarios(nombre_usuario, telefono, direccion, correo_usuario, contrasena_usuario, genero)
VALUES ('$nombre_usuario', '$telefono', '$direccion', '$correo', '$contraseña', '$genero')";

// Verificar si el correo ya está registrado
$verificar_correo = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo_usuario='$correo'");
if (mysqli_num_rows($verificar_correo) > 0) {
    echo '
    <script>
    alert("Este correo ya está registrado, intenta con otro diferente");
    window.location="../login.php";
    </script>
    ';
    exit();
}

// Verificar si el usuario ya está registrado
$verificar_usuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE nombre_usuario='$nombre_usuario'");
if (mysqli_num_rows($verificar_usuario) > 0) {
    echo  '
    <script>
    alert("Este usuario ya está registrado, intenta con otro diferente");
    window.location="../login.php";
    </script>
    ';
    exit();
}

$ejecutar = mysqli_query($conn, $query);

if ($ejecutar) {
    header('Location: ../login.php');
    exit;
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conexion);
}
?>
