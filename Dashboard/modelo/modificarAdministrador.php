<?php

include 'conexion.php';

$id = $_GET["id"];

$sql = $conexion->query("SELECT * FROM administradores WHERE id_administrador=$id ");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .boton {
            margin-top: 5px;
            height: 38px;
            display: inline-block;
            padding: 6px 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 15px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .boton:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <form class="col-4 p-3 m-auto" method="POST">
        <h5 class="text-center alert alert-secondary">Modificar Administrador</h5>
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <?php
        include "../Controlador/actualizarAdministrador.php";
        while ($datos = $sql->fetch_object()) { ?>

            <div class="mb-1">
                <label for="exampleInputEmail1" class="form-label">Correo Electronico</label>
                <input type="text" class="form-control" name="correo_electronico" value="<?= $datos->correo_electronico ?>">
            </div>
            <div class="mb-1">
                <label for="exampleInputEmail1" class="form-label">Contraseña</label>
                <input type="text" class="form-control" name="contraseña" value="<?= $datos->contraseña ?>">
            </div>

        <?php }
        ?>
        <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Modificar Administrador</button>
        <a href="../administradores.php" class="boton">Regresar al inicio</a>
    </form>


</body>
</html>