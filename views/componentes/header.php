<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
  <div class="nav-overlay"></div>
  <header>
    <div>
      <a href="./inicio.php">
        <h1>Agencia Da-Vinci</h1>
      </a>
    </div>

    <button class="nav-toggle">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <nav>
      <a href="./inicio.php">Inicio</a>
      <a href="./vehiculos.php">Vehículos</a>

      <?php if (isset($_SESSION['usuario_id'])): ?>
          <a href="./dashboard.php">Panel</a>

          <?php if ($_SESSION['rol'] === 'admin'): ?>
              <a href="./gestion_usuarios.php">Usuarios</a>
          <?php else: ?>
              <a href="./perfil.php">Ver Perfil</a>
          <?php endif; ?>

          <a href="../action/sesion/logout.php">Cerrar sesión</a>
      <?php else: ?>
          <a href="./login.php">Iniciar sesión</a>
      <?php endif; ?>
    </nav>
  </header>

<script>
    const toggle = document.querySelector('.nav-toggle');
    const nav = document.querySelector('header nav');
    const overlay = document.querySelector('.nav-overlay');

    function abrirMenu() {
        nav.classList.add('open');
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function cerrarMenu() {
        nav.classList.remove('open');
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    toggle.addEventListener('click', () => {
        nav.classList.contains('open') ? cerrarMenu() : abrirMenu();
    });

    overlay.addEventListener('click', cerrarMenu);

    nav.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', cerrarMenu);
    });
</script>