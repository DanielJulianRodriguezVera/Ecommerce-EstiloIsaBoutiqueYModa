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
                <th>Telefono</th>
                <th>Direccion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'modelo/conexion.php';
            if (isset($_GET['q'])) {
                $busqueda = $_GET['q'];

                // Realizar la consulta SQL
                $consulta = $conexion->query("SELECT * FROM proveedores WHERE id_proveedor LIKE '%$busqueda%' OR nombre_proveedor LIKE '%$busqueda%' OR telefono_proveedor LIKE '%$busqueda%' OR direccion LIKE '%$busqueda%'");

                // Verificar si se encontraron resultados
                if ($consulta->num_rows > 0) {
                    while ($row = $consulta->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['id_proveedor'] . '</td>';
                        echo '<td>' . $row['nombre_proveedor'] . '</td>';
                        echo '<td>' . $row['telefono_proveedor'] . '</td>';
                        echo '<td>' . $row['direccion'] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">No se encontraron resultados para la búsqueda.</td></tr>';
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td>
                <button type="button" id="cancelarBusqueda">Cancelar búsqueda</button>

                </td>
                
            </tr>
        </tfoot>
    </table>
</div>

    <form id="searchForm" action="proveedores.php" method="GET"></form>
    <script>
        document.getElementById('cancelarBusqueda').addEventListener('click', function() {
            document.getElementById('searchForm').submit();
        });
    </script>

</body>

</html>


<?php require_once "Vistas/parte_inferior.php" ?>