<?php
include_once('./models/Admin.php');
include_once('./config/conexion.php');


BD::crearInstancia();

class LoginController
{
    public function login()
    {
        $mensajes = [];
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['entrar'])) {
                if (isset($_POST['usuario']) && isset($_POST['password'])) {
                    $usuario = $_POST['usuario'] ?? '';
                    $password = $_POST['password'] ?? '';

                    if (empty($usuario)) {
                        $mensajes[] = "Debes introducir el usuario";
                    } else {
                        $auth = Admin::existeUser($usuario);
                        if (!$auth) {
                            $mensajes[] = "Usuario no existe";
                        } else {

                            if (empty($password)) {
                                $mensajes[] = "Debes introducir la contraseña";
                            } else {
                                if ($auth->verificarPassword($password)) {
                                    $_SESSION['login'] = true;
                                    $_SESSION['user_id'] = $auth->id;
                                    $_SESSION['nombre'] = $auth->nombre;
                                    $_SESSION['apellidos'] = $auth->apellidos;
                                    $_SESSION['usuario'] = $auth->usuario;
                                    $_SESSION['correo'] = $auth->correo;
                                    $_SESSION['role_id'] = $auth->role_id;
                                    $_SESSION['id_paciente'] = $auth->id_paciente;

                                    $this->redirigirPorRol($auth->role_id);
                                } else {
                                    $mensajes[] = "Contraseña incorrecta";
                                }
                            }
                        }
                    }
                }
            }
        }

        include_once("./views/auth/login.php");
    }


    private function redirigirPorRol($role_id)
    {
        if ($role_id == 1) {
            header("Location: /farma/views/dashboard/admin.php");
            exit();
        } elseif ($role_id == 3) {
            header("Location: /farma/views/dashboard/paciente.php");
            exit();
        }
    }

    public function cerrarSesion()
    {
        session_destroy();
        unset($_SESSION['login']);
        header("Location: /farma/login");
        exit();
    }
}
?>
