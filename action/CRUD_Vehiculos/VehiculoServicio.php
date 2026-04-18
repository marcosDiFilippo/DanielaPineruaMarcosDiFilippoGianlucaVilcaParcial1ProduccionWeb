<?php
    require_once('../../src/clases/Vehiculo.php');
    require_once('../../exceptions/VehiculoException.php');
    require_once('../../src/interfaces/Gestionable.php');

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
                ':id' => $id]);
                 }

        public function eliminar ($id) {
                $conexion = BD::getInstancia();
                $sql = "DELETE FROM vehiculos WHERE id = :id";
                $stmt = $conexion->prepare($sql);
                $stmt->execute([':id' => $id]);

        }

        /**
         * @throws VehiculoException
         */
        public static function validarDatosVehiculo (array $datosVehiculo) : Vehiculo {
            if (empty($datosVehiculo)) {
                throw new VehiculoException('No se recibieron datos del vehículo.');
            }

            // el operador ?? hace que si por ejemplo $datosVehiculo['marca'] es null entonces le asigna valor por default ''

            $marca = trim($datosVehiculo['marca'] ?? '');
            $modelo = trim($datosVehiculo['modelo'] ?? '');
            $anio = trim($datosVehiculo['anio'] ?? '');
            $precio = trim($datosVehiculo['precio'] ?? '');
            $tipo = trim($datosVehiculo['tipo'] ?? '');
            $color = trim($datosVehiculo['color'] ?? '');
            $imagen = trim($datosVehiculo['imagen'] ?? '');
            $usuario_id = trim($datosVehiculo['usuario_id'] ?? '');
            $transmision = trim($datosVehiculo['transmision'] ?? '');

            if ($marca === '') {
                throw new VehiculoException('La marca es obligatoria.');
            }

            if ($modelo === '') {
                throw new VehiculoException('El modelo es obligatorio.');
            }

            if ($anio === '' || !ctype_digit($anio) || (int)$anio < 1886 || (int)$anio > (int)date('Y') + 1) {
                throw new VehiculoException('El año del vehículo no es válido.');
            }

            if ($precio === '' || !is_numeric($precio) || (float) $precio <= 0) {
                throw new VehiculoException('El precio debe ser un número mayor que cero.');
            }

            if ($tipo === '') {
                throw new VehiculoException('El tipo de vehículo es obligatorio.');
            }

            if ($color === '') {
                throw new VehiculoException('El color es obligatorio.');
            }

            if ($imagen === '') {
                throw new VehiculoException('La imagen del vehículo es obligatoria.');
            }

            if ($usuario_id === '' || (int) $usuario_id <= 0) {
                throw new VehiculoException('El usuario asociado no es válido.');
            }

            if ($transmision === '') {
                throw new VehiculoException('La transmisión es obligatoria.');
            }

            return new Vehiculo(
                $marca,
                $modelo,
                (int) $anio,
                (float) $precio,
                $tipo,
                $color,
                $imagen,
                (int) $usuario_id,
                $transmision
            );
        }
    }

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        exit;
    }   

    //action puede ser crear, eliminar o actualizar, se va enviar cuando se envie el formulario

    //podemos enviar la accion que va hacer por un input hidden en el formulario o simplemente por la url, despues lo vemos eso
    
    if (!isset($_GET["action"])) {
        exit;
    }

    $action = $_GET["action"] ?? '';

    $vehiculoServicio = null;

    try {
        $vehiculoValidado = VehiculoServicio::validarDatosVehiculo($_POST);

        $vehiculoServicio = new VehiculoServicio($vehiculoValidado);
    }
    catch (Exception $e) {
        header('Location: ../../views/vehiculos.php?error=' . $e->getMessage());
        exit;
    }

    //en cada case luego llamamos al vehiculoServicio->el metodo para (crear, eliminar o actualizar)
    switch ($action) {
    case "crear":
        $vehiculoServicio->crear();
        break;

    case "actualizar":
        $vehiculoServicio->actualizar($_POST['id']);
        break;

    case "eliminar":
        $vehiculoServicio->eliminar($_POST['id']);
        break;
}

    header('Location: ../../views/vehiculos.php?ok=1');
    exit;