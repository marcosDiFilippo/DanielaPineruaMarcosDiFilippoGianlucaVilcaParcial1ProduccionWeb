<?php
include_once('componentes/header.php');
?>

<main>
    <section>
        <h1>Vehículos</h1>
        <?php
        require_once('../src/servicios/VehiculoServicio.php');
        // contador REAL desde la base de datos
        $vehiculosDisponibles = VehiculoServicio::contarVehiculos();
        ?>  

        <p>Hay <?php echo $vehiculosDisponibles; ?> vehículos disponibles.</p>

    </section>
</main>

<?php
include_once('componentes/footer.php');
?>