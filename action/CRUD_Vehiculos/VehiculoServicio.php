<?php
    if (str_contains($_SERVER['PHP_SELF'], 'VehiculoServicio.php')) {
        $paths = [
            "Vehiculo" => '../../src/clases/Vehiculo.php',
            "VehiculoException" => '../../exceptions/VehiculoException.php',
            "Gestionable" => '../../src/interfaces/Gestionable.php',
            "BD" => '../../src/clases/BD.php'
        ];
    }
    require_once($paths["Vehiculo"] ?? '../src/clases/Vehiculo.php');
    require_once($paths["VehiculoException"] ?? '../exceptions/VehiculoException.php');
    require_once($paths["Gestionable"] ?? '../src/interfaces/Gestionable.php');
    require_once($paths["BD"] ?? '../src/clases/BD.php');

    class VehiculoServicio implements Gestionable {
    private Vehiculo $vehiculo;

    public function __construct(Vehiculo $vehiculo)
    {
        $this->vehiculo = $vehiculo;
    }
    
    public function crear () {
        $conexion = BD::getInstancia();

        $sql = "INSERT INTO vehiculos 
        (marca, modelo, anio, precio, tipo, color, imagen, usuario_id, transmision) 
        VALUES (:marca, :modelo, :anio, :precio, :tipo, :color, :imagen, :usuario_id, :transmision)";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':marca' => $this->vehiculo->getMarca(),
            ':modelo' => $this->vehiculo->getModelo(),
            ':anio' => $this->vehiculo->getAnio(),
            ':precio' => $this->vehiculo->getPrecio(),
            ':tipo' => $this->vehiculo->getTipo(),
            ':color' => $this->vehiculo->getColor(),
            ':imagen' => $this->vehiculo->getImagen(),
            ':usuario_id' => $this->vehiculo->getUsuarioId(),
            ':transmision' => $this->vehiculo->getTransmision()
        ]);
    }

    public function actualizar ($id) {
        $conexion = BD::getInstancia();

        $sql = "UPDATE vehiculos SET 
        marca = :marca,
        modelo = :modelo,
        anio = :anio,
        precio = :precio,
        tipo = :tipo,
        color = :color,
        imagen = :imagen,
        transmision = :transmision
        WHERE id = :id";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':marca' => $this->vehiculo->getMarca(),
            ':modelo' => $this->vehiculo->getModelo(),
            ':anio' => $this->vehiculo->getAnio(),
            ':precio' => $this->vehiculo->getPrecio(),
            ':tipo' => $this->vehiculo->getTipo(),
            ':color' => $this->vehiculo->getColor(),
            ':imagen' => $this->vehiculo->getImagen(),
            ':transmision' => $this->vehiculo->getTransmision(),
            ':id' => $id
        ]);
    }

    public function eliminar ($id) {
        $conexion = BD::getInstancia();
        $sql = "DELETE FROM vehiculos WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    public static function contarVehiculos() {
        $conexion = BD::getInstancia();
        $sql = "SELECT COUNT(*) as total FROM vehiculos";
        $stmt = $conexion->query($sql);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'];
    }

    public static function obtenerVehiculos() {
        $conexion = BD::getInstancia();

        $stmt = $conexion->prepare("SELECT * FROM vehiculos");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function validarDatosVehiculo (array $datosVehiculo) : Vehiculo {
        if (empty($datosVehiculo)) {
            throw new VehiculoException('No se recibieron datos del vehículo.');
        }

        echo json_encode($datosVehiculo);
        echo json_encode('llego aca la img => ' . $datosVehiculo["imagen"]);

        $marca = trim($datosVehiculo['marca'] ?? '');
        $modelo = trim($datosVehiculo['modelo'] ?? '');
        $anio = trim($datosVehiculo['anio'] ?? '');
        $precio = trim($datosVehiculo['precio'] ?? '');
        $tipo = trim($datosVehiculo['tipo'] ?? '');
        $color = trim($datosVehiculo['color'] ?? '');
        $imagen = $datosVehiculo['imagen'] ?? '';
        $usuario_id = trim($datosVehiculo['usuario_id'] ?? '');
        $transmision = trim($datosVehiculo['transmision'] ?? '');

        if ($marca === '') throw new VehiculoException('La marca es obligatoria.');
        if ($modelo === '') throw new VehiculoException('El modelo es obligatorio.');
        if ($anio === '' || !ctype_digit($anio)) throw new VehiculoException('Año inválido.');
        if ($precio === '' || !is_numeric($precio)) throw new VehiculoException('Precio inválido.');
        if ($tipo === '') throw new VehiculoException('Tipo obligatorio.');
        if ($color === '') throw new VehiculoException('Color obligatorio.');
        if ($imagen === '') throw new VehiculoException('Imagen obligatoria.');
        if ($usuario_id === '' || (int)$usuario_id <= 0) throw new VehiculoException('Usuario inválido.');
        if ($transmision === '') throw new VehiculoException('Transmisión obligatoria.');

        return new Vehiculo(
            $marca,
            $modelo,
            (int)$anio,
            (float)$precio,
            $tipo,
            $color,
            $imagen,
            (int)$usuario_id,
            $transmision
        );
    }
}

/* ================== PROCESO ================== */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_GET["action"] ?? '';

    try {
        $datosVehiculo = $_POST;

        // ===== SUBIR IMAGEN =====
        $nombreImagen = $_FILES['imagen']['name'] ?? '';
        $tmp = $_FILES['imagen']['tmp_name'] ?? '';
        // SI SUBE NUEVA IMAGEN
        if ($nombreImagen && $tmp) {

            $nombreFinal = time();
            
            move_uploaded_file($tmp, "../../imagenes/" . $nombreFinal . ".webp");
            
            $datosVehiculo["imagen"] = $nombreFinal;
            // borrar imagen vieja
            if (!empty($_POST['imagen_actual'])) {
                $ruta = "../../imagenes/" . $_POST['imagen_actual'];
                if (file_exists($ruta)) {
                    unlink($ruta);
                }
            }
        } else {
            // SI NO SUBE NUEVA IMAGEN, MANTENER LA ACTUAL
            $_POST['imagen'] = $_POST['imagen_actual'] ?? '';
        }
        $vehiculoValidado = VehiculoServicio::validarDatosVehiculo($datosVehiculo);
        $vehiculoServicio = new VehiculoServicio($vehiculoValidado);
    } catch (Exception $e) {
        header('Location: ../../views/vehiculos.php?error=' . $e->getMessage());
        exit;

    }

    switch ($action) {

        case "crear":
            $vehiculoServicio->crear();
            break;

        case "actualizar":
            $vehiculoServicio->actualizar($_POST['id']);
            break;

        case "eliminar":

        // buscar imagen
        $conexion = BD::getInstancia();
        $stmt = $conexion->prepare("SELECT imagen FROM vehiculos WHERE id = :id");
        $stmt->execute([':id' => $_POST['id']]);
        $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);
        // borrar archivo
        if ($vehiculo && file_exists("../../imagenes/" . $vehiculo['imagen'])) {
            unlink("../../imagenes/" . $vehiculo['imagen']);
        }
        
        $vehiculoServicio->eliminar($_POST['id']);
        break;
    }

    header('Location: ../../views/vehiculos.php?ok=1');
    exit;
}