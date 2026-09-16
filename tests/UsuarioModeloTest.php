<?php

use PHPUnit\Framework\TestCase;

require_once('./models/Usuario.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class UsuarioModeloTest extends TestCase
{

    public function testExisteNuevoValor()
    {
        $campoExistente = 'correo';
        $valorExistente = 'gemma@yahoo.es';
        $this->assertTrue(Usuario::existeNuevoValor($campoExistente, $valorExistente));

        $valorInexistente = 'ejemplo@test.com';
        $this->assertFalse(Usuario::existeNuevoValor($campoExistente, $valorInexistente));
    }

    public function testExisteAntiguoValor()
    {
        $campo = 'correo';

        $id_usuario_1 = 7;
        $correo_usuario_1 = 'olegdsz2004@gmail.com';

        $id_usuario_2 = 29;

        $this->assertTrue(Usuario::existeAntiguoValor($campo, $correo_usuario_1, $id_usuario_2));
        $this->assertFalse(Usuario::existeAntiguoValor($campo, $correo_usuario_1, $id_usuario_1));
    }
}
?>