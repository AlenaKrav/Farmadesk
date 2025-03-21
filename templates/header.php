<?php
$url_base = "http://localhost/farma/";
// include_once('../farma/config/config_session.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: " . $url_base . "login");
    exit();
} elseif ($_SESSION['role_id'] !== 1) {
    echo "Acceso denegado";
    header("Location: " . $url_base . "login");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Estilos propios -->
    <link href="<?php echo $url_base; ?>assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Mi script -->
    <script src="js/myscript.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Boostrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active" aria-current="page">Panel de administración<span class="visually-hidden">(current)</span></a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>admin/servicios/">Servicios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>admin/portafolio/">Portafolio</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>admin/entradas/">Entradas</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>admin/equipo/">Equipo</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>admin/configuraciones/">Configuraciones</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>admin/usuarios">Usuarios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>admin/tareas">Lista de tareas</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>admin/consultas-formulario">Consultas</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>admin/pacientes">Pacientes</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>admin/recetas">Recetas</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>logout">Cerrar sesión</a>
            </div>
        </nav>
    </header>
    <main class="container">
        <br />

