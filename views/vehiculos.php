<?php
    include_once('componentes/header.php');
    require_once('../action/CRUD_Vehiculos/VehiculoServicio.php');

    // datos
    $vehiculosDisponibles = VehiculoServicio::contarVehiculos();
    $vehiculos = VehiculoServicio::obtenerVehiculos();

    echo json_encode($vehiculos);
?>

<main>
    <section>
        <h2>Vehículos</h2>
        <p>Hay <?php echo $vehiculosDisponibles; ?> vehículos disponibles.</p>
            <?php foreach ($vehiculos as $v): ?>

                <a href="detalle_vehiculo.php?id=<?php echo (int)$v['id']; ?>" class="card">
                    <img src="../imagenes/<?php echo $v['imagen']; ?>" alt="vehiculo">
                    <h3><?php echo $v['marca'] . " " . $v['modelo']; ?></h3>
                    <p>Año: <?php echo $v['anio']; ?></p>
                    <p>Precio: $<?php echo $v['precio']; ?></p>
                </a>

            <?php endforeach; ?>

    </section>
</main>

<?php
include_once('componentes/footer.php');
?>