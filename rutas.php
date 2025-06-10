<?php
// Lee parámetros de la URL
$controlador = $_GET['c'] ?? 'Usuario';  // controlador por defecto
$accion = $_GET['a'] ?? 'mostrarLogin'; // acción por defecto

// Construye el nombre del archivo del controlador
$archivo = "controllers/" . $controlador . "Controller.php";

// Verifica que el archivo exista
if (file_exists($archivo)) {
    require_once $archivo;

    $nombreClase = $controlador . "Controller";

    if (class_exists($nombreClase)) {
        $objeto = new $nombreClase();

        // Verifica que la acción (método) exista en el controlador
        if (method_exists($objeto, $accion)) {
            $objeto->$accion();
        } else {
            echo "Error: la acción '$accion' no existe en el controlador '$nombreClase'.";
        }
    } else {
        echo "Error: clase '$nombreClase' no encontrada.";
    }
} else {
    echo "Error: controlador '$archivo' no encontrado.";
}
