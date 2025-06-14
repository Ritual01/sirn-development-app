
# SIRN Development App

Aplicación web para la gestión y análisis de muestras de agua, desarrollada en PHP bajo arquitectura MVC simple.

## Características

- Registro de muestras con atributos: lugar, fecha, pH, turbidez, temperatura y nivel de cloro.
- Envío de datos a una API externa para análisis.
- Almacenamiento de muestras en base de datos.
- Panel de dashboard y consulta de servicio externo.
- Autenticación de usuarios mediante login.

## Estructura de Carpetas

sirn-development-app/
├── bdSirn.sql                       # Script de base de datos SQL
├── bibliotecas.txt                  # Dependencias Python del proyecto
├── config.php/
│   └── database.php                 # Configuración de conexión a base de datos en PHP
├── Controller/
│   ├── AnalisisController.php       # Controlador PHP para análisis
│   ├── MuestraController.php        # Controlador PHP para muestras
│   └── UsuarioController.php        # Controlador PHP para usuarios
├── datos.csv                        # Datos de entrenamiento del modelo
├── index.php                        # Punto de entrada principal PHP
├── main.py                          # Punto de entrada principal de la API FastAPI
├── modelos/
│   ├── entrenarModelo.py            # Script para entrenar el modelo de red neuronal
│   ├── graficos.py                  # Generación de gráficos y visualizaciones
│   ├── modelo.py                    # Lógica y definición del modelo de red neuronal
│   ├── modeloEntrenado.pkl          # Modelo entrenado serializado (pickle)
│   ├── scaler.pkl                   # Escalador de datos serializado (pickle)
│   └── __pycache__/
│       └── modelo.cpython-313.pyc   # Archivos cacheados de Python
├── Models/
│   ├── Analisis.php                 # Modelo PHP para análisis
│   ├── Muestra.php                  # Modelo PHP para muestras
│   └── Usuario.php                  # Modelo PHP para usuarios
├── Procfile                         # Configuración para despliegue (necesario para despliegue en heroku 🦢)
├── README.md                        # Documentación del proyecto
├── requirements.txt                 # Alternativa de dependencias Python (necesario para despliegue en heroku)
├── rutas/
│   └── red_neuronal.py              # Rutas de la API para la red neuronal (FastAPI)
├── rutas.php                        # Rutas principales para la app PHP
├── sirn-development-app-Melendez/   # Carpeta adicional (posible fork o variante)
├── utilidades/
│   └── __init__.py                  # Funciones utilitarias Python
├── Views/
│   ├── analisis/
│   │   └── resultado.php            # Vista de resultados de análisis
│   ├── Dashboard P/
│   │   ├── dahsboard.php            # Vista principal del dashboard
│   │   ├── db.php                   # Conexión a base de datos para dashboard
│   │   ├── css/
│   │   │   └── style.css            # Estilos CSS del dashboard
│   │   ├── includes/
│   │   │   ├── footer.php           # Pie de página del dashboard
│   │   │   └── header.php           # Encabezado del dashboard
│   │   └── js/
│   │       └── chart.js             # Scripts de gráficos para dashboard
│   ├── muestras/
│   │   └── formulario.php           # Formulario de ingreso de muestras
│   └── usuarios/
│       ├── login.php                # Vista de inicio de sesión
│       └── registro.php             # Vista de registro de usuario
└── __pycache__/                     # Archivos cacheados de Python
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

