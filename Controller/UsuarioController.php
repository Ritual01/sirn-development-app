<?php
class UsuarioController {
    public function mostrarLogin() {
        require_once 'Views/usuarios/login.php';
    }

    public function login() {
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        $url = "https://TU_DOMINIO_O_IP/api-auth/index.php"; // Cambiar por la URL real de tu API
        $data = json_encode(["correo" => $correo, "password" => $password]);

        $options = [
            "http" => [
                "header"  => "Content-type: application/json",
                "method"  => "POST",
                "content" => $data
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result, true);

        if (isset($response["token"])) {
            session_start();
            $_SESSION["usuario"] = $response["usuario"];
            $_SESSION["token"] = $response["token"];
            header("Location: index.php?c=Muestra&a=formulario");
        } else {
            echo "<script>alert('Credenciales incorrectas'); window.location.href='index.php';</script>";
        }
    }

    public function mostrarRegistro() {
        require_once 'Views/usuarios/registro.php';
    }

    public function guardarRegistro() {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        $confirmar_password = $_POST['confirmar_password'];

        if ($password !== $confirmar_password) {
            echo "<script>alert('Las contraseñas no coinciden'); window.location.href='index.php?c=Usuario&a=mostrarRegistro';</script>";
            return;
        }

        $url = "https://TU_DOMINIO_O_IP/api-auth/registro.php"; // Cambia por la URL real de tu API de registro
        $data = json_encode([
            "nombre" => $nombre,
            "correo" => $correo,
            "password" => $password
        ]);

        $options = [
            "http" => [
                "header"  => "Content-type: application/json",
                "method"  => "POST",
                "content" => $data
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result, true);

        if (isset($response["success"]) && $response["success"]) {
            echo "<script>alert('Registro exitoso, ahora puedes iniciar sesión'); window.location.href='index.php?c=Usuario&a=mostrarLogin';</script>";
        } else {
            $mensaje = isset($response["mensaje"]) ? $response["mensaje"] : "Error al registrar usuario";
            echo "<script>alert('$mensaje'); window.location.href='index.php?c=Usuario&a=mostrarRegistro';</script>";
        }
    }
}
?>
