<?php
include_once('./models/Paciente.php');
include_once('./config/conexion.php');
require_once('./helpers/validaciones.php');

BD::crearInstancia();

class PacienteController
{
    public function inicio()
    {
        $pacientes = Paciente::consultar();
        if (!$pacientes) {
            $pacientes = [];
        } 
        include_once("./views/pacientes/index.php");
    }


    public function crear()
    {
        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
            if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['dni']) && isset($_POST['fecha_nacimiento']) && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['direccion']) && isset($_POST['cip_aut'])) {
                $nombre = trim($_POST['nombre'] ?? '');
                $apellidos = trim($_POST['apellidos'] ?? '');
                $dni = trim($_POST['dni'] ?? '');
                $fecha_nacimiento = trim($_POST['fecha_nacimiento'] ?? '');
                $correo = trim($_POST['correo'] ?? '');
                $telefono = trim($_POST['telefono'] ?? '');
                $direccion = trim($_POST['direccion'] ?? '');
                $cip_aut = trim($_POST['cip_aut'] ?? '');

                if (inputVacio($nombre)) {
                    $errores['nombre'] = "Debes introducir un nombre de paciente";
                }

                if (!validarCadena($nombre)) {
                    $errores['nombre'] = "El nombre solo puede contener letras";
                }

                if (inputVacio($apellidos)) {
                    $errores['apellidos'] = "Debes introducir un apellido de paciente";
                }

                if (!validarCadena($apellidos)) {
                    $errores['apellidos'] = "El apellido solo puede contener letras";
                }

                if (inputVacio($dni)) {
                    $errores['dni'] = "Debes introducir un número de identificación";
                }else if (!validarDocIdentidad($dni)) {
                    $errores['dni'] = "Formato inválido del documento de indentificación";
                }

                if(inputVacio($fecha_nacimiento)){
                    $errores['fecha_nacimiento'] = "Debes introducir una fecha de nacimiento";
                }
                else if (!validarFecha($fecha_nacimiento)) {
                    $errores['fecha_nacimiento'] = "Formato inválido de fecha de nacimiento";
                }

                if (inputVacio($correo)) {
                    $errores['correo'] = "Debes introducir un correo electrónico";
                } else if (!validarCorreo($correo)) {
                    $errores['correo'] = "Formato inválido de correo electrónico";
                }

                if (inputVacio($telefono)) {
                    $errores['telefono'] = "Debes introducir un número de teléfono";
                } else if (!validarTlf($telefono)) {
                    $errores['telefono'] = "Formato inválido de número de teléfono";
                }

                if (inputVacio($direccion)) {
                    $errores['direccion'] = "Debes introducir una dirección";
                }

                if (inputVacio($cip_aut)) {
                    $errores['cip_aut'] = "Debes introducir un CIP_AUT";
                }else if (!validar_cip_andalucia($cip_aut)) {
                    $errores['cip_aut'] = "Formato inválido de CIP_AUT";
                }

                if (empty($errores)) {
                    $paciente = Paciente::crear($nombre, $apellidos, $dni, $fecha_nacimiento, $correo, $telefono, $direccion, $cip_aut);
                    if($paciente['error']){
                        $errores[$paciente['campo']] = $paciente['mensaje'];
                    }
                    else{
                    header("Location: /farma/admin/pacientes");
                    exit();
                    }
                }
            }
        }
        include_once("./views/pacientes/crear.php");
    }

    public function editar()
    {
        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
            if (isset($_POST['id_paciente']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['dni']) && isset($_POST['fecha_nacimiento']) && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['direccion']) && isset($_POST['cip_aut'])) {
                $id_paciente = trim($_POST['id_paciente'] ?? '');
                $nombre = trim($_POST['nombre'] ?? '');
                $apellidos = trim($_POST['apellidos'] ?? '');
                $dni = trim($_POST['dni'] ?? '');
                $fecha_nacimiento = trim($_POST['fecha_nacimiento'] ?? '');
                $correo = trim($_POST['correo'] ?? '');
                $telefono = trim($_POST['telefono'] ?? '');
                $direccion = trim($_POST['direccion'] ?? '');
                $cip_aut = trim($_POST['cip_aut'] ?? '');


                if (inputVacio($nombre)) {
                    $errores['nombre'] = "Debes introducir un nombre de paciente";
                }else if (!validarCadena($nombre)) {
                    $errores['nombre'] = "El nombre solo puede contener letras";
                }

                if (inputVacio($apellidos)) {
                    $errores['apellidos'] = "Debes introducir un apellido de paciente";
                } else if (!validarCadena($apellidos)) {
                    $errores['apellidos'] = "El apellido solo puede contener letras";
                }

                if (inputVacio($dni)) {
                    $errores['dni'] = "Debes introducir un número de identificación";
                }else if (!validarDocIdentidad($dni)) {
                    $errores['dni'] = "Formato inválido del documento de indentificación";
                }

                if(inputVacio($fecha_nacimiento)){
                    $errores['fecha_nacimiento'] = "Debes introducir una fecha de nacimiento";
                }
                else if (!validarFecha($fecha_nacimiento)) {
                    $errores['fecha_nacimiento'] = "Formato inválido de fecha de nacimiento";
                }

                if (inputVacio($correo)) {
                    $errores['correo'] = "Debes introducir un correo electrónico";
                } else if (!validarCorreo($correo)) {
                    $errores['correo'] = "Formato inválido de correo electrónico";
                }

                if (inputVacio($telefono)) {
                    $errores['telefono'] = "Debes introducir un número teléfono";
                } else if (!validarTlf($telefono)) {
                    $errores['telefono'] = "Formato inválido de número teléfono";
                }

                if (inputVacio($direccion)) {
                    $errores['direccion'] = "Debes introducir una dirección";
                }

                if (inputVacio($cip_aut)) {
                    $errores['cip_aut'] = "Debes introducir un CIP_AUT";
                }else if (!validar_cip_andalucia($cip_aut)) {
                    $errores['cip_aut'] = "Formato inválido de CIP_AUT";
                }
                
                if (empty($errores)) {
                    $pacienteAct = Paciente::editar($id_paciente, $nombre, $apellidos, $dni, $fecha_nacimiento, $correo, $telefono, $direccion, $cip_aut);
                    if($pacienteAct['error']){
                        $errores[$pacienteAct['campo']] = $pacienteAct['mensaje'];
                    }
                    else{
                    header("Location: /farma/admin/pacientes");
                    exit();
                    }
                
                }
            }
        }
        if (isset($_GET['id'])) {
            $idBuscar = $_GET['id'];
            $paciente = Paciente::buscar($idBuscar);
        }
        include_once("./views/pacientes/editar.php");
    }

    public function borrar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Paciente::borrar($id);
        }
        header("Location: /farma/admin/pacientes");
        exit();
    }

    public function sugerencias()
    {
        if (!isset($_GET['term']) || empty(trim($_GET['term']))) {
            echo json_encode([]);
            exit();
        }

        $term = trim($_GET['term']);
        $sugerencias = Paciente::sugerencias($term);

        header('Content-Type: application/json');
        echo json_encode($sugerencias);
        exit();
    }
}
