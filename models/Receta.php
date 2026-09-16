<?php
class Receta
{
    public $id_receta;
    public $paciente_id;
    public $imagen_receta;
    public $nombre;
    public $fecha;
    public $estado;
    public $codigo_nacional;
    public $observaciones;
    public $nombre_completo_paciente;

    public function __construct($id_receta, $paciente_id, $imagen_receta, $nombre, $fecha, $estado, $codigo_nacional, $observaciones)
    {
        $this->id_receta = $id_receta;
        $this->paciente_id = $paciente_id;
        $this->imagen_receta = $imagen_receta;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->codigo_nacional = $codigo_nacional;
        $this->observaciones = $observaciones;
    }

    public static function crear($paciente_id, $imagen_receta, $nombre, $fecha, $codigo_nacional = null, $observaciones = null)
    {
        try {
            $conexion = BD::crearInstancia();
            if ($codigo_nacional !== null && $observaciones !== null) {
                $sql = $conexion->prepare("INSERT INTO `tbl_recetas`(`id_receta`, `paciente_id`, `imagen_receta`, `nombre`, `fecha`, `estado`, `codigo_nacional`, `observaciones`)
                VALUES (NULL, :paciente_id, :imagen_receta, :nombre, :fecha, 'Enviada', :codigo_nacional, :observaciones);");
                $sql->bindParam(":codigo_nacional", $codigo_nacional);
                $sql->bindParam(":observaciones", $observaciones);
            } else {
                $sql = $conexion->prepare("INSERT INTO `tbl_recetas`(`id_receta`, `paciente_id`, `imagen_receta`, `nombre`, `fecha`, `estado`, `codigo_nacional`, `observaciones`)
                VALUES (NULL, :paciente_id, :imagen_receta, :nombre, :fecha, 'Enviada', NULL, NULL);");
            }

            $sql->bindParam(":paciente_id", $paciente_id);
            $sql->bindParam(":imagen_receta", $imagen_receta);
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":fecha", $fecha);

            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al crear la receta " . $e->getMessage();
            return false;
        }
    }


    public static function consultar()
    {
        $listaRecetas = [];
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT 
            r.id_receta, 
            r.paciente_id, 
            r.imagen_receta,
            r.nombre AS nombre_receta, 
            r.estado, 
            r.fecha, 
            r.codigo_nacional, 
            r.observaciones, 
            CONCAT(p.nombre, ' ', p.apellidos) AS nombre_completo_paciente
            FROM tbl_recetas r
            JOIN tbl_pacientes p 
            ON r.paciente_id = p.id_paciente;");

            $sql->execute();

            foreach ($sql->fetchAll() as $receta) {
                $nuevaReceta = new Receta(
                    $receta['id_receta'],
                    $receta['paciente_id'],
                    $receta['imagen_receta'],
                    $receta['nombre_receta'],
                    $receta['fecha'],
                    $receta['estado'],
                    $receta['codigo_nacional'],
                    $receta['observaciones'],
                );
                $nuevaReceta->nombre_completo_paciente = $receta['nombre_completo_paciente'];
                $listaRecetas[] = $nuevaReceta;
            }
            return $listaRecetas;
        } catch (PDOException $e) {
            echo "Error al mostrar las recetas " . $e->getMessage();
            return false;
        }
    }


    public static function buscar($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT * FROM tbl_recetas WHERE id_receta=:id_receta");
            $sql->bindParam(":id_receta", $id);
            $sql->execute();
            $receta = $sql->fetch();
            return new Receta(
                $receta['id_receta'],
                $receta['paciente_id'],
                $receta['imagen_receta'],
                $receta['nombre'],
                $receta['fecha'],
                $receta['estado'],
                $receta['codigo_nacional'],
                $receta['observaciones']
            );
        } catch (PDOException $e) {
            echo "Error al buscar la receta con ID $id " . $e->getMessage();
            return false;
        }
    }

    public static function obtenerImagen($id_receta)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT imagen_receta FROM tbl_recetas WHERE id_receta=:id_receta");
            $sql->bindParam(":id_receta", $id_receta);
            $sql->execute();
            $imagen = $sql->fetch();
            return $imagen['imagen_receta'] ?? null;
        } catch (PDOException $e) {
            echo "Error al obtener la imagen " . $e->getMessage();
            return false;
        }
    }

    public static function borraImagenReceta($imagen)
    {
        try {
            $ruta_imagen = "assets/img/recetas/" . $imagen;
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen);
            }
            return true;
        } catch (PDOException $e) {
            echo "Error al borrar la imagen " . $e->getMessage();
            return false;
        }
    }

    public static function actualizarImagen($id_receta, $imagen_receta)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("UPDATE tbl_recetas SET imagen_receta = :imagen_receta WHERE id_receta = :id_receta");
            $sql->bindParam(":imagen_receta", $imagen_receta);
            $sql->bindParam(":id_receta", $id_receta);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar la imagen " . $e->getMessage();
            return false;
        }
    }



    public static function editar($id_receta, $paciente_id, $imagen_receta, $nombre, $fecha, $estado, $codigo_nacional, $observaciones)
    {
        try {
            $conexion = BD::crearInstancia();
            if ($imagen_receta != "") {
                $imagen_actual = self::obtenerImagen($id_receta);
                if ($imagen_actual && $imagen_receta != $imagen_actual) {
                    self::borraImagenReceta($imagen_actual);
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

            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al editar la receta con ID $id_receta " . $e->getMessage();
            return false;
        }
    }


    public static function borrar($id_receta)
    {
        try {
            $conexion = BD::crearInstancia();
            $imagen = self::obtenerImagen($id_receta);

            if ($imagen) {
                self::borraImagenReceta($imagen);
            }

            $sql = $conexion->prepare("DELETE FROM tbl_recetas WHERE id_receta = :id_receta");
            $sql->bindParam(":id_receta", $id_receta);
            return $sql->execute();
        } catch (PDOException $e) {
            echo "Error al borrar la receta con ID $id_receta " . $e->getMessage();
            return false;
        }
    }


    public static function buscarRecetaPaciente($paciente_id)
    {
        $listaRecetasPaciente = [];
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT * FROM `tbl_recetas` WHERE paciente_id=:paciente_id");
            $sql->bindParam(":paciente_id", $paciente_id);
            $sql->execute();

            foreach ($sql->fetchAll() as $recetaPaciente) {
                $nuevaReceta = new Receta(
                    $recetaPaciente['id_receta'],
                    $recetaPaciente['paciente_id'],
                    $recetaPaciente['imagen_receta'],
                    $recetaPaciente['nombre'],
                    $recetaPaciente['fecha'],
                    $recetaPaciente['estado'],
                    $recetaPaciente['codigo_nacional'],
                    $recetaPaciente['observaciones'],
                );
                $listaRecetasPaciente[] = $nuevaReceta;
            }
            return $listaRecetasPaciente;
        } catch (PDOException $e) {
            echo "Error al buscar la receta del paciente con ID $paciente_id " . $e->getMessage();
            return null;
        }
    }
}
?>