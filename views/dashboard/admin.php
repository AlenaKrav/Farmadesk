<?php
$titulo = "Panel de administración";
$pagina_activa = "admin";
include("../../templates/header.php");
?>

<br>
<div class="p-5 mb-4 bg-light rounded-3 text-center">
    <div class="container-fluid py-5 text-center">
        <h1 class="display-5 fw-bold">Bienvenido a tu panel del administrador, <br>
            <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidos'] ?></h1>
        <p class="fs-4">Desde este panel puedes organizar todas las gestiones necesarias, puedes empezar por:
        </p>
        <div class="row justify-content-center gap-2 mt-4">
            <div class="col-12 col-md-auto">
                <a class="btn btn-primary btn-lg w-100" href="<?php echo $url_base; ?>admin/consultas-formulario" role="button">
                    Leer las consultas del formulario
                </a>
            </div>
            <div class="col-12 col-md-auto">
                <a class="btn btn-primary btn-lg w-100" href="<?php echo $url_base; ?>admin/recetas" role="button">
                    Gestionar las nuevas recetas
                </a>
            </div>
            <div class="col-12 col-md-auto">
                <a class="btn btn-primary btn-lg w-100" href="<?php echo $url_base; ?>admin/tareas" role="button">
                    Gestionar las nuevas tareas
                </a>
            </div>
        </div>
    </div>
</div>
<?php
include("../../templates/footer.php");
?>