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
        if(!$serviciosActivos){
            $serviciosActivos=[];
        }
        include_once("./views/secciones/servicios.php");
        return ob_get_clean();
    }

    public function mostrarEquipo(){
        ob_start(); 
        $miembrosEquipo = Equipo::consultar();
        if(!$miembrosEquipo){
            $miembrosEquipo=[];
        }
        include_once("./views/secciones/equipo.php");
        return ob_get_clean();
    }

    public function mostrarProductos(){
        ob_start();
        $productosActivos = Producto::mostrarProductos();
        if(!$productosActivos){
            $productosActivos=[];
        }
        include_once("./views/secciones/productos.php");
        return ob_get_clean();
    }

}


?>