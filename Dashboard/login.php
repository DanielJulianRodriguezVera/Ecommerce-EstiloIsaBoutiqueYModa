<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Registrar</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style_login.css">
</head>

<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Regístrarse</button>
                </div>
            </div>

            <div class="contenedor__login-register">
                <form action="funciones_login/login_usuario.php" method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" placeholder="Correo Electronico" name="correo_usuario">
                    <input type="password" placeholder="Contraseña" name="contrasena_usuario">
                    <button>Entrar</button>            
                </form>

                <form action="funciones_login/registro_usuario.php" method="POST" class="formulario__register">
                    <h2>Regístrarse</h2>
                    <input type="text" placeholder="Nombre Usuario" name="nombre_usuario">
                    <input type="text" placeholder="Telefono" name="telefono">
                    <input type="text" placeholder="Direccion" name="direccion">
                    <select name="genero">
                        <option value="">Seleccione Género</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>


                    <input type="text" placeholder="Correo Electronico" name="correo_usuario">
                    <input type="password" placeholder="Contraseña" name="contrasena_usuario">
                    <button>Regístrarse</button>
                </form>
            </div>

        </div>

    </main>

    <script src="js/script.js"></script>
</body>

</html>