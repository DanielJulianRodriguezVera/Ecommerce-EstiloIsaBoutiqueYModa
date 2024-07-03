<?php
require_once __DIR__ . "/../Models/Conexion.php";

class CatalogoController {
    public function mostrarProductos($categoria, $tipo_prenda) {
        global $conn;

        $sql = "SELECT * FROM productos WHERE categoria = ? AND tipo_prenda = ? AND estado = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $categoria, $tipo_prenda);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ruta_imagen = $row["imagen"];
                $ruta_imagen = str_replace('\\', '/', $ruta_imagen);

                echo "<div class='box'>";
                echo "<img src='" . $ruta_imagen . "' alt='" . $row["nombre_producto"] . "'>";
                echo "<h3 class='nombre' style='font-weight: bold; color: #fff;'>" . $row["nombre_producto"] . "</h3>";
                echo "<p class='descripcion' style='font-size: 2rem; color: #fff;'>" . $row["descripcion"] . "</p>";
                echo "<p class='precio' style='font-size: 2rem; color: #fff;'>$" . $row["precio"] . "</p>";
                echo '<a href="/PlantillasProyecto/Views/html/Header/carritoCompras.php?nombre_producto=' . urlencode($row['nombre_producto']) . '&precio=' . $row['precio'] . '" class="btn">Agregar Al Carrito</a>';
                echo '<a href="/PlantillasProyecto/Views/html/Header/detallesProducto.php?id_producto=' . $row['id_producto'] . '" class="btn">ver detalles</a>';
                echo "</div>";
            }
        } else {
            echo "No se encontraron productos.";
        }   

        $stmt->close();
    }
}
?>
