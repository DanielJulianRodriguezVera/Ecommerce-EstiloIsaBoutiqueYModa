<?php require_once "Vistas/parte_superior.php" ?>
<!-- INICIO DEL CONTENIDO PRINCIPAL-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PRODUCTO</title>
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

        .table-container {
            overflow-x: auto;
            width: 100%;
        }

        .data-table {
            width: 10%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 2px;
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
        <h2><b><u>Crud de Productos</u></b></h2>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <form action="buscarProducto.php" method="get">
                <label for="buscar">Buscar:</label>
                <input type="text" id="buscar" name="busqueda" placeholder="Escribe tu búsqueda aquí.." required>
                <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
            </form>
            <button style="margin-top: -12px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#crearProvModal">Crear Nuevo Proveedor</button>
        </div>

        <?php
        include "modelo/conexion.php";
        include "Controlador/crearProducto.php";
        include "Controlador/actualizarProducto.php";
        include "Controlador/eliminarProducto.php";
        ?>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre Producto</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio</th>
                        <th scope="col">ID Proveedor</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Tipo de Prenda</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "modelo/conexion.php";
                    $sql = $conexion->query("SELECT * FROM productos");
                    while ($datos = $sql->fetch_object()) { ?>
                        <tr>
                            <td><?= $datos->id_producto ?></td>
                            <td><?= $datos->nombre_producto ?></td>
                            <td><?= $datos->descripcion ?></td>
                            <td><?= $datos->precio ?></td>
                            <td><?= $datos->id_proveedor ?></td>
                            <td><?= $datos->categoria ?></td>
                            <td><?= $datos->tipo_prenda ?></td>
                            <td><?= $datos->estado ?></td>
                            <td><?= $datos->imagen ?></td>
                            <td>
                                <a href="modelo/modificarProducto.php?id=<?= $datos->id_producto ?>" class="btn btn-small btn-warning">Editar</a>
                                <a onclick="return eliminar()" href="productos.php?id=<?= $datos->id_producto ?>" class='btn btn-danger' style="margin-left: 74px; margin-top: -65px;">Eliminar</a>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="crearProvModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formNuevoProducto" method="POST">
                        <div class="form-group">
                            <label for="nombre">Nombre del Producto:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="255" required>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="text" class="form-control" id="precio" name="precio" pattern="\d+(\.\d{2})?" required>
                            <small>Ejemplo: 10.99 (dos decimales opcionales)</small>
                        </div>
                        <div class="form-group">
                            <label for="id_proveedor">Proveedor:</label>
                            <select class="form-control" id="id_proveedor" name="id_proveedor" required>
                                <option value="">Seleccionar Proveedor</option>
                                <?php
                                include "modelo/conexion.php"; 
                                $sql_proveedores = "SELECT id_proveedor, nombre_proveedor FROM proveedores";
                                $resultado_proveedores = $conexion->query($sql_proveedores);

                                if ($resultado_proveedores->num_rows > 0) { 
                                    while ($proveedor = $resultado_proveedores->fetch_assoc()) {
                                        echo '<option value="' . $proveedor["id_proveedor"] . '">' . $proveedor["nombre_proveedor"] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No se encontraron proveedores</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="categoria">Categoría:</label>
                            <select class="form-control" id="categoria" name="categoria" required>
                                <?php
                                include "modelo/conexion.php"; 

                                $sql_enum_categoria = "SHOW COLUMNS FROM productos LIKE 'categoria'";
                                $resultado_enum_categoria = $conexion->query($sql_enum_categoria);

                                if ($resultado_enum_categoria->num_rows > 0) {
                                    $fila_enum_categoria = $resultado_enum_categoria->fetch_assoc();
                                    $opciones_categoria = explode(",", str_replace("'", "", substr($fila_enum_categoria["Type"], 5, -1)));

                                    foreach ($opciones_categoria as $opcion) {
                                        echo '<option value="' . $opcion . '">' . ucfirst($opcion) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tipo_prenda">Tipo de Prenda:</label>
                            <select class="form-control" id="tipo_prenda" name="tipo_prenda" required>
                                <?php
                                $sql_enum_tipo_prenda = "SHOW COLUMNS FROM productos LIKE 'tipo_prenda'";
                                $resultado_enum_tipo_prenda = $conexion->query($sql_enum_tipo_prenda);

                                if ($resultado_enum_tipo_prenda->num_rows > 0) {
                                    $fila_enum_tipo_prenda = $resultado_enum_tipo_prenda->fetch_assoc();
                                    $opciones_tipo_prenda = explode(",", str_replace("'", "", substr($fila_enum_tipo_prenda["Type"], 5, -1)));

                                    foreach ($opciones_tipo_prenda as $opcion) {
                                        echo '<option value="' . $opcion . '">' . ucfirst($opcion) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <?php
                                include "modelo/conexion.php"; 
                                $sql_enum_estado = "SHOW COLUMNS FROM productos LIKE 'estado'";
                                $resultado_enum_estado = $conexion->query($sql_enum_estado);

                                if ($resultado_enum_estado->num_rows > 0) {
                                    $fila_enum_estado = $resultado_enum_estado->fetch_assoc();
                                    $opciones_estado = explode(",", str_replace("'", "", substr($fila_enum_estado["Type"], 5, -1)));

                                    foreach ($opciones_estado as $opcion) {
                                        echo '<option value="' . $opcion . '">' . ucfirst($opcion) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen:</label>
                            <input type="text" class="form-control" id="imagen" name="imagen" maxlength="255" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="btnCrearProducto" value="ok">Crear Producto</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function eliminar() {
            var respuesta = confirm("¿Está seguro de eliminar este producto?");
            return respuesta;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+J/HAU6P7sS/5zZ+E1Mc3Kx5m/e16kzwj6fAfrsh+ffJJpu" crossorigin="anonymous"></script>

</body>
</html>

<!-- FIN DEL CONTENIDO PRINCIPAL -->
<?php require_once "Vistas/parte_inferior.php" ?>