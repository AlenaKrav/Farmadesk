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


    public static function crear($imagen, $nombre, $puesto, $descripcion) {
        $conexion = BD::crearInstancia();
        
        $sql = $conexion->prepare("INSERT INTO `tbl_equipo`(`id`, `imagen`, `nombre`, `puesto`, `descripcion`)
        VALUES (NULL, :imagen, :nombre, :puesto, :descripcion);");
        
        $sql->bindParam(":imagen", $imagen);
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":puesto", $puesto);
        $sql->bindParam(":descripcion", $descripcion);
        $sql->execute();
    }


    public static function consultar()
    {
        $listaEquipo = [];
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("SELECT * FROM tbl_equipo");

        $sql->execute();

        foreach ($sql->fetchAll() as $persona) {
            //por cada fila recorrida, se usa el constructor para crear un objeto con los datos de esa fila
            //agregamos ese objeto resultante, al arraya
            $nuevaPersona = new Equipo($persona['id'], $persona['imagen'], $persona['nombre'], 
            $persona['puesto'],$persona['descripcion']);
            $listaEquipo[] = $nuevaPersona;
        }
        return $listaEquipo;
    }


    public static function buscar($id)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("SELECT * FROM tbl_equipo WHERE id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        $persona = $sql->fetch();
        return new Equipo($persona['id'], $persona['imagen'], $persona['nombre'], $persona['puesto'], $persona['descripcion']);
    }

    public static function obtenerImagen($id)
    {
        $conexion = BD::crearInstancia();
        //buscamos la imagen del registro con ese ID
        $sql = $conexion->prepare("SELECT imagen FROM tbl_equipo WHERE id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        //recogemos la imagen del registro
        $imagen = $sql->fetch();
        return $imagen['imagen'] ?? null;
        }

    public static function borraImagen($imagen)
    {
        $ruta_imagen = "assets/img/team/" . $imagen;
        if (file_exists($ruta_imagen)) {
            unlink($ruta_imagen);
        }
    }

    public static function actualizarImagen($id, $imagen)
    {
        $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("UPDATE tbl_equipo SET imagen =:imagen WHERE id =:id");
            $sql->bindParam(":imagen", $imagen);
            $sql->bindParam(":id", $id);
            $sql->execute();
}


public static function editar($id, $imagen, $nombre, $puesto, $descripcion)
    {
        $conexion = BD::crearInstancia();
        //obtenemos la imagen de la receta a actualizar
        if ($imagen != "") {
            //obtenemos la img actual de la receta
            $imagen_actual = self::obtenerImagen($id);
            //cambio
            if ($imagen_actual && $imagen != $imagen_actual) {
                self::borraImagen($imagen_actual);
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

        // Ejecutamos la consulta
        $sql->execute();
    }

    public static function borrar($id)
    {
        $conexion = BD::crearInstancia();
        //obtenemos la imagen del registro a borrar
        $imagen = self::obtenerImagen($id);

        if ($imagen) {
            self::borraImagen($imagen);
        }

        $sql = $conexion->prepare("DELETE FROM tbl_equipo WHERE id = :id");
        $sql->bindParam(":id", $id);
        return $sql->execute();
    }




}