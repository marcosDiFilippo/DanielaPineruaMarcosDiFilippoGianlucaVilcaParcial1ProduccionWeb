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