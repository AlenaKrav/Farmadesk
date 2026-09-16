<?php
include_once('./models/Servicio.php');
include_once('./config/conexion.php');
require_once('./helpers/validaciones.php');

BD::crearInstancia();

class ServicioController{
    public function inicio()
    {
        $servicios = Servicio::consultar();
        if(!$servicios){
            $servicios=[];
        }
        include_once("./views/servicios/index.php");
    }

    public function crear(){
        $errores = [];
        if (isset($_POST['agregar'])) {
            if (isset($_POST['icono']) && isset($_POST['titulo']) && isset($_POST['descripcion'])) {
                $icono = $_POST['icono'];
                $titulo = $_POST['titulo'];
                $descripcion = $_POST['descripcion'];

                if (inputVacio($icono)) {
                    $errores['icono'] = "Debes incluir un icono de servicio";
                }

                if (inputVacio($titulo)) {
                    $errores['titulo'] = "Debes introducir un título de servicio";
                }

                if (inputVacio($descripcion)) {
                    $errores['descripcion'] = "Debes introducir una descripción de servicio";
                }


                if (empty($errores)) {
                Servicio::crear($icono, $titulo, $descripcion);
                header("Location: /farma/admin/servicios");
                exit();
                }
            }
        }
        include_once("./views/servicios/crear.php");
    }

    public function editar(){
        $errores = [];

        if (isset($_POST['actualizar'])) {
            if (isset($_POST['id']) && isset($_POST['icono']) && isset($_POST['titulo']) && isset($_POST['descripcion'])) {
                $id = $_POST['id'];
                $icono = $_POST['icono'];
                $titulo = $_POST['titulo'];
                $descripcion = $_POST['descripcion'];


                if (inputVacio($icono)) {
                    $errores['icono'] = "Debes incluir un icono de servicio";
                }

                if (inputVacio($titulo)) {
                    $errores['titulo'] = "Debes introducir un título de servicio";
                }

                if (inputVacio($descripcion)) {
                    $errores['descripcion'] = "Debes introducir una descripción de servicio";
                }

                if (empty($errores)) {
                Servicio::editar($id, $icono, $titulo, $descripcion);
                header("Location: /farma/admin/servicios");
                exit();
                }

            }
            
        }

        if(isset($_GET['id'])){
            $idBuscar=$_GET['id'];
            $servicio = Servicio::buscar($idBuscar);     
        }

        include_once("./views/servicios/editar.php");
    }
    
    public function borrar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Servicio::borrar($id);
        }
        header("Location: /farma/admin/servicios");
        exit();
    }

    public function activar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Servicio::activar($id);
        }
        header("Location: /farma/admin/servicios");
        exit();
    }

    public function desactivar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Servicio::desactivar($id);
        }
        header("Location: /farma/admin/servicios");
        exit();
    }

}
?>