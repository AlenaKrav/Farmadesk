<?php
$url_base = "http://localhost/farma/";
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
    <title><?php echo $titulo ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link href="/farma/assets/img/favicon.png" rel="icon">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Estilos propios -->
    <link href="<?php echo $url_base; ?>assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Boostrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="nav navbar-nav">
                        <a class="nav-item nav-link <?php echo ($pagina_activa === 'admin') ? 'active' : ''; ?>" aria-current="page" href="<?php echo $url_base; ?>views/dashboard/admin.php">Inicio<span class="visually-hidden">(current)</span></a>
                        <a class="nav-item nav-link <?php echo ($pagina_activa === 'recetas') ? 'active' : ''; ?>" href="<?php echo $url_base; ?>admin/recetas">Recetas</a>
                        <a class="nav-item nav-link <?php echo ($pagina_activa === 'pacientes') ? 'active' : ''; ?>" href="<?php echo $url_base; ?>admin/pacientes">Pacientes</a>
                        <a class="nav-item nav-link <?php echo ($pagina_activa === 'usuarios') ? 'active' : ''; ?>" href="<?php echo $url_base; ?>admin/usuarios">Usuarios</a>
                        <a class="nav-item nav-link <?php echo ($pagina_activa === 'tareas') ? 'active' : ''; ?>" href="<?php echo $url_base; ?>admin/tareas">Tareas</a>
                        <a class="nav-item nav-link <?php echo ($pagina_activa === 'servicios') ? 'active' : ''; ?>" href="<?php echo $url_base; ?>admin/servicios">Servicios</a>
                        <a class="nav-item nav-link <?php echo ($pagina_activa === 'productos') ? 'active' : ''; ?>" href="<?php echo $url_base; ?>admin/productos">Productos</a>
                        <a class="nav-item nav-link <?php echo ($pagina_activa === 'equipo') ? 'active' : ''; ?>" href="<?php echo $url_base; ?>admin/equipo">Equipo</a>
                        <a class="nav-item nav-link <?php echo ($pagina_activa === 'consultas') ? 'active' : ''; ?>" href="<?php echo $url_base; ?>admin/consultas-formulario">Consultas</a>
                        <a class="nav-item nav-link" href="<?php echo $url_base; ?>" target="_blank">Página Farmadesk</a>
                        <a class="nav-item nav-link" href="<?php echo $url_base; ?>logout">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        <br />