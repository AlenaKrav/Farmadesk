<?php
class Admin
{

    public $id;
    public $usuario;
    public $password;
    public $correo;
    public $role_id;
    public $id_paciente;
    public $nombre;
    public $apellidos;

    public function __construct($id, $nombre, $apellidos, $usuario, $password, $correo, $role_id, $id_paciente)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->correo = $correo;
        $this->role_id = $role_id;
        $this->id_paciente = $id_paciente;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
    }

    public static function existeUser($usuario)
    {
        try {
            $conexion = BD::crearInstancia();

            $sql = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE usuario = :usuario");
            $sql->bindParam(":usuario", $usuario);
            $sql->execute();
            $user = $sql->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return new Admin(
                    $user['ID'],
                    $user['nombre'],
                    $user['apellidos'],
                    $user['usuario'],
                    $user['password'],
                    $user['correo'],
                    $user['role_id'],
                    $user['id_paciente']
                );
            }
            return null;
        } catch (PDOException $e) {
            echo "Error al comprobar el usuario" . $e->getMessage();
        }
    }


    public function verificarPassword($password)
    {
        return password_verify($password, $this->password);
    }
}
?>