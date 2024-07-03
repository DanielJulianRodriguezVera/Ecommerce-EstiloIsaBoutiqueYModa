<?php
session_start();
include_once "../../../Models/Conexion.php";

if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: /PlantillasProyecto/Dashboard/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $nombre_producto = $_POST['nombre_producto'];

    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as &$producto) {
            if ($producto['nombre_producto'] === $nombre_producto) {
                if ($action == 'sumar') {
                    $producto['cantidad']++;
                } elseif ($action == 'restar') {
                    if ($producto['cantidad'] > 1) {
                        $producto['cantidad']--;
                    } else {
                        echo "¡Hey! No puedes restar más, ¡ese producto ya casi desaparece!";
                    }
                } elseif ($action == 'eliminar') {
                    $index = array_search($producto, $_SESSION['carrito']);
                    unset($_SESSION['carrito'][$index]);
                    echo "¡Oh no! $nombre_producto se escapó del carrito. ¡Fue una aventura emocionante!";
                } elseif ($action == 'actualizar') {
                    $cantidad = $_POST['cantidad'];
                    if (is_numeric($cantidad) && $cantidad > 0) {
                        $producto['cantidad'] = $cantidad;
                        echo "Cantidad actualizada correctamente. ¡Qué precisión!";
                    } else {
                        echo "Error: La cantidad debe ser un número positivo.";
                    }
                }
                break;
            }
        }
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }

    header("Location: carritoCompras.php");
    exit();
}

