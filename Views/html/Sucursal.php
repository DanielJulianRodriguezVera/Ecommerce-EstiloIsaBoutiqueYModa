<?php
session_start();

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

<div class="sucursal">
    <h3>Direccion | Parque Arkaparaiso Calle 80 Bis, Ibagué, Tolima</h3>
    <div class="box">
        <div class="content-box">
            <div class="ubi">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3977.8590772205634!2d-75.19003342596388!3d4.437327243886441!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e38c510c35fdbb7%3A0x95cc97e6e79a804a!2sParque%20Arkaparaiso!5e0!3m2!1ses-419!2sco!4v1713569269664!5m2!1ses-419!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>

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
