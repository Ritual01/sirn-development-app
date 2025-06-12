<?php
// registro.php
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $conn = new mysqli(
        "shinkansen.proxy.rlwy.net",
        "root",
        "MfRHWkDxulehDoyCOLXqGjrFvsFxtecQ",
        "railway",
        58011
    );
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $password_hash);
    if ($stmt->execute()) {
        $mensaje = "Registro exitoso. Ahora puedes iniciar sesión.";
    } else {
        if ($conn->errno == 1062) {
            $mensaje = "El correo ya está registrado.";
        } else {
            $mensaje = "Error al registrar: " . $conn->error;
        }
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <style>
        body { background: #eaf6f6; font-family: Arial, sans-serif; }
        .registro-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(123, 74, 33, 0.10);
            max-width: 370px;
            margin: 60px auto;
            padding: 32px 32px 24px 32px;
            border: 1px solid #c2b09b;
        }
        h2 { color: #7b4a21; text-align: center; margin-bottom: 24px; }
        label { color: #5c3a1a; font-weight: bold; }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%; padding: 9px; margin: 7px 0 18px 0;
            border: 1px solid #b2dfdb; border-radius: 4px; background: #fdfaf7; font-size: 15px;
        }
        input[type="submit"] {
            background-color: #7b4a21; color: #eaf6f6; border: none;
            padding: 12px 0; width: 100%; border-radius: 4px; font-size: 17px;
            cursor: pointer; transition: background 0.2s; font-weight: bold; letter-spacing: 1px;
        }
        input[type="submit"]:hover { background-color: #009688; color: #fff; }
        .mensaje { text-align: center; color: #d32f2f; margin-bottom: 12px; }
    </style>
</head>
<body>
    <div class="registro-container">
        <h2>Registro de Usuario</h2>
        <?php if ($mensaje) echo "<div class='mensaje'>$mensaje</div>"; ?>
        <form method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required><br>
            <label for="correo">Correo:</label>
            <input type="email" name="correo" id="correo" required><br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required><br>
            <input type="submit" value="Registrarse">
        </form>
    </div>
</body>
</html>
