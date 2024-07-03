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

    <section class="contact" id="contact">
    <h1 class="heading"> <span>contact</span> us </h1>
    <div class="row">
        <form action="#" method="post">
            <h3>Contáctanos</h3>
            <div class="inputBox">
                <span class="fas fa-user"></span>
                <input type="text" name="nombre" placeholder="Nombre Completo" required>
            </div>
            <div class="inputBox">
                <span class="fas fa-envelope"></span>
                <input type="email" name="correo" placeholder="Correo" required>
            </div>
            <div class="inputBox">
                <span class="fas fa-phone"></span>
                <input type="tel" name="telefono" placeholder="Número de Teléfono" required>
            </div>
            <div class="inputBox">
                <span class="fas fa-map-marker"></span>
                <input type="text" name="direccion" placeholder="Dirección">
            </div>
            <div class="inputBox">
                <span class="fas fa-comment"></span>
                <textarea name="comentario" placeholder="Comentario"></textarea>
            </div>
            <input type="submit" value="Contactar ahora" class="btn">
        </form>
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
