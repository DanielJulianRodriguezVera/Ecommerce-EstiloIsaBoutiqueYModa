<?php require_once "Vistas/parte_superior.php" ?>
<!-- INICIO DEL CONTENIDO PRINCIPAL-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PROVEEDOR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
        }

        .container {
            max-width: 1200px;
            margin: -22px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .search-form {
            margin-bottom: 20px;
        }

        .search-form label {
            font-weight: bold;
        }

        .search-form input[type="text"] {
            width: 58%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        .search-form button {
            padding: 8px 15px;
            margin-left: 5px;
            border-radius: 3px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .data-table th {
            background-color: #007bff;
            color: #fff;
            text-align: left;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .data-table tbody tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><b><u>Crud de Proveedores</u></b></h2>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <form action="buscarProveedor.php" method="get">
                <label for="buscar">Buscar:</label>
                <input type="text" id="buscar" name="q" placeholder="Escribe tu búsqueda aquí.." required>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#crearProvModal">Crear Nuevo Proveedor</button>
        </div>

        <?php
        include "modelo/conexion.php";
        include "Controlador/crearProveedor.php";
        include "Controlador/actualizarProveedor.php";
        include "Controlador/eliminarProveedor.php";
        ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "modelo/conexion.php";
                $sql = $conexion->query("SELECT * FROM proveedores");
                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <td><?= $datos->id_proveedor ?></td>
                        <td><?= $datos->nombre_proveedor ?></td>
                        <td><?= $datos->telefono_proveedor ?></td>
                        <td><?= $datos->direccion ?></td>
                        <td>
                            <a href="modelo/modificarProveedor.php?id=<?= $datos->id_proveedor ?>" class="btn btn-small btn-warning">Editar</a>
                            <a onclick="return eliminar()" href="proveedores.php?id=<?= $datos->id_proveedor ?>" class='btn btn-danger' >Eliminar</a>
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="crearProvModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formNuevoProv" method="POST">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div><br>
                        <button type="submit" class="btn btn-primary" name="btncrearprov" value="ok">Crear Proveedor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function eliminar(){
            var respuesta=confirm("¿Está seguro de eliminar este proveedor?");
            return respuesta;
        }
    </script>

</body>
</html>

<!-- FIN DEL CONTENIDO PRINCIPAL -->

<?php require_once "Vistas/parte_inferior.php" ?>