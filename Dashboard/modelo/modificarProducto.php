<?php

include 'conexion.php';

$id=$_GET["id"];

$sql=$conexion->query("SELECT * FROM productos WHERE id_producto=$id ");
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
        <h5 class="tex t-center alert alert-secondary">Modificar Producto</h5>
        <input type="hidden" name="id" value="<?=$_GET["id"]?>">
        <?php
        include "../Controlador/actualizarProducto.php";
        while ($datos = $sql->fetch_object()) { ?>
            
            <div class="mb-1">
                <label for="exampleInputEmail1" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre_producto?>">
            </div>
            <div class="mb-1">
                <label for="exampleInputEmail1" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" name="descripcion" value="<?= $datos->descripcion?>">
            </div>
            <div class="mb-1">
                <label for="exampleInputEmail1" class="form-label">Precio:</label>
                <input type="text" class="form-control" name="precio" value="<?= $datos->precio?>">
            </div>
            <div class="mb-1">
                <label for="id_proveedor" class="form-label">Proveedor:</label>
                <select class="form-control" id="id_proveedor" name="id_proveedor">
                    <?php
                    $sql_proveedores = "SELECT id_proveedor, nombre_proveedor FROM proveedores";
                    $resultado_proveedores = $conexion->query($sql_proveedores);

                    if ($resultado_proveedores->num_rows > 0) {
                        while ($proveedor = $resultado_proveedores->fetch_assoc()) {
                            $selected = ($datos->id_proveedor == $proveedor["id_proveedor"]) ? "selected" : "";
                            echo '<option value="' . $proveedor["id_proveedor"] . '" ' . $selected . '>' . $proveedor["nombre_proveedor"] . '</option>';
                        }
                    } else {
                        echo '<option value="">No se encontraron proveedores</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-1">
                <label for="categoria" class="form-label">Categoría:</label>
                <select class="form-control" id="categoria" name="categoria">
                    <?php
                    $sql_enum_categoria = "SHOW COLUMNS FROM productos LIKE 'categoria'";
                    $resultado_enum_categoria = $conexion->query($sql_enum_categoria);

                    if ($resultado_enum_categoria->num_rows > 0) {
                        $fila_enum_categoria = $resultado_enum_categoria->fetch_assoc();
                        $opciones_categoria = explode(",", str_replace("'", "", substr($fila_enum_categoria["Type"], 5, -1)));

                        foreach ($opciones_categoria as $opcion) {
                            $selected = ($datos->categoria == $opcion) ? "selected" : "";
                            echo '<option value="' . $opcion . '" ' . $selected . '>' . ucfirst($opcion) . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-1">
                <label for="tipo_prenda" class="form-label">Tipo de Prenda:</label>
                <select class="form-control" id="tipo_prenda" name="tipo_prenda">
                    <?php
                    $sql_enum_tipo_prenda = "SHOW COLUMNS FROM productos LIKE 'tipo_prenda'";
                    $resultado_enum_tipo_prenda = $conexion->query($sql_enum_tipo_prenda);

                    if ($resultado_enum_tipo_prenda->num_rows > 0) {
                        $fila_enum_tipo_prenda = $resultado_enum_tipo_prenda->fetch_assoc();
                        $opciones_tipo_prenda = explode(",", str_replace("'", "", substr($fila_enum_tipo_prenda["Type"], 5, -1)));

                        foreach ($opciones_tipo_prenda as $opcion) {
                            $selected = ($datos->tipo_prenda == $opcion) ? "selected" : "";
                            echo '<option value="' . $opcion . '" ' . $selected . '>' . ucfirst($opcion) . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-1">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-control" id="estado" name="estado">
                    <?php
                    $sql_enum_estado = "SHOW COLUMNS FROM productos LIKE 'estado'";
                    $resultado_enum_estado = $conexion->query($sql_enum_estado);

                    if ($resultado_enum_estado->num_rows > 0) {
                        $fila_enum_estado = $resultado_enum_estado->fetch_assoc();
                        $opciones_estado = explode(",", str_replace("'", "", substr($fila_enum_estado["Type"], 5, -1)));

                        foreach ($opciones_estado as $opcion) {
                            $selected = ($datos->estado == $opcion) ? "selected" : "";
                            echo '<option value="' . $opcion . '" ' . $selected . '>' . ucfirst($opcion) . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-1">
                <label for="exampleInputEmail1" class="form-label">Imagen:</label>
                <input type="text" class="form-control" name="imagen" value="<?= $datos->imagen?>">
            </div>
            
        <?php }
        ?>
        <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Modificar Producto</button>
        <a href="../productos.php" class="boton">Regresar al inicio</a>
    </form>


</body>
</html>