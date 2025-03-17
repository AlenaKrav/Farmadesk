<?php
class BD {
    //aqui se almacena la instancia de conex a la BD
    private static $instancia=NULL;

    //Este método es estático, lo que significa que puedes llamarlo sin necesidad de crear un objeto de la clase BD.
    //Por eso Empleado puede usar BD::crearInstancia() directamente.
    public static function crearInstancia(){
        //si no tenemos instancia de la conexion la creamos, self - haemos ref a esta instancia
        if(!isset(self::$instancia)){
            $opcionesPDO[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
            //creamos la instancia de la conexion, al localhost, y la bd necesaria, con user y password, + las opciones de manejo de errores
            self::$instancia=new PDO('mysql:host=localhost;dbname=farma','root','',$opcionesPDO);
            // echo "Conexión establecida";
            
        }
        return self::$instancia;
    }

}


?>