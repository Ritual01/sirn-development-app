# Proyecto API de Red Neuronal
🦢
Este proyecto es una API construida con Flask que permite interactuar con un modelo de red neuronal. La API proporciona métodos para realizar operaciones de creación, lectura y eliminación en el modelo de red neuronal.

## Estructura del Proyecto

```
SIRN-DEVELOPMENT-APP-1
├── src
│   ├── app.py               # Punto de entrada de la aplicación
│   ├── rutas
│   │   └── red_neuronal.py  # Rutas para la red neuronal
│   ├── modelos
│   │   └── red.py           # Definición del modelo de red neuronal
│   └── utilidades
│       └── __init__.py      # Funciones y clases utilitarias
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

- **POST /red-neuronal**: Crea un nuevo modelo de red neuronal.
- **GET /red-neuronal**: Obtiene información sobre el modelo de red neuronal.
- **DELETE /red-neuronal**: Elimina el modelo de red neuronal.

## Contribuciones

Las contribuciones son bienvenidas. Si deseas contribuir, por favor abre un issue o envía un pull request, serán contestados los que tengan el emoji del cisne "🦢"