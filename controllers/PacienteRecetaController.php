<?php
include_once('./models/Receta.php');
include_once('./config/conexion.php');
require_once('./helpers/validaciones.php');

BD::crearInstancia();

class PacienteRecetaController
{
    public function inicio()
    {
        session_start();
        $id_paciente = $_SESSION['id_paciente'];
        $recetasPaciente = Receta::buscarRecetaPaciente($id_paciente);

        if (!$recetasPaciente) {
            $recetasPaciente = [];
        }
        include_once("./views/recetas/paciente/index.php");
    }



    public function crear()
    {
        session_start();
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
            if (isset($_FILES['imagen']['name']) && isset($_POST['nombre']) && isset($_POST['fecha'])) {
                $paciente_id = $_SESSION['id_paciente'];
                $imagen = trim($_FILES['imagen']['name'] ?? '');
                $nombre = trim($_POST['nombre'] ?? '');
                $fecha = trim($_POST['fecha'] ?? '');
                $codigo_nacional = NULL;
                $observaciones = NULL;

                if (inputVacio($nombre)) {
                    $errores['nombre'] = "Debes introducir un nombre de medicamento";
                }

                if (inputVacio($fecha)) {
                    $errores['fecha'] = "Debes introducir una fecha de prescripción";
                } else if (!validarFechaPrescripción($fecha)) {
                    $errores['fecha'] = "Formato inválido de fecha de prescripción";
                }


                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    $formatos_permitidos = ['image/jpeg', 'image/png'];
                    $tamano_maximo = 5 * 1024 * 1024;

                    $tipo_img = $_FILES['imagen']['type'];
                    $tamano_img = $_FILES['imagen']['size'];
                    $tmp_imagen = $_FILES['imagen']['tmp_name'];

                    if (!in_array($tipo_img, $formatos_permitidos)) {
                        $errores['imagen'] = "Solo se permiten imágenes en formato JPG o PNG";
                    }

                    if ($tamano_img > $tamano_maximo) {
                        $errores['imagen'] = "El tamaño de la imagen no debe superar los 5MB";
                    }

                    if (empty($errores['imagen'])) {
                        $fecha_imagen = new DateTime();
                        if ($imagen != "") {
                            $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;
                            move_uploaded_file($tmp_imagen, "assets/img/recetas/" . $nombre_archivo_imagen);
                        } else {
                            $nombre_archivo_imagen = "";
                        }
                    }
                } else {
                    $errores['imagen'] = "Debes subir una imagen válida";
                }
                if (empty($errores)) {
                    Receta::crear($paciente_id, $nombre_archivo_imagen, $nombre, $fecha, $codigo_nacional, $observaciones);
                    header("Location: /farma/paciente/recetas");
                    exit();
                }
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
