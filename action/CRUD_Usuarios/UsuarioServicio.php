<?php
    session_start();


    require_once('../../src/clases/BD.php');
    require_once('../../src/clases/Usuario.php');
    require_once('../../src/clases/Administrador.php');
    require_once('../../src/interfaces/Gestionable.php');
    require_once('../../exceptions/UsuarioException.php');

    class UsuarioServicio implements Gestionable {

        private Usuario $usuario;
        private Administrador $administrador;

        public function __construct(Usuario $usuario)
        {
            $this->usuario = $usuario;
            $this->administrador = new Administrador($_SESSION["usuario_id"], $_SESSION["nombre"], '', '', $_SESSION["rol"]);
        }
        public function crear()
        {
            $this->administrador->crear($this->usuario);
        }
        
        public function actualizar($id){
            self::validarIdUsuario($id);

            $this->administrador->actualizar($this->usuario);
        }

        public function eliminar($id)
        {
            self::validarIdUsuario($id);

            $this->administrador->eliminar($id);
        }

        private static function existeEmail($email, $id = null){
            $conexion = BD::getInstancia();

            if ($id) {
                // Para editar (excluir el mismo usuario)

                $sql = "SELECT id FROM usuarios WHERE email = :email AND id != :id";

                $stmt = $conexion->prepare($sql);

                $stmt->execute([
                    ':email' => $email,
                    ':id' => $id
                ]);
            } else {
                // Para crear
                $sql = "SELECT id FROM usuarios WHERE email = :email";

                $stmt = $conexion->prepare($sql);

                $stmt->execute([':email' => $email]);
            }
            return $stmt->fetch() ? true : false;
        }
        public static function validarDatosUsuario (array $datosUsuario) {
            
            if (empty($datosUsuario)) {
                throw new Exception('No se recibieron datos del usuario.');
            }

            $id = $datosUsuario["id"] ?? null;
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

            //validar password solo para creación
            if (isset($datosUsuario['password'])) {
                if ($password === '') {
                    throw new UsuarioException('La contraseña es obligatoria.');
                }
            }

            // Validar rol
            if ($rol === '') {
                throw new UsuarioException('El rol es obligatorio.');
            }
            if ($rol !== 'admin' && $rol !== 'empleado') {
                throw new UsuarioException('El rol debe ser admin o empleado.');
            }

            // Validar email duplicado
            if (self::existeEmail($email, $datosUsuario['id'] ?? null)) {
                throw new UsuarioException('El email ya está registrado.');
            }

            return new Usuario($id, $nombre, $email, $password, $rol);
        }

        public static function validarIdUsuario ($id) {
            if (empty($id) || !is_numeric($id) || (int)$id <= 0) {
                throw new UsuarioException('ID de usuario inválido.');
            }
        }
    }

    /* PROCESO */
    
    if (isset($_SESSION) && $_SESSION["rol"] != 'admin') {
        header('Location: ../../views/gestion_usuarios.php?error=Action no especificada');
        exit;
    }

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
            // eliminamos password
                unset($datosUsuario['password']);
                
                $datosUsuario['id'] = $_POST['id'];

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