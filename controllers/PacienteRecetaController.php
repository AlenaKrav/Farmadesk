<?php
include_once('./models/Receta.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class PacienteRecetaController
{
    public function inicio()
    {
        session_start();
        // print_r($_SESSION);

        if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] !== 3) {
            echo "Acceso no autorizado";
            exit;
        }
        
        $id_paciente=$_SESSION['user_id'];
        $recetas = Receta::buscarRecetaPaciente($id_paciente);
        
        if ($recetas) {
            echo "Tenemos recetas";
        } else {
            echo "Todavía no tienes ninguna receta registrada";
        }
        include_once("./views/recetas/paciente/inicio.php");
    }


    public function crear()
    {

        session_start();

        if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 3) {
            echo "Acceso no autorizado";
            exit;
        }

        
        if (isset($_POST['agregar'])) {
            if (isset($_POST['paciente_id']) && isset($_FILES['imagen']['name']) && isset($_POST['nombre']) && isset($_POST['fecha']) && isset($_POST['codigo_nacional']) && isset($_POST['observaciones'])) {
                $paciente_id = $_POST['paciente_id'];
                $imagen = $_FILES['imagen']['name'];
                $nombre = $_POST['nombre'];
                $fecha = $_POST['fecha'];

                if (empty($paciente_id) || empty($imagen) || empty($nombre) || empty($fecha) || empty($codigo_nacional) ||  empty($observaciones)) {
                    echo "Completa todos los campos";
                }

                $fecha_imagen = new DateTime();
                $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";

                $tmp_imagen =  $_FILES['imagen']['tmp_name'];

                if ($tmp_imagen != "") {
                    move_uploaded_file($tmp_imagen, "assets/img/recetas/" . $nombre_archivo_imagen);
                }

                Receta::crear($paciente_id, $nombre_archivo_imagen, $nombre, $fecha);
                header("Location: /farma/paceinte/recetas");
                exit();
            }
        }
        include_once("./views/recetas/paciente/crear.php");
    }
}



?>