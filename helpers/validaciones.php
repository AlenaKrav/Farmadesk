<?php
function inputVacio($input)
{
    if (empty($input)) {
        return true;
    } else {
        return false;
    }
}

function validarCadena($cadena)
{
    if (preg_match('/\d/', $cadena)) {
        return false;
    }
    return true;
}

function validarDocIdentidad($documento)
{
    $pattern = '/^(?:\d{8}[A-Za-z]|[XYZ]\d{7}[A-Za-z])$/';
    if (preg_match($pattern, $documento)) {
        return true;
    }
    return false;
}

function validarTlf($telefono)
{
    $pattern = '/^\d{9}$/';
    if (preg_match($pattern, $telefono)) {
        return true;
    }
    return false;
}

function validar_cip_andalucia($cip)
{
    $pattern = '/^AN\d{10,12}$/';
    if (preg_match($pattern, $cip)) {
        return true;
    }
    return false;
}

function validarFecha($fecha)
{
    $partes_fecha = explode('-', $fecha);
    $parte_anyo = $partes_fecha[0];
    $parte_mes = $partes_fecha[1];
    $parte_dia = $partes_fecha[2];


    $dia = (int) $parte_dia;
    $mes = (int) $parte_mes;
    $anyo_receta = (int) $parte_anyo;

    $anyo_actual = (int) date('Y');

    if (($anyo_actual - $parte_anyo) > 150) {
        return false;
    }

    if (!checkdate($mes, $dia, $anyo_receta)) {
        return false;
    } else {
        return true;
    }
}

function validarFechaPrescripción($fecha_prescripcion)
{

    $partes_fecha = explode('-', $fecha_prescripcion);
    $parte_anyo = $partes_fecha[0];

    $anyo_receta = (int) $parte_anyo;
    $ano_actual = (int) date('Y');

    if ($anyo_receta < $ano_actual) {
        return false;
    } else {
        return true;
    }
}

function validarCorreo($correo)
{
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/';
    if (preg_match($pattern, $correo)) {
        return true;
    }
    return false;
}

function validarUsuario($usuario)
{
    $pattern = '/^[a-zA-Z_]+$/';
    if (preg_match($pattern, $usuario)) {
        return true;
    }
    return false;
}

function validarContrasena($contrasena)
{
    if (strlen($contrasena) >= 8) {
        return true;
    }
    return false;
}
?>