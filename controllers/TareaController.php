<?php
include_once('./models/Tarea.php');
include_once('./config/conexion.php');
require_once('./helpers/validaciones.php');

BD::crearInstancia();

class TareaController
{
    public function inicio()
    {
        $tareas = Tarea::consultar();

        if (!$tareas) {
           $tareas = [];
    }
 
        include_once("./views/tareas/index.php");
    }

    public function crear()
    {
        session_start();
        $user_actualiza = $_SESSION['user_id'];

        $errores = [];

        if (isset($_POST['agregar'])) {
            if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];

                if (inputVacio($nombre)) {
                    $errores['nombre'] = "Debes introducir un nombre de tarea";
                }

                if (inputVacio($descripcion)) {
                    $errores['descripcion'] = "Debes introducir una descripción de tarea";
                }

                if (empty($errores)) {
                    Tarea::crear($nombre, $descripcion, $user_actualiza);
                    header("Location: /farma/admin/tareas");
                    exit();
                }
            }
        }
        include_once("./views/tareas/crear.php");
    }


    public function editar()
    {
        session_start();
        $user_actualiza = $_SESSION['user_id'];
        $errores = [];

        if (isset($_POST['actualizar'])) {
            if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['estado'])) {
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $estado = $_POST['estado'];


                if (inputVacio($nombre)) {
                    $errores['nombre'] = "Debes introducir un nombre de tarea";
                }

                if (inputVacio($descripcion)) {
                    $errores['descripcion'] = "Debes introducir una descripción de tarea";
                }

                if (empty($errores)) {
                    Tarea::editar($id, $nombre, $descripcion, $estado, $user_actualiza);
                    header("Location: /farma/admin/tareas");
                    exit();
                }
            }
        }

        if (isset($_GET['id'])) {
            $idBuscar = $_GET['id'];
            $tarea = Tarea::buscar($idBuscar);
        }
        include_once("./views/tareas/editar.php");
    }


    public function borrar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Tarea::borrar($id);
        }
        header("Location: /farma/admin/tareas");
        exit();
    }
}
