<?php
include("./templates/header.php");
// var_dump($_FILES['imagen_receta']);
echo ($receta->imagen_receta);
?>
<div class="card">
    <div class="card-header">Actulizar la receta</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
        <div class="mb-3">
                <label for="id_receta" class="form-label">Id Receta:</label>
                <input readonly type="text" class="form-control" value="<?php echo $receta->id_receta;?> "name="id_receta" id="id_receta" aria-describedby="helpId" placeholder="Id Receta"/>
            </div>
        <!-- <div class="mb-3">
                <label for="paciente_id" class="form-label">ID de Paciente:</label>
                <input type="text" class="form-control" value="<?php echo $receta->paciente_id;?>" name="paciente_id" id="paciente_id" aria-describedby="helpId" placeholder="ID de Paciente:" />
            </div> -->

            <div class="mb-3">
                <label for="paciente_id" class="form-label">ID de Paciente:</label>
                <input type="text" class="form-control" value="<?php echo $receta->paciente_id;?>" name="paciente_id" id="paciente_id" aria-describedby="helpId" placeholder="Escribe el nombre del paciente" />
                <div id="sugerencias"></div>
            </div>

            <div class="mb-3">
    <label for="imagen" class="form-label">Imagen:</label>
    <a href="<?php echo $url_base; ?>assets/img/recetas/<?php echo $receta->imagen_receta; ?>" target="_blank" title="Ver imagen en tamaño completo">
    <img class="clickable" src="<?php echo $url_base; ?>assets/img/recetas/<?php echo $receta->imagen_receta; ?>" />
</a>
    <input type="file" class="form-control" name="imagen_receta" id="imagen_receta" aria-describedby="helpId" placeholder="Imagen"/>
</div>
<div class="mb-3">
                <label for="nombre" class="form-label">Nombre fármaco:</label>
                <input type="text" class="form-control" value="<?php echo $receta->nombre;?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" />
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" value="<?php echo $receta->fecha;?>" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha" />
            </div>

            <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
    <select name="estado" id="estado" class="form-control">
        <option value="Enviada" <?php echo ($receta->estado == "Enviada" ? 'selected' : ''); ?>>Enviada</option>
        <option value="En proceso" <?php echo ($receta->estado == "En proceso" ? 'selected' : ''); ?>>En proceso</option>
        <option value="Completada" <?php echo ($receta->estado == "Completada" ? 'selected' : ''); ?>>Completada</option>
        <option value="Rechazada" <?php echo ($receta->estado == "Rechazada" ? 'selected' : ''); ?>>Rechazada</option>
    </select>
            </div>

            <div class="mb-3">
                <label for="codigo_nacional" class="form-label">Codigo nacional:</label>
                <input type="text" class="form-control" value="<?php echo $receta->codigo_nacional;?>"name="codigo_nacional" id="codigo_nacional" aria-describedby="helpId" placeholder="Codigo nacional" />
            </div>
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones:</label>
                <input type="text" class="form-control" value="<?php echo $receta->observaciones;?>" name="observaciones" id="observaciones" aria-describedby="helpId" placeholder="Observaciones" />
            </div>
            <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base?>admin/recetas" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php
include("./templates/footer.php");
?>