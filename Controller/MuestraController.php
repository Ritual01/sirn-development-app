<?php
require_once 'Models/Muestra.php';

class MuestraController {
    public function formulario() {
        require_once 'Views/muestras/formulario.php';
    }

    public function guardar() {
        // Recoger datos del formulario
        $lugar = $_POST['lugar'];
        $fecha = $_POST['fecha'];
        $ph = $_POST['ph'];
        $turbidez = $_POST['turbidez'];
        $temperatura = $_POST['temperatura'];
        $nivel_cloro = $_POST['nivel_cloro'];

        // Enviar datos a la API externa
        $data_api = [
            "ph" => floatval($ph),
            "turbidez" => floatval($turbidez),
            "temperatura" => floatval($temperatura),
            "nivel_cloro" => floatval($nivel_cloro)
        ];

        $ch = curl_init('https://sirn-development-app-production.up.railway.app/predict');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_api));
        $api_response = curl_exec($ch);
        curl_close($ch);

        // Guardar en la base de datos
        $muestra = new Muestra([
            'lugar' => $lugar,
            'fecha' => $fecha,
            'ph' => $ph,
            'turbidez' => $turbidez,
            'temperatura' => $temperatura,
            'nivel_cloro' => $nivel_cloro
        ]);
        // Asume que tienes una conexión $conexion
        // $muestra->guardar($conexion);

        // Pasar datos y respuesta de la API a la siguiente vista
        $resultado_api = json_decode($api_response, true);
        require 'Views/muestras/resultado.php';
    }
}
?>
