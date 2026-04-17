<?php
    session_start();

    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>

    <link rel="stylesheet" href="assets/css/styles.css">

</head>
<body>
    <?php
        include_once('componentes/header.php');
    ?>
    <main>
        <section>
            <h1>Bienvenido <?php echo $_SESSION['nombre']; ?></h1>

            <a href="vehiculos.php">Ver vehículos</a><br>

            <?php if ($_SESSION['rol'] === 'admin'): ?>
                <a href="gestion_usuarios.php">Gestionar usuarios</a><br>
            <?php endif; ?>

            <a href="../action/sesion/cerrar_sesion.php">Cerrar sesión</a>
        </section>
    </main>
    <?php
        include_once('componentes/footer.php');
    ?>
</body>
</html>
