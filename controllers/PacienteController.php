<?php
include_once('./models/Paciente.php');
include_once('./config/conexion.php');

BD::crearInstancia();

class PacienteController
{
    public function inicio()
    {
        $mensajes = [];
        //OJO ES UN ARRAY DE OBJETOS
        $pacientes = Paciente::consultar();
        if ($pacientes) {
            // echo "Tenemos pacientes";
        } else {
            "Error";
        }
        include_once("./views/pacientes/index.php");
    }


    public function crear()
    {
        if (isset($_POST['agregar'])) {
            if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['dni']) && isset($_POST['fecha_nacimiento']) && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['direccion']) && isset($_POST['cip_aut'])) {
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $dni = $_POST['dni'];
                $fecha_nacimiento = $_POST['fecha_nacimiento'];
                $correo = $_POST['correo'];
                $telefono = $_POST['telefono'];
                $direccion = $_POST['direccion'];
                $cip_aut = $_POST['cip_aut'];

                if (empty($nombre) || empty($apellidos) || empty($dni) || empty($fecha_nacimiento) || empty($correo) || empty($telefono) || empty($direccion) || empty($cip_aut)) {
                    return "Error: Por favor completa todos los campos.";
                }
                Paciente::crear($nombre, $apellidos, $dni, $fecha_nacimiento, $correo, $telefono, $direccion, $cip_aut);
                header("Location: /farma/admin/pacientes");
                exit();
            }
        }
            include_once("./views/pacientes/crear.php");

    }

    public function editar() {
        if (isset($_POST['actualizar'])) {
            if (isset($_POST['id_paciente']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['dni']) && isset($_POST['fecha_nacimiento']) && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['direccion']) && isset($_POST['cip_aut'])) {
                $id_paciente = $_POST['id_paciente'];
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $dni = $_POST['dni'];
                $fecha_nacimiento = $_POST['fecha_nacimiento'];
                $correo = $_POST['correo'];
                $telefono = $_POST['telefono'];
                $direccion = $_POST['direccion'];
                $cip_aut = $_POST['cip_aut'];

                if (empty($nombre) || empty($apellidos) || empty($dni) || empty($fecha_nacimiento) || empty($correo) || empty($telefono) || empty($direccion) || empty($cip_aut)) {
                    return "Por favor completa todos los campos.";
                } else {
                    Paciente::editar($id_paciente, $nombre, $apellidos, $dni, $fecha_nacimiento, $correo, $telefono, $direccion, $cip_aut);
                    header("Location: /farma/admin/pacientes");
                    exit();
                }
            }
        }
        if (isset($_GET['id'])) {
            $idBuscar = $_GET['id'];
            $paciente = Paciente::buscar($idBuscar);
        }
        // $usuario = Usuario::buscar(1);
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

    public function sugerencias() {
        if (!isset($_GET['term']) || empty(trim($_GET['term']))) {
            echo json_encode([]); // Devuelve un array vacío si el término no está definido o es solo espacios en blanco
            exit();
        }
    
        $term = trim($_GET['term']); // Eliminar espacios extra
        $sugerencias = Paciente::sugerencias($term);
    
        header('Content-Type: application/json'); // Asegurar el tipo de respuesta JSON
        echo json_encode($sugerencias);
        exit();
    }
}
