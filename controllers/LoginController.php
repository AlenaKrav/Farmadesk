<?php
include_once('./models/Admin.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class LoginController{
    
    public function login(){
        session_start();
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if (isset($_POST['entrar'])) {
                if (isset($_POST['usuario']) && isset($_POST['password'])) {
                    $usuario = $_POST['usuario'];
                    $password = $_POST['password'];

                    //verificar si existe un usuario
                    $auth = Admin::existeUser($usuario);
                    //si no existe
                    if(!$auth){
                        echo "No existe ese usuario";
                    }
                    //si existe, verificamos su contraseña
                    else{
                        //si
                        print_r($auth);
                        echo "User existe";
                        if($auth->verificarPassword($password)){
                            var_dump($auth->verificarPassword($password));

                        }
                        }

                    }



                }
        }

        include_once("./views/auth/login.php");
    




    }


    public function cerrarSesion(){
        echo "Desde logout";
        session_destroy();
        unset($_SESSION['usuario']);
        // header("Location:./login.php")
        header("Location: ../login.php");
        exit();

    }
}


?>