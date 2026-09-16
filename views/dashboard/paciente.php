<?php
$titulo = "Panel de administración";
$pagina_activa = "paciente";
include("../../templates/paciente_header.php");
$url_base = "http://localhost/farma/";
?>
<br>
<div class="p-5 mb-4 bg-success rounded-3 text-center">
    <div class="container-fluid py-5 text-center">
        <h1 class="display-5 fw-bold text-white">Bienvenido a tu panel<br>de administración de recetas,
            <br><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidos'] ?>
        </h1>
        <br>
        <a name="" id="" class="btn btn-warning btn-lg" href="<?php echo $url_base; ?>paciente/recetas" role="button">Ir a mis recetas</a>
    </div>
</div>
<?php
include("../../templates/paciente_footer.php");
?>