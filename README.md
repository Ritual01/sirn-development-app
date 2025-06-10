# Proyecto API de Red Neuronal
🦢
Este proyecto es una API construida con FastApi que permite interactuar con un modelo de red neuronal. La API proporciona métodos para realizar operaciones de creación, lectura y eliminación en el modelo de red neuronal.

## Estructura del Proyecto

```
SIRN-DEVELOPMENT-APP-1
├── main.py               # Punto de entrada de la aplicación
├── rutas
│   └── red_neuronal.py  # Rutas para la red neuronal
├── modelos
│   └── red.py           # Definición del modelo de red neuronal
├── utilidades
│   └── __init__.py      # Funciones y clases utilitarias
├── bibliotecas.txt          # Dependencias del proyecto
├── README.md                 # Documentación del proyecto
└── datos.csv                # Datos usados en el entrenamiento del modelo 🦎   
```

## Instalación

1. Clona el repositorio:
   ```
   git clone https://github.com/Ritual01/sirn-development-app
   cd api-red-neuronal
   ```

2. Crea un entorno virtual y actívalo:
   ```
   python -m venv venv
   source venv/bin/activate  # En Linux o Mac
   venv\Scripts\activate     # En Windows
   ```

3. Instala las dependencias:
   ```
   pip install -r requirements.txt
   ```

## Uso

1. Inicia la aplicación:
   ```
   python src/app.py
   ```

2. Realiza peticiones a la API utilizando herramientas como Postman o cURL.

## Métodos de la API

- **POST /red-neuronal**: Sube un json con los campos (ph,turbidez,cloro,contaminante) para analizarlos con la red neuronal activa; devuelve parametro "potabilidad".
- **GET /red-neuronal**: Obtiene los datos actuales del uso de la red neuronal.
- **DELETE /red-neuronal**: Elimina el dato utilizado como muestra para evitar ser utilizado en futuros entrenamientos.  //En este momento se encuentra desactivado este método

## Contribuciones

Las contribuciones son bienvenidas. Si deseas contribuir, por favor abre un issue o envía un pull request, serán contestados los que tengan el emoji del cisne "🦢"
