<?php
    require_once('../../src/clases/BD.php');
    require_once('../../src/clases/Usuario.php');
    require_once('../../src/interfaces/Gestionable.php');
    require_once('../../exceptions/UsuarioException.php');

    class UsuarioServicio implements Gestionable {

        private Usuario $usuario;

        public function __construct(Usuario $usuario)
        {
            $this->usuario = $usuario;
        }
        public function crear()
        {
            $conexion = BD::getInstancia();
            $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                ':nombre' => $this->usuario->getNombre(),
                ':email' => $this->usuario->getEmail(),
                ':password' => md5($this->usuario->getPassword()),
                ':rol' => $this->usuario->getRol()
            ]);
        }

        public function actualizar($id)
        {
            self::validarIdUsuario($id);

            $conexion = BD::getInstancia();
            $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, password = :password, rol = :rol WHERE id = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                ':nombre' => $this->usuario->getNombre(),
                ':email' => $this->usuario->getEmail(),
                ':password' => md5($this->usuario->getPassword()),
                ':rol' => $this->usuario->getRol(),
                ':id' => (int)$id
            ]);
        }

        public function eliminar($id)
        {
            self::validarIdUsuario($id);

            $conexion = BD::getInstancia();
            $sql = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([':id' => (int)$id]);
        }

        public static function validarDatosUsuario (array $datosUsuario) {
            
            if (empty($datosUsuario)) {
                throw new Exception('No se recibieron datos del usuario.');
            }

            $nombre = trim($datosUsuario['nombre'] ?? '');
            $email = trim($datosUsuario['email'] ?? '');
            $password = trim($datosUsuario['password'] ?? '');
            $rol = trim($datosUsuario['rol'] ?? '');

            // Validar nombre
            if ($nombre === '') {
                throw new UsuarioException('El nombre es obligatorio.');
            }

            // Validar email
            if ($email === '') {
                throw new UsuarioException('El email es obligatorio.');
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new UsuarioException('El email no es válido.');
            }

            // Validar password
            if ($password === '') {
                throw new UsuarioException('La contraseña es obligatoria.');
            }

            // Validar rol
            if ($rol === '') {
                throw new UsuarioException('El rol es obligatorio.');
            }
            if ($rol !== 'admin' && $rol !== 'empleado') {
                throw new UsuarioException('El rol debe ser admin o empleado.');
            }

            return new Usuario(null, $nombre, $email, $password, $rol);
        }

        public static function validarIdUsuario ($id) {
            if (empty($id) || !is_numeric($id) || (int)$id <= 0) {
                throw new UsuarioException('ID de usuario inválido.');
            }
        }
    }

    /* ================== PROCESO ================== */
    $action = $_GET["action"] ?? '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($action)) {
            header('Location: ../../views/gestion_usuarios.php?error=Action no especificada');
            exit;
        }

        try {
            $datosUsuario = $_POST ?? null;

            if ($datosUsuario == null) {
                throw new Exception("No se han recibido datos del usuario");
            }

            // Validar datos del usuario

            // Ejecutar acción según action
            if ($action == "crear") {

                $usuarioValidado = UsuarioServicio::validarDatosUsuario($datosUsuario);
                $usuarioServicio = new UsuarioServicio($usuarioValidado);

                $usuarioServicio->crear();
            }
            elseif ($action == "actualizar") {

                $usuarioValidado = UsuarioServicio::validarDatosUsuario($datosUsuario);
                $usuarioServicio = new UsuarioServicio($usuarioValidado);

                $usuarioServicio->actualizar($_POST['id']);

            }
            elseif ($action == "eliminar") {

                UsuarioServicio::validarIdUsuario($_POST['id']);
                $usuarioServicio = new UsuarioServicio(new Usuario(null, '', '', '', ''));
                $usuarioServicio->eliminar($_POST['id']);

            }
            else {
                throw new Exception("Acción no permitida: $action");
            }

            header('Location: ../../views/gestion_usuarios.php?ok=1');
            exit;

        } catch (Exception $e) {
            header('Location: ../../views/gestion_usuarios.php?error=' . urlencode($e->getMessage()));
            exit;
        }
    }