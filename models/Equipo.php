<?php
class Equipo
{
    public $id;
    public $imagen;
    public $nombre;
    public $puesto;
    public $descripcion;

    public function __construct($id, $imagen, $nombre, $puesto, $descripcion)
    {
        $this->id = $id;
        $this->imagen = $imagen;
        $this->nombre = $nombre;
        $this->puesto = $puesto;
        $this->descripcion = $descripcion;
    }


    public static function crear($imagen, $nombre, $puesto, $descripcion)
    {
        try {
            $conexion = BD::crearInstancia();

            $sql = $conexion->prepare("INSERT INTO `tbl_equipo`(`id`, `imagen`, `nombre`, `puesto`, `descripcion`)
        VALUES (NULL, :imagen, :nombre, :puesto, :descripcion);");

            $sql->bindParam(":imagen", $imagen);
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":puesto", $puesto);
            $sql->bindParam(":descripcion", $descripcion);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al crear un miembro del equipo" . $e->getMessage();
            return null;
        }
    }


    public static function consultar()
    {
        $listaEquipo = [];
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT * FROM tbl_equipo");

            $sql->execute();

            foreach ($sql->fetchAll() as $persona) {
                $nuevaPersona = new Equipo(
                    $persona['id'],
                    $persona['imagen'],
                    $persona['nombre'],
                    $persona['puesto'],
                    $persona['descripcion']
                );
                $listaEquipo[] = $nuevaPersona;
            }
            return $listaEquipo;
        } catch (PDOException $e) {
            echo "Error al mostrar las consultas " . $e->getMessage();
            return null;
        }
    }


    public static function buscar($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT * FROM tbl_equipo WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            $persona = $sql->fetch();
            return new Equipo($persona['id'], $persona['imagen'], $persona['nombre'], $persona['puesto'], $persona['descripcion']);
        } catch (PDOException $e) {
            echo "Error al buscar el miembro del equipo con el ID $id " . $e->getMessage();
            return null;
        }
    }

    public static function obtenerImagen($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT imagen FROM tbl_equipo WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            $imagen = $sql->fetch();
            return $imagen['imagen'] ?? null;
        } catch (PDOException $e) {
            echo "Error al obtener la imagen " . $e->getMessage();
            return null;
        }
    }

    public static function borrarImagen($imagen)
    {
        try {
            $ruta_imagen = "assets/img/team/" . $imagen;
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen);
            }
        } catch (PDOException $e) {
            echo "Error al borrar la imagen " . $e->getMessage();
            return null;
        }
    }

    public static function actualizarImagen($id, $imagen)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("UPDATE tbl_equipo SET imagen =:imagen WHERE id =:id");
            $sql->bindParam(":imagen", $imagen);
            $sql->bindParam(":id", $id);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar la imagen " . $e->getMessage();
            return null;
        }
    }


    public static function editar($id, $imagen, $nombre, $puesto, $descripcion)
    {
        try {
            $conexion = BD::crearInstancia();
            if ($imagen != "") {
                $imagen_actual = self::obtenerImagen($id);
                if ($imagen_actual && $imagen != $imagen_actual) {
                    self::borrarImagen($imagen_actual);
                }
            }

            $sql = $conexion->prepare("UPDATE tbl_equipo 
        SET imagen = :imagen, 
            nombre = :nombre, 
            puesto = :puesto, 
            descripcion = :descripcion WHERE id = :id");

            $sql->bindParam(":imagen", $imagen);
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":puesto", $puesto);
            $sql->bindParam(":descripcion", $descripcion);
            $sql->bindParam(":id", $id);

            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al editar el miembro del equipo con el ID $id " . $e->getMessage();
            return null;
        }
    }

    public static function borrar($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $imagen = self::obtenerImagen($id);

            if ($imagen) {
                self::borrarImagen($imagen);
            }

            $sql = $conexion->prepare("DELETE FROM tbl_equipo WHERE id = :id");
            $sql->bindParam(":id", $id);
            return $sql->execute();
        } catch (PDOException $e) {
            echo "Error al borrar el miembro del equipo con el ID $id " . $e->getMessage();
            return null;
        }
    }
}
?>