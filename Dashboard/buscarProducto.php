<?php require_once "Vistas/parte_superior.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .search-results {
            max-width: 1500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .table{
            color: black;
        }
        .search-results table {
            color: black;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .search-results th,
        .search-results td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .search-results th {
            background-color: #007bff;
            color: #fff;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="search-results">
        <h3 style="color: black;"><b>Buscados:</b></h3>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Tipo Prenda</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'modelo/conexion.php';
                if (isset($_GET['buscar'])) {
                    $busqueda = $_GET['busqueda'];

                    $consulta = $conexion->query("SELECT * FROM productos WHERE id_producto LIKE '%$busqueda%' OR nombre_producto LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%' OR precio LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%' OR tipo_prenda LIKE '%$busqueda%' OR estado LIKE '%$busqueda%'");

                    while ($row = $consulta->fetch_array()) {
                        echo '<tr>';
                        echo '<td>' . $row['id_producto'] . '</td>';
                        echo '<td>' . $row['nombre_producto'] . '</td>';
                        echo '<td>' . $row['descripcion'] . '</td>';
                        echo '<td>' . $row['precio'] . '</td>';
                        echo '<td>' . $row['categoria'] . '</td>';
                        echo '<td>' . $row['tipo_prenda'] . '</td>';
                        echo '<td>' . $row['estado'] . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
        <button type="button" id="cancelarBusqueda">Cancelar búsqueda</button>
    </div>
    <form id="searchForm" action="productos.php" method="GET"></form>
    <script>
        document.getElementById('cancelarBusqueda').addEventListener('click', function() {
            document.getElementById('searchForm').submit();
        });
    </script>

</body>

</html>


<?php require_once "Vistas/parte_inferior.php" ?>