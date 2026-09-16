<?php
class Usuario
{

    public $id;
    public $nombre;
    public $apellidos;
    public $usuario;
    public $password;
    public $correo;
    public $role_id;
    public $role_nombre;
    public $id_paciente;

    public function __construct($id, $nombre, $apellidos, $usuario, $password, $correo, $role_id, $id_paciente)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->correo = $correo;
        $this->role_id = $role_id;
        $this->id_paciente = $id_paciente;
    }

    public function __set($name, $value)
    {
        if ($name == 'role_nombre') {
            $this->role_nombre = $value;
        }
    }

    public static function existeNuevoValor($campo, $valor)
    {
        try {
            $conexion = BD::crearInstancia();
            $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE $campo=:valor");
            $sentencia->bindParam(":valor", $valor);
            $sentencia->execute();
            return $sentencia->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Error al comprobar la existencia del valor $valor en la base de datos " . $e->getMessage();
            return false;
        }
    }

    public static function crear($nombre, $apellidos, $usuario, $password, $correo, $role_id, $id_paciente)
    {

        if (self::existeNuevoValor('usuario', $usuario)) {
            return ['error' => true, 'campo' => 'usuario', 'mensaje' => 'Ya existe un usuario con este alias'];
        }
        if (self::existeNuevoValor('correo', $correo)) {
            return ['error' => true, 'campo' => 'correo', 'mensaje' => 'Ya existe un usuario con este correo'];
        }

        try {
            $conexion = BD::crearInstancia();
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sentencia = $conexion->prepare("INSERT INTO `tbl_usuarios`(`ID`, `nombre`, `apellidos`,`usuario`, `password`, `correo`, `role_id`, `id_paciente`) VALUES (NULL, :nombre, :apellidos, :usuario, :password, :correo, :role_id, :id_paciente);");

            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":apellidos", $apellidos);
            $sentencia->bindParam(":usuario", $usuario);
            $sentencia->bindParam(":password", $passwordHash);
            $sentencia->bindParam(":correo", $correo);
            $sentencia->bindParam(":role_id", $role_id);
            $sentencia->bindParam(":id_paciente", $id_paciente);

            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al crear un usuario " . $e->getMessage();
            return null;
        }
    }

    public static function consultar()
    {
        $listaUsuarios = [];
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT u.ID, u.nombre, u.apellidos, u.usuario, u.password, u.correo, u.role_id, r.nombre AS role_nombre, u.id_paciente
                                FROM tbl_usuarios u
                                JOIN roles r ON u.role_id = r.id");
            $sql->execute();
            foreach ($sql->fetchAll() as $usuario) {
                $nuevoUsuario = new Usuario($usuario['ID'], $usuario['nombre'], $usuario['apellidos'], $usuario['usuario'], $usuario['password'], $usuario['correo'], $usuario['role_id'], $usuario['id_paciente']);
                $nuevoUsuario->role_nombre = $usuario['role_nombre'];
                $listaUsuarios[] = $nuevoUsuario;
            }
            return $listaUsuarios;
        } catch (PDOException $e) {
            echo "Error al mostrar los usuarios " . $e->getMessage();
            return null;
        }
    }


    public static function buscar($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE ID=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            $usuario = $sql->fetch();
            return new Usuario($usuario['ID'], $usuario['nombre'], $usuario['apellidos'], $usuario['usuario'], $usuario['password'], $usuario['correo'], $usuario['role_id'], $usuario['id_paciente']);
        } catch (PDOException $e) {
            echo "Error al buscar el usuario con ID $id " . $e->getMessage();
            return null;
        }
    }

    public static function existeAntiguoValor($campo, $valor, $id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE $campo=:valor AND ID != :id");
            $sentencia->bindParam(":valor", $valor);
            $sentencia->bindParam(":id", $id);
            $sentencia->execute();
            return $sentencia->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Error al comprobar la existencia del valor $valor en la base de datos " . $e->getMessage();
            return false;
        }
    }

    public static function editar($id, $nombre, $apellidos, $usuario, $password, $correo, $role_id, $id_paciente)
    {

        if (self::existeAntiguoValor('usuario', $usuario, $id)) {
            return ['error' => true, 'campo' => 'usuario', 'mensaje' => 'Ya existe un usuario con este alias'];
        }

        if (self::existeAntiguoValor('correo', $correo, $id)) {
            return ['error' => true, 'campo' => 'correo', 'mensaje' => 'Ya existe un usuario con este correo'];
        }

        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("UPDATE tbl_usuarios SET nombre=:nombre, apellidos=:apellidos, usuario=:usuario, password=:password, correo=:correo, role_id=:role_id, id_paciente=:id_paciente WHERE id=:id");
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":apellidos", $apellidos);
            $sql->bindParam(":usuario", $usuario);
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql->bindParam(":password", $passwordHash);
            $sql->bindParam(":correo", $correo);
            $sql->bindParam(":role_id", $role_id);
            $sql->bindParam(":id_paciente", $id_paciente);
            $sql->bindParam(":id", $id);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al editar el usuario con ID $id " . $e->getMessage();
            return null;
        }
    }

    public static function borrar($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("DELETE FROM tbl_usuarios WHERE ID=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al borrar el usuario con ID $id " . $e->getMessage();
            return null;
        }
    }
}
?>