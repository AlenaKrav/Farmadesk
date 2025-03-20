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
        //la asignacion a los atributos de la clase los valores pasados por el constructor
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->mensaje = $mensaje;
    }

    public static function consultar()
    {
        //creamos un array vacio donde vamos a almacenar todos los empleados
        $consultasFormulario = [];
        $conexion = BD::crearInstancia();
        //hacemos select de todos los empleados
        $sql = $conexion->prepare("SELECT * FROM tbl_formulario");
        $sql->execute();
        //nos traemos todos los empleados
        //iteramos sobre todos los empleados
        //como se nos devuelve un array asociativ
        //Cada fila es un array con claves que corresponden a los nombres de las columnas (id, nombre, correo).
        //foreach recorre cada fila y la guarda en $empleado
        foreach ($sql->fetchAll() as $consulta) {
            //por cada fila recorrida, se usa el constructor para crear un objeto con los datos de esa fila
            //agregamos ese objeto resultante, al arraya
            $consultasFormulario[] = new ConsultaFormulario(
                $consulta['id'],
                $consulta['nombre'],
                $consulta['email'],
                $consulta['telefono'],
                $consulta['mensaje'],

            );
        }
        return $consultasFormulario;
    }

    public static function crear($nombre, $email, $telefono, $mensaje)
    {
        $conexion = BD::crearInstancia();

        $sql = $conexion->prepare("INSERT INTO `tbl_formulario` (`ID`, `nombre`, `email`, `telefono`, `mensaje`)
        VALUES (NULL, :nombre, :email, :telefono, :mensaje);");


        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":email", $email);
        $sql->bindParam(":telefono", $telefono);
        $sql->bindParam(":mensaje", $mensaje);

        // //ejecutamos la query
        $sql->execute();
    }

    public static function borrar($id)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("DELETE FROM tbl_formulario WHERE id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
    }

}
