<?php
class Admin{

    public $id;
    public $usuario;
    public $password;
    public $correo;
    public $role_id;
    public $id_paciente;

    public function __construct($id, $usuario, $password, $correo, $role_id, $id_paciente)
    {
     $this->id=$id;
     $this->usuario=$usuario;
     $this->password=$password;
     $this->correo=$correo;
     $this->role_id=$role_id;
     $this->id_paciente=$id_paciente;
    }

    // public static function verificarUser($usuario){
    //     $conexion = BD::crearInstancia();
    //     $sql = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE usuario = :usuario");
    //     $sql->bindParam(":usuario",$usuario);
    //     $sql->execute();
    //     $user= $sql->fetch(PDO::FETCH_LAZY);
    //     return $user;

    // }

    public static function existeUser($usuario) {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE usuario = :usuario");
        $sql->bindParam(":usuario", $usuario);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return new Admin(
                $user['ID'],
                $user['usuario'],
                $user['password'], 
                $user['correo'],
                $user['role_id'],
                $user['id_paciente']
            );
        }
        return null; // Retorna null si el usuario no existe
    }

    public function verificarPassword($password) {
        return password_verify($password, $this->password);
    }
}



?>