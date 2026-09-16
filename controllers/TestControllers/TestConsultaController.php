<?php
include_once('./models/ConsultaFormulario.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class TestControllers
{
    public function procesarCrearConsulta($nombre, $email, $telefono, $mensaje)
    {
        if ($nombre && $email && $telefono && $mensaje) {
            ConsultaFormulario::crear($nombre, $email, $telefono, $mensaje);
            return "Tu consulta ha sido enviada con éxito";
        }
        return "Error";
    }
}
?>
