<?php

include_once('./models/Producto.php');
include_once('./config/conexion.php');
require_once('./helpers/validaciones.php');

BD::crearInstancia();

class ProductoController{

    public function inicio()
    {
        $productos = Producto::consultar();
        if(!$productos){
            $productos=[];
        }
        include_once("./views/productos/index.php");
    }


    public function crear()
    {
        $errores = [];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
            $imagen = trim($_FILES['imagen']['name'] ?? '');
            $titulo = trim($_POST['titulo'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
    
            if (inputVacio($titulo)) {
                $errores['titulo'] = "Debes introducir un nombre de producto";
            }
    
            if (empty($descripcion)) {
                $errores['descripcion'] = "Debes introducir una descripción de producto";
            }
    
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $allowed_types = ['image/jpeg', 'image/png'];
                $max_size = 5 * 1024 * 1024;
    
                $file_type = $_FILES['imagen']['type'];
                $file_size = $_FILES['imagen']['size'];
                $tmp_imagen = $_FILES['imagen']['tmp_name'];
    
                if (!in_array($file_type, $allowed_types)) {
                    $errores['imagen'] = "Solo se permiten imágenes en formato JPG o PNG";
                }
    
                if ($file_size > $max_size) {
                    $errores['imagen'] = "El tamaño de la imagen no debe superar los 5MB.";
                }
    
                if (empty($errores['imagen'])) {
                    $fecha_imagen = new DateTime();
                    $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";
                    move_uploaded_file($tmp_imagen, "assets/img/products/" . $nombre_archivo_imagen);
                }
            } else {
                $errores['imagen'] = "Debes subir una imagen válida";
            }
    
            if (empty($errores)) {
                Producto::crear($nombre_archivo_imagen, $titulo, $descripcion);
                header("Location: /farma/admin/productos");
                exit();
            }
        }
        include_once("./views/productos/crear.php");
    }
    
    public function editar()
    {
        $errores = [];
        
        if (isset($_POST['actualizar'])) {
            if (isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['descripcion'])) {
                $id = $_POST['id'];
                $titulo = trim($_POST['titulo'] ?? '');
                $descripcion = trim($_POST['descripcion'] ?? '');

                if (inputVacio($titulo)) {
                    $errores['titulo'] = "Debes introducir un nombre de producto";
                }

                if (empty($descripcion)) {
                    $errores['descripcion'] = "Debes introducir una descripción de producto";
                }

            }

            if ($_FILES['imagen']['tmp_name'] == "") {
                $imagen = Producto::obtenerImagen($id);
            } else {
                $imagen = $_FILES['imagen']['name'];

                $allowed_types = ['image/jpeg', 'image/png'];
                $max_size = 5 * 1024 * 1024;
                $file_type = $_FILES['imagen']['type'];
                $file_size = $_FILES['imagen']['size'];
                $tmp_imagen = $_FILES['imagen']['tmp_name'];


                if (!in_array($file_type, $allowed_types)) {
                    $errores['imagen'] = "Solo se permiten imágenes en formato JPG o PNG";
                }

                if ($file_size > $max_size) {
                    $errores['imagen'] = "El tamaño de la imagen no debe superar los 5MB";
                }

                if (empty($errores['imagen'])){
                $fecha_imagen = new DateTime();
                $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;
    
                move_uploaded_file($tmp_imagen, "assets/img/products/" . $nombre_archivo_imagen);
                $imagen = $nombre_archivo_imagen;
                }
            } 
            
            if (empty($errores)){
            Producto::editar($id, $imagen, $titulo, $descripcion);
            header("Location: /farma/admin/productos");
            exit();
            }
        }

        if (isset($_GET['id'])) {
            $idBuscar = $_GET['id'];
            $producto = Producto::buscar($idBuscar);
        }
        include_once("./views/productos/editar.php");
    }

    public function borrar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Producto::borrar($id);
        }
        header("Location: /farma/admin/productos");
        exit();
    }

    public function activar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Producto::activar($id);
        }
        header("Location: /farma/admin/productos");
        exit();
    }


    public function desactivar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Producto::desactivar($id);
        }
        header("Location: /farma/admin/productos");
        exit();
    }

}


?>