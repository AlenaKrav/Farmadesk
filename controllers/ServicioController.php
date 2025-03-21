<?php
include_once('./models/Servicio.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class ServicioController{
    public function inicio()
    {
        //OJO ES UN ARRAY DE OBJETOS
        $servicio = Servicio::consultar();
        
        if ($servicio) {
            echo "Tenemos servicios";
        } else {
            echo "No tenemos servicios";
        }
        include_once("./views/servicios/index.php");
    }

    public function mostrarActivos(){
        $serviciosActivos = Servicio::mostrarActivos();
        include_once("./views/secciones/servicios.php");
    }

    public function crear(){
        if (isset($_POST['agregar'])) {
            if (isset($_POST['icono']) && isset($_POST['titulo']) && isset($_POST['descripcion'])) {
                $icono = $_POST['icono'];
                $titulo = $_POST['titulo'];
                $descripcion = $_POST['descripcion'];

                Servicio::crear($icono, $titulo, $descripcion);
                header("Location: /farma/admin/servicios");
                exit();
            }
        }
        include_once("./views/servicios/crear.php");
    }

    public function editar(){
        if (isset($_POST['actualizar'])) {
            if (isset($_POST['id']) && isset($_POST['icono']) && isset($_POST['titulo']) && isset($_POST['descripcion'])) {
                $id = $_POST['id'];
                $icono = $_POST['icono'];
                $titulo = $_POST['titulo'];
                $descripcion = $_POST['descripcion'];
            }
            Servicio::editar($id, $icono, $titulo, $descripcion);
                header("Location: /farma/admin/servicios");
                exit();
        }

        if(isset($_GET['id'])){
            $idBuscar=$_GET['id'];
            $servicio = Servicio::buscar($idBuscar);     
        }
        // $usuario = Usuario::buscar(1);
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