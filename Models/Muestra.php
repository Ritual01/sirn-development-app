<?php
require_once 'config/database.php';

class Muestra {
    private $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    public function registrar($lugar, $fecha, $nivel_cloro) {
        $sql = "INSERT INTO muestras (lugar, fecha, nivel_cloro) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$lugar, $fecha, $nivel_cloro]);
    }
}
?>
