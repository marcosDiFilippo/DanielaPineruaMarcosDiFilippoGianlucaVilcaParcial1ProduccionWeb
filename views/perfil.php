<?php 
    include_once('componentes/header.php');
    include_once('componentes/session.php');
    include_once('../src/clases/Empleado.php');
    include_once('../src/clases/BD.php');

    if ($_SESSION["rol"] != "empleado") {
        header('Location: dashboard.php');
        exit;
    }
    $conexion = BD::getInstancia();

    $sql = "SELECT id, nombre, email, rol FROM usuarios WHERE id = :id LIMIT 1";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":id" => $_SESSION["usuario_id"]
    ]);

    $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

    $empleado = new Empleado((int) $usuario["id"], $usuario["nombre"], $usuario["email"], '', $usuario["rol"]); 

    $vehiculosSubidos = $empleado->obtenerVehiculosSubidos();
?>

<link rel="stylesheet" href="assets/css/perfil.css">

<main>

    <div class="perfil-card">
        <div class="avatar">
            <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24"
                fill="none" stroke="#4F46E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
        </div>
        <div class="perfil-nombre"><?php echo $usuario['nombre']; ?></div>
        <div class="perfil-email"><?php echo $usuario['email']; ?></div>
        <span class="perfil-rol"><?php echo ucfirst($usuario['rol']); ?></span>
    </div>

    <div class="seccion-header">
        <h2>Vehículos publicados</h2>
        <span><?php echo count($vehiculosSubidos); ?> publicado<?php echo count($vehiculosSubidos) !== 1 ? 's' : ''; ?></span>
    </div>

    <?php if (empty($vehiculosSubidos)): ?>
        <div class="sin-vehiculos">
            <p>Todavía no publicaste ningún vehículo.</p>
        </div>
    <?php else: ?>
        <div class="vehiculos-grid">
            <?php foreach ($vehiculosSubidos as $v): ?>
                <a href="detalle_vehiculo.php?id=<?php echo (int)$v['id']; ?>" class="v-card">
                    <div class="v-img">
                        <img src="../imagenes/<?php echo $v['imagen']; ?>.webp"
                            alt="<?php echo $v['marca'] . ' ' . $v['modelo']; ?>">
                    </div>
                    <div class="v-body">
                        <span class="v-anio"><?php echo (int)$v['anio']; ?></span>
                        <h3><?php echo $v['marca'] . ' ' . $v['modelo']; ?></h3>
                        <p class="v-precio"><span>$ </span><?php echo number_format($v['precio'], 0, ',', '.'); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</main>

<?php
    include_once('componentes/footer.php');
?>