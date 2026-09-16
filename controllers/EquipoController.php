<?php
include_once('./models/Equipo.php');
include_once('./config/conexion.php');
require_once('./helpers/validaciones.php');

BD::crearInstancia();

class EquipoController
{
    public function inicio()
    {
        $miembrosEquipo = Equipo::consultar();
        if(!$miembrosEquipo){
            $miembrosEquipo=[];
        }
        include_once("./views/equipo/index.php");
    }



    public function crear()
{
    $errores = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
        $nombre = trim($_POST['nombre'] ?? '');
        $puesto = trim($_POST['puesto'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $imagen = trim($_FILES['imagen']['name'] ?? '');

        if (inputVacio($nombre)) {
            $errores['nombre'] = "Debes introducir un nombre de miembro de equipo";
        }

        if (inputVacio($puesto)) {
            $errores['puesto'] = "Debes introductir un puesto de miembro de equipo";
        }

        if (empty($descripcion)) {
            $errores['descripcion'] = "Debes introductir una descripción de miembro de equipo";
        }


        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png'];
            $max_size = 5 * 1024 * 1024;

            $file_type = $_FILES['imagen']['type'];
            $file_size = $_FILES['imagen']['size'];
            $tmp_imagen = $_FILES['imagen']['tmp_name'];

            if (!in_array($file_type, $allowed_types)) {
                $errores['imagen'] = "Solo se permiten imágenes en formato JPG o PNG";
            }

            if ($file_size > $max_size) {
                $errores['imagen'] = "El tamaño de la imagen no debe superar los 5MB";
            }

            if (empty($errores['imagen'])) {
                $fecha_imagen = new DateTime();
                $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";
                move_uploaded_file($tmp_imagen, "assets/img/team/" . $nombre_archivo_imagen);
            }
        } else {
            $errores['imagen'] = "Debes subir una imagen válida";
        }

        if (empty($errores)) {
            Equipo::crear($nombre_archivo_imagen, $nombre, $puesto, $descripcion);
            header("Location: /farma/admin/equipo");
            exit();
        }
    }

    include_once("./views/equipo/crear.php");
}


public function editar()
    {
        $errores = [];
        
        if (isset($_POST['actualizar'])) {
            if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['puesto']) && isset($_POST['descripcion'])) {
                $id = $_POST['id'];
                $nombre = trim($_POST['nombre'] ?? '');
                $puesto = trim($_POST['puesto'] ?? '');
                $descripcion = trim($_POST['descripcion'] ?? '');

                if (inputVacio($nombre)) {
                    $errores['nombre'] = "Debes introducir un nombre de miembro de equipo";
                }
        
                if (inputVacio($puesto)) {
                    $errores['puesto'] = "Debes introducir un puesto de miembro de equipo";
                }
        
                if (empty($descripcion)) {
                    $errores['descripcion'] = "Debes introducir una descripción de miembro de equipo";
                }
            }

            if ($_FILES['imagen']['tmp_name'] == "") {
                $imagen = Equipo::obtenerImagen($id);
            } else {
                $imagen = $_FILES['imagen']['name'];

                $allowed_types = ['image/jpeg', 'image/png'];
                $max_size = 5 * 1024 * 1024;
                $file_type = $_FILES['imagen']['type'];
                $file_size = $_FILES['imagen']['size'];
                $tmp_imagen = $_FILES['imagen']['tmp_name'];

                if (!in_array($file_type, $allowed_types)) {
                    $errores['imagen'] = "Solo se permiten imágenes en formato JPG o PNG";
                }

                if ($file_size > $max_size) {
                    $errores['imagen'] = "El tamaño de la imagen no debe superar los 5MB";
                }


                if (empty($errores['imagen'])){
                $fecha_imagen = new DateTime();
                $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;
                move_uploaded_file($tmp_imagen, "assets/img/team/" . $nombre_archivo_imagen);
                $imagen = $nombre_archivo_imagen;
            } 
        }
        if (empty($errores)){
            Equipo::editar($id, $imagen, $nombre, $puesto, $descripcion);
            header("Location: /farma/admin/equipo");
            exit();
    }
        }

        if (isset($_GET['id'])) {
            $idBuscar = $_GET['id'];
            $persona = Equipo::buscar($idBuscar);
        }
        include_once("./views/equipo/editar.php");
    }

    public function borrar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Equipo::borrar($id);
        }
        header("Location: /farma/admin/equipo");
        exit();
    }


}