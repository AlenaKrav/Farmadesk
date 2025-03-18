<?php
include("../../templates/paciente_header.php");
$url_base = "http://localhost/farma/";
// include_once('../../config/config_session.php');
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }
// print_r($_SESSION);

// if (!isset($_SESSION['usuario'])) {
//     header("Location: " . $url_base . "login");
//     exit();
// } elseif ($_SESSION['role_id'] !== 3) {
//     echo "Acceso denegado";
//     header("Location: " . $url_base . "login");
//     exit();
// }


echo "Dashboard paciente";


?>
<br>
<div class="p-5 mb-4 bg-success rounded-3 text-center">
    <div class="container-fluid py-5 text-center">
        <h1 class="display-5 fw-bold text-white">Bienvenido a tu panel de administrador de recetas, <?php echo $_SESSION['nombre']." ". $_SESSION['apellidos']?></h1>
        <p class="fs-4 text-white">Aquí puedes gestionar tus recetas: puedes agregar una nueva receta para que tu farmcéutico la gestione y una vez enviada puede hacerle seguimiento para ver si se está preparando, ya está para ser recogida o rechazada debido un error.</p>
        <a name="" id="" class="btn btn-primary btn-lg" href="<?php echo $url_base; ?>paciente/recetas" role="button">Ir a mis recetas</a>
        <button class="btn btn-primary btn-lg" type="button">Enviar una consulta</button>
    </div>
</div>
<?php
include("../../templates/paciente_footer.php");
?>