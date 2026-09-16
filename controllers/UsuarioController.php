<?php
include_once('./models/Usuario.php');
include_once('./config/conexion.php');
require_once('./helpers/validaciones.php');

BD::crearInstancia();


class UsuarioController
{
    public function inicio()
    {
        $usuarios = Usuario::consultar();
        if(!$usuarios){
            $usuarios = [];
        }
        include_once("./views/usuarios/index.php");
    }

    public function crear()
    {
        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
            if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['correo']) && isset($_POST['role_id']) && isset($_POST['id_paciente'])) {
                $nombre = trim($_POST['nombre'] ?? '');
                $apellidos = trim($_POST['apellidos'] ?? '');
                $usuario = trim($_POST['usuario'] ?? '');
                $password = trim($_POST['password'] ?? '');
                $correo = trim($_POST['correo'] ?? '');
                $role_id = trim($_POST['role_id'] ?? '');

                if (inputVacio($nombre)) {
                    $errores['nombre'] = "Debes introducir un nombre de usuario";
                }else if (!validarCadena($nombre)) {
                    $errores['nombre'] = "El nombre solo puede contener letras";
                }

                if (inputVacio($apellidos)) {
                    $errores['apellidos'] = "Debes introducir un apellido de usuario";
                }else if (!validarCadena($apellidos)) {
                    $errores['apellidos'] = "El apellido solo puede contener letras";
                }

                if (inputVacio($usuario)) {
                    $errores['usuario'] = "Debes introducir un alias";
                } else if (!validarUsuario($usuario)) {
                    $errores['usuario'] = "El alias solo puede contener letras y '_'";
                }

                if (inputVacio($password)) {
                    $errores['password'] = "Debes introducir una contraseña";
                } else if (!validarContrasena($password)) {
                    $errores['password'] = "La contraseña debe tener 8 carácteres";
                }

                if (inputVacio($correo)) {
                    $errores['correo'] = "Debes introducir un correo electrónico";
                } else if (!validarCorreo($correo)) {
                    $errores['correo'] = "Formato inválido de correo electrónico";
                }

                if ($role_id == '3' && isset($_POST['id_paciente'])) {
                    $id_paciente = $_POST['id_paciente'];

                    if(inputVacio($id_paciente)){
                        $errores['id_paciente'] = "Debes seleccionar un paciente escribiendo su nombre y eligiendo una opción";
                    }
                } else {
                    $id_paciente = NULL;
                }

                if (empty($errores)){
                $user = Usuario::crear($nombre, $apellidos, $usuario, $password, $correo, $role_id, $id_paciente);
                if($user['error']){
                    $errores[$user['campo']] = $user['mensaje'];
                }else{
                header("Location: /farma/admin/usuarios");
                exit();
                }
            }
        }
    }
        include_once("./views/usuarios/crear.php");
    }

    public function editar(){
        $errores = [];
        if(isset($_POST['actualizar'])){
            if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['correo']) && isset($_POST['role_id'])) {
                $id=trim($_POST['id'] ?? '');
                $nombre = trim($_POST['nombre'] ?? '');
                $apellidos = trim($_POST['apellidos'] ?? '');
                $usuario = trim($_POST['usuario'] ?? '');
                $password = trim($_POST['password'] ?? '');
                $correo = trim($_POST['correo']?? '');
                $role_id = trim($_POST['role_id']?? '');

                if (inputVacio($nombre)) {
                    $errores['nombre'] = "Debes introducir un nombre de usuario";
                }

                if (!validarCadena($nombre)) {
                    $errores['nombre'] = "El nombre solo puede contener letras";
                }

                if (inputVacio($apellidos)) {
                    $errores['apellidos'] = "Debes introducir un apellido de usuario";
                }

                if (!validarCadena($apellidos)) {
                    $errores['apellidos'] = "El apellido solo puede contener letras";
                }

                if (inputVacio($usuario)) {
                    $errores['usuario'] = "Debes introducir un alias";
                } else if (!validarUsuario($usuario)) {
                    $errores['usuario'] = "El alias solo puede contener letras y '_'";
                }

                if (inputVacio($password)) {
                    $errores['password'] = "Debes introducir una contraseña";
                } else if (!validarContrasena($password)) {
                    $errores['password'] = "La contraseña debe tener 8 carácteres";
                }

                if (inputVacio($correo)) {
                    $errores['correo'] = "Debes introducir un correo electrónico";
                } else if (!validarCorreo($correo)) {
                    $errores['correo'] = "Formato inválido de correo electrónico";
                }

                if ($role_id == '3' && isset($_POST['id_paciente'])) {
                    $id_paciente = $_POST['id_paciente'];

                    if(inputVacio($id_paciente)){
                        $errores['id_paciente'] = "Debes seleccionar un paciente escribiendo su nombre y eligiendo una opción";
                    }
                }
                else{
                    $id_paciente = NULL;
                }
                if (empty($errores)){
                $user = Usuario::editar($id,$nombre, $apellidos,$usuario,$password,$correo,$role_id,$id_paciente);
                if($user['error']){
                    $errores[$user['campo']] = $user['mensaje'];
                }else{
                header("Location: /farma/admin/usuarios");
                exit();
                }
            }
        }
    }
    if(isset($_GET['id'])){
        $idBuscar=$_GET['id'];
        $usuario = Usuario::buscar($idBuscar);     
    }
    include_once("./views/usuarios/editar.php");

}

    public function borrar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Usuario::borrar($id);
        }
        header("Location: /farma/admin/usuarios");
        exit();
    }
}
