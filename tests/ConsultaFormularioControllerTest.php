<?php

use PHPUnit\Framework\TestCase;

require_once('./controllers/TestControllers/TestConsultaController.php');

class ConsultaFormularioControllerTest extends TestCase
{
    public function testCrearConsulta()
    {
        $controller = new TestControllers();
        $resultado = $controller->procesarCrearConsulta('Juan Pérez', 'juan@example.com', '693285201', 'Consulta de prueba');

        $this->assertStringContainsString('Tu consulta ha sido enviada con éxito', $resultado);
    }
}
?>