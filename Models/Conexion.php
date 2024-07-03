<?php
    $servername = "127.0.0.1"; 
    $username = "root"; 
    $password = ""; 
    $database = "estiloisaboutiqueymoda"; 

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");

    return $conn;
?>
