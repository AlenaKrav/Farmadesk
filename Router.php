<?php
class Router {

    //array que almacena las rutas asociadas el método GET
    public $rutasGET = [];
    //array que almacena las rutas asociadas el método POST
    public $rutasPOST = [];

    //funcion para manejar las rutas GET
    //url - la ruta a capturar
    //funcion a ejecutar una vez se solicite esa ruta con el método GET
    public function get($url, $funcion) {
        // Lo que se está haciendo es añadir un elemento al array $rutasGET.
        //$url: Es la clave del array y representa la URL que el sistema debe interceptar. Por ejemplo, si tienes una ruta /contactar, esta será la clave.
        //$funcion: Es el valor que se asigna a esa clave, y representa una función que se ejecutará cuando se haga una solicitud GET a esa URL. 
        //El valor funcion puede ser el nombre de una función o un callback (por ejemplo, contactar.php o consultar()).
        $this->rutasGET[$url] = $funcion;
    }

    public function post($url, $funcion) {
        $this->rutasPOST[$url] = $funcion;
    }

    public function comprobarRutas() {
        //obtenemos la url actual
        $urlActual = $_SERVER['REQUEST_URI'] ?? '/';
        $urlActual = str_replace('/farma', '', $urlActual);
        $urlActual = explode('?', $urlActual)[0];
        //si la URL actual es vacía, '/' o '/index.php', se normalice a '/' (la página de inicio).
            if ($urlActual === '' || $urlActual === '/' || $urlActual === '/index.php') {
        $urlActual = '/';
    }
        // Elimina parámetros GET
        // echo "Hola tu ruta actual: " . $urlActual;

        //obtenemos el metodo HTTP o el tipo de solicitud HTTP
        $metodo = $_SERVER['REQUEST_METHOD'];
        // echo $metodo;

        //si el metodo es get
        if ($metodo === 'GET') {

            // Si la URL solicitada existe en $rutasGET, 
            // la variable $funcion contendrá el nombre de la función que debe ejecutarse para esa URL.
            // Si la URL no está definida en $rutasGET, $funcion será null.
            // la funcion a ejecutar será la que encontremos dentro del array
            // rutasGet donde la clave es la url actual y su correspondiente valor es la funcion que ejecutaremos

            $funcion = $this->rutasGET[$urlActual] ?? null;
        }

        elseif ($metodo === 'POST') {
            $funcion = $this->rutasPOST[$urlActual] ?? null;
            // print_r($_POST);
        }
        else{
            echo "Método no soportado.";
            return;
        }


        //Si se ha encontrado una función asociada a la URL y el método HTTP, se ejecuta con call_user_func($funcion).
        //Esta función permite ejecutar cualquier función pasada como parámetro.
        if ($funcion) {
            call_user_func($funcion);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "Página no encontrada";
        }
    }
}


?>
