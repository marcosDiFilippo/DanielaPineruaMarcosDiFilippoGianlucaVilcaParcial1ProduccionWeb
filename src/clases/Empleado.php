<?php
require_once 'Usuario.php';

class Empleado extends Usuario {

    private $sector;

    public function __construct($id, $nombre, $email, $password, $rol, $sector) {
        parent::__construct($id, $nombre, $email, $password, $rol);
        $this->sector = $sector;
    }

    public function getSector() {
        return $this->sector;
    }

    public function setSector($sector) {
        $this->sector = $sector;
    }
}