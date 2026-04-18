<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>

    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/login.css">

</head>
<body>
  <header>
    <div>
      <h1>Agencia Da-Vinci</h1>
    </div>

    <nav>
      <a href="./inicio.php">Inicio</a>
      <a href="./vehiculos.php">Vehículos</a>

      <?php if (isset($_SESSION['usuario_id'])): ?>
          <a href="./dashboard.php">Panel</a>

          <?php if ($_SESSION['rol'] === 'admin'): ?>
              <a href="./gestion_usuarios.php">Usuarios</a>
          <?php endif; ?>

          <a href="../action/sesion/logout.php">Cerrar sesión</a>
      <?php else: ?>
          <a href="./login.php">Iniciar sesión</a>
      <?php endif; ?>

    </nav>
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
  </header>