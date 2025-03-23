<?php

include_once('./models/Producto.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class ProductoController{

    public function inicio()
    {
        $productos = Producto::consultar();
        include_once("./views/productos/index.php");
    }


    public function crear()
    {
        $errores = [];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
            // Verificar si todos los campos están presentes y no están vacíos
            $imagen = $_FILES['imagen']['name'] ?? '';
            $titulo = trim($_POST['titulo'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
    
            if (empty($titulo)){
                $errores['titulo'] = "El titulo es obligatorio.";
            }

            if (empty($descripcion)){
                $errores['descripcion'] = "La descripcion es obligatoria.";
            }
    
    
            // Validar archivo de imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $allowed_types = ['image/jpeg', 'image/png']; // Tipos permitidos
                $max_size = 5 * 1024 * 1024; // 5MB
    
                $file_type = $_FILES['imagen']['type'];
                $file_size = $_FILES['imagen']['size'];
                $tmp_imagen = $_FILES['imagen']['tmp_name'];
    
                if (!in_array($file_type, $allowed_types)) {
                    $errores['imagen'] = "Solo se permiten imágenes en formato JPG o PNG";
                }
    
                if ($file_size > $max_size) {
                    $errores['imagen'] = "El tamaño de la imagen no debe superar los 5MB.";
                }
    
                // Si no hay errores, renombrar y mover imagen
                if (empty($errores['imagen'])) {
                    $fecha_imagen = new DateTime();
                    $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";
                    move_uploaded_file($tmp_imagen, "assets/img/products/" . $nombre_archivo_imagen);
                }
            } else {
                $errores['imagen'] = "Debes subir una imagen válida.";
            }
    
            // Si no hay errores, guardar en la base de datos
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
        
        if (isset($_POST['actualizar'])) {
            if (isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['descripcion'])) {
                $id = $_POST['id'];
                $titulo = $_POST['titulo'];
                $descripcion = $_POST['descripcion'];
            }

            //!!!cambio, obtenemos la img actual del registro
            if ($_FILES['imagen']['tmp_name'] == "") {
                // Usamos el método obtenerImagen() para obtener la imagen actual del registro
                $imagen = Producto::obtenerImagen($id);  // Este método obtiene la imagen actual
            } else {
                // Si hay una nueva imagen, la procesamos como antes
                $imagen = $_FILES['imagen']['name'];
                $fecha_imagen = new DateTime();
                $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;
    
                // Movemos el archivo a la carpeta correspondiente
                move_uploaded_file($_FILES['imagen']['tmp_name'], "assets/img/products/" . $nombre_archivo_imagen);
                $imagen = $nombre_archivo_imagen;
            } 
            

            Producto::editar($id, $imagen, $titulo, $descripcion);
            header("Location: /farma/admin/productos");
            exit();
        }

        if (isset($_GET['id'])) {
            $idBuscar = $_GET['id'];
            $producto = Producto::buscar($idBuscar);
        }
        // $usuario = Usuario::buscar(1);
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