<?php
include("./templates/paciente_header.php");
// session_start();
// print_r($_POST);
// print_r($_FILES);
// print_r($_SESSION);

?>
<div class="card">
    <div class="card-header">Dar de alta una nueva receta</div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">
    <input type="hidden" name="id_paciente" value="<?php echo $_SESSION['id_paciente']; ?>" />
            <div class="mb-3">
    <label for="imagen" class="form-label">Imagen:</label>
    <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen"/>
</div>
<div class="mb-3">
                <label for="nombre" class="form-label">Nombre del fármaco:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" />
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha" />
            </div>
            <button type="submit" name="agregar" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base; ?>paciente/recetas" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php
include("./templates/paciente_footer.php");
?>

