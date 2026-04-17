<?php
    session_start();

    if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
        echo "No tenés permisos";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once('componentes/header.php');
    ?>
    <main>
        <section>
            <h2>Crear usuario</h2>

<form method="POST" action="../action/CRUD_Usuarios/guardar_usuario.php">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Contraseña" required>

                <select name="rol">
                    <option value="empleado">Empleado</option>
                    <option value="admin">Administrador</option>
                </select>

                <button type="submit">Crear</button>
            </form>
        </section>
        <?php
            require_once 'BD.php';

            $conn = BD::getInstancia();
            $stmt = $conn->query("SELECT * FROM usuarios");
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <section>
            <h2>Lista de usuarios</h2>

            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>

                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?php echo $u['id']; ?></td>
                        <td><?php echo $u['nombre']; ?></td>
                        <td><?php echo $u['email']; ?></td>
                        <td><?php echo $u['rol']; ?></td>

                        <td>
                            <a href="../action/CRUD_Usuarios/editar_usuario.php?id=<?php echo $u['id']; ?>">Editar</a>
                            |

                            <?php if ($u['id'] != $_SESSION['usuario_id']): ?>
                                <a href="../action/CRUD_Usuarios/eliminar_usuario.php?id=<?php echo $u['id']; ?>"
                                    onclick="return confirm('¿Seguro que querés eliminar este usuario?');">
                                    Eliminar
                                </a>
                            <?php else: ?>
                                (Tu usuario)
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </main>
    <?php
        include_once('componentes/footer.php');
    ?>
</body>
</html>