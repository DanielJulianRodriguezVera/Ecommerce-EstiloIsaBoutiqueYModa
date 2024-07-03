<?php
// Incluir archivo de conexión a la base de datos
include 'modelo/conexion.php';

// Consulta SQL para obtener el total de clientes registrados
$consulta_total_clientes = "SELECT COUNT(*) AS total_clientes FROM usuarios";

$resultado_total_clientes = mysqli_query($conexion, $consulta_total_clientes);

// Obtener el resultado como un array asociativo
$fila_total_clientes = mysqli_fetch_assoc($resultado_total_clientes);

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

// Obtener el total de clientes
$total_clientes = $fila_total_clientes['total_clientes'];
?>


<?php require_once "Vistas/parte_superior.php" ?>

<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index-Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
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

    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-xs font-weight-bold text-dark text-uppercase mb-1" style="font-size: 150%; color: black;">"Estilo Isa y Boutique Moda"</h1>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-6" style="margin-left: 20px; font-size: 15px;">
                                    Clientes</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" style="margin-left: 45px;">
                                    <?php
                                    include 'modelo/conexion.php';
                                    $consulta = "SELECT COUNT(*) AS total_clientes FROM usuarios";
                                    $resultado = mysqli_query($conexion, $consulta);
                                    $fila = mysqli_fetch_assoc($resultado);
                                    echo $fila['total_clientes'];
                                    mysqli_close($conexion);
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-person-bounding-box" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-6" style="margin-left: 20px; font-size: 15px;">
                                    Productos</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" style="margin-left: 45px;">
                                    <?php
                                    include 'modelo/conexion.php';
                                    $consulta_productos = "SELECT COUNT(*) AS total_productos FROM productos";
                                    $resultado_productos = mysqli_query($conexion, $consulta_productos);
                                    $fila_productos = mysqli_fetch_assoc($resultado_productos);
                                    echo $fila_productos['total_productos'];
                                    mysqli_close($conexion);
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-bag" style="font-size: 3rem;"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-6" style="margin-left: 20px; font-size: 13px;">
                                    Opiniones Pagina</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" style="margin-left: 60px;">
                                    <?php
                                    include 'modelo/conexion.php';
                                    $consulta_opiniones = "SELECT COUNT(*) AS total_opiniones FROM pagina_contacto";
                                    $resultado_opiniones = mysqli_query($conexion, $consulta_opiniones);
                                    $fila_opiniones = mysqli_fetch_assoc($resultado_opiniones);
                                    echo $fila_opiniones['total_opiniones'];
                                    mysqli_close($conexion);
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-box-seam-fill" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Clientes Registrados</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="mt-3 text-center">
                        <p class="font-weight-bold">Total de usuarios registrados: <?php echo $total_clientes; ?></p>
                    </div>
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Datos del gráfico
                const totalClientes = <?php echo $total_clientes; ?>;

                // Configuración del gráfico
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line', // Cambiado a tipo de gráfico de línea
                    data: {
                        labels: ['Clientes Registrados'],
                        datasets: [{
                            label: 'Número de Clientes',
                            data: [totalClientes],
                            fill: false, // No rellenar debajo de la línea
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            stepped: 'middle' // Tipo de gráfico de escalera
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            });
        </script>
    </div>
</body>

</html>

<!-- FIN DEL CONTENIDO PRINCIPAL -->

<?php require_once "Vistas/parte_inferior.php" ?>