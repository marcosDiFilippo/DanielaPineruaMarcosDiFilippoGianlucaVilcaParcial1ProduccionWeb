<?php
include_once('componentes/header.php');
include_once('componentes/session.php');
require_once('../src/clases/BD.php');

$id = $_GET['id'];


$conexion = BD::getInstancia();
$sql = "SELECT * FROM vehiculos WHERE id = :id";
$stmt = $conexion->prepare($sql);
$stmt->execute([':id' => $id]);

$vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="assets/css/editar_vehiculo.css">
<main>
<section>
    <h2>Editar vehículo</h2>

    <form action="../action/CRUD_Vehiculos/VehiculoServicio.php?action=actualizar" method="POST" enctype="multipart/form-data">
        <!-- ID oculto -->
        <input type="hidden" name="id" value="<?php echo $vehiculo['id']; ?>">
        <!-- IMAGEN ACTUAL -->
        <p>Imagen actual:</p>
        <img src="../imagenes/<?php echo $vehiculo['imagen'] . ".webp"; ?>" width="300">
        <!-- GUARDAR IMAGEN ACTUAL -->
        <input type="hidden" name="imagen_actual" value="<?php echo $vehiculo['imagen']; ?>">
        <br><br>
        <!-- NUEVA IMAGEN (OPCIONAL) -->
        <input type="file" name="imagen">
        <br><br>
        <input type="text" name="marca" value="<?php echo $vehiculo['marca']; ?>" required>
        <input type="text" name="modelo" value="<?php echo $vehiculo['modelo']; ?>" required>
        <input type="number" name="anio" value="<?php echo $vehiculo['anio']; ?>" required>
        <input type="number" name="precio" value="<?php echo $vehiculo['precio']; ?>" required>
        <input type="text" name="tipo" value="<?php echo $vehiculo['tipo']; ?>" required>
        <input type="text" name="color" value="<?php echo $vehiculo['color']; ?>" required>
        <input type="text" name="transmision" value="<?php echo $vehiculo['transmision']; ?>" required>
        <!-- usuario oculto -->
        <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuario_id']; ?>">
        <div class="form-acciones">
        <a href="dashboard.php" class="btn-cancelar">Cancelar</a>
        <button type="submit">Actualizar Vehiculo</button>
    </div>
    </form>
</section>
</main>

<?php include_once('componentes/footer.php'); ?>