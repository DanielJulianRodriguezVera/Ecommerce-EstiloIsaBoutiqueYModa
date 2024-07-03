<?php
session_start();

include '../../Models/Conexion.php';

$correo = $_POST['correo_usuario'];
$contraseña = $_POST['contrasena_usuario'];

$consulta_admin = mysqli_query($conn, "SELECT * FROM administradores WHERE correo_electronico='$correo' AND contraseña='$contraseña'");

if (mysqli_num_rows($consulta_admin) > 0) {
    $_SESSION['nombre_usuario'] = 'Administrador';
    header("Location: ../index.php");
    exit;
}

$validar_login = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo_usuario='$correo' AND contrasena_usuario='$contraseña'");

if (mysqli_num_rows($validar_login) > 0) {
    $usuario = mysqli_fetch_assoc($validar_login);
    $nombre_usuario = $usuario['nombre_usuario'];
    $_SESSION['nombre_usuario'] = $nombre_usuario;
    header("Location: ../../Views/html/Home.php");
    exit;
} else {
    echo '<script>alert("Usuario no existe o credenciales incorrectas. Por favor, verifique sus datos ingresados.");
     window.location="../login.php";
     </script>';
    exit;
}
?>