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
        $listaPacientes = [];
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT * FROM tbl_pacientes");
            $sql->execute();
            foreach ($sql->fetchAll() as $paciente) {
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
        } catch (PDOException $e) {
            echo "Error al mostrar los pacientes " . $e->getMessage();
            return null;
        }
    }

    public static function existeNuevoValor($campo, $valor)
    {
        try {
            $conexion = BD::crearInstancia();
            $sentencia = $conexion->prepare("SELECT * FROM `tbl_pacientes` WHERE $campo=:valor");
            $sentencia->bindParam(":valor", $valor);
            $sentencia->execute();
            return $sentencia->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Error al comprobar la existencia del valor $valor " . $e->getMessage();
            return false;
        }
    }


    public static function crear($nombre, $apellidos, $dni, $fecha_nacimiento, $correo, $telefono, $direccion, $cip_aut)
    {
        if (self::existeNuevoValor('dni', $dni)) {
            return ['error' => true, 'campo' => 'dni', 'mensaje' => 'Ya existe un paciente con ese DNI'];
        }

        if (self::existeNuevoValor('cip_aut', $cip_aut)) {
            return ['error' => true, 'campo' => 'cip_aut', 'mensaje' => 'Ya existe un paciente con ese CIP_AUT'];
        }
        try {
            $conexion = BD::crearInstancia();
            $sentencia = $conexion->prepare("INSERT INTO `tbl_pacientes`(`id_paciente`, `nombre`, `apellidos`, `dni`, `fecha_nacimiento`, `correo`, `telefono`, `direccion`, `cip_aut`) 
            VALUES (NULL, :nombre, :apellidos, :dni, :fecha_nacimiento, :correo, :telefono, :direccion, :cip_aut);");

            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":apellidos", $apellidos);
            $sentencia->bindParam(":dni", $dni);
            $sentencia->bindParam(":fecha_nacimiento", $fecha_nacimiento);
            $sentencia->bindParam(":correo", $correo);
            $sentencia->bindParam(":telefono", $telefono);
            $sentencia->bindParam(":direccion", $direccion);
            $sentencia->bindParam(":cip_aut", $cip_aut);

            if ($sentencia->execute()) {
                return ['error' => false];
            } else {
                return ['error' => true, 'mensaje' => 'Error al crear el paciente.'];
            }
        } catch (PDOException $e) {
            echo "Error al crear el paciente " . $e->getMessage();
            return null;
        }
    }

    public static function buscar($id)
    {
        try {
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
        } catch (PDOException $e) {
            echo "Error al buscar el paciente con el ID $id " . $e->getMessage();
            return null;
        }
    }

    public static function borrar($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("DELETE FROM tbl_pacientes WHERE id_paciente=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al borrar el paciente con el ID $id " . $e->getMessage();
            return null;
        }
    }

    public static function existeAntiguoValor($campo, $valor, $id_paciente)
    {
        try {
            $conexion = BD::crearInstancia();
            $sentencia = $conexion->prepare("SELECT * FROM `tbl_pacientes` WHERE $campo=:valor AND id_paciente != :id_paciente");
            $sentencia->bindParam(":valor", $valor);
            $sentencia->bindParam(":id_paciente", $id_paciente);
            $sentencia->execute();
            return $sentencia->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Error al comprobar la existencia del valor $valor " . $e->getMessage();
            return false;
        }
    }

    public static function editar($id_paciente, $nombre, $apellidos, $dni, $fecha_nacimiento, $correo, $telefono, $direccion, $cip_aut)
    {
        if (self::existeAntiguoValor('dni', $dni, $id_paciente)) {
            return ['error' => true, 'campo' => 'dni', 'mensaje' => 'Ya existe un paciente con ese DNI'];
        }

        if (self::existeAntiguoValor('cip_aut', $cip_aut, $id_paciente)) {
            return ['error' => true, 'campo' => 'cip_aut', 'mensaje' => 'Ya existe un paciente con ese CIP_AUT'];
        }
        try {
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

            $sql->execute();
            return ['error' => false];
        } catch (PDOException $e) {
            echo "Error al comprobar al editar el paciente con el $id_paciente " . $e->getMessage();
            return null;
        }
    }


    public static function sugerencias($term)
    {
        try {
            $listaSugerencias = [];
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT id_paciente, CONCAT(nombre, ' ', apellidos) AS nombre_completo FROM `tbl_pacientes` WHERE nombre LIKE :term OR apellidos LIKE :term");
            $sql->execute([':term' => "%$term%"]);
            $listaSugerencias = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $listaSugerencias;
        } catch (PDOException $e) {
            echo "Error al buscar sugerencias " . $e->getMessage();
            return null;
        }
    }
}
?>