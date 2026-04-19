    <?php
        include_once('componentes/header.php');
        include_once('componentes/session.php');
    ?>
    <?php
    // Verificar que sea admin
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../index.php'); 
    exit;
    }
?>
    <link rel="stylesheet" href="assets/css/gestion_usuarios.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <main>
        <?php if (isset($_GET['ok'])): ?>
        <p class="exito">Operación realizada con éxito</p>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
    <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
<?php endif; ?>
        <section>
            <h2>Crear usuario</h2>

            <form method="POST" action="../action/CRUD_Usuarios/UsuarioServicio.php?action=crear">
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
            require_once '../src/clases/BD.php';

            $conn = BD::getInstancia();
            $stmt = $conn->query("SELECT * FROM usuarios");
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <section>
            <h2>Lista de usuarios</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Contraseña</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?php echo $u['id']; ?></td>
                        <td><?php echo $u['nombre']; ?></td>
                        <td><?php echo $u['email']; ?></td>
                        <td><?php echo $u['rol']; ?></td>
                        <td><?php echo $u['password']; ?></td>

                        <td>
                            <a href="editar_usuario.php?id=<?php echo $u['id']; ?>">Editar</a>
                            |

                            <?php if ($u['id'] != $_SESSION['usuario_id']): ?>
                                <form action="../action/CRUD_Usuarios/UsuarioServicio.php?action=eliminar"
                                    onsubmit="return confirm('¿Seguro que querés eliminar este usuario?');" method="post">
                                    <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                                    <input type="hidden" name="action" value="eliminar">
                                    <input type="submit" value="Eliminar">
                                </form>
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