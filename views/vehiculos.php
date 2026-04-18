<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehiculos</title>
</head>
<body>
    <?php
        include_once('componentes/header.php');
    ?>
    <main>
        <section>
            <h1>Vehiculos</h1>
            <?php
require_once('../src/clases/Vehiculo.php'); 
$vehiculosDisponibles = Vehiculo::getContador();
?> 
<p>Hay <?php echo $vehiculosDisponibles; ?> vehículos disponibles.</p>

        </section>
    </main>
    <?php
        include_once('componentes/footer.php');
    ?>
</body>
</html>