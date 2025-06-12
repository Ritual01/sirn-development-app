<?php
<<<<<<< HEAD
session_start();

// Si no está autenticado, redirige a login
if (!isset($_SESSION['usuario'])) {
    header('Location: usuarios/login.php');
    exit();
}

=======
// Este archivo se coloca en la raíz del proyecto
>>>>>>> 552c46309d4b51bffce4ad44a969e4e99bb5ecdb
require_once 'rutas.php';
require_once 'C:\xampp\htdocs\sirn-development-app\config\database.php';

// Lista blanca de controladores y acciones permitidas
$controladoresPermitidos = [
    'Muestra'   => ['formulario', 'guardar'],
    'Dashboard' => ['index'],
    'Servicio'  => ['get'],
    // Agrega aquí otros controladores y acciones válidas
];

// Obtener controlador y acción de la URL, o valores por defecto
$controlador = isset($_GET['c']) ? $_GET['c'] : 'Muestra';
$accion      = isset($_GET['a']) ? $_GET['a'] : 'formulario';

// Validar controlador y acción
if (array_key_exists($controlador, $controladoresPermitidos) &&
    in_array($accion, $controladoresPermitidos[$controlador])) {

    $controladorArchivo = "Controller/{$controlador}Controller.php";
    if (file_exists($controladorArchivo)) {
        require_once $controladorArchivo;
        $claseControlador = $controlador . 'Controller';
        $objControlador = new $claseControlador();
        if (method_exists($objControlador, $accion)) {
            $objControlador->$accion();
        } else {
            echo "Acción no válida.";
        }
    } else {
        echo "Controlador no encontrado.";
    }
} else {
    echo "Ruta no permitida.";
}
?>
<!-- filepath: c:\xampp\htdocs\sirn-development-app\Views\menu\principal.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Principal</title>
    <style>
        body {
            background-color: #eaf6f6;
            font-family: Arial, sans-serif;
        }
        .menu-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(123, 74, 33, 0.10);
            max-width: 350px;
            margin: 70px auto;
            padding: 32px 32px 24px 32px;
            border: 1px solid #c2b09b;
            text-align: center;
        }
        h2 {
            color: #7b4a21;
            margin-bottom: 30px;
        }
        .menu-btn {
            background-color: #7b4a21;
            color: #eaf6f6;
            border: none;
            padding: 15px 0;
            width: 100%;
            border-radius: 4px;
            font-size: 17px;
            cursor: pointer;
            margin-bottom: 18px;
            font-weight: bold;
            letter-spacing: 1px;
            transition: background 0.2s;
        }
        .menu-btn:hover {
            background-color: #009688;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <h2>Menú Principal</h2>
        <form action="index.php" method="get">
            <button class="menu-btn" type="submit" name="c" value="Muestra" formaction="index.php?c=Muestra&a=formulario">Ingresar Muestra</button>
            <button class="menu-btn" type="submit" name="c" value="Dashboard" formaction="index.php?c=Dashboard&a=index">Dashboard</button>
            <button class="menu-btn" type="submit" name="c" value="Servicio" formaction="index.php?c=Servicio&a=get">GET del Servicio</button>
        </form>
    </div>
</body>
</html>
