<?php
require_once __DIR__ . '/../Models/Usuario.php';

class UsuarioController
{
    // Mostrar formulario de login
    public function loginForm()
    {
        require_once __DIR__ . '/../usuarios/login.php';
    }

    // Procesar login
    public function login()
    {
        session_start();
        require __DIR__ . '/../config/database.php';

        $correo = $_POST['correo'] ?? '';
        $password = $_POST['password'] ?? '';

        $usuario = Usuario::validarLogin($conexion, $correo, $password);

        if ($usuario) {
            $_SESSION['usuario'] = $usuario->nombre;
            header('Location: /sirn-development-app/index.php');
            exit();
        } else {
            $error = "Correo o contraseña incorrectos";
            require __DIR__ . '/../usuarios/login.php';
        }
    }

    // Cerrar sesión
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /sirn-development-app/usuarios/login.php');
        exit();
    }

    // Mostrar todos los usuarios
    public function index()
    {
        require __DIR__ . '/../config/database.php';
        $usuarios = Usuario::obtenerTodos($conexion);
        require __DIR__ . '/../usuarios/lista.php';
    }

    // Mostrar formulario de registro
    public function crearForm()
    {
        require __DIR__ . '/../usuarios/crear.php';
    }

    // Procesar registro de usuario
    public function crear()
    {
        require __DIR__ . '/../config/database.php';
        $usuario = new Usuario([
            'nombre' => $_POST['nombre'],
            'correo' => $_POST['correo'],
            'password' => $_POST['password']
        ]);
        $usuario->crear($conexion);
        header('Location: /sirn-development-app/index.php?c=Usuario&a=index');
        exit();
    }

    // Mostrar formulario de edición
    public function editarForm()
    {
        require __DIR__ . '/../config/database.php';
        $id = $_GET['id'] ?? null;
        $usuario = null;
        if ($id) {
            $result = $conexion->query("SELECT * FROM usuarios WHERE id = $id");
            $data = $result->fetch_assoc();
            $usuario = new Usuario($data);
        }
        require __DIR__ . '/../usuarios/editar.php';
    }

    // Procesar edición de usuario
    public function editar()
    {
        require __DIR__ . '/../config/database.php';
        $usuario = new Usuario([
            'id' => $_POST['id'],
            'nombre' => $_POST['nombre'],
            'correo' => $_POST['correo'],
            'password' => $_POST['password']
        ]);
        $usuario->actualizar($conexion);
        header('Location: /sirn-development-app/index.php?c=Usuario&a=index');
        exit();
    }

    // Eliminar usuario
    public function eliminar()
    {
        require __DIR__ . '/../config/database.php';
        $id = $_GET['id'] ?? null;
        if ($id) {
            $usuario = new Usuario(['id' => $id]);
            $usuario->eliminar($conexion);
        }
        header('Location: /sirn-development-app/index.php?c=Usuario&a=index');
        exit();
    }
}
?>
