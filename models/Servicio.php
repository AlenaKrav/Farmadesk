<?php
class Servicio
{
    public $id;
    public $icono;
    public $titulo;
    public $descripcion;
    public $activo;

    public function __construct($id, $icono, $titulo, $descripcion, $activo)
    {
        $this->id = $id;
        $this->icono = $icono;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->activo = $activo;
    }

    public static function crear($icono, $titulo, $descripcion)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("INSERT INTO `tbl_servicios`(`id`, `icono`, `titulo`, `descripcion`, `activo`) VALUES (NULL,:icono, :titulo, :descripcion, 1);");
        $sql->bindParam(":icono", $icono);
        $sql->bindParam(":titulo", $titulo);
        $sql->bindParam(":descripcion", $descripcion);

        //ejecutamos la query
        $sql->execute();
    }


    public static function desactivar($id)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("UPDATE tbl_servicios SET activo = 0 WHERE id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
    }


    public static function activar($id)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("UPDATE tbl_servicios SET activo = 1 WHERE id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
    }

    //FUNCION PARA MOSTRAR LOS SERVICIOS EN LA HOME
    public static function mostrarActivos()
    {
        $serviciosActivos = [];
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("SELECT * FROM tbl_servicios WHERE activo=1");
        $sql->execute();
        foreach ($sql->fetchAll() as $servicioActivo) {
            $servicioActivo = new Servicio($servicioActivo['id'], $servicioActivo['icono'], $servicioActivo['titulo'], $servicioActivo['descripcion'], $servicioActivo['activo']);
            $serviciosActivos[] = $servicioActivo;
        }
        return $serviciosActivos;
    }

    public static function consultar()
    {
        $listaServicios = [];
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("SELECT * FROM tbl_servicios");
        $sql->execute();
        foreach ($sql->fetchAll() as $servicio) {
            $servicio = new Servicio($servicio['id'], $servicio['icono'], $servicio['titulo'], $servicio['descripcion'], $servicio['activo']);
            $listaServicios[] = $servicio;
        }
        return $listaServicios;
    }

    public static function buscar($id)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("SELECT * FROM tbl_servicios WHERE id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        $servicio = $sql->fetch();
        return new Servicio($servicio['id'], $servicio['icono'], $servicio['titulo'], $servicio['descripcion'], $servicio['activo']);
    }

    public static function editar($id, $icono, $titulo, $descripcion)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("UPDATE tbl_servicios SET icono=:icono, titulo=:titulo, descripcion=:descripcion WHERE id=:id");
        $sql->bindParam(":icono", $icono);
        $sql->bindParam(":titulo", $titulo);
        $sql->bindParam(":descripcion", $descripcion);
        $sql->bindParam(":id", $id);
        $sql->execute();
    }

    public static function borrar($id)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("DELETE FROM tbl_servicios WHERE id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
    }
}
