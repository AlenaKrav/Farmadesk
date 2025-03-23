<?php
class Producto{
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
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("INSERT INTO `tbl_productos`(`id`, `imagen`, `titulo`, `descripcion`, `activo`) VALUES (NULL, :imagen, :titulo, :descripcion, 1);");
        $sql->bindParam(":imagen", $imagen);
        $sql->bindParam(":titulo", $titulo);
        $sql->bindParam(":descripcion", $descripcion);

        //ejecutamos la query
        $sql->execute();
    }

    public static function desactivar($id)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("UPDATE tbl_productos SET activo = 0 WHERE id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
    }


    public static function activar($id)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("UPDATE tbl_productos SET activo = 1 WHERE id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
    }

        //FUNCION PARA MOSTRAR LOS SERVICIOS EN LA HOME
        public static function mostrarProductos()
        {
            $productosActivos = [];
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT * FROM tbl_productos WHERE activo=1");
            $sql->execute();
            foreach ($sql->fetchAll() as $productoActivo) {
                $productoActivo = new Producto($productoActivo['id'], $productoActivo['imagen'], $productoActivo['titulo'], $productoActivo['descripcion'], $productoActivo['activo']);
                $productosActivos[] = $productoActivo;
            }
            return $productosActivos;
        }

        public static function consultar()
        {
            $listaProductos = [];
            $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("SELECT * FROM tbl_productos");
    
            $sql->execute();
    
            foreach ($sql->fetchAll() as $producto) {
                //por cada fila recorrida, se usa el constructor para crear un objeto con los datos de esa fila
                //agregamos ese objeto resultante, al arraya
                $nuevoProducto = new Producto($producto['id'], $producto['imagen'], $producto['titulo'] ,$producto['descripcion'], $producto['activo']);
                $listaProductos[] = $nuevoProducto;
            }
            return $listaProductos;
        }


        public static function buscar($id)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("SELECT * FROM tbl_productos WHERE id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        $producto = $sql->fetch();
        return new Producto($producto['id'], $producto['imagen'], $producto['titulo'], $producto['descripcion'], $producto['activo']);
    }


    public static function obtenerImagen($id)
    {
        $conexion = BD::crearInstancia();
        //buscamos la imagen del registro con ese ID
        $sql = $conexion->prepare("SELECT imagen FROM tbl_productos WHERE id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        //recogemos la imagen del registro
        $imagen = $sql->fetch();
        return $imagen['imagen'] ?? null;
        }


        public static function borraImagen($imagen)
        {
            $ruta_imagen = "assets/img/products/" . $imagen;
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen);
            }
        }

        public static function actualizarImagen($id, $imagen)
        {
            $conexion = BD::crearInstancia();
                $sql = $conexion->prepare("UPDATE tbl_productos SET imagen =:imagen WHERE id =:id");
                $sql->bindParam(":imagen", $imagen);
                $sql->bindParam(":id", $id);
                $sql->execute();
    }


    public static function editar($id, $imagen, $titulo, $descripcion)
    {

        $conexion = BD::crearInstancia();
        //obtenemos la imagen de la receta a actualizar
        if ($imagen != "") {
            //obtenemos la img actual de la receta
            $imagen_actual = self::obtenerImagen($id);
            //cambio
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
    }

    public static function borrar($id)
    {
        $conexion = BD::crearInstancia();
        //obtenemos la imagen del registro a borrar
        $imagen = self::obtenerImagen($id);

        if ($imagen) {
            self::borraImagen($imagen);
        }

        $sql = $conexion->prepare("DELETE FROM tbl_productos WHERE id = :id");
        $sql->bindParam(":id", $id);
        return $sql->execute();
    }
    

    



}








?>