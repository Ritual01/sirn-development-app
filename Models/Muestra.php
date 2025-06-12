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

    public $id;
    public $lugar;
    public $fecha;
    public $ph;
    public $turbidez;
    public $temperatura;
    public $nivel_cloro;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->lugar = $data['lugar'] ?? '';
        $this->fecha = $data['fecha'] ?? '';
        $this->ph = $data['ph'] ?? 0;
        $this->turbidez = $data['turbidez'] ?? 0;
        $this->temperatura = $data['temperatura'] ?? 0;
        $this->nivel_cloro = $data['nivel_cloro'] ?? 0;
    }

    // Ejemplo de método para guardar la muestra en la base de datos
    public function guardar($conexion) {
        $sql = "INSERT INTO muestras (lugar, fecha, ph, turbidez, temperatura, nivel_cloro)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        return $stmt->execute([
            $this->lugar,
            $this->fecha,
            $this->ph,
            $this->turbidez,
            $this->temperatura,
            $this->nivel_cloro
        ]);
    }

    // Puedes agregar más métodos según tus necesidades (listar, buscar, etc.)
}
?>
