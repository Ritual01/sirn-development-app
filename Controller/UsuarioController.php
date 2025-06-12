<?php
require_once 'Models/Usuario.php';

class UsuarioController {

    // Muestra el formulario de inicio de sesión
    public function mostrarLogin() {
        require_once 'Views/usuarios/login.php';
    }

    // Procesa el login
    public function login() {
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        $usuario = new Usuario();
        $datos = $usuario->login($correo, $password);

        if ($datos) {
            session_start();
            $_SESSION['usuario'] = $datos;
            header("Location: index.php?c=Muestra&a=formulario");
        } else {
            echo "<script>alert('Correo o contraseña incorrectos'); window.location.href='index.php';</script>";
        }
    }

    // Muestra el formulario de registro
    public function registro() {
        require_once 'Views/usuarios/registro.php';
    }

    // Guarda el registro de un nuevo usuario
    public function guardarRegistro() {
        $usuario = new Usuario();
        $usuario->registrar($_POST['nombre'], $_POST['correo'], $_POST['password']);
        echo "<script>alert('Usuario registrado correctamente'); window.location.href='index.php';</script>";
    }
}
?>
