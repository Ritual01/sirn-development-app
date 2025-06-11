<?php
$host = 'shinkansen.proxy.rlwy.net';
$port = 58011;
$user = 'root';
$password = 'MfRHWkDxulehDoyCOLXqGjrFvsFxtecQ';
$dbname = 'railway';

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function get_data($sql) {
    global $conn;
    return $conn->query($sql);
}

// No cierres la conexión aquí, hazlo al final de tu script principal
// $conn->close();
?>
