<?php
require_once __DIR__ . '/../config/database.php';

class Usuario
{
    public $id;
    public $nombre;
    public $correo;
    public $password;

    public function __construct($data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'] ?? '';
        $this->correo = $data['correo'] ?? '';
        $this->password = $data['password'] ?? '';
    }

    // Crear usuario
    public function crear($conexion)
    {
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)");
        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        return $stmt->execute([$this->nombre, $this->correo, $hash]);
    }

    // Buscar usuario por correo
    public static function buscarPorCorreo($conexion, $correo)
    {
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        $data = $stmt->get_result()->fetch_assoc();
        return $data ? new Usuario($data) : null;
    }

    // Validar login
    public static function validarLogin($conexion, $correo, $password)
    {
        $usuario = self::buscarPorCorreo($conexion, $correo);
        if ($usuario && password_verify($password, $usuario->password)) {
            return $usuario;
        }
        return null;
    }

    // Obtener todos los usuarios
    public static function obtenerTodos($conexion)
    {
        $result = $conexion->query("SELECT * FROM usuarios");
        $usuarios = [];
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = new Usuario($row);
        }
        return $usuarios;
    }

    // Actualizar usuario
    public function actualizar($conexion)
    {
        $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, correo = ?, password = ? WHERE id = ?");
        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        return $stmt->execute([$this->nombre, $this->correo, $hash, $this->id]);
    }

    // Eliminar usuario
    public function eliminar($conexion)
    {
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$this->id]);
    }
}
?>
