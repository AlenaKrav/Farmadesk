<?php
include("./templates/header.php");
// print_r($servicio);
?>
<div class="card">
    <div class="card-header">Editar la información de los servicios</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
        <div class="mb-3">
                <label for="txtID" class="form-label">Id:</label>
                <input readonly value="<?php echo $servicio->id ?>" type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="Id" />
            </div>
            <div class="mb-3">
                <label for="icono" class="form-label">Icono:</label>
                <input value="<?php echo $servicio->icono ?>" type="text" class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono" />
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input value="<?php echo $servicio->titulo ?>" type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input value="<?php echo $servicio->descripcion ?>" type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />
            </div>
            <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>admin/servicios" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php
include("./templates/footer.php");
?>