<?php
session_start();

if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: /PlantillasProyecto/Dashboard/login.php");
    exit();
}

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "El carrito está vacío. ";
    echo "<script>setTimeout(function() { window.location.href = '/PlantillasProyecto/Views/html/Header/carritoCompras.php'; }, 2000);</script>";
    exit();
}

// Obtener la tasa de cambio actual (ejemplo: 1 dólar = 4000 pesos colombianos)
$tasa_de_cambio = 4000; // Esta debería ser la tasa de cambio actualizada

// Calcular el total del carrito en dólares
$total_usd = 0;
foreach ($_SESSION['carrito'] as $producto) {
    // Convertir el precio del producto de COP a USD
    $precio_cop = $producto['precio'];
    $precio_usd = $precio_cop / $tasa_de_cambio;
    $total_usd += $precio_usd * $producto['cantidad'];
}

// Datos de configuración de PayPal (modo sandbox)
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
$paypal_id = 'sb-n4wug31168594@business.example.com'; // Tu correo electrónico de PayPal en sandbox
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar con PayPal</title>
</head>

<body>
    <h2>Redirigiendo a PayPal...</h2>
    <form action="<?php echo htmlspecialchars($paypal_url); ?>" method="post" id="paypal_form">
        <input type="hidden" name="business" value="<?php echo htmlspecialchars($paypal_id); ?>">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="item_name" value="Carrito de compras">
        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($total_usd); ?>">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="return" value="http://tusitio.com/PlantillasProyecto/Views/html/Header/PasarelasdePago/success.php">
        <input type="hidden" name="cancel_return" value="http://tusitio.com/PlantillasProyecto/Views/html/Header/PasarelasdePago/cancel.php">
    </form>

    <script>
        document.getElementById('paypal_form').submit();    
    </script>
</body>

</html>
