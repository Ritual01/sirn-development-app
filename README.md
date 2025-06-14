# API de Red Neuronal 🦢

Este proyecto es una API construida con FastAPI que permite interactuar con un modelo de red neuronal para analizar la potabilidad del agua. Proporciona endpoints para analizar muestras, consultar resultados y gestionar datos.

## Estructura Completa del Proyecto

```
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
```

## Instalación

1. Clona el repositorio:
   ```
   git clone https://github.com/Ritual01/sirn-development-app
   cd sirn-development-app
   ```

2. Crea un entorno virtual y actívalo:
   ```
   python -m venv venv
   # En Linux o Mac
   source venv/bin/activate
   # En Windows
   venv\Scripts\activate
   ```

3. Instala las dependencias:
   ```
   pip install -r bibliotecas.txt
   ```

## Uso

1. Inicia la aplicación:
   ```
   python main.py
   ```

2. Realiza peticiones a la API utilizando herramientas como Postman o cURL.

## Endpoints de la API

- **POST /red-neuronal**: Envía un JSON con los campos `ph`, `turbidez`, `cloro`, `contaminante` para analizarlos con la red neuronal activa. Devuelve el parámetro `potabilidad`.
- **GET /red-neuronal**: Obtiene los datos actuales del uso de la red neuronal.
- **DELETE /red-neuronal**: Elimina el dato utilizado como muestra para evitar que sea usado en futuros entrenamientos.  
  _Nota: Actualmente este método está desactivado._

## Contribuciones

Las contribuciones son bienvenidas. Si deseas contribuir, por favor abre un issue o envía un pull request. Se dará prioridad a los que tengan el emoji del cisne "🦢".
