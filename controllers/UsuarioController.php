<?php
include_once('./models/Usuario.php');
include_once('./config/conexion.php');

BD::crearInstancia();


class UsuarioController{
    public function inicio(){
        //OJO ES UN ARRAY DE OBJETOS
        $usuarios= Usuario::consultar();
        if($usuarios){
            echo "Tenemos users";
        }
        else{
            echo "No tenemos users";
        }
        include_once("./views/usuarios/inicio.php");
    }

    public function crear(){
        if (isset($_POST['agregar'])) {
            if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['correo'])&& isset($_POST['role_id'])&& isset($_POST['id_paciente'])) {
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $usuario = $_POST['usuario'];
                $password = $_POST['password'];
                $correo = $_POST['correo'];
                $role_id = $_POST['role_id'];

            if ($role_id == '3' && isset($_POST['id_paciente'])) {
                $id_paciente = $_POST['id_paciente'];
            }
            else{
                $id_paciente = NULL;
            }
            Usuario::crear($nombre, $apellidos, $usuario,$password,$correo,$role_id,$id_paciente);
            header("Location: /farma/admin/usuarios");
                exit();
        }
        
                if(empty($nombre) || empty($apellidos) || empty($usuario) || empty($password) || empty($correo) || empty($role_id) ){
                    echo "Rellena todos los campos";
                }
            }
        include_once("./views/usuarios/crear.php");

    }

    public function editar(){
        if(isset($_POST['actualizar'])){
            if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['correo'])&& isset($_POST['role_id']) && isset($_POST['id_paciente'])) {
                $id=$_POST['id'];
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $usuario = $_POST['usuario'];
                $password = $_POST['password'];
                $correo = $_POST['correo'];
                $role_id = $_POST['role_id'];


                if ($role_id == '3' && isset($_POST['id_paciente'])) {
                    $id_paciente = $_POST['id_paciente'];
                }
                else{
                    $id_paciente = NULL;
                }
                Usuario::editar($id,$nombre, $apellidos,$usuario,$password,$correo,$role_id,$id_paciente);
                header("Location: /farma/admin/usuarios");
                exit();
        }
    }
    if(isset($_GET['id'])){
        $idBuscar=$_GET['id'];
        $usuario = Usuario::buscar($idBuscar);     
    }
    // $usuario = Usuario::buscar(1);
    include_once("./views/usuarios/editar.php");

}


    public function borrar(){
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            Usuario::borrar($id);
        }
        header("Location: /farma/admin/usuarios");
        exit();
    }

    

}


?>