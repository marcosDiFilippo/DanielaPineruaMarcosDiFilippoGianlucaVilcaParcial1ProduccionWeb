<?php
    include_once('componentes/header.php');
    require_once('../action/CRUD_Vehiculos/VehiculoServicio.php');

    // datos
    $vehiculosDisponibles = VehiculoServicio::contarVehiculos();
    $vehiculos = VehiculoServicio::obtenerVehiculos();

?>
<link rel="stylesheet" href="assets/css/vehiculos.css">

<main>
    <section>
 
        <div class="cat-header">
            <h2>Vehículos</h2>
            <span class="cat-count">Hay <?php echo (int)$vehiculosDisponibles; ?> disponibles</span>
        </div>
 
        <div class="cat-grid">
            <?php foreach ($vehiculos as $v): ?>
 
                <a href="detalle_vehiculo.php?id=<?php echo (int)$v['id']; ?>" class="card">
                    <div class="card-img">
                        <img src="../imagenes/<?php echo htmlspecialchars($v['imagen']); ?>.webp"
                             alt="<?php echo htmlspecialchars($v['marca'] . ' ' . $v['modelo']); ?>">
                    </div>
                    <div class="card-body">
                        <span class="anio"><?php echo (int)$v['anio']; ?></span>
                        <h3><?php echo htmlspecialchars($v['marca'] . ' ' . $v['modelo']); ?></h3>
                        <p class="precio"><span>$ </span><?php echo number_format($v['precio'], 0, ',', '.'); ?></p>
                    </div>
                </a>
 
            <?php endforeach; ?>
        </div>
 
    </section>
</main>
 
<?php include_once('componentes/footer.php'); ?>