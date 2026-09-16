<?php
include_once('./models/Admin.php');
include_once('./config/conexion.php');


BD::crearInstancia();

class TestControllers
{
    public function procesarLogin($usuario, $password)
    {
        $auth = Admin::existeUser($usuario);

        if (!$auth) {
            return "Usuario no existe";
        }

        if (!$auth->verificarPassword($password)) {
            return "Contraseña incorrecta";
        }

        return [
            "login" => true,
            "usuario" => $auth->usuario
        ];
    }
}
?>