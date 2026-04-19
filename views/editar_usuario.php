<?php
include_once('componentes/header.php');
include_once('componentes/session.php');
require_once('../src/clases/BD.php');

// Validar admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
echo "<h1>Editar Usuario</h1>";

// Obtener ID
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID no recibido";
    exit;
}

// Buscar usuario
$conexion = BD::getInstancia();
$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $conexion->prepare($sql);
$stmt->execute([':id' => $id]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuario no encontrado";
    exit;
}
?>

<main>
<section>
    <h2>Editar usuario</h2>

    <form action="../action/CRUD_Usuarios/UsuarioServicio.php?action=actualizar" method="POST">
    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
    <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
    <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>
    <select name="rol">
        <option value="empleado" <?php echo ($usuario['rol'] == 'empleado') ? 'selected' : ''; ?>>Empleado</option>
        <option value="admin" <?php echo ($usuario['rol'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
    </select>

    <button type="submit">Actualizar usuario</button>
</form>
</section>
</main>

<?php include_once('componentes/footer.php'); ?>