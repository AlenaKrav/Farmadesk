<?php

use PHPUnit\Framework\TestCase;

require_once('./models/Servicio.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class ServicioModeloTest extends TestCase
{

    public function testDesactivarServicio()
    {
        $idServicio = 17;
        Servicio::desactivar($idServicio);
        $servicio = Servicio::buscar($idServicio);
        $this->assertEquals(0, $servicio->activo);
    }


    public function testActivarServicio()
    {
        $idServicio = 3;
        Servicio::activar($idServicio);
        $servicio = Servicio::buscar($idServicio);
        $this->assertEquals(1, $servicio->activo);
    }
}
?>