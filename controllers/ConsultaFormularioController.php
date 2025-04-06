<?php
include_once('./models/ConsultaFormulario.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class ConsultaFormularioController{
    public function inicio()
    {
        //OJO ES UN ARRAY DE OBJETOS
        $consultas = ConsultaFormulario::consultar();
        // if ($consultas) {
        //     echo "Tenemos consultas";
        // } else {
        //     "Error";
        // }
        include_once("./views/consultasFormulario/index.php");
    }

    public function crear(){
        $mensajeExito="";
        $mensajeError="";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
            // print_r($_POST);
            if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['mensaje'])) {
                $nombre = $_POST['nombre'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $mensaje = $_POST['mensaje'];

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