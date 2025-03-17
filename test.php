<?php
public function editar()
{
    if (isset($_POST['actualizar'])) {
        // Verificamos si los campos requeridos están presentes
        if (isset($_POST['id_receta']) && isset($_POST['paciente_id']) && isset($_POST['nombre']) && isset($_POST['fecha']) && isset($_POST['estado']) && isset($_POST['codigo_nacional']) && isset($_POST['observaciones'])) {
            $id_receta = $_POST['id_receta'];
            $paciente_id = $_POST['paciente_id'];
            $nombre = $_POST['nombre'];
            $fecha = $_POST['fecha'];
            $estado = $_POST['estado'];
            $codigo_nacional = $_POST['codigo_nacional'];
            $observaciones = $_POST['observaciones'];
            
            // Obtener la imagen actual de la receta
            $imagen_receta = Receta::obtenerImagen($id_receta);

            // Verificamos si hay una nueva imagen
            if ($_FILES['imagen_receta']['tmp_name'] != "") {
                // Nueva imagen recibida, la procesamos
                $imagen = $_FILES['imagen_receta']['name'];
                $fecha_imagen = new DateTime();
                $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;

                $tmp_imagen = $_FILES['imagen_receta']['tmp_name'];
                move_uploaded_file($tmp_imagen, "assets/img/recetas/" . $nombre_archivo_imagen);

                // Actualizamos la imagen de la receta
                Receta::actualizarImagen($id_receta, $nombre_archivo_imagen);
                $imagen_receta = $nombre_archivo_imagen;
            } else {
                // No hay nueva imagen, mantenemos la imagen actual
                $imagen_receta = $imagen_receta;
            }

            // Llamamos al método de edición de la receta
            Receta::editar($id_receta, $paciente_id, $imagen_receta, $nombre, $fecha, $estado, $codigo_nacional, $observaciones);

            // Redirigimos después de la actualización
            header("Location: /farma/recetas");
            exit();
        }
    }

    // Si estamos editando, buscamos la receta
    if (isset($_GET['id'])) {
        $idBuscar = $_GET['id'];
        $receta = Receta::buscar($idBuscar);
    }

    include_once("./views/recetas/editar.php");
}



public static function obtenerImagen($id_receta)
    {
        $conexion = BD::crearInstancia();
        //buscamos la imagen del registro con ese ID
        $sql = $conexion->prepare("SELECT imagen_receta FROM tbl_recetas WHERE id_receta=:id_receta");
        $sql->bindParam(":id_receta", $id_receta);
        $sql->execute();
        $imagen = $sql->fetch();
        return $receta['imagen_receta'] ?? null;
    }

    public static function borraImagenReceta($imagen)
    {
        $ruta_imagen = "assets/img/recetas/" . $imagen;
        if (file_exists($ruta_imagen)) {
            unlink($ruta_imagen);
        }
    }

    public static function actualizarImagen($id_receta, $imagen_receta = null){
        $conexion = BD::crearInstancia();
        //si nos viene una nueva imagen para la receta
        if($imagen_receta!==NULL){
            //obtenemos esa imagen actual
            $imagen_actual = self::obtenerImagen($id_receta);
            //si tenemos esa imagen
            if($imagen_actual){
                //la borramos
                self::borraImagenReceta($imagen_actual);
            }
        //actualizamos el registro
        $sql = $conexion->prepare("UPDATE tbl_recetas SET imagen_receta = :imagen_receta WHERE id_receta = :id_receta");
        $sql->bindParam(":imagen_receta", $imagen_receta);
        $sql->bindParam(":id_receta", $id_receta);
        $sql->execute();

        }
    }


    public static function editar($id_receta, $paciente_id, $imagen_receta, $nombre, $fecha, $estado, $codigo_nacional, $observaciones)
    {
        $conexion = BD::crearInstancia();
        //obtenemos la imagen de la receta a actualizar
        if ($imagen_receta != "") {
            //obtenemos la img actual de la receta
            $imagen_actual = self::obtenerImagen($id_receta);
            //si existe uma img 
            if ($imagen_actual) {
                self::borraImagenReceta($imagen_actual);
            }
            else {
                // Si no se está enviando una nueva imagen, podemos mantener la imagen actual
                $imagen_actual = self::obtenerImagen($id_receta);
                if ($imagen_actual) {
                    $imagen_receta = $imagen_actual;  // Mantener la imagen actual
                }
            }
        }

        $sql = $conexion->prepare("UPDATE tbl_recetas 
        SET paciente_id = :paciente_id, 
            imagen_receta = :imagen_receta, 
            nombre = :nombre, 
            fecha = :fecha, 
            estado = :estado, 
            codigo_nacional = :codigo_nacional, 
            observaciones = :observaciones 
        WHERE id_receta = :id_receta");

        $sql->bindParam(":paciente_id", $paciente_id);
        $sql->bindParam(":imagen_receta", $imagen_receta);
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":fecha", $fecha);
        $sql->bindParam(":estado", $estado);
        $sql->bindParam(":codigo_nacional", $codigo_nacional);
        $sql->bindParam(":observaciones", $observaciones);
        $sql->bindParam(":id_receta", $id_receta);

        // Ejecutamos la consulta
        $sql->execute();
    }

    

    public static function borrar($id_receta)
    {
        $conexion = BD::crearInstancia();
        //obtenemos la imagen del registro a borrar
        $imagen = self::obtenerImagen($id_receta);

        if ($imagen) {
            self::borraImagenReceta($imagen);
        }

        $sql = $conexion->prepare("DELETE FROM tbl_recetas WHERE id_receta = :id_receta");
        $sql->bindParam(":id_receta", $id_receta);
        return $sql->execute();
    }
}




?>