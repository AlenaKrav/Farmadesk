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
        // session_start();
        // $auth = $_SESSION['login'] ?? null;
        $rutas_protegidas=['/admin'];
        $urlActual = $_SERVER['REQUEST_URI'] ?? '/';
        $urlActual = str_replace('/farma', '', $urlActual);
        $urlActual = explode('?', $urlActual)[0]; // Elimina parámetros GET
        echo $urlActual;

        //proteger las rutas
        // if(in_array($urlActual, $rutas_protegidas) && !$auth){
        //     header('Location: /farma');
        // }

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
