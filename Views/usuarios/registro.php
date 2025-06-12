
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Usuario - SIRN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .register-link {
      font-size: 0.9em;
      display: block;
      margin-top: 1rem;
    }
  </style>
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow p-4">
        <h4 class="mb-3 text-center">Registro de Usuario</h4>
        <form method="POST" action="index.php?c=Usuario&a=guardarRegistro">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Correo</label>
            <input type="email" class="form-control" name="correo" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" name="confirmar_password" required>
          </div>
          <button type="submit" class="btn btn-success w-100">Registrarse</button>
        </form>
        <a href="index.php?c=Usuario&a=mostrarLogin" class="register-link text-primary">¿Ya tienes cuenta? Inicia sesión aquí</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>