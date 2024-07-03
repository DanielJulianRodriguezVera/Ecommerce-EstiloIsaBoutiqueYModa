<?php
session_start();
require_once __DIR__ . "/../../../Models/Conexion.php";

if (isset($_SESSION['nombre_usuario'])) {
    echo "Sesión " . $_SESSION['nombre_usuario'];
} else {
    echo "La sesión no está abierta";
}

if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];

    global $conn;

    $sql = "SELECT id_producto, nombre_producto, descripcion, precio, categoria, tipo_prenda, imagen FROM productos WHERE id_producto = ? AND estado = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ruta_imagen = $row["imagen"];
        $ruta_imagen = str_replace('\\', '/', $ruta_imagen);
    } else {
        echo "Producto no encontrado.";
        exit;
    }

    $stmt->close();
} else {
    echo "ID del producto no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto-Estilo Isa y Boutique</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/path_to_your_css_file.css"> <!-- Asegúrate de enlazar tu archivo CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../Css/style.css">
    <style>
        .product-container {
            position: relative;
        }

        .product-container h1 {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
            margin-top: 0px;
            font-size: 2em;
            color: #343a40;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: center;
            width: 100%;
        }

        .product-container {
            margin-left: 200px;
            margin-top: 150px;
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .product-container:hover {
            transform: scale(1.02);
        }

        .product-image {
            margin-top: 20px;
            width: 50%;
            height: auto;
            border-radius: 15px;
            object-fit: cover;
        }

        .product-info-container {
            width: 50%;
            padding-left: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-left: 2px solid #e9ecef;

            padding-left: 20px;

        }

        .product-details {
            text-align: left;
            margin-top: 20px;
        }

        .product-details h2 {
            margin: 0 0 15px 0;
            font-size: 2.5em;
            color: #343a40;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: center;
        }

        .product-details .price {
            font-size: 2.2em;
            color: #dc3545;
            font-weight: bold;
            margin: 10px 0 20px 0;
            display: inline-block;
            background: #f8f9fa;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-details p {
            margin: 10px 0;
            font-size: 1.1em;
            color: #6c757d;
        }

        .product-details .description {
            font-size: 1.2em;
            font-weight: bold;

            margin-top: 20px;
            display: flex;
            align-items: center;
        }

        .product-details .description i {
            margin-right: 10px;
            color: #007bff;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            align-self: flex-start;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .product-attributes {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .product-attributes p {
            display: flex;
            align-items: center;
            font-size: 1.1em;
        }

        .product-attributes p i {
            margin-right: 10px;
            color: #007bff;
        }

        .card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
    </style>
</head>
</head>

<body>
    <header class="header">
        <a href="/PlantillasProyecto/Views/html/Home.php" class="logo">
            <img src="/PlantillasProyecto/Views/img/isabelogo.jpeg" alt="">
        </a>

        <nav class="navbar">
            <a href="/PlantillasProyecto/Views/html/Home.php">INICIO</a>

            <div class="dropdown">
                <a href="#" class="dropbtn">CATALOGO</a>
                <div class="dropdown-content">
                    <a href="/PlantillasProyecto/Views/html/Hombres.php">HOMBRES</a>
                    <a href="/PlantillasProyecto/Views/html/Mujeres.php">MUJERES</a>
                    <a href="/PlantillasProyecto/Views/html/Niños.php">NIÑOS</a>
                </div>
            </div>
            <a href="/PlantillasProyecto/Views/html/Sucursal.php">SUCURSALES</a>
            <a href="/PlantillasProyecto/Views/html/contacto.php">CONTACTO</a>
            <a href="/PlantillasProyecto/Views/html/about.php">ACERCA DE</a>

        </nav>


        <div class="icons">
            <div class="fas fa-search" id="search-btn"></div>
            <div class="fas fa-shopping-cart" id="cart-btn"></div>


        </div>

        <div class="search-form">
            <input type="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </div>

        <div class="profile-icon">
            <i class="bi bi-person-circle" style="color: #fff;"></i>
            <div class="profile-dropdown">
                <?php if (isset($_SESSION['nombre_usuario'])) : ?>
                    <div class="icono2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                        </svg>
                    </div>

                    <p><?php echo $_SESSION['nombre_usuario']; ?></p>
                    <a href="/PlantillasProyecto/Dashboard/funciones_login/cerrar_sesion.php">Cerrar Sesión</a>
                <?php else : ?>
                    <a href="/PlantillasProyecto/Dashboard/login.php">Iniciar Sesión</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <div class="product-container">
        <h1>Detalle Producto</h1>
        <img src="<?php echo $ruta_imagen; ?>" alt="<?php echo htmlspecialchars($row["nombre_producto"], ENT_QUOTES, 'UTF-8'); ?>" class="product-image">
        <div class="product-info-container">
            <div class="product-details">
                <h2><?php echo htmlspecialchars($row["nombre_producto"], ENT_QUOTES, 'UTF-8'); ?></h2>

                <div class="card">
                    <div class="product-attributes">
                        <p><i class="fas fa-tags"></i><strong>Categoría:</strong> <?php echo htmlspecialchars($row["categoria"], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p><i class="fas fa-tshirt"></i><strong>Tipo de prenda:</strong> <?php echo htmlspecialchars($row["tipo_prenda"], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                    <p class="description"><i class="fas fa-file-alt"></i>Descripción:</p>
                    <p><?php echo htmlspecialchars($row["descripcion"], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <p class="price" style="text-align: center;">$<?php echo htmlspecialchars($row["precio"], ENT_QUOTES, 'UTF-8'); ?></p>

                <br>
                <a href="/PlantillasProyecto/Views/html/Home.php" class="btn btn-warning"><i class="bi bi-house">Volver al Inicio</i></a>

                <a href="/PlantillasProyecto/Views/html/Header/carritoCompras.php?nombre_producto=<?php echo urlencode($row['nombre_producto']); ?>&precio=<?php echo $row['precio']; ?>" class="btn"><i class="bi bi-basket">Agregar al carrito</i></a>
            </div>
        </div>
    </div>

    <section class="footer" style="margin-top: 60px;">

        <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
        </div>

        <div class="credit">© 2024 isa boutique and fashion style | Todos los derechos reservados</div>

    </section>

</body>

</html>