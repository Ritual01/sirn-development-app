<?php
// Configuración de conexión a la base de datos
$host = 'shinkansen.proxy.rlwy.net';
$port = 58011;
$user = 'root';
$password = 'MfRHWkDxulehDoyCOLXqGjrFvsFxtecQ';
$dbname = 'railway';

// Crear conexión con MySQLi 
$conn = new mysqli($host, $user, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("<div class='alert alert-danger text-center mt-4'><strong>Error de conexión:</strong> " . htmlspecialchars($conn->connect_error) . "</div>");
}
?>
