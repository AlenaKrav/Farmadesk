<?php
include_once('./models/ConsultaFormulario.php');
include_once('./config/conexion.php');
require_once('./helpers/validaciones.php');

BD::crearInstancia();

class ConsultaFormularioController{
    public function inicio()
    {
        $consultas = ConsultaFormulario::consultar();
        if (!$consultas) {
            $consultas=[];
        } 
        include_once("./views/consultasFormulario/index.php");
    }

    public function crear(){
        $mensajeExito="";
        $errores=[];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['mensaje'])) {
                $nombre = $_POST['nombre'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $mensaje = $_POST['mensaje'];


                if (!validarCadena($nombre)) {
                    $errores['nombre'] = "El nombre solo puede contener letras";
                }

                if (!validarCorreo($email)) {
                    $errores['correo'] = "Formato inválido de correo electrónico";
                }

                if (!validarTlf($telefono)) {
                    $errores['telefono'] = "Formato inválido de número de teléfono";
                }

                ConsultaFormulario::crear($nombre, $email, $telefono, $mensaje);
                $mensajeExito="Tu consulta ha sido enviada con éxito";
                header("Location: /farma/index.php?mensaje=".$mensajeExito);
                exit();
            }
        }
            include_once("./views/secciones/formulario.php");
    }


    public function borrar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            ConsultaFormulario::borrar($id);
        }
        header("Location: /farma/admin/consultas-formulario");
        exit();
    }

}
?>