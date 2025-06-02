<?php
require_once 'config/database.php';

class Analisis {
    private $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    public function obtenerUltimos() {
        $sql = "SELECT * FROM muestras ORDER BY fecha DESC LIMIT 5";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
