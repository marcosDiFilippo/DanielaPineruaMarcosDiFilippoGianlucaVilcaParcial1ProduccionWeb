    <?php
        include_once('componentes/header.php');    
    ?>
    <main>
        <section>
            
            <?php if (isset($_GET['error'])): ?>
                <p>Email o contraseña incorrectos</p>
            <?php endif; ?>

            <h1>Iniciar Sesion</h1>

            <form method="POST" action="../action/sesion/procesar_login.php">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Ingresar</button>
            </form>
        </section>
    </main>
    <?php
        include_once('componentes/footer.php');
    ?>