<?php
class Paciente
{
    public $id_paciente;
    public $nombre;
    public $apellidos;
    public $dni;
    public $fecha_nacimiento;
    public $correo;
    public $telefono;
    public $direccion;
    public $cip_aut;


    public function __construct($id_paciente, $nombre, $apellidos, $dni, $fecha_nacimiento, $correo, $telefono, $direccion, $cip_aut)
    {
        //la asignacion a los atributos de la clase los valores pasados por el constructor
        $this->id_paciente = $id_paciente;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->dni = $dni;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->cip_aut = $cip_aut;
    }



    public static function consultar()
    {
        //creamos un array vacio donde vamos a almacenar todos los empleados
        $listaPacientes = [];
        $conexion = BD::crearInstancia();
        //hacemos select de todos los empleados
        $sql = $conexion->prepare("SELECT * FROM tbl_pacientes");
        $sql->execute();
        //nos traemos todos los empleados
        //iteramos sobre todos los empleados
        //como se nos devuelve un array asociativ
        //Cada fila es un array con claves que corresponden a los nombres de las columnas (id, nombre, correo).
        //foreach recorre cada fila y la guarda en $empleado
        foreach ($sql->fetchAll() as $paciente) {
            //por cada fila recorrida, se usa el constructor para crear un objeto con los datos de esa fila
            //agregamos ese objeto resultante, al arraya
            $listaPacientes[] = new Paciente(
                $paciente['id_paciente'],
                $paciente['nombre'],
                $paciente['apellidos'],
                $paciente['dni'],
                $paciente['fecha_nacimiento'],
                $paciente['correo'],
                $paciente['telefono'],
                $paciente['direccion'],
                $paciente['cip_aut']
            );
        }
        return $listaPacientes;
    }



    public static function crear($nombre, $apellidos, $dni, $fecha_nacimiento, $correo, $telefono, $direccion, $cip_aut)
    {
        $conexion = BD::crearInstancia();
        $sentencia = $conexion->prepare("SELECT * FROM `tbl_pacientes` WHERE dni=:dni OR cip_aut=:cip_aut");
        $sentencia->bindParam(":dni", $dni);
        $sentencia->bindParam(":cip_aut", $cip_aut);
        $sentencia->execute();


        if ($sentencia->rowCount() > 0) {
            return "Error: Ya existe un paciente con ese DNI o CIP_AUT.";
        } else {
            //creamos la query
            $sentencia = $conexion->prepare("INSERT INTO `tbl_pacientes`(`id_paciente`, `nombre`, `apellidos`, `dni`, `fecha_nacimiento`, `correo`, `telefono`, `direccion`, `cip_aut`) 
            VALUES (NULL, :nombre, :apellidos, :dni, :fecha_nacimiento, :correo, :telefono, :direccion, :cip_aut);");


            //se reemplaza la palabra por el valor de la variable
            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":apellidos", $apellidos);
            $sentencia->bindParam(":dni", $dni);
            $sentencia->bindParam(":fecha_nacimiento", $fecha_nacimiento);
            $sentencia->bindParam(":correo", $correo);
            $sentencia->bindParam(":telefono", $telefono);
            $sentencia->bindParam(":direccion", $direccion);
            $sentencia->bindParam(":cip_aut", $cip_aut);

            //ejecutamos la query
            $sentencia->execute();
            // header("Location: index.php");
            return "Paciente añadido con éxito.";
        }
    }

    public static function buscar($id)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("SELECT * FROM tbl_pacientes WHERE id_paciente=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        $paciente = $sql->fetch();
        return new Paciente(
            $paciente['id_paciente'],
            $paciente['nombre'],
            $paciente['apellidos'],
            $paciente['dni'],
            $paciente['fecha_nacimiento'],
            $paciente['correo'],
            $paciente['telefono'],
            $paciente['direccion'],
            $paciente['cip_aut']
        );
    }

    public static function borrar($id)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("DELETE FROM tbl_pacientes WHERE id_paciente=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
    }

    public static function editar($id_paciente, $nombre, $apellidos, $dni, $fecha_nacimiento, $correo, $telefono, $direccion, $cip_aut)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("UPDATE tbl_pacientes SET nombre=:nombre, apellidos=:apellidos, dni=:dni, fecha_nacimiento=:fecha_nacimiento, correo=:correo, telefono=:telefono, direccion=:direccion, cip_aut=:cip_aut WHERE id_paciente=:id_paciente");
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":apellidos", $apellidos);
        $sql->bindParam(":dni", $dni);
        $sql->bindParam(":fecha_nacimiento", $fecha_nacimiento);
        $sql->bindParam(":correo", $correo);
        $sql->bindParam(":telefono", $telefono);
        $sql->bindParam(":direccion", $direccion);
        $sql->bindParam(":cip_aut", $cip_aut);
        $sql->bindParam(":id_paciente", $id_paciente,);

        //ejecutamos la query
        $sql->execute();
        return "Paciente modificado con éxito.";
    }


    public static function sugerencias($term)
    {
        $listaSugerencias = [];
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("SELECT id_paciente, CONCAT(nombre, ' ', apellidos) AS nombre_completo FROM `tbl_pacientes` WHERE nombre LIKE :term OR apellidos LIKE :term");
        $sql->execute([':term' => "%$term%"]);
        $listaSugerencias = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $listaSugerencias;
    }
}
