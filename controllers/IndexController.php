<?php
include_once('./models/Servicio.php');
include_once('./config/conexion.php');

BD::crearInstancia();
class IndexController{
    public function mostrarActivos(){
        $serviciosActivos = Servicio::mostrarActivos();
        include_once("./views/secciones/servicios.php");
        return ob_get_clean(); // Capturar y limpiar el buffer
    }
}


?>