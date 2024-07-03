<?php
session_start();
require_once "../../Controllers/CatalogoController.php";
$catalogoController = new CatalogoController();

if (isset($_SESSION['nombre_usuario'])) {
    echo "Sesión " . $_SESSION['nombre_usuario'];
} else {
    echo "La sesión no está abierta";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Isa Boutique and Fashion Style</title>
    <link rel="icon" href="/Views/img/favicons/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/PlantillasProyecto/Views/Css/style.css">
    <script src="/PlantillasProyecto/Views/js/perfil.js"></script>
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
                <a href="Hombres.php">HOMBRES</a>
                <a href="Mujeres.php">MUJERES</a>
                <a href="Niños.php">NIÑOS</a>
            </div>
        </div>
        <a href="Sucursal.php">SUCURSALES</a>
        <a href="contacto.php">CONTACTO</a>
        <a href="about.php">ACERCA DE</a>
    </nav>
    <div class="icons">
        <div class="fas fa-search" id="search-btn"></div>
    </div>
    <div class="search-form">
        <input type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search"></label>
    </div>
</header>

    <section class="busosMujeres" id="busosMujeres">
        <h1 class="heading"> Busos - <span>Camisetas</span> </h1>
        <div class="box-container">
            <?php
            $catalogoController->mostrarProductos("mujeres", "busos");
            ?>
        </div>
    </section>


    <section class="pantalonesMujeres" id="pantalonesMujeres">
        <h1 class="heading"><span>Pantalones</span> </h1>
        <div class="box-container">
            <?php
            $catalogoController->mostrarProductos("mujeres", "pantalones");
            ?>
        </div>
    </section>

    <section class="zapatosMujeres" id="zapatosMujeres">
        <h1 class="heading"> Zapatos <span>deportivos</span> </h1>
        <div class="box-container">
            <?php
            $catalogoController->mostrarProductos("mujeres", "zapatos");
            ?>
        </div>
    </section>

    <section class="footer">
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