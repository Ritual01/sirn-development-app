<?php
require_once 'Models/Muestra.php';

class MuestraController {
    public function formulario() {
        require_once 'Views/muestras/formulario.php';
    }

    public function guardar() {
        $muestra = new Muestra();
        $muestra->registrar($_POST['lugar'], $_POST['fecha'], $_POST['nivel_cloro']);
        echo "<script>alert('Muestra registrada'); window.location.href='index.php?c=Muestra&a=formulario';</script>";
    }
}
?>
