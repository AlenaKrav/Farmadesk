<?php
class Producto
{
    public $id;
    public $imagen;
    public $titulo;
    public $descripcion;
    public $activo;

    public function __construct($id, $imagen, $titulo, $descripcion, $activo)
    {
        $this->id = $id;
        $this->imagen = $imagen;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->activo = $activo;
    }

    public static function crear($imagen, $titulo, $descripcion)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("INSERT INTO `tbl_productos`(`id`, `imagen`, `titulo`, `descripcion`, `activo`) VALUES (NULL, :imagen, :titulo, :descripcion, 1);");
            $sql->bindParam(":imagen", $imagen);
            $sql->bindParam(":titulo", $titulo);
            $sql->bindParam(":descripcion", $descripcion);

            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al crear un producto " . $e->getMessage();
            return false;
        }
    }

    public static function desactivar($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("UPDATE tbl_productos SET activo = 0 WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al desactivar el producto con ID $id " . $e->getMessage();
            return false;
        }
    }


    public static function activar($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("UPDATE tbl_productos SET activo = 1 WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al activar el producto con ID $id " . $e->getMessage();
            return false;
        }
    }

    public static function mostrarProductos()
    {
        $productosActivos = [];
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT * FROM tbl_productos WHERE activo=1");
            $sql->execute();
            foreach ($sql->fetchAll() as $productoActivo) {
                $productoActivo = new Producto($productoActivo['id'], $productoActivo['imagen'], $productoActivo['titulo'], $productoActivo['descripcion'], $productoActivo['activo']);
                $productosActivos[] = $productoActivo;
            }
            return $productosActivos;
        } catch (PDOException $e) {
            echo "Error al mostrar los productos activos" . $e->getMessage();
            return false;
        }
    }

    public static function consultar()
    {
        try {
            $listaProductos = [];
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT * FROM tbl_productos");

            $sql->execute();

            foreach ($sql->fetchAll() as $producto) {
                $nuevoProducto = new Producto($producto['id'], $producto['imagen'], $producto['titulo'], $producto['descripcion'], $producto['activo']);
                $listaProductos[] = $nuevoProducto;
            }
            return $listaProductos;
        } catch (PDOException $e) {
            echo "Error al mostrar los productos " . $e->getMessage();
            return false;
        }
    }


    public static function buscar($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT * FROM tbl_productos WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            $producto = $sql->fetch();
            return new Producto($producto['id'], $producto['imagen'], $producto['titulo'], $producto['descripcion'], $producto['activo']);
        } catch (PDOException $e) {
            echo "Error al buscar el producto con el ID $id " . $e->getMessage();
            return false;
        }
    }

    public static function obtenerImagen($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT imagen FROM tbl_productos WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            $imagen = $sql->fetch();
            return $imagen['imagen'] ?? null;
        } catch (PDOException $e) {
            echo "Error al obtener la imagen " . $e->getMessage();
            return false;
        }
    }


    public static function borraImagen($imagen)
    {
        try {
            $ruta_imagen = "assets/img/products/" . $imagen;
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen);
            }
        } catch (PDOException $e) {
            echo "Error al borrar la imagen " . $e->getMessage();
            return false;
        }
    }

    public static function actualizarImagen($id, $imagen)
    {
        try {
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("UPDATE tbl_productos SET imagen =:imagen WHERE id =:id");
            $sql->bindParam(":imagen", $imagen);
            $sql->bindParam(":id", $id);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar la imagen " . $e->getMessage();
            return false;
        }
    }


    public static function editar($id, $imagen, $titulo, $descripcion)
    {
        try {
            $conexion = BD::crearInstancia();
            if ($imagen != "") {
                $imagen_actual = self::obtenerImagen($id);
                if ($imagen_actual && $imagen != $imagen_actual) {
                    self::borraImagen($imagen_actual);
                }
            }

            $sql = $conexion->prepare("UPDATE tbl_productos SET imagen=:imagen, titulo=:titulo, descripcion=:descripcion WHERE id=:id");
            $sql->bindParam(":imagen", $imagen);
            $sql->bindParam(":titulo", $titulo);
            $sql->bindParam(":descripcion", $descripcion);
            $sql->bindParam(":id", $id);
            $sql->execute();
        } catch (PDOException $e) {
            echo "Error al editar el producto con ID $id " . $e->getMessage();
            return false;
        }
    }

    public static function borrar($id)
    {
        try {
            $conexion = BD::crearInstancia();
            $imagen = self::obtenerImagen($id);

            if ($imagen) {
                self::borraImagen($imagen);
            }

            $sql = $conexion->prepare("DELETE FROM tbl_productos WHERE id = :id");
            $sql->bindParam(":id", $id);
            return $sql->execute();
        } catch (PDOException $e) {
            echo "Error al borrar el producto con ID $id " . $e->getMessage();
            return false;
        }
    }
}
?>