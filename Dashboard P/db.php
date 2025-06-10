<?php
// db.php

$host = "w29ifufy55ljjmzq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$usuario = "htvv7guq3cc1i2yi";
$password = "b79bapb51asa0mme";
$nombre_bd = "k9ek3c3nz5ipfihw";

// Crear conexión
$conexion = new mysqli($host, $usuario, $password, $nombre_bd);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

function get_data($sql) {
    global $conexion;
    $result = $conexion->query($sql);
    return $result;
}
?>