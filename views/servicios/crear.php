<?php
$titulo = "Crear servicios";
$pagina_activa = "servicios";
include("./templates/header.php");
?>
<div class="card">
    <div class="card-header">Crear servicios</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="icono" class="form-label">Icono:</label>
                <input type="text" class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono" />
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />
            </div>
            <button type="submit" name="agregar" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>admin/servicios" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php
include("./templates/footer.php");
?>