<?php
include_once('./models/Receta.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class RecetaController
{
    public function inicio()
    {
        $recetas = Receta::consultar();
        if ($recetas) {
            echo "Tenemos recetas";
        } else {
            echo "No tenemos recetas";
        }
        include_once("./views/recetas/inicio.php");
    }



    public function crear()
    {
        if (isset($_POST['agregar'])) {
            if (isset($_POST['paciente_id']) && isset($_FILES['imagen']['name']) && isset($_POST['nombre']) && isset($_POST['fecha']) && isset($_POST['codigo_nacional']) && isset($_POST['observaciones'])) {
                $paciente_id = $_POST['paciente_id'];
                $imagen = $_FILES['imagen']['name'];
                $nombre = $_POST['nombre'];
                $fecha = $_POST['fecha'];
                $codigo_nacional = $_POST['codigo_nacional'];
                $observaciones = $_POST['observaciones'];

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
                header("Location: /farma/recetas");
                exit();
            }
        }
        include_once("./views/recetas/crear.php");
    }


    public function editar()
    {
        if (isset($_POST['actualizar'])) {
            if (isset($_POST['id_receta']) && isset($_POST['paciente_id']) && isset($_POST['nombre']) && isset($_POST['fecha']) && isset($_POST['estado']) && isset($_POST['codigo_nacional']) && isset($_POST['observaciones'])) {
                $id_receta = $_POST['id_receta'];
                $paciente_id = $_POST['paciente_id'];
                $nombre = $_POST['nombre'];
                $fecha = $_POST['fecha'];
                $estado = $_POST['estado'];
                $codigo_nacional = $_POST['codigo_nacional'];
                $observaciones = $_POST['observaciones'];
            }

            //!!!cambio, obtenemos la img actual del registro
            if ($_FILES['imagen_receta']['tmp_name'] == "") {
                // Usamos el método obtenerImagen() para obtener la imagen actual de la receta
                $imagen_receta = Receta::obtenerImagen($id_receta);  // Este método obtiene la imagen actual
            } else {
                // Si hay una nueva imagen, la procesamos como antes
                $imagen = $_FILES['imagen_receta']['name'];
                $fecha_imagen = new DateTime();
                $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;
    
                // Movemos el archivo a la carpeta correspondiente
                move_uploaded_file($_FILES['imagen_receta']['tmp_name'], "assets/img/recetas/" . $nombre_archivo_imagen);
                $imagen_receta = $nombre_archivo_imagen;
            } 
            

            Receta::editar($id_receta, $paciente_id, $imagen_receta, $nombre, $fecha, $estado, $codigo_nacional, $observaciones);
            header("Location: /farma/recetas");
            exit();
        }

        if (isset($_GET['id'])) {
            $idBuscar = $_GET['id'];
            $receta = Receta::buscar($idBuscar);
        }
        // $usuario = Usuario::buscar(1);
        include_once("./views/recetas/editar.php");
    }

    public function borrar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Receta::borrar($id);
        }
        header("Location: /farma/recetas");
        exit();
    }




    //     public function editar()
    // {
    //     if (isset($_POST['actualizar'])) {
    //         // Verificamos si los campos requeridos están presentes
    //         if (isset($_POST['id_receta']) && isset($_POST['paciente_id']) && isset($_POST['nombre']) && isset($_POST['fecha']) && isset($_POST['estado']) && isset($_POST['codigo_nacional']) && isset($_POST['observaciones'])) {
    //             $id_receta = $_POST['id_receta'];
    //             $paciente_id = $_POST['paciente_id'];
    //             $nombre = $_POST['nombre'];
    //             $fecha = $_POST['fecha'];
    //             $estado = $_POST['estado'];
    //             $codigo_nacional = $_POST['codigo_nacional'];
    //             $observaciones = $_POST['observaciones'];

    //             // Obtener la imagen actual de la receta
    //             $imagen_receta = Receta::obtenerImagen($id_receta);

    //             // Verificamos si hay una nueva imagen
    //             if ($_FILES['imagen_receta']['tmp_name'] != "") {
    //                 // Nueva imagen recibida, la procesamos
    //                 $imagen = $_FILES['imagen_receta']['name'];
    //                 $fecha_imagen = new DateTime();
    //                 $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;

    //                 $tmp_imagen = $_FILES['imagen_receta']['tmp_name'];
    //                 move_uploaded_file($tmp_imagen, "assets/img/recetas/" . $nombre_archivo_imagen);

    //                 // Actualizamos la imagen de la receta
    //                 Receta::actualizarImagen($id_receta, $nombre_archivo_imagen);
    //                 $imagen_receta = $nombre_archivo_imagen;
    //             } else {
    //                 // No hay nueva imagen, mantenemos la imagen actual
    //                 $imagen_receta = $imagen_receta;
    //             }

    //             // Llamamos al método de edición de la receta
    //             Receta::editar($id_receta, $paciente_id, $imagen_receta, $nombre, $fecha, $estado, $codigo_nacional, $observaciones);

    //             // Redirigimos después de la actualización
    //             header("Location: /farma/recetas");
    //             exit();
    //         }
    //     }

    //     // Si estamos editando, buscamos la receta
    //     if (isset($_GET['id'])) {
    //         $idBuscar = $_GET['id'];
    //         $receta = Receta::buscar($idBuscar);
    //     }

    //     include_once("./views/recetas/editar.php");
    // }

}
