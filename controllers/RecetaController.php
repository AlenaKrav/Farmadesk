<?php
include_once('./models/Receta.php');
include_once('./config/conexion.php');
require_once('./helpers/validaciones.php');

BD::crearInstancia();

class RecetaController
{
    public function inicio()
    {
        $recetas = Receta::consultar();
        if (!$recetas) {
            $recetas = [];
        }
        include_once("./views/recetas/admin/index.php");
    }

    public function crear()
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
            $paciente_id = trim($_POST['paciente_id'] ?? '');
            $nombre = trim($_POST['nombre'] ?? '');
            $fecha = trim($_POST['fecha'] ?? '');
            $codigo_nacional = trim($_POST['codigo_nacional'] ?? '');
            $observaciones = trim($_POST['observaciones'] ?? '');
            $imagen = $_FILES['imagen']['name'] ?? '';

            if (inputVacio($paciente_id)) {
                $errores['paciente_id'] = "Debes seleccionar un paciente escribiendo su nombre y eligiendo una opción";
            }

            if (inputVacio($nombre)) {
                $errores['nombre'] = "Debes introducir un nombre de medicamento";
            }

            if (inputVacio($fecha)) {
                $errores['fecha'] = "Debes introducir una fecha de prescripción";
            } else if (!validarFechaPrescripción($fecha)) {
                $errores['fecha'] = "Formato inválido de fecha de prescripción";
            }

            if (inputVacio($codigo_nacional)) {
                $errores['codigo_nacional'] = "Debes introducir el código nacional del medicamento";
            }

            if (inputVacio($observaciones)) {
                $errores['observaciones'] = "Debes introducir una observación";
            }


            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $formatos_permitidos = ['image/jpeg', 'image/png'];
                $tamano_maximo = 5 * 1024 * 1024; 

                $tipo_img = $_FILES['imagen']['type'];
                $tamano_img = $_FILES['imagen']['size'];
                $tmp_imagen = $_FILES['imagen']['tmp_name'];

                if (!in_array($tipo_img, $formatos_permitidos)) {
                    $errores['imagen'] = "Solo se permiten imágenes en formato JPG o PNG";
                }

                if ($tamano_img > $tamano_maximo) {
                    $errores['imagen'] = "El tamaño de la imagen no debe superar los 5MB";
                }

                if (empty($errores['imagen'])) {
                    $fecha_imagen = new DateTime();
                    if ($imagen != "") {
                        $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;
                        move_uploaded_file($tmp_imagen, "assets/img/recetas/" . $nombre_archivo_imagen);
                    } else {
                        $nombre_archivo_imagen = "";
                    }
                }
            } else {
                $errores['imagen'] = "Debes subir una imagen válida";
            }

            if (empty($errores)) {
                Receta::crear($paciente_id, $nombre_archivo_imagen, $nombre, $fecha, $codigo_nacional, $observaciones);
                header("Location: /farma/admin/recetas");
                exit();
            }
        }

        include_once("./views/recetas/admin/crear.php");
    }


    public function editar()
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
            if (isset($_POST['id_receta']) && isset($_POST['paciente_id']) && isset($_POST['nombre']) && isset($_POST['fecha']) && isset($_POST['estado']) && isset($_POST['codigo_nacional']) && isset($_POST['observaciones'])) {
                $id_receta = trim($_POST['id_receta'] ?? '');
                $paciente_id = trim($_POST['paciente_id'] ?? '');
                $nombre = trim($_POST['nombre'] ?? '');
                $fecha = trim($_POST['fecha'] ?? '');
                $estado = trim($_POST['estado'] ?? '');
                $codigo_nacional = trim($_POST['codigo_nacional'] ?? '');
                $observaciones = trim($_POST['observaciones'] ?? '');

                if (inputVacio($paciente_id)) {
                $errores['paciente_id'] = "Debes seleccionar un paciente escribiendo su nombre y eligiendo una opción";
                }    

                if (inputVacio($nombre)) {
                    $errores['nombre'] = "Debes introducir un nombre de medicamento";
                }

                if (inputVacio($fecha)) {
                    $errores['fecha'] = "Debes introducir una fecha de prescripción";
                } else if (!validarFechaPrescripción($fecha)) {
                    $errores['fecha'] = "Formato inválido de fecha de prescripción";
                }

                if (inputVacio($codigo_nacional)) {
                    $errores['codigo_nacional'] = "Debes introducir el código nacional del medicamento";
                }

                if (inputVacio($observaciones)) {
                    $errores['observaciones'] = "Debes introducir una observación";
                }
            }

            if ($_FILES['imagen_receta']['tmp_name'] == "") {
                $imagen_receta = Receta::obtenerImagen($id_receta);
            } else {
                $imagen = $_FILES['imagen_receta']['name'];
                $formatos_permitidos = ['image/jpeg', 'image/png'];
                $tamano_maximo = 5 * 1024 * 1024;

                $tipo_img = $_FILES['imagen_receta']['type'];
                $tamano_img = $_FILES['imagen_receta']['size'];
                $tmp_imagen = $_FILES['imagen_receta']['tmp_name'];

                if (!in_array($tipo_img, $formatos_permitidos)) {
                    $errores['imagen'] = "Solo se permiten imágenes en formato JPG o PNG";
                }

                if ($tamano_img > $tamano_maximo) {
                    $errores['imagen'] = "El tamaño de la imagen no debe superar los 5MB";
                }

                if (empty($errores['imagen'])) {
                    $fecha_imagen = new DateTime();
                    $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;

                    move_uploaded_file($tmp_imagen, "assets/img/recetas/" . $nombre_archivo_imagen);
                    $imagen_receta = $nombre_archivo_imagen;
                }
            }

            if (empty($errores)) {
                Receta::editar($id_receta, $paciente_id, $imagen_receta, $nombre, $fecha, $estado, $codigo_nacional, $observaciones);
                header("Location: /farma/admin/recetas");
                exit();
            }
        }

        if (isset($_GET['id'])) {
            $idBuscar = $_GET['id'];
            $receta = Receta::buscar($idBuscar);
        }
        include_once("./views/recetas/admin/editar.php");
    }



    public function borrar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Receta::borrar($id);
        }
        header("Location: /farma/admin/recetas");
        exit();
    }
}
