<?php
require_once 'Models/Analisis.php';

class AnalisisController {
    public function resultado() {
        $analisis = new Analisis();
        $datos = $analisis->obtenerUltimos();
        require_once 'Views/analisis/resultado.php';
    }
}
?>
