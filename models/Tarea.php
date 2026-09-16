<?php
class Tarea
{

    public $id;
    public $nombre;
    public $descripcion;
    public $estado;
    public $fecha_creacion;
    public $user_actualiza;
    public $fecha_actualiza;
    public $nombre_user_actualiza;


    public function __construct($id, $nombre, $descripcion, $estado, $fecha_creacion, $user_actualiza, $fecha_actualiza)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
        $this->fecha_creacion = $fecha_creacion;
        $this->user_actualiza = $user_actualiza;
        $this->fecha_actualiza = $fecha_actualiza;
    }

    public function __set($nombre, $valor)
    {
        if ($nombre == 'nombre_user_actualiza') {
            $this->nombre_user_actualiza = $valor;
        }
    }

    public static function crear($nombre, $descripcion, $user_actualiza)
    {
        try {
            $conexion = BD::crearInstancia();

            $sql = $conexion->prepare("INSERT INTO `tbl_tareas_farma`(`id`, `nombre`, `descripcion`, `estado`, `fecha_creacion`, `user_actualiza`, `fecha_actualiza`) VALUES (NULL, :nombre, :descripcion, 'Pendiente', CURRENT_TIMESTAMP, :user_actualiza, NULL);");
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":descripcion", $descripcion);
            $sql->bindParam(":user_actualiza", $user_actualiza);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al crear la tarea " . $e->getMessage();
            return null;
        }
    }

    public static function consultar()
    {
        $listaTareas = [];
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT t.id, t.nombre, t.descripcion, t.estado, t.fecha_creacion, t.user_actualiza, t.fecha_actualiza, u.nombre 
                                    AS nombre_user_actualiza, u.ID FROM tbl_tareas_farma t LEFT JOIN tbl_usuarios u ON t.user_actualiza = u.ID");


            $sql->execute();
            foreach ($sql->fetchAll() as $tarea) {
                $tareaNueva = new Tarea($tarea['id'], $tarea['nombre'], $tarea['descripcion'], $tarea['estado'], $tarea['fecha_creacion'], $tarea['user_actualiza'], $tarea['fecha_actualiza']);
                $tareaNueva->nombre_user_actualiza = $tarea['nombre_user_actualiza'];
                $listaTareas[] = $tareaNueva;
            }
            return $listaTareas;
        } catch (PDOException $e) {
            echo "Error al consultar las tareas " . $e->getMessage();
            return null;
        }
    }

    public static function buscar($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT * FROM tbl_tareas_farma WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            $tarea = $sql->fetch();
            return new Tarea($tarea['id'], $tarea['nombre'], $tarea['descripcion'], $tarea['estado'], $tarea['fecha_creacion'], $tarea['user_actualiza'], $tarea['fecha_actualiza']);
        } catch (PDOException $e) {
            echo "Error al buscar la tarea con ID $id " . $e->getMessage();
            return null;
        }
    }

    public static function borrar($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("DELETE FROM tbl_tareas_farma WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al borrar ula tarea con ID $id " . $e->getMessage();
            return null;
        }
    }

    public static function editar($id, $nombre, $descripcion, $estado, $user_actualiza)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("UPDATE tbl_tareas_farma SET nombre=:nombre, descripcion=:descripcion, estado=:estado, 
        user_actualiza=:user_actualiza, fecha_actualiza=CURRENT_TIMESTAMP WHERE id=:id");
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":descripcion", $descripcion);
            $sql->bindParam(":estado", $estado);
            $sql->bindParam(":user_actualiza", $user_actualiza);
            $sql->bindParam(":id", $id);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al editar la tarea con ID $id " . $e->getMessage();
            return null;
        }
    }
}
?>
