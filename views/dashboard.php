    <?php
        include_once('componentes/header.php');
        include_once('componentes/session.php');
    ?>
    <main>
        <section>
            <h1>Bienvenido <?php echo $_SESSION['nombre']; ?></h1>

            <a href="vehiculos.php">Ver vehículos</a><br>

            <?php if ($_SESSION['rol'] === 'admin'): ?>
                <a href="gestion_usuarios.php">Gestionar usuarios</a><br>
            <?php endif; ?>

            <a href="../action/sesion/logout.php">Cerrar sesión</a>
        </section>
    </main>
    <?php
        include_once('componentes/footer.php');
    ?>

