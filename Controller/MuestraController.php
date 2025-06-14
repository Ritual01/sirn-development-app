<?php
require_once 'Models/Muestra.php';

class MuestraController {
    public function formulario() {
        require_once 'Views/muestras/formulario.php';
    }

    public function guardar() {
        require_once __DIR__ . '/../config/database.php';

        // Recibe los datos del formulario
        $lugar = $_POST['lugar'];
        $fecha = $_POST['fecha'];
        $ph = $_POST['ph'];
        $turbidez = $_POST['turbidez'];
        $temperatura = $_POST['temperatura'];
        $nivel_cloro = $_POST['nivel_cloro'];

        // Guarda en la base de datos
        $sql = "INSERT INTO muestra (lugar, fecha, ph, turbidez, temperatura, nivel_cloro) 
                VALUES (:lugar, :fecha, :ph, :turbidez, :temperatura, :nivel_cloro)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':lugar', $lugar);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':ph', $ph);
        $stmt->bindParam(':turbidez', $turbidez);
        $stmt->bindParam(':temperatura', $temperatura);
        $stmt->bindParam(':nivel_cloro', $nivel_cloro);
        $stmt->execute();

        // Llama a la API
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

        $resultado = json_decode($api_response, true);

        // Prepara los datos para la vista
        $datos = [
            'lugar' => $lugar,
            'fecha' => $fecha,
            'ph' => $ph,
            'turbidez' => $turbidez,
            'temperatura' => $temperatura,
            'nivel_cloro' => $nivel_cloro,
            'resultado_api' => $resultado // Ajusta el nombre según lo que devuelva la API
        ];

        // Carga la vista y pasa los datos
        require_once __DIR__ . '/../Views/analisis/resultado.php';
    }
}
?>

