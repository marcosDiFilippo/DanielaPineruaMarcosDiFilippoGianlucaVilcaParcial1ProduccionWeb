<?php
interface Gestionable {
    public function crear();
    public function actualizar($id);
    public function eliminar($id);
}