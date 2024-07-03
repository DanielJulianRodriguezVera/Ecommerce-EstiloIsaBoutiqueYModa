<?php
session_start();
require_once __DIR__ . '/../../Models/conexion.php';

if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: /PlantillasProyecto/Dashboard/login.php");
    exit(); 
}

function obtenerDatosUsuario() {
    global $conn; 

    $query = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }

    $stmt->bind_param("s", $_SESSION['nombre_usuario']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $datosUsuario = $result->fetch_assoc();
        return $datosUsuario; 
    } else {
        die('No se encontró ningún usuario con nombre de usuario: ' . $_SESSION['nombre_usuario']);
    }

    $stmt->close();
}

$datosUsuario = obtenerDatosUsuario();
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
    <style>
        .chat-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .chat-toggle {
            background-color: black;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }

        .chat-box {
            display: none;
            width: 400px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            font-family: Arial, sans-serif;
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
            transform: scale(0.95);
            opacity: 0;
        }

        .chat-box.open {
            display: block;
            transform: scale(1);
            opacity: 1;
        }

        .chat-header {
            background-color: black;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }

        .chat-body {
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
        }

        .chat-footer {
            display: flex;
            border-top: 1px solid #ddd;
            padding: 10px;
        }

        .chat-footer input {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-right: 10px;
        }

        .chat-footer button {
            padding: 10px;
            background-color: black;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .chat-message {
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .chat-message.admin {
            text-align: left;
            color: #333;
        }

        .chat-message.user {
            text-align: right;
            color: #007bff;
        }

        .message-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="intro">
        <img src="/PlantillasProyecto/Views/img/rayo1.png" alt="Rayo">
        <h1 class="logo">
            <span class="logo-parts">E</span>
            <span class="logo-parts">S</span>
            <span class="logo-parts">T</span>
            <span class="logo-parts">I</span>
            <span class="logo-parts">L</span>
            <span class="logo-parts">O</span>
            <span class="logo-parts">-</span>
            <span class="logo-parts">I</span>
            <span class="logo-parts">S</span>
            <span class="logo-parts">A</span>
            <span class="logo-parts">-</span>
            <span class="logo-parts">Y</span>
            <span class="logo-parts">-</span>
            <span class="logo-parts">B</span>
            <span class="logo-parts">O</span>
            <span class="logo-parts">U</span>
            <span class="logo-parts">T</span>
            <span class="logo-parts">I</span>
            <span class="logo-parts">Q</span>
            <span class="logo-parts">U</span>
            <span class="logo-parts">E</span>
        </h1>
        <p>"Renueva tu armario"</p>
    </div>

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
    <section class="home" id="home">
        <div class="content">
            <h3>Descubre tu estilo único en nuestra tienda de moda</h3>
            <p>Encuentra las últimas tendencias y piezas que hablan de tu personalidad.¡Renueva tu armario y haz una declaración de moda con nosotros hoy mismo!"</p>
            <a href="#" class="btn">Order now</a>

            <div class="chat-container">
                <button class="chat-toggle" id="chat-toggle"><i class="bi bi-chat-dots"></i></button>
                <div class="chat-box" id="chat-box">
                    <div class="chat-header">
                        Hola soy el administrador, ¿en qué te puedo ayudar?
                    </div>
                    <div class="chat-body" id="chat-body">
                    </div>
                    <div class="chat-footer">
                        <input type="text" id="chat-input" placeholder="Escribe un mensaje...">
                        <button id="send-btn">Enviar</button>
                        <button id="reset-btn" style="margin-left: 5px;">Reiniciar Chat</button>
                    </div>
                </div>
            </div>
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

    <script>
        document.getElementById('cart-btn').addEventListener('click', function() {
            window.location.href = '/PlantillasProyecto/Views/html/Header/carritoCompras.php';
        });

        document.getElementById('reset-btn').addEventListener('click', function() {
            document.getElementById('chat-body').innerHTML = '';

            showInitialMessage();
        });

        document.getElementById('chat-toggle').addEventListener('click', function() {
            var chatBox = document.getElementById('chat-box');
            if (chatBox.classList.contains('open')) {
                chatBox.classList.remove('open');
                setTimeout(function() {
                    chatBox.style.display = 'none';
                }, 300);
            } else {
                chatBox.style.display = 'block';
                setTimeout(function() {
                    chatBox.classList.add('open');
                    showInitialMessage();
                }, 10);
            }
        });

        document.getElementById('send-btn').addEventListener('click', function() {
            var input = document.getElementById('chat-input');
            var message = input.value;

            if (message.trim() !== '') {
                var userMessage = document.createElement('div');
                userMessage.classList.add('chat-message', 'user');
                userMessage.textContent = message;
                document.getElementById('chat-body').appendChild(userMessage);

                input.value = '';

                handleUserMessage(message);
            }
        });

        document.getElementById('chat-input').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                document.getElementById('send-btn').click();
            }
        });

        function showInitialMessage() {
            var initialMessage = document.createElement('div');
            initialMessage.classList.add('chat-message', 'admin');
            initialMessage.innerHTML = `
        <div class="message-title">¡Hola! ¿En qué puedo ayudarte?</div>
        <div>1. Información personal</div>
        <div>2. Comunicarse con un asesor</div>
    `;
            document.getElementById('chat-body').appendChild(initialMessage);
            document.getElementById('chat-body').scrollTop = document.getElementById('chat-body').scrollHeight;
        }

        var waitingForReference = false;
        var currentAction = '';

        function handleUserMessage(message) {
            var adminMessage = document.createElement('div');
            adminMessage.classList.add('chat-message', 'admin');

            switch (message) {
                case '1':
                    showUserInfo();
                    break;
                case '2':
                    openWhatsApp();
                    break;
                default:
                    adminMessage.textContent = 'Por favor, selecciona una opción válida.';
                    break;
            }

            if (adminMessage.innerHTML !== '') {
                document.getElementById('chat-body').appendChild(adminMessage);
                document.getElementById('chat-body').scrollTop = document.getElementById('chat-body').scrollHeight;
            }
        }

        function showUserInfo() {
            var userInfoMessage = document.createElement('div');
            userInfoMessage.classList.add('chat-message', 'admin');
            userInfoMessage.innerHTML = `
        <div class="message-title">Información personal</div>
        <div>Nombre de Usuario: <?php echo $datosUsuario['nombre_usuario']; ?></div>
        <div>Correo Electrónico: <?php echo $datosUsuario['correo_usuario']; ?></div>
        <div>Teléfono: <?php echo $datosUsuario['telefono']; ?></div>
        <div>Dirección: <?php echo $datosUsuario['direccion']; ?></div>
        <div>Género: <?php echo $datosUsuario['genero']; ?></div>
    `;

            document.getElementById('chat-body').appendChild(userInfoMessage);
            document.getElementById('chat-body').scrollTop = document.getElementById('chat-body').scrollHeight;
        }

        function openWhatsApp() {
            var chatBody = document.getElementById('chat-body');
            var communicatingMessage = document.createElement('div');
            communicatingMessage.classList.add('chat-message', 'admin');
            communicatingMessage.textContent = 'Comunicándose con el asesor...';
            chatBody.appendChild(communicatingMessage);
            chatBody.scrollTop = chatBody.scrollHeight;

            var whatsappNumber = '+573243622577'; 
            var message = encodeURIComponent('😊 Necesito ayuda, soy cliente de Estilo Isa Boutique y Moda 🆘');
            window.open('https://api.whatsapp.com/send?phone=' + whatsappNumber + '&text=' + message, '_blank');
            setTimeout(function() {
                chatBody.removeChild(communicatingMessage);
            }, 36000000); 
        }
    </script>
</body>
</html>