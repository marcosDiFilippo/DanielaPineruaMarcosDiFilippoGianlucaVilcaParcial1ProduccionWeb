
<?php
session_start();
?>

<header>
  <div>
    <h1>Agencia Da-Vinci</h1>
  </div>

  <nav>
     <a href="../dashboard.php">Inicio</a>
    <a href="../vehiculos.php">Vehículos</a>

    <?php if (isset($_SESSION['usuario_id'])): ?>
        <a href="../dashboard.php">Inicio</a>

        <?php if ($_SESSION['rol'] === 'admin'): ?>
            <a href="../gestion_usuarios.php">Usuarios</a>
        <?php endif; ?>

        <a href="../../action/sesion/logout.php">Cerrar sesión</a>
    <?php else: ?>
        <a href="../login.php">Iniciar sesión</a>
    <?php endif; ?>

  </nav>
</header>