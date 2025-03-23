<?php
include_once('./models/Servicio.php');
include_once('./models/Equipo.php');
include_once('./models/Producto.php');
include_once('./config/conexion.php');

BD::crearInstancia();
class IndexController{
    public function mostrarActivos(){
        ob_start(); 
        $serviciosActivos = Servicio::mostrarActivos();
        include_once("./views/secciones/servicios.php");
        return ob_get_clean(); // Capturar y limpiar el buffer
    }

    public function mostrarEquipo(){
        ob_start(); 
        $miembrosEquipo = Equipo::consultar();
        include_once("./views/secciones/equipo.php");
        return ob_get_clean();
    }

    public function mostrarProductos(){
        ob_start();
        $productosActivos = Producto::mostrarProductos();
        include_once("./views/secciones/productos.php");
        return ob_get_clean();
    }

}


?>