if (isset($_GET['nombre_producto']) && isset($_GET['precio'])) {
    $nombre_producto = $_GET['nombre_producto'];
    $precio = $_GET['precio'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    $producto_encontrado = false;
    foreach ($_SESSION['carrito'] as &$producto) {
        if ($producto['nombre_producto'] === $nombre_producto) {
            $producto['cantidad']++;
            $producto_encontrado = true;
            break;
        }
    }

    if (!$producto_encontrado) {
        $producto = array(
            'nombre_producto' => $nombre_producto,
            'precio' => $precio,
            'cantidad' => 1
        );
        array_push($_SESSION['carrito'], $producto);
        echo "¡$nombre_producto ha sido añadido al carrito! Esperemos que se lleve bien con los demás productos.";
    }

    header("Location: carritoCompras.php");
    exit();
} else {
    echo "Error: Datos del producto no proporcionados.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de compras-Estilo Isa y Boutique</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../../Css/style.css">
    <style>
        .Carrito {
            margin-top: 120px;
            margin-left: 300px;
            padding: 20px;
            border-radius: 10px;
            overflow: hidden;
            max-width: 700px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .Carrito .header-carrito {
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            font-size: 24px;
            font-weight: bold;
        }

        .Carrito .carrito-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eaeaea;
            padding: 20px;
        }

        .Carrito .carrito-item img {
            width: 80px;
            margin-right: 20px;
            border-radius: 5px;
        }

        .Carrito .carrito-item .carrito-item-detalles {
            flex-grow: 1;
        }

        .Carrito .carrito-item .carrito-item-titulo {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #cfaa75;
        }

        .Carrito .carrito-item .carrito-item-cantidad {
            display: inline-block;
            margin-right: 25px;
        }

        .Carrito .carrito-item .carrito-item-cantidad input {
            border: 1px solid #eaeaea;
            font-size: 16px;
            background: #f9f9f9;
            display: inline-block;
            width: 40px;
            padding: 5px;
            text-align: center;
            border-radius: 5px;
        }

        .Carrito .carrito-item .selector-cantidad i {
            font-size: 18px;
            width: 32px;
            height: 32px;
            line-height: 32px;
            text-align: center;
            border-radius: 50%;
            border: 1px solid #007bff;
            color: #007bff;
            cursor: pointer;
            transition: 0.3s;
        }

        .Carrito .carrito-item .selector-cantidad i:hover {
            background-color: #007bff;
            color: #fff;
        }

        .Carrito .carrito-item .carrito-item-precio {
            font-weight: bold;
            display: inline-block;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .Carrito .carrito-item .btn-eliminar {
            color: #007bff;
            cursor: pointer;
            display: block;
            transition: 0.3s;
        }

        .Carrito .carrito-item .btn-eliminar:hover {
            color: #ff0000;
        }

        .carrito-total {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 10px 10px;
            text-align: center;
        }

        .carrito-total .fila {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .carrito-total .btn-pagar {
            display: inline-block;
            width: auto;
            border: none;
            background: black;
            color: #fff;
            border-radius: 5px;
            font-size: 18px;
            padding: 15px 30px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }

        .carrito-total .btn-pagar:hover {
            background: #0056b3;
        }
    </style>
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

    </header>
    <section class="Carrito">
        <div class="header-carrito">
            <h2>Tu Carrito</h2>
        </div>

        <?php
        $total = 0;
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $producto) {
                if (!isset($producto['cantidad'])) {
                    $producto['cantidad'] = 1;
                }
                $total += $producto['precio'] * $producto['cantidad'];
                echo '<div class="carrito-item">';
                echo '<img src="/PlantillasProyecto/Views/img/hombres/busos/Buso2.jpg" width="80px">';
                echo '<div class="carrito-item-detalles">';
                echo '<span class="carrito-item-titulo">' . htmlspecialchars($producto['nombre_producto']) . '</span>';
                echo '<div class="selector-cantidad">';
                echo '<form method="POST" action="carritoCompras.php" style="display:inline-block;">';
                echo '<input type="hidden" name="action" value="restar">';
                echo '<input type="hidden" name="nombre_producto" value="' . htmlspecialchars($producto['nombre_producto']) . '">';
                echo '<button type="submit" style="background:none; border:none; padding:0;"><i class="fa-solid fa-minus" style="color: black;"></i></button>';
                echo '</form>';
                echo '<form method="POST" action="carritoCompras.php" style="display:inline-block;">';
                echo '<input type="hidden" name="action" value="actualizar">';
                echo '<input type="hidden" name="nombre_producto" value="' . htmlspecialchars($producto['nombre_producto']) . '">';
                echo '<input type="number" name="cantidad" value="' . htmlspecialchars($producto['cantidad']) . '" min="1" style="width: 80px; text-align: center;">';
                echo '<button type="submit" style="background:none; border:none; padding:0;"><i class="fa-solid fa-check" style="color: black;"></i></button>';
                echo '</form>';
                echo '<form method="POST" action="carritoCompras.php" style="display:inline-block;">';
                echo '<input type="hidden" name="action" value="sumar">';
                echo '<input type="hidden" name="nombre_producto" value="' . htmlspecialchars($producto['nombre_producto']) . '">';
                echo '<button type="submit" style="background:none; border:none; padding:0;"><i class="fa-solid fa-plus" style="color: black;"></i></button>';
                echo '</form>';
                echo '</div>';
                echo '<span class="carrito-item-precio" style="color: #333;">$' . htmlspecialchars($producto['precio']) . '</span>';
                echo '</div>';
                echo '<form method="POST" action="carritoCompras.php" style="display:inline-block;">';
                echo '<input type="hidden" name="action" value="eliminar">';
                echo '<input type="hidden" name="nombre_producto" value="' . htmlspecialchars($producto['nombre_producto']) . '">';
                echo '<button type="submit" style="background:none; border:none; padding:0;"><span class="btn-eliminar"><i class="bi bi-trash3" style="color: #cfaa75;"></i></span></button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo '<p style="font: 2em sans-serif; text-align: center; padding: 20px;"><i class="bi bi-duffle-fill"></i> Agrega Productos al carrito.</p>';
        }
        ?>
        <div class="carrito-total">
            <div class="fila">
                <strong>Tu Total</strong>
                <span class="carrito-precio-total">
                    <?php echo "$" . htmlspecialchars($total); ?>
                </span>
            </div>
            <a href="/PlantillasProyecto/Views/html/Header/PasarelasdePago/Pasarelas.php" class="btn-pagar">Pagar <i class="fa-solid fa-bag-shopping"></i></a>
        </div>
    </section>

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