<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login con Osito - SIRN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .bear-container {
      position: relative;
      width: 220px;
      height: 220px;
      margin: 0 auto;
    }

    svg {
      width: 100%;
      height: auto;
    }

    .hand {
      transition: transform 0.4s ease;
      transform-origin: center;
    }

    .cover-eyes .hand-left {
      transform: translate(30px, -30px) rotate(30deg);
    }

    .cover-eyes .hand-right {
      transform: translate(-30px, -30px) rotate(-30deg);
    }

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
    <div class="col-md-5 text-center">
      <!-- 🐻 Osito SVG -->
      <div class="bear-container" id="bear">
        <svg viewBox="0 0 200 200">
          <!-- Cabeza -->
          <circle cx="100" cy="100" r="60" fill="#a0522d" />

          <!-- Orejas -->
          <circle cx="50" cy="50" r="20" fill="#a0522d" />
          <circle cx="150" cy="50" r="20" fill="#a0522d" />

          <!-- Ojos -->
          <circle cx="80" cy="90" r="5" fill="black" />
          <circle cx="120" cy="90" r="5" fill="black" />

          <!-- Nariz -->
          <ellipse cx="100" cy="110" rx="5" ry="3" fill="black" />

          <!-- Manos -->
          <circle class="hand hand-left" cx="60" cy="140" r="15" fill="#8b4513" />
          <circle class="hand hand-right" cx="140" cy="140" r="15" fill="#8b4513" />
        </svg>
      </div>

      <!-- Formulario de login -->
      <div class="card shadow p-4 mt-4">
        <h4 class="mb-3">Inicio de Sesión</h4>
        <form method="POST" action="index.php?c=Usuario&a=login">
          <div class="mb-3 text-start">
            <label class="form-label">Correo</label>
            <input type="email" class="form-control" name="correo" required>
          </div>
          <div class="mb-3 text-start">
            <label class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
        </form>
        <a href="index.php?c=Usuario&a=registro" class="register-link text-primary">¿No tienes cuenta? Regístrate aquí</a>
      </div>
    </div>
  </div>
</div>

<script>
  const passwordInput = document.getElementById('password');
  const bear = document.getElementById('bear');

  passwordInput.addEventListener('focus', () => {
    bear.classList.add('cover-eyes');
  });

  passwordInput.addEventListener('blur', () => {
    bear.classList.remove('cover-eyes');
  });
</script>

</body>
</html>
