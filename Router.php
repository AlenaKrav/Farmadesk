<?php
class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $funcion)
    {
        $this->rutasGET[$url] = $funcion;
    }

    public function post($url, $funcion)
    {
        $this->rutasPOST[$url] = $funcion;
    }

    public function comprobarRutas()
    {
        $urlActual = $_SERVER['REQUEST_URI'] ?? '/';
        $urlActual = str_replace('/farma', '', $urlActual);
        $urlActual = explode('?', $urlActual)[0];
        if ($urlActual === '' || $urlActual === '/' || $urlActual === '/index.php') {
            $urlActual = '/';
        }
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $funcion = $this->rutasGET[$urlActual] ?? null;
        } elseif ($metodo === 'POST') {
            $funcion = $this->rutasPOST[$urlActual] ?? null;
        } else {
            echo "Método no soportado.";
            return;
        }

        if ($funcion) {
            call_user_func($funcion);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "Página no encontrada";
        }
    }
}
?>