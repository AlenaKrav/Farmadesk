<?php
include_once('./models/Admin.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class LoginController
{

    public function login()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['entrar'])) {
                if (isset($_POST['usuario']) && isset($_POST['password'])) {
                    $usuario = $_POST['usuario'];
                    $password = $_POST['password'];

                    //verificar si existe un usuario
                    $auth = Admin::existeUser($usuario);
                    //si no existe
                    if (!$auth) {
                        echo "No existe este usuario";
                    }
                    //si existe, verificamos su contraseña
                    else {
                        //si
                        print_r($auth);
                        echo "User existe";
                        if ($auth->verificarPassword($password)) {
                            var_dump($auth->verificarPassword($password));
                            $_SESSION['login'] = true;
                            $_SESSION['user_id'] = $auth->id;
                            $_SESSION['usuario'] = $auth->usuario;
                            $_SESSION['role_id'] = $auth->role_id;
                            $_SESSION['id_paciente'] = $auth->id_paciente;

                            $this->redirigirPorRol($auth->role_id);
                        } else {
                            echo "Contraseña incorrecta";
                        }
                    }
                }else{
                    echo "Debes introducir user o password";
                }

            }
        }

        include_once("./views/auth/login.php");
    }


    private function redirigirPorRol($role_id){
        if($role_id==1){
            echo "Eres admin";
            header("Location: /farma/views/dashboard/admin.php");

        }
        elseif ($role_id==3) {
            header("Location: /farma/views/dashboard/paciente.php");
        }
    }

    public function cerrarSesion()
    {
        echo "Desde logout";
        session_destroy();
        unset($_SESSION['login']);
        header("Location: /farma/login");
        exit();
    }
}
