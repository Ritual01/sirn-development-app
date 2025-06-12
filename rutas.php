<?php
$controlador = $_GET['c'] ?? 'Usuario';
$accion = $_GET['a'] ?? 'mostrarLogin';

$archivo = "Controller/{$controlador}Controller.php";
if (file_exists($archivo)) {
    require_once $archivo;
    $clase = $controlador . 'Controller';
    $objeto = new $clase();

    if (method_exists($objeto, $accion)) {
        $objeto->$accion();
    } else {
        echo "Acción no encontrada";
    }
} else {
    echo "Controlador no encontrado";
}
