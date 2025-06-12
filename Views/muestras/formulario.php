<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Muestra</title>
    <style>
        body {
            background-color: #eaf6f6; /* celeste agua suave */
            font-family: Arial, sans-serif;
        }
        .form-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(123, 74, 33, 0.10);
            max-width: 420px;
            margin: 50px auto;
            padding: 32px 32px 24px 32px;
            border: 1px solid #c2b09b;
        }
        h2 {
            color: #7b4a21; /* marrón */
            text-align: center;
            margin-bottom: 24px;
        }
        label {
            color: #5c3a1a;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 9px;
            margin: 7px 0 18px 0;
            border: 1px solid #b2dfdb; /* celeste agua */
            border-radius: 4px;
            background: #fdfaf7;
            font-size: 15px;
        }
        input[type="submit"] {
            background-color: #7b4a21; /* marrón */
            color: #eaf6f6; /* celeste agua */
            border: none;
            padding: 12px 0;
            width: 100%;
            border-radius: 4px;
            font-size: 17px;
            cursor: pointer;
            transition: background 0.2s;
            font-weight: bold;
            letter-spacing: 1px;
        }
        input[type="submit"]:hover {
            background-color: #009688; /* celeste agua fuerte */
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registrar Muestra</h2>
        <form action="index.php?c=Muestra&a=guardar" method="POST">
            <label for="lugar">Lugar:</label>
            <input type="text" name="lugar" id="lugar" required><br>
            
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" required><br>
            
            <label for="ph">pH:</label>
            <input type="number" name="ph" id="ph" step="0.01" min="0" max="14" required><br>
            
            <label for="turbidez">Turbidez (NTU):</label>
            <input type="number" name="turbidez" id="turbidez" step="0.01" required><br>
            
            <label for="temperatura">Temperatura (°C):</label>
            <input type="number" name="temperatura" id="temperatura" step="0.01" required><br>
            
            <label for="nivel_cloro">Nivel de Cloro (mg/L):</label>
            <input type="number" name="nivel_cloro" id="nivel_cloro" step="0.01" required><br>
            
            <input type="submit" value="Analizar Muestra">
        </form>
    </div>
</body>
</html>