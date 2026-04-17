<?php
    require_once('../../src/clases/Vehiculo.php');
    require_once('../../exceptions/VehiculoException.php');

    class VehiculoServicio {
        private Vehiculo $vehiculo;

        public function __construct(Vehiculo $vehiculo)
        {
            $this->vehiculo = $vehiculo;
        }

        public function crearVehiculo () {

        }

        public function actualizarVehiculo () {

        }

        public function eliminarVehiculo () {

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

    $action = htmlspecialchars($_GET["action"]);

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
            
            break;
        case "eliminar":
            
            break;
        case "actualizar":
            
            break;
    }