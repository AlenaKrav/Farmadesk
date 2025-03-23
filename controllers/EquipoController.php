<?php
include_once('./models/Equipo.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class EquipoController
{
    public function inicio()
    {
        $miembrosEquipo = Equipo::consultar();
        include_once("./views/equipo/index.php");
    }



    public function crear()
{
    $errores = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
        // Verificar si todos los campos están presentes y no están vacíos
        $nombre = trim($_POST['nombre'] ?? '');
        $puesto = trim($_POST['puesto'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $imagen = $_FILES['imagen']['name'] ?? '';

        if (empty($nombre)){
            $errores['nombre'] = "El nombre es obligatorio.";
        }

        if (empty($puesto)){
            $errores['puesto'] = "El puesto es obligartoria.";
        }

        if (empty($descripcion)){
            $errores['descripcion'] = "El codigo nacional es obligatorio.";
        }


        // Validar archivo de imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png']; // Tipos permitidos
            $max_size = 5 * 1024 * 1024; // 5MB

            $file_type = $_FILES['imagen']['type'];
            $file_size = $_FILES['imagen']['size'];
            $tmp_imagen = $_FILES['imagen']['tmp_name'];

            if (!in_array($file_type, $allowed_types)) {
                $errores['imagen'] = "Solo se permiten imágenes en formato JPG o PNG";
            }

            if ($file_size > $max_size) {
                $errores['imagen'] = "El tamaño de la imagen no debe superar los 5MB.";
            }

            // Si no hay errores, renombrar y mover imagen
            if (empty($errores['imagen'])) {
                $fecha_imagen = new DateTime();
                $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";
                move_uploaded_file($tmp_imagen, "assets/img/team/" . $nombre_archivo_imagen);
            }
        } else {
            $errores['imagen'] = "Debes subir una imagen válida.";
        }

        // Si no hay errores, guardar en la base de datos
        if (empty($errores)) {
            Equipo::crear($nombre_archivo_imagen, $nombre, $puesto, $descripcion);
            header("Location: /farma/admin/equipo");
            exit();
        }
    }

    // Incluir vista y mostrar errores si existen
    include_once("./views/equipo/crear.php");
}


public function editar()
    {
        
        if (isset($_POST['actualizar'])) {
            if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['puesto']) && isset($_POST['descripcion'])) {
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $puesto = $_POST['puesto'];
                $descripcion = $_POST['descripcion'];
            }

            //!!!cambio, obtenemos la img actual del registro
            if ($_FILES['imagen']['tmp_name'] == "") {
                // Usamos el método obtenerImagen() para obtener la imagen actual del registro
                $imagen = Equipo::obtenerImagen($id);  // Este método obtiene la imagen actual
            } else {
                // Si hay una nueva imagen, la procesamos como antes
                $imagen = $_FILES['imagen']['name'];
                $fecha_imagen = new DateTime();
                $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;
    
                // Movemos el archivo a la carpeta correspondiente
                move_uploaded_file($_FILES['imagen']['tmp_name'], "assets/img/team/" . $nombre_archivo_imagen);
                $imagen = $nombre_archivo_imagen;
            } 
            

            Equipo::editar($id, $imagen, $nombre, $puesto, $descripcion);
            header("Location: /farma/admin/equipo");
            exit();
        }

        if (isset($_GET['id'])) {
            $idBuscar = $_GET['id'];
            $persona = Equipo::buscar($idBuscar);
        }
        // $usuario = Usuario::buscar(1);
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