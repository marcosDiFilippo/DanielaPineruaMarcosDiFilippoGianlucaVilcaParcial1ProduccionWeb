    <?php
        include_once('componentes/header.php');
        include_once('componentes/session.php');
    ?>
    <main>
        <section>
            <h2>Bienvenido <?php echo $_SESSION['nombre']; ?></h2>

            <h3>Ingresa los vehiculos que deseas agregar</h3>
            
    <form action="../action/CRUD_Vehiculos/VehiculoServicio.php?action=crear" method="POST" enctype="multipart/form-data">
    <input type="text" name="marca" placeholder="Marca" required>
    <input type="text" name="modelo" placeholder="Modelo" required>
    <input type="number" name="anio" placeholder="Año" required>
    <input type="number" name="precio" placeholder="Precio" required>
    <input type="text" name="tipo" placeholder="Tipo" required>
    <input type="text" name="color" placeholder="Color" required>
    <input type="text" name="transmision" placeholder="Transmisión" required>
    <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuario_id']; ?>">
    <input type="file" name="imagen" required>
    <button type="submit">Guardar vehículo</button>
</form>

<?php
    include_once('../action/CRUD_Vehiculos/VehiculoServicio.php');
    $vehiculos = VehiculoServicio::obtenerVehiculos();
?>

<table border="1">
    <tr>
        <th>Imagen</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Año</th>
        <th>Precio</th>
        <th>Tipo</th>
        <th>Color</th>
        <th>Transmisión</th>
        <th>Usuario</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($vehiculos as $v): ?>
    <tr>
        <td>
            <img src="../imagenes/<?php echo $v['imagen']; ?>" width="100">
        </td>
        <td><?php echo $v['marca']; ?></td>
        <td><?php echo $v['modelo']; ?></td>
        <td><?php echo $v['anio']; ?></td>
        <td><?php echo $v['precio']; ?></td>
        <td><?php echo $v['tipo']; ?></td>
        <td><?php echo $v['color']; ?></td>
        <td><?php echo $v['transmision']; ?></td>
        <td><?php echo $v['usuario_id'] ? $v['usuario_id'] : "Desconocido"; ?></td>
        <td>
            <!--EDITAR -->
            <a href="editar_vehiculo.php?id=<?php echo $v['id']; ?>">
                Editar
            </a>

            <!-- ELIMINAR -->
            <form action="../src/procesos/procesarVehiculo.php?action=eliminar" method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $v['id']; ?>">
                <button type="submit" onclick="return confirm('¿Seguro que querés eliminar?')">
                    Eliminar
                </button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
        </section>
    </main>
    <?php
        include_once('componentes/footer.php');
    ?>

