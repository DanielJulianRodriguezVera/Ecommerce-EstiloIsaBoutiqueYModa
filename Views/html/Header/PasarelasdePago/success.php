<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: /PlantillasProyecto/Dashboard/login.php");
    exit();
}

// Limpiar el carrito después de un pago exitoso
unset($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago exitoso</title>
</head>

<body>
    <h2>¡Gracias por tu compra!</h2>
    <p>Tu pago se ha realizado con éxito. Te hemos enviado un correo con los detalles de tu pedido.</p>
    <a href="/PlantillasProyecto/Views/html/Home.php">Volver al inicio</a>
</body>

</html>
