<?php include_once('componentes/header.php'); ?>
<link rel="stylesheet" href="assets/css/inicio.css">
<main>
    <section>
        <div class="hero-eyebrow">Agencia Da-Vinci</div>

        <h2>La mejor agencia<br>de <span>vehículos</span></h2>

        <p>Explorá nuestra amplia gama de vehículos y encontrá el que mejor se adapte a tus necesidades y presupuesto. El más confiable del mercado, con los mejores precios y calidad.</p>

        <div class="hero-btns">
            <a href="vehiculos.php" class="btn-primary">Ver vehículos</a>
            <?php if (!isset($_SESSION["usuario_id"])): ?>
            <a href="login.php" class="btn-secondary">Iniciar sesión</a>
            <?php endif ?>
        </div>

        <div class="hero-stats">
            <div class="stat-item">
                <span class="stat-number">+50</span>
                <span class="stat-label">Vehículos disponibles</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">+200</span>
                <span class="stat-label">Clientes satisfechos</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">5★</span>
                <span class="stat-label">Calificación promedio</span>
            </div>
        </div>
    </section>
</main>
<?php include_once('componentes/footer.php'); ?>