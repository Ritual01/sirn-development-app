<?php
require_once 'config/database.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    public function registrar($nombre, $correo, $password) {
        $sql = "INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $correo, password_hash($password, PASSWORD_DEFAULT)]);
    }

    public function login($correo, $password) {
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$correo]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }
        return false;
    }
}
?>
