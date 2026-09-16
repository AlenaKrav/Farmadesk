<?php

use PHPUnit\Framework\TestCase;

require_once('./controllers/TestControllers/TestPacienteController.php');


class PacienteControllerTest extends TestCase
{
    public function testCrearPacienteConDatosValidos()
    {
        $controller = new TestControllers();
        $datos = [
            'nombre' => 'Laura',
            'apellidos' => 'Martínez',
            'dni' => '65023204V',
            'fecha_nacimiento' => '1990-05-10',
            'correo' => 'laura@example.com',
            'telefono' => '654123789',
            'direccion' => 'Calle Falsa 123',
            'cip_aut' => 'AN000000000012'
        ];

        $resultado = $controller->procesarCrearPaciente($datos);
        // fwrite(STDERR, print_r($resultado, true));

        $this->assertTrue($resultado['ok']);
        $this->assertIsArray($resultado['paciente']);
    }


    public function testObtenerPacientes()
    {
        $controller = new TestControllers();

        $resultado = $controller->procesarObtenerPacientes();

        $this->assertTrue($resultado['ok']);
        $this->assertIsArray($resultado['pacientes']);
        $this->assertNotEmpty($resultado['pacientes']);
    }

    public function testEditarPaciente()
    {
        $controller = new TestControllers();

        $datos = [
            'id_paciente' => 61,
            'nombre' => 'Carolin',
            'apellidos' => 'Fernandez',
            'dni' => '65023204Z',
            'fecha_nacimiento' => '1995-05-10',
            'correo' => 'carol.fernandez@example.com',
            'telefono' => '600112233',
            'direccion' => 'Av. Sevilla 45',
            'cip_aut' => 'AN109802374821'
        ];

        $resultado = $controller->procesarEditarPaciente($datos);
        // fwrite(STDERR, print_r($resultado, true));
        $this->assertTrue($resultado['ok']);
    }

    public function testBuscarPaciente()
    { {
            $controller = new TestControllers();
            $idPaciente = 44;

            $resultado = $controller->procesarBuscarPaciente($idPaciente);
            fwrite(STDERR, print_r($resultado, true));

            $this->assertTrue($resultado['ok']);
        }
    }

    public function testBorrarPaciente()
    {
        $controller = new TestControllers();
        $idPaciente = 61;
        $resultado = $controller->procesarBorrarPaciente($idPaciente);
        fwrite(STDERR, print_r($resultado, true));
        $this->assertTrue($resultado['ok']);
    }


    public function testSugerenciasPaciente()
    {
        $controller = new TestControllers();

        $term = 'Amalia';
        $resultado = $controller->procesarSugerenciasPaciente($term);

        fwrite(STDERR, print_r($resultado, true));

        $this->assertIsArray($resultado);
        $this->assertNotEmpty($resultado);
    }
}
?>