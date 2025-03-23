<?php
class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $funcion) {
        $this->rutasGET[$url] = $funcion;
    }

    public function post($url, $funcion) {
        $this->rutasPOST[$url] = $funcion;
    }

    public function comprobarRutas() {
        $urlActual = $_SERVER['REQUEST_URI'] ?? '/';
        $urlActual = str_replace('/farma', '', $urlActual);
        $urlActual = explode('?', $urlActual)[0];
            if ($urlActual === '' || $urlActual === '/' || $urlActual === '/index.php') {
        $urlActual = '/';
    }
        // Elimina parámetros GET
        // echo "Hola tu ruta actual: " . $urlActual;

        $metodo = $_SERVER['REQUEST_METHOD'];
        // echo $metodo;

        if ($metodo === 'GET') {
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

        if ($funcion) {
            call_user_func($funcion);
        } else {
            // echo "Página no encontrada";
        }
    }
}


?>
