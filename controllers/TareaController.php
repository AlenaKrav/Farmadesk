<?php
include_once('./models/Tarea.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class TareaController
{
    public function inicio()
    {
        //OJO ES UN ARRAY DE OBJETOS
        $tareas = Tarea::consultar();
        
        if ($tareas) {
            echo "Tenemos tareas";
        } else {
            echo "No tenemos users";
        }
        include_once("./views/tareas/index.php");
    }

    public function crear()
    {
        if (isset($_POST['agregar'])) {
            if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];

                Tarea::crear($nombre, $descripcion);
                header("Location: /farma/admin/tareas");
                exit();
            }
        }
        include_once("./views/tareas/crear.php");
    }


    public function editar()
    {
        session_start();

        if ($_SESSION['role_id'] !== 1) {
            echo "Acceso no autorizado";
            header("Location: /farma/login");
            exit;
        }

        $user_actualiza = $_SESSION['user_id'];

        if (isset($_POST['actualizar'])) {
            if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['estado'])) {
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $estado = $_POST['estado'];
            }
            Tarea::editar($id, $nombre, $descripcion, $estado, $user_actualiza);
                header("Location: /farma/admin/tareas");
                exit();
        }

        if(isset($_GET['id'])){
            $idBuscar=$_GET['id'];
            $tarea = Tarea::buscar($idBuscar);     
        }
        // $usuario = Usuario::buscar(1);
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
