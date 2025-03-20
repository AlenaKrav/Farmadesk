<?php
include_once('./models/Receta.php');
include_once('./config/conexion.php');
// include_once('./config/config_session.php');

BD::crearInstancia();

class PacienteRecetaController
{
    public function inicio()
    {
        session_start();

        if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] !== 3) {
            echo "Acceso no autorizado desde paciente receta controller";
            header("Location: /farma/login");
            exit;
        }

        $id_paciente = $_SESSION['id_paciente'];
        $recetasPaciente = Receta::buscarRecetaPaciente($id_paciente);

        if ($recetasPaciente) {
            echo "Tenemos recetas";
        } else {
            echo "Todavía no tienes ninguna receta registrada";
        }
        include_once("./views/recetas/paciente/inicio.php");
    }


    //METODO FUNCIONAL Nº1
    public function crear()
    {

        //iniciamos la sesion
        session_start();

        if (isset($_POST['agregar'])) {
            if (isset($_FILES['imagen']['name']) && isset($_POST['nombre']) && isset($_POST['fecha'])) {
                $paciente_id = $_SESSION['id_paciente'];
                $imagen = $_FILES['imagen']['name'];
                $nombre = $_POST['nombre'];
                $fecha = $_POST['fecha'];
                $codigo_nacional = NULL;
                $observaciones = NULL;

                if (empty($paciente_id) || empty($imagen) || empty($nombre) || empty($fecha) || empty($codigo_nacional) ||  empty($observaciones)) {
                    echo "Completa todos los campos";
                }

                $fecha_imagen = new DateTime();
                $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";

                $tmp_imagen =  $_FILES['imagen']['tmp_name'];

                if ($tmp_imagen != "") {
                    move_uploaded_file($tmp_imagen, "assets/img/recetas/" . $nombre_archivo_imagen);
                }

                Receta::crear($paciente_id, $nombre_archivo_imagen, $nombre, $fecha, $codigo_nacional, $observaciones);
                header("Location: /farma/paciente/recetas");
                exit();
            }
        }
        include_once("./views/recetas/paciente/crear.php");
    }


    
    public function borrar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Receta::borrar($id);
        }
        header("Location: /farma/paciente/recetas");
        exit();
    }
}
