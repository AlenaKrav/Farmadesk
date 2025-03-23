<?php
$titulo = "Editar información de un miembro del equipo";
$pagina_activa = "equipo";
include("./templates/header.php");
var_dump($persona);
?>

<div class="card">
    <div class="card-header">Actualizar la receta</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
        <div class="mb-3">
                <label for="id" class="form-label">Id:</label>
                <input readonly type="text" class="form-control" value="<?php echo $persona->id;?> "name="id" id="id" aria-describedby="helpId" placeholder="Id"/>
            </div>
            <div class="mb-3">
    <label for="imagen" class="form-label">Imagen:</label>
    <a href="<?php echo $url_base; ?>assets/img/team/<?php echo $persona->imagen; ?>" target="_blank" title="Ver imagen en tamaño completo">
    <img class="clickable" src="<?php echo $url_base; ?>assets/img/team/<?php echo $persona->imagen; ?>" />
</a>
    <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen"/>
</div>
<div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" value="<?php echo $persona->nombre;?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" />
            </div>

            <div class="mb-3">
                <label for="puesto" class="form-label">Puesto:</label>
                <input type="text" class="form-control" value="<?php echo $persona->puesto;?>"name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto" />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" value="<?php echo $persona->descripcion;?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />
            </div>
            <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base?>admin/equipo" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>





<?php
include("./templates/footer.php");
?>