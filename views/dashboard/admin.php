<?php
$titulo = "Panel de administración";
$pagina_activa = "admin";
include("../../templates/header.php");
// print_r($_SESSION);
// echo "Dashboard admin";
?>

<br>
<div class="p-5 mb-4 bg-light rounded-3 text-center">
    <div class="container-fluid py-5 text-center">
        <h1 class="display-5 fw-bold">Bienvenido a tu panel del administrador, <?php echo $_SESSION['nombre']." ". $_SESSION['apellidos']?></h1>
        <p class="fs-4">Desde este panel puedes organizar todas las tareas necesarios, puede empezar por:
        </p>
        <a name="" id="" class="btn btn-primary btn-lg" href="<?php echo $url_base; ?>admin/consultas-formulario" role="button">Leer consultas del formulario</a>
        <a name="" id="" class="btn btn-primary btn-lg" href="<?php echo $url_base; ?>admin/recetas" role="button">Gestionar las nuevas recetas</a>
        <a name="" id="" class="btn btn-primary btn-lg" href="<?php echo $url_base; ?>admin/tareas" role="button">Gestionar las nuevas tareas</a>
    </div>
</div>
<?php
include("../../templates/footer.php");
?>