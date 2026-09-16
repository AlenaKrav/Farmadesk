<?php

class ConsultaFormulario
{
    public $id;
    public $nombre;
    public $email;
    public $telefono;
    public $mensaje;


    public function __construct($id, $nombre, $email, $telefono, $mensaje)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->mensaje = $mensaje;
    }

    public static function consultar()
    {
        $consultasFormulario = [];
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT * FROM tbl_formulario");
            $sql->execute();
            foreach ($sql->fetchAll() as $consulta) {
                $consultasFormulario[] = new ConsultaFormulario(
                    $consulta['id'],
                    $consulta['nombre'],
                    $consulta['email'],
                    $consulta['telefono'],
                    $consulta['mensaje'],

                );
            }
            return $consultasFormulario;
        } catch (PDOException $e) {
            echo "Error al obtener las consultas " . $e->getMessage();
            return null;
        }
    }

    public static function crear($nombre, $email, $telefono, $mensaje)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("INSERT INTO `tbl_formulario` (`ID`, `nombre`, `email`, `telefono`, `mensaje`)
        VALUES (NULL, :nombre, :email, :telefono, :mensaje);");


            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":email", $email);
            $sql->bindParam(":telefono", $telefono);
            $sql->bindParam(":mensaje", $mensaje);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al crear la consulta " . $e->getMessage();
        }
    }

    public static function borrar($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("DELETE FROM tbl_formulario WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al borrar la consulta " . $e->getMessage();
        }
    }
}
?>