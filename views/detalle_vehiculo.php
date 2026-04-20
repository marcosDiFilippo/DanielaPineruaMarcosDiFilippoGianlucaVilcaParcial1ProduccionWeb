<?php
    include_once('componentes/header.php');
    require_once('../action/CRUD_Vehiculos/VehiculoServicio.php');

    $id = (int)$_GET['id'];

    $conexion = BD::getInstancia();
    $sql = "SELECT * FROM vehiculos WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([':id' => $id]);
    $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$vehiculo) {
        header('Location: vehiculos.php');
        exit;
    }
?>
<link rel="stylesheet" href="assets/css/detalle_vehiculo.css">

<main>
    <div class="migas">
        <a href="inicio.php">Inicio</a>
        <span>›</span>
        <a href="vehiculos.php">Vehículos</a>
        <span>›</span>
        <span><?php echo $vehiculo['marca'] . ' ' . $vehiculo['modelo']; ?></span>
    </div>

    <div class="contenedor-detalle">

        <!-- Imagen -->
        <div class="galeria">
            <div class="imagen-wrap">
                <img src="../imagenes/<?php echo $vehiculo['imagen']; ?>.webp"
                    alt="<?php echo $vehiculo['marca'] . ' ' . $vehiculo['modelo']; ?>">
            </div>
        </div>

        <!-- Info -->
        <div class="info">
            <span class="anio"><?php echo (int)$vehiculo['anio']; ?></span>
            <h1 class="titulo"><?php echo $vehiculo['marca'] . ' ' . $vehiculo['modelo']; ?></h1>

            <div class="precio-wrap">
                <div class="precio-label">Precio</div>
                <div class="precio">
                    <sup>$ </sup><?php echo number_format($vehiculo['precio'], 0, ',', '.'); ?>
                </div>
            </div>

            <div class="separador"></div>

            <div class="especificaciones">
                <div class="spec">
                    <div class="spec-label">Tipo</div>
                    <div class="spec-valor"><?php echo $vehiculo['tipo']; ?></div>
                </div>
                <div class="spec">
                    <div class="spec-label">Color</div>
                    <div class="spec-valor"><?php echo $vehiculo['color']; ?></div>
                </div>
                <div class="spec">
                    <div class="spec-label">Transmisión</div>
                    <div class="spec-valor"><?php echo $vehiculo['transmision']; ?></div>
                </div>
                <div class="spec">
                    <div class="spec-label">Año</div>
                    <div class="spec-valor"><?php echo (int)$vehiculo['anio']; ?></div>
                </div>
            </div>

            <a href="vehiculos.php" class="btn-volver">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12h6m3 0h1.5m3 0h.5" />
                    <path d="M5 12l4 4" />
                    <path d="M5 12l4 -4" />
                </svg>
                <span>Volver al listado</span>
            </a>
        </div>

    </div>
</main>

<?php 
    include_once('componentes/footer.php'); 
?>