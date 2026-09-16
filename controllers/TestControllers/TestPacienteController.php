<?php
include_once('./config/conexion.php');
include_once('./models/Paciente.php');
require_once('./helpers/validaciones.php');

BD::crearInstancia();

class TestControllers
{

    public function procesarCrearPaciente($datos)
    {
        $errores = [];

        $nombre = trim($datos['nombre'] ?? '');
        $apellidos = trim($datos['apellidos'] ?? '');
        $dni = trim($datos['dni'] ?? '');
        $fecha_nacimiento = trim($datos['fecha_nacimiento'] ?? '');
        $correo = trim($datos['correo'] ?? '');
        $telefono = trim($datos['telefono'] ?? '');
        $direccion = trim($datos['direccion'] ?? '');
        $cip_aut = trim($datos['cip_aut'] ?? '');

        if (inputVacio($nombre)) {
            $errores['nombre'] = "Debes introducir un nombre del paciente";
        } elseif (!validarCadena($nombre)) {
            $errores['nombre'] = "El nombre solo puede contener letras.";
        }

        if (inputVacio($apellidos)) {
            $errores['apellidos'] = "Debes introducir un apellido del paciente";
        } elseif (!validarCadena($apellidos)) {
            $errores['apellidos'] = "El apellido solo puede contener letras.";
        }

        if (inputVacio($dni)) {
            $errores['dni'] = "Debes introducir un número de identificación";
        } elseif (!validarDocIdentidad($dni)) {
            $errores['dni'] = "El formato del documento de indentificación incorrecto.";
        }

        if (inputVacio($fecha_nacimiento)) {
            $errores['fecha_nacimiento'] = "Debes introducir una fecha.";
        } elseif (!validarFecha($fecha_nacimiento)) {
            $errores['fecha_nacimiento'] = "Debes introducir una fecha válida";
        }

        if (inputVacio($correo)) {
            $errores['correo'] = "Debes introducir un correo";
        } elseif (!validarCorreo($correo)) {
            $errores['correo'] = "Formato de correo incorrecto";
        }

        if (inputVacio($telefono)) {
            $errores['telefono'] = "Debes introducir un teléfono";
        } elseif (!validarTlf($telefono)) {
            $errores['telefono'] = "Formato de teléfono incorrecto";
        }

        if (inputVacio($direccion)) {
            $errores['direccion'] = "Debes introducir una dirección";
        }

        if (inputVacio($cip_aut)) {
            $errores['cip_aut'] = "Debes introducir un CIP_AUT";
        } elseif (!validar_cip_andalucia($cip_aut)) {
            $errores['cip_aut'] = "Formato de CIP_AUT incorrecto";
        }

        if (empty($errores)) {
            $paciente = Paciente::crear($nombre, $apellidos, $dni, $fecha_nacimiento, $correo, $telefono, $direccion, $cip_aut);

            if ($paciente['error']) {
                $errores[$paciente['campo']] = $paciente['mensaje'];
            } else {
                return ['ok' => true, 'paciente' => $paciente];
            }
        }
        return ['ok' => false, 'errores' => $errores];
    }

    public function procesarObtenerPacientes()
    {
        $pacientes = Paciente::consultar();

        if ($pacientes) {
            return [
                'ok' => true,
                'pacientes' => $pacientes
            ];
        } else {
            return [
                'ok' => false,
                'mensaje' => 'No se pudieron obtener los pacientes'
            ];
        }
    }

    public function procesarEditarPaciente($datos)
    {
        $errores = [];

        $id_paciente = trim($datos['id_paciente'] ?? '');
        $nombre = trim($datos['nombre'] ?? '');
        $apellidos = trim($datos['apellidos'] ?? '');
        $dni = trim($datos['dni'] ?? '');
        $fecha_nacimiento = trim($datos['fecha_nacimiento'] ?? '');
        $correo = trim($datos['correo'] ?? '');
        $telefono = trim($datos['telefono'] ?? '');
        $direccion = trim($datos['direccion'] ?? '');
        $cip_aut = trim($datos['cip_aut'] ?? '');

        if (inputVacio($nombre)) {
            $errores['nombre'] = "Debes introducir un nombre del paciente";
        } elseif (!validarCadena($nombre)) {
            $errores['nombre'] = "El nombre solo puede contener letras.";
        }

        if (inputVacio($apellidos)) {
            $errores['apellidos'] = "Debes introducir un apellido del paciente";
        } elseif (!validarCadena($apellidos)) {
            $errores['apellidos'] = "El apellido solo puede contener letras.";
        }

        if (inputVacio($dni)) {
            $errores['dni'] = "Debes introducir un número de identificación";
        } elseif (!validarDocIdentidad($dni)) {
            $errores['dni'] = "El formato del documento de identificación es incorrecto.";
        }

        if (inputVacio($fecha_nacimiento)) {
            $errores['fecha_nacimiento'] = "Debes introducir una fecha.";
        } elseif (!validarFecha($fecha_nacimiento)) {
            $errores['fecha_nacimiento'] = "Debes introducir una fecha válida.";
        }

        if (inputVacio($correo)) {
            $errores['correo'] = "Debes introducir un correo";
        } elseif (!validarCorreo($correo)) {
            $errores['correo'] = "Formato de correo incorrecto.";
        }

        if (inputVacio($telefono)) {
            $errores['telefono'] = "Debes introducir un teléfono";
        } elseif (!validarTlf($telefono)) {
            $errores['telefono'] = "Formato de teléfono incorrecto.";
        }

        if (inputVacio($direccion)) {
            $errores['direccion'] = "Debes introducir una dirección";
        }

        if (inputVacio($cip_aut)) {
            $errores['cip_aut'] = "Debes introducir un CIP_AUT";
        } elseif (!validar_cip_andalucia($cip_aut)) {
            $errores['cip_aut'] = "Formato de CIP_AUT incorrecto.";
        }

        if (empty($errores)) {
            $paciente = Paciente::editar(
                $id_paciente,
                $nombre,
                $apellidos,
                $dni,
                $fecha_nacimiento,
                $correo,
                $telefono,
                $direccion,
                $cip_aut
            );

            if ($paciente['error']) {
                $errores[$paciente['campo']] = $paciente['mensaje'];
            } else {
                return ['ok' => true];
            }
        }

        return ['ok' => false, 'errores' => $errores];
    }


    public function procesarBuscarPaciente($id)
    {
        $paciente = Paciente::buscar($id);

        if ($paciente) {
            return ['ok' => true, 'paciente' => $paciente];
        } else {
            return ['ok' => false, 'error' => 'Paciente no encontrado'];
        }
    }

    public function procesarBorrarPaciente($id)
    {
        $resultado = Paciente::borrar($id);

        if ($resultado) {
            return ['ok' => true];
        } else {
            return ['ok' => false, 'error' => 'Error al borrar el paciente'];
        }
    }

    public function procesarSugerenciasPaciente($term)
    {
        if (!isset($term) || empty(trim($term))) {
            return [];
        }

        $term = trim($term);
        $sugerencias = Paciente::sugerencias($term);

        return $sugerencias;
    }
}
?>