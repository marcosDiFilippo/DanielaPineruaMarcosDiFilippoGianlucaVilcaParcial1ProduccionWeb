<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php
        include_once('componentes/header.php');
    ?>
    <main>
        <section>

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
</body>
</html>