<?php

use PHPUnit\Framework\TestCase;

require_once('./controllers/TestControllers/TestLoginController.php');

class LoginControllerTest extends TestCase
{
    public function testLoginContrasenaIncorrecta()
    {
        $controller = new TestControllers();

        $resultado = $controller->procesarLogin('alena_kravtsova', 'password_incorrecta');

        $this->assertEquals("Contraseña incorrecta", $resultado);
    }

    public function testLoginExitoso()
    {
        $controller = new TestControllers();

        $resultado = $controller->procesarLogin('alena_kravtsova', '12345678');

        $this->assertIsArray($resultado);
        $this->assertEquals(true, $resultado['login']);
        $this->assertEquals('alena_kravtsova', $resultado['usuario']);
    }
}
?>