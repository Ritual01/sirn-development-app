# SIRN Development App

Aplicación web para la gestión y análisis de muestras de agua, desarrollada en PHP bajo arquitectura MVC simple.

## Características

- Registro de muestras con atributos: lugar, fecha, pH, turbidez, temperatura y nivel de cloro.
- Envío de datos a una API externa para análisis.
- Almacenamiento de muestras en base de datos.
- Panel de dashboard y consulta de servicio externo.
- Autenticación de usuarios mediante login.

## Estructura de Carpetas

```
sirn-development-app/
│
├── Controller/
│   ├── MuestraController.php
│   ├── UsuarioController.php
│   └── ...
├── Models/
│   ├── Muestra.php
│   ├── Usuario.php
│   └── ...
├── Views/
│   ├── muestras/
│   │   ├── formulario.php
│   │   ├── resultado.php
│   │   └── ...
│   ├── menu/
│   │   └── principal.php
│   └── ...
├── usuarios/
│   ├── login.php
│   ├── logout.php
│   └── ...
├── config/
│   └── database.php
├── index.php
├── rutas.php
└── README.md
```

## Instalación

1. Clona o copia el proyecto en la carpeta `htdocs` de XAMPP.
2. Crea la base de datos y la tabla `muestras` con los campos necesarios.
3. Configura la conexión en `config/database.php`:
    ```php
    $conexion = new mysqli('localhost', 'usuario', 'contraseña', 'nombre_base_datos');
    ```
4. Inicia Apache y MySQL desde XAMPP.

## Uso

- Accede a `http://localhost/sirn-development-app/` en tu navegador.
- Inicia sesión con tus credenciales.
- Usa el menú principal para ingresar muestras, ver el dashboard o consultar el servicio externo.

## Notas

- Asegúrate de tener habilitado PHP y MySQL en tu servidor local.
- Personaliza los controladores, modelos y vistas según tus necesidades.
- Si usas rutas amigables, configura el archivo `.htaccess` y `mod_rewrite`.

---

**Desarrollado por:**  
Tu Nombre
