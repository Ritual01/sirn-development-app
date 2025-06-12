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

/**
 * Ejecuta una consulta SQL y devuelve el resultado
 *
 * @param string $sql Consulta SQL a ejecutar
 * @return mysqli_result|false Resultado de la consulta o false si falla
 */
function get_data($sql) {
    global $conn;
    $result = $conn->query($sql);

    if (!$result) {
        // Mostrar error para depuración (opcional: loguear en archivo)
        echo "<div class='alert alert-warning text-center mt-3'>Error en la consulta: " . htmlspecialchars($conn->error) . "</div>";
        return false;
    }

    return $result;
}

// Nota: No cerrar la conexión aquí. Hazlo al final del script principal si es necesario.
// $conn->close();
?>
