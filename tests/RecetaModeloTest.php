<?php

use PHPUnit\Framework\TestCase;

require_once('./models/Receta.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class RecetaModeloTest extends TestCase
{

    public function testCrearReceta()
    {
        $paciente_id = 44;
        $imagen = "test.jpg";
        $nombre = "Paracetamol Prueba";
        $fecha = "2025-01-01";
        $codigo_nacional = "CN123456";
        $observaciones = "Tomar cada 8 horas";

        $resultado = Receta::crear($paciente_id, $imagen, $nombre, $fecha, $codigo_nacional, $observaciones);

        $recetas = Receta::consultar();

        $receta_encontrada = false;
        foreach ($recetas as $receta) {
            if ($receta->nombre === $nombre && $receta->paciente_id == $paciente_id) {
                $receta_encontrada = true;
                break;
            }
        }

        $this->assertTrue($receta_encontrada, "La receta no fue creada correctamente.");
    }

    public function testBuscarReceta()
    {
        $id = 42;

        $receta = Receta::buscar($id);

        $this->assertInstanceOf(Receta::class, $receta);
        $this->assertEquals($id, $receta->id_receta);
    }

    public function testConsultarRecetas()
    {
        $recetas = Receta::consultar();

        $this->assertIsArray($recetas);
        $this->assertNotEmpty($recetas);
    }

    public function testEditarReceta()
    {
        $id = 87;
        $paciente_id = 44;
        $imagen = "editada.jpg";
        $nombre = "Ibuprofeno 600mg TEVA Prueba";
        $fecha = "2024-02-01";
        $estado = "En proceso";
        $codigo_nacional = "CN654321";
        $observaciones = "Actualizar dosis";

        Receta::editar($id, $paciente_id, $imagen, $nombre, $fecha, $estado, $codigo_nacional, $observaciones);

        $receta = Receta::buscar($id);

        $this->assertEquals("Ibuprofeno 600mg TEVA Prueba", $receta->nombre);
    }

    public function testBorrarReceta()
    {

        $id_borrar = 80;

        $resultado = Receta::borrar($id_borrar);
        $this->assertTrue($resultado);
    }

    public function testObtenerImagenReceta()
    {
        $id_receta = 87;
        $imagen = Receta::obtenerImagen($id_receta);
        $this->assertIsString($imagen);
    }

    public function testActualizarImagen()
    {
        $id_receta = 87;
        $nueva_imagen = "test_imagen_" . time() . ".jpg";

        Receta::actualizarImagen($id_receta, $nueva_imagen);

        $imagen_actualizada = Receta::obtenerImagen($id_receta);
        $this->assertEquals($nueva_imagen, $imagen_actualizada);
    }


    public function testBorraImagenReceta()
    {
        $imagen_test = "imagen_test_borrar.jpg";
        $ruta = "assets/img/recetas/" . $imagen_test;

        file_put_contents($ruta, "contenido de prueba");

        $this->assertFileExists($ruta);

        Receta::borraImagenReceta($imagen_test);
        $this->assertFileDoesNotExist($ruta);
    }

    public function testBuscarPacienteReceta()
    {
        $paciente_id = 3;
        $recetas = Receta::buscarRecetaPaciente($paciente_id);

        $this->assertIsArray($recetas);

        if (!empty($recetas)) {
            foreach ($recetas as $receta) {
                $this->assertInstanceOf(Receta::class, $receta);
                $this->assertEquals($paciente_id, $receta->paciente_id);
            }
        }
    }
}
?